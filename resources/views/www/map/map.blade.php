<x-layout>

    <div class="body">
        <div class="map_wrap">
            <div class="map_head_wrap">
                <div class="map_filter_wrap">
                    <div class="dropdown_box type_2">
                        <button class="dropdown_label">실거래가지도</button>
                        <ul class="optionList">
                            <li class="optionItem" onclick="location.href='map.html'">실거래가지도</li>
                            <li class="optionItem" onclick="location.href='map_property.html'">매물지도</li>
                        </ul>
                    </div>

                    <div class="filter_dropdown_wrap">
                        <!-- filter 매물 종류 : s -->
                        <div class="filter_btn_wrap">
                            <button class="filter_btn_trigger">매물 종류</button>
                            <div class="filter_panel panel_item_1">
                                <div class="filter_panel_body">
                                    <h6>매물 종류</h6>
                                    <div class="btn_radioType">
                                        <input type="radio" name="estate_type" id="estate_type_1" value="Y">
                                        <label for="estate_type_1">지식산업센터</label>
                                        <input type="radio" name="estate_type" id="estate_type_2" value="Y">
                                        <label for="estate_type_2">상가</label>
                                        <input type="radio" name="estate_type" id="estate_type_3" value="Y">
                                        <label for="estate_type_3">건물</label>
                                        <input type="radio" name="estate_type" id="estate_type_4" value="Y">
                                        <label for="estate_type_4">아파트</label>
                                    </div>
                                </div>
                                <div class="filter_panel_bottom">
                                    <button class="btn_graylight_ghost btn_md_full"><img
                                            src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                                    <button class="btn_point btn_md_full">적용하기</button>
                                </div>
                            </div>
                        </div>
                        <!-- filter 매물 종류 : e -->

                        <!-- filter 준공연차 : s -->
                        <div class="filter_btn_wrap">
                            <button class="filter_btn_trigger">준공연차</button>
                            <div class="filter_panel panel_item_3">
                                <div class="filter_panel_body">
                                    <h6>준공연차</h6>
                                    <div class="btn_radioType">
                                        <input type="radio" name="year" id="year_1" value="Y">
                                        <label for="year_1">전체</label>
                                        <input type="radio" name="year" id="year_2" value="Y">
                                        <label for="year_2">1년 이내</label>
                                        <input type="radio" name="year" id="year_3" value="Y">
                                        <label for="year_3">2년 이내</label>
                                        <input type="radio" name="year" id="year_4" value="Y">
                                        <label for="year_4">5년 이내</label>
                                        <input type="radio" name="year" id="year_5" value="Y">
                                        <label for="year_5">10년 이내</label>
                                        <input type="radio" name="year" id="year_6" value="Y">
                                        <label for="year_6">15년 이내</label>
                                        <input type="radio" name="year" id="year_7" value="Y">
                                        <label for="year_7">15년 이상</label>
                                    </div>
                                </div>
                                <div class="filter_panel_bottom">
                                    <button class="btn_graylight_ghost btn_md_full"><img
                                            src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                                    <button class="btn_point btn_md_full">적용하기</button>
                                </div>
                            </div>
                        </div>
                        <!-- filter 준공연차 : e -->
                    </div>
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
                            <button id="current"><img
                                    src="{{ asset('assets/media/ic_map_activate1.png') }}"></button>
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
                    <button class="map_view_btn">익선동 <span class="txt_point">실거래가</span> 보기</button>
                    <div class="map_bottom_btn">
                        <button onclick="location.href='{{ route('www.product.create.view') }}'"><img
                                src="{{ asset('assets/media/ic_org_estate.png') }}">매물 내놓기</button>
                        <button onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'"><img
                                src="{{ asset('assets/media/btn_point_search.png') }}">매물 구하기</button>
                    </div>

                    {{--  네이버 지도 --}}
                    <div id="map" style="width:100%; height:100%;"></div>
                    <div id="pano" style="width:100%; height:100%;"></div>
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

    function getProductSide(markerId, markerType) {
        console.log(markerId, markerType);
        $.ajax({
            type: "get", // 전송타입
            url: "{{ route('www.map.side.view') }}",
            data: {
                'id': markerId,
                'type': markerType
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



    // 가격을 '억'과 '천' 단위로 포맷하는 함수
    function formatPrice(priceString) {
        // 문자열을 숫자로 변환
        var price = parseInt(priceString.replace(/,/g, ''), 10);

        if (isNaN(price)) {
            return ''; // 숫자로 변환할 수 없는 경우 빈 문자열 반환
        }

        var billion = Math.floor(price / 10000); // 억 단위
        var thousand = price % 10000; // 천 단위

        if (billion > 0) {
            return `${billion}억${thousand > 0 ? thousand : ''}`;
        } else {
            return `${thousand}`;
        }
    }


    // 매물 데이터
    // 내 줌위치 이동 시 몇미터만 가져오게 api 변경해야댐
    const data = {!! json_encode($data) !!};

    // 폴리라인
    var polylines = [];
    // 마커
    var markers = [];
    var map;
    var pano = null;
    var lastActiveMarkerElement = null;

    // var htmlMarker = {
    //     content: '<div style="cursor:pointer;width:40px;height:40px;line-height:42px;font-size:10px;color:white;text-align:center;font-weight:bold;background:url({{ asset('assets/media/cluster_marker_1.png') }});background-size:contain;"></div>',
    //     size: N.Size(40, 40),
    //     anchor: N.Point(20, 20)
    // };

    window.initMap = function() {
        map = new naver.maps.Map('map', {
            center: new naver.maps.LatLng(37.5665, 126.9780),
            zoom: 15,
            minZoom: 8,
            maxZoom: 21,
            size: new naver.maps.Size(window.innerWidth, window.innerHeight),
            mapTypeId: naver.maps.MapTypeId.NORMAL,
        });

        // 공통 변수 선언
        var bounds = new naver.maps.LatLngBounds();
        var pathCoordinates = [];
        var infoWindow = new naver.maps.InfoWindow();
        var markers = [];

        // 배열 초기화
        var aptMapsArray = Array.isArray(data.aptMaps) ? data.aptMaps : [];
        var mapsArray = Array.isArray(data.maps) ? data.maps : [];
        var knowledgesArray = Array.isArray(data.knowledges) ? data.knowledges : [];
        var storeArray = Array.isArray(data.store) ? data.store : [];
        var buildingArray = Array.isArray(data.building) ? data.building : [];

        var sidoArray = [
            [37.5666103, 126.9783882, '서울'],
            [37.8603672, 128.3115261, '강원도'],
            [37.4363177, 127.550802, '경기도'],
            [35.4414209, 128.2417453],
            [36.6308397, 128.962578],
            [35.160032, 126.851338],
        ]

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
            pathCoordinates.push(position);

            naver.maps.Event.addListener(marker, 'click', function() {
                var markerElement = marker.getElement(); // 현재 마커의 DOM 요소
                var markerId = marker.id; // 마커의 고유 ID
                var markerType = marker.type; // 마커의 타입
                var mapSide = document.querySelector('.map_side');

                // 현재 마커의 activeMarker 요소 선택
                var currentActiveMarkerElement = markerElement.querySelector('.activeMarker');

                // 클릭된 마커가 이미 active 상태인 경우
                if (lastActiveMarkerElement === currentActiveMarkerElement) {
                    // map_side의 active 클래스를 제거
                    mapSide.classList.remove('active');
                    // 클릭된 마커의 active 클래스를 제거
                    $(currentActiveMarkerElement).removeClass('active');
                    // 마지막 active 마커를 null로 설정
                    lastActiveMarkerElement = null;

                    if (polygonMap) {
                        polygonMap.setMap(null);
                    }
                } else {
                    // 클릭된 마커가 다른 마커인 경우
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

        // 가격 형식화 함수
        function addCommasToNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // 제곱미터 단위를 평 단위로 변환하는 함수
        function convertToPyeong(squareMeters) {
            return Math.floor(squareMeters / 3.305785); // 내림하여 정수로 반환
        }

        // 각 데이터 배열 처리
        processDataArray(knowledgesArray, 'knowledge', ({
            product_name,
            sale_min_price,
            sale_max_price,
            lease_min_price,
            lease_max_price
        }) => `<div class="activeMarker iw_inner">
                            <h3>${product_name}</h3>
                            <div class="inner_info">
                                <p>매매 <span>${addCommasToNumber(sale_min_price)}~${addCommasToNumber(sale_max_price)}</span></p>
                                <p>임대 <span>${lease_min_price}~${lease_max_price}</span></p>
                                <span class="bubble_info">분양</span>
                            </div>
                        </div>
                    `, 0, 73);

        processDataArray(aptMapsArray, 'apt', ({
                kaptName,
                transactions,
                exclusiveArea = transactions?.exclusiveArea != null ?
                `<span class="bubble_info">${convertToPyeong(transactions?.exclusiveArea || '')}평</span>` :
                '',
            }) =>
            `<div class="activeMarker iw_mini_inner">
                            <h3>아파트</h3>
                            <div class="mini_inner_info">
                                <p>${formatPrice(transactions?.transactionPrice || '')}</p>
                            </div>
                            ${exclusiveArea}
                        </div>
                    `, 0, 50);

        processDataArray(storeArray, 'store', ({
            kstoreName
        }) => `<div class="activeMarker iw_mini_inner">
                            <h3>${kstoreName}</h3>
                            <div class="mini_inner_info">
                                &nbsp;
                            </div>
                        </div>
                    `, 0, 50);

        processDataArray(buildingArray, 'building', ({
            kbuildingName
        }) => `<div class="activeMarker iw_mini_inner">
                            <h3>${kbuildingName}</h3>
                            <div class="mini_inner_info">
                                &nbsp;
                            </div>
                        </div>
                    `, 0, 50);

        // 지도 경계 설정
        map.fitBounds(bounds);

        // 지적도 세팅
        var cadastralLayer = new naver.maps.CadastralLayer();
        var cadastralbtn = $('#cadastral');

        naver.maps.Event.addListener(map, 'cadastralLayer_changed', function() {
            if (cadastralLayer.getMap()) {
                cadastralbtn.addClass('control-on').val('지적도 끄기');
            } else {
                cadastralbtn.removeClass('control-on').val('지적도 켜기');
            }
        });

        cadastralbtn.on('click', function(e) {
            e.preventDefault();
            if (cadastralLayer.getMap()) {
                cadastralLayer.setMap(null);
                cadastralbtn.removeClass('control-on').val('지적도 켜기');
            } else {
                cadastralLayer.setMap(map);
                cadastralbtn.addClass('control-on').val('지적도 끄기');
            }
        });

        // 위성뷰 세팅
        window.toggleSatelliteView = function() {
            var currentMapTypeId = map.getMapTypeId();
            if (currentMapTypeId === naver.maps.MapTypeId.NORMAL) {
                map.setMapTypeId(naver.maps.MapTypeId.SATELLITE);
            } else {
                map.setMapTypeId(naver.maps.MapTypeId.NORMAL);
            }
        };

        naver.maps.onJSContentLoaded = function() {
            // 아이디 혹은 지도 좌표로 파노라마를 표시할 수 있습니다.
            pano = new naver.maps.Panorama("pano", {
                position: new naver.maps.LatLng(37.4808568, 126.8802557),
                pov: {
                    pan: -133,
                    tilt: 0,
                    fov: 100
                }
            });

            // 파노라마 위치가 갱신되었을 때 발생하는 이벤트를 받아 지도의 중심 위치를 갱신합니다.
            naver.maps.Event.addListener(pano, 'pano_changed', function() {
                var latlng = pano.getPosition();

                if (!latlng.equals(map.getCenter())) {
                    map.setCenter(latlng);
                }
            });
        };

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

                document.getElementById('map').style.visibility = "hidden";
                document.getElementById('pano').style.visibility = "visible";
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

        //줌을 땡기면 마커업데이트
        naver.maps.Event.addListener(map, 'zoom_changed', function() {
            updateCenter();
        });

        //드래그를 하면 마커업데이트
        naver.maps.Event.addListener(map, 'dragend', function() {
            updateCenter();
        });
    };

    window.initMap();

    // 현재 내 gps 위치로 이동
    var currentbtn = $('#current');
    currentbtn.on("click", function(e) {
        e.preventDefault();
        navigator.geolocation.getCurrentPosition((position) => {
            console.log(position)
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            var currentLocation = new naver.maps.LatLng(lat, lng)
            map.setZoom(18, true);
            map.setCenter(currentLocation);

            updateCenter();
        });
    });

    // 마커 업데이트
    function markerUpdate(lat, lng, zoomLv) {

        console.log('lat:', lat);
        console.log('lng:', lng);
        console.log('zoomLv:', zoomLv);
        var formData = {
            'lat': lat,
            'lng': lng,
            'zoomLv': zoomLv,
        };
        $.ajax({
            type: "get", // 전송타입
            url: "{{ route('www.map.map') }}",
            data: formData,
            success: function(data, status, xhr) {
                console.log("Success: ", status);
            },
            error: function(xhr, status, e) {
                console.error("Error: ", e);
            }
        });
    }

    // 화면 가운데 좌표 가져오기 > 좌표 업데이트
    function updateCenter() {
        var center = map.getCenter();
        var zoom = map.getZoom();
        markerUpdate(center.lat(), center.lng(), zoom);
    }

    // 필터 열기
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

    var slider = document.querySelector("#rangeItem_1");
    var valueMin = document.querySelector("#item_1_min");
    var valueMax = document.querySelector("#item_1_max");
    var item1txt = document.querySelector("#item_1_txt");



    // noUiSlider.create(slider, {
    //     start: [0, 100],
    //     connect: true,
    //     range: {
    //         "min": 0,
    //         "max": 100
    //     }
    // });

    // slider.noUiSlider.on("update", function(values, handle) {
    //     if (values[0] < 0 || values[1] > 99) {
    //         item1txt.innerHTML = "전체";
    //     } else {
    //         valueMin.innerHTML = values[0];
    //         valueMax.innerHTML = values[1];
    //         item1txt.innerHTML = "<span id='kt_slider_basic_min'>" + values[0] +
    //             "원</span> ~ <span id='kt_slider_basic_max'>" + values[1] + "원</span>";
    //     }
    // });



    // var map = new naver.maps.Map('map', {
    //     center: new naver.maps.LatLng(37.3595704, 127.105399),
    //     mapTypeControl: true,
    //     mapTypeControlOptions: {
    //         style: naver.maps.MapTypeControlStyle.DROPDOWN
    //     }
    // });

    // });
    // // // 지도 옵션 설정
    // var mapOptions = {
    //     center: new naver.maps.LatLng(37.5665, 126.9780),
    //     zoom: 10,
    //     size: new naver.maps.Size(w, h),
    // };

    // // 지도 객체 생성
    // var map = new naver.maps.Map('map', map);

    // var contentEl = $(
    //     '<div style="width:350px;position:absolute;top:0;right:0;z-index:1000;background-color:#fff;border:solid 1px #333;">' +
    //     '<h3>Map States</h3>' +
    //     '<p style="font-size:14px;">zoom : <em class="zoom">' + map.getZoom() + '</em></p>' +
    //     '<p style="font-size:14px;">centerPoint : <em class="center">' + map.getCenterPoint() + '</em></p>' +
    //     '</div>');

    // contentEl.appendTo(map.getElement());


    // naver.maps.Event.addListener(map, 'zoom_changed', function(zoom) {
    //     contentEl.find('.zoom').text(zoom);
    // });

    // naver.maps.Event.addListener(map, 'bounds_changed', function(bounds) {
    //     // contentEl.find('.center').text(map.getCenterPoint());
    //     // console.log('Center: ' + map.getCenter().toString() + ', Bounds: ' + bounds.toString());
    // });
</script>

<script>
    function getSidoData() {
        // 시도 데이터를 가져오는 함수
        return [{
                lat: 37.5665,
                lng: 126.9780,
                name: '서울'
            },
            {
                lat: 35.1796,
                lng: 129.0756,
                name: '부산'
            },
            // 추가 시도 데이터
        ];
    }

    function getSigunguData() {
        // 시군구 데이터를 가져오는 함수
        return [{
                lat: 37.4138,
                lng: 127.5183,
                name: '성남시'
            },
            {
                lat: 37.4563,
                lng: 126.7052,
                name: '인천시'
            },
            // 추가 시군구 데이터
        ];
    }

    function getEupmyeondongData() {
        // 읍면동 데이터를 가져오는 함수
        return [{
                lat: 37.5665,
                lng: 126.9780,
                name: '가산동'
            },
            {
                lat: 35.1796,
                lng: 129.0756,
                name: '해운대동'
            },
            // 추가 읍면동 데이터
        ];
    }

    function getIndividualListings() {
        // 개별 매물 데이터를 가져오는 함수
        return [{
                lat: 37.5665,
                lng: 126.9780,
                name: '매물 1'
            },
            {
                lat: 35.1796,
                lng: 129.0756,
                name: '매물 2'
            },
            // 추가 매물 데이터
        ];
    }

    function createMarker(position) {
        return new naver.maps.Marker({
            position: new naver.maps.LatLng(position.lat, position.lng),
            map: map,
            title: position.name,
            icon: {
                content: `<div class="marker">${position.name}</div>`,
                anchor: new naver.maps.Point(12, 12)
            }
        });
    }

    function updateMarkers() {
        var zoomLevel = map.getZoom();
        var clusterer;
        var positions = [];

        // 기존 마커 클러스터링 제거
        if (markers.length > 0) {
            markers.forEach(marker => marker.setMap(null));
            markers = [];
        }

        if (zoomLevel >= 10 && zoomLevel <= 12) {
            // 시도 기준 클러스터링
            positions = getSidoData();
        } else if (zoomLevel >= 7 && zoomLevel <= 9) {
            // 시군구 기준 클러스터링
            positions = getSigunguData();
        } else if (zoomLevel >= 5 && zoomLevel <= 6) {
            // 읍면동 기준 클러스터링
            positions = getEupmyeondongData();
        } else if (zoomLevel >= 1 && zoomLevel <= 4) {
            // 개별 매물 표시
            positions = getIndividualListings();
        }

        // 클러스터러 생성
        clusterer = new naver.maps.MarkerClusterer({
            map: map,
            averageCenter: true,
            minClusterSize: 2,
            markers: markers
        });

        // 마커 생성 및 클러스터 추가
        positions.forEach(position => {
            var marker = createMarker(position);
            markers.push(marker);
        });

        if (clusterer) {
            clusterer.addMarkers(markers);
        }
    }

    // naver.maps.Event.addListener(map, 'zoom_changed', updateMarkers);
    // naver.maps.Event.addListener(map, 'dragend', updateMarkers);

    // updateMarkers();
</script>
