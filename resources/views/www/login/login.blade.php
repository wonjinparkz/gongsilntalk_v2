<body class="gray_body">
    <x-layout>

        <div class="body">
            <div class="inner_wrap login_inner_wrap">
                <div class="col-md-6 box_member">
                    <h2>공실앤톡 로그인</h2>
                    <form class="form" name="login" id="login" method="POST"
                        action="{{ route('www.login.create') }}">
                        @csrf
                        <input type="hidden" name="fcm_key" id="fcm_key" value="">
                        <input type="hidden" name="device_type" id="device_type" value="">

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
                                <input type="checkbox" name="auto_login" id="auto_login">
                                <label for="auto_login" class="mr10"><span></span> 자동로그인</label>
                            </div>
                            <a href="javascript:(0)" class="gray_basic" onclick="modal_open('pw_change1')">비밀번호 찾기</a>
                        </div>

                        <button type="submit" class="btn_point btn_full_basic mt28">로그인</button>
                    </form>

                    <div class="ss_login">
                        <a href="{{ route('www.login.apple') }}">
                            <img src="{{ asset('assets/media/btn_ss_1.png') }}" alt="애플로그인">
                        </a>
                        <a href="{{ route('www.login.kakao') }}">
                            <img src="{{ asset('assets/media/btn_ss_2.png') }}" alt="카카오로그인">
                        </a>
                        <a href="{{ route('www.login.naver') }}">
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
                    <button class="btn_point btn_full_basic password_confirm_1" disabled
                        onclick="passwordConfirm()"><b>변경 완료</b></button>
                </div>
            </div>
        </div>
        <div class="md_overlay md_overlay_pw_change2" onclick="modal_close('pw_change2')"></div>
        <!-- modal 비밀번호 재설정 : e-->

        <form class="form" name="form_password" id="form_password" method="POST"
            action="{{ route('password.change') }}">
            <input type="hidden" id="verification" name="verification" value='N'>
            <input type="hidden" id="name" name="name" value=''>
            <input type="hidden" id="phone" name="phone" value=''>
            <input type="hidden" id="birth" name="birth" value=''>
            <input type="hidden" id="new_password" name="new_password" value=''>
            <input type="hidden" id="new_password_confirmation" name="new_password_confirmation" value=''>
            <input type="hidden" id="passwordUser" name="passwordUser" value=''>
        </form>

    </x-layout>
</body>

<script>

    function responseToken(token, type) {
        alert('token' + token + '\n' + 'type : ' + type);
    }

    if (isMobile.any()) {
        if (isMobile.Android()) {
            window.rocateer.requestToken();
        } else if (isMobile.iOS()) {
            webkit.messageHandlers.requestToken.postMessage();
        }
    }


    $('input[name="change_password"]').change(function() {
        passwordInputCheck2();
    })
    $('input[name="change_password_confirmation"]').change(function() {
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
        var passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;

        if (!passwordRegex.test(change_password)) {
            console.log('비밀번호 입력1');
            return $('.change_password').css('display', '');

        } else {
            $('.change_password').css('display', 'none');
            console.log('비밀번호 입력2');

        }

        if (change_password != '' && change_password_confirmation) {
            if (change_password == change_password_confirmation) {
                $('.password_confirm_1').attr("disabled", false);
                $('#new_password').val(change_password);
                $('#new_password_confirmation').val(change_password_confirmation);
                $('.change_password_confirmation').css('display', 'none')
            } else {
                $('.change_password_confirmation').css('display', '');
            }
        } else {
            $('.password_confirm_1').attr("disabled", true);
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
                console.log(rsp);
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
                        // console.log(json_decode(data));
                        // console.log();
                        $("#verificat").html(data);
                        $("#confirm").attr('onclick', '').unbind('click');
                        passwordUserCheck();
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        alert('다시 시도해주세요.', "확인");
                    });

            } else { // 인증 실패

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
                console.log(data);
                $('#passwordUser').val(data.confirm);
                if (data.confirm) {
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
