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
        <form method="get" action="{{ route('www.mypage.service.create.third.view') }}">
            @php
                $data = $request->all();

                foreach ($data as $key => $value) {
                    echo '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                }
            @endphp

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">자산 등록하기 <span class="step_number"><span class="txt_point">2</span>/4</span>
                </h1>

                <div class="offer_step_wrap">

                    <div class="box_01 box_reg">
                        <h4>거래정보</h4>

                        <ul class="tab_type_3 tab_toggle_menu">
                            <li class="active">매매</li>
                            <li>분양권</li>
                        </ul>

                        <div class="tab_area_wrap">
                            <div class="input_item_grid">
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">매매가 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text"> <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">계약일자 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text">
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">취득세율 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" placeholder="소수점 두자리까지 입력"> <span>%</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">기타비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text"> <span>원</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">세무비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" placeholder="소수점 두자리까지 입력"> <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">부동산수수료</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text"> <span>원</span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="input_item_grid">
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">분양가 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text"> <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">계약일자 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" placeholder="예) 20230101">
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <div class="flex_between">
                                            <label class="input_label">등기일</label>
                                            <span class="gray_basic">* 건물 준공 후 기입</span>
                                        </div>
                                        <div class="flex_1 flex_between">
                                            <input type="text" disabled placeholder="예) 20240101">
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">취득세율 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" placeholder="소수점 두자리까지 입력"> <span>%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">기타비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" placeholder="소수점 두자리까지 입력"> <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">세무비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" placeholder="소수점 두자리까지 입력"> <span>원</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">부동산수수료</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" placeholder="소수점 두자리까지 입력"> <span>원</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box_01 box_reg">
                        <h4>대출정보</h4>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">대출금액</label>
                                <div class="flex_1 flex_between">
                                    <input type="text"> <span>원</span>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">대출금리</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" placeholder="소수점 두자리까지 입력"> <span>%</span>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">대출기간 </label>
                                <div class="flex_1 flex_between">
                                    <input type="text"> <span>개월</span>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">대출일자</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" placeholder="예) 20230101"> <span>원</span>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="">
                                <label class="input_label">대출방식 </label>
                                <div class="btn_radioType mt8">
                                    <input type="radio" name="loan_type" id="loan_type_1" value="Y">
                                    <label for="loan_type_1">해당없음</label>

                                    <input type="radio" name="loan_type" id="loan_type_2" value="Y">
                                    <label for="loan_type_2">원리금균등분할</label>

                                    <input type="radio" name="loan_type" id="loan_type_3" value="Y">
                                    <label for="loan_type_3">원금균등상환</label>

                                    <input type="radio" name="loan_type" id="loan_type_4" value="Y">
                                    <label for="loan_type_4">만기상환</label>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="step_btn_wrap">
                        <button class="btn_full_basic btn_graylight_ghost" type="button"
                            onclick="javascript:history.back();">이전</button>
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
