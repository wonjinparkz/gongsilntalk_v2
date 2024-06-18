<x-layout>

    <!-- m::header bar : s -->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">공실앤톡공인중개사사무소</div>
        <div class="right_area"><img src="{{ asset('assets/media/header_btn_share_deep.png') }}"
                onclick="modal_open_slide('share')"></div>
    </div>
    <div class="modal_slide modal_slide_share">
        <div class="slide_title_wrap">
            <span>공유하기</span>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('share')">
        </div>
        <div class="slide_modal_body">
            <div class="layer_share_con">
                <a href="#">
                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                    <p class="mt8">카카오톡</p>
                </a>
                <a href="#">
                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
                    <p class="mt8">링크복사</p>
                </a>
            </div>
        </div>
    </div>
    <div class="md_slide_overlay md_slide_overlay_share" onclick="modal_close_slide('share')"></div>
    <!-- m::header bar : s -->


    <div class="body">
        <div class="agent_head">
            <div class="agent_img">
                <div class="img_box"><img src="{{ asset('assets/media/default_img.png') }}"></div>
            </div>
            <div class="agent_detail_info">
                <h3>공실앤톡부동산중개법인</h3>
                <div class="info_row"><span>대표</span>정수동</div>
                <div class="info_row"><span>주소</span>경기도 화성시 동탄기흥로 557 , 103호(영천동) </div>
                <div class="info_row"><span>대표번호</span>031-1600-09624</div>
                <div class="info_row"><span>휴대전화</span>010-5184-7214</div>
            </div>
        </div>


        <div class="inner_wrap bottom_space">
            <!-- PC::filter : s -->
            <div class="mt28 only_pc">
                <div class="dropdown_box w_10">
                    <button class="dropdown_label">거래유형 </button>
                    <ul class="optionList">
                        <li class="optionItem">전체</li>
                        <li class="optionItem">매매</li>
                        <li class="optionItem">임대</li>
                        <li class="optionItem">단기임대</li>
                        <li class="optionItem">전매</li>
                    </ul>
                </div>
            </div>
            <!-- PC::filter : e -->

            <!-- M::filter : s -->
            <div class="m_sales_filter_wrap agent_filter_wrap">
                <div class="m_dropdown_double_wrap">
                    <button class="btn_dropdown" onclick="modal_open_slide('transaction_type')">거래유형</button>
                </div>
            </div>
            <div class="modal_slide modal_slide_transaction_type">
                <div class="slide_title_wrap">
                    <span>거래유형 선택</span>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}"
                        onclick="modal_close_slide('transaction_type')">
                </div>
                <ul class="slide_modal_menu">
                    <li><a href="#">전체</a></li>
                    <li><a href="#">매매</a></li>
                    <li><a href="#">임대</a></li>
                    <li><a href="#">단기임대</a></li>
                    <li><a href="#">전매</a></li>
                </ul>
            </div>
            <div class="md_slide_overlay md_slide_overlay_transaction_type"
                onclick="modal_close_slide('transaction_type')"></div>
            <!-- M::filter : e -->

            <div class="flex_between agent_sort_wrap">
                <div class="txt_search_total">분양목록 총 <span class="txt_point">44건</span></div>
                <ul class="list_sort2 normal_type toggle_tab">
                    <li class="active"><a href="#">최신순</a></li>
                    <li><a href="#">높은가격순</a></li>
                    <li><a href="#">면적순</a></li>
                </ul>
            </div>


            <div class="sales_list_wrap">
                <!-- card : s -->
                <div class="sales_card">
                    <span class="sales_list_wish" onclick="btn_wish(this)"></span>
                    <a href="room_detail.html">
                        <div class="sales_card_img">
                            <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                        </div>
                        <div class="sales_list_con">
                            <p class="txt_item_1">매매 13억 2000만원</p>
                            <p class="txt_item_4">서울시 강서구 강동동</p>
                            <p class="txt_item_2">62.11㎡ / 46.2㎡·3층</p>
                            <p class="txt_item_3">한 줄 소개로 안내 드립니다. 영등포시장역 도보 1분 초역세권 매물</p>
                        </div>
                    </a>
                </div>
                <!-- card : e -->
            </div>


            <!-- paging : s -->
            <div class="paging only_pc">
                <ul class="btn_wrap">
                    <li class="btn_prev">
                        <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_prev.png') }}"
                                alt=""></a>
                    </li>
                    <li class="active">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li class="btn_next">
                        <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_next.png') }}"
                                alt=""></a>
                    </li>
                </ul>
            </div>
            <!-- paging : e -->
        </div>
    </div>


    <script>
        // 관심매물 토글버튼
        function btn_wish(element) {
            if ($(element).hasClass("on")) {
                $(element).removeClass("on");
            } else {
                $(element).addClass("on");
            }
        }
    </script>
</x-layout>
