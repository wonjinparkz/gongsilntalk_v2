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
            <div class="menu menu-column menu-rounded menu-sub-indention px-3 pb-20" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">

                @php
                    $permissions = explode(',', Auth::guard('admin')->user()->permissions);
                @endphp

                {{-- 대시보드  메뉴 --}}
                {{-- <div class="menu-item pt-5">
                    <div class="menu-item">
                        <a class="menu-link {{ Route::currentRouteNamed('dashboard.view') ? 'active' : '' }}"
                            href="{{ route('dashboard.view') }}">
                            <span class="menu-icon">
                                <i class="fa-regular fa-clipboard"></i>
                            </span>
                            <span class="menu-title">대시보드</span>
                        </a>
                    </div>
                </div> --}}

                @if (in_array('0', $permissions))
                    {{-- 일반회원 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">일반 회원 관리</span>
                        </div>

                        {{-- 일반회원관리 메뉴 --}}
                        <div class="menu-item">
                            <a class="menu-link {{ str_contains(Route::currentRouteName(), 'user') ? 'active' : '' }}"
                                href="{{ route('admin.user.list.view') }}">
                                <span class="menu-icon">
                                    <i class="fa-regular fa-user"></i>
                                </span>
                                <span class="menu-title">일반 회원 관리</span>
                            </a>
                        </div>
                    </div>
                @endif

                @if (in_array('1', $permissions) || in_array('2', $permissions))
                    {{-- 중개사 회원 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">*
                            <span class="menu-heading fw-bold text-uppercase fs-7">중개사 회원 관리</span>
                        </div>

                        @if (in_array('1', $permissions))
                            {{-- 중개사 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'admin.corp') && !str_contains(Route::currentRouteName(), 'admin.corp.proposal') && !str_contains(Route::currentRouteName(), 'admin.corp.product') ? 'active' : '' }}"
                                    href="{{ route('admin.corp.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-handshake"></i>
                                    </span>
                                    <span class="menu-title">중개사 회원 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('2', $permissions))
                            {{-- 승인요청 중개사 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'company') ? 'active' : '' }}"
                                    href="{{ route('admin.company.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-pen-nib"></i>
                                    </span>
                                    <span class="menu-title">승인 요청 중개사 관리</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- 매물 관리 --}}
                @if (in_array('3', $permissions) || in_array('4', $permissions) || in_array('5', $permissions))
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">*
                            <span class="menu-heading fw-bold text-uppercase fs-7">매물 관리</span>
                        </div>
                        @if (in_array('3', $permissions))
                            {{-- 일반 회원 매물 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'admin.product') ? 'active' : '' }}"
                                    href="{{ route('admin.product.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-house"></i>
                                    </span>
                                    <span class="menu-title">일반 회원 매물 관리</span>
                                </a>
                            </div>
                        @endif
                        @if (in_array('4', $permissions))
                            {{-- 중개사 매물 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'corp.product') ? 'active' : '' }}"
                                    href="{{ route('admin.corp.product.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-building-user"></i>
                                    </span>
                                    <span class="menu-title">중개사 매물 관리</span>
                                </a>
                            </div>
                        @endif
                        @if (in_array('5', $permissions))
                            {{-- 분양현장 매물 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'site.product') ? 'active' : '' }}"
                                    href="{{ route('admin.site.product.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-building-flag"></i>
                                    </span>
                                    <span class="menu-title">분양현장 매물 관리</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                @if (in_array('6', $permissions))
                    {{-- 지식산업센터 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">*
                            <span class="menu-heading fw-bold text-uppercase fs-7">지식산업센터 관리</span>
                        </div>

                        {{-- 일반 회원 매물 관리 메뉴 --}}
                        <div class="menu-item">
                            <a class="menu-link {{ str_contains(Route::currentRouteName(), 'knowledgeCenter') ? 'active' : '' }}"
                                href="{{ route('admin.knowledgeCenter.list.view') }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-building-columns"></i>
                                </span>
                                <span class="menu-title">지식산업센터 관리</span>
                            </a>
                        </div>
                    </div>
                @endif

                @if (in_array('7', $permissions) || in_array('8', $permissions))
                    {{-- 제안서 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">*
                            <span class="menu-heading fw-bold text-uppercase fs-7">제안서 관리</span>
                        </div>

                        @if (in_array('7', $permissions))
                            {{-- 매물 제안서 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'admin.proposal') ? 'active' : '' }}"
                                    href="{{ route('admin.proposal.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-list-check"></i>
                                    </span>
                                    <span class="menu-title">매물 제안서 관리</span>
                                </a>
                            </div>
                        @endif
                        @if (in_array('8', $permissions))
                            {{-- 기업 이전 제안서 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'corp.proposal') ? 'active' : '' }}"
                                    href="{{ route('admin.corp.proposal.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-chart-pie"></i>
                                    </span>
                                    <span class="menu-title">기업 이전 제안서 관리</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                @if (in_array('9', $permissions) || in_array('10', $permissions) || in_array('11', $permissions))
                    {{-- 관리자 컨텐츠 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">관리자 컨텐츠 관리</span>
                        </div>

                        @if (in_array('9', $permissions))
                            {{-- 공톡 유튜브 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'magazine') && request()->query('type') == 0 ? 'active' : '' }}"
                                    href="{{ route('admin.magazine.list.view', ['type' => '0']) }}">
                                    <span class="menu-icon">
                                        <i class="fa-brands fa-youtube"></i>
                                    </span>
                                    <span class="menu-title">공톡 유튜브 관리</span>
                                </a>
                            </div>
                        @endif
                        @if (in_array('10', $permissions))
                            {{-- 공톡 매거진 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'magazine') && request()->query('type') == 1 ? 'active' : '' }}"
                                    href="{{ route('admin.magazine.list.view', ['type' => 1]) }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-comment-dots"></i>
                                    </span>
                                    <span class="menu-title">공톡 매거진 관리</span>
                                </a>
                            </div>
                        @endif
                        @if (in_array('11', $permissions))
                            {{-- 공톡 뉴스 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'magazine') && request()->query('type') == 2 ? 'active' : '' }}"
                                    href="{{ route('admin.magazine.list.view', ['type' => 2]) }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </span>
                                    <span class="menu-title">공톡 뉴스 관리</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                @if (in_array('12', $permissions))
                    {{-- 커뮤니티 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">커뮤니티 관리</span>
                        </div>

                        {{-- 커뮤니티 관리 메뉴 --}}
                        <div class="menu-item">
                            <a class="menu-link {{ str_contains(Route::currentRouteName(), 'admin.community') ? 'active' : '' }}"
                                href="{{ route('admin.community.list.view') }}">
                                <span class="menu-icon">
                                    <i class="fa-solid fa-layer-group"></i>
                                </span>
                                <span class="menu-title">커뮤니티 관리</span>
                            </a>
                        </div>

                    </div>
                @endif

                @if (in_array('13', $permissions) || in_array('14', $permissions))
                    {{-- 신고 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">신고 관리</span>
                        </div>
                        @if (in_array('13', $permissions))
                            {{-- 게시글 신고 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'report.community') ? 'active' : '' }}"
                                    href="{{ route('admin.report.community.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-text-slash"></i>
                                    </span>
                                    <span class="menu-title">게시글 신고 관리</span>
                                </a>
                            </div>
                        @endif
                        @if (in_array('14', $permissions))
                            {{-- 댓글 신고 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'report.reply') ? 'active' : '' }}"
                                    href="{{ route('admin.report.reply.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-comment-slash"></i>
                                    </span>
                                    <span class="menu-title">댓글 신고 관리</span>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                {{-- 고객 센터 메뉴 그룹  --}}
                @if (in_array('15', $permissions) || in_array('18', $permissions))

                    {{-- 메뉴 - 서브 메뉴 없는 경우  --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">고객센터</span>
                        </div>
                        @if (in_array('15', $permissions))
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
                        @endif
                        @if (in_array('18', $permissions))
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
                        @endif
                    </div>
                @endif

                @if (in_array('19', $permissions) ||
                        in_array('20', $permissions) ||
                        in_array('21', $permissions) ||
                        in_array('22', $permissions) ||
                        in_array('23', $permissions))
                    {{-- 메인 페이지 구성 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">메인 페이지 구성 관리</span>
                        </div>
                        @if (in_array('19', $permissions))
                            {{-- 메인 배너 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'banner') ? 'active' : '' }}"
                                    href="{{ route('admin.banner.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-sign-hanging"></i>
                                    </span>
                                    <span class="menu-title">메인 배너 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('20', $permissions))
                            {{-- 메인 서비스 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'admin.service') ? 'active' : '' }}"
                                    href="{{ route('admin.service.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-money-check"></i>
                                    </span>
                                    <span class="menu-title">메인 서비스 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('21', $permissions))
                            {{-- 부가 서비스 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'extra.service') ? 'active' : '' }}"
                                    href="{{ route('admin.extra.service.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-light fa-sign-hanging"></i>
                                    </span>
                                    <span class="menu-title">부가 서비스 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('22', $permissions))
                            {{-- 시작페이지 팝업 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'popup') && request()->query('type') == 0 ? 'active' : '' }}"
                                    href="{{ route('admin.popup.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-window-restore"></i>
                                    </span>
                                    <span class="menu-title">시작페이지 팝업 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('23', $permissions))
                            {{-- 메인 텍스트 노출 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'main.text') ? 'active' : '' }}"
                                    href="{{ route('admin.main.text.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </span>
                                    <span class="menu-title">메인 텍스트 노출 관리</span>
                                </a>
                            </div>
                        @endif

                    </div>
                @endif


                @if (in_array('24', $permissions))
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
                @endif
                @if (in_array('25', $permissions) ||
                        in_array('26', $permissions) ||
                        in_array('27', $permissions) ||
                        in_array('28', $permissions) ||
                        in_array('29', $permissions) ||
                        in_array('30', $permissions) ||
                        in_array('31', $permissions) ||
                        in_array('32', $permissions))
                    {{-- 데이터 관리 --}}
                    <div class="menu-item pt-5 ">
                        <div class="menu-content">
                            <span class="menu-heading fw-bold text-uppercase fs-7">데이터 관리</span>
                        </div>

                        @if (in_array('25', $permissions))
                            {{-- 일반 회원 자산 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'apt.complex') ? 'active' : '' }}"
                                    href="{{ route('admin.asset.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-money-bill-trend-up"></i>
                                    </span>
                                    <span class="menu-title">일반 회원 자산 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('26', $permissions))
                            {{-- 인테리어 견적 받기 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                    </span>
                                    <span class="menu-title">인테리어 견적 받기 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('27', $permissions))
                            {{-- 아파트 단지 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'apt.complex') ? 'active' : '' }}"
                                    href="{{ route('admin.apt.complex.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-city"></i>
                                    </span>
                                    <span class="menu-title">아파트 단지 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('28', $permissions))
                            {{-- 아파트 단지명 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'apt.name') ? 'active' : '' }}"
                                    href="{{ route('admin.apt.name.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-file-signature"></i>
                                    </span>
                                    <span class="menu-title">아파트 단지명 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('29', $permissions))
                            {{-- 상가 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'store') ? 'active' : '' }}"
                                    href="{{ route('admin.store.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-store"></i>
                                    </span>
                                    <span class="menu-title">상가 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('30', $permissions))
                            {{-- 건물 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'building') ? 'active' : '' }}"
                                    href="{{ route('admin.building.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-building"></i>
                                    </span>
                                    <span class="menu-title">건물 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('31', $permissions))
                            {{-- 아파트 매매 실거래가 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ !str_contains(Route::currentRouteName(), 'rent') && str_contains(Route::currentRouteName(), 'transactions') ? 'active' : '' }}"
                                    href="{{ route('admin.transactions.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-chart-line"></i>
                                    </span>
                                    <span class="menu-title">아파트 매매 실거래가 관리</span>
                                </a>
                            </div>
                        @endif

                        @if (in_array('32', $permissions))
                            {{-- 아파트 전월세 실거래가 관리 메뉴 --}}
                            <div class="menu-item">
                                <a class="menu-link {{ str_contains(Route::currentRouteName(), 'rent') && str_contains(Route::currentRouteName(), 'transactions') ? 'active' : '' }}"
                                    href="{{ route('admin.transactions.rent.list.view') }}">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-chart-column"></i>
                                    </span>
                                    <span class="menu-title">아파트 전월세 실거래가 관리</span>
                                </a>
                            </div>
                        @endif

                    </div>
                @endif

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
