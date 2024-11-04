<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicon.png') }}">

    <!--메타 : 메타 태그만 사용-->
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">

    <!--내부 기본 CSS : 내부에서 생성한 CSS만 사용-->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/external.css') }}">

    <!--외부 CSS : 외부 모듈에서 제공된 CSS만 사용-->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--내부 기본 JS : 내부에서 생성한 JS 경우만 사용 하며. 이를 사용하기 위한 라이브러만사용(jquery.js) -->
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>

    <!--외부 JS : 외부 모듈에서 제공된 JS만 사용-->
    <script src="{{ asset('assets/js/swiper.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/proj4.js') }}"></script>
    <script src="{{ asset('assets/external_js/html2canvas.js') }}"></script>

    <script src="{{ asset('assets/js/scroll_page.js') }}"></script>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>

    {{-- 지도 관련 api --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script type="text/javascript"
        src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
    </script>
</head>

@inject('carbon', 'Carbon\Carbon')

<body style="margin: 0;">

    <div class="share_body">
        @php
            $title = '';
            switch ($loan->type) {
                case 0:
                    $title = '원금균등분할';
                    break;
                case 1:
                    $title = '원리금균등분할';
                    break;
                case 2:
                    $title = '만기일시';
                    break;

                default:
                    $title = '원금균등분할';
                    break;
            }
        @endphp
        <div class=" share_tit  item_tit_wrap">
            <h4>대출이자 <span> {{ $title }} </span> 계산서</h4>
        </div>

        <div class="share_section">
            <div class="loan_item">
                <div class="table_container columns_2">
                    <div class="td">대출금액</div>
                    <div class="td">{{ number_format($loan->loan_price) }}원</div>

                    @if ($loan->type != 2)
                        <div class="td">대출기간</div>
                        <div class="td">{{ $loan->loan_month }}개월
                            @if ($loan->holding_month != '')
                                <span class="gray_basic">거치기간 {{ $loan->holding_month }}개월</span>
                            @endif
                        </div>
                        @if ($loan->type != 0)
                            <div class="td">월상환금액</div>
                            <div class="td" id="repayment_price_{{ $loan->id }}"></div>
                        @endif
                    @else
                        <div class="td">상환기간</div>
                        <div class="td">{{ $loan->loan_month }}개월</div>
                    @endif

                    <div class="td">총 이자액</div>
                    <div class="td" id="total_loan_price_{{ $loan->id }}">
                        <span class="txt_point"> (금리{{ $loan->loan_rate }}%)</span>
                    </div>
                    <div class="td">총 상환금액</div>
                    <div class="td" id="total_repayment_price_{{ $loan->id }}">
                    </div>
                </div>

                <div class="flex_between mt20">
                    <h4>상환 스케줄 </h4>
                    <div class="fs_13 gray_basic">(단위 : 원)</div>
                </div>

                <div class="repayment_schedule_wrap">
                    @php
                        $payment_price = 0;
                        $month_payment_price = 0;
                        $one_loan_price = 0;

                        $loan_price = $loan->loan_price; // 잔금
                        $balance = $loan->loan_price; // 잔금 계산
                        $loan_month = $loan->loan_month;
                        $loan_rate = $loan->loan_rate / 100;
                        $type = $loan->type;

                        $total_loan_price = 0;
                    @endphp
                    @for ($i = 1; $i <= $loan_month; $i++)
                        @php
                            if ($type == 0) {
                                if ($loan->holding_month != '' && $i <= $loan->holding_month) {
                                    $payment_price = 0;
                                } else {
                                    $payment_price = $loan_price / ($loan_month - $loan->holding_month);
                                }

                                $loan_month_price =
                                    (($loan_price - ($i - $loan->holding_month - 1) * $payment_price) * $loan_rate) /
                                    12;

                                $month_price = $payment_price + $loan_month_price;
                            } elseif ($type == 1) {
                                if ($loan->holding_month != '' && $i <= $loan->holding_month) {
                                    // 거치기간 동안
                                    $payment_price = 0;
                                    $loan_month_price = ($loan_price * $loan_rate) / 12;
                                    $month_price = $loan_month_price;
                                } else {
                                    if ($i == $loan->holding_month + 1) {
                                        // 거치기간 후 첫 달
                                        $one_loan_price =
                                            $loan_price *
                                            calculate_mortgage_constant($loan_rate, $loan_month - $loan->holding_month);
                                        $month_price = $one_loan_price;
                                    }

                                    // 거치기간 후 모든 달
                                    $loan_month_price = ($balance * $loan_rate) / 12;
                                    $payment_price = $month_price - $loan_month_price;
                                }
                            } elseif ($type == 2) {
                                if ($i == $loan_month) {
                                    $payment_price = $loan_price;
                                }
                                $loan_month_price = ($loan_price * $loan_rate) / 12;

                                $month_price = $loan_month_price + $payment_price;
                            }

                            $balance -= $payment_price;
                            $total_loan_price += $loan_month_price;
                        @endphp

                        <div class="repayment_schedule_item">
                            <div class="schedule_tit_tiem">
                                <span>{{ $i }}회차</span>
                                <span>잔금 : {{ number_format($balance) }}</span>
                            </div>
                            <table class="repayment_table">
                                <tr>
                                    <th>월상환금</th>
                                    <th>납입원금</th>
                                    <th>이자액</th>
                                </tr>
                                <tr>
                                    <td>{{ number_format($month_price) }}</td>
                                    <td>{{ number_format($payment_price) }}</td>
                                    <td>{{ number_format($loan_month_price) }}</td>
                                </tr>
                            </table>
                        </div>
                    @endfor
                    <script>
                        $('#repayment_price_{{ $loan->id }}').text('{{ number_format($month_price) }}원')
                        $('#total_loan_price_{{ $loan->id }}').html(
                            `{{ number_format($total_loan_price) }}원<span class="txt_point"> (금리{{ $loan->loan_rate }}%)</span>`)
                        $('#total_repayment_price_{{ $loan->id }}').text(
                            '{{ number_format($total_loan_price + $loan->loan_price) }}원')
                    </script>
                </div>
            </div>
            <!-- 계산서 : e -->
        </div>

        <div class="share_btn_floting">
            <button class="btn_point btn_full_basic" onclick="location.href='{{ env('APP_URL') }}'">공실앤톡 사이트
                방문하기</button>
        </div>

        <div class="my_inner_wrap">
            <div class="my_wrap">
            </div>
        </div>

    </div>
</body>

<script></script>
