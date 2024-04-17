<body class="gray_body">
    <x-layout>

        <div class="body">
            <div class="inner_wrap login_inner_wrap">
                <div class="col-md-6 box_member">
                    <h2>공실앤톡 로그인</h2>
                    <form class="form" name="login" id="login" method="POST"
                        action="{{ route('www.login.create') }}">
                        @csrf
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
                        <div><a href="{{ route('www.register.register') }}" class="txt_point">일반회원 가입</a><i
                                class="v_line">|</i> <a href="{{ route('www.register.register') }}"
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
                        <input type="text" placeholder="example@email.com">
                    </li>
                </ul>
                <div class="mt50">
                    <button class="btn_black_ghost btn_full_basic"><b>본인인증</b></button>
                </div>
                <div class="mt50">
                    <button class="btn_full_basic" disabled><b>다음</b></button>
                    <span onclick="modal_close('pw_change1')"><button class="btn_point btn_full_basic"
                            onclick="modal_open('pw_change2')"><b>다음</b></button></span>
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
                        <input type="password" placeholder="8자리 이상 영문, 숫자 포함">
                    </li>
                    <li>
                        <label>비밀번호 확인</label>
                        <input type="password" placeholder="새 비밀번호 재입력">
                    </li>
                </ul>
                <div class="mt50">
                    <!-- <a href="#" class="btn_disabled_2 btn_full_basic"><b>변경 완료</b></a> -->
                    <button class="btn_point btn_full_basic"><b>변경 완료</b></button>
                </div>
            </div>
        </div>
        <div class="md_overlay md_overlay_pw_change2" onclick="modal_close('pw_change2')"></div>
        <!-- modal 비밀번호 재설정 : e-->




    </x-layout>
</body>
