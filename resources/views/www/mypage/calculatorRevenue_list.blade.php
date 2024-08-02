<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">마이메뉴</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">수익률 계산기</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5">
                            <li class="active"
                                onclick="location.href='{{ route('www.mypage.calculator.revenue.list.view') }}'">
                                수익률 계산
                            </li>
                            <li onclick="location.href='{{ route('www.mypage.calculator.loan.list.view') }}'">
                                대출이자 계산
                            </li>
                        </ul>
                    </div>

                    <div class="calculator_btn_wrap">
                        <div class="txt_info">
                            본 계산기는 월 단위로 계산되었으므로, 실제 대출 시작 일자의 일할 계산에 따라 차이가 있을 수 있습니다. <br>
                            상세한 계산을 위해서는 전문 계산기를 이용해주세요.
                        </div>
                        <button class="btn_point btn_basic" onclick="modal_open('rev_calculator')">수익률 계산기</button>
                    </div>

                    <div class="calculator_container">
                        <!-- 계산서 : s -->
                        @foreach ($result_calculator as $index => $calculator)
                            <div class="revenue_item">
                                <div class="item_tit_wrap">
                                    <h4>공실앤톡 수익률 계산서 {{ $index + 1 }}</h4>
                                    <div class="btn_area">
                                        <button class="btn_graylight_ghost btn_sm">공유</button>
                                        <form class="form" method="POST"
                                            action="{{ route('www.calculator.revenue.delete') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $calculator->id }}" />
                                            <button class="btn_graylight_ghost btn_sm">삭제</button>
                                        </form>
                                    </div>
                                </div>
                                @php

                                    $sale_price = $calculator->sale_price;
                                    $acquisition_tax = $calculator->acquisition_tax;
                                    $tax_price = $calculator->tax_price ?? 0;
                                    $commission = $calculator->commission ?? 0;
                                    $etc_price = $calculator->etc_price ?? 0;
                                    $price = $calculator->price ?? 0;
                                    $month_price = $calculator->month_price ?? 0;
                                    $loan_ratio = $calculator->loan_ratio ?? 0;
                                    $loan_interest = $calculator->loan_interest ?? 0;

                                    // 취득세
                                    $acquisition_tax_price = $sale_price * ($acquisition_tax / 100);

                                    // 기타비용
                                    $etc_price_sum = $tax_price + $commission + $etc_price;

                                    // 대출금
                                    $loan_price = $sale_price * ($loan_ratio / 100);

                                    // 월 이자 상환액
                                    $month_interest_price = ($loan_price * ($loan_interest / 100)) / 12;

                                    // 실투자금
                                    $investment_price =
                                        $sale_price + $acquisition_tax_price + $etc_price_sum - $loan_price - $price;

                                    // 월 순수익
                                    $month_revenue_price = $month_price - $month_interest_price;

                                    // 연 순수익
                                    $revenue_price = $month_revenue_price * 12;

                                    // // 수익률
                                    // $revenue_rate = ($revenue_price / $investment_price) * 100;

                                    // // 실투자금 회수기간
                                    // $payback_period = $investment_price / $revenue_price;
                                    // 수익률
                                    $revenue_rate =
                                        $investment_price != 0 ? ($revenue_price / $investment_price) * 100 : 0;

                                    // 실투자금 회수기간
                                    $payback_period = $revenue_price != 0 ? $investment_price / $revenue_price : 0;
                                @endphp
                                <div class="table_container columns_2 mt18">
                                    <div class="td">매매/분양가</div>
                                    <div class="td">
                                        {{ number_format($sale_price) }}원
                                    </div>
                                    <div class="td">
                                        취득세
                                    </div>
                                    <div class="td">
                                        {{ number_format($acquisition_tax_price) }}원
                                        <span class="txt_point">({{ $acquisition_tax }}%)</span>
                                    </div>
                                    <div class="td">
                                        기타비용
                                    </div>
                                    <div class="td">
                                        {{ number_format($etc_price_sum) }}원
                                    </div>
                                    <div class="td">
                                        대출금
                                    </div>
                                    <div class="td">
                                        {{ number_format($loan_price) }}원
                                        <span class="txt_point">({{ $loan_interest }}%)</span>
                                    </div>
                                    <div class="td">
                                        월 이자 상환액
                                    </div>
                                    <div class="td">
                                        {{ number_format($month_interest_price) }}원
                                    </div>
                                    <div class="td">
                                        보증금
                                    </div>
                                    <div class="td">
                                        {{ number_format($price) }}원
                                    </div>
                                    <div class="td">
                                        월임대료
                                    </div>
                                    <div class="td">
                                        {{ number_format($month_price) }}원
                                    </div>
                                    <div class="td">
                                        실투자금
                                    </div>
                                    <div class="td">
                                        {{ number_format($investment_price) }}원
                                    </div>
                                    <div class="td">
                                        월순수익
                                    </div>
                                    <div class="td">
                                        {{ number_format($month_revenue_price) }}원
                                    </div>
                                    <div class="td">
                                        연순수익
                                    </div>
                                    <div class="td">
                                        {{ number_format($revenue_price) }}원
                                    </div>
                                    <div class="td">
                                        수익률
                                    </div>
                                    <div class="td">
                                        {{ number_format($revenue_rate, 2) }}%
                                    </div>
                                    <div class="td">
                                        실투자금 회수기간
                                    </div>
                                    <div class="td">
                                        {{ number_format($payback_period, 1) }}년
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- 계산서 : e -->

                        <!-- 계산서 : s -->
                        {{-- <div class="revenue_item">
                            <div class="item_tit_wrap">
                                <h4>공실앤톡 수익률 계산서 2</h4>
                                <div class="btn_area">
                                    <button class="btn_graylight_ghost btn_sm">공유</button>
                                    <button class="btn_graylight_ghost btn_sm">삭제</button>
                                </div>
                            </div>
                            <div class="table_container columns_2 mt18">
                                <div class="td">매매/분양가</div>
                                <div class="td">100,000,000원</div>
                                <div class="td">취득세</div>
                                <div class="td">46,000,000원<span class="txt_point">(4.60%)</span></div>
                                <div class="td">기타비용</div>
                                <div class="td">5,000,000원</div>
                                <div class="td">대출금</div>
                                <div class="td">70,500,000원<span class="txt_point">(5.00%)</span></div>
                                <div class="td">월 이자 상환액</div>
                                <div class="td">291,667원</div>
                                <div class="td">보증금</div>
                                <div class="td">5,000,000원</div>
                                <div class="td">월임대료</div>
                                <div class="td">500,000원</div>
                                <div class="td">실투자금</div>
                                <div class="td">29,000,000원</div>
                                <div class="td">월순수익</div>
                                <div class="td">208,333원</div>
                                <div class="td">연순수익</div>
                                <div class="td">2,500,000원</div>
                                <div class="td">수익률</div>
                                <div class="td">8.45%</div>
                                <div class="td">실투자금 회수기간</div>
                                <div class="td">6.4개월</div>
                            </div>
                        </div> --}}
                        <!-- 계산서 : e -->
                    </div>
                </div>
                <!-- my_body : e -->

            </div>

            <!-- modal 계산기 : s -->
            <div class="modal modal_mid modal_rev_calculator">
                <div class="modal_title">
                    <h5>수익률 계산기</h5>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                        onclick="modal_close('rev_calculator')">
                </div>
                <div class="modal_container">
                    <div class="gray_basic txt_lh_1">
                        노후 시설 수리비, 감가상각비 등 관련사항을 충분히 고려하신 후 산정하시는 것을 권장합니다.
                    </div>
                </div>
                <form class="form" id="revenueForm" method="POST"
                    action="{{ route('www.calculator.revenue.create') }}">
                    @csrf
                    <div class="md_inner_scroll">

                        <ul class="reg_bascic mt18">
                            <li>
                                <label>매매/분양가<span class="gray_basic">(부가세 제외) </span> <span>*</span></label>
                                <div class="flex_1">
                                    <input type="number" class="input_check" name="sale_price"
                                        oninput="onlyNumbers(this); onTextChangeEvent(this);" onfocus="toggleInputType(this)"
                                        onblur="toggleInputType(this);">
                                    <span>원</span>
                                </div>
                            </li>
                            <li>
                                <label>취득세율 <span>*</span></label>
                                <div class="flex_1">
                                    <input type="number" class="input_check" name="acquisition_tax"
                                        onfocus="toggleInputTypeImsi(this)" onblur="toggleInputTypeImsi(this);"
                                        oninput="imsi(this)">
                                    <span>%</span>
                                </div>
                            </li>
                            <li>
                                <label>세무비용</label>
                                <div class="flex_1">
                                    <input type="number" class="" name="tax_price" oninput="onlyNumbers(this)"
                                        onfocus="toggleInputType(this)"
                                        onblur="toggleInputType(this);onTextChangeEvent(this);">
                                    <span>원</span>
                                </div>
                            </li>
                            <li>
                                <label>중개보수</label>
                                <div class="flex_1">
                                    <input type="number" class="" name="commission" oninput="onlyNumbers(this)"
                                        onfocus="toggleInputType(this)"
                                        onblur="toggleInputType(this);onTextChangeEvent(this);">
                                    <span>원</span>
                                </div>
                            </li>
                            <li>
                                <label>기타비용</label>
                                <div class="flex_1">
                                    <input type="number" class="" name="etc_price"
                                        oninput="onlyNumbers(this)" onfocus="toggleInputType(this)"
                                        onblur="toggleInputType(this);onTextChangeEvent(this);">
                                    <span>원</span>
                                </div>
                            </li>
                            <li>
                                <div class="btn_half_wrap">
                                    <div>
                                        <label>보증금</label>
                                        <div class="flex_1">
                                            <input type="number" class="" name="price"
                                                oninput="onlyNumbers(this)" onfocus="toggleInputType(this)"
                                                onblur="toggleInputType(this);onTextChangeEvent(this);">
                                            <span>/</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label>월임대료</label>
                                        <div class="flex_1">
                                            <input type="number" class="" name="month_price"
                                                oninput="onlyNumbers(this)" onfocus="toggleInputType(this)"
                                                onblur="toggleInputType(this);onTextChangeEvent(this);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <label>대출비율<span class="gray_basic">(매매 또는 분양가 기준) </span></label>
                                <div class="flex_1">
                                    <input type="number" class="" max="100" placeholder="0 ~ 100 사이값 입력"
                                        onfocus="toggleInputTypeImsi(this)" onblur="toggleInputTypeImsi(this);"
                                        name="loan_ratio" oninput="validateInput(this, 100); onlyNumbers(this)">
                                    <span>%</span>
                                </div>
                            </li>
                            <li>
                                <label>대출금리</label>
                                <div class="flex_1">
                                    <input type="number" class="" onfocus="toggleInputTypeImsi(this)"
                                        onblur="toggleInputTypeImsi(this);" oninput="imsi(this)"
                                        placeholder="소수점 두자리까지 입력" name="loan_interest">
                                    <span>%</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="modal_container">
                        <button type="button" class="btn_point btn_full_basic confirm" onclick="submitForm()"
                            disabled><b>수익률 계산하기</b></button>
                    </div>

                </form>

            </div>
            <div class="md_overlay md_overlay_rev_calculator" onclick="modal_close('rev_calculator')"></div>
            <!-- modal 계산기 : e -->

        </div>

    </div>

</x-layout>

<script>
    // 폼 제출 함수
    function submitForm() {
        document.getElementById('revenueForm').submit();
    }

    $('.input_check').on("keyup", function() {
        let allFilled = true;
        $('.input_check').each(function() {
            if ($(this).val().trim() === '') {
                allFilled = false;
                return false; // break out of the loop
            }
        });
        if (allFilled) {
            $('.confirm').attr("disabled", false);
        } else {
            $('.confirm').attr("disabled", true);
        }
    });
</script>

<div>
    <label for="amount1">금액 입력 1:</label>
    <input type="text" id="amount1" inputmode="numeric" pattern="[0-9]*" placeholder="금액을 입력하세요">
</div>
<div>
    <label for="amount2">금액 입력 2:</label>
    <input type="text" id="amount2" inputmode="numeric" pattern="[0-9]*" placeholder="금액을 입력하세요">
</div>
<script>
    $(document).ready(function() {
        function setupCurrencyInputHandlers(selector) {
            $(selector).on('input', function() {
                let value = $(this).val().replace(/,/g, '');

                if (isNaN(value)) {
                    $(this).val('');
                    return;
                }

                value = parseInt(value, 10).toLocaleString();
                $(this).val(value);
            });

            $(selector).on('focus', function() {
                $(this).attr('type', 'number');
            });

            $(selector).on('blur', function() {
                $(this).attr('type', 'text');
                let value = $(this).val().replace(/,/g, '');

                if (isNaN(value)) {
                    $(this).val('');
                    return;
                }

                value = parseInt(value, 10).toLocaleString();
                $(this).val(value);
            });
        }

        // 원하는 입력란에 대해 함수를 호출합니다.
        setupCurrencyInputHandlers('#amount1');
        setupCurrencyInputHandlers('#amount2');
    });
</script>
