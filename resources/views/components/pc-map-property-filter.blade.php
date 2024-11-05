<form id="productFilterForm">
    <input type="hidden" id="product_type" value="">
    <input type="hidden" id="payment_type" value="">
    <input type="hidden" id="temp_price" value="">
    <input type="hidden" id="price" value="">
    <input type="hidden" id="temp_month_price" value="">
    <input type="hidden" id="month_price" value="">
    <input type="hidden" id="temp_area" value="">
    <input type="hidden" id="area" value="">
    <input type="hidden" id="temp_square" value="">
    <input type="hidden" id="square" value="">
    <input type="hidden" id="temp_service_price" value="">
    <input type="hidden" id="service_price" value="">
    <input type="hidden" id="temp_approve_date" value="">
    <input type="hidden" id="approve_date" value="">
    <input type="hidden" id="temp_loan_type" value="">
    <input type="hidden" id="loan_type" value="">
    <input type="hidden" id="temp_premium_price" value="">
    <input type="hidden" id="premium_price" value="">
    <input type="hidden" id="temp_business_type" value="">
    <input type="hidden" id="business_type" value="">
    <input type="hidden" id="temp_floor_height_type" value="">
    <input type="hidden" id="floor_height_type" value="">
    <input type="hidden" id="temp_wattage_type" value="">
    <input type="hidden" id="wattage_type" value="">
</form>

<!-- filter 매물 종류 : s -->
<div class="filter_btn_wrap">
    <button class="filter_btn_trigger" id="filter_text_product_type">매물 종류</button>
    <div class="filter_panel panel_item_1">
        <div class="filter_panel_body">
            <h6 id="product_type_title">매물 종류</h6>
            <ul class="tab_type_3 tab_toggle_menu">
                <li class="active" onclick="productTypeChage(0)">상업용</li>
                <li onclick="productTypeChage(8)" style="display:none">주거용</li>
                <li onclick="productTypeChage(14)">분양권</li>
            </ul>
            <div class="tab_area_wrap">
                <div>
                    <div class="btn_radioType">
                        <input type="radio" name="product_type" id="product_type_0" value="0,1,2" checked>
                        <label
                            for="product_type_0">{{ Lang::get('commons.product_type.' . 0) }}/{{ Lang::get('commons.product_type.' . 1) }}/{{ Lang::get('commons.product_type.' . 2) }}</label>
                        @for ($i = 3; $i < 8; $i++)
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
                onclick="filter_apply('product_type', 0)">적용하기</button>
        </div>
    </div>
</div>
<script>
    function productTypeChage(value) {
        $('input[name="product_type"][value="' + value + '"]').prop('checked', true);
    }
</script>
<!-- filter 매물 종류 : e -->

<!-- filter 거래유형/가격 : s -->
<div class="filter_btn_wrap">
    <button class="filter_btn_trigger" id="filter_text_payment_type_txt">거래유형/가격</button>
    <div class="filter_panel panel_item_2">
        <div class="filter_panel_body">
            <h6 style="display:none" id="payment_type_txt_title">거래유형/가격</h6>
            <h6>거래 유형 <span>중복 선택 가능</span></h6>
            <div class="input_type_wrap">
                <div class="input_type_wrap">
                    <div class="product_payment0">
                        <input type="checkbox" name="payment_type_txt" id="payment_type_0" value="0">
                        <label for="payment_type_0"><span></span>매매</label>
                    </div>
                    <div class="product_payment0">
                        <input type="checkbox" name="payment_type_txt" id="payment_type_1" value="1">
                        <label for="payment_type_1"><span></span>월세</label>
                    </div>
                    <div class="product_payment1">
                        {{-- <input type="checkbox" name="payment_type_txt" id="payment_type_5" value="5">
                        <label for="payment_type_5"><span></span>전매</label> --}}
                    </div>
                    <div class="product_payment0">
                        <input type="checkbox" name="payment_type_txt" id="payment_type_3" value="3">
                        <label for="payment_type_3"><span></span>전세</label>
                    </div>
                    <div class="">
                        {{-- <input type="checkbox" name="payment_type_txt" id="payment_type_4" value="4">
                        <label for="payment_type_4"><span></span>월세</label> --}}
                    </div>
                    <div class="product_payment0">
                        <input type="checkbox" name="payment_type_txt" id="payment_type_2" value="2">
                        <label for="payment_type_2"><span></span>단기임대</label>
                    </div>
                </div>
            </div>

            <h6 class="mt20">가격</h6>

            <!-- slider : s -->
            <div class="range_wrap">
                <div class="slider_between">
                    <label id="price_label">매매가/전세가/보증금</label>
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
        <script>
            function resetPaymentType() {
                $('#price_label').text('매매가/전세가/보증금'); // 기본 라벨 텍스트 설정
                $('#rangeMonthPrice').closest('.range_wrap').show(); // 월세 슬라이더 표시
                $('.product_payment0').show(); // 기본 거래 유형 표시 설정
                $('.product_payment1').hide(); // 추가적인 거래 유형 숨김

                initializeSliders('#rangePrice');
                initializeSliders('#rangeMonthPrice');
            }
            $('input[name="payment_type_txt"]').on('change', function() {
                // 선택된 product_type 값을 가져옵니다.
                var productTypeValue = $('input[name="payment_type_txt"]:checked').val();

                // product_payment0과 product_payment1의 표시 여부를 결정합니다.
                if (productTypeValue > 13) {
                    $('.product_payment0').hide();
                    $('.product_payment1').show();
                } else {
                    $('.product_payment0').show();
                    $('.product_payment1').hide();
                }

            });
            // payment_type이 변경될 때마다 슬라이더 라벨 업데이트
            $('input[name="payment_type_txt"]').on('change', function() {
                // 선택된 payment_type 값을 가져옵니다.
                var paymentTypeValues = $('input[name="payment_type_txt"]:checked').map(function() {
                    return parseInt($(this).val());
                }).get();

                // 체크박스가 모두 해제된 경우 초기 상태로 되돌림
                if (paymentTypeValues.length === 0) {
                    resetPaymentType();
                    return; // 이후 로직을 실행하지 않도록 종료
                }

                // 라벨 텍스트 설정
                // 라벨 텍스트 설정
                var priceLabelText = '';
                var showMonthPriceSlider = paymentTypeValues.some(val => [1, 2, 4].includes(val));

                // 각 paymentTypeValue에 대한 텍스트 매핑
                var labelMap = {
                    0: '매매가',
                    1: '보증금',
                    2: '보증금',
                    3: '전세가',
                    4: '보증금',
                    5: '전매가'
                };

                if (paymentTypeValues.length === 1) {
                    priceLabelText = labelMap[paymentTypeValues[0]];
                } else if (paymentTypeValues.length > 1) {
                    const hasSale = paymentTypeValues.includes(0);
                    const hasJeonse = paymentTypeValues.includes(3);
                    const hasDeposit = paymentTypeValues.some(val => [1, 2, 4].includes(val));
                    const hasTransfer = paymentTypeValues.includes(5);

                    // 여러 가지 조합 처리
                    if (hasSale && hasJeonse && hasDeposit) {
                        priceLabelText = '매매가/전세가/보증금';
                    } else if (hasSale && hasJeonse) {
                        priceLabelText = '매매가/전세가';
                    } else if (hasSale && hasDeposit) {
                        priceLabelText = '매매가/보증금';
                    } else if (hasJeonse && hasDeposit) {
                        priceLabelText = '전세가/보증금';
                    } else if (hasTransfer && hasDeposit) {
                        priceLabelText = '전매가/보증금';
                    }
                }

                // 가격 라벨 업데이트
                if (priceLabelText) {
                    $('#price_label').text(priceLabelText);
                }

                // 월세 슬라이더 표시 여부 결정
                if (showMonthPriceSlider) {
                    $('#rangeMonthPrice').closest('.range_wrap').show();
                } else {
                    $('#rangeMonthPrice').closest('.range_wrap').hide();
                }

            });
        </script>

        <div class="filter_panel_bottom">
            <button type="button" class="btn_graylight_ghost btn_md_full"
                onclick="filter_reset('payment_type_txt')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full"
                onclick="filter_apply('payment_type_txt', 1)">적용하기</button>
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
                <h6 id="area_title">면적</h6>
                <div class="change_unit type_sm toggle_menu areaChage">
                    <div class="active">㎡</div>
                    <div class="">평</div>
                </div>
            </div>
            <!-- slider : s -->
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
            <div class="range_wrap areaSlider" style="display: none;">
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
            <!-- slider : e -->
        </div>

        <script>
            $('.areaChage').on('click', function() {
                // 클릭된 요소의 텍스트를 가져옵니다.
                var selectedUnit = $(this).find('.active').text().trim();

                // 클릭된 단위에 따라 슬라이더를 전환합니다.
                if (selectedUnit === '㎡') {
                    // '㎡'을 선택했을 때
                    $('.areaSlider').hide();
                    $('.squareSlider').show();
                } else {
                    // '평'을 선택했을 때
                    $('.squareSlider').hide();
                    $('.areaSlider').show();
                }
            });
        </script>

        <div class="filter_panel_bottom">
            <button type="button" class="btn_graylight_ghost btn_md_full" onclick="filter_reset('area')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full" onclick="filter_apply('area', 1)">적용하기</button>
        </div>
    </div>
</div>
<!-- filter 면적 : e -->

<!-- filter 관리비 : s -->
<div class="filter_btn_wrap">
    <button class="filter_btn_trigger" id="filter_text_service_price">관리비</button>
    <div class="filter_panel panel_item_3">
        <div class="filter_panel_body">
            <h6 id="service_price_title">관리비</h6>
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
                onclick="filter_reset('service_price')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full"
                onclick="filter_apply('service_price', 1)">적용하기</button>
        </div>
    </div>
</div>
<!-- filter 관리비 : e -->

<!-- filter 사용승인연도 : s -->
<div class="filter_btn_wrap">
    <button class="filter_btn_trigger" id="filter_text_approve_date">사용승인연도</button>
    <div class="filter_panel panel_item_3">
        <div class="filter_panel_body">
            <h6 id="approve_date_title">사용승인연도</h6>
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
                onclick="filter_apply('approve_date', 1)">적용하기</button>
        </div>
    </div>
</div>
<!-- filter 사용승인연도 : e -->

<!-- filter 융자금 : s -->
<div class="filter_btn_wrap">
    <button class="filter_btn_trigger" id="filter_text_loan_type">융자금</button>
    <div class="filter_panel panel_item_6">
        <div class="filter_panel_body">
            <h6 id="loan_type_title">융자금</h6>
            <div class="btn_radioType">
                <input type="radio" name="loan_type" id="loan_type_0" value="0">
                <label for="loan_type_0">융자금 없음</label>

                <input type="radio" name="loan_type" id="loan_type_1" value="1">
                <label for="loan_type_1">30% 미만</label>

                <input type="radio" name="loan_type" id="loan_type_2" value="2">
                <label for="loan_type_2">30% 이상</label>
            </div>
        </div>
        <div class="filter_panel_bottom">
            <button type="button" class="btn_graylight_ghost btn_md_full" onclick="filter_reset('loan_type')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full" onclick="filter_apply('loan_type', 0)">적용하기</button>
        </div>
    </div>
</div>
<!-- filter 융자금 : s -->

<!-- filter 권리금 : s -->
<div class="filter_btn_wrap">
    <button class="filter_btn_trigger" id="filter_text_premium_price">권리금</button>
    <div class="filter_panel panel_item_3">
        <div class="filter_panel_body">
            <h6 id="premium_price_title">권리금</h6>
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
                onclick="filter_reset('premium_price')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full"
                onclick="filter_apply('premium_price', 1)">적용하기</button>
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
                <h6 id="business_type_title">업종</h6>
                <div class="checkbox_sm_btn">
                    <input type="checkbox" name="businessTypeAll" id="businessTypeAll">
                    <label for="businessTypeAll"><span></span>전체</label>
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
                onclick="filter_reset('business_type')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full"
                onclick="filter_apply('business_type')">적용하기</button>
        </div>
    </div>
</div>
<!-- filter 업종 : e -->

<!-- filter 기타 : s -->
<div class="filter_btn_wrap">
    <button class="filter_btn_trigger" id="filter_text_etc">기타</button>
    <div class="filter_panel panel_item_6">
        <div class="filter_panel_body">
            <h6 style="display:none" id="etc_title">기타</h6>
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
            <button type="button" class="btn_graylight_ghost btn_md_full" onclick="filter_reset('etc')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full" onclick="filter_apply('etc')">적용하기</button>
        </div>
    </div>
</div>
<!-- filter 기타 : s -->

<script>
    $('#businessTypeAll').on('change', function() {
        // 전체 체크박스의 상태에 따라 모든 개별 체크박스의 상태를 변경
        $('input[name="business_type"]').prop('checked', this.checked);
    });

    // 개별 체크박스 클릭 시
    $('input[name="business_type"]').on('change', function() {
        // 모든 개별 체크박스가 체크되어 있는지 확인
        var allChecked = $('input[name="business_type"]').length === $('input[name="business_type"]:checked')
            .length;
        // 전체 선택 체크박스의 상태를 모든 체크박스가 체크되어 있는지 여부에 따라 설정
        $('#businessTypeAll').prop('checked', allChecked);
    });
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

    function initializeSliders(sliderId) {
        var sliders = {
            "#rangePrice": {
                minId: "#price_min",
                maxId: "#price_max",
                txtId: "#price_txt",
                valueId: "#temp_price",
                start: [0, 200], // 0 ~ 200억
                range: {
                    "min": 0,
                    "max": 200 // 200억
                },
                unit: "억"
            },
            "#rangeMonthPrice": {
                minId: "#month_price_min",
                maxId: "#month_price_max",
                txtId: "#month_price_txt",
                valueId: "#temp_month_price",
                start: [0, 1000], // 0 ~ 1000만원
                range: {
                    "min": 0,
                    "max": 1000 // 1000만원
                },
                unit: "만"
            },
            "#rangeArea": {
                minId: "#area_min",
                maxId: "#area_max",
                txtId: "#area_txt",
                valueId: "#temp_area",
                start: [0, 1000],
                range: {
                    "min": 0,
                    "max": 1000
                },
                unit: "평"
            },
            "#rangeSquare": {
                minId: "#square_min",
                maxId: "#square_max",
                txtId: "#square_txt",
                valueId: "#temp_square",
                start: [0, 3205],
                range: {
                    "min": 0,
                    "max": 3205
                },
                unit: "㎡"
            },
            "#rangeServicePrice": {
                minId: "#service_price_min",
                maxId: "#service_price_max",
                txtId: "#service_price_txt",
                valueId: "#temp_service_price",
                start: [0, 50],
                range: {
                    "min": 0,
                    "max": 50
                },
                unit: "만"
            },
            "#rangeApproveDate": {
                minId: "#approve_date_min",
                maxId: "#approve_date_max",
                txtId: "#approve_date_txt",
                valueId: "#temp_approve_date",
                start: [0, 10],
                range: {
                    "min": 0,
                    "max": 10
                },
                unit: "년"
            },
            "#rangePremiumPrice": {
                minId: "#premium_price_min",
                maxId: "#premium_price_max",
                txtId: "#premium_price_txt",
                valueId: "#temp_premium_price",
                start: [0, 10000],
                range: {
                    "min": 0,
                    "max": 10000
                },
                unit: "만"
            }
        };

        if (sliderId) {
            initializeSlider(sliderId, sliders[sliderId]);
        } else {
            for (var id in sliders) {
                initializeSlider(id, sliders[id]);
            }
        }
    }

    function initializeSlider(sliderId, slider) {
        var sliderElement = document.querySelector(sliderId);
        var valueMin = document.querySelector(slider.minId);
        var valueMax = document.querySelector(slider.maxId);
        var itemTxt = document.querySelector(slider.txtId);

        if (!sliderElement) {
            console.error('Slider element not found: ' + sliderId);
            return;
        }

        if (sliderElement.noUiSlider) {
            sliderElement.noUiSlider.destroy();
        }

        noUiSlider.create(sliderElement, {
            start: slider.start,
            connect: true,
            range: slider.range,
            format: {
                to: function(value) {
                    return Number(value).toFixed(0); // 단위에 맞게 소수점 제거
                },
                from: function(value) {
                    return Number(value);
                }
            }
        });

        sliderElement.noUiSlider.on("update", function(values, handle) {
            var minValue = values[0];
            var maxValue = values[1];

            if (minValue == slider.range.min && maxValue == slider.range.max) {
                $(slider.valueId).val([slider.range.min, slider.range.max]);
                itemTxt.innerHTML = "전체";
            } else if (minValue == slider.range.min) {
                $(slider.valueId).val([slider.range.min, maxValue]);
                itemTxt.innerHTML =
                    "<span id='kt_slider_basic_min'></span> ~ <span id='kt_slider_basic_max'>" +
                    maxValue +
                    slider.unit + "</span>";
            } else if (maxValue == slider.range.max) {
                $(slider.valueId).val([minValue, slider.range.max]);
                itemTxt.innerHTML = "<span id='kt_slider_basic_min'>" + minValue +
                    slider.unit + "</span> ~ ";
            } else {
                valueMin.innerHTML = minValue + slider.unit;
                valueMax.innerHTML = maxValue + slider.unit;
                $(slider.valueId).val([minValue, maxValue]);
                itemTxt.innerHTML = "<span id='kt_slider_basic_min'>" + minValue +
                    slider.unit + "</span> ~ <span id='kt_slider_basic_max'>" + maxValue +
                    slider.unit + "</span>";
            }
        });

        // 초기 슬라이더 값 업데이트
        sliderElement.noUiSlider.set(slider.start);
    }


    // 슬라이더 초기화 함수 호출
    initializeSliders('');
</script>
