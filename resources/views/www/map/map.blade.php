<x-layout>

    <div class="body">
        <div class="map_wrap">
            <div class="map_head_wrap">
                <div class="map_filter_wrap">
                    <div class="dropdown_box type_2">
                        <button class="dropdown_label" id="mapTypeText">실거래가지도</button>
                        <input type="hidden" id="mapType" value="0">
                        <ul class="optionList">
                            <li class="optionItem" onclick="mapTypeChage(0)">실거래가지도</li>
                            <li class="optionItem" onclick="mapTypeChage(1)">매물지도</li>
                        </ul>
                    </div>

                    <x-pc-map-filter />
                    <x-pc-map-property-filter />
                </div>
                <div>
                    <button class="btn_graylight_ghost btn_sm"><img src="{{ asset('assets/media/ic_reset.png') }}">전체
                        초기화</button>
                </div>
            </div>
            <div class="map_search_wrap">
                <div class="flex_between">
                    <input type="text" id="search_input" placeholder="금천구 가산동">
                    <img src="{{ asset('assets/media/btn_solid_delete.png') }}" alt="del" class="btn_del">
                    <button><img src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
                </div>
            </div>
            <div class="map_body">
                <!-- map side : s -->
                <div class="map_side">

                </div>
                <!-- map side : e -->

                <div class="map_area">
                    <div class="map_side_btn">
                        <div>
                            <button id="current"><img src="{{ asset('assets/media/ic_map_activate1.png') }}"></button>
                            <div class="btn_zoom">
                                <button id="zoomout"><img
                                        src="{{ asset('assets/media/ic_map_activate2.png') }}"></button>
                                <button id="zoomin"><img
                                        src="{{ asset('assets/media/ic_map_activate3.png') }}"></button>
                            </div>
                        </div>
                        <div class="btn_view_type">
                            <button id="cadastral">지적도</button>
                            <button onclick="toggleSatelliteView()">위성뷰</button>
                        </div>
                        <button id="streetView"><img src="{{ asset('assets/media/ic_map_activate4.png') }}"></button>
                    </div>
                    <button type="button" class="map_view_btn" onclick="mapTypeViewChage()">
                        <span id="centerDongText">익선동</span>
                        <span class="txt_point centerDongMapText">실거래가</span> 보기
                    </button>
                    <div class="map_bottom_btn">
                        <button onclick="location.href='{{ route('www.product.create.view') }}'"><img
                                src="{{ asset('assets/media/ic_org_estate.png') }}">매물 내놓기</button>
                        <button onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'"><img
                                src="{{ asset('assets/media/btn_point_search.png') }}">매물 구하기</button>
                    </div>

                    {{--  네이버 지도 --}}
                    <div id="mapArea">
                        <div id="map" style="width:100%; height:100%;"></div>
                    </div>
                    <div id="panoArea">
                        <div id="pano" style="width:100%; height:100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.5/proj4.js"></script>
<script type="text/javascript"
    src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
</script>
<script>
    var polygonMap = null;
    var map;
    var pano;
    var markers = []; // 마커 배열을 전역 변수로 선언
    var bounds; // bounds 전역 변수로 선언
    var lastActiveMarkerElement = null; // 마지막으로 활성화된 마커 요소를 저장

    // 마커 클릭 사이드맵
    function getProductSide(markerId, markerType) {
        $.ajax({
            type: "get", // 전송타입
            url: "{{ route('www.map.side.view') }}",
            data: {
                'id': markerId,
                'type': markerType,
            },
            dataType: 'html',
            success: function(data, status, xhr) {
                if (polygonMap) {
                    polygonMap.setMap(null);
                }
                $('.map_side').html(data);
            },
            error: function(xhr, status, e) {
                console.error("Error: ", e);
            }
        });
    }

    // 마커 업데이트
    function markerUpdate(lat, lng, zoomLv) {
        console.log('lat:', lat);
        console.log('lng:', lng);
        console.log('zoomLv:', zoomLv);
        var formData = {
            'lat': lat,
            'lng': lng,
            'zoomLv': zoomLv,
            'sale_product_type': $('#sale_product_type').val(),
            'useDate': $('#useDate').val(),
            'mapType': $('#mapType').val(),
        };
        $.ajax({
            type: "post", // 전송타입
            dataType: 'json',
            url: "{{ route('www.map.marker') }}",
            data: formData,
            success: function(data, status, xhr) {
                var data = data.data;

                // 기존 마커 제거
                markers.forEach(marker => marker.setMap(null)); // 마커를 지도에서 제거
                markers = []; // 마커 배열 초기화
                bounds = new naver.maps.LatLngBounds(); // bounds 초기화

                // 새 마커 추가
                processRegionArray(data.region, 'region', getContentStringForRegion, 25, 55);
                processDataArray(data.knowledges, 'knowledge', getContentStringForKnowledge, 0, 73);
                processDataArray(data.aptMaps, 'apt', getContentStringForApt, 0, 50);
                processDataArray(data.store, 'store', getContentStringForStore, 0, 50);
                processDataArray(data.building, 'building', getContentStringForBuilding, 0, 50);
                processDataArray(data.product, 'product', getContentStringForApt, 0, 50);
                // processProductDataArray(data.product, 'product', getContentStringForApt, 0, 50);

                if (data.centerDongName != null) {
                    $('#centerDongText').text(data.centerDongName.dong);
                }

                // 지도 경계 설정
                // map.fitBounds(bounds);
            },
            error: function(xhr, status, e) {
                console.error("Error1: ", e);
            }
        });
    }

    // 데이터 배열 처리 함수
    function processDataArray(array, type, getContentString, anchorX, anchorY) {
        array.forEach(item => {
            var {
                id,
                address_lat,
                address_lng
            } = item;
            var contentString = getContentString(item);
            createMarker({
                id: id,
                lat: address_lat,
                lng: address_lng,
                type: type,
                contentString: contentString,
                anchorX: anchorX,
                anchorY: anchorY
            });
        });
    }

    // 데이터 배열 처리 함수
    function processRegionArray(array, type, getContentString, anchorX, anchorY) {
        array.forEach(item => {
            var {
                id,
                address_lat,
                address_lng
            } = item;
            var contentString = getContentString(item);
            createRegionMarker({
                id: id,
                lat: address_lat,
                lng: address_lng,
                type: type,
                contentString: contentString,
                anchorX: anchorX,
                anchorY: anchorY
            });
        });
    }

    // 가격을 '억'과 '천' 단위로 포맷하는 함수
    function formatPrice(priceString) {
        var price = parseInt(priceString.replace(/,/g, ''), 10);
        if (isNaN(price)) {
            return '';
        }
        var billion = Math.floor(price / 10000);
        var thousand = price % 10000;
        if (billion > 0) {
            return `${billion}억${thousand > 0 ? thousand : ''}`;
        } else {
            return `${thousand}`;
        }
    }

    // 제곱미터 단위를 평 단위로 변환하는 함수
    function convertToPyeong(squareMeters) {
        return Math.floor(squareMeters / 3.305785); // 내림하여 정수로 반환
    }

    // 마커 생성 및 클릭 이벤트 리스너 추가 함수
    function createMarker({
        id,
        lat,
        lng,
        type,
        contentString,
        anchorX,
        anchorY
    }) {
        var position = new naver.maps.LatLng(lat, lng);
        var marker = new naver.maps.Marker({
            id: id,
            type: type,
            map: map,
            position: position,
            icon: {
                content: contentString,
                anchor: new naver.maps.Point(anchorX, anchorY) // 기준점을 하단 중앙으로 설정
            }
        });

        bounds.extend(position);

        naver.maps.Event.addListener(marker, 'click', function() {
            var markerElement = marker.getElement();
            var markerId = marker.id;
            var markerType = marker.type;
            var mapSide = document.querySelector('.map_side');
            var currentActiveMarkerElement = markerElement.querySelector('.activeMarker');

            if (lastActiveMarkerElement === currentActiveMarkerElement) {
                mapSide.classList.remove('active');
                $(currentActiveMarkerElement).removeClass('active');
                lastActiveMarkerElement = null;

                if (polygonMap) {
                    polygonMap.setMap(null);
                }
            } else {
                getProductSide(markerId, markerType);
                $('.activeMarker').removeClass('active');
                $(currentActiveMarkerElement).addClass('active');
                if (!mapSide.classList.contains('active')) {
                    mapSide.classList.add('active');
                }
                lastActiveMarkerElement = currentActiveMarkerElement;
            }
        });

        markers.push(marker);
    }

    // 마커 생성 및 클릭 이벤트 리스너 추가 함수
    function createRegionMarker({
        id,
        lat,
        lng,
        type,
        contentString,
        anchorX,
        anchorY
    }) {
        var position = new naver.maps.LatLng(lat, lng);
        var regionMarker = new naver.maps.Marker({
            id: id,
            type: type,
            map: map,
            position: position,
            icon: {
                content: contentString,
                anchor: new naver.maps.Point(anchorX, anchorY) // 기준점을 하단 중앙으로 설정
            }
        });

        bounds.extend(position);

        markers.push(regionMarker);
    }

    // 각 데이터별 contentString 생성 함수
    function getContentStringForRegion({
        id,
        name,
        average_price
    }) {
        return `<div class="activeMarker iw_region_inner">
        <span>${name}</span>
        <div class="mini_inner_info">
            <p>${average_price ? formatPrice(average_price.toLocaleString()) + '만' : '-'}</p>
        </div>
    </div>`;
    }

    function getContentStringForKnowledge({
        product_name,
        sale_min_price,
        sale_max_price,
        lease_min_price,
        lease_max_price
    }) {
        return `<div class="activeMarker iw_inner">
        <h3>${product_name || 'No name'}</h3>
        <div class="inner_info">
            <p>매매 <span>${sale_min_price}~${sale_max_price}</span></p>
            <p>임대 <span>${lease_min_price}~${lease_max_price}</span></p>
            <span class="bubble_info">분양</span>
        </div>
    </div>`;
    }

    function getContentStringForApt({
        kaptName,
        transactions
    }) {
        var exclusiveArea = transactions?.exclusiveArea != null ?
            `<span class="bubble_info">${convertToPyeong(transactions.exclusiveArea || '')}평</span>` : '';
        return `<div class="activeMarker iw_mini_inner">
        <h3>아파트</h3>
        <div class="mini_inner_info">
            <p>${formatPrice(transactions?.transactionPrice || '')}</p>
        </div>
        ${exclusiveArea}
    </div>`;
    }

    function getContentStringForStore({
        kstoreName
    }) {
        return `<div class="activeMarker iw_mini_inner">
        <h3>${kstoreName || 'No name'}</h3>
        <div class="mini_inner_info">
            &nbsp;
        </div>
    </div>`;
    }

    function getContentStringForBuilding({
        kbuildingName
    }) {
        return `<div class="activeMarker iw_mini_inner">
        <h3>${kbuildingName || 'No name'}</h3>
        <div class="mini_inner_info">
            &nbsp;
        </div>
    </div>`;
    }

    function initializeMap() {
        map = new naver.maps.Map('map', {
            center: new naver.maps.LatLng(37.45404740497049, 126.9087944960182),
            zoom: 20,
            minZoom: 8,
            maxZoom: 21,
            size: new naver.maps.Size(window.innerWidth, window.innerHeight),
            mapTypeId: naver.maps.MapTypeId.NORMAL,
        });

        bounds = new naver.maps.LatLngBounds();

        // 지도 로드 완료 후 이벤트 리스너 추가
        naver.maps.Event.addListener(map, 'init', function() {

            pano = new naver.maps.Panorama("pano");


            // 파노라마 위치가 갱신되었을 때 발생하는 이벤트를 받아 지도의 중심 위치를 갱신합니다.
            naver.maps.Event.addListener(pano, 'pano_changed', function() {
                var latlng = pano.getPosition();

                if (!latlng.equals(map.getCenter())) {
                    map.setCenter(latlng);
                }
            });

            // 거리뷰 세팅
            var streetLayer = new naver.maps.StreetLayer();
            var streetbtn = $('#streetView');
            streetbtn.on("click", function(e) {
                e.preventDefault();
                if (streetLayer.getMap()) {
                    streetLayer.setMap(null);
                } else {
                    streetLayer.setMap(map);
                }
            });

            // 지도를 클릭했을 때 발생하는 이벤트를 받아 파노라마 위치를 갱신합니다. 이때 거리뷰 레이어가 있을 때만 갱신하도록 합니다.
            naver.maps.Event.addListener(map, 'click', function(e) {
                if (streetLayer.getMap()) {
                    var latlng = e.coord;

                    // 파노라마의 setPosition()은 해당 위치에서 가장 가까운 파노라마(검색 반경 300미터)를 자동으로 설정합니다.
                    pano.setPosition(latlng);

                    document.getElementById('map').style.position = "relative";
                    // document.getElementById('pano').style.position = "relative";
                    document.getElementById('pano').style.position = "";
                }
            });


            var zoominbtn = $('#zoomin');
            var zoomoutbtn = $('#zoomout');

            // 줌인
            zoominbtn.on('click', function(e) {
                e.preventDefault();
                map.setZoom(map.getZoom() + 1, true);
            });

            // 줌아웃
            zoomoutbtn.on('click', function(e) {
                e.preventDefault();
                map.setZoom(map.getZoom() - 1, true);
            });

            // 줌 변경 시 마커 업데이트
            naver.maps.Event.addListener(map, 'zoom_changed', function() {
                updateCenter();
            });

            // 지도 드래그 종료 시 마커 업데이트
            naver.maps.Event.addListener(map, 'dragend', function() {
                updateCenter();
            });

            // 현재 위치로 이동 버튼
            var currentbtn = $('#current');
            currentbtn.on("click", function(e) {
                e.preventDefault();
                navigator.geolocation.getCurrentPosition((position) => {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    var currentLocation = new naver.maps.LatLng(lat, lng);
                    map.setZoom(18, true);
                    map.setCenter(currentLocation);
                    updateCenter();
                });
            });

            window.toggleSatelliteView = function() {
                var currentMapTypeId = map.getMapTypeId();
                if (currentMapTypeId === naver.maps.MapTypeId.NORMAL) {
                    map.setMapTypeId(naver.maps.MapTypeId.SATELLITE);
                } else {
                    map.setMapTypeId(naver.maps.MapTypeId.NORMAL);
                }
            };

            // 지적도 세팅
            var cadastralLayer = new naver.maps.CadastralLayer();
            var btn = $('#cadastral');

            naver.maps.Event.addListener(map, 'cadastralLayer_changed', function() {
                if (cadastralLayer.getMap()) {
                    btn.addClass('control-on').val('지적도 끄기');
                } else {
                    btn.removeClass('control-on').val('지적도 켜기');
                }
            });

            btn.on('click', function(e) {
                e.preventDefault();

                if (cadastralLayer.getMap()) {
                    cadastralLayer.setMap(null);
                    btn.removeClass('control-on').val('지적도 켜기');
                } else {
                    cadastralLayer.setMap(map);
                    btn.addClass('control-on').val('지적도 끄기');
                }
            });

            // 초기 마커 설정
            mapTypeChage({{ $mapType ?? 0 }})

        });
    }


    var lastCenter = null;
    var lastZoom = null;
    var totalDistance = 0;

    function getDistance(lat1, lon1, lat2, lon2) {
        var R = 6371; // 지구의 반지름 (km)
        var dLat = (lat2 - lat1) * Math.PI / 180;
        var dLon = (lon2 - lon1) * Math.PI / 180;
        var a =
            0.5 - Math.cos(dLat) / 2 +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            (1 - Math.cos(dLon)) / 2;

        return R * 2 * Math.asin(Math.sqrt(a));
    }

    function updateCenter(force) {
        var center = map.getCenter();
        var zoom = map.getZoom();

        var zoomLock;

        if (zoom <= 12) {
            zoomLock = 10000;
        } else if (zoom >= 11 && zoom <= 13) {
            zoomLock = 7;
        } else if (zoom >= 14 && zoom <= 15) {
            zoomLock = 1;
        } else {
            zoomLock = 0.6;
        }

        if (lastCenter && lastZoom !== null) {
            var distance = getDistance(lastCenter.lat(), lastCenter.lng(), center.lat(), center.lng());

            // 누적 거리 계산
            totalDistance += distance;

            // 줌 레벨이 다르거나, 줌 레벨이 같고 누적 이동 거리가 zoomLock 이상일 경우에만 업데이트
            if (lastZoom !== zoom || (lastZoom === zoom && totalDistance >= zoomLock)) {
                markerUpdate(center.lat(), center.lng(), zoom);
                // 마지막 중심 좌표와 줌 레벨 저장 및 누적 거리 초기화
                lastCenter = center;
                lastZoom = zoom;
                totalDistance = 0;
            }
        } else {
            // 최초 실행 시 마커 업데이트
            markerUpdate(center.lat(), center.lng(), zoom);
            // 마지막 중심 좌표와 줌 레벨 저장 및 누적 거리 초기화
            lastCenter = center;
            lastZoom = zoom;
            totalDistance = 0;
        }
    }


    // 페이지 로드 시 지도 초기화
    window.onload = initializeMap;
</script>

<script>
    function mapReset() {
        if (polygonMap) {
            polygonMap.setMap(null);
        }
        $('.map_side').removeClass('active');
        $('.filter_panel').css('display', 'none');

        var center = map.getCenter();
        var zoom = map.getZoom();
        markerUpdate(center.lat(), center.lng(), zoom);
    }

    function filter_reset(Name) {

        var text = '';
        if (Name == 'sale_product_type') {
            text = '매물 종류'
        } else if (Name == 'useDate') {
            text = '준공연차'
        }
        $('input[name="' + Name + '"]').prop('checked', false);
        $('#filter_text_' + Name).text(text);
        $('#' + Name).val('');
        mapReset();
    }

    function filter_apply(Name) {
        var text = $('input[name="' + Name + '"]:checked').next('label').text();
        var value = $('input[name="' + Name + '"]:checked').val();
        if (text == '') {
            return;
        }

        $('#filter_text_' + Name).text(text);
        $('#' + Name).val(value);

        mapReset();
    }

    function mapTypeViewChage() {
        mapTypeChage($('#mapType').val() == 0 ? 1 : 0)
    }

    function mapTypeChage(type) {
        $('.map_side').removeClass('active');
        $('.type_2').removeClass('active');

        var text = type == 0 ? '실거래가지도' : '매물지도';
        $('#mapTypeText').text(text);
        $('.centerDongMapText').text(type == 0 ? '매물현황' : '실거래가');

        $('#mapType').val(type);

        $('#filterType' + (type == 0 ? 1 : 0)).hide();
        $('#filterType' + type).show();

        mapReset();
    }

    // 필터 버튼 이벤트 리스너 추가
    const filterBtns = document.querySelectorAll('.filter_btn_trigger');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function(event) {
            const parent = this.parentElement;
            const panel = parent.querySelector('.filter_panel');
            document.querySelectorAll('.filter_panel').forEach(p => {
                if (p !== panel && p.style.display === 'block') {
                    p.style.display = 'none';
                }
            });
            panel.style.display = (panel.style.display === 'block') ? 'none' : 'block';
            event.stopPropagation();
        });
    });

    document.addEventListener('click', function(event) {
        const isOutsideFilterPanel = !event.target.closest('.filter_panel');
        if (isOutsideFilterPanel) {
            document.querySelectorAll('.filter_panel').forEach(p => {
                p.style.display = 'none';
            });
        }
    });
</script>
