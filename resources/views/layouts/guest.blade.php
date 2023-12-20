<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- 폰트 --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    {{-- 글로벌 스타일 시트 --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
</head>

<body id="kt_app_body" class="app-default">
    <script>
        var hostUrl = "assets/";

        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Chrome/) == null ? false : true;
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i) == null ? false : true;
            },
            any: function() {
                return (isMobile.Android() || isMobile.iOS());
            }
        };

        // 공통 메세지 출력
        @if (session('message') != null)
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": false,
                "positionClass": "toastr-top-right",
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
    </script>



    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    {{ $slot }}
                </div>
            </div>
        </div>


        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
</body>

</html>
