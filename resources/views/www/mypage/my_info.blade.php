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
                            <div class="img_box"><img id="member_img_src"
                                    src="{{ asset('assets/media/default_user.png') }}" alt=""></div>
                        </div>
                        <div class="t_center mt18">
                            <button class="btn_gray_ghost btn_sm">사진 등록</button>
                        </div>
                        <ul class="reg_bascic mt20">
                            <li>
                                <label>이름</label>
                                <input type="text" value="홍길동" disabled>
                            </li>
                            <li>
                                <label>이메일</label>
                                <input type="text" value="hong1234@naver.com" disabled>
                            </li>
                            <li>
                                <label>비밀번호</label>
                                <button class="btn_gray_ghost btn_full_thin" id="btn_pw"
                                    onclick="btn_pw_change()">비밀번호 변경</button>
                                <div class="pw_change_wrap" id="input_pw">
                                    <input type="text" placeholder="현재 비밀번호">
                                    <input type="text" placeholder="새 비밀번호 8자리 이상 영문, 숫자 포함">
                                    <input type="text" placeholder="비밀번호 확인">
                                    <button class="btn_point btn_full_thin">변경 완료</button>
                                </div>

                            </li>
                            <li>
                                <label>휴대폰 번호</label>
                                <input type="text" value="010-1234-1234" disabled>
                            </li>
                        </ul>
                        <button class="btn_gray_ghost btn_full_basic mt28" onclick="modal_open('info_modify')"><b>내 정보
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
                            <input type="text" value="홍길동">
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
                        <button class="btn_point btn_full_basic mt28"
                            onclick="modal_close('info_modify')"><b>수정</b></button>
                    </div>

                </div>
            </div>
            <div class="md_overlay md_overlay_info_modify" onclick="modal_close('info_modify')"></div>
            <!-- modal 정보수정 : e -->


        </div>

    </div>

</x-layout>
