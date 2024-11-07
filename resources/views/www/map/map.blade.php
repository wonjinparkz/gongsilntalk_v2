<x-layout>

    <div class="body">
        <div class="map_wrap">
            <div class="map_head_wrap non_pano">
                <div class="map_filter_wrap">
                    <div class="dropdown_box type_2">
                        <button class="dropdown_label" id="mapTypeText">실거래가지도</button>
                        <ul class="optionList">
                            <li class="optionItem" onclick="mapTypeChage(0)">실거래가지도</li>
                            <li class="optionItem" onclick="mapTypeChage(1)">매물지도</li>
                        </ul>
                        <input type="hidden" id="mapType" value="{{ $mapType ?? 0 }}">
                    </div>
                    <div class="filter_dropdown_wrap" id="filterType0">
                        <x-pc-map-filter />
                    </div>
                    <div class="filter_dropdown_wrap" id="filterType1">
                        <x-pc-map-property-filter />
                    </div>
                </div>
                <div>
                    <button type="button" id="resetAllFilters" class="btn_graylight_ghost btn_sm"><img
                            src="{{ asset('assets/media/ic_reset.png') }}">전체
                        초기화</button>
                </div>
            </div>
            <div class="map_search_wrap non_pano">
                <div class="flex_between">
                    <input type="text" id="search_input" class="map_search" placeholder="단지명, 동이름, 지하철역으로 검색"
                        autocomplete='off'>
                    <img src="{{ asset('assets/media/btn_solid_delete.png') }}" alt="del" class="btn_del">
                    {{-- <button><img src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button> --}}
                </div>
            </div>

            <div class="search_open" id="search_open_layer">
                <div class="search_recent">
                    <div id="search_history">
                        <div class="txt_point">최근 검색</div>
                    </div>
                    <div class="side_search_list" id="history_search_list">
                    </div>

                    <div class="side_search_list" id="search_list">
                        {{-- <div class="side_search_no_row">최그 검색어가 없습니다.</div>
                        <div class="side_search_list_row"><a href="#">서울시 구로구 구로동</a> <button><img
                                    src="{{ asset('assets/media/list_delete.png') }}"></button></div>
                        <div class="side_search_list_row"><a href="#">서울시 구로구 구로동 735-26 (구로동교회)</a> <button><img
                                    src="{{ asset('assets/media/list_delete.png') }}"></button></div>
                        <div class="side_search_list_row"><a href="#">서울시 구로구 구로동 735-26 (구로동교회)</a> <button><img
                                    src="{{ asset('assets/media/list_delete.png') }}"></button></div>
                        <div class="side_search_list_row"><a href="#">서울시 <span>구로</span>구 구로동 735-26 (구로동교회)</a>
                        </div>
                        {{-- <div class="side_search_list_row"><a href="#">서울시 <span>구로</span>구 궁동</a></div> --}}
                        {{-- <div class="side_search_list_row"><a href="#">서울시 <span>구로</span>구 항동</a></div>
                        <div class="side_search_list_row"><a href="#">서울시 <span>구로</span>구 고척동</a></div> --}}
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    loadSearchTerms();
                });

                function loadSearchTerms() {
                    $('#history_search_list').empty();
                    const searchTerm = getCookie('mapSearchTerm');
                    if (searchTerm !== "") {
                        const searchTerms = JSON.parse(searchTerm);
                        if (searchTerms.length > 0) {
                            $.each(searchTerms, function(index, value) {
                                const term = JSON.parse(value);
                                addSearchTermToList(term);
                            });
                        } else {
                            $('#history_search_list').append('<div class="side_search_no_row">최근 검색어가 없습니다.</div>');
                        }
                    } else {
                        $('#history_search_list').append('<div class="side_search_no_row">최근 검색어가 없습니다.</div>');
                    }
                }

                // 검색어를 리스트에 추가하는 함수
                function addSearchTermToList(term) {
                    const lat = term.lat;
                    const lng = term.lng;
                    const name = term.name;
                    var list = `
        <div class="side_search_list_row">
            <a onclick="search_click('${lat}', '${lng}', '${name}')">${name}</a>
            <button class="deleteBtn">
                <img src="{{ asset('assets/media/list_delete.png') }}">
            </button>
        </div>`;
                    $('#history_search_list').append(list);
                }

                // 삭제 버튼 클릭 시 해당 검색어 삭제
                $('#history_search_list').on('click', '.deleteBtn', function() {
                    const termToRemove = $(this).closest('.side_search_list_row').find('a').text().trim();
                    removeSearchTermFromCookie(termToRemove);
                    $(this).closest('.side_search_list_row').remove();
                });

                // 쿠키에서 특정 검색어를 삭제하는 함수
                function removeSearchTermFromCookie(term) {
                    let existingTerms = getCookie('mapSearchTerm');
                    if (existingTerms !== "") {
                        let termsArray = JSON.parse(existingTerms);
                        termsArray = termsArray.filter(item => JSON.parse(item).name !== term);
                        setCookie('mapSearchTerm', JSON.stringify(termsArray), 365); // 365일 동안 쿠키 저장
                    }
                }

                $('#search_input').on('keyup', function() {
                    $('#search_list').empty();
                    var search = $(this).val();
                    if (search == '') {
                        $('#search_history').show();
                        $('#history_search_list').show();
                        return;
                    }
                    $('#search_history').hide();
                    $('#history_search_list').hide();
                    if (search != '') {
                        $.ajax({
                            url: "{{ route('api.search.address') }}",
                            type: "post",
                            data: {
                                'search': search
                            },
                            success: function(data, status, xhr) {
                                var subwayList = data.result['subwayList'];
                                var regionList = data.result['regionList'];
                                subwayList.forEach(function(item, index) {
                                    var name = item.subway_name + ' ' + `[${item.line}]`;
                                    var Sname = getSearchContent(search, name);
                                    var list_row = `
                        <div class="side_search_list_row" onclick="search_click('${item.y}', '${item.x}', '${name}')">
                            <a>${Sname}</a>
                        </div>`;
                                    $('#search_list').append(list_row);
                                });
                                regionList.forEach(function(item, index) {
                                    var name = item.sido + ' ' + item.sigungu + ' ' + item.dong;
                                    var Sname = getSearchContent(search, name);
                                    var list_row = `
                        <div class="side_search_list_row" onclick="search_click('${item.address_lat}', '${item.address_lng}', '${name}')">
                            <a>${Sname}</a>
                        </div>`;
                                    $('#search_list').append(list_row);
                                });
                            },
                            error: function(xhr, status, e) {}
                        });
                    }
                });

                // 위치 조정
                function search_click(lat, lng, name) {
                    $('#search_open_layer').css('display', 'none');
                    $('.btn_del').css('display', 'inline-block');
                    $('#search_input').val(name);

                    var currentLocation = new naver.maps.LatLng(lat, lng);
                    map.setZoom(18, true);
                    map.setCenter(currentLocation);

                    const searchInputValue = name;
                    if (searchInputValue !== "") {
                        let existingTerms = getCookie('mapSearchTerm');
                        let newTerm = JSON.stringify({
                            name: searchInputValue,
                            lat: lat,
                            lng: lng
                        });

                        if (existingTerms !== "") {
                            let termsArray = JSON.parse(existingTerms);
                            if (!termsArray.some(term => JSON.parse(term).name === searchInputValue)) {
                                termsArray.push(newTerm);
                                setCookie('mapSearchTerm', JSON.stringify(termsArray), 365); // 365일 동안 쿠키 저장
                            }
                        } else {
                            let termsArray = [newTerm];
                            setCookie('mapSearchTerm', JSON.stringify(termsArray), 365); // 365일 동안 쿠키 저장
                        }
                    }
                    loadSearchTerms();
                }

                function setCookie(cname, cvalue, exdays) {
                    const d = new Date();
                    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                    let expires = "expires=" + d.toUTCString();
                    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }

                // 쿠키에서 불러오는 함수
                function getCookie(cname) {
                    const name = cname + "=";
                    const decodedCookie = decodeURIComponent(document.cookie);
                    const ca = decodedCookie.split(';');
                    for (let i = 0; i < ca.length; i++) {
                        let c = ca[i];
                        while (c.charAt(0) == ' ') {
                            c = c.substring(1);
                        }
                        if (c.indexOf(name) == 0) {
                            return c.substring(name.length, c.length);
                        }
                    }
                    return "";
                }
            </script>


            <div class="map_body ">
                <!-- map side : s -->
                <div class="map_side map_side_0 non_pano_side"></div> <!-- 실거래가 -->
                <div class="map_side property_type map_side_1 non_pano_side">
                    <x-pc-map-side-product />
                </div>
                <!-- <div class="map_side transaction_type">
                </div> -->

                <!-- map side : e -->

                <div class="map_area">
                    <div class="map_side_btn non_pano">
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
                            <button class="toggle-btn" id="cadastral">지적도</button>
                            <button class="toggle-btn" onclick="toggleSatelliteView()">위성뷰</button>
                        </div>
                        <button class="toggle-btn line_type" id="streetView"><span></span></button>
                        <!-- <button class="toggle-btn line_type" id="streetView"><img src="{{ asset('assets/media/ic_map_activate4.png') }}"></button> -->
                    </div>
                    <div class="non_pano">
                        <button type="button" class="map_view_btn" onclick="mapTypeViewChage()">
                            <span id="centerDongText">익선동</span>
                            <span class="txt_point centerDongMapText">실거래가</span> 보기
                        </button>
                    </div>
                    <div class="map_bottom_btn non_pano">
                        @if (Auth::guard('web')->user()->type ?? 0 == 1)
                            <button onclick="location.href='{{ route('www.corp.product.create.view') }}'"><img
                                    src="{{ asset('assets/media/ic_org_estate.png') }}">매물 내놓기</button>
                        @else
                            <button onclick="location.href='{{ route('www.product.create.view') }}'"><img
                                    src="{{ asset('assets/media/ic_org_estate.png') }}">매물 내놓기</button>
                        @endif
                        <button onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'"><img
                                src="{{ asset('assets/media/btn_point_search.png') }}">매물 구하기</button>
                    </div>

                    {{--  네이버 지도 --}}
                    <div id="mapArea">
                        <div id="map" style="width:100%; height:100%;"></div>
                    </div>
                    <button class="btn_pano_close"><img src="{{ asset('assets/media/btn_img_delete.png') }}"></button>
                    <div id="panoArea" class="pano_wrap">
                        <div id="pano" style="width:100%; height:100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>


<script>
    const buttons = document.querySelectorAll('.toggle-btn');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            button.classList.toggle('clicked');
        });
    });

    // 커리뷰 끄기
    $(document).ready(function() {
        // 초기 상태에서 버튼 숨기기
        $('.btn_pano_close').hide();

        // 버튼 클릭 시 pano의 스타일 변경
        $('.btn_pano_close').on('click', function() {
            $('#pano').css('position', 'relative');
            checkPosition();
        });

        function checkPosition() {
            // pano의 position이 relative가 아닌지 확인
            if ($('#pano').css('position') !== 'relative') {
                document.querySelector('.btn_pano_close').style.display = 'block';
            } else {
                document.querySelector('.btn_pano_close').style.display = 'none';
                document.getElementById('panoArea').style.display = 'none';
                document.getElementById('mapArea').style.display = 'block';
                $('.btn_pano_close').hide();
                $('.non_pano').show();
                mapReset();
            }
        }

        // 페이지 로드 시 초기 상태 확인
        // checkPosition();
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.5/proj4.js"></script>
<script type="text/javascript"
    src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
</script>
<script src="{{ asset('assets/js/MarkerClustering.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
    var today = new Date();
    var polygonMap = null;
    var map;
    var pano;
    var markers = []; // 마커 배열을 전역 변수로 선언
    var productMarkers = []; // product 마커 배열 초기화
    var agentMarkers = []; // product 마커 배열 초기화
    var bounds; // bounds 전역 변수로 선언
    var lastActiveMarkerElement = null; // 마지막으로 활성화된 마커 요소를 저장
    var knowledgeClustering;
    var productClustering;
    var agentClustering;
    var MarkerIdArray = []; // 클러스터링 매물,중개사 ids 임시 저장소
    var productIdArray = []; // 매물 ids 저장소
    var agentIdArray = []; // 중개사 ids 저장소

    function compareDate(completion_date) {
        const todayString = today.toISOString().slice(0, 10).replace(/-/g, '');
        return completion_date < todayString ? 0 : 1;
    }



    // 마커 클릭 사이드맵
    function getProductSide(markerId, markerType, mapType) {
        $.ajax({
            type: "get", // 전송타입
            url: "{{ route('www.map.side.view') }}",
            data: {
                'id': markerId,
                'type': markerType,
                'mapType': mapType,
            },
            dataType: 'html',
            success: function(data, status, xhr) {
                if (polygonMap) {
                    polygonMap.setMap(null);
                }
                $('.map_side_0').html(data);
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
        if ($('#mapType').val() == 0) {
            formData.sale_product_type = $('#sale_product_type').val();
            formData.useDate = $('#useDate').val();
        } else {
            formData.product_type = $('#product_type').val();
            formData.payment_type = $('#payment_type').val();
            formData.price = $('#price').val();
            formData.month_price = $('#month_price').val();
            formData.area = $('#area').val();
            formData.square = $('#square').val();
            formData.service_price = $('#service_price').val();
            formData.approve_date = $('#approve_date').val();
            formData.loan_type = $('#loan_type').val();
            formData.premium_price = $('#premium_price').val();
            formData.business_type = $('#business_type').val();
            formData.floor_height_type = $('#floor_height_type').val();
            formData.wattage_type = $('#wattage_type').val();
        }

        $.ajax({
            type: "post", // 전송타입
            dataType: 'json',
            url: "{{ route('www.map.marker') }}",
            data: formData,
            success: function(data, status, xhr) {
                var data = data.data;

                // 기존 마커 제거
                if (knowledgeClustering) {
                    knowledgeClustering.setMap(null);
                    knowledgeClustering = null;
                }
                if (productClustering) {
                    productClustering.setMap(null);
                    productClustering = null;
                }
                if (agentClustering) {
                    agentClustering.setMap(null);
                    agentClustering = null;
                }
                markers.forEach(marker => marker.setMap(null)); // 마커를 지도에서 제거
                markers = []; // 마커 배열 초기화

                productMarkers.forEach(productMarkers => productMarkers.setMap(null));
                productMarkers = []; // product 마커 배열 초기화

                agentMarkers.forEach(agentMarkers => agentMarkers.setMap(null));
                agentMarkers = []; // agent 마커 배열 초기화

                bounds = new naver.maps.LatLngBounds(); // bounds 초기화

                // 새 마커 추가
                processRegionArray(data.region, 'region', getContentStringForRegion, 25, 55);
                processDataArray(data.knowledges, 'knowledge', getContentStringForKnowledge, 0, 73);
                processDataArray(data.aptMaps, 'apt', getContentStringForApt, 0, 50);
                processDataArray(data.store, 'store', getContentStringForStore, 0, 50);
                processDataArray(data.building, 'building', getContentStringForBuilding, 0, 50);

                processProductArray(data.product, 'product', 0, 50);
                processAgentArray(data.agent, 'agent', 0, 50);


                if (data.centerDongName != null) {
                    $('#centerDongText').text(data.centerDongName.dong);
                }

                if ($('#mapType').val() != 0) {
                    clusterProductMarkers();
                    clusterAgentMarkers();
                    loadMoreData();
                } else {
                    clusterKnowledgesMarkers();
                }

                @if ($markerId != '' && $markerType != '')
                    getProductSide('{{ $markerId }}', '{{ $markerType }}', 0)
                    $('.map_side_0').addClass('active');
                @endif

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
                address_lng,
            } = item;
            var contentString = getContentString(item);
            createMarker({
                id: id,
                lat: address_lat,
                lng: address_lng,
                type: type,
                sale_mid_price: (type == 'knowledge' ? item.sale_mid_price : ''),
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

    // 데이터 배열 처리 함수
    function processProductArray(array, type, anchorX, anchorY) {
        array.forEach(item => {
            var {
                id,
                address_lat,
                address_lng,
                type,
            } = item;
            createProductMarker({
                id: id,
                lat: address_lat,
                lng: address_lng,
                type: type,
                anchorX: anchorX,
                anchorY: anchorY
            });
        });
    }

    // 데이터 배열 처리 함수
    function processAgentArray(array, type, anchorX, anchorY) {
        array.forEach(item => {
            var {
                id,
                company_address_lat,
                company_address_lng,
                type,
                image
            } = item;
            createAgentMarker({
                id: item.id,
                lat: company_address_lat,
                lng: company_address_lng,
                type: type,
                image: image,
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
        sale_mid_price,
        contentString,
        anchorX,
        anchorY
    }) {
        var position = new naver.maps.LatLng(lat, lng);
        var marker = new naver.maps.Marker({
            id: id,
            type: type,
            sale_mid_price: sale_mid_price,
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
            var mapSide = document.querySelector('.map_side_0');
            var currentActiveMarkerElement = markerElement.querySelector('.activeMarker');

            if (lastActiveMarkerElement === currentActiveMarkerElement) {
                mapSide.classList.remove('active');
                $(currentActiveMarkerElement).removeClass('active');
                lastActiveMarkerElement = null;

                if (polygonMap) {
                    polygonMap.setMap(null);
                }
            } else {
                getProductSide(markerId, markerType, 0);
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

    function createProductMarker({
        id,
        lat,
        lng,
        type,
        anchorX,
        anchorY
    }) {
        var position = new naver.maps.LatLng(lat, lng);
        var productMarker = new naver.maps.Marker({
            id: id,
            map: map,
            position: position,
            icon: {
                url: "{{ asset('assets/media/map_marker_default.png') }}",
                size: new naver.maps.Size(100, 100), //아이콘 크기
                scaledSize: new naver.maps.Size(30, 43), //아이콘 크기
                // origin: new naver.maps.Point(0, 0),
                anchor: new naver.maps.Point(anchorX, anchorY)
            }
        });

        bounds.extend(position);

        productMarkers.push(productMarker); // product 마커 배열에 추가
    }

    function createAgentMarker({
        id,
        lat,
        lng,
        type,
        image,
        anchorX,
        anchorY
    }) {
        var position = new naver.maps.LatLng(lat, lng);
        var imagePath = image != null ? "{{ Storage::url('image/') }}" + image.path :
            "{{ asset('assets/media/default_img.png') }} "
        var agentMarker = new naver.maps.Marker({
            id: id,
            map: map,
            position: position,
            icon: {
                content: `<div class="marker_default detail_info_toggle"><div class="agent_mark_img"><div class="img_box"><img src="` +
                    imagePath + `"></div></div></div>`,
                size: new naver.maps.Size(22, 35),
                anchor: new naver.maps.Point(11, 35)
            }
        });

        bounds.extend(position);
        naver.maps.Event.addListener(agentMarker, 'click', function() {
            markerId = agentMarker.id;
            agentIdArray = [markerId];
            $('#getAgentList').click();
        });

        agentMarkers.push(agentMarker); // agent 마커 배열에 추가

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
        </div>
    </div>`;
        //     return `<div class="activeMarker iw_region_inner">
        //     <span>${name}</span>
        //     <div class="mini_inner_info">
        //         <p>${average_price ? formatPrice(average_price.toLocaleString()) + '만' : '-'}</p>
        //     </div>
        // </div>`;
    }

    function getContentStringForKnowledge({
        product_name,
        sale_min_price,
        sale_max_price,
        lease_min_price,
        lease_max_price,
        completion_date
    }) {
        is_sale = '';
        if (compareDate(completion_date)) {
            is_sale = '<span class="bubble_info">준공전</span>';
        }
        return `<div class="activeMarker iw_inner">
        <h3>${product_name || 'No name'}</h3>
        <div class="inner_info">
            <p>매매 <span>${sale_min_price}~${sale_max_price}</span></p>
            <p>임대 <span>${lease_min_price}~${lease_max_price}</span></p>
            ${is_sale}
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
            center: new naver.maps.LatLng({{ $lat }}, {{ $lng }}),
            zoom: 18,
            minZoom: 8,
            maxZoom: 21,
            size: new naver.maps.Size(window.innerWidth, window.innerHeight),
            mapTypeId: naver.maps.MapTypeId.NORMAL,
        });

        bounds = new naver.maps.LatLngBounds();

        // 지도 로드 완료 후 이벤트 리스너 추가
        naver.maps.Event.addListener(map, 'init', function() {

            // pano = new naver.maps.Panorama("pano");
            pano = new naver.maps.Panorama("pano", {
                pov: {
                    pan: 0,
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
                    $('.btn_pano_close').show();
                    $('.non_pano').hide();
                    $('.non_pano_side').removeClass('active');
                    if (polygonMap) {
                        polygonMap.setMap(null);
                    }

                    var latlng = e.coord;

                    // 파노라마의 setPosition()은 해당 위치에서 가장 가까운 파노라마(검색 반경 300미터)를 자동으로 설정합니다.
                    pano.setPosition(latlng);

                    document.querySelector('.btn_pano_close').style.display = 'block';
                    document.getElementById('panoArea').style.display = 'block';
                    document.getElementById('mapArea').style.display = 'none';

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

        if (zoom <= 10) {
            zoomLock = 200;
        } else if (zoom >= 11 && zoom <= 13) {
            zoomLock = 5;
        } else if (zoom >= 14 && zoom <= 15) {
            zoomLock = 5;
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


    var htmlMarker1 = { // 매물 클러스터링 마커
            content: `<div class="cluster_marker"></div>`,
            size: N.Size(40, 40),
            anchor: N.Point(20, 20)
        },
        htmlMarker2 = { // 중개사 클러스터링 마커
            content: `<div class="marker_default detail_info_toggle"><span></span></div>`,
            size: N.Size(40, 40),
            anchor: N.Point(20, 20)
        },
        htmlMarker3 = { // 매물 클러스터링 마커
            content: `<div class="knowledge_cluster_marker active"></div>`,
            size: N.Size(40, 40),
            anchor: N.Point(20, 20)
        };

    function clusterKnowledgesMarkers() {
        if (markers.length > 0) {
            // knowledge 타입의 마커들만 필터링합니다.
            const knowledgeMarkers = markers.filter(function(marker) {
                return marker.type === 'knowledge';
            });

            knowledgeClustering = new MarkerClustering({
                minClusterSize: 1,
                maxZoom: 16,
                map: map,
                markers: knowledgeMarkers, // knowledge 마커들만 클러스터링
                disableClickZoom: false,
                knowledgeSaleMidPrice: true,
                gridSize: 70,
                icons: [htmlMarker3],
                indexGenerator: [1],
            });
        }
    }

    function clusterProductMarkers() {
        MarkerIdArray = [];
        if (productMarkers.length > 0) {

            productMarkers.forEach(function(marker) {
                marker.setVisible(false); // 마커를 숨깁니다.
            });

            productClustering = new MarkerClustering({
                minClusterSize: 0,
                maxZoom: 999,
                map: map,
                markers: productMarkers, // product 마커들만 클러스터링
                disableClickZoom: true,
                productClick: true,
                gridSize: 70,
                icons: [htmlMarker1],
                indexGenerator: [1],
                stylingFunction: function(clusterMarker, count) {
                    $(clusterMarker.getElement()).find('div:first-child').text(count);
                }
            });
            productMarkers.forEach(function(marker) {
                MarkerIdArray.push(marker.id);
            });

            productIdArray = MarkerIdArray;
        } else {
            productIdArray = [];
        }
    }

    function clusterAgentMarkers() {
        MarkerIdArray = [];

        if (13 > map.getZoom()) {
            agentMarkers.forEach(function(marker) {
                MarkerIdArray.push(marker.id);
                marker.setVisible(false); // 마커를 숨깁니다.
            });
            agentMarkers = [];
        }
        if (agentMarkers.length > 0) {
            agentClustering = new MarkerClustering({
                minClusterSize: 2,
                maxZoom: 999,
                map: map,
                markers: agentMarkers, // product 마커들만 클러스터링
                disableClickZoom: true,
                agentClick: true,
                gridSize: 70,
                icons: [htmlMarker2],
                indexGenerator: [2],
                stylingFunction: function(clusterMarker, count) {
                    $(clusterMarker.getElement()).find('div:first-child').text(count);
                }
            });
            agentMarkers.forEach(function(marker) {
                MarkerIdArray.push(marker.id);
            });

            agentIdArray = MarkerIdArray;
        } else {
            agentIdArray = MarkerIdArray;
        }
    }

    // 페이지 로드 시 지도 초기화
    window.onload = initializeMap;
</script>

<script>
    function mapReset() {
        var mapType = $('#mapType').val();
        if (polygonMap) {
            polygonMap.setMap(null);
        }
        if (mapType == 0) {
            $('.map_side_0').removeClass('active');
            $('.map_side_1').removeClass('active');
        } else {
            $('.map_side_0').removeClass('active');
            $('.map_side_1').addClass('active');
        }

        $('.filter_panel').css('display', 'none');

        var center = map.getCenter();
        var zoom = map.getZoom();
        markerUpdate(center.lat(), center.lng(), zoom);
    }

    // function filter_reset(Name) {

    //     var text = '';
    //     text = $('#' + Name + '_title').text();

    //     if (Name == 'payment_type_txt') {
    //         $('#price').val('');
    //         $('#month_price').val('');
    //     } else if (Name == 'area') {
    //         $('#square').val('');
    //     } else if (Name == 'etc') {
    //         $('floor_height_type').val('');
    //         $('wattage_type').val('');
    //     }


    //     $('input[type="radio"][name="' + Name + '"][value="0"]').prop('checked', true);
    //     $('#filter_text_' + Name).text(text);
    //     $('#' + Name).val('');
    //     mapReset();
    // }

    function filter_reset(Name) {
        var text = '';
        text = $('#' + Name + '_title').text();

        if (Name == 'payment_type_txt') {
            // 거래유형 체크박스 초기화
            $('input[name="payment_type_txt"]').prop('checked', false);
            $('#payment_type').val('');
            $('#price').val('');
            $('#month_price').val('');

            resetPaymentType();
            // 거래유형에 따른 슬라이더 상태 초기화

        } else if (Name == 'area') {
            // 면적 초기화
            $('#square').val('');
            $('#area').val('');

            initializeSliders('#rangeSquare')
            initializeSliders('#rangeArea')

        } else if (Name == 'etc') {
            // 기타 옵션 초기화
            $('input[name="floor_height_type"][type="radio"]').eq(0).prop('checked', true);
            $('input[name="wattage_type"][type="radio"]').eq(0).prop('checked', true);

            $('#floor_height_type').val('');
            $('#wattage_type').val('');

        } else if (Name == 'service_price') {
            // 관리비 초기화
            $('#service_price').val('');
            initializeSliders('#rangeServicePrice')

        } else if (Name == 'approve_date') {
            // 사용승인연도 초기화
            $('#approve_date').val('');
            $('#temp_approve_date').val('');
            initializeSliders('#rangeApproveDate')

        } else if (Name == 'premium_price') {
            // 권리금 초기화
            $('#premium_price').val('');
            initializeSliders('#rangePremiumPrice')

        } else if (Name == 'loan_type') {
            // 융자금 초기화
            $('input[name="loan_type"]').prop('checked', false);
            $('#loan_type').val('');
        } else if (Name == 'business_type') {
            // 업종 초기화
            $('input[name="business_type"]').prop('checked', false);
            $('#business_type').val('');
            $('#businessTypeAll').prop('checked', false);
        }

        // 라디오 버튼 초기화 (필요 시)
        $('input[type="radio"][name="' + Name + '"][value="0"]').prop('checked', true);
        // 필터 텍스트 초기화
        $('#filter_text_' + Name).text(text);
        // 숨겨진 input 값 초기화
        $('#' + Name).val('');

        mapReset();
    }

    function filter_apply(Name, filertType) {
        var textArray = [];
        var valueArray = [];

        $('input[name="' + Name + '"]:checked').each(function() {
            textArray.push($(this).next('label').text());
            valueArray.push($(this).val());
        });

        var text = textArray.length > 0 ? textArray.join(', ') : '';
        var value = valueArray.length > 0 ? valueArray.join(',') : '';

        var min, max;

        if (filertType == 1) {
            if (Name == 'payment_type_txt') {
                $('#payment_type').val(value ?? '');
                text = value == '' ? "전체" : text;

                $('#price').val($('#temp_price').val());
                [min, max] = $('#temp_price').val().split(',').map(Number);
                if (min == 0 && max == 200) {} else {
                    text = text + (min > 0 ? min + '억' : '') + ' ~ ' + (max < 200 ? max + '억' : '');
                }
                if (valueArray.includes('2') || valueArray.includes('4') || valueArray.length == 0) {
                    $('#month_price').val($('#temp_month_price').val());
                    [min, max] = $('#temp_month_price').val().split(',').map(Number);
                    if (min == 0 && max == 1000) {} else {
                        text = text + ' 월 ' + (min > 0 ? min + '만' : '') + ' ~ ' + (max < 1000 ? max + '만' : '');
                    }
                } else {
                    $('#month_price').val('');
                }
            } else if (Name == 'area') {
                var arayTypeText = $.trim($('.areaChage .active').text());
                if (arayTypeText == '평') {
                    $('#area').val($('#temp_area').val());
                    [min, max] = $('#temp_area').val().split(',').map(Number);
                    if (min == 0 && max == 1000) {
                        text = "전체";
                    } else {
                        text = (min > 0 ? min + '평' : '') + ' ~ ' + (max < 1000 ? max + '평' : '');
                    }
                    initializeSliders('#rangeSquare');
                } else {
                    $('#square').val($('#temp_square').val());
                    [min, max] = $('#temp_square').val().split(',').map(Number);
                    if (min == 0 && max == 3205) {
                        text = "전체";
                    } else {
                        text = (min > 0 ? min + '㎡' : '') + ' ~ ' + (max < 3205 ? max + '㎡' : '');
                    }
                    initializeSliders('#rangeArea');
                }
            } else {
                unit = '';
                $('#' + Name).val($('#temp_' + Name).val());
                [min, max] = $('#temp_' + Name).val().split(',').map(Number);
                switch (Name) {
                    case 'service_price':
                        if (min == 0 && max == 50) {
                            text = "전체";
                        } else {
                            text = (min > 0 ? min + '만' : '') + ' ~ ' + (max < 50 ? max + '만' : '');
                        }
                        break;
                    case 'approve_date':
                        if (min == 0 && max == 10) {
                            text = "전체";
                        } else {
                            text = (min > 0 ? min + '년' : '') + ' ~ ' + (max < 10 ? max + '년' : '');
                        }
                        break;
                    case 'premium_price':
                        if (min == 0 && max == 10000) {
                            text = "전체";
                        } else {
                            text = (min > 0 ? min + '천' : '') + ' ~ ' + (max < 10000 ? max + '천' : '');
                        }
                        break;
                    default:
                        text = '';
                        break;
                }
            }
        } else {
            if (Name == 'useDate') {
                text = value == '0' ? "준공연차" : text;
            }
            if (Name == 'etc') {
                value = $('input[name="floor_height_type"]:checked').val();
                $('#floor_height_type').val(value);
                etcText1 = '층고' + $('input[name="floor_height_type"]:checked').next('label').text();
                value = $('input[name="wattage_type"]:checked').val();
                $('#wattage_type').val(value);
                etcText2 = '사용전력' + $('input[name="wattage_type"]:checked').next('label').text();

                text = etcText1 + '/' + etcText2
            } else {
                $('#' + Name).val(value);
            }
        }

        if (text == '') {
            return;
        }

        $('#filter_text_' + Name).text(text);

        mapReset();
    }

    function mapTypeViewChage() {
        mapTypeChage($('#mapType').val() == 0 ? 1 : 0)
    }

    function mapTypeChage(type) {
        $('.map_side_0').removeClass('active');
        $('.map_side_1').addClass('active');

        var text = type == 0 ? '실거래가지도' : '매물지도';
        $('#mapTypeText').text(text);
        $('.centerDongMapText').text(type == 0 ? '매물현황' : '실거래가');

        $('#mapType').val(type);

        $('#filterType' + (type == 0 ? 1 : 0)).hide();
        $('#filterType' + type).show();

        mapReset();
    }

    // 좋아요 토글버튼
    function btn_wish(element, id) {

        var login_check =
            @if (Auth::guard('web')->check())
                false
            @else
                true
            @endif ;

        if (login_check) {
            dialog('로그인이 필요합니다.\n로그인 하시겠어요?', '로그인', '아니요', login);
            return;
        } else {
            var formData = {
                'target_id': id,
                'target_type': 'product',
            };

            if ($(element).hasClass("on")) {
                $(element).removeClass("on");
            } else {
                $(element).addClass("on");
            }

            $.ajax({
                type: "post", //전송타입
                url: "{{ route('www.commons.like') }}",
                data: formData,
                success: function(data, status, xhr) {},
                error: function(xhr, status, e) {}
            });
        }
    }

    // 전체 초기화 버튼 클릭 시 처리
    $('#resetAllFilters').on('click', function() {
        // 거래유형 체크박스 초기화
        $('input[name="payment_type_txt"]').prop('checked', false);
        $('#payment_type').val('');
        $('#price').val('');
        $('#month_price').val('');
        resetPaymentType(); // 이 함수가 거래 유형에 따른 슬라이더 초기화를 처리해야 함

        // 슬라이더 값 초기화 (슬라이더 다시 생성 없이)
        $('#rangePrice')[0].noUiSlider.set([0, 100]); // 예시: 최소 0, 최대 100으로 설정
        $('#rangeMonthPrice')[0].noUiSlider.set([0, 1000]); // 예시: 최소 0, 최대 1000으로 설정

        // 면적 초기화
        $('#square').val('');
        $('#area').val('');

        // 슬라이더 값 초기화
        $('#rangeSquare')[0].noUiSlider.set([0, 3205]); // 예시: 최소 0, 최대 3205로 설정
        $('#rangeArea')[0].noUiSlider.set([0, 1000]); // 예시: 최소 0, 최대 1000으로 설정

        // 기타 옵션 초기화
        $('input[name="floor_height_type"][type="radio"]').first().prop('checked', true);
        $('input[name="wattage_type"][type="radio"]').first().prop('checked', true);
        $('#floor_height_type').val($('input[name="floor_height_type"][type="radio"]').first().val());
        $('#wattage_type').val($('input[name="wattage_type"][type="radio"]').first().val());

        // 관리비 초기화
        $('#service_price').val('');
        $('#rangeServicePrice')[0].noUiSlider.set([0, 50]); // 예시: 최소 0, 최대 50으로 설정

        // 사용승인연도 초기화
        $('#approve_date').val('');
        $('#rangeApproveDate')[0].noUiSlider.set([0, 10]); // 예시: 최소 0, 최대 10으로 설정

        // 권리금 초기화
        $('#premium_price').val('');
        $('#rangePremiumPrice')[0].noUiSlider.set([0, 10000]); // 예시: 최소 0, 최대 10000으로 설정

        // 융자금 초기화
        $('input[name="loan_type"]').prop('checked', false);
        $('#loan_type').val('');

        // 업종 초기화
        $('input[name="business_type"]').prop('checked', false);
        $('#business_type').val('');
        $('#businessTypeAll').prop('checked', false);

        // 모든 필터 텍스트 초기화
        $('.filter_btn_trigger').each(function() {
            var filterName = $(this).attr('id').replace('filter_text_', '');
            var text = $('#' + filterName + '_title').text();
            $('#filter_text_' + filterName).text(text);
            $('#' + filterName).val('');
        });

        // 맵 초기화
        mapReset();
    });

    // 카카오톡 공유하기 버튼
    $(document).on('click', '.kakaotalk-sharing-btn', function(event) {
        event.preventDefault(); // 기본 클릭 동작 방지

        // 버튼 요소의 데이터 속성을 읽어옵니다.
        var $button = $(this);
        var title = $button.data('title');
        var description = $button.data('description');
        var imageUrl = $button.data('image-url');
        var m_link = $button.data('m_link');
        var pc_link = $button.data('pc_link');

        // Kakao 공유 기능을 동적으로 호출
        Kakao.Share.createDefaultButton({
            objectType: "feed",
            content: {
                title: title,
                description: description,
                imageUrl: imageUrl,
                link: {
                    mobileWebUrl: m_link,
                    webUrl: pc_link
                }
            }
        });
    });

    // 주소 복사
    var textCopy = (url) => {
        window.navigator.clipboard.writeText(url).then(() => {
            alert("링크가 복사 되었습니다.");
        });
    };
</script>
