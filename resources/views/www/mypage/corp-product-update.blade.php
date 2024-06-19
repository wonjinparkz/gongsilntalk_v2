<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 수정</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="body">
        <form method="post" id="updateForm" action="{{ route('www.mypage.corp.product.magagement.update') }}">
            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">매물 수정</h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>매물 유형 <span class="txt_point">*</span></h4>
                        @php
                            $type = 0;
                            switch ($product->type) {
                                case $product->type < 8:
                                    $type = 0;
                                    break;
                                case $product->type > 7 && $product->type < 14:
                                    $type = 1;
                                    break;
                                case $product->type > 13:
                                    $type = 2;
                                    break;
                                default:
                                    $type = 0;
                                    break;
                            }
                        @endphp
                        <div class="estate_type_txt">{{ Lang::get('commons.management_product_type.' . $type) }} >
                            {{ Lang::get('commons.product_type.' . $product->type) }}
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <div class="category_wrap">

                            @if ($type == 0)
                                <!-- 상업용 : s -->
                                <div class="category_item">
                                    <div class="input_item_grid">
                                        <h4>상업용 거래 정보 <span class="txt_point">*</span></h4>
                                        <div class="btn_radioType">
                                            <input type="radio" name="sales_type_1" id="sales_type_1_1"
                                                value="Y">
                                            <label for="sales_type_1_1" onclick="showDiv('type', 0)">매매</label>

                                            <input type="radio" name="sales_type_1" id="sales_type_1_2"
                                                value="Y">
                                            <label for="sales_type_1_2" onclick="showDiv('type', 1)">임대</label>

                                            <input type="radio" name="sales_type_1" id="sales_type_1_3"
                                                value="Y">
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
                                                            <input type="checkbox" name="checkOne" id="checkOne_4"
                                                                value="Y">
                                                            <label for="checkOne_4" class="gray_deep"><span></span>
                                                                협의가능</label>
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
                                                                    <input type="number"
                                                                        class="w_input_150"><span>/</span>
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <label class="input_label">현 월임대료</label>
                                                                <div class="flex_1">
                                                                    <input type="number"
                                                                        class="w_input_150"><span>원</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="item_check_add">
                                                            <input type="checkbox" name="checkOne" id="checkOne_4"
                                                                value="Y">
                                                            <label for="checkOne_4" class="gray_deep mt18"><span></span>
                                                                협의가능</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div>
                                            <label class="input_label">기존 임대차 내용</label>
                                            <div class="btn_radioType">
                                                <input type="radio" name="lease_1" id="lease_1_1" value="Y">
                                                <label for="lease_1_1" onclick="showDiv('lease_1', 0)">있음</label>

                                                <input type="radio" name="lease_1" id="lease_1_2" value="Y">
                                                <label for="lease_1_2" onclick="showDiv('lease_1', 1)">없음</label>
                                            </div>
                                        </div>
                                        <div class="lease_1_wrap">
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



                                        <div>
                                            <label class="input_label">권리금 (상가일때만 개발 시 텍스트 삭제)</label>
                                            <div class="btn_radioType">
                                                <input type="radio" name="keymoney" id="keymoney_1"
                                                    value="Y">
                                                <label for="keymoney_1" onclick="showDiv('keymoney', 0)">있음</label>

                                                <input type="radio" name="keymoney" id="keymoney_2"
                                                    value="Y">
                                                <label for="keymoney_2" onclick="showDiv('keymoney', 1)">없음</label>
                                            </div>
                                        </div>
                                        <div class="keymoney_wrap w_30">
                                            <div class="keymoney_item open_key">
                                                <div class="flex_1 flex_between">
                                                    <input type="text"> <span>원</span>
                                                </div>
                                            </div>
                                            <div class="keymoney_item open_key"></div>
                                        </div>




                                    </div>
                                </div>
                                <!-- 상업용 : e -->
                            @elseif ($type == 1)
                                <!-- 주거용 : s -->
                                <div class="category_item">
                                    <div class="input_item_grid">
                                        <h4>주거용 거래 정보 <span class="txt_point">*</span></h4>
                                        <div class="btn_radioType">
                                            <input type="radio" name="sales_type_2" id="sales_type_2_1"
                                                value="Y" checked>
                                            <label for="sales_type_2_1" onclick="showDiv('type_2', 0)">매매</label>

                                            <input type="radio" name="sales_type_2" id="sales_type_2_2"
                                                value="Y">
                                            <label for="sales_type_2_2" onclick="showDiv('type_2', 1)">전세</label>

                                            <input type="radio" name="sales_type_2" id="sales_type_2_3"
                                                value="Y">
                                            <label for="sales_type_2_3" onclick="showDiv('type_2', 2)">월세</label>

                                            <input type="radio" name="sales_type_2" id="sales_type_2_4"
                                                value="Y">
                                            <label for="sales_type_2_4" onclick="showDiv('type_2', 2)">단기임대</label>
                                        </div>

                                        <div class="type_2_wrap">
                                            <!-- 매매 -->
                                            <div class="type_2_item open_key active">
                                                <div>
                                                    <label class="input_label">매매가</label>
                                                    <div class="input_area_1">
                                                        <input type="number" class=""> <span
                                                            class="gray_deep">원</span>
                                                        <input type="checkbox" name="checkOne" id="checkOne_4"
                                                            value="Y">
                                                        <label for="checkOne_4" class="gray_deep"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 전세 -->
                                            <div class="type_2_item open_key">
                                                <div>
                                                    <label class="input_label">전세가</label>
                                                    <div class="input_area_1">
                                                        <input type="number" class=""> <span
                                                            class="gray_deep">원</span>
                                                        <input type="checkbox" name="checkOne" id="checkOne_4"
                                                            value="Y">
                                                        <label for="checkOne_4" class="gray_deep"><span></span>
                                                            협의가능</label>
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
                                                                <input type="number"
                                                                    class="w_input_150"><span>/</span>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <label class="input_label">월임대료</label>
                                                            <div class="flex_1">
                                                                <input type="number"
                                                                    class="w_input_150"><span>원</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item_check_add">
                                                        <input type="checkbox" name="checkOne" id="checkOne_4"
                                                            value="Y">
                                                        <label for="checkOne_4" class="gray_deep mt18"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input_item_grid">
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
                            @else
                                <!-- 분양권 : s -->
                                <div class="category_item">
                                    <div class="input_item_grid">
                                        <h4>분양권 거래 정보 <span class="txt_point">*</span></h4>
                                        <div class="btn_radioType">
                                            <input type="radio" name="sales_type_3" id="sales_type_3_1"
                                                value="Y" checked>
                                            <label for="sales_type_3_1" onclick="showDiv('type_3', 0)">전매</label>

                                            <input type="radio" name="sales_type_3" id="sales_type_3_2"
                                                value="Y">
                                            <label for="sales_type_3_2" onclick="showDiv('type_3', 1)">전세</label>

                                            <input type="radio" name="sales_type_3" id="sales_type_3_3"
                                                value="Y">
                                            <label for="sales_type_3_3"onclick="showDiv('type_3', 2)">월세</label>
                                        </div>

                                        <div class="type_3_wrap">
                                            <!-- 전매 -->
                                            <div class="type_3_item open_key active">
                                                <div>
                                                    <label class="input_label">전매가</label>
                                                    <div class="input_area_1">
                                                        <input type="number" class=""> <span
                                                            class="gray_deep">원</span>
                                                        <input type="checkbox" name="checkOne" id="checkOne_4"
                                                            value="Y">
                                                        <label for="checkOne_4" class="gray_deep"><span></span>
                                                            협의가능</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- 전세 -->
                                            <div class="type_3_item open_key">
                                                <div>
                                                    <label class="input_label">전세가</label>
                                                    <div class="input_area_1">
                                                        <input type="number" class=""> <span
                                                            class="gray_deep">원</span>
                                                        <input type="checkbox" name="checkOne" id="checkOne_4"
                                                            value="Y">
                                                        <label for="checkOne_4" class="gray_deep"><span></span>
                                                            협의가능</label>
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
                                                                <input type="number"
                                                                    class="w_input_150"><span>/</span>
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <label class="input_label">월임대료</label>
                                                            <div class="flex_1">
                                                                <input type="number"
                                                                    class="w_input_150"><span>원</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="item_check_add">
                                                        <input type="checkbox" name="checkOne" id="checkOne_5"
                                                            value="Y">
                                                        <label for="checkOne_5" class="gray_deep mt18"><span></span>
                                                            협의가능</label>
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
                            @endif
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <h4>위치 및 주소 <span class="txt_point">*</span></h4>

                        <div class="address_reg_wrap">
                            <div class="inner_item">
                                <div class="search_address_1 active">
                                    <button type="button" class="btn_graylight_ghost btn_full_thin txt_r">주소
                                        검색</button>
                                </div>
                                <div class="search_address_2">
                                    <button type="button" class="btn_graylight_ghost btn_full_thin txt_r"
                                        onclick="modal_open('address_search')">가(임시)주소 검색</button>
                                </div>
                                <div class="mt8 gap_14">
                                    <input type="checkbox" name="temporary_address" id="temporary_address"
                                        value="Y">
                                    <label for="temporary_address" class="gray_deep"><span></span> 가(임시)주소</label>

                                    <input type="checkbox" name="unregistered" id="unregistered" value="Y">
                                    <label for="unregistered" class="gray_deep"><span></span> 미등기</label>
                                </div>
                                <!----------------- M:: map : s ----------------->
                                <div class="inner_item inner_map only_m">
                                    주소 검색 시,<br>해당 위치가 지도에 표시됩니다.
                                </div>
                                <!----------------- M:: map : e ----------------->
                                <div class="inner_address">
                                    <div class="address_row">
                                        <span>도로명</span>서울특별시 구로구 구로동 419-1
                                    </div>
                                    <div class="address_row">
                                        <span>지번</span>서울특별시 구로구 구로동로 40길 2
                                    </div>
                                </div>

                                <div class="detail_address_1 mt18 active">
                                    <div class="flex_2">
                                        <div class="flex_1">
                                            <input type="text">
                                            <span>동</span>
                                        </div>
                                        <div class="flex_1">
                                            <input type="text">
                                            <span>호</span>
                                        </div>
                                    </div>
                                    <div class="mt8">
                                        <input type="checkbox" name="address_no" id="address_no_1" value="Y">
                                        <label for="address_no_1" class="gray_deep"><span></span> 동정보 없음</label>
                                    </div>
                                </div>

                                <div class="detail_address_2 mt18">
                                    <div>
                                        <input type="text" placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호">
                                    </div>
                                    <div class="mt8">
                                        <input type="checkbox" name="address_no" id="address_no_2" value="Y">
                                        <label for="address_no_2" class="gray_deep"><span></span> 상세주소 없음</label>
                                    </div>
                                </div>

                            </div>
                            <div class="inner_item inner_map only_pc">
                                주소 검색 시,<br>해당 위치가 지도에 표시됩니다.
                            </div>
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <h4>기본 정보</h4>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">해당층/전체층 <span class="txt_point">*</span></label>
                                <div class="input_pyeong_area">
                                    <div><input type="text" placeholder="해당층"> <span class="gray_deep">층</span>
                                    </div>
                                    <span class="gray_deep">/</span>
                                    <div><input type="text" placeholder="전체층"> <span class="gray_deep">층</span>
                                    </div>
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
                                    <div><input type="text" placeholder="전용면적"> <span class="gray_deep">평</span>
                                    </div>
                                    <span class="gray_deep">/</span>
                                    <div><input type="text" placeholder="평 입력시 자동"> <span
                                            class="gray_deep">㎡</span>
                                    </div>
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
                                    <div><input type="text" placeholder="전용면적"> <span class="gray_deep">평</span>
                                    </div>
                                    <span class="gray_deep">/</span>
                                    <div><input type="text" placeholder="평 입력시 자동"> <span
                                            class="gray_deep">㎡</span>
                                    </div>
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
                                    <button type="button" class="dropdown_label">주용도 선택</button>
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
                                    <input type="radio" name="m_day" id="m_day_1" value="Y"
                                        checked="">
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
                                    <input type="radio" name="loan" id="loan_1" value="Y"
                                        checked="">
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
                                    <input type="radio" name="parking" id="parking_1" value="Y"
                                        checked="">
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

                    <div class="box_01 box_reg">
                        <h4>추가 정보</h4>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">건물 방향</label>
                                <div class="dropdown_box">
                                    <button type="button" class="dropdown_label">건물 방향 선택</button>
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
                                    <button type="button" class="dropdown_label">난방 종류 선택</button>
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
                                    <input type="number" class="w_input_150" disabled><span>원</span>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">승강시설 <span class="txt_point">*</span></label>
                                <div class="btn_radioType mt18">
                                    <input type="radio" name="elevator" id="elevator_1" checked="">
                                    <label for="elevator_1">있음</label>

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
                                    <input type="radio" name="interior" id="interior_1" value="Y"
                                        checked="">
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
                                    <input type="radio" name="floor_height" id="floor_height_1" value="Y"
                                        checked="">
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
                                    <input type="radio" name="power" id="power_1" value="Y"
                                        checked="">
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
                                    <input type="radio" name="option_info" id="option_info_1" value="Y"
                                        checked="">
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

                    <div class="box_01 box_reg">
                        <div class="flex_between">
                            <h4>사진 및 상세 설명</h4>
                            <p class="gray_basic">최대 8장 업로드 가능 <span class="txt_point">7</span> / 8</p>
                        </div>
                        <div class="img_add_wrap reg_step_type">
                            <div class="cell">
                                <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete">
                                <div class="img_box"><img src="{{ asset('assets/media/s_2.png') }}"></div>
                            </div>
                            <div class="cell">
                                <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete">
                                <div class="img_box"><img src="{{ asset('assets/media/s_2.png') }}"></div>
                            </div>
                            <div class="cell">
                                <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete">
                                <div class="img_box"><img src="{{ asset('assets/media/s_2.png') }}"></div>
                            </div>
                            <div class="cell">
                                <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete">
                                <div class="img_box"><img src="{{ asset('assets/media/s_2.png') }}"></div>
                            </div>
                            <div class="cell">
                                <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete">
                                <div class="img_box"><img src="{{ asset('assets/media/s_2.png') }}"></div>
                            </div>
                            <div class="cell">
                                <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete">
                                <div class="img_box"><img src="{{ asset('assets/media/s_2.png') }}"></div>
                            </div>
                            <div class="cell">
                                <button type="button">
                                    <div class="img_box"><img src="{{ asset('assets/media/btn_img_add.png') }}">
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div>
                            <div class="offer_textarea_wrap">
                                <label class="input_label">상세 설명 <span class="txt_point">*</span></label>
                                <input type="text" placeholder="매물 한줄요약. 예) 역에서 5분거리, 인프라 좋은 매물">
                                <textarea class="mt10" placeholder="매물에 대해 추가로 어필하고 싶은 내용을 자세히 작성해 주세요."></textarea>
                            </div>
                            <div class="reg_mid_wrap mt10">
                                <div class="reg_item">
                                    <label class="input_label">중개보수(부가세별도) <span class="txt_point">*</span></label>
                                    <input type="number" placeholder="중개보수를 입력해 주세요.">
                                </div>
                                <div class="reg_item">
                                    <label class="input_label">상한요율 <span class="txt_point">*</span></label>
                                    <input type="number" placeholder="상한요율을 % 단위로 입력해 주세요.">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step_btn_wrap">
                        <span></span>
                        <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point" type="button" onclick="onFormSubmit();">저장</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->
        </form>
    </div>

    <!-- modal 가(임시)주소 검색 : s-->
    <div class="modal modal_mid modal_address_search">
        <div class="modal_title">
            <h5>가(임시) 주소 검색</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('address_search')">
        </div>
        <div class="modal_container">
            <ul class="adress_select tab_toggle_menu">
                <li class="active"><span id="region_input_1">시/도</span></li>
                <li><span id="region_input_2">시/군/구</span></li>
                <li><span id="region_input_3">읍/면/동</span></li>
                <li><span id="region_input_4">리</span></li>
            </ul>
            <div class="tab_area_wrap adress_select_wrap  mt20">
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_1" value="Y">
                            <label for="region_1_1">강원도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_2" value="Y">
                            <label for="region_1_2">경기도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_3" value="Y">
                            <label for="region_1_3">경상남도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_4" value="Y">
                            <label for="region_1_4">광주광역시</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_5" value="Y">
                            <label for="region_1_5">대구광역시</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_6" value="Y">
                            <label for="region_1_6">세종특별자치시</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_2" id="region_2_1" value="Y">
                            <label for="region_2_1">강남구</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_2" id="region_2_2" value="Y">
                            <label for="region_2_2">강동구</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_3" id="region_3_1" value="Y">
                            <label for="region_3_1">개포동</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_3" id="region_3_2" value="Y">
                            <label for="region_3_2">논현동</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_4" id="region_4_1" value="Y">
                            <label for="region_4_1">개곡리</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_4" id="region_4_2" value="Y">
                            <label for="region_4_2">개곡리</label>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type="button" class="btn_full_basic btn_point" disabled>검색</button>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_address_search" onclick="modal_close('address_search')"></div>
    <!-- modal 가(임시)주소 검색 : e-->

    <script>
        function onFormSubmit() {
            $('#updateForm').submit();
        }

        //입력란 열고 닫기
        function showDiv(className, index) {
            var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }

        //가(임시)주소 클릭 이벤트
        document.getElementById("temporary_address").addEventListener("change", function() {
            var address_1 = document.querySelector(".detail_address_1");
            var address_2 = document.querySelector(".detail_address_2");
            var search_1 = document.querySelector(".search_address_1");
            var search_2 = document.querySelector(".search_address_2");

            if (this.checked) {
                address_1.style.display = "none";
                address_2.classList.add("active");
                search_1.style.display = "none";
                search_2.classList.add("active");
            } else {
                address_1.style.display = "block";
                address_2.classList.remove("active");
                search_1.style.display = "block";
                search_2.classList.remove("active");
            }
        });

        //가(임시)주소 선택하기
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('label').forEach(function(label) {
                label.addEventListener("click", function() {
                    var index = label.getAttribute("for").split("_")[1]; // 인덱스 추출
                    var regionInputId = "region_input_" + index;
                    var span = document.getElementById(regionInputId);
                    span.textContent = label.textContent; // 클릭된 라벨의 텍스트를 span에 입력
                });
            });
        });
    </script>
</x-layout>
