<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"></div>
        <div class="m_title">
            <div class="txt_bold" id="mapTypeText" onclick="modal_open_slide('menu_map')">실거래가지도 <img
                    src="{{ asset('assets/media/ic_arrow_more.png') }}" class="tit_dropdown_arrow"></div>
        </div>
        <div class="right_area"></div>
    </div>
    <div class="modal_slide modal_slide_menu_map">
        <div class="slide_title_wrap">
            <span>지도 선택</span>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('menu_map')">
        </div>
        <ul class="slide_modal_menu">
            <li><a href="javascript:;" onclick="mapTypeChage(0)">실거래가지도</a></li>
            <li><a href="javascript:;" onclick="mapTypeChage(1)">매물지도</a></li>
        </ul>
        <input type="hidden" id="mapType" value="0">
    </div>
    <div class="md_slide_overlay md_slide_overlay_menu_map" onclick="modal_close_slide('menu_map')"></div>
    <!----------------------------- m::header bar : s ----------------------------->

    <!-- top area : s  -->
    <div class="map_m_top_wrap only_m">
        <div class="m_inner_wrap">
            <div class="community_search_wrap flex_between">
                <input type="text" id="search_input" name="search_input" placeholder="단지명, 동이름, 지하철역으로 검색"
                    value="{{ $_GET['search_input'] ?? '' }}" onkeyup="if(window.event.keyCode==13){search_request();}">
                <img src="{{ asset('assets/media/btn_solid_delete.png') }}" alt="del" class="btn_del">
                <button onclick="search_request()"><img src="{{ asset('assets/media/btn_search.png') }}"
                        alt="검색"></button>
            </div>
        </div>

        <!-- tab : s -->
        <div class="inner_wrap">
            <div class="swiper detail_tab m_swiper_filter">
                <div class="swiper-wrapper menu">
                    <div class="swiper-slide active"><button class="filter_btn_trigger"
                            onclick="modal_open_slide('filter_1')">매물 종류</button></div>
                    <div class="swiper-slide"><button class="filter_btn_trigger"
                            onclick="modal_open_slide('filter_2')">거래유형/가격</button></div>
                </div>
            </div>
        </div>
        <!-- tab : e -->
    </div>
    <!-- top area : e  -->

    <!-- 지식산업센터 modal : s -->
    <div class="modal_slide modal_slide_filter_1">
        <div class="slide_title_wrap">
            <span>매물 종류</span>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('filter_1')">
        </div>
        <div class="slide_modal_body">
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
    <div class="md_slide_overlay md_slide_overlay_filter_1" onclick="modal_close_slide('filter_1')"></div>
    <!-- 지식산업센터 modal : e -->


    <!-- 융자금 modal : s -->
    <div class="modal_slide modal_slide_filter_2">
        <div class="slide_title_wrap">
            <span>융자금</span>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('filter_2')">
        </div>
        <div class="slide_modal_body">
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
    <div class="md_slide_overlay md_slide_overlay_filter_2" onclick="modal_close_slide('filter_2')"></div>
    <!-- 융자금 modal : e -->

    <div class="body">
        <div class="map_side_btn">
            <div>
                <button id="current"><img src="{{ asset('assets/media/ic_map_activate1.png') }}"></button>
            </div>
            <div class="btn_view_type">
                <button id="cadastral">지적도</button>
                <button onclick="toggleSatelliteView()">위성뷰</button>
            </div>
            <button id="streetView"><img src="{{ asset('assets/media/ic_map_activate4.png') }}"></button>
        </div>
        <button type="button" class="map_view_btn map_view_btn_2" onclick="mapTypeViewChage()">
            <span id="centerDongText">익선동</span>
            <span class="txt_point centerDongMapText">실거래가</span> 보기
        </button>
        <div class="map_bottom_area map_bottom_area_2">
            <div class="map_bottom_btn">
                <button onclick="location.href='{{ route('www.product.create.view') }}'"><img
                        src="{{ asset('assets/media/ic_org_estate.png') }}">매물 내놓기</button>
                <button onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'"><img
                    src="{{ asset('assets/media/btn_point_search.png') }}">매물 구하기</button>
            </div>
        </div>

        {{--  네이버 지도 --}}
        <div id="map" style="width:100%; height:calc(100vh - 60px);"></div>

        <div id="panoArea">
            <div id="pano" style="width:100%; height:100%;"></div>
        </div>
    </div>

    <div class="map_bottom_tab">
            <button onclick="modal_open('m_property_list')">지도 내 매물 15</button>
            <button onclick="modal_open('m_agent_list')">중개사무소 62</button>
        </div>

    <!-- <ul class="side_list_tab tab_toggle_menu" id="bottom_property" style="display: none">
        <li class="property active"><a href="javascript:(0)" onclick="modal_open('m_property_list')">지도 내 매물 <span
                    id="property_count">0</span>
            </a>
        </li>
        <li class="property active"><a href="{{ route('www.map.property.list') }}">지도 내 매물 <span
                    id="property_count">0</span>
            </a>
        </li>
        <li class="agent"><a href="javascript:(0)" onclick="modal_open('m_agent_list')">중개사무소 <span id="agent_count">0</span>
            </a>
        </li>
        <li class="agent"><a href="{{ route('www.map.property.list') }}">중개사무소 <span id="agent_count">0</span>
            </a>
        </li>
    </ul> -->

    <div class="side_list_scroll" id="property_list" style="display:none;">
    </div>
    <div class="side_list_scroll" id="agent_list" style="display:none;">
    </div>

    <x-nav-layout />
</x-layout>

<!-- 지도 내 매물 : s -->
<div class="modal modal_full modal_m_property_list">
    <div class="modal_title">
        <h5>지도 내 매물 16</h5>
    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close" onclick="modal_close('m_property_list')">
    </div>
    <div class="modal_container_full">
        <ul class="list_sort2 toggle_tab">
            <li class="active"><a href="#">최신순</a></li>
            <li class="inner_toggle">
            <a href="#">
                <span class="sort_direction active">가격순</span>
                <button class="inner_button sort_price"><span class="price_txt">낮은가격순</span> <img src="{{ asset('assets/media/sort_arrow.png') }}" class="sort_arrow"></button>
            </a>
            </li>
            <li class="inner_toggle">
            <a href="#">
                <span class="sort_direction active">면적순</span>
                <button class="inner_button sort_area"><span class="price_txt">넓은면적순</span> <img src="{{ asset('assets/media/sort_arrow.png') }}" class="sort_arrow"></button>
            </a>
            </li>
        </ul>
        <div class="side_list_scroll">
            여기에 리스트를 넣으면 됨<div style="height:2000px;">개발시 삭제 할 것</div>
        </div>
    </div>
</div>
<!-- 지도 내 매물 : e -->

<!-- 중개사무소 list : s -->
<div class="modal modal_full modal_m_agent_list">
    <div class="modal_title">
        <h5>중개사무소 10</h5>
    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close" onclick="modal_close('m_agent_list')">
    </div>
    <div class="modal_container_full">
        <ul class="list_sort2 toggle_tab">
            <li class="active"><a href="#">가까운 거리순</a></li>
            <li><a href="#">이름순</a></li>
            
        </ul>
        <div class="side_list_scroll">
            여기에 리스트를 넣으면 됨<div style="height:2000px;">개발시 삭제 할 것</div>
        </div>
    </div>
</div> 
<!-- 중개사무소 list : e -->

<script>
//정렬
document.addEventListener("DOMContentLoaded", function() {
    const priceButton = document.querySelector(".sort_price");
    const priceTextSpan = priceButton.querySelector(".price_txt");
    const priceArrowImg = priceButton.querySelector(".sort_arrow");
    
    priceButton.addEventListener("click", function() {
        if (priceTextSpan.textContent === "낮은가격순") {
            priceTextSpan.textContent = "높은가격순";
            priceArrowImg.style.transform = "rotate(180deg)";
        } else {
            priceTextSpan.textContent = "낮은가격순";
            priceArrowImg.style.transform = "rotate(0deg)";
        }
    });

    const areaButton = document.querySelector(".sort_area");
    const areaTextSpan = areaButton.querySelector(".price_txt");
    const areaArrowImg = areaButton.querySelector(".sort_arrow");

    areaButton.addEventListener("click", function() {
        if (areaTextSpan.textContent === "넓은면적순") {
            areaTextSpan.textContent = "좁은면적순";
            areaArrowImg.style.transform = "rotate(180deg)";
        } else {
            areaTextSpan.textContent = "넓은면적순";
            areaArrowImg.style.transform = "rotate(0deg)";
        }
    });
});

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.7.5/proj4.js"></script>
<script type="text/javascript"
    src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
</script>
<script src="{{ asset('assets/js/MarkerClustering.js') }}"></script>
<script>
    var polygonMap = null;
    var map;
    var pano;
    var markers = []; // 마커 배열을 전역 변수로 선언
    var productMarkers = []; // product 마커 배열 초기화
    var agentMarkers = []; // product 마커 배열 초기화
    var bounds; // bounds 전역 변수로 선언
    var lastActiveMarkerElement = null; // 마지막으로 활성화된 마커 요소를 저장
    var productClustering;
    var agentClustering;
    var MarkerIdArray = []; // 클러스터링 매물,중개사 ids 임시 저장소
    var productIdArray = []; // 매물 ids 저장소
    var agentIdArray = []; // 중개사 ids 저장소

    // 검색 추가
    function search_request() {
        var search_input = $("#search_input").val();
        if (search_input == "") {
            return;
        }
        location.href = "{{ route('www.map.mobile') }}" + "?search_input=" + search_input;
    }

    // 실거래가지도, 매물지도 타입
    function mapTypeChage(type) {
        // $('.map_side_0').removeClass('active');
        // $('.map_side_1').addClass('active');

        var text = type == 0 ? '실거래가지도' : '매물지도';
        var bottom_property = document.getElementById('bottom_property');
        const mapElement = document.getElementById('map');
        // $('#mapTypeText').text(text);
        var mapType = document.getElementById('mapTypeText');
        mapType.childNodes[0].nodeValue = text;
        $('.centerDongMapText').text(type == 0 ? '매물현황' : '실거래가');
        if (type == 0) {
            bottom_property.style.display = "none";
            mapElement.style.height = 'calc(100vh - 60px)';
        } else {
            bottom_property.style.display = "";
            mapElement.style.height = 'calc(100vh - 105px)';
        }

        $('#mapType').val(type);
        modal_close_slide('menu_map')
        mapReset();
    }


    // 실거래가지도, 매물지도 타입
    function mapTypeViewChage() {
        mapTypeChage($('#mapType').val() == 0 ? 1 : 0)
    }

    // 맵 리셋
    function mapReset() {
        var mapType = $('#mapType').val();
        if (polygonMap) {
            polygonMap.setMap(null);
        }
        var center = map.getCenter();
        var zoom = map.getZoom();
        markerUpdate(center.lat(), center.lng(), zoom);
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
            console.log('agentMarker : ', agentMarker.id);
            markerId = agentMarker.id;
            agentIdArray = [markerId];
            $('li.agent').click();
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
        };

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
            console.log('productIdArray'.productIdArray);
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

    // 페이징
    function loadMoreData() {
        $.ajax({
                url: "{{ route('www.map.property.list') }}",
                data: {
                    page: null,
                    orderby: $('#orderby').val(),
                    productIds: productIdArray,
                    agentIds: agentIdArray,
                },
                type: "get",
                beforeSend: function() {
                    // $('.ajax-load').show();
                }
            })
            .done(function(data) {
                $("#property_list").html(data.property);
                $("#agent_list").html(data.agent);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {});
    }
</script>
