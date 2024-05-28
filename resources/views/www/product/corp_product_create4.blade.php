<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="images/header_btn_back.png"></a></div>
        <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">4</span>/5</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span class="txt_point">4</span>/5</span></h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>추가 정보</h4>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">건물 방향</label>
                            <div class="dropdown_box">
                                <button class="dropdown_label">건물 방향 선택</button>
                                <ul class="optionList">
                                    <li class="optionItem">동</li>
                                    <li class="optionItem">서</li>
                                    <li class="optionItem">남</li>
                                    <li class="optionItem">북</li>
                                    <li class="optionItem">북동</li>
                                    <li class="optionItem">남동</li>
                                    <li class="optionItem">북서</li>
                                    <li class="optionItem">남서</li>
                                </ul>
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">난방 종류</label>
                            <div class="dropdown_box">
                                <button class="dropdown_label">난방 종류 선택</button>
                                <ul class="optionList">
                                    <li class="optionItem">개별난방</li>
                                    <li class="optionItem">중앙난방</li>
                                    <li class="optionItem">지역난방</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">하중(평당)</label>
                            <div class="flex_1 mt10">
                                <input type="number" placeholder="예) 0.8" class="w_input_150"><span>톤</span>
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">승강시설 <span class="txt_point">*</span></label>
                            <div class="btn_radioType mt18">
                                <input type="radio" name="elevator" id="elevator_1" checked="">
                                <label for="elevator_1" >있음</label>

                                <input type="radio" name="elevator" id="elevator_2">
                                <label for="elevator_2">없음</label>

                                <input type="checkbox" name="elevator" id="elevator_3" value="Y">
                                <label for="elevator_3" class="gray_deep"><span></span> 화물용</label>
                            </div>
                        </div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">인테리어 여부</label>
                            <div class="btn_radioType">
                                <input type="radio" name="interior" id="interior_1" value="Y" checked="">
                                <label for="interior_1">선택 안함</label>

                                <input type="radio" name="interior" id="interior_2" value="Y">
                                <label for="interior_2">있음</label>

                                <input type="radio" name="interior" id="interior_3" value="Y">
                                <label for="interior_3">없음</label>
                            </div>
                        </div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">층고</label>
                            <div class="btn_radioType">
                                <input type="radio" name="floor_height" id="floor_height_1" value="Y" checked="">
                                <label for="floor_height_1">선택 안함</label>

                                <input type="radio" name="floor_height" id="floor_height_2" value="Y">
                                <label for="floor_height_2">3.5M 이하</label>

                                <input type="radio" name="floor_height" id="floor_height_3" value="Y">
                                <label for="floor_height_3">3.6~4.5M</label>

                                <input type="radio" name="floor_height" id="floor_height_4" value="Y">
                                <label for="floor_height_4">4.6~5.5M</label>

                                <input type="radio" name="floor_height" id="floor_height_5" value="Y">
                                <label for="floor_height_5">5.6~6.5M</label>

                                <input type="radio" name="floor_height" id="floor_height_6" value="Y">
                                <label for="floor_height_6">6.6M 이상</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="reg_item">
                            <label class="input_label">사용전력</label>
                            <div class="btn_radioType">
                                <input type="radio" name="power" id="power_1" value="Y" checked="">
                                <label for="power_1">선택 안함</label>

                                <input type="radio" name="power" id="power_2" value="Y">
                                <label for="power_2">10KW 이하</label>

                                <input type="radio" name="power" id="power_3" value="Y">
                                <label for="power_3">11~25KW</label>

                                <input type="radio" name="power" id="power_4" value="Y">
                                <label for="power_4">26~50KW</label>

                                <input type="radio" name="power" id="power_5" value="Y">
                                <label for="power_5">51~100KW</label>

                                <input type="radio" name="power" id="power_6" value="Y">
                                <label for="power_6">101~1000KW</label>

                                <input type="radio" name="power" id="power_6" value="Y">
                                <label for="power_6">1001KW 이상</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box_01 box_reg">
                    <h4>옵션 정보</h4>

                    <div>
                        <div class="reg_item">
                            <label class="input_label">옵션 여부</label>
                            <div class="btn_radioType">
                                <input type="radio" name="option_info" id="option_info_1" value="Y" checked="">
                                <label for="option_info_1" onclick="showDiv('option_info', 0)">있음</label>

                                <input type="radio" name="option_info" id="option_info_2" value="Y">
                                <label for="option_info_2" onclick="showDiv('option_info', 1)">없음</label>
                            </div>
                            <div class="option_info_wrap">
                                <div class="option_info_item open_key active">
                                    <div class="option_row">
                                        <div class="option_tit">시설</div>
                                        <div class="checkbox_btn">
                                            <input type="checkbox" name="option_1" id="option_1_1">
                                            <label for="option_1_1">창고</label>

                                            <input type="checkbox" name="option_1" id="option_1_2">
                                            <label for="option_1_2">급수시설</label>

                                            <input type="checkbox" name="option_1" id="option_1_3">
                                            <label for="option_1_3">급배기시설</label>

                                            <input type="checkbox" name="option_1" id="option_1_4">
                                            <label for="option_1_4">환기시설</label>

                                            <input type="checkbox" name="option_1" id="option_1_5">
                                            <label for="option_1_5">휴게공간</label>

                                            <input type="checkbox" name="option_1" id="option_1_6">
                                            <label for="option_1_6">베란다</label>

                                            <input type="checkbox" name="option_1" id="option_1_7">
                                            <label for="option_1_7">테라스</label>
                                        </div>
                                    </div>
                                    <div class="option_row">
                                        <div class="option_tit">보안</div>
                                        <div class="checkbox_btn">
                                            <input type="checkbox" name="option_2" id="option_2_1">
                                            <label for="option_2_1">CCTV</label>

                                            <input type="checkbox" name="option_2" id="option_2_2">
                                            <label for="option_2_2">자체경비원</label>

                                            <input type="checkbox" name="option_2" id="option_2_3">
                                            <label for="option_2_3">디지털도어락</label>

                                            <input type="checkbox" name="option_2" id="option_2_4">
                                            <label for="option_2_4">관리인상주</label>

                                            <input type="checkbox" name="option_2" id="option_2_5">
                                            <label for="option_2_5">소화기</label>

                                            <input type="checkbox" name="option_2" id="option_2_6">
                                            <label for="option_2_6">화재감지기</label>

                                            <input type="checkbox" name="option_2" id="option_2_7">
                                            <label for="option_2_7">화재경보기</label>

                                            <input type="checkbox" name="option_2" id="option_2_8">
                                            <label for="option_2_8">카드키</label>

                                            <input type="checkbox" name="option_2" id="option_2_9">
                                            <label for="option_2_9">무인택배함</label>

                                            <input type="checkbox" name="option_2" id="option_2_10">
                                            <label for="option_2_10">방범창</label>

                                            <input type="checkbox" name="option_2" id="option_2_11">
                                            <label for="option_2_11">비디오폰</label>
                                        </div>
                                    </div>

                                    <div class="option_row">
                                        <div class="option_tit">주방</div>
                                        <div class="checkbox_btn">
                                            <input type="checkbox" name="option_3" id="option_3_1">
                                            <label for="option_3_1">인덕션</label>

                                            <input type="checkbox" name="option_3" id="option_3_2">
                                            <label for="option_3_2">가스레인지</label>

                                            <input type="checkbox" name="option_3" id="option_3_3">
                                            <label for="option_3_3">전자레인지</label>

                                            <input type="checkbox" name="option_3" id="option_3_4">
                                            <label for="option_3_4">오븐</label>

                                            <input type="checkbox" name="option_3" id="option_3_5">
                                            <label for="option_3_5">식기세척기</label>

                                            <input type="checkbox" name="option_3" id="option_3_6">
                                            <label for="option_3_6">싱크대</label>
                                        </div>
                                    </div>

                                    <div class="option_row">
                                        <div class="option_tit">가전</div>
                                        <div class="checkbox_btn">
                                            <input type="checkbox" name="option_4" id="option_4_1">
                                            <label for="option_4_1">무선인터넷</label>

                                            <input type="checkbox" name="option_4" id="option_4_2">
                                            <label for="option_4_2">에어컨</label>

                                            <input type="checkbox" name="option_4" id="option_4_3">
                                            <label for="option_4_3">세탁기</label>

                                            <input type="checkbox" name="option_4" id="option_4_4">
                                            <label for="option_4_4">냉장고</label>

                                            <input type="checkbox" name="option_4" id="option_4_5">
                                            <label for="option_4_5">비데</label>

                                            <input type="checkbox" name="option_4" id="option_4_6">
                                            <label for="option_4_6">TV</label>
                                        </div>
                                    </div>

                                    <div class="option_row">
                                        <div class="option_tit">가구</div>
                                        <div class="checkbox_btn">
                                            <input type="checkbox" name="option_5" id="option_5_1">
                                            <label for="option_5_1">붙박이장</label>

                                            <input type="checkbox" name="option_5" id="option_5_2">
                                            <label for="option_5_2">드레스룸</label>

                                            <input type="checkbox" name="option_5" id="option_5_3">
                                            <label for="option_5_3">신발장</label>

                                            <input type="checkbox" name="option_5" id="option_5_4">
                                            <label for="option_5_4">욕조</label>

                                            <input type="checkbox" name="option_5" id="option_5_5">
                                            <label for="option_5_5">식탁</label>
                                        </div>
                                    </div>

                                    <div class="option_row">
                                        <div class="option_tit">기타</div>
                                        <div class="checkbox_btn">
                                            <input type="checkbox" name="option_6" id="option_6_1">
                                            <label for="option_6_1">베란다</label>

                                            <input type="checkbox" name="option_6" id="option_6_2">
                                            <label for="option_6_2">테라스</label>

                                            <input type="checkbox" name="option_6" id="option_6_3">
                                            <label for="option_6_3">발코니</label>

                                            <input type="checkbox" name="option_6" id="option_6_4">
                                            <label for="option_6_4">마당</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="option_info_item open_key"></div>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="step_btn_wrap">
                    <button class="btn_full_basic btn_graylight_ghost" onclick="location.href='realtor_estate_reg_3.html'">이전</button>
                    <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point" onclick="location.href='realtor_estate_reg_5.html'">다음</button>
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
