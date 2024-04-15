<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">마이메뉴</div>
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
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">매물 제안서 목록</h1>

                    <div class="flex_between my_body_top">
                        <div class="gray_deep fs_16_v">총 8개의 제안서</div>
                        <button class="btn_point btn_sm" onclick="location.href='offer_step_1.html'">신규 매물 제안서
                            받기</button>
                    </div>
                    <p class="gray_basic fs_14_v mt18">*최대 7일까지만 보관됩니다.</p>

                    <!-- 데이터가 없을 경우 : s -->
                    <!-- <div class="empty_wrap">
                        <p>받은 매물 제안서가 없습니다.</p>
                        <span>매물 제안서를 작성하고, 원하는 조건의 매물을 찾아보세요.</span>
                      </div> -->
                    <!-- 데이터가 없을 경우 : e -->

                    <div class="proposal_list">
                        <div class="box_01">
                            <div class="proposal_row">
                                <div class="proposal_item_1 cursor_pointer"
                                    onclick="location.href='my_proposal_offer_list.html'">
                                    <h4>(주)공실앤톡 지산/사무실/창고 제안서</h4>
                                    <p class="txt_item_1">제안된 매물 <span class="txt_point">20개</span></p>
                                </div>
                                <div class="proposal_item_2">
                                    <span class="txt_date">2023.04.12</span> <button class="btn_gray_ghost btn_sm"
                                        onclick="modal_open('delete')">삭제</button>
                                </div>
                            </div>
                            <div class="proposal_m_btn only_m"><!-- m -->
                                <button class="btn_gray_ghost btn_sm_full">다운로드</button>
                                <button class="btn_gray_ghost btn_sm_full" onclick="modal_open('delete')">삭제</button>
                            </div>
                            <div class="table_container mt18 only_pc">
                                <div>희망 지역</div>
                                <div>경기도 군포시 당동 425-5</div>
                                <div>사용인원</div>
                                <div>50명</div>
                                <div>희망 면적</div>
                                <div>123.12㎡<span class="gray_basic">(100평)</span></div>
                                <div>예산</div>
                                <div>임대 3억원 / 4,000만원</div>
                                <div>입주가능일</div>
                                <div>날짜협의</div>
                                <div>인테리어 유무</div>
                                <div>필요해요</div>
                                <div>요청사항</div>
                                <div class="item_col_3">개인 사정으로 한달내로 이사 예정인데 급하게 구할 수 있을까요?</div>
                            </div>
                        </div>
                        <div class="box_01">
                            <div class="proposal_row">
                                <div class="proposal_item_1">
                                    <h4>(주)어바웃스킨 단독공장 제안서</h4>
                                    <p class="txt_item_1">제안된 매물 <span class="txt_point">21개</span></p>
                                </div>
                                <div class="proposal_item_2">
                                    <span class="txt_date">2023.04.12</span> <button
                                        class="btn_gray_ghost btn_sm">삭제</button>
                                </div>
                            </div>
                            <div class="proposal_m_btn only_m"><!-- m -->
                                <button class="btn_gray_ghost btn_sm_full">다운로드</button>
                                <button class="btn_gray_ghost btn_sm_full">삭제</button>
                            </div>
                            <div class="table_container mt18 only_pc">
                                <div>희망 지역</div>
                                <div>경기도 군포시 당동 425-5</div>
                                <div>사용인원</div>
                                <div>50명</div>
                                <div>희망 면적</div>
                                <div>123.12㎡<span class="gray_basic">(100평)</span></div>
                                <div>예산</div>
                                <div>임대 3억원 / 4,000만원</div>
                                <div>입주가능일</div>
                                <div>날짜협의</div>
                                <div>인테리어 유무</div>
                                <div>필요해요</div>
                                <div>요청사항</div>
                                <div class="item_col_3">개인 사정으로 한달내로 이사 예정인데 급하게 구할 수 있을까요?</div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- my_body : e -->
            </div>

            <!-- modal 삭제 : s -->
            <div class="modal modal_delete">

                <div class="modal_container">
                    <div class="modal_mss_wrap">
                        <p class="txt_item_1 txt_point">(주)공실앤톡 사무실 제안서</p>
                        <p class="txt_item_1">제안서를 삭제하시겠습니까?</p>
                        <p class="mt8 txt_item_2">삭제 후에는 되돌릴 수 없습니다.</p>
                    </div>

                    <div class="modal_btn_wrap">
                        <button class="btn_gray btn_full_thin" onclick="modal_close('delete')">취소</button>
                        <button class="btn_point btn_full_thin" onclick="modal_close('delete')">삭제</button>
                    </div>
                </div>

            </div>
            <div class="md_overlay md_overlay_delete" onclick="modal_close('delete')"></div>
            <!-- modal 삭제 : e -->

        </div>
    </div>

</x-layout>
