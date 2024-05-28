<!-- header : s -->
<header>
    <a href="{{ route('www.main.main') }}"><img src="{{ asset('assets/media/header_logo.png') }}" class="header_logo"
            alt="공실앤톡"></a>
    <ul class="gnb">
        <li><a href="sales_list.html">실시간 분양현장</a></li>
        <li><a href="map.html">빅데이터/매물지도</a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'www.community') ? 'active' : '' }}">
            <a href="{{ route('www.community.list.view') }}">커뮤니티</a>
        </li>
        @guest
        @else
            @if (Auth::guard('web')->user()->type == 0)
                <li class="{{ str_contains(Route::currentRouteName(), 'mypage') ? 'active' : '' }}">
                    <a href="{{ route('www.mypage.product.magagement.list.view') }}">마이메뉴</a>
                </li>
            @else
                <li class="{{ str_contains(Route::currentRouteName(), 'mypage') ? 'active' : '' }}">
                    <a href="{{ route('www.mypage.corp.product.magagement.list.view') }}">마이메뉴</a>
                </li>
            @endif
        @endguest
    </ul>
    <div>
        @guest
            <ul class="util_menu">
                <li><a href="{{ route('www.login.login') }}">로그인</a></li>
                <li><a href="{{ route('www.register.register.view') }}">회원가입</a></li>
                <li><a href="{{ route('www.register.corp.register.view') }}">중개사 가입</a></li>
            </ul>
        @else
            <div class="util_area">
                <div class="header_user_img">
                    <div class="img_box"><img src="{{ asset('assets/media/default_user.png') }}"></div>
                </div>
                {{ Auth::guard('web')->user()->name }}
                <ul class="util_menu">
                    <li><a href="{{ route('www.logout.logout') }}">로그아웃</a></li>
                </ul>
            </div>
        @endguest
    </div>
</header>
<!-- header : e -->
