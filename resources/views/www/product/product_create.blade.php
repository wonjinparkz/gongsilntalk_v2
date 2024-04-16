<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="images/header_btn_back.png"></a></div>
        <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">1</span>/3</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span class="txt_point">1</span>/3</span></h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>매물 유형 <span class="txt_point">*</span></h4>
                    <ul class="tab_type_3 tab_toggle_menu">
                        <li class="active" onclick="showDiv('category', 0)">상업용</li>
                        <li onclick="showDiv('category', 1)">주거용</li>
                        <li onclick="showDiv('category', 2)">분양권</li>
                    </ul>
                    <div class="tab_area_wrap">
                        <div>
                            <div class="btn_radioType">
                                <input type="radio" name="commercial" id="commercial_1" value="Y" checked>
                                <label for="commercial_1">지식산업센터</label>

                                <input type="radio" name="commercial" id="commercial_2" value="Y">
                                <label for="commercial_2">사무실</label>

                                <input type="radio" name="commercial" id="commercial_3" value="Y">
                                <label for="commercial_3">창고</label>

                                <input type="radio" name="commercial" id="commercial_4" value="Y">
                                <label for="commercial_4">상가</label>

                                <input type="radio" name="commercial" id="commercial_5" value="Y">
                                <label for="commercial_5">기숙사</label>

                                <input type="radio" name="commercial" id="commercial_6" value="Y">
                                <label for="commercial_6">건물</label>

                                <input type="radio" name="commercial" id="commercial_7" value="Y">
                                <label for="commercial_7">토지/임야</label>

                                <input type="radio" name="commercial" id="commercial_8" value="Y">
                                <label for="commercial_8">단독 공장</label>
                            </div>
                        </div>
                        <div>
                            <div class="btn_radioType">
                                <input type="radio" name="inhabitation" id="inhabitation_1" value="Y" checked>
                                <label for="inhabitation_1">아파트</label>

                                <input type="radio" name="inhabitation" id="inhabitation_2" value="Y">
                                <label for="inhabitation_2">오피스텔</label>

                                <input type="radio" name="inhabitation" id="inhabitation_3" value="Y">
                                <label for="inhabitation_3">단독/다가구</label>

                                <input type="radio" name="inhabitation" id="inhabitation_4" value="Y">
                                <label for="inhabitation_4">다세대/빌라/연립</label>

                                <input type="radio" name="inhabitation" id="inhabitation_5" value="Y">
                                <label for="inhabitation_5">상가주택</label>

                                <input type="radio" name="inhabitation" id="inhabitation_6" value="Y">
                                <label for="inhabitation_6">주택</label>
                            </div>
                        </div>

                        <div>
                            <div class="btn_radioType">
                                <input type="radio" name="pre_sale" id="pre_sale_1" value="Y" checked>
                                <label for="pre_sale_1">지식산업센터 분양권</label>

                                <input type="radio" name="pre_sale" id="pre_sale_2" value="Y">
                                <label for="pre_sale_2">상가 분양권</label>

                                <input type="radio" name="pre_sale" id="pre_sale_3" value="Y">
                                <label for="pre_sale_3">아파트 분양권</label>

                                <input type="radio" name="pre_sale" id="pre_sale_4" value="Y">
                                <label for="pre_sale_4">오피스텔 분양권</label>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="box_01 box_reg">
                    <div class="category_wrap">
                        <!-- 상업용 : s -->
                        <div class="category_item open_key active">
                            <div class="input_item_grid">
                                <h4>상업용 거래 정보 <span class="txt_point">*</span></h4>
                                <div class="btn_radioType">
                                    <input type="radio" name="sales_type_1" id="sales_type_1_1" value="Y" checked>
                                    <label for="sales_type_1_1" onclick="showDiv('type', 0)">매매</label>

                                    <input type="radio" name="sales_type_1" id="sales_type_1_2" value="Y">
                                    <label for="sales_type_1_2" onclick="showDiv('type', 1)">임대</label>

                                    <input type="radio" name="sales_type_1" id="sales_type_1_3" value="Y">
                                    <label for="sales_type_1_3" onclick="showDiv('type', 1)">단기임대</label>
                                </div>

                                <div class="type_wrap">
                                    <!-- 매매 -->
                                    <div class="type_item open_key active">
                                        <div class="input_item_grid">
                                            <div>
                                                <label class="input_label">매매가</label>
                                                <div class="input_area_1">
                                                    <input type="number"> <span class="gray_deep">원</span>
                                                    <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                                    <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 임대, 단기임대 -->
                                    <div class="type_item open_key">
                                        <div class="input_item_grid">
                                            <div class="input_area_2">
                                                <div class="flex_between">
                                                    <div class="item">
                                                        <label class="input_label">현 보증금</label>
                                                        <div class="flex_1">
                                                            <input type="number" class="w_input_150"><span>/</span>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <label class="input_label">현 월임대료</label>
                                                        <div class="flex_1">
                                                            <input type="number" class="w_input_150"><span>원</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item_check_add">
                                                    <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                                    <label for="checkOne_4" class="gray_deep mt18"><span></span> 협의가능</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>
                                        <label class="input_label">기존 임대차 내용</label>
                                        <div class="btn_radioType">
                                            <input type="radio" name="lease_1" id="lease_1_1" value="Y">
                                            <label for="lease_1_1" onclick="showDiv('lease_1', 0)">있음</label>

                                            <input type="radio" name="lease_1" id="lease_1_2" value="Y">
                                            <label for="lease_1_2" onclick="showDiv('lease_1', 1)">없음</label>
                                        </div>
                                    </div>
                                    <div class="lease_1_wrap mt20">
                                        <div class="lease_1_item open_key">
                                            <div class="flex_between w_30">
                                                <div class="item">
                                                    <label class="input_label">현 보증금</label>
                                                    <div class="flex_1">
                                                        <input type="number" class="w_input_150"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">현 월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="number" class="w_input_150"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lease_1_item open_key"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- 상업용 : e -->

                        <!-- 주거용 : s -->
                        <div class="category_item open_key">
                            <div class="input_item_grid">
                                <h4>주거용 거래 정보 <span class="txt_point">*</span></h4>
                                <div class="btn_radioType">
                                    <input type="radio" name="sales_type_2" id="sales_type_2_1" value="Y" checked>
                                    <label for="sales_type_2_1" onclick="showDiv('type_2', 0)">매매</label>

                                    <input type="radio" name="sales_type_2" id="sales_type_2_2" value="Y">
                                    <label for="sales_type_2_2" onclick="showDiv('type_2', 1)">전세</label>

                                    <input type="radio" name="sales_type_2" id="sales_type_2_3" value="Y">
                                    <label for="sales_type_2_3" onclick="showDiv('type_2', 2)">월세</label>

                                    <input type="radio" name="sales_type_2" id="sales_type_2_4" value="Y">
                                    <label for="sales_type_2_4" onclick="showDiv('type_2', 2)">단기임대</label>
                                </div>

                                <div class="type_2_wrap">
                                    <!-- 매매 -->
                                    <div class="type_2_item open_key active">
                                        <div>
                                            <label class="input_label">매매가</label>
                                            <div class="input_area_1">
                                                <input type="number" class=""> <span class="gray_deep">원</span>
                                                <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                                <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 전세 -->
                                    <div class="type_2_item open_key">
                                        <div>
                                            <label class="input_label">전세가</label>
                                            <div class="input_area_1">
                                                <input type="number" class=""> <span class="gray_deep">원</span>
                                                <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                                <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 월세, 단기임대 -->
                                    <div class="type_2_item open_key">
                                        <div class="input_area_2">
                                            <div class="flex_between">
                                                <div class="item">
                                                    <label class="input_label">보증금</label>
                                                    <div class="flex_1">
                                                        <input type="number" class="w_input_150"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="number" class="w_input_150"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item_check_add">
                                                <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                                <label for="checkOne_4" class="gray_deep mt18"><span></span> 협의가능</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="input_label">기존 임대차 내용</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="lease_2" id="lease_2_1" value="Y">
                                        <label for="lease_2_1" onclick="showDiv('lease_2', 0)">있음</label>

                                        <input type="radio" name="lease_2" id="lease_2_2" value="Y">
                                        <label for="lease_2_2" onclick="showDiv('lease_2', 1)">없음</label>
                                    </div>
                                </div>
                                <div class="lease_2_wrap w_30">
                                    <div class="lease_2_item open_key">
                                        <div class="flex_between">
                                            <div class="item">
                                                <label class="input_label">현 보증금</label>
                                                <div class="flex_1">
                                                    <input type="number"><span>/</span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <label class="input_label">현 월임대료</label>
                                                <div class="flex_1">
                                                    <input type="number"><span>원</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="lease_2_item open_key"></div>
                                </div>
                            </div>
                        </div>
                        <!-- 주거용 : e -->

                        <!-- 분양권 : s -->
                        <div class="category_item open_key">
                            <div class="input_item_grid">
                                <h4>분양권 거래 정보 <span class="txt_point">*</span></h4>
                                <div class="btn_radioType">
                                    <input type="radio" name="sales_type_3" id="sales_type_3_1" value="Y" checked>
                                    <label for="sales_type_3_1" onclick="showDiv('type_3', 0)">전매</label>

                                    <input type="radio" name="sales_type_3" id="sales_type_3_2" value="Y">
                                    <label for="sales_type_3_2" onclick="showDiv('type_3', 1)">전세</label>

                                    <input type="radio" name="sales_type_3" id="sales_type_3_3" value="Y">
                                    <label for="sales_type_3_3"onclick="showDiv('type_3', 2)">월세</label>
                                </div>

                                <div class="type_3_wrap">
                                    <!-- 전매 -->
                                    <div class="type_3_item open_key active">
                                        <div>
                                            <label class="input_label">전매가</label>
                                            <div class="input_area_1">
                                                <input type="number" class=""> <span class="gray_deep">원</span>
                                                <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                                <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 전세 -->
                                    <div class="type_3_item open_key">
                                        <div>
                                            <label class="input_label">전세가</label>
                                            <div class="input_area_1">
                                                <input type="number" class=""> <span class="gray_deep">원</span>
                                                <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                                <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 월세 -->
                                    <div class="type_3_item open_key">
                                        <div class="input_area_2">
                                            <div class="flex_between">
                                                <div class="item">
                                                    <label class="input_label">보증금</label>
                                                    <div class="flex_1">
                                                        <input type="number" class="w_input_150"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="number" class="w_input_150"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item_check_add">
                                                <input type="checkbox" name="checkOne" id="checkOne_5" value="Y">
                                                <label for="checkOne_5" class="gray_deep mt18"><span></span> 협의가능</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <label class="input_label">준공예정일</label>
                                    <div class="w_30">
                                        <input type="number" placeholder="예) 20230101">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- 분양권 : e -->

                    </div>
                </div>

                <div class="step_btn_wrap">
                    <span></span>
                    <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point" onclick="location.href='estate_reg_2.html'">다음</button>
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
