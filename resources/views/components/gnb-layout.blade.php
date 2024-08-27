<!-- header : s -->
<header>
    <a href="{{ route('www.main.main') }}"><img src="{{ asset('assets/media/header_logo.png') }}" class="header_logo"
            alt="공실앤톡"></a>
    <ul class="gnb">
        <li><a href="{{ route('www.site.product.list.view') }}">실시간 분양현장</a></li>
        <li><a href="{{ route('www.map.map') }}">빅데이터/매물지도</a></li>
        <li class="{{ str_contains(Route::currentRouteName(), 'www.community') ? 'active' : '' }}">
            <a href="{{ route('www.community.list.view') }}">커뮤니티</a>
        </li>
        @guest
        @else
            @if (Auth::guard('web')->user()->type == 0)
                <li class="{{ str_contains(Route::currentRouteName(), 'mypage') ? 'active' : '' }}">
                    @if (Auth::guard('web')->user()->phone == null)
                        <a href="javascript:;" onclick="modal_open('add_info')">마이메뉴</a>
                    @else
                        <a href="{{ route('www.mypage.product.magagement.list.view') }}">마이메뉴</a>
                    @endif
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
                <li class="btn_type"><a href="{{ route('www.register.corp.register.view') }}">중개사 가입</a></li>
            </ul>
        @else
            <div class="util_area">
                <div class="header_user_img">
                    <div class="img_box"><img src="{{ asset('assets/media/default_user.png') }}"></div>
                </div>
                {{ Auth::guard('web')->user()->name }}
                <ul class="util_menu">
                    <li class="btn_type"><a href="{{ route('www.logout.logout') }}">로그아웃</a></li>
                </ul>
            </div>
        @endguest
    </div>

</header>
<!-- modal 추가정보 입력 : s-->
@guest
@else
    @if (Auth::guard('web')->user()->phone == null)
        <form class="form" id="form" name="form" method="POST" action="{{ route('www.sns.addinfo.create') }}">
            @csrf
            <div class="modal modal_mid modal_add_info">
                <div class="modal_title">
                    <h5>회원 추가정보 입력</h5>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                        onclick="modal_close('add_info')">
                </div>
                <div class="modal_container">
                    <div class="gray_basic txt_lh_1">
                        <span class="txt_point">공실앤톡의 모든 기능을 사용하기 위해서는 <br>
                            아래의 추가 정보가 필요합니다.</span>
                    </div>
                    <ul class="login_wrap reg_bascic mt20">
                        <li>
                            <label>닉네임<span class="txt_point">*</span></label>
                            <input type="text" name="nickname" id="nickname" placeholder="2~8 특수문자를 제외한 글자">
                            <input type="hidden" id="name" name="name" value='{{ old('name') ?? '' }}'>
                            <input type="hidden" id="phone" name="phone" value='{{ old('phone') ?? '' }}'>
                            <input type="hidden" id="birth" name="birth" value='{{ old('birth') ?? '' }}'>
                            <input type="hidden" id="gender" name="gender" value='{{ old('gender') ?? '' }}'>
                        </li>
                    </ul>
                    <div class="mt50">
                        <label>본인인증<span class="txt_point">*</span></label>
                        <button type="button" class="btn_black_ghost btn_full_basic" id="confirm"
                            onclick="verificationstart()"><b>본인인증</b></button>
                    </div>
                    <div class="mt50">
                        <button type="button" class="btn_point btn_full_basic" onclick="add_info()">
                            <b>입력 완료</b>
                        </button>
                    </div>
                </div>
            </div>
            <div class="md_overlay md_overlay_add_info" onclick="modal_close('add_info')"></div>
            <!-- modal 추가정보 입력 : e-->
        </form>
        <!-- header : e -->
    @endif
@endguest

<script>
    // 본인인증 모듈 실행
    @guest
    @else
        @if (Auth::guard('web')->user()->phone == null)
            function verificationstart() {

                IMP.init("{{ env('IMP_CODE') }}");
                IMP.certification({ // param
                    // 주문 번호
                    // pg: 'PG사코드.{CPID}', //본인인증 설정이 2개이상 되어 있는 경우 필
                    merchant_uid: "MIIiasTest",
                    popup: true
                }, function(rsp) { // callback
                    if (rsp.success) { // 인증 성공
                        jQuery.ajax({
                                url: "{{ route('www.verification.result') }}",
                                method: "get",
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                data: {
                                    imp_uid: rsp.imp_uid,
                                    success: rsp.success,
                                    merchant_uid: rsp.merchant_uid,
                                }
                            }).done(function(data) {
                                $("#verificat").html(data);
                                $("#confirm").attr('onclick', '').unbind('click');
                                button_active();
                            })
                            .fail(function(jqXHR, ajaxOptions, thrownError) {
                                alert('다시 시도해주세요.', "확인");
                            });

                    } else { // 인증 실패

                    }
                });
            }
        @endif
    @endguest

    function add_info() {
        var formData = $("#form").serialize();

        $.ajax({
            type: "post", //전송타입
            url: "{{ route('www.sns.addinfo.create') }}",
            data: formData,
            success: function(data, status, xhr) {
                history.replaceState(null, null, document.referrer);
                location.replace(document.referrer);
            },
            error: function(xhr, status, e) {

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function(fieldName, errorMessages) {
                        toastr.error(errorMessages[0]);
                    });
                } else {
                    if (xhr.responseJSON && xhr.responseJSON.check) {
                        var errorMessages = xhr.responseJSON.check;
                        toastr.error(errorMessages[0]);
                    } else if (xhr.responseJSON && xhr.responseJSON.job_check) {
                        var errorMessages = xhr.responseJSON.job_check;
                        toastr.error(errorMessages[0]);
                    } else {
                        toastr.error('다시 시도해주세요.');
                    }
                }
            }
        });
    }
</script>
<script src="https://cdn.iamport.kr/v1/iamport.js"></script>
<div id="verificat">
</div>
