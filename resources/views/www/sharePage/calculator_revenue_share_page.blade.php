<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicon.png') }}">

    <!--메타 : 메타 태그만 사용-->
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

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
        <div class="share_tit">
            공실앤톡 수익률 계산서
        </div>

        <div class="share_section">
            <div class="revenue_item">
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
                    $investment_price = $sale_price + $acquisition_tax_price + $etc_price_sum - $loan_price - $price;

                    // 월 순수익
                    $month_revenue_price = $month_price - $month_interest_price;

                    // 연 순수익
                    $revenue_price = $month_revenue_price * 12;

                    // // 수익률
                    // $revenue_rate = ($revenue_price / $investment_price) * 100;

                    // // 실투자금 회수기간
                    // $payback_period = $investment_price / $revenue_price;
                    // 수익률
                    $revenue_rate = $investment_price != 0 ? ($revenue_price / $investment_price) * 100 : 0;

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
                        <span class="txt_point">({{ $loan_ratio }}%)</span>
                    </div>
                    <div class="td">
                        대출금리
                    </div>
                    <div class="td">
                        {{ number_format($loan_interest, 2) }}%
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
                        <span class="txt_point">{{ number_format($investment_price) }}원</span>
                    </div>
                    <div class="td">
                        월순수익
                    </div>
                    <div class="td">
                        <span class="txt_point">{{ number_format($month_revenue_price) }}원</span>
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
                        <span class="txt_point">{{ number_format($revenue_rate, 2) }}%</span>
                    </div>
                    <div class="td">
                        실투자금 회수기간
                    </div>
                    <div class="td">
                        {{ $payback_period > 0 ? number_format($payback_period, 1) : '-' }}년
                    </div>
                </div>
            </div>
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
