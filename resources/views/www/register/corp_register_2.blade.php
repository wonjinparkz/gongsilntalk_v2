<x-layout>
    <div class="body">
        <div class="inner_wrap">
            <div class="col-md-6 box_member">
                <h2>중개사무소 정보 입력</h2>
                <ul class="login_wrap reg_bascic">
                    <li>
                        <label>이메일</label>
                        <input type="text" placeholder="example@email.com">
                    </li>
                    <li>
                        <label>비밀번호</label>
                        <input type="password" placeholder="8자리 이상 영문, 숫자 포함">
                        <input type="password" placeholder="비밀번호 확인" class="mt8">
                    </li>
                    <li>
                        <label>닉네임</label>
                        <input type="text" placeholder="2~8 특수문자를 제외한 글자">
                    </li>
                    <li>
                        <!-- <label>본인인증</label> -->
                        <button class="btn_black_ghost btn_full_basic"><b>본인인증</b></button>
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

                    <div class="step_btn_wrap">
                        <button class="btn_full_basic btn_graylight_ghost"
                            onclick="location.href='realtor_join_reg.html'">이전</button>
                        <!-- <button class="btn_full_basic btn_point" disabled>가입 완료</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point" onclick="location.href='realtor_join_success.html'">가입
                            완료</button>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- modal 약관 : s-->
    <div class="modal modal_mid modal_terms">
        <div class="modal_title">
            <h5>공실앤톡 서비스 이용약관</h5>
            <img src="images/btn_md_close.png" class="md_btn_close" onclick="modal_close('terms')">
        </div>
        <div class="modal_container">
            <div class="terms_wrap">
                <b>제1조 (목적)</b><br>
                본 약관은 ‘공실앤톡’(이하 “회사”라 한다)가 운영하는 인터넷 사이트 및 모바일 어플리케이션(이하 “공실앤톡”이라 한다)에서 제공하는 인터넷 관련 서비스(이하 “서비스”라 한다)를
                이용함에 있어 회사와 이용자 및 이용자간의 권리, 의무 및 책임사항, 기타 필요한 사항을 규정함을 목적으로 합니다.<br><br>
                <b>제2조 (정의)</b><br>
                이 약관에서 사용하는 용어의 정의는 다음과 같습니다.<br>
                1. 공실앤톡 : 회사가 제공하는 각종의 정보서비스를 이용자가 이용할 수 있는 형태로 구성한 것으로 인터넷 사이트 및 모바일 어플리케이션 등을 포함한 제반 단말기를 의미합니다.
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_terms" onclick="modal_close('terms')"></div>
    <!-- modal 약관 : e-->

</x-layout>
