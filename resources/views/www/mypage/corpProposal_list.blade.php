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
                    <h1 class="t_center only_pc">기업 이전 제안서</h1>

                    <div class="flex_between my_body_top">
                        <div class="gray_deep fs_16_v">총 8개의 제안서</div>
                        <button class="btn_point btn_sm" onclick="modal_open('add')">신규 기업 추가</button>
                    </div>

                    <!-- 데이터가 없을 경우 : s -->
                    <!-- <div class="empty_wrap">
                        <p>작성한 기업 이전 제안서가 없습니다.</p>
                        <span>기업 이전 제안서를 작성하고, 쉽게 관리해보세요.</span>
                      </div> -->
                    <!-- 데이터가 없을 경우 : e -->

                    <div class="proposal_list_2_wrap">

                        <div class="proposal_list_row">
                            <div class="cursor_pointer" onclick="location.href='realtor_proposal_detail.html'">
                                <h5>주식회사 에스앤디</h5>
                                <p class="list_item_1">제안한 매물 <span>0개</span></p>
                            </div>
                            <div class="list_item_2">
                                <span class="txt_date">2023.04.12</span>
                                <div class="gap_8">
                                    <button class="btn_gray_ghost btn_sm"
                                        onclick="location.href='proposal_type.html'">제안서 미리보기</button>
                                    <button class="btn_gray_ghost btn_sm" onclick="modal_open('delete')">삭제</button>
                                </div>
                                <button class="btn_arrow"
                                    onclick="location.href='realtor_proposal_detail.html'"></button>
                            </div>
                        </div>

                        <div class="proposal_list_row">
                            <div class="cursor_pointer" onclick="location.href='realtor_proposal_detail.html'">
                                <h5>(주)어바웃스킨</h5>
                                <p class="list_item_1">제안한 매물 <span>0개</span></p>
                            </div>
                            <div class="list_item_2">
                                <span class="txt_date">2023.04.12</span>
                                <div class="gap_8">
                                    <button class="btn_gray_ghost btn_sm" disabled>제안서 미리보기</button>
                                    <button class="btn_gray_ghost btn_sm" onclick="modal_open('delete')">삭제</button>
                                </div>
                                <button class="btn_arrow"
                                    onclick="location.href='realtor_proposal_detail.html'"></button>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- my_body : e -->
            </div>

            <!-- modal 추가 : s -->
            <div class="modal modal_add">
                <div class="modal_title">
                    <h5>신규 기업 추가</h5>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                        onclick="modal_close('add')">
                </div>
                <div class="modal_container">
                    <ul class="reg_bascic">
                        <li>
                            <label>기업명<span>*</span></label>
                            <input type="text" placeholder="기업명을 입력해주세요.">
                        </li>
                        <li>
                            <label>중개사 직책 *<span>*</span></label>
                            <input type="text" placeholder="제안서에 노출될 중개사의 직책 입력. 예) 대표">
                        </li>
                    </ul>
                    <div class="mt40">
                        <button class="btn_point btn_full_thin" disabled onclick="modal_close('add')">추가</button>
                    </div>
                </div>
            </div>
            <div class="md_overlay md_overlay_add" onclick="modal_close('add')"></div>
            <!-- modal 추가 : e -->

            <!-- modal 삭제 : s -->
            <div class="modal modal_delete">

                <div class="modal_container">
                    <div class="modal_mss_wrap">
                        <p class="txt_item_1 txt_point">주식회사 에스엔디</p>
                        <p class="txt_item_1">기업을 삭제하시겠습니까?</p>
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
