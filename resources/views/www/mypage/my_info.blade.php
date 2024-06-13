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
                            <div class="img_box">
                                <input type="file" class="real-upload" accept="image/*" required multiple
                                    style="display: none;">
                                @if ($user->images != null)
                                    @foreach ($user->images as $image)
                                        <img id="member_img_src" src="{{ Storage::url('image/' . $image->path) }}"
                                            alt="">
                                    @endforeach
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
                            <li>
                                <label>이메일</label>
                                <input type="text" value="{{ $user->email }}" disabled>
                            </li>
                            <li>
                                <label>비밀번호</label>
                                <button class="btn_gray_ghost btn_full_thin" id="btn_pw"
                                    onclick="btn_pw_change()">비밀번호 변경</button>
                                <div class="pw_change_wrap" id="input_pw">
                                    <input type="password" placeholder="현재 비밀번호">
                                    <input type="password" placeholder="새 비밀번호 8자리 이상 영문, 숫자 포함">
                                    <input type="password" placeholder="비밀번호 확인">
                                    <button class="btn_point btn_full_thin" type="button">변경 완료</button>
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
                        <button class="btn_ghost btn_full_thin mt28"><b>로그아웃</b></button>
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

                    <ul class="reg_bascic">
                        <li>
                            <label>이름</label>
                            <input type="text" value="">
                        </li>
                        <li>
                            <label>휴대폰 번호</label>
                            <div class="flex_1">
                                <input type="text">
                                <button class="btn_point">인증번호 전송</button>
                            </div>
                            <input type="text" placeholder="인증번호 입력" class="mt8">
                        </li>
                    </ul>
                    <div class="mt20">
                        <button class="btn_point btn_full_basic mt28" onclick="modal_close('info_modify')"
                            type="button"><b>수정</b></button>
                    </div>

                </div>
            </div>
            <div class="md_overlay md_overlay_info_modify" onclick="modal_close('info_modify')"></div>
            <!-- modal 정보수정 : e -->


        </div>

    </div>

</x-layout>

<script>
    const realUpload = document.querySelector('.real-upload');
    const upload = document.getElementById('profile_drop');

    upload.addEventListener('click', () => realUpload.click());
    realUpload.addEventListener('change', getImageFiles);

    function getImageFiles(e) {
        console.log(e.currentTarget.files[0]);

        fetch("{{ route('api.imageupload') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    image: e.currentTarget.files[0]
                }),
            })
            .then((response) => response.json())
            .then((data) => console.log(data))
    }

    //////////////////////


    var profileimageDropzone = new Dropzone("#profile_drop", {
        url: "{{ route('api.imageupload') }}", // URL
        method: 'post', // method
        paramName: "image", // 파라미터 이름
        maxFiles: 10, // 파일 갯수
        maxFilesize: 10, // MB
        timeout: 300000, // 타임아웃 30초 기본 설정
        addRemoveLinks: true, // 업로드 후 파일 삭제버튼 표시 여부
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF', // 이미지 파일 포맷만 허
        accept: function(file, done) {
            done();
        },
        success: function(file, responseText) {


            var imagePath = '{{ Storage::url('image/') }}' + responseText.result.path;

            var image =
                '<div class="cell draggable">' +
                '<input type="hidden" name="profile_image_ids[]" value="' + responseText.result
                .id + '" />' +
                '<input type="hidden" name="profile_image_paths[]" value="' + imagePath +
                '" />' +
                // '<img src="{{ asset('assets/media/mark_rep.png') }}" class="add_img_mark"> ' +
                '<img onClick="removeImage(this)" src="{{ asset('assets/media/btn_img_delete.png') }}"' +
                'class="btn_img_delete">' +
                '<div class="img_box draggable-handle"><img src="' + imagePath + '"></div>' +
                '</div>'

            profileimageDropzone.removeFile(file);
            refreshFsLightbox();
        }
    });



    // 이미지 제거
    function removeImage(elem) {

        $(elem).parent().remove();
    }
</script>
