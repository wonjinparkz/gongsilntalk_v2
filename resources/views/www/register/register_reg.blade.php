<x-layout>

    <div class="body">
        <div class="inner_wrap">
            <form class="form" method="POST" action="{{ route('www.register.create') }}">
                @csrf
                <input type="hidden" name="signup_type" value="E" />
                <input type="hidden" name="token" value="{{ Request::get('token') }}" />
                <input type="hidden" id="verification" name="verification" value='{{ old('verification') ?? 'N' }}'>
                <input type="hidden" id="name" name="name" value='{{ old('name') ?? '' }}'>
                <input type="hidden" id="phone" name="phone" value='{{ old('phone') ?? '' }}'>
                <input type="hidden" id="gender" name="gender" value='{{ old('gender') ?? '' }}'>
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
                            <input type="password" name="password" placeholder="8자리 이상 영문, 숫자 포함"
                                value="{{ old('password') }}">
                            <input type="password" name="password_confirmation" placeholder="비밀번호 확인" class="mt8"
                                value="{{ old('password_confirmation') }}">
                            <x-input-error class="mt-2 text-danger" :messages="count($errors->get('password')) > 0
                                ? $errors->get('password')
                                : $errors->get('password_confirmation')" />
                        </li>
                        <li>
                            <label>닉네임</label>
                            <input type="text" name="nickname" id="nickname" placeholder="2~8 특수문자를 제외한 글자"
                                value="{{ old('nickname') }}">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('nickname')" />
                        </li>
                        <li>
                            <!-- <label>본인인증</label> -->
                            <button type="button" class="btn_black_ghost btn_full_basic" id="confirm"
                                onclick="verificationstart();"><b>본인인증</b></button>
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
                                style="display:none">가입 완료</button>
                        </div>
                    </div>
                </div>
                </from>
        </div>

    </div>
</x-layout>

<script>
    $(document).ready(function() {
        $('input').change(function() {
            $('#button_disabled').css('display', 'none');
            $('#button_activ').css('display', '');
        });
    });


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
                        alert("본인인증 성공하였습니다.", "확인");
                        $("#confirm").attr('onclick', '').unbind('click');
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
