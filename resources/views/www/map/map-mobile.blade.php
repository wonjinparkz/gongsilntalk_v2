<x-layout>


    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"></div>
        <div class="m_title">
            <div class="txt_bold" onclick="modal_open_slide('menu_map')">실거래가지도 <img
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
            <li><a href="#" onclick="location.href='m_map.html'">실거래가지도</a></li>
            <li><a href="#" onclick="location.href='m_map_property.html'">매물지도</a></li>
        </ul>
    </div>
    <div class="md_slide_overlay md_slide_overlay_menu_map" onclick="modal_close_slide('menu_map')"></div>
    <!----------------------------- m::header bar : s ----------------------------->

    <!-- top area : s  -->
    <div class="map_m_top_wrap only_m">
        <div class="m_inner_wrap">
            <div class="community_search_wrap flex_between">
                <input type="text" id="search_input" placeholder="검색어를 입력해주세요.">
                <img src="{{ asset('assets/media/btn_solid_delete.png') }}" alt="del" class="btn_del">
                <button onclick="location.href='community_search_list.html'"><img
                        src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
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
                <input type="radio" name="year" id="year_1" value="Y">
                <label for="year_1">지식산업센터</label>

                <input type="radio" name="year" id="year_2" value="Y">
                <label for="year_2">상가</label>

                <input type="radio" name="year" id="year_3" value="Y">
                <label for="year_3">건물</label>

                <input type="radio" name="year" id="year_4" value="Y">
                <label for="year_4">아파트</label>
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
        <div class="map_wrap">
            <div class="map_side_btn">
                <div>
                    <button><img src="{{ asset('assets/media/ic_map_activate1.png') }}"></button>
                </div>
                <div class="btn_view_type">
                    <button>지적도</button>
                    <button>위성뷰</button>
                </div>
                <button><img src="{{ asset('assets/media/ic_map_activate4.png') }}"></button>
            </div>
            <button class="map_view_btn">익선동 <span class="txt_point">실거래가</span> 보기</button>
            <div class="map_bottom_btn">
                <button onclick="location.href='estate_reg_1.html'"><img
                        src="{{ asset('assets/media/ic_org_estate.png') }}">매물
                    내놓기</button>
                <button onclick="location.href='offer_step_1.html'"><img
                        src="{{ asset('assets/media/btn_point_search.png') }}">매물
                    구하기</button>
            </div>
            <script type="text/javascript" src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId=7etdlg7znh"></script>
            <div id="map" style="width:100%; height:calc(100vh - 60px);"></div>
        </div>
    </div>
    <!-- nav : s -->
    <nav>
        <ul>
            <li>
                <a href="main.html"><span><img src="{{ asset('assets/media/mcnu_ic_1.png') }}"
                            alt=""></span>홈</a>
            </li>
            <li>
                <a href="sales_list.html"><span><img src="{{ asset('assets/media/mcnu_ic_2.png') }}"
                            alt=""></span>분양현장</a>
            </li>
            <li class="active">
                <a href="m_map.html"><span><img src="{{ asset('assets/media/mcnu_ic_3.png') }}"
                            alt=""></span>지도</a>
            </li>
            <li>
                <a href="community_contents_list.html"><span><img src="{{ asset('assets/media/mcnu_ic_5.png') }}"
                            alt=""></span>커뮤니티</a>
            </li>
            <li>
                <a href="my_main.html"><span><img src="{{ asset('assets/media/mcnu_ic_4.png') }}"
                            alt=""></span>마이페이지</a>
            </li>
        </ul>
    </nav>
    <!-- nav : e -->


</x-layout>

<script>
    //지도
    var cityhall = new naver.maps.LatLng(37.5666805, 126.9784147),
        map = new naver.maps.Map('map', {
            center: cityhall.destinationPoint(0, 500),
            zoom: 15
        }),
        marker = new naver.maps.Marker({
            map: map,
            position: cityhall
        });
    var contentString = [
        '<div class="iw_inner">',
        '   <a href="m_map_detail.html">',
        '   <h3>서울특별시청</h3>',
        '     <div class="inner_info">',
        '       <p>매매 <span>1,234~1,234</span></p>',
        '       <p>임대 <span>1.2~3.4</span></p>',
        '     </div>',
        '   </a>',
        '</div>'
    ].join('');

    var infowindow = new naver.maps.InfoWindow({
        content: contentString,
        borderColor: "#",
        backgroundColor: "#",
        anchorColor: "#",
        pixelOffset: new naver.maps.Point(60, 50)
    });

    infowindow.open(map, marker);

    //페이지 탭
    var detail_tab = new Swiper(".detail_tab", {
        slidesPerView: 'auto',
        freeMode: true,
        breakpointsInverse: true,
        breakpoints: {
            1023: {
                allowTouchMove: false
            }
        }
    });

    //슬라이드 탭
    function showContent(index) {
        var tabContents = document.querySelectorAll('.side_tab_wrap .sction_item');
        tabContents.forEach(function(content) {
            content.classList.remove('active');
        });
        tabContents[index].classList.add('active');
    }

    // slider range
    var slider = document.querySelector("#rangeItem_1");
    var valueMin = document.querySelector("#item_1_min");
    var valueMax = document.querySelector("#item_1_max");
    var item1txt = document.querySelector("#item_1_txt");

    noUiSlider.create(slider, {
        start: [0, 100],
        connect: true,
        range: {
            "min": 0,
            "max": 100
        }
    });

    slider.noUiSlider.on("update", function(values, handle) {
        if (values[0] < 0 || values[1] > 99) {
            item1txt.innerHTML = "전체";
        } else {
            valueMin.innerHTML = values[0];
            valueMax.innerHTML = values[1];
            item1txt.innerHTML = "<span id='kt_slider_basic_min'>" + values[0] +
                "원</span> ~ <span id='kt_slider_basic_max'>" + values[1] + "원</span>";
        }
    });
</script>
