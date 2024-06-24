@props(['result' => ''])

<div class="my_side_top">
    <div class="my_profile_img">
        <div class="img_box" style="height:50px; width:50px;">
            @if ($result->images != null)
                @foreach ($result->images as $image)
                    <img src="{{ Storage::url('image/' . $image->path) }}" />
                @endforeach
            @else
                <img src="{{ asset('assets/media/default_user.png') }}" />
            @endif
        </div>
    </div>
    @if ($result->type == 0)
        <span class="user_name">{{ $result->name }}님</span>
    @elseif($result->type == 1)
        <div class="my_info">
            <p>{{ $result->company_name }}</p>
            <span class="user_name">{{ $result->name }}님</span>
        </div>
    @endif
</div>
<ul class="my_gnb">
    @if ($result->type == 0)
        <li class="{{ str_contains(Route::currentRouteName(), 'mypage.product.magagement') ? 'active' : '' }}">
            <a href="{{ route('www.mypage.product.magagement.list.view') }}">내 매물 관리</a>
        </li>
    @elseif($result->type == 1)
        <li class="{{ str_contains(Route::currentRouteName(), 'mypage.corp.product.magagement') ? 'active' : '' }}">
            <a href="{{ route('www.mypage.corp.product.magagement.list.view') }}">매물 관리</a>
        </li>
    @endif
    <li class="{{ str_contains(Route::currentRouteName(), 'mypage.product.interest') ? 'active' : '' }}">
        <a href="{{ route('www.mypage.product.interest.list.view') }}">관심매물/최근 본 매물</a>
    </li>
    @if ($result->type == 1)
        <li class="{{ str_contains(Route::currentRouteName(), 'mypage.corp.proposal') ? 'active' : '' }}">
            <a href="{{ route('www.mypage.corp.proposal.list.view') }}">기업 이전 제안서</a>
        </li>
    @endif
    <li class="{{ str_contains(Route::currentRouteName(), 'mypage.service') ? 'active' : '' }}">
        <a href="{{ route('www.mypage.service.list.view') }}">내 자산관리</a>
    </li>
    <li class="{{ str_contains(Route::currentRouteName(), 'mypage.proposal') ? 'active' : '' }}">
        <a href="{{ route('www.mypage.proposal.list.view') }}">매물 제안서</a>
    </li>
    <li class="{{ str_contains(Route::currentRouteName(), 'mypage.calculator.revenue') ? 'active' : '' }}">
        <a href="{{ route('www.mypage.calculator.revenue.list.view') }}">수익률 계산기</a>
    </li>
    @if ($result->type == 0)
        <li class="{{ str_contains(Route::currentRouteName(), 'mypage.my.info') ? 'active' : '' }}">
            <a href="{{ route('www.mypage.my.info') }}">내 정보 수정</a>
        </li>
    @elseif($result->type == 1)
        <li class="{{ str_contains(Route::currentRouteName(), 'mypage.comapny.my.info') ? 'active' : '' }}">
            <a href="{{ route('www.mypage.company.info') }}">내 정보 수정</a>
        </li>
    @endif
    <li class="{{ str_contains(Route::currentRouteName(), 'mypage.community') ? 'active' : '' }}">
        <a href="{{ route('www.mypage.community.list.view') }}">커뮤니티 게시글 관리</a>
    </li>
    <li class="only_pc {{ str_contains(Route::currentRouteName(), 'mypage.alarm') ? 'active' : '' }}">
        <a href="{{ route('www.mypage.alarm.list.view') }}">알림</a>
    </li>
    <li>
        <button class="btn_call" onclick="location.href='tel:1600-5734'">
            <img src="{{ asset('assets/media/ic_call.png') }}"> 고객센터 문의
        </button>
    </li>
</ul>
