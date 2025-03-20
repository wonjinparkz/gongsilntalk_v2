<style>
    input {
        appearance: none;
        user-select: text;
        -webkit-user-select: text;
        -moz-user-select: text;
        -khtml-user-select: text;
        -ms-user-select: text;
    }
</style>

<body class="gray_body">
    <x-layout>

        <div class="m_header">
            <div class="left_area"><a href="{{ route('www.main.main') }}"><img
                        src="{{ asset('assets/media/header_btn_close.png') }}"></a></div>
            <div class="m_title"></div>
            <div class="right_area"></div>
        </div>

        <div class="body">
            <div class="inner_wrap login_inner_wrap">
                <div class="col-md-6 box_member">
                    <h2>공실앤톡 로그인</h2>
                    <form class="form" name="login" id="login" method="POST"
                        action="{{ route('www.login.create') }}">
                        @csrf
                        <input type="hidden" name="fcm_key" value="">
                        <input type="hidden" name="device_type" value="">

                        <ul class="login_wrap">
                            <li>
                                <input name="email" id="email" type="text" placeholder="이메일을 입력해주세요.">
                            </li>
                            <li>
                                <input name="password" id="password" type="password" placeholder="비밀번호를 입력해주세요.">
                            </li>
                        </ul>
                        <div class="flex_between">
                            <div>
                                <input type="checkbox" name="auto_login" id="auto_login" checked>
                                <label for="auto_login" class="mr10"><span></span> 자동로그인</label>
                            </div>
                            <a href="javascript:(0)" class="gray_basic" onclick="modal_open('pw_change1')">비밀번호 찾기</a>
                        </div>

                        <button type="submit" class="btn_point btn_full_basic mt28">로그인</button>
                    </form>

                    <div class="ss_login">
                        {{-- <a onclick="openApplePopup();">
                            <img src="{{ asset('assets/media/btn_ss_1.png') }}" alt="애플로그인">
                        </a> --}}
                        <a onclick="openKakaoPopup();">
                            <img src="{{ asset('assets/media/btn_ss_2.png') }}" alt="카카오로그인">
                        </a>
                        <a onclick="form_sns_login('{{ route('www.login.naver') }}');">
                            <img src="{{ asset('assets/media/btn_ss_3.png') }}" alt="네이버로그인">
                        </a>
                    </div>

                    <div class="t_center mt28">
                        <div><a href="{{ route('www.register.register.view') }}" class="txt_point">일반회원 가입</a><i
                                class="v_line">|</i> <a href="{{ route('www.register.corp.register.view') }}"
                                class="txt_point">중개사 가입</a></div>
                    </div>
                </div>
            </div>

        </div>

        {{-- modal sns 로그인 --}}
        <div class="modal modal_mid modal_sns_login">
            <div class="modal_title">
                <h5>SNS 로그인</h5>
                <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                    onclick="modal_close('sns_login')">
            </div>
            <div class="modal_container sns_login_container">
                <div id="kakao-login"></div>
            </div>
        </div>
        <div class="md_overlay md_overlay_pw_change1" onclick="modal_close('modal_sns_login')"></div>
        {{-- modal sns 로그인 --}}

        <script src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
        <script>
            Kakao.init('{{ env('KAKAO_CLIENT_ID') }}'); // 카카오 SDK 초기화

            function openKakaoPopup() {
                var fcmKey = $('input[name="fcm_key"]').val();
                var deviceType = $('input[name="device_type"]').val();
                var autoLogin = $('#auto_login').is(':checked') ? 1 : 0;

                var kakaoLoginUrl = "{{ route('www.login.kakao') }}" +
                    "?autoLogin=" + autoLogin +
                    "&fcm_key=" + encodeURIComponent(fcmKey) +
                    "&device_type=" + encodeURIComponent(deviceType);

                // var kakaoLoginUrl = "{{ route('www.login.kakao') }}";
                var width = 500;
                var height = 600;
                var left = (screen.width / 2) - (width / 2);
                var top = (screen.height / 2) - (height / 2);
                var popup = window.open(kakaoLoginUrl, 'kakaoLoginPopup', 'width=' + width + ', height=' + height + ', top=' +
                    top + ', left=' + left);

                window.addEventListener('message', function(event) {
                    if (event.origin !== window.location.origin) {
                        return;
                    }
                    if (event.data === 'success') {
                        window.location.reload();
                    }
                }, false);
            }

            function openApplePopup() {
                var appleLoginUrl = "{{ route('www.login.apple') }}";
                var width = 500;
                var height = 600;
                var left = (screen.width / 2) - (width / 2);
                var top = (screen.height / 2) - (height / 2);
                var popup = window.open(appleLoginUrl, 'appleLoginPopup', 'width=' + width + ', height=' + height + ', top=' +
                    top + ', left=' + left);

                window.addEventListener('message', function(event) {
                    if (event.origin !== window.location.origin) {
                        return;
                    }
                    if (event.data === 'success') {
                        window.location.reload();
                    }
                }, false);
            }
        </script>


        <!-- modal 비밀번호 재설정 : s-->
        <div class="modal modal_mid modal_pw_change1">
            <div class="modal_title">
                <h5>비밀번호 재설정</h5>
                <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                    onclick="modal_close('pw_change1')">
            </div>
            <div class="modal_container">
                <div class="gray_basic txt_lh_1">
                    비밀번호를 재설정할 <span class="txt_point">이메일 계정을 먼저 입력</span> 하신 후, 본인인인증을 해주세요.
                </div>
                <ul class="login_wrap reg_bascic mt20">
                    <li>
                        <label>이메일</label>
                        <input type="text" name="password_email" id="password_email" placeholder="example@email.com">
                    </li>
                </ul>
                <div class="mt50">
                    <button class="btn_black_ghost btn_full_basic" onclick="verificationstart()"><b>본인인증</b></button>
                </div>
                <div class="mt50">
                    <button class="btn_point btn_full_basic password_confirm_1"
                        onclick="modal_close('pw_change1'); modal_open('pw_change2')" disabled>
                        <b>다음</b>
                    </button>
                </div>
            </div>
        </div>
        <div class="md_overlay md_overlay_pw_change1" onclick="modal_close('pw_change1')"></div>
        <!-- modal 비밀번호 재설정 : e-->

        <!-- modal 비밀번호 재설정 : s-->
        <div class="modal modal_mid modal_pw_change2">
            <div class="modal_title">
                <h5>비밀번호 재설정</h5>
                <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                    onclick="modal_close('pw_change2')">
            </div>
            <div class="modal_container">
                <div class="gray_basic txt_lh_1">
                    비밀번호를 양식에 맞게 다시 설정해주세요.
                </div>
                <ul class="login_wrap reg_bascic mt20">
                    <li>
                        <label>새 비밀번호</label>
                        <input type="password" name="change_password" id="change_password"
                            placeholder="8자리 이상 영문, 숫자 포함">
                        <ul class='mt-2 text-danger change_password' style="display: none">
                            <li>영문, 숫자를 포함하여 8자리 이상으로 작성해주세요.</li>
                        </ul>
                    </li>
                    <li>
                        <label>비밀번호 확인</label>
                        <input type="password" name="change_password_confirmation" id="change_password_confirmation"
                            placeholder="새 비밀번호 재입력">
                        <ul class='mt-2 text-danger change_password_confirmation' style="display: none">
                            <li>비밀번호가 일치하지 않습니다.</li>
                        </ul>
                    </li>
                </ul>
                <div class="mt50">
                    <!-- <a href="#" class="btn_disabled_2 btn_full_basic"><b>변경 완료</b></a> -->
                    <button class="btn_point btn_full_basic password_confirm_2" disabled
                        onclick="passwordConfirm()"><b>변경 완료</b></button>
                </div>
            </div>
        </div>
        <div class="md_overlay md_overlay_pw_change2" onclick="modal_close('pw_change2')"></div>
        <!-- modal 비밀번호 재설정 : e-->

        <form class="form" name="form_password" id="form_password" method="POST"
            action="{{ route('password.change') }}">
            @csrf

            <input type="hidden" id="verification" name="verification" value='N'>
            <input type="hidden" id="name" name="name" value=''>
            <input type="hidden" id="phone" name="phone" value=''>
            <input type="hidden" id="birth" name="birth" value=''>
            <input type="hidden" id="new_password" name="new_password" value=''>
            <input type="hidden" id="new_password_confirmation" name="new_password_confirmation" value=''>
            <input type="hidden" id="passwordUser" name="passwordUser" value=''>
            <input type="hidden" id="password_email_confirmation" name="password_email_confirmation"
                value=''>

        </form>

        <form class="form" name="sns_login" id="sns_login" method="GET" action="">
            <input type="hidden" name="fcm_key" value="">
            <input type="hidden" name="device_type" value="">
            <input type="hidden" name="auto_login" id="sns_auto_login">

        </form>

    </x-layout>
</body>

<script>
    $(document).ready(function() {

        // 받아오기 성공 데이터 처리
        function responseToken(fcm_key, device_type) {
            if (fcm_key != '' && device_type != '') {
                $('input[name="fcm_key"]').val(fcm_key);
                $('input[name="device_type"]').val(device_type);
            }
        }

        if (isMobile.any()) {
            if (isMobile.Android()) {
                window.rocateer.requestToken();
            } else if (isMobile.iOS()) {
                webkit.messageHandlers.requestToken.postMessage();
            }
        }
    });

    function form_sns_login(sns_url) {
        var autoLogin = $('#auto_login').is(':checked') ? 1 : 0;
        $('#sns_auto_login').val(autoLogin);
        $('#sns_login').attr('action', sns_url).submit();
    }

    $('input[name="change_password"]').keyup(function() {
        passwordInputCheck2();
    })
    $('input[name="change_password_confirmation"]').keyup(function() {
        passwordInputCheck2();
    })

    $('input[name="password_email"]').on('keyup', function() {
        passwordInputCheck();
    })

    function passwordInputCheck() {
        var password_email = $('#password_email').val();
        var verification = $('#verification').val();
        var name = $('#name').val();
        var phone = $('#phone').val();
        var passwordUser = $('#passwordUser').val();

        if (password_email != '' && verification != '' && name != '' && phone != '' && passwordUser == 1) {
            $('.password_confirm_1').attr("disabled", false);
        } else {
            $('.password_confirm_1').attr("disabled", true);
        }
    }

    function passwordConfirm() {
        $('#form_password').submit();
    }

    function passwordInputCheck2() {
        var change_password = $('#change_password').val();
        var change_password_confirmation = $('#change_password_confirmation').val();

        // 비밀번호 유효성 검사
        var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,15}$/;

        if (!passwordRegex.test(change_password)) {
            $('.change_password').css('display', '');
        } else {
            $('.change_password').css('display', 'none');
        }

        if (change_password != '' && change_password_confirmation) {
            if (change_password == change_password_confirmation) {
                $('.password_confirm_2').attr("disabled", false);
                $('#new_password').val(change_password);
                $('#new_password_confirmation').val(change_password_confirmation);
                $('.change_password_confirmation').css('display', 'none')
            } else {
                $('.change_password_confirmation').css('display', '');
            }
        } else {
            $('.password_confirm_2').attr("disabled", true);
        }
    }

    // 본인인증 모듈 실행
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
                        passwordUserCheck();
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert('다시 시도해주세요.', "확인");
                    });

            } else { // 인증 실패
                alert('본인 인증에 실패했습니다. 다시 시도해주세요.', "확인");
            }
        });
    }

    function passwordUserCheck() {

        var password_email = $('#password_email').val();
        var name = $('#name').val();
        var phone = $('#phone').val();


        var formData = {
            'email': password_email,
            'name': name,
            'phone': phone,
        };

        $.ajax({
            type: "post", //전송타입
            url: "{{ route('password.user.check') }}",
            data: formData,
            success: function(data, status, xhr) {
                $('#passwordUser').val(data.confirm);
                if (data.confirm) {
                    $('#password_email_confirmation').val(password_email);
                    passwordInputCheck();
                } else {
                    return alert('가입한 회원을 찾을 수 없습니다.');
                }

            },
            error: function(xhr, status, e) {}
        });
    }
</script>
<script src="https://cdn.iamport.kr/v1/iamport.js"></script>
<div id="verificat">
</div>
