<form id="productFilterForm">
    <input type="hidden" id="product_type" value="">
    <input type="hidden" id="payment_type" value="">
    <input type="hidden" id="area" value="">
    <input type="hidden" id="service_price" value="">
    <input type="hidden" id="approve_date" value="">
    <input type="hidden" id="loan_type" value="">
    <input type="hidden" id="premium_price" value="">
    <input type="hidden" id="business_type" value="">
    <input type="hidden" id="floor_height_type" value="">
    <input type="hidden" id="floor_height_type" value="">
</form>

<div class="filter_dropdown_wrap" id="filterType1">
    <!-- filter 매물 종류 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger" id="filter_text_product_type">매물 종류</button>
        <div class="filter_panel panel_item_1">
            <div class="filter_panel_body">
                <h6 id="product_type_title">매물 종류</h6>
                <ul class="tab_type_3 tab_toggle_menu">
                    <li class="active">상업용</li>
                    <li>주거용</li>
                    <li>분양권</li>
                </ul>
                <div class="tab_area_wrap">
                    <div>
                        <div class="btn_radioType">
                            @for ($i = 0; $i < 8; $i++)
                                <input type="radio" name="product_type" id="product_type_{{ $i }}"
                                    value="{{ $i }}">
                                <label
                                    for="product_type_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                            @endfor
                        </div>
                    </div>
                    <div>
                        <div class="btn_radioType">
                            @for (; $i < 14; $i++)
                                <input type="radio" name="product_type" id="product_type_{{ $i }}"
                                    value="{{ $i }}">
                                <label
                                    for="product_type_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                            @endfor
                        </div>
                    </div>

                    <div>
                        <div class="btn_radioType">
                            @for (; $i < Count(Lang::get('commons.product_type')); $i++)
                                <input type="radio" name="product_type" id="product_type_{{ $i }}"
                                    value="{{ $i }}">
                                <label
                                    for="product_type_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
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
    <!-- filter 매물 종류 : e -->

    <!-- filter 거래유형/가격 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger" id="filter_text_payment_type">거래유형/가격</button>
        <div class="filter_panel panel_item_2">
            <div class="filter_panel_body">
                <h6 style="display:none" id="payment_type_title">거래유형/가격</h6>
                <h6>거래 유형 <span>중복 선택 가능</span></h6>
                <div class="input_type_wrap">
                    <div class="input_type_wrap">
                        <div>
                            <input type="checkbox" name="payment_type" id="payment_type_0" value="0">
                            <label for="payment_type_0"><span></span>매매</label>
                        </div>
                        <div>
                            <input type="checkbox" name="payment_type" id="payment_type_3" value="3">
                            <label for="payment_type_3"><span></span>전세</label>
                        </div>
                        <div>
                            <input type="checkbox" name="payment_type" id="payment_type_4" value="4">
                            <label for="payment_type_4"><span></span>월세</label>
                        </div>
                        <div>
                            <input type="checkbox" name="payment_type" id="payment_type_2" value="2">
                            <label for="payment_type_2"><span></span>단기임대</label>
                        </div>
                    </div>
                </div>

                <h6 class="mt20">가격</h6>

                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label>매매가/전세가/보증금</label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="price_txt"><span id="price_min"></span> ~ <span
                                    id="price_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangePrice"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0</li>
                        <li>100억</li>
                        <li>200억~</li>
                    </ul>
                </div>
                <div class="range_wrap">
                    <div class="slider_between">
                        <label>월임대료</label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="month_price_txt"><span id="month_price_min"></span> ~
                                <span id="month_price_max"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeMonthPrice"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0</li>
                        <li>500만</li>
                        <li>1000만~</li>
                    </ul>
                </div>
                <!-- slider : e -->

            </div>
            <div class="filter_panel_bottom">
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('payment_type')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('payment_type')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 거래유형/가격 : e -->

    <!-- filter 면적 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger" id="filter_text_area">면적</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <div class="filter_tit_2">
                    <h6>면적</h6>
                    <div class="change_unit type_sm toggle_menu areaChage">
                        <div class="active">㎡</div>
                        <div class="">평</div>
                    </div>
                </div>
                <!-- slider : s -->
                <div class="range_wrap areaSlider">
                    <div class="slider_between">
                        <label>평</label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="area_txt"><span id="area_min"></span> ~ <span
                                    id="area_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeArea"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0 평</li>
                        <li>500평</li>
                        <li>1,000평~</li>
                    </ul>
                </div>
                <div class="range_wrap squareSlider">
                    <div class="slider_between">
                        <label>㎡</label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="square_txt"><span id="square_min"></span> ~ <span
                                    id="square_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeSquare"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0 ㎡</li>
                        <li>1652㎡</li>
                        <li>3205㎡~</li>
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
        <button class="filter_btn_trigger" id="filter_text_service_price">관리비</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <h6>관리비</h6>
                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label></label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="service_price_txt"><span id="service_price_min"></span>
                                ~ <span id="service_price_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeServicePrice"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0</li>
                        <li>25만</li>
                        <li>50만~</li>
                    </ul>
                </div>
                <!-- slider : e -->
            </div>
            <div class="filter_panel_bottom">
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('area')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('area')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 관리비 : e -->

    <!-- filter 사용승인연도 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger" id="filter_text_approve_date">사용승인연도</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <h6>사용승인연도</h6>
                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label></label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="approve_date_txt"><span id="approve_date_min"></span> ~
                                <span id="approve_date_max"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangeApproveDate"></div>
                    </div>
                    <ul class="range_txt">
                        <li>0</li>
                        <li>5년</li>
                        <li>10년</li>
                    </ul>
                </div>
                <!-- slider : e -->
            </div>
            <div class="filter_panel_bottom">
                <button type="button" class="btn_graylight_ghost btn_md_full"
                    onclick="filter_reset('approve_date')"><img
                        src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
                <button type="button" class="btn_point btn_md_full"
                    onclick="filter_apply('approve_date')">적용하기</button>
            </div>
        </div>
    </div>
    <!-- filter 사용승인연도 : e -->

    <!-- filter 융자금 : s -->
    <div class="filter_btn_wrap">
        <button class="filter_btn_trigger" id="filter_text_loan_type">융자금</button>
        <div class="filter_panel panel_item_6">
            <div class="filter_panel_body">
                <h6>융자금</h6>
                <div class="btn_radioType">
                    <input type="radio" name="loan_type_type" id="loan_type_type_0" value="0">
                    <label for="loan_type_type_0">융자금 없음</label>

                    <input type="radio" name="loan_type_type" id="loan_type_type_1" value="1">
                    <label for="loan_type_type_1">30% 미만</label>

                    <input type="radio" name="loan_type_type" id="loan_type_type_2" value="2">
                    <label for="loan_type_type_2">30% 이상</label>
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
        <button class="filter_btn_trigger" id="filter_text_premium_price">권리금</button>
        <div class="filter_panel panel_item_3">
            <div class="filter_panel_body">
                <h6>권리금</h6>
                <!-- slider : s -->
                <div class="range_wrap">
                    <div class="slider_between">
                        <label></label>
                        <div class="pt-5">
                            <div class="fw-semibold mb-2" id="premium_price_txt"><span id="premium_price_min"></span>
                                ~ <span id="premium_price_max"></span></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div id="rangePremiumPrice"></div>
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
        <button class="filter_btn_trigger" id="filter_text_business_type">업종</button>
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
                    @foreach (Lang::get('commons.product_business_type') as $index => $type)
                        <div class="cell">
                            <input type="checkbox" name="business_type" id="business_type_{{ $index }}"
                                value="{{ $index }}">
                            <label for="business_type_{{ $index }}">{{ $type }}</label>
                        </div>
                    @endforeach
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
        <button class="filter_btn_trigger" id="filter_text_etc">기타</button>
        <div class="filter_panel panel_item_6">
            <div class="filter_panel_body">
                <h6>기타 옵션</h6>
                <p class="gray_deep mt18">층고</p>
                <div class="btn_radioType mt10">
                    <input type="radio" name="floor_height_type" id="floor_height_type_" value="" checked>
                    <label for="floor_height_type_">전체</label>
                    @foreach (Lang::get('commons.floor_height_type') as $index => $type)
                        <input type="radio" name="floor_height_type" id="floor_height_type_{{ $index }}"
                            value="{{ $index }}">
                        <label for="floor_height_type_{{ $index }}">{{ $type }}</label>
                    @endforeach
                </div>
                <p class="gray_deep mt18">사용전력</p>
                <div class="btn_radioType mt10">
                    <input type="radio" name="wattage_type" id="wattage_type_" value="" checked>
                    <label for="wattage_type_">전체</label>
                    @foreach (Lang::get('commons.wattage_type') as $index => $type)
                        <input type="radio" name="wattage_type" id="wattage_type_{{ $index }}"
                            value="{{ $index }}">
                        <label for="wattage_type_{{ $index }}">{{ $type }}</label>
                    @endforeach
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


    function initializeSliders() {
        var sliders = [{
                sliderId: "#rangePrice",
                minId: "#price_min",
                maxId: "#price_max",
                txtId: "#price_txt",
                start: [0, 200], // 0 ~ 200억
                range: {
                    "min": 0,
                    "max": 200 // 200억
                },
                unit: "억",
                format: {
                    to: function(value) {
                        return Number(value).toFixed(0); // 억 단위로 소수점 제거
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            }, {
                sliderId: "#rangeMonthPrice",
                minId: "#month_price_min",
                maxId: "#month_price_max",
                txtId: "#month_price_txt",
                start: [0, 1000], // 0 ~ 1000만원
                range: {
                    "min": 0,
                    "max": 1000 // 1000만원
                },
                unit: "만",
                format: {
                    to: function(value) {
                        return Number(value).toFixed(0); // 억 단위로 소수점 제거
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            },
            {
                sliderId: "#rangeArea",
                minId: "#area_min",
                maxId: "#area_max",
                txtId: "#area_txt",
                start: [0, 1000],
                range: {
                    "min": 0,
                    "max": 1000
                },
                unit: "평",
                format: {
                    to: function(value) {
                        return Number(value).toFixed(0);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            },
            {
                sliderId: "#rangeSquare",
                minId: "#square_min",
                maxId: "#square_max",
                txtId: "#square_txt",
                start: [0, 3205],
                range: {
                    "min": 0,
                    "max": 3205
                },
                unit: "㎡",
                format: {
                    to: function(value) {
                        return Number(value).toFixed(0);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            },
            {
                sliderId: "#rangeServicePrice",
                minId: "#service_price_min",
                maxId: "#service_price_max",
                txtId: "#service_price_txt",
                start: [0, 50],
                range: {
                    "min": 0,
                    "max": 50
                },
                unit: "만",
                format: {
                    to: function(value) {
                        return Number(value).toFixed(0);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            },
            {
                sliderId: "#rangeApproveDate",
                minId: "#approve_date_min",
                maxId: "#approve_date_max",
                txtId: "#approve_date_txt",
                start: [0, 10],
                range: {
                    "min": 0,
                    "max": 10
                },
                unit: "년",
                format: {
                    to: function(value) {
                        return Number(value).toFixed(0);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            },
            {
                sliderId: "#rangePremiumPrice",
                minId: "#premium_price_min",
                maxId: "#premium_price_max",
                txtId: "#premium_price_txt",
                start: [0, 10000],
                range: {
                    "min": 0,
                    "max": 10000
                },
                unit: "천",
                format: {
                    to: function(value) {
                        return Number(value).toFixed(0);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            },
        ];

        sliders.forEach(function(slider) {
            var sliderElement = document.querySelector(slider.sliderId);
            var valueMin = document.querySelector(slider.minId);
            var valueMax = document.querySelector(slider.maxId);
            var itemTxt = document.querySelector(slider.txtId);

            if (!sliderElement) {
                console.error('Slider element not found: ' + slider.sliderId);
                return;
            }

            noUiSlider.create(sliderElement, {
                start: slider.start,
                connect: true,
                range: slider.range,
                format: slider.format
            });

            sliderElement.noUiSlider.on("update", function(values, handle) {
                var minValue = slider.format.to(values[0]);
                var maxValue = slider.format.to(values[1]);

                if (minValue == slider.range.min && maxValue == slider.range.max) {
                    itemTxt.innerHTML = "전체";
                } else {
                    valueMin.innerHTML = minValue + slider.unit;
                    valueMax.innerHTML = maxValue + slider.unit;
                    itemTxt.innerHTML = "<span id='kt_slider_basic_min'>" + minValue +
                        slider.unit + "</span> ~ <span id='kt_slider_basic_max'>" + maxValue + slider
                        .unit + "</span>";
                }
            });


            // 초기 슬라이더 값 업데이트
            sliderElement.noUiSlider.set(slider.start);
        });
    }


    // 슬라이더 초기화 함수 호출
    initializeSliders();
</script>
