<style>
    .img_box_size {
        height: 80px;
        width: 80px;
    }
</style>

<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">마이메뉴</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="body">

        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">내 정보 수정</h1>

                    <div class="col-md-6 box_member">
                        <div class="user_profile_wrap">
                            <div class="img_box img_box_size">
                                @if ($user->image != null)
                                    <img id="member_img_src" src="{{ Storage::url('image/' . $user->image->path) }}"
                                        alt="">
                                @else
                                    <img id="member_img_src" src="{{ asset('assets/media/default_user.png') }}"
                                        alt="">
                                @endif
                            </div>
                        </div>
                        <div class="t_center mt18">
                            <button class="btn_gray_ghost btn_sm" type="button" id="profile_drop">사진 등록</button>
                        </div>
                        <ul class="reg_bascic mt20">
                            <li>
                                <label>이름</label>
                                <input type="text" value="{{ $user->name }}" disabled>
                            </li>

                            {{-- QA-68 디자인 변경 필요 --}}
                            <li>
                                <label>닉네임</label>
                                <input type="text" id="chage_nickname" name="chage_nickname"
                                    value="{{ $user->nickname }}">
                                <p id="nickname_confirm" style="color:red; display:none;"></p>
                                <p />
                                <button class="btn_gray_ghost btn_sm" id="btn_pw" onclick="changeNickName()">닉네임
                                    변경</button>
                            </li>

                            <li>
                                <label>이메일</label>
                                <input type="text" value="{{ $user->email }}" disabled>
                            </li>
                            <li>
                                <label>비밀번호</label>
                                <button class="btn_gray_ghost btn_full_thin" id="btn_pw"
                                    onclick="btn_pw_change()">비밀번호 변경</button>
                                <div class="pw_change_wrap" id="input_pw">
                                    <input type="password" id="password" name="password" placeholder="현재 비밀번호">
                                    <p id="password_confirm" style="color:red; display:none;"></p>
                                    <input type="password" id="new_password" name="new_password"
                                        placeholder="새 비밀번호 8자리 이상 영문, 숫자 포함">
                                    <p id="new_password_confirm" style="color:red; display:none;"></p>
                                    <input type="password" id="new_password_confirmation"
                                        name="new_password_confirmation" placeholder="비밀번호 확인">
                                    <p id="new_password_confirmation_confirm" style="color:red; display:none;"></p>
                                    <button class="btn_point btn_full_thin" type="button" onclick="changePW();">변경
                                        완료</button>
                                </div>

                            </li>
                            <li>
                                <label>휴대폰 번호</label>
                                <input type="text" value="{{ $user->phone }}" disabled>
                            </li>
                        </ul>
                        <button class="btn_gray_ghost btn_full_basic mt28" type="button"
                            onclick="modal_open('info_modify')"><b>내 정보
                                수정</b></button>
                        <button class="btn_ghost btn_full_thin mt28" type="button"
                            onclick="location.href='{{ route('www.logout.logout') }}'"><b>로그아웃</b></button>
                    </div>

                </div>
                <!-- my_body : e -->

                <script>
                    function btn_pw_change() {
                        var btn_pw = document.getElementById("btn_pw");
                        var input_pw = document.getElementById("input_pw");

                        if (btn_pw.style.display === "none") {
                            btn_pw.style.display = "inline-block";
                            input_pw.style.display = "none";
                        } else {
                            btn_pw.style.display = "none";
                            input_pw.style.display = "inline-block";
                        }
                    }
                </script>

            </div>

            <!-- modal 정보수정 : s -->
            <div class="modal modal_mid modal_info_modify">
                <div class="modal_title">
                    <h5>정보수정</h5>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                        onclick="modal_close('info_modify')">
                </div>
                <div class="modal_container">
                    <form class="form" method="POST" action="{{ route('www.register.corp.create') }}">
                        @csrf
                        <ul class="reg_bascic">
                            <li>
                                <label>이름</label>
                                <input type="text" id="name" name="name" value="" disabled>
                            </li>
                            <li>
                                <label>전화번호</label>
                                <input type="text" id="phone" name="phone" value="" disabled>
                            </li>
                            <input type="hidden" id="birth" name="birth" value=''>
                            <input type="hidden" id="gender" name="gender" value=''>
                            <input type="hidden" id="unique_key" name="unique_key" value=''>
                        </ul>
                        <div class="mt20">
                            <button class="btn_point btn_full_basic mt28" type="button" id="verification_button"
                                name="verification_button" onclick="verificationstart();">본인인증</button>
                            <button class="btn_point btn_full_basic mt28" id="verification_confirm"
                                name="verification_confirm" onclick="changeUserInfo();" type="button"
                                id="info_mod_btn" name="info_mod_btn" disabled>
                                <b>수정</b>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="md_overlay md_overlay_info_modify" onclick="modal_close('info_modify')"></div>
            <!-- modal 정보수정 : e -->
        </div>
    </div>

</x-layout>

<script>
    var profileimageDropzone = new Dropzone("#profile_drop", {
        url: "{{ route('api.imageupload') }}", // URL
        method: 'post', // method
        paramName: "image", // 파라미터 이름
        maxFiles: 10, // 파일 갯수
        maxFilesize: 10, // MB
        timeout: 300000, // 타임아웃 30초 기본 설정
        addRemoveLinks: false, // 업로드 후 파일 삭제버튼 표시 여부
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF', // 이미지 파일 포맷만 허
        accept: function(file, done) {
            done();
        },
        success: function(file, responseText) {

            $.ajax({
                    url: '{{ route('www.info.profile.image.update') }}',
                    type: "post",
                    data: {
                        'image_ids[]': responseText.result.id
                    }
                })
                .done(function(data) {

                    var imagePath = '{{ Storage::url('image/') }}' + responseText.result.path;

                    document.getElementById('member_img_src').src = imagePath;

                    profileimageDropzone.removeFile(file);
                    refreshFsLightbox();
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                });
        }
    });

    function changePW() {
        $('#password_confirm').hide();
        $('#new_password_confirm').hide();
        $('#new_password_confirmation_confirm').hide();

        $('#password').css('border', '1px solid #D2D1D0');
        $('#new_password').css('border', '1px solid #D2D1D0');
        $('#new_password_confirmation').css('border', '1px solid #D2D1D0');

        $.ajax({
                url: '{{ route('www.change.pw') }}',
                type: "post",
                data: {
                    'password': $('#password').val(),
                    'new_password': $('#new_password').val(),
                    'new_password_confirmation': $('#new_password_confirmation').val()
                }
            })
            .done(function(data) {
                location.reload();
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                let fieldName = '';
                switch (jqXHR.responseJSON.errors) {
                    case 1:
                        fieldName = 'password';
                        break;
                    case 2:
                        fieldName = 'new_password';
                        break;
                    case 3:
                        fieldName = 'new_password_confirmation';
                        break;
                    default:
                        break;
                }

                $('#' + fieldName).css('border', '1px solid #ff0000');

                $('#' + fieldName).focus();
                $('#' + fieldName + '_confirm').css('display', 'inline');
                $('#' + fieldName + '_confirm').text(jqXHR.responseJSON.message);
            });
    }

    function changeNickName() {
        $('#nickname_confirm').hide();

        $.ajax({
                url: '{{ route('www.change.nickname') }}',
                type: "post",
                data: {
                    'nickname': $('#chage_nickname').val(),
                }
            })
            .done(function(data) {
                location.reload();
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                $('#chage_nickname').css('border', '1px solid #ff0000');
                $('#chage_nickname').focus();

                $('#nickname_confirm').css('display', 'inline');
                $('#nickname_confirm').text(jqXHR.responseJSON.message);
            });
    }

    function changeUserInfo() {

        $.ajax({
                url: '{{ route('www.change.user.info') }}',
                type: "post",
                data: {
                    'name': $('#name').val(),
                    'phone': $('#phone').val(),
                    'gender': $('#gender').val() == 'male' ? 0 : 1,
                    'unique_key': $('#unique_key').val(),
                }
            })
            .done(function(data) {
                location.reload();
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                $("#verification_confirm").attr('disabled', true);
                alert(jqXHR.responseJSON.message);
            });
    }

    function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        };
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
                        $("#verification_confirm").attr('disabled', false);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
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
