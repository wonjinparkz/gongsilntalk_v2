<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">내 자산 관리</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        <form method="get" action="{{ route('www.mypage.service.create.fourth.view') }}">
            @php
                $data = $request->all();

                foreach ($data as $key => $value) {
                    echo '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                }
            @endphp
            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">자산 등록하기 <span class="step_number"><span class="txt_point">3</span>/4</span>
                </h1>

                <div class="offer_step_wrap">

                    <div class="box_01 box_reg">
                        <h4>임대차 계약 정보</h4>

                        <div>
                            <label class="input_label">공실여부 <span class="txt_point">*</span></label>
                            <div class="btn_radioType mt8">
                                <input type="radio" name="vacancy" id="vacancy_1" value="Y">
                                <label for="vacancy_1">공실</label>

                                <input type="radio" name="vacancy" id="vacancy_2" value="Y">
                                <label for="vacancy_2">계약중</label>

                                <input type="radio" name="vacancy" id="vacancy_3" value="Y">
                                <label for="vacancy_3">미임대</label>
                            </div>
                        </div>



                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">임차인명</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" disabled>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">임차인 연락처</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" placeholder="예) 01012345678" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">임대료 납부 방법</label>
                                <div class="btn_radioType mt8">
                                    <input type="radio" name="pay_type" id="pay_type_1" value="Y">
                                    <label for="pay_type_1">선택 안함</label>

                                    <input type="radio" name="pay_type" id="pay_type_2" value="Y">
                                    <label for="pay_type_2">후불</label>

                                    <input type="radio" name="pay_type" id="pay_type_3" value="Y">
                                    <label for="pay_type_3">선불</label>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <div class="flex_between">
                                    <div class="item">
                                        <label class="input_label">보증금</label>
                                        <div class="flex_1">
                                            <input type="text"><span>/</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <label class="input_label">월임대료</label>
                                        <div class="flex_1">
                                            <input type="text"><span>원</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">월세 입금일</label>
                                <div class="dropdown_box w_full ">
                                    <button class="dropdown_label disabled">월세 입금일 선택 </button>
                                    <ul class="optionList">
                                        <li class="optionItem">1일</li>
                                        <li class="optionItem">2일</li>
                                        <li class="optionItem">3일</li>
                                        <li class="optionItem">말일</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap w_30">
                            <div class="input_calendar_term">
                                <div>
                                    <label class="input_label">계약시작일</label>
                                    <input type="text" placeholder="예) 20230101" disabled>
                                </div>
                                <span>~</span>
                                <div>
                                    <label class="input_label">계약종료일</label>
                                    <input type="text" placeholder="예) 20230101" disabled>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="step_btn_wrap">
                        <button class="btn_full_basic btn_graylight_ghost" type="button"
                            onclick="javascript:history.back();">이전</button>
                        <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point" type="submit">다음</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->
        </form>
    </div>

    <script>
        //기본 토글 이벤트
        $(".proposal_toggle_btn").click(function() {
            $(this).toggleClass("toggled");
            if ($(this).hasClass("toggled")) {
                $(this).css("transform", "rotate(180deg)");
            } else {
                $(this).css("transform", "rotate(0deg)");
            }

            $(".proposal_table_wrap").stop().slideToggle(300);
            return false;
        });
    </script>
</x-layout>
