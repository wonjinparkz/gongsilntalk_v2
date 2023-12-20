<x-errors>
    <!--begin::Body-->

    <body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root" id="kt_app_root">
            <!--begin::Authentication - Signup Welcome Message -->
            <div class="d-flex flex-column flex-center flex-column-fluid">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center text-center p-10">
                    <!--begin::Wrapper-->
                    <div class="card card-flush w-lg-650px py-5">
                        <div class="card-body py-15 py-lg-20">
                            <!--begin::Title-->
                            <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="fw-semibold fs-6 text-gray-500 mb-7">페이지를 찾을 수 없습니다.</div>
                            <!--end::Text-->
                            <!--begin::Illustration-->
                            <div class="mb-3">
                                <img src="{{ asset('assets/media/auth/404-error.png') }}"
                                    class="mw-100 mh-300px theme-light-show" alt="" />
                            </div>
                            <!--end::Illustration-->
                            <!--begin::Link-->
                            <div class="mb-0">
                                <a href="/" class="btn btn-sm btn-primary">홈으로 돌아가기</a>
                            </div>
                            <!--end::Link-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Authentication - Signup Welcome Message-->
        </div>
        <!--end::Root-->
        <!--begin::Javascript-->
        <script>
            var hostUrl = "assets/";
        </script>
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</x-errors>
