<div class="filter_dropdown_wrap" id="filterType1">
    <!-- filter 지식산업센터 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">지식산업센터</button>
        <div class="filter_panel panel_item_1">
            <div class="filter_panel_body">
                <h6>매물 종류</h6>
                <ul class="tab_type_3 tab_toggle_menu">
                    <li class="active">상업용</li>
                    <li>주거용</li>
                    <li>분양권</li>
                </ul>
                <div class="tab_area_wrap">
                    <div>
                        <div class="btn_radioType">
                            <input type="radio" name="commercial" id="commercial_1" value="Y">
                            <label for="commercial_1">지식산업센터</label>

                            <input type="radio" name="commercial" id="commercial_2" value="Y">
                            <label for="commercial_2">사무실</label>

                            <input type="radio" name="commercial" id="commercial_3" value="Y">
                            <label for="commercial_3">창고</label>

                            <input type="radio" name="commercial" id="commercial_4" value="Y">
                            <label for="commercial_4">상가</label>

                            <input type="radio" name="commercial" id="commercial_5" value="Y">
                            <label for="commercial_5">건물</label>

                            <input type="radio" name="commercial" id="commercial_6" value="Y">
                            <label for="commercial_6">토지/임야</label>

                            <input type="radio" name="commercial" id="commercial_7" value="Y">
                            <label for="commercial_7">단독 공장</label>
                        </div>
                    </div>
                    <div>
                        <div class="btn_radioType">
                            <input type="radio" name="inhabitation" id="inhabitation_1" value="Y">
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
                            <input type="radio" name="pre_sale" id="pre_sale_1" value="Y">
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
            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>

        </div>
    </div>
    <!-- filter 지식산업센터 : e -->

    <!-- filter 거래유형/가격 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">거래유형/가격</button>
        <div class="filter_panel panel_item_2">
            <div class="filter_panel_body">
                <h6>거래 유형 <span>중복 선택 가능</span></h6>
                <div class="input_type_wrap">
                    <div>
                        <input type="checkbox" name="type" id="type_1">
                        <label for="type_1"><span></span>매매</label>
                    </div>
                    <div>
                        <input type="checkbox" name="type" id="type_2">
                        <label for="type_2"><span></span>전세</label>
                    </div>
                    <div>
                        <input type="checkbox" name="type" id="type_3">
                        <label for="type_3"><span></span>월세</label>
                    </div>
                    <div>
                        <input type="checkbox" name="type" id="type_4">
                        <label for="type_4"><span></span>단기임대</label>
                    </div>
                </div>

                <h6 class="mt20">가격</h6>

                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label>매매가/전세가/보증금</label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="item_1_txt"><span id="item_1_min"></span> ~ <span
                                    id="item_1_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeItem_1"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0</li>
                        <li>100억</li>
                        <li>200억~</li>
                    </ul>
                </div>
                <!-- slider : e -->

            </div>
            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 거래유형/가격 : e -->

    <!-- filter 면적 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">면적</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <div class="filter_tit_2">
                    <h6>면적</h6>
                    <div class="change_unit type_sm toggle_menu">
                        <div class="active">㎡</div>
                        <div class="">평</div>
                    </div>
                </div>
                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label>평</label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="item_1_txt"><span id="item_1_min"></span> ~ <span
                                    id="item_1_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeItem_1"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0 평</li>
                        <li>500평</li>
                        <li>1,000평~</li>
                    </ul>
                </div>
                <!-- slider : e -->
            </div>

            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 면적 : e -->

    <!-- filter 관리비 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">관리비</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <h6>관리비</h6>
                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label>평</label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="item_1_txt"><span id="item_1_min"></span> ~ <span
                                    id="item_1_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeItem_1"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0</li>
                        <li>5년</li>
                        <li>10년~</li>
                    </ul>
                </div>
                <!-- slider : e -->
            </div>
            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 관리비 : e -->

    <!-- filter 사용승인연도 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">사용승인연도</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <h6>사용승인연도</h6>
                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label>평</label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="item_1_txt"><span id="item_1_min"></span> ~ <span
                                    id="item_1_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeItem_1"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0 평</li>
                        <li>500평</li>
                        <li>1,000평~</li>
                    </ul>
                </div>
                <!-- slider : e -->
            </div>
            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 사용승인연도 : e -->

    <!-- filter 융자금 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">융자금 없음</button>
        <div class="filter_panel panel_item_6">
            <div class="filter_panel_body">
                <h6>융자금</h6>
                <div class="btn_radioType">
                    <input type="radio" name="loan" id="loan_1" value="Y">
                    <label for="loan_1">융자금 없음</label>

                    <input type="radio" name="loan" id="loan_2" value="Y">
                    <label for="loan_2">30% 미만</label>

                    <input type="radio" name="loan" id="loan_3" value="Y">
                    <label for="loan_3">30% 이상</label>
                </div>
            </div>
            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 융자금 : s -->

    <!-- filter 권리금 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">권리금</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <h6>권리금</h6>
                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label></label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="item_1_txt"><span id="item_1_min"></span> ~ <span
                                    id="item_1_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeItem_1"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0</li>
                        <li>5천</li>
                        <li>1억~</li>
                    </ul>
                </div>
                <!-- slider : e -->
            </div>

            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 권리금 : e -->

    <!-- filter 업종 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">업종, 휴게음식점, 일반음식점</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <div class="flex_between">
                    <h6>업종</h6>
                    <div class="checkbox_sm_btn">
                        <input type="checkbox" name="checkAll" id="checkAll">
                        <label for="checkAll"><span></span>전체</label>
                    </div>
                </div>

                <div class="point_sm_filter">
                    <div class="cell">
                        <input type="checkbox" name="sector" id="sector_1" value="Y">
                        <label for="sector_1">휴게음식점</label>
                    </div>
                    <div class="cell">
                        <input type="checkbox" name="sector" id="sector_2" value="Y">
                        <label for="sector_2">일반음식점</label>
                    </div>
                    <div class="cell">
                        <input type="checkbox" name="sector" id="sector_3" value="Y">
                        <label for="sector_3">주류점</label>
                    </div>
                    <div class="cell">
                        <input type="checkbox" name="sector" id="sector_4" value="Y">
                        <label for="sector_4">오락스포츠</label>
                    </div>
                    <div class="cell">
                        <input type="checkbox" name="sector" id="sector_5" value="Y">
                        <label for="sector_5">판매업</label>
                    </div>
                    <div class="cell">
                        <input type="checkbox" name="sector" id="sector_6" value="Y">
                        <label for="sector_6">서비스업</label>
                    </div>
                    <div class="cell">
                        <input type="checkbox" name="sector" id="sector_7" value="Y">
                        <label for="sector_7">숙박업</label>
                    </div>
                    <div class="cell">
                        <input type="checkbox" name="sector" id="sector_8" value="Y">
                        <label for="sector_8">기타업종</label>
                    </div>
                </div>
            </div>

            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 업종 : e -->

    <!-- filter 기타 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">기타</button>
        <div class="filter_panel panel_item_6">
            <div class="filter_panel_body">
                <h6>기타 옵션</h6>
                <p class="gray_deep mt18">층고</p>
                <div class="btn_radioType mt10">
                    <input type="radio" name="floor_height" id="floor_height_1" value="Y">
                    <label for="floor_height_1">전체</label>

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
                <p class="gray_deep mt18">사용전력</p>
                <div class="btn_radioType mt10">
                    <input type="radio" name="power" id="power_1" value="Y">
                    <label for="power_1">전체</label>

                    <input type="radio" name="power" id="power_2" value="Y">
                    <label for="power_2">10KW 이하</label>

                    <input type="radio" name="power" id="power_3" value="Y">
                    <label for="power_3">10~25KW</label>

                    <input type="radio" name="power" id="power_4" value="Y">
                    <label for="power_4">25~50KW</label>

                    <input type="radio" name="power" id="power_5" value="Y">
                    <label for="power_5">51~100KW</label>

                    <input type="radio" name="power" id="power_6" value="Y">
                    <label for="power_6">100~1000KW</label>

                    <input type="radio" name="power" id="power_7" value="Y">
                    <label for="power_7">1000KW 이상</label>

                </div>
            </div>
            <div class="filter_panel_bottom">
                <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                <button class="btn_point btn_md_full">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 기타 : s -->
</div>
