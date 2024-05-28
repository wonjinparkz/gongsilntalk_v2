<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="images/header_btn_back.png"></a></div>
        <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">3</span>/5</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span class="txt_point">3</span>/5</span></h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>기본 정보</h4>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">해당층/전체층 <span class="txt_point">*</span></label>
                            <div class="input_pyeong_area">
                                <div><input type="text" placeholder="해당층"> <span class="gray_deep">층</span> </div>
                                <span class="gray_deep">/</span>
                                <div><input type="text" placeholder="전체층"> <span class="gray_deep">층</span></div>
                            </div>
                        </div>
                    </div>
                    <!-- 단독공장 해당 : s
                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">최저/최고층 <span class="txt_point">*</span></label>
                            <div class="input_pyeong_area">
                                <div><input type="text" placeholder="최저"> <span class="gray_deep">층</span> </div>
                                <span class="gray_deep">/</span>
                                <div><input type="text" placeholder="최고"> <span class="gray_deep">층</span></div>
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">대지면적 <span class="txt_point">*</span></label>
                            <div class="input_pyeong_area">
                                <div><input type="text" placeholder="대지면적"> <span class="gray_deep">평</span> </div>
                                <span class="gray_deep">/</span>
                                <div><input type="text" placeholder="평 입력시 자동"> <span class="gray_deep">㎡</span></div>
                            </div>
                        </div>
                    </div>
                     단독공장 해당 : e -->

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">공급 면적 <span class="txt_point">*</span></label>
                            <div class="input_pyeong_area">
                                <div><input type="text" placeholder="전용면적"> <span class="gray_deep">평</span> </div>
                                <span class="gray_deep">/</span>
                                <div><input type="text" placeholder="평 입력시 자동"> <span class="gray_deep">㎡</span></div>
                            </div>
                        </div>
                        <!-- 단독공장 해당 <div class="reg_item">
                            <label class="input_label">연면적 <span class="txt_point">*</span></label>
                            <div class="input_pyeong_area">
                                <div><input type="text" placeholder="연면적"> <span class="gray_deep">평</span> </div>
                                <span class="gray_deep">/</span>
                                <div><input type="text" placeholder="평 입력시 자동"> <span class="gray_deep">㎡</span></div>
                            </div>
                        </div> -->
                        <div class="reg_item">
                            <label class="input_label">전용 면적 <span class="txt_point">*</span></label>
                            <div class="input_pyeong_area">
                                <div><input type="text" placeholder="전용면적"> <span class="gray_deep">평</span> </div>
                                <span class="gray_deep">/</span>
                                <div><input type="text" placeholder="평 입력시 자동"> <span class="gray_deep">㎡</span></div>
                            </div>
                        </div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">사용승인일 <span class="txt_point">*</span></label>
                            <input type="text" placeholder="예) 20230101">
                        </div>
                        <div class="reg_item">
                            <label class="input_label">주용도 <span class="txt_point">*</span></label>
                            <div class="dropdown_box">
                                <button class="dropdown_label">주용도 선택</button>
                                <ul class="optionList">
                                    <li class="optionItem">단독주택</li>
                                    <li class="optionItem">공동주택</li>
                                    <li class="optionItem">업무시설</li>
                                    <li class="optionItem">단기임대</li>
                                    <li class="optionItem">근린생활시설</li>
                                    <li class="optionItem">의료시설</li>
                                    <li class="optionItem">교육연구시설</li>
                                    <li class="optionItem">판매시설</li>
                                    <li class="optionItem">운동시설</li>
                                    <li class="optionItem">숙박시설</li>
                                    <li class="optionItem">문화및집회시설</li>
                                    <li class="optionItem">위락시설</li>
                                    <li class="optionItem">창고시설</li>
                                    <li class="optionItem">공장</li>
                                    <li class="optionItem">기타</li>
                                    <li class="optionItem">구분없음</li>
                                </ul>
                              </div>
                        </div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">입주가능일 <span class="txt_point">*</span></label>
                            <div class="btn_radioType">
                                <input type="radio" name="m_day" id="m_day_1" value="Y" checked="">
                                <label for="m_day_1" onclick="showDiv('m_day', 0)">즉시 입주</label>

                                <input type="radio" name="m_day" id="m_day_2" value="Y">
                                <label for="m_day_2" onclick="showDiv('m_day', 0)">날짜 협의</label>

                                <input type="radio" name="m_day" id="m_day_3" value="Y">
                                <label for="m_day_3" onclick="showDiv('m_day', 1)">직접 입력</label>
                            </div>
                            <div class="m_day_wrap mt8">
                                <div class="m_day_item open_key"></div>
                                <div class="m_day_item open_key">
                                    <input type="text" placeholder="예) 20230101" class="">
                                </div>
                            </div>
                        </div>
                        <div class="reg_item only_pc"></div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">월 관리비 <span class="txt_point">*</span></label>
                            <div class="input_area_1">
                                <input type="number"> <span class="gray_deep">원</span>
                                <!-- <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                기숙사일 경우 <label for="checkOne_4" class="gray_deep"><span></span> 관리비 없음</label> -->
                            </div>
                        </div>
                    </div>



                    <div>
                        <label class="input_label">관리비 항목</label>
                        <div class="checkbox_btn">
                            <input type="checkbox" name="mngt_item" id="mngt_item_1">
                            <label for="mngt_item_1">청소비</label>

                            <input type="checkbox" name="mngt_item" id="mngt_item_2">
                            <label for="mngt_item_2">경비비</label>

                            <input type="checkbox" name="mngt_item" id="mngt_item_3">
                            <label for="mngt_item_3">인터넷</label>

                            <input type="checkbox" name="mngt_item" id="mngt_item_4">
                            <label for="mngt_item_4">승강기유지비</label>

                            <input type="checkbox" name="mngt_item" id="mngt_item_5">
                            <label for="mngt_item_5">수선유지비</label>

                            <input type="checkbox" name="mngt_item" id="mngt_item_6">
                            <label for="mngt_item_6">전기세</label>

                            <input type="checkbox" name="mngt_item" id="mngt_item_7">
                            <label for="mngt_item_7">수도세</label>

                            <input type="checkbox" name="mngt_item" id="mngt_item_8">
                            <label for="mngt_item_8">도시가스비</label>

                            <input type="checkbox" name="mngt_item" id="mngt_item_9">
                            <label for="mngt_item_9">기타</label>
                        </div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">융자금 <span class="txt_point">*</span></label>
                            <div class="btn_radioType">
                                <input type="radio" name="loan" id="loan_1" value="Y" checked="">
                                <label for="loan_1">없음</label>

                                <input type="radio" name="loan" id="loan_2" value="Y">
                                <label for="loan_2">30%미만</label>

                                <input type="radio" name="loan" id="loan_3" value="Y">
                                <label for="loan_3">30%이상</label>
                            </div>
                            <div class="flex_1 mt10">
                                <input type="number" class="w_input_150" disabled><span>원</span>
                            </div>
                        </div>
                        <div class="reg_item only_pc"></div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">주차 가능 여부</label>
                            <div class="btn_radioType">
                                <input type="radio" name="parking" id="parking_1" value="Y" checked="">
                                <label for="parking_1">선택 안함</label>

                                <input type="radio" name="parking" id="parking_2" value="Y">
                                <label for="parking_2">가능</label>

                                <input type="radio" name="parking" id="parking_3" value="Y">
                                <label for="parking_3">불가능</label>
                            </div>
                            <div class="flex_1 mt10">
                                <input type="number" class="w_input_150" disabled><span>원</span>
                            </div>
                        </div>
                        <div class="reg_item only_pc"></div>
                    </div>

                </div>



                <div class="step_btn_wrap">
                    <button class="btn_full_basic btn_graylight_ghost" onclick="location.href='realtor_estate_reg_2.html'">이전</button>
                    <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point" onclick="location.href='realtor_estate_reg_4.html'">다음</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->

    </div>

    <script>
    //입력란 열고 닫기
    function showDiv(className, index) {
        var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
        tabContents.forEach(function(content) {
            content.classList.remove('active');
        });
        tabContents[index].classList.add('active');
    }

    </script>

</x-layout>
