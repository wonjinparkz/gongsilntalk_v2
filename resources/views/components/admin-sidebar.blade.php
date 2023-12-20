<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6">
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <span class="svg-icon svg-icon-2 rotate-180">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.5"
                        d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                        fill="currentColor" />
                    <path
                        d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                        fill="currentColor" />
                </svg>
            </span>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                {{-- 대시보드  메뉴 --}}
                <div class="menu-item pt-5">
                    <div class="menu-item">
                        <a class="menu-link {{ Route::currentRouteNamed('dashboard.view') ? 'active' : '' }}"
                            href="{{ route('dashboard.view') }}">
                            <span class="menu-icon">
                                <i class="fa-regular fa-clipboard"></i>
                            </span>
                            <span class="menu-title">대시보드</span>
                        </a>
                    </div>
                </div>

                {{-- 회원 관리 --}}
                <div class="menu-item pt-5 ">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">회원관리</span>
                    </div>

                    {{-- 회원관리 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'user') ? 'active' : '' }}"
                            href="{{ route('admin.user.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <span class="menu-title">회원관리</span>
                        </a>
                    </div>

                    {{-- 회원관리 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link" href="#">
                            <span class="menu-icon">
                                <i class="fa-solid fa-handshake"></i>
                            </span>
                            <span class="menu-title">파트너</span>
                        </a>
                    </div>
                </div>

                {{-- 커뮤니티 관리 --}}
                <div class="menu-item pt-5 ">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">커뮤니티 관리</span>
                    </div>

                    {{-- 커뮤니티 카테고리 관리 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'community.category') ? 'active' : '' }}"
                            href="{{ route('admin.community.category.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-layer-group"></i>
                            </span>
                            <span class="menu-title">커뮤니티 카테고리 관리</span>
                        </a>
                    </div>

                    {{-- 커뮤니티 카테고리 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'community.list.view') ? 'active' : '' }}"
                            href="{{ route('admin.community.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-comment-dots"></i>
                            </span>
                            <span class="menu-title">커뮤니티 목록 관리</span>
                        </a>
                    </div>


                    {{-- 커뮤니티 신고 관리 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link" href="#">
                            <span class="menu-icon">
                                <i class="fa-solid fa-comment-slash"></i>
                            </span>
                            <span class="menu-title">커뮤니티 신고 관리</span>
                        </a>
                    </div>


                </div>


                {{-- 매거진 관리 --}}
                <div class="menu-item pt-5 ">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">매거진 관리</span>
                    </div>

                    {{-- 매거진 카테고리 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'magazine.category') ? 'active' : '' }}"
                            href="{{ route('admin.magazine.category.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-book"></i>
                            </span>
                            <span class="menu-title">매거진 카테고리 관리</span>
                        </a>
                    </div>

                    {{-- 매거진 목록 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'magazine') ? 'active' : '' }}"
                            href="{{ route('admin.magazine.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-book"></i>
                            </span>
                            <span class="menu-title">매거진 목록 관리</span>
                        </a>
                    </div>
                </div>


                {{-- 고객 센터 메뉴 그룹  --}}
                {{-- 메뉴 - 서브 메뉴 없는 경우  --}}
                <div class="menu-item pt-5 ">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">고객센터</span>
                    </div>

                    {{-- 공지사항 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'notice') ? 'active' : '' }}"
                            href="{{ route('admin.notice.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-bullhorn"></i>
                            </span>
                            <span class="menu-title">공지사항 관리</span>
                        </a>
                    </div>

                    {{-- FAQ 메뉴  --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'faq') ? 'active' : '' }}"
                            href="{{ route('admin.faq.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-clipboard-question"></i>
                            </span>
                            <span class="menu-title">FAQ 관리</span>
                        </a>
                    </div>

                    {{-- 1:1문의 메뉴  --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'qa') ? 'active' : '' }}"
                            href="{{ route('admin.qa.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-person-circle-question"></i>
                            </span>
                            <span class="menu-title">1:1 문의 관리</span>
                        </a>
                    </div>

                    {{-- 약관 메뉴  --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'terms') ? 'active' : '' }}"
                            href="{{ route('admin.terms.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-circle-check"></i>
                            </span>
                            <span class="menu-title">약관 관리</span>
                        </a>
                    </div>


                </div>


                {{-- 관리자 메뉴 --}}
                <div class="menu-item pt-5 ">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">환경설정</span>
                    </div>

                    {{-- 팝업 관리 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'popup') ? 'active' : '' }}"
                            href="{{ route('admin.popup.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-window-restore"></i>
                            </span>
                            <span class="menu-title">팝업관리</span>
                        </a>
                    </div>
                      {{-- 배너 관리 메뉴 --}}
                      <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'banner') ? 'active' : '' }}"
                            href="{{ route('admin.banner.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-sign-hanging"></i>
                            </span>
                            <span class="menu-title">배너관리</span>
                        </a>
                    </div>

                    {{-- 알림 발송 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'alarm') ? 'active' : '' }}"
                            href="{{ route('admin.alarm.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-bell"></i>
                            </span>
                            <span class="menu-title">알림 관리</span>
                        </a>
                    </div>
                </div>

                {{-- 관리자 메뉴 --}}
                <div class="menu-item pt-5 ">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">관리자</span>
                    </div>

                    {{-- 관리자 메뉴 --}}
                    <div class="menu-item">
                        <a class="menu-link {{ str_contains(Route::currentRouteName(), 'admins') ? 'active' : '' }}"
                            href="{{ route('admins.list.view') }}">
                            <span class="menu-icon">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <span class="menu-title">관리자 관리</span>
                        </a>
                    </div>
                </div>

                {{-- 관리자 메뉴 그룹  --}}


                {{-- 메뉴 -서브 메뉴 있는 경우  --}}
                {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link ">
                        <span class="menu-icon">
                            <i class="fas fa-mail-bulk"></i>
                        </span>
                        <span class="menu-title">공지사항</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion {{ Route::currentRouteNamed('admin.notice.list.view') ? 'show' : '' }}">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ Route::currentRouteNamed('admin.notice.list.view') ? 'active' : '' }}" href="#">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">공지사항</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div> --}}
            </div>
        </div>
    </div>
</div>
