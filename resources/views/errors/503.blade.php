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
                            <!--begin::Logo-->
                            <div class="mb-13">
                                {{-- <a href="../../demo1/dist/index.html" class="">
                                    <img alt="Logo" src="assets/media/logos/custom-2.svg" class="h-40px" />
                                </a> --}}
                            </div>
                            <!--end::Logo-->
                            <!--begin::Title-->
                            <h1 class="fw-bolder text-gray-900 mb-7">보수중에 있습니다.</h1>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="fw-semibold fs-6 text-gray-500 mb-7">곧 다시 런칭 합니다.<br />조금만 기다려주세요.
                            </div>
                            <!--end::Text-->
                            <!--begin::Illustration-->
                            <div class="mb-n5">
                                <img src="{{ asset('assets/media/auth/chart-graph.png') }}"
                                    class="mw-100 mh-300px theme-light-show" alt="" />
                            </div>
                            <!--end::Illustration-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Authentication - Signup Welcome Message-->
        </div>
        <!--end::Root-->
    </body>
    <!--end::Body-->
</x-errors>
