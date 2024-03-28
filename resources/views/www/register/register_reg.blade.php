<x-layout>

    <div class="body">
        <div class="inner_wrap">
            <form class="form" method="POST" action="{{ route('www.register.create') }}">
                @csrf
                <input type="hidden" name="token" value="{{ Request::get('token') }}" />
                <input type="hidden" id="verification" name="verification" value='{{ old('verification') ?? 'N' }}'>
                <input type="hidden" id="name" name="name" value='{{ old('name') ?? '' }}'>
                <input type="hidden" id="phone" name="phone" value='{{ old('phone') ?? '' }}'>
                <input type="hidden" id="birth" name="birth" value='{{ old('birth') ?? '' }}'>
                <input type="hidden" id="unique_key" name="unique_key" value='{{ old('unique_key') ?? '' }}'>

                <div class="col-md-6 box_member">
                    <h2>회원정보 입력</h2>
                    <ul class="login_wrap reg_bascic">
                        <li>
                            <label>이메일</label>
                            <input name="email" id="email" type="text" placeholder="example@email.com"
                                value="{{ old('email') }}">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />
                        </li>
                        <li>
                            <label>비밀번호</label>
                            <input type="password" name="password" id="password" placeholder="8자리 이상 영문, 숫자 포함"
                                value="{{ old('password') }}">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="비밀번호 확인" class="mt8" value="{{ old('password_confirmation') }}">
                            <x-input-error class="mt-2 text-danger" :messages="count($errors->get('password')) > 0
                                ? $errors->get('password')
                                : $errors->get('password_confirmation')" />
                        </li>
                        <li>
                            <label>닉네임</label>
                            <input type="text" name="nickname" id="nickname" placeholder="2~8 특수문자를 제외한 글자"
                                maxlength='8' value="{{ old('nickname') }}">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('nickname')" />
                        </li>
                        <li class="flex_between">
                            <label>성별</label>
                            <div class="btn_radioType">
                                <input type="radio" name="gender" id="gender_0" value="0">
                                <label for="gender_0">남성</label>

                                <input type="radio" name="gender" id="gender_1" value="1">
                                <label for="gender_1">여성</label>
                            </div>
                        </li>
                        <li>
                            <!-- <label>본인인증</label> -->
                            <button type="button" class="btn_black_ghost btn_full_basic" id="confirm"
                                onclick="verificationstart();"><b>본인인증</b></button>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('verification')" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('phone')" />
                        </li>
                    </ul>

                    <div>
                        <div class="mt28">
                            <input type="checkbox" name="checkAll" id="checkAll">
                            <label for="checkAll"><span></span>모두 동의합니다.</label>
                        </div>
                        <ul class="terms_list">
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
                                <label for="checkOne_1"><span></span></label>
                                [필수] 만 14세 이상입니다.
                            </li>
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_2" value="Y">
                                <label for="checkOne_2"><span></span></label>
                                <a href="javascript:void(0)" onclick="modal_open('terms')">[필수] 공실앤톡 서비스 이용약관 동의</a>
                            </li>
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_3" value="Y">
                                <label for="checkOne_3"><span></span></label>
                                <a href="javascript:void(0)" onclick="modal_open('terms')">[필수] 개인정보 수집 및 이용동의</a>
                            </li>
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_4" value="Y">
                                <label for="checkOne_4"><span></span></label>
                                <a href="javascript:void(0)" onclick="modal_open('terms')">[선택] 마케팅 정보 수신에 대한 동의</a>
                            </li>
                        </ul>
                        <div class="mt40">
                            <button id="button_disabled" class="btn_full_basic" disabled>가입 완료</button>
                            <button id="button_activ" type="submit" class="btn_point btn_full_basic"
                                style="display:">가입 완료</button>
                        </div>
                    </div>
                </div>
                </from>
        </div>

    </div>
</x-layout>

<!-- modal 약관 : s-->
<div class="modal modal_mid modal_terms">
    <div class="modal_title">
        <h5>공실앤톡 서비스 이용약관</h5>
        <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close" onclick="modal_close('terms')">
    </div>
    <div class="modal_container">
        <div class="terms_wrap">
            <b>제1조 (목적)</b><br>
            본 약관은 ‘공실앤톡’(이하 “회사”라 한다)가 운영하는 인터넷 사이트 및 모바일 어플리케이션(이하 “공실앤톡”이라 한다)에서 제공하는 인터넷 관련 서비스(이하 “서비스”라 한다)를 이용함에
            있어 회사와 이용자 및 이용자간의 권리, 의무 및 책임사항, 기타 필요한 사항을 규정함을 목적으로 합니다.<br><br>
            <b>제2조 (정의)</b><br>
            이 약관에서 사용하는 용어의 정의는 다음과 같습니다.<br>
            1. 공실앤톡 : 회사가 제공하는 각종의 정보서비스를 이용자가 이용할 수 있는 형태로 구성한 것으로 인터넷 사이트 및 모바일 어플리케이션 등을 포함한 제반 단말기를 의미합니다.
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>
</div>
<div class="md_overlay md_overlay_terms" onclick="modal_close('terms')"></div>
<!-- modal 약관 : e-->


<script>
    $(document).ready(function() {
        $('input').change(function() {
            button_active();
        });
    });

    function button_active() {
        var email = $('#email').val();
        var password = $('#password').val();
        var password_confirmation = $('#password_confirmation').val();
        var nickname = $('#nickname').val();
        var verification = $('#verification').val();
        var checkOne_1 = $('#checkOne_1').is(':checked');
        var checkOne_2 = $('#checkOne_2').is(':checked');
        var checkOne_3 = $('#checkOne_3').is(':checked');
        var gender = $('input [name="gender"]').is(':checked');

        if (email !== '' && password !== '' && password_confirmation !== '' && nickname !== '' && verification == 'Y' &&
            checkOne_1 !== false && checkOne_2 !== false && checkOne_3 !== false) {
            $('#button_activ').css('display', '');
            $('#button_disabled').css('display', 'none');
        } else {
            $('#button_disabled').css('display', '');
            $('#button_activ').css('display', 'none');
        }
    }


    // 닉네임 중복확인
    function nicknameCheck() {
        var nickname = $('#nickname').val();
        var url = "{{ route('www.register.nickname', [':nickname']) }}".replace(':nickname', nickname);
        $.ajax({
                url: url,
                type: "post"
            })
            .done(function(data) {
                if (data.result == 'Y') {
                    alert('사용 가능한 닉네임 입니다.', "확인");
                } else {
                    $('#nickname').val('');
                    alert('중복된 닉네임 입니다.', "확인");
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('닉네임을 입력해 주세요.', "확인");
            });
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
                        button_active();
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log(thrownError);
                        alert('다시 시도해주세요.', "확인");
                    });

            } else { // 인증 실패

            }
        });
    }
</script>
<script src="https://cdn.iamport.kr/v1/iamport.js"></script>
<div id="verificat">
</div>
