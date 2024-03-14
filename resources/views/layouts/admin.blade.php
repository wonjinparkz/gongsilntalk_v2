<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/admin.commons.js') }}"></script>
    <script src="{{ asset('assets/js/proj4.js') }}"></script>

    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>


    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <script></script>
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <x-admin-headbar />

            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <x-admin-sidebar />

                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>

    {{-- 공통 자바스크립트 --}}
    <script>
        var V_WORD_KEY = "{{ env('V_WORD_KEY') }}";
        var APP_URL = "{{ env('APP_URL') }}";
        var hostUrl = "assets/";

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

        // 페이지 로딩 함수
        const loadingEl = document.createElement("div");
        document.body.prepend(loadingEl);
        loadingEl.classList.add("page-loader");
        loadingEl.classList.add("flex-column");
        loadingEl.classList.add("bg-dark");
        loadingEl.classList.add("bg-opacity-25");
        loadingEl.innerHTML = `
            <span class="spinner-border text-primary" role="status"></span>
            <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
            `;

        // Handle toggle click event
        function loadingStart() {
            // Populate the page loading element dynamically.
            // Optionally you can skipt this part and place the HTML
            // code in the body element by refer to the above HTML code tab.

            // Show page loading
            KTApp.showPageLoading();

        };

        function loadingEnd() {
            KTApp.hidePageLoading();
        }
    </script>
</body>

</html>
