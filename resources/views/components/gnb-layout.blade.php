<!-- header : s -->
<header>
    <a href="{{ route('www.main.main') }}"><img src="{{ asset('assets/media/header_logo.png') }}" class="header_logo"
            alt="공실앤톡"></a>
    <ul class="gnb">
        <li><a href="sales_list.html">실시간 분양현장</a></li>
        <li><a href="map.html">빅데이터/매물지도</a></li>
        <li><a href="community_contents_list.html">커뮤니티</a></li>
        @guest
        @else
            <li><a href="my_main.html">마이메뉴</a></li>
        @endguest
    </ul>
    <div>
        @guest
            <ul class="util_menu">
                <li><a href="{{ route('www.login.login') }}">로그인</a></li>
                <li><a href="{{ route('www.register.register') }}">회원가입</a></li>
                <li><a href="realtor_join_reg.html">중개사 가입</a></li>
            </ul>
        @else
            <ul class="">
                <li><a href="{{ route('www.logout.logout') }}">로그아웃</a></li>
            </ul>

        @endguest
    </div>
</header>
<!-- header : e -->
