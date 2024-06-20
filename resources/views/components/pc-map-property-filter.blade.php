<div class="filter_dropdown_wrap" id="filterType1">
    <!-- filter 지식산업센터 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger" id="filter_text_product_type">매물 종류</button>
        <input type="hidden" id="product" value="">
        <div class="filter_panel panel_item_1">
            <div class="filter_panel_body">
                <h6 id="productTitle">매물 종류</h6>
                <ul class="tab_type_3 tab_toggle_menu">
                    <li class="active">상업용</li>
                    <li>주거용</li>
                    <li>분양권</li>
                </ul>
                <div class="tab_area_wrap">
                    <div>
                        <div class="btn_radioType">
                            @for ($i = 0; $i < 8; $i++)
                                <input type="radio" name="product" id="product_{{ $i }}"
                                    value="{{ $i }}">
                                <label
                                    for="product_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                            @endfor
                        </div>
                    </div>
                    <div>
                        <div class="btn_radioType">
                            @for (; $i < 14; $i++)
                                <input type="radio" name="product" id="product_{{ $i }}"
                                    value="{{ $i }}">
                                <label
                                    for="product_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <div class="btn_radioType">
                            @for (; $i < Count(Lang::get('commons.product_type')); $i++)
                                <input type="radio" name="product" id="product_{{ $i }}"
                                    value="{{ $i }}">
                                <label
                                    for="product_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter_panel_bottom">
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('product_type')">적용하기</button>
            </div>

        </div>
    </div>
    <!-- filter 지식산업센터 : e -->

    <!-- filter 거래유형/가격 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">거래유형/가격</button>
        <input type="hidden" id="payment_type" value="">
        <div class="filter_panel panel_item_2">
            <div class="filter_panel_body">
                <h6>거래 유형 <span>중복 선택 가능</span></h6>
                <div class="input_type_wrap">
                    @foreach (Lang::get('commons.payment_type') as $index => $payment)
                        <div>
                            <input type="checkbox" name="payment_type" id="payment_type_{{ $index }}">
                            <label for="payment_type_{{ $index }}"><span></span>{{ $payment }}</label>
                        </div>
                    @endforeach
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
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('sale_product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('sale_product_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 거래유형/가격 : e -->

    <!-- filter 면적 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">면적</button>
        <input type="hidden" id="product" value="">
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
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('sale_product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('sale_product_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 면적 : e -->

    <!-- filter 관리비 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">관리비</button>
        <input type="hidden" id="product" value="">
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
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('sale_product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('sale_product_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 관리비 : e -->

    <!-- filter 사용승인연도 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">사용승인연도</button>
        <input type="hidden" id="product" value="">
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
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('sale_product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('sale_product_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 사용승인연도 : e -->

    <!-- filter 융자금 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">융자금</button>
        <input type="hidden" id="product" value="">
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
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('sale_product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('sale_product_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 융자금 : s -->

    <!-- filter 권리금 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">권리금</button>
        <input type="hidden" id="product" value="">
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
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('sale_product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('sale_product_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 권리금 : e -->

    <!-- filter 업종 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">업종</button>
        <input type="hidden" id="product" value="">
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
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('sale_product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('sale_product_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 업종 : e -->

    <!-- filter 기타 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger">기타</button>
        <input type="hidden" id="product" value="">
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
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('sale_product_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('sale_product_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 기타 : s -->
</div>

<script>
    // 필터 열기
    const filterBtns = document.querySelectorAll('.filter_btn_trigger');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function(event) {
            const parent = this.parentElement;
            const panel = parent.querySelector('.filter_panel');

            document.querySelectorAll('.filter_panel').forEach(p => {
                if (p !== panel && p.style.display === 'block') {
                    p.style.display = 'none';
                }
            });
            panel.style.display = (panel.style.display === 'block') ? 'none' : 'block';
            event.stopPropagation();
        });
    });

    document.addEventListener('click', function(event) {
        const isOutsideFilterPanel = !event.target.closest('.filter_panel');
        if (isOutsideFilterPanel) {
            document.querySelectorAll('.filter_panel').forEach(p => {
                p.style.display = 'none';
            });
        }
    });

    var slider = document.querySelector("#rangeItem_1");
    var valueMin = document.querySelector("#item_1_min");
    var valueMax = document.querySelector("#item_1_max");
    var item1txt = document.querySelector("#item_1_txt");

    noUiSlider.create(slider, {
        start: [0, 100],
        connect: true,
        range: {
            "min": 0,
            "max": 100
        }
    });

    slider.noUiSlider.on("update", function(values, handle) {
        if (values[0] < 0 || values[1] > 99) {
            item1txt.innerHTML = "전체";
        } else {
            valueMin.innerHTML = values[0];
            valueMax.innerHTML = values[1];
            item1txt.innerHTML = "<span id='kt_slider_basic_min'>" + values[0] +
                "원</span> ~ <span id='kt_slider_basic_max'>" + values[1] + "원</span>";
        }
    });
</script>
