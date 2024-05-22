<html lang="kor"><head>
	<title>공실앤톡</title>
	<link rel="shortcut icon" href="images/favicon.png">

	<!--메타 : 메타 태그만 사용-->
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">

	<!--내부 기본 CSS : 내부에서 생성한 CSS만 사용-->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/common.css">
	<link rel="stylesheet" href="css/common_responsive.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_responsive.css">

	<!--외부 CSS : 외부 모듈에서 제공된 CSS만 사용-->
	<link rel="stylesheet" href="css/swiper-bundle.min.css">


	<!--내부 기본 JS : 내부에서 생성한 JS 경우만 사용 하며. 이를 사용하기 위한 라이브러만사용(jquery.js) -->
	<script src="js/jquery-1.12.4.min.js"></script>
	<script src="js/jquery-ui.js"></script>
	<script src="js/common.js"></script>

	<!--외부 JS : 외부 모듈에서 제공된 JS만 사용-->
	<script src="js/swiper.jquery.js"></script>
	<script src="js/swiper-bundle.min.js"></script>


  <body>
    <!-- header : s -->
    <header>
      <a href="main.html"><img src="images/header_logo.png" class="header_logo" alt="공실앤톡"></a>
      <ul class="gnb">
        <li><a href="sales_list.html">실시간 분양현장</a></li>
        <li><a href="map.html">빅데이터/매물지도</a></li>
        <li><a href="community_contents_list.html">커뮤니티</a></li>
        <li class="active"><a href="javascript:history.go(-1)">마이메뉴</a></li>
      </ul>
      <div>
        <ul class="util_menu">
            <li><a href="login.html">로그인</a></li>
            <li><a href="join_reg.html">회원가입</a></li>
            <li><a href="realtor_join_reg.html">중개사 가입</a></li>
        </ul>
      </div>
    </header>
    <!-- header : e -->

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="images/header_btn_back.png"></a></div>
        <div class="m_title">마이메뉴</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <div class="my_side_top">
                        <div class="my_profile_img">
                            <div class="img_box"><img src="images/default_user.png"></div>
                        </div>
                        <span class="user_name">홍길동님</span>
                    </div>
                    <ul class="my_gnb">
                        <li>
                          <a href="my_estate_list.html">내 매물 관리</a>
                        </li>
                        <li>
                          <a href="realtor_estate_list.html">중 - 매물 관리</a>
                        </li>
                        <li>
                            <a href="my_wish_list.html">관심매물/최근 본 매물</a>
                        </li>
                        <li>
                          <a href="realtor_proposal_list.html">중 - 기업 이전 제안서</a>
                        </li>
                        <li>
                            <a href="my_asset_view.html">내 자산관리</a>
                        </li>
                        <li>
                            <a href="my_proposal_list.html">매물 제안서</a>
                        </li>
                        <li>
                            <a href="calculator_revenue.html">수익률 계산기</a>
                        </li>
                        <li>
                            <a href="my_info.html">내 정보 수정</a>
                        </li>
                        <li class="active">
                          <a href="realtor_info.html">중 - 내 정보 수정</a>
                        </li>
                        <li>
                            <a href="my_community_list.html">커뮤니티 게시글 관리</a>
                        </li>
                        <li class="only_pc">
                            <a href="alarm_list.html">알림</a>
                        </li>
                    </ul>
                    <button class="btn_call">
                        <img src="images/ic_call.png"> 고객센터 문의
                    </button>
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">내 정보 수정</h1>

                    <div class="col-md-6 box_member">
                        <div class="user_profile_wrap">
                          <div class="img_box"><img id="member_img_src" src="images/default_user.png" alt=""></div>
                        </div>
                        <div class="t_center mt18">
                          <button class="btn_gray_ghost btn_sm">사진 등록</button>
                        </div>
                        <h5 class="mt28">중개사무소 정보</h5>
                        <div class="table_container columns_2 mt10">
                            <div class="td">중개사무소명</div>
                            <div class="td">공실앤톡공인중개사사무소</div>
                            <div class="td">대표자명</div>
                            <div class="td">홍길동</div>
                            <div class="td">소재지</div>
                            <div class="td">서울시 구로구 공원로</div>
                            <div class="td">대표 전화번호</div>
                            <div class="td">
                                <p class="flex_between">
                                    02-123-4567
                                    <button class="btn_graylight_ghost btn_sm">수정</button>
                                </p>
                                </div>
                            <div class="td">중개등록번호</div>
                            <div class="td">12345-1234-12345</div>
                            <div class="td">사업자 등록번호</div>
                            <div class="td">123-12-12345</div>
                        </div>
                        <h5 class="mt28">개인정보</h5>
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
                              <button class="btn_gray_ghost btn_full_thin" id="btn_pw" onclick="btn_pw_change()">비밀번호 변경</button>
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
                        <button class="btn_gray_ghost btn_full_basic mt28" onclick="modal_open('info_modify')"><b>내 정보 수정</b></button>
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
                <img src="images/btn_md_close.png" class="md_btn_close" onclick="modal_close('info_modify')">
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
                  <button class="btn_point btn_full_basic mt28" onclick="modal_close('info_modify')"><b>수정</b></button>
                </div>

              </div>
            </div>
            <div class="md_overlay md_overlay_info_modify" onclick="modal_close('info_modify')"></div>
            <!-- modal 정보수정 : e -->


        </div>

    </div>




    <!-- footer : s -->
    <footer>
      <div class="inner_wrap row">
        <div class="footer_info">
          언론보도 : gongsil_ntalk@naver.com<br>
          대표문의 : gongsil_ntalk@naver.com<br>
          상담문의 : 1600-5734
        </div>
        <div class="footer_info">
          주식회사 공실앤톡<br>
          대표 : 임요섭<i>|</i>사업자 등록 번호 : 291-81-02340<i>|</i>경기도 화성시 동탄기흥로557 금강펜테리움IT타워
        </div>
        <p class="copyright">Copyright ⓒ 주식회사 공실앤톡. All rights reserved.</p>
      </div>
    </footer>
    <!-- footer : s -->
</body>
</html>
