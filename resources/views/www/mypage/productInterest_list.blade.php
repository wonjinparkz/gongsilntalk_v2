<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">관심 매물</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap">
                    <h1 class="t_center only_pc">관심 매물</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5 toggle_tab">
                            <li onclick="location.href='my_wish_list.html'" class="active">관심 매물</li>
                            <li onclick="location.href='my_recently.html'">최근 본 매물</li>
                        </ul>
                    </div>

                    <div class="wish_wrap">
                        <ul class="tab_type_6 tab_toggle_menu mt28">
                            <li class="active">일반매물</li>
                            <li class="">분양매물</li>
                        </ul>

                        <div class="tab_area_wrap">
                            <!-- 일반매물 : s -->
                            <div>
                                <div class="my_search_wrap mt20">
                                    <div class="sort_wrap">
                                        <div class="dropdown_box">
                                            <button class="dropdown_label">거래 유형</button>
                                            <ul class="optionList">
                                                <li class="optionItem">전체</li>
                                                <li class="optionItem">매매</li>
                                                <li class="optionItem">임대</li>
                                                <li class="optionItem">단기임대</li>
                                                <li class="optionItem">전세</li>
                                                <li class="optionItem">월세</li>
                                                <li class="optionItem">전매</li>
                                            </ul>
                                        </div>
                                        <div class="dropdown_box">
                                            <button class="dropdown_label">매물 종류</button>
                                            <ul class="optionList">
                                                <li class="optionItem">전체</li>
                                                <li class="optionItem">지식산업센터</li>
                                                <li class="optionItem">사무실</li>
                                                <li class="optionItem">창고</li>
                                                <li class="optionItem">상가</li>
                                                <li class="optionItem">기숙사</li>
                                                <li class="optionItem">건물</li>
                                                <li class="optionItem">토지/임야</li>
                                                <li class="optionItem">단독공장</li>
                                                <li class="optionItem">아파트</li>
                                                <li class="optionItem">오피스텔</li>
                                                <li class="optionItem">단독/다가구</li>
                                                <li class="optionItem">다세대/빌라/연립</li>
                                                <li class="optionItem">상가주택</li>
                                                <li class="optionItem">주택</li>
                                                <li class="optionItem">지식산업센터 분양권</li>
                                                <li class="optionItem">상가 분양권</li>
                                                <li class="optionItem">아파트 분양권</li>
                                                <li class="optionItem">오피스텔 분양권</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="txt_search_total">총 <span class="txt_point">0개</span>의 관심 매물</div>
                                <!-- 데이터가 없을 경우 : s -->
                                <!-- <div class="empty_wrap">
                            <p>관심 등록된 매물이 없습니다.</p>
                            <span>매물지도에서 마음에 드는 매물을 찾아<br>관심 매물로 등록해보세요.</span>
                            <div class="mt8"><button class="btn_point btn_md_bold" onclick="location.href='sales_list.html'">매물 찾아보기</button></div>
                          </div> -->
                                <!-- 데이터가 없을 경우 : e -->

                                <div class="sales_list_wrap">

                                    <div class="sales_card">
                                        <span class="sales_list_wish" onclick="btn_wish(this)"></span>
                                        <a href="sales_detail.html">
                                            <div class="sales_card_img">
                                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}">
                                                </div>
                                            </div>
                                            <div class="sales_list_con">
                                                <p class="txt_item_1">매매 13억 2000만원</p>
                                                <p class="txt_item_4">서울시 강서구 강동동</p>
                                                <p class="txt_item_2">62.11㎡ / 46.2㎡·3층</p>
                                                <p class="txt_item_3">한 줄 소개로 안내 드립니다. 영등포시장역 도보 1분 초역세권 매물</p>
                                            </div>
                                        </a>
                                    </div>

                                </div>

                                <!-- paging : s -->
                                <div class="paging only_pc">
                                    <ul class="btn_wrap">
                                        <li class="btn_prev">
                                            <a class="no_next" href="#1"><img
                                                    src="{{ asset('assets/media/btn_prev.png') }}" alt=""></a>
                                        </li>
                                        <li class="active">1</li>
                                        <li>2</li>
                                        <li>3</li>
                                        <li>4</li>
                                        <li>5</li>
                                        <li class="btn_next">
                                            <a class="no_next" href="#1"><img
                                                    src="{{ asset('assets/media/btn_next.png') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- paging : e -->
                            </div>
                            <!-- 일반매물 : e -->


                            <!--  분양매물 : s -->
                            <div>
                                <div class="txt_search_total">총 <span class="txt_point">0개</span>의 관심 매물</div>
                                <!-- 데이터가 없을 경우 : s -->
                                <div class="empty_wrap">
                                    <p>관심 등록된 매물이 없습니다.</p>
                                    <span>매물지도에서 마음에 드는 매물을 찾아<br>관심 매물로 등록해보세요.</span>
                                    <div class="mt8"><button class="btn_point btn_md_bold"
                                            onclick="location.href='sales_list.html'">매물 찾아보기</button></div>
                                </div>
                                <!-- 데이터가 없을 경우 : e -->

                                <div class="sales_list_wrap">
                                    <div class="sales_card">
                                        <span class="sales_list_wish" onclick="btn_wish(this)"></span>
                                        <a href="sales_detail.html">
                                            <div class="sales_card_img">
                                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}">
                                                </div>
                                            </div>
                                            <div class="sales_list_con">
                                                <span class="mark_proceeding">분양중</span>
                                                <p class="txt_item_1">지식산업센터 놀라움 마곡</p>
                                                <p class="txt_item_2">서울시 강서구 강동동</p>
                                                <p class="txt_item_3">한 줄 소개로 안내 드립니다. 여기는 아름다운 도시 마곡입니다.</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="sales_card">
                                        <span class="sales_list_wish" onclick="btn_wish(this)"></span>
                                        <a href="sales_detail.html">
                                            <div class="sales_card_img">
                                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}">
                                                </div>
                                            </div>
                                            <div class="sales_list_con">
                                                <span class="mark_proceeding">분양중</span>
                                                <p class="txt_item_1">지식산업센터 놀라움 마곡</p>
                                                <p class="txt_item_2">서울시 강서구 강동동</p>
                                                <p class="txt_item_3">한 줄 소개로 안내 드립니다. 여기는 아름다운 도시 마곡입니다.</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="sales_card">
                                        <span class="sales_list_wish" onclick="btn_wish(this)"></span>
                                        <a href="sales_detail.html">
                                            <div class="sales_card_img">
                                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}">
                                                </div>
                                            </div>
                                            <div class="sales_list_con">
                                                <span class="mark_proceeding">분양중</span>
                                                <p class="txt_item_1">지식산업센터 놀라움 마곡</p>
                                                <p class="txt_item_2">서울시 강서구 강동동</p>
                                                <p class="txt_item_3">한 줄 소개로 안내 드립니다. 여기는 아름다운 도시 마곡입니다.</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="sales_card">
                                        <span class="sales_list_wish" onclick="btn_wish(this)"></span>
                                        <a href="sales_detail.html">
                                            <div class="sales_card_img">
                                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}">
                                                </div>
                                            </div>
                                            <div class="sales_list_con">
                                                <span class="mark_proceeding">분양중</span>
                                                <p class="txt_item_1">지식산업센터 놀라움 마곡</p>
                                                <p class="txt_item_2">서울시 강서구 강동동</p>
                                                <p class="txt_item_3">한 줄 소개로 안내 드립니다. 여기는 아름다운 도시 마곡입니다.</p>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="sales_card">
                                        <span class="sales_list_wish" onclick="btn_wish(this)"></span>
                                        <a href="sales_detail.html">
                                            <div class="sales_card_img">
                                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}">
                                                </div>
                                            </div>
                                            <div class="sales_list_con">
                                                <span class="mark_proceeding">분양중</span>
                                                <p class="txt_item_1">지식산업센터 놀라움 마곡</p>
                                                <p class="txt_item_2">서울시 강서구 강동동</p>
                                                <p class="txt_item_3">한 줄 소개로 안내 드립니다. 여기는 아름다운 도시 마곡입니다.</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <!-- paging : s -->
                                <div class="paging only_pc">
                                    <ul class="btn_wrap">
                                        <li class="btn_prev">
                                            <a class="no_next" href="#1"><img
                                                    src="{{ asset('assets/media/btn_prev.png') }}" alt=""></a>
                                        </li>
                                        <li class="active">1</li>
                                        <li>2</li>
                                        <li>3</li>
                                        <li>4</li>
                                        <li>5</li>
                                        <li class="btn_next">
                                            <a class="no_next" href="#1"><img
                                                    src="{{ asset('assets/media/btn_next.png') }}"
                                                    alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- paging : e -->
                            </div>
                            <!--  분양매물 : e -->

                        </div>
                    </div>


                </div>
                <!-- my_body : e -->

            </div>

        </div>

    </div>

</x-layout>
