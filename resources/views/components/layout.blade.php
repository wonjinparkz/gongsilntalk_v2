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
    <link rel="stylesheet" href="{{ asset('assets/css/common_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/external.css') }}">

    <!--외부 CSS : 외부 모듈에서 제공된 CSS만 사용-->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">

    <!--내부 기본 JS : 내부에서 생성한 JS 경우만 사용 하며. 이를 사용하기 위한 라이브러만사용(jquery.js) -->
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>

    <!--외부 JS : 외부 모듈에서 제공된 JS만 사용-->
    <script src="{{ asset('assets/js/swiper.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>



</head>

<body>

    <x-gnb-layout>
    </x-gnb-layout>

    {{ $slot }}

</body>

<x-footer-layout>
</x-footer-layout>


</html>

<style>
    .toast-message {
        color: #FFFFFF;
    }
</style>
<script type="text/javascript" src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script>
    var hostUrl = "assets/";

    // 공통 메세지 출력
    @if (session('message') != null)
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.success("{{ session('message') }}");
    @endif

    @if (session('error') != null)
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr.error("{{ session('error') }}");
    @endif

    @if ($errors->any())
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>
