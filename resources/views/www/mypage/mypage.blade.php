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
        <li class="active"><a href="my_main.html">마이메뉴</a></li>
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

    <!-- m::header bar : s -->
    <div class="m_header">
        <div class="left_area"></div>
        <div class="m_title">마이페이지</div>
        <div class="right_area"><a href="#"><img src="images/header_btn_alarm.png"></a></div>
      </div>
      <!-- m::header bar : s -->
  
    <div class="body">
        
        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side">
                    <div class="my_side_top">
                        <div class="my_profile_img">
                            <div class="img_box"><img src="images/default_user.png"></div>
                        </div>
                        <span class="user_name">홍길동님</span>
                    </div>
                    <ul class="my_gnb">
                        <li class="active">
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
                        <li>
                          <a href="realtor_info.html">중 - 내 정보 수정</a>
                        </li>
                        <li>
                            <a href="my_community_list.html">커뮤니티 게시글 관리</a>
                        </li>
                        <li class="only_pc">
                            <a href="alarm_list.html">알림</a>
                        </li>
                        <li>
                          <button class="btn_call" onclick="location.href='tel:1600-5734'">
                            <img src="images/ic_call.png"> 고객센터 문의
                          </button>
                        </li>
                    </ul>
                    
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body my_main_body inner_wrap">
                    <h1 class="t_center">내 매물관리</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5 toggle_tab">
                            <li class="active">등록요청<span>62</span></li>
                            <li>등록완료<span>12</span></li>
                        </ul>
                    </div>

                      <div class="my_search_wrap">
                        <div class="sort_wrap">
                          <div class="dropdown_box">
                            <button class="dropdown_label">거래 유형</button>
                            <ul class="optionList">
                                <li class="optionItem">전체</li>
                                <li class="optionItem">매매</li>
                                <li class="optionItem">임대</li>
                                <li class="optionItem">단기임대</li>
                                <li class="optionItem">전세</li>
                                <li class="optionItem">월세</li>
                                <li class="optionItem">전매</li>
                            </ul>
                          </div>
                          <div class="dropdown_box">
                            <button class="dropdown_label">매물 종류</button>
                            <ul class="optionList">
                                <li class="optionItem">지산/사무실/창고</li>
                                <li class="optionItem">상가</li>
                                <li class="optionItem">건물</li>
                                <li class="optionItem">토지/임야</li>
                                <li class="optionItem">단독공장</li>
                                <li class="optionItem">아파트</li>
                                <li class="optionItem">오피스텔</li>
                                <li class="optionItem">단독/다가구</li>
                                <li class="optionItem">다세대/빌라/연립</li>
                                <li class="optionItem">상가주택</li>
                                <li class="optionItem">주택</li>
                                <li class="optionItem">지식산업센터 분양권</li>
                                <li class="optionItem">상가 분양권</li>
                                <li class="optionItem">아파트 분양권</li>
                                <li class="optionItem">오피스텔 분양권</li>
                            </ul>
                          </div>
                        </div>

                        <div class="search_wrap">
                             <input type="text" placeholder="매물번호/주소로 검색">
                             <button><img src="images/btn_search.png" alt="검색"></button>
                        </div>
                      </div>

                      <div class="border_top">
                        <div>
                          <!-- <input type="checkbox" name="checkAll" id="checkAll">
                          <label for="checkAll"><span></span></label> -->
                        </div>
                        <div class="right_spacing">
                          <button class="btn_gray_ghost btn_sm">선택 삭제</button>
                          <button class="btn_point btn_sm" onclick="location.href='estate_reg_1.html'">신규 매물 등록</button>
                        </div>
                      </div>

                      <!-- 데이터가 없을 경우 : s -->
                      <!-- <div class="empty_wrap">
                        <p>등록한 매물이 없습니다.</p>
                        <span>매물을 등록하고 간편하게 관리해보세요.</span>
                      </div> -->
                      <!-- 데이터가 없을 경우 : e -->

                      <table class="table_basic mt20">
                        <colgroup>
                          <col width="50">
                          <col width="100">
                          <col width="80">
                        </colgroup>
                        <thead>
                          <tr>
                            <th>
                              <input type="checkbox" name="checkAll" id="checkAll">
                              <label for="checkAll"><span></span></label>
                            </th>
                            <th>매물번호</th>
                            <th>사진</th>
                            <th>매물 종류</th>
                            <th>주소</th>
                            <th>면적 <button class="inner_change_button"><img src="images/ic_change.png"> 평</button></th>
                            <th>거래정보</th>
                            <th>관리</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="td_center">
                              <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
                              <label for="checkOne_1"><span></span></label>
                            </td>
                            <td><span class="gray_deep">123456</span></td>
                            <td>
                              <div class="list_thumb_1">
                                <div class="img_box"><img src="images/s_1.png"></div>
                              </div>
                            </td>
                            <td>오피스텔</td>
                            <td>서울시 마포구 합정동 서희스타힐스 1105호</td>
                            <td>공급 1234.12㎡<br>전용 1234.12㎡</td>
                            <td>매매<br>12억 2,000만</td>
                            <td><button class="btn_gray_ghost btn_sm">삭제</button></td>
                          </tr>
                        </tbody>
                      </table>

                      <!-- paging : s -->
                      <div class="paging only_pc">
                        <ul class="btn_wrap">
                            <li class="btn_prev">
                                <a class="no_next" href="#1"><img src="images/btn_prev.png" alt=""></a>
                            </li>
                            <li class="active">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li class="btn_next">
                                <a class="no_next" href="#1"><img src="images/btn_next.png" alt=""></a>
                            </li>
                        </ul>
                    </div>
                    <!-- paging : e -->
                </div>
                <!-- my_body : e -->

            </div>
            
            <!-- nav : s -->
            <nav>
                <ul>
                    <li>
                      <a href="main.html"><span><img src="images/mcnu_ic_1.png" alt=""></span>홈</a>
                    </li>
                    <li>
                      <a href="sales_list.html"><span><img src="images/mcnu_ic_2.png" alt=""></span>분양현장</a>
                    </li> 
                    <li>
                      <a href="m_map.html"><span><img src="images/mcnu_ic_3.png" alt=""></span>지도</a>
                    </li> 
                    <li>
                      <a href="community_contents_list.html"><span><img src="images/mcnu_ic_5.png" alt=""></span>커뮤니티</a>
                    </li>
                    <li class="active">
                      <a href="my_main.html"><span><img src="images/mcnu_ic_4.png" alt=""></span>마이페이지</a>
                    </li>
                </ul>
            </nav>
            <!-- nav : e -->
            
            
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
