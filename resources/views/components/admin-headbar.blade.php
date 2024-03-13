<div id="kt_app_header" class="app-header">
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="메뉴보기">
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
            </div>
            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <img src="{{ asset('assets/media/auth/rocateer_logo.png') }}" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{ Auth::guard('admin')->user()->name }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5 my-1">
                            <a href="{{ route('admins.me.view', [Auth::guard('admin')->user()->id]) }}"
                                class="menu-link px-5">계정설정1</a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="{{ route('admin.login.logout') }}" class="menu-link px-5">로그아웃</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
