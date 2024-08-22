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

    <div class="share_tit">
        공실앤톡
    </div>

    <div class="proposal_type_wrap">
        <!-- tab : s -->
        <div class="swiper proposal_type_tab" style="display: {{ $is_type == 1 ? '' : 'none' }}">
            <div class="swiper-wrapper">
                <div class="swiper-slide btn_radioType active">
                    <input type="radio" name="proposal_type" id="proposal_type_1" value="0"
                        onclick="showType(this)" checked>
                    <label for="proposal_type_1">스타일1</label>
                </div>
                <div class="swiper-slide btn_radioType">
                    <input type="radio" name="proposal_type" id="proposal_type_2" value="1"
                        onclick="showType(this)">
                    <label for="proposal_type_2">스타일2</label>
                </div>
                <div class="swiper-slide btn_radioType">
                    <input type="radio" name="proposal_type" id="proposal_type_3" value="2"
                        onclick="showType(this)">
                    <label for="proposal_type_3">스타일3</label>
                </div>
                <div class="swiper-slide btn_radioType">
                    <input type="radio" name="proposal_type" id="proposal_type_4" value="3"
                        onclick="showType(this)">
                    <label for="proposal_type_4">스타일4</label>
                </div>
                <div class="swiper-slide btn_radioType">
                    <input type="radio" name="proposal_type" id="proposal_type_5" value="4"
                        onclick="showType(this)">
                    <label for="proposal_type_5">스타일5</label>
                </div>
            </div>
        </div>
        <!-- tab : e -->

        <div id="type_preview" class="type_view_wrap">
            <!-- type_1 : s -->
            <x-user-proposal-type-1 :corpInfo="$corpInfo" :address="$address" :products="$products" />
            <!-- type_1 : e -->

            <!-- type_2 : s -->
            <x-user-proposal-type-2 :corpInfo="$corpInfo" :address="$address" :products="$products" />
            <!-- type_2 : e -->

            <!-- type_3 : s -->
            <x-user-proposal-type-3 :corpInfo="$corpInfo" :address="$address" :products="$products" />
            <!-- type_3 : e -->

            <!-- type_4 : s -->
            <x-user-proposal-type-4 :corpInfo="$corpInfo" :address="$address" :products="$products" />
            <!-- type_4 : e -->

            <!-- type_5 : s -->
            <x-user-proposal-type-5 :corpInfo="$corpInfo" :address="$address" :products="$products" />
            <!-- type_5 : e -->
        </div>
    </div>

</body>

<script>
    var firstTab = $('.proposal_type_tab input[name="proposal_type"]').eq({{ $proposal_type }});
    if (firstTab.length) {
        firstTab.prop('checked', true); // 첫 번째 라디오 버튼 선택
        showType(firstTab[0]); // 해당 탭의 내용을 보여주는 함수 호출
    }

    //탭 보기
    function showType(element) {
        var is_checked = element.checked;
        console.log('elment', is_checked);
        if (is_checked) {
            var index = element.value;
            var type_preview = document.querySelectorAll('.type_view_wrap .proposal_type_item');
            type_preview.forEach(function(content) {
                content.classList.remove('active');
            });
            type_preview[index].classList.add('active');
        }
    }

    //탭 스와이프
    var proposal_type_tab = new Swiper(".proposal_type_tab", {
        slidesPerView: 'auto',
        spaceBetween: 8,
        freeMode: true,
        breakpointsInverse: true,
        breakpoints: {
            1023: {
                allowTouchMove: false
            }
        }
    });
</script>
