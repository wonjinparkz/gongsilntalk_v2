<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="images/header_btn_back.png"></a></div>
        <div class="m_title"></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body map_side">
        <div class="side_list_wrap">
            <ul class="side_list_tab tab_toggle_menu">
                <li class="active">지도 내 매물 15</li>
                <li>중개사무소 17</li>
            </ul>
            <div class="tab_area_wrap side_list_body">
                <div>
                    <ul class="list_sort2 toggle_tab">
                        <li class="active"><a href="#">최신순</a></li>
                        <li class="inner_toggle">
                            <a href="#">
                                <span class="sort_direction active">가격순</span>
                                <button class="inner_button sort_price"><span class="price_txt">낮은가격순</span> <img
                                        src="images/sort_arrow.png" class="sort_arrow"></button>
                            </a>
                        </li>
                        <li class="inner_toggle">
                            <a href="#">
                                <span class="sort_direction active">면적순</span>
                                <button class="inner_button sort_area"><span class="price_txt">넓은면적순</span> <img
                                        src="images/sort_arrow.png" class="sort_arrow"></button>
                            </a>
                        </li>
                    </ul>
                    <!-- <div class="empty_wrap">
                  <p><img src="images/img_empty_1.png" class="empty_img"></p>
                  <span>조건에 맞는 매물이 없습니다.<br>지도를 이동하거나, 검색 필터를 조정해보세요.</span>
                </div> -->
                    <div class="side_list_scroll">
                        <!-- list : s -->
                        <div class="property_sm_list">
                            <div class="frame_img_mid">
                                <span class="btn_wish_sm" onclick="btn_wish(this)"></span>
                                <div class="img_box"><img src="images/s_3.png"></div>
                            </div>
                            <a href="room_detail.html">
                                <div class="property_sm_info">
                                    <p class="property_sm_item_1">매매 2억 9,900만</p>
                                    <p class="txt_lh_1">사무실 강남구 논현동</p>
                                    <p class="txt_lh_1">62.11㎡ / 46.2㎡·3층</p>
                                    <p class="property_sm_item_2">영등포시장역 도보 1분 초역세권 매물 소개를 합니다.</p>
                                </div>
                            </a>
                        </div>
                        <!-- list : e -->
                        <div style="height:1000px; color:#fff">개발시 삭제 스크롤 때문에 넣어봄.</div>
                    </div>
                </div>
                <div>
                    <!-- <div class="empty_wrap">
                  <p><img src="images/img_empty_1.png" class="empty_img"></p>
                  <span>조건에 맞는  중개사무소가 없습니다.<br>지도를 이동하거나, 검색 필터를 조정해보세요.</span>
                </div> -->
                    <ul class="list_sort2 toggle_tab">
                        <li class="active"><a href="#">가까운 거리순</a></li>
                        <li class=""><a href="#">이름순</a></li>
                    </ul>
                    <div class="side_list_scroll">
                        <!-- list : s -->
                        <a href="agent_detail.html">
                            <div class="agent_sm_list">
                                <div class="agent_sm_info">
                                    <p class="agent_txt_item_1">주식회사더블유파트너즈부동산중개</p>
                                    <p class="agent_txt_item_2">서울특별시 중구 세종대로 136 3층 S3002호</p>
                                </div>
                                <div class="frame_img_sm">
                                    <div class="img_box"><img src="images/default_img.png"></div>
                                </div>
                            </div>
                        </a>
                        <!-- list : e -->

                        <div style="height:1000px; color:#fff">개발시 삭제</div>
                    </div>
                </div>
            </div>
        </div>

    </div>



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
</x-layout>
