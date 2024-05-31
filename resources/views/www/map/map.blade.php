<x-layout>
    <body>
        <!-- header : s -->
        <header>
          <a href="main.html"><img src="images/header_logo.png" class="header_logo" alt="공실앤톡"></a>
          <ul class="gnb">
            <li><a href="sales_list.html">실시간 분양현장</a></li>
            <li class="active"><a href="map.html">빅데이터/매물지도</a></li>
            <li><a href="community_contents_list.html">커뮤니티</a></li>
            <li><a href="my_main.html">마이메뉴</a></li>
          </ul>
          <div class="util_area">
            <div class="header_user_img">
              <div class="img_box"><img src="images/default_gs.png"></div>
            </div>
            홍길동님
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
          <div class="left_area"></div>
          <div class="m_title"><div class="txt_bold" onclick="modal_open_slide('menu_map')">실거래가지도 <img src="images/ic_arrow_more.png" class="tit_dropdown_arrow"></div></div>
          <div class="right_area"></div>
        </div>
        <div class="modal_slide modal_slide_menu_map">
          <div class="slide_title_wrap">
              <span>지도 선택</span>
              <img src="images/btn_md_close.png" onclick="modal_close_slide('menu_map')">
          </div>
          <ul class="slide_modal_menu">
              <li><a href="#" onclick="location.href='map.html'">실거래가지도</a></li>
              <li><a href="#" onclick="location.href='map_property.html'">매물지도</a></li>
          </ul>
        </div>
        <div class="md_slide_overlay md_slide_overlay_menu_map" onclick="modal_close_slide('menu_map')"></div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body">
            <div class="map_wrap">

              <div class="map_head_wrap">
                <div class="map_filter_wrap">
                  <div class="dropdown_box type_2">
                    <button class="dropdown_label">실거래가지도</button>
                    <ul class="optionList">
                        <li class="optionItem" onclick="location.href='map.html'">실거래가지도</li>
                        <li class="optionItem" onclick="location.href='map_property.html'">매물지도</li>
                    </ul>
                  </div>

                  <div class="filter_dropdown_wrap">
                    <!-- filter 매물 종류 : s -->
                    <div class="filter_btn_wrap">
                      <button class="filter_btn_trigger">매물 종류</button>
                      <div class="filter_panel panel_item_1">
                        <div class="filter_panel_body">
                          <h6>매물 종류</h6>
                          <div class="btn_radioType">
                            <input type="radio" name="estate_type" id="estate_type_1" value="Y">
                            <label for="estate_type_1">지식산업센터</label>

                            <input type="radio" name="estate_type" id="estate_type_2" value="Y">
                            <label for="estate_type_2">상가</label>

                            <input type="radio" name="estate_type" id="estate_type_3" value="Y">
                            <label for="estate_type_3">건물</label>

                            <input type="radio" name="estate_type" id="estate_type_4" value="Y">
                            <label for="estate_type_4">아파트</label>
                        </div>

                        </div>
                        <div class="filter_panel_bottom">
                          <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                          <button class="btn_point btn_md_full">적용하기</button>
                        </div>
                      </div>
                    </div>
                    <!-- filter 매물 종류 : e -->

                    <!-- filter 준공연차 : s -->
                    <div class="filter_btn_wrap">
                      <button class="filter_btn_trigger">준공연차</button>
                      <div class="filter_panel panel_item_3">
                        <div class="filter_panel_body">
                          <h6>준공연차</h6>
                          <div class="btn_radioType">
                            <input type="radio" name="year" id="year_1" value="Y">
                            <label for="year_1">전체</label>

                            <input type="radio" name="year" id="year_2" value="Y">
                            <label for="year_2">1년 이내</label>

                            <input type="radio" name="year" id="year_3" value="Y">
                            <label for="year_3">2년 이내</label>

                            <input type="radio" name="year" id="year_4" value="Y">
                            <label for="year_4">5년 이내</label>

                            <input type="radio" name="year" id="year_5" value="Y">
                            <label for="year_5">10년 이내</label>

                            <input type="radio" name="year" id="year_6" value="Y">
                            <label for="year_6">15년 이내</label>

                            <input type="radio" name="year" id="year_7" value="Y">
                            <label for="year_7">15년 이상</label>
                          </div>
                        </div>
                        <div class="filter_panel_bottom">
                          <button class="btn_graylight_ghost btn_md_full"><img src="images/ic_refresh.png">초기화</button>
                          <button class="btn_point btn_md_full">적용하기</button>
                        </div>
                      </div>
                    </div>
                    <!-- filter 준공연차 : e -->

                  </div>

                </div>
                <div>
                  <button class="btn_graylight_ghost btn_sm"><img src="images/ic_reset.png">전체 초기화</button>
                </div>
              </div>
              <div class="map_search_wrap">
                <div class="flex_between">
                  <input type="text" id="search_input" placeholder="금천구 가산동">
                  <img src="images/btn_solid_delete.png" alt="del" class="btn_del">
                  <button><img src="images/btn_search.png" alt="검색"></button>
                </div>
              </div>
              <div class="map_body">
                <!-- map side : s -->
                <div class="map_side">
                  <div class="side_header">
                    <div class="left_area"><a href="javascript:history.go(-1)"><img src="images/header_btn_back.png"></a></div>
                    <div class="m_title">성강케렌시아</div>
                    <div class="right_area"><a href="#" class="btn_share"><img src="images/header_btn_share_deep.png"></a></div>
                    <!-- 공유하기 : s -->
                    <div class="layer layer_share_wrap layer_share_top">
                      <div class="layer_title">
                          <h5>공유하기</h5>
                          <img src="images/btn_md_close.png" class="md_btn_close btn_share">
                      </div>
                      <div class="layer_share_con">
                          <a href="#">
                              <img src="images/share_ic_01.png">
                              <p class="mt8">카카오톡</p>
                          </a>
                          <a href="#">
                              <img src="images/share_ic_02.png">
                              <p class="mt8">링크복사</p>
                          </a>
                      </div>
                  </div>
                  <!-- 공유하기 : e -->
                  </div>
                  <div class="side_fixed">
                    <div class="top_wrap flex_between">
                      <ul class="tab_type_3 toggle_tab">
                        <li class="active">매매</li>
                        <li class="">전월세</li>
                      </ul>

                      <div class="dropdown_box s_sm">
                        <button class="dropdown_label">71.1㎡</button>
                        <ul class="optionList">
                            <li class="optionItem">71.1㎡</li>
                            <li class="optionItem">79.33평</li>
                            <li class="optionItem">81.13㎡</li>
                            <li class="optionItem">84㎡</li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="scroll_wrap_1">
                    <hr class="space">
                    <div class="estate_link">
                      <a href="#" class="flex_between">
                        <span><img src="images/ic_org_estate.png" class="ic_left_20"> 부동산 내놓기</span>
                        <span><img src="images/ic_list_arrow.png" class="ic_10"></span>
                      </a>
                    </div>
                    <hr class="space">

                    <div class="side_info_wrap">
                      <div>
                        <img src="images/map_sample_sm.png" class="size_100p">
                      </div>
                      <p class="txt_address">서울특별시 구로구 구로동 345-90</p>
                      <p class="txt_sub_1">가산디지털단지역 1호선 <span>3분</span></p>
                      <ul class="info_detail">
                        <li><p>2동</p><label>총 동수</label></li>
                        <li><p>142세대</p><label>총 세대수</label></li>
                        <li><p>3층/22층</p><label>최고/최저</label></li>
                        <li><p>2023년</p><label>준공년도</label></li>
                      </ul>
                    </div>

                    <!-- tab : s -->
                    <div class="tab_type_2 type_side">
                      <div style="width: 100%;">
                          <div class="swiper detail_tab">
                              <div class="swiper-wrapper menu toggle_menu">
                                <div class="swiper-slide active"><a href="javascript:(0)" onclick="showContent(0)">가격·거래내역</a></div>
                                <div class="swiper-slide"><a href="javascript:(0)" onclick="showContent(1)">건물·토지정보</a></div>
                                <div class="swiper-slide"><a href="javascript:(0)" onclick="showContent(2)">위치 및 주변정보</a></div>
                                <div class="swiper-slide"><a href="javascript:(0)" onclick="showContent(3)">매물정보</a></div>
                              </div>
                          </div>
                          <div class="swiper-button-next"></div>
                          <!-- <div class="swiper-button-prev"></div> -->
                        </div>
                    </div>
                    <!-- tab : e -->

                    <div class="side_tab_wrap" >
                        <div class="sction_item active">
                          <!-- 거래내역 : s -->
                          <div class="side_section">
                            <h4>거래내역</h4>
                            <!-- 데이터 없을 경우 -->
                            <div class="empty_wrap sm_type">
                              <span>실거래 내역이 없습니다.</span>
                            </div>
                            <div class="mt20">
                              <p>최근 실거래가</p>
                              <div class="transaction_box mt10">
                                <div class="gray_deep"><span class="transaction_price">3억 8200만</span>(11층)</div>
                                <div class="status_item_blue">1억(+4.1%)</div>
                              </div>

                              <div class="table_container2_sm mt10">
                                <div class="td">거래일시</div>
                                <div class="td">2023년 02월 4일</div>
                                <div class="td">거래 총면적</div>
                                <div class="td">전용 79.33㎡</div>
                                <div class="td">면적당 단가</div>
                                <div class="td">전용 792만/㎡</div>
                              </div>

                              <div class="section_price_wrap mt20">
                                <div class="default_box showstep1">
                                  <table class="table_type_1">
                                    <colgroup>
                                      <col width="80">
                                      <col width="*">
                                      <col width="*">
                                    </colgroup>
                                    <thead>
                                      <tr>
                                        <th>거래일</th>
                                        <th>거래금액</th>
                                        <th>층수</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>23.02</td>
                                        <td>3억 8,200만</td>
                                        <td>11층</td>
                                      </tr>
                                      <tr>
                                        <td>23.02</td>
                                        <td>3억 8,200만</td>
                                        <td>11층</td>
                                      </tr>
                                      <tr>
                                        <td>23.02</td>
                                        <td>3억 8,200만</td>
                                        <td>11층</td>
                                      </tr>
                                      <tr>
                                        <td>23.02</td>
                                        <td>3억 8,200만</td>
                                        <td>11층</td>
                                      </tr>
                                      <tr>
                                        <td>22.02</td>
                                        <td>3억 8,200만</td>
                                        <td>11층</td>
                                      </tr>
                                      <tr>
                                        <td>22.02</td>
                                        <td>3억 8,200만</td>
                                        <td>11층</td>
                                      </tr>
                                      <tr>
                                        <td>22.02</td>
                                        <td>3억 8,200만</td>
                                        <td>11층</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>

                                <div class="btn_more_open">더보기</div>
                              </div>
                            </div>
                            <hr class="space exp mt20">

                            <h4 class="mt20">평단가 기준 유사 실거래 사례</h4>

                            <div class="section_price_wrap mt20">
                              <div class="default_box showstep1">
                                <table class="table_type_1">
                                  <colgroup>
                                    <col width="60">
                                    <col width="*">
                                    <col width="100">
                                    <col width="100">
                                  </colgroup>
                                  <thead>
                                    <tr>
                                      <th>거래일</th>
                                      <th>단지명</th>
                                      <th>거래금액</th>
                                      <th>금액/평단가</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>23.01</td>
                                      <td>한신아파트</td>
                                      <td>1122.44㎡</td>
                                      <td>2 억 8,200만<p class="gray_deep">820만/㎡</p></td>
                                    </tr>
                                    <tr>
                                      <td>23.01</td>
                                      <td>구로 힐스테이트</td>
                                      <td>48.6㎡</td>
                                      <td>2억 8,200만<p class="gray_deep">820만/㎡</p></td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>

                              <div class="btn_more_open">더보기</div>
                            </div>
                          </div>
                          <!-- 거래내역 : e -->
                        </div>
                        <div class="sction_item">
                          <!-- 건물·토지정보 : s -->
                          <div class="side_section"><h4>건물·토지정보</h4></div>

                          <div class="open_con_wrap building_item_1">
                            <div class="open_trigger">동별정보 <span><img src="images/dropdown_arrow.png"></span></div>
                            <div class="con_panel">
                              <div class="default_box showstep1">
                                <table class="table_type_1">
                                  <colgroup>
                                    <col width="40">
                                    <col width="*">
                                    <col width="55">
                                    <col width="50">
                                    <col width="90">
                                  </colgroup>
                                  <thead>
                                    <tr>
                                      <th class="txt_sm">선택</th>
                                      <th class="txt_sm">대장종류</th>
                                      <th class="txt_sm">동</th>
                                      <th class="txt_sm">주용도</th>
                                      <th class="txt_sm">면적</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td class="txt_sm">
                                        <input type="radio" name="select" id="select_1" checked>
                                        <label for="select_1"><span></span></label>
                                      </td>
                                      <td class="txt_sm">총괄표제부(집합)</td>
                                      <td class="txt_sm">-</td>
                                      <td class="txt_sm">-</td>
                                      <td class="txt_sm">1582.26㎡</td>
                                    </tr>
                                    <tr>
                                      <td class="txt_sm">
                                        <input type="radio" name="select" id="select_1">
                                        <label for="select_1"><span></span></label>
                                      </td>
                                      <td class="txt_sm">일반건축물(일반)</td>
                                      <td class="txt_sm">관리사무소</td>
                                      <td class="txt_sm">공동주택</td>
                                      <td class="txt_sm">582.6㎡</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="btn_more_open">더보기</div>
                            </div>

                          </div>

                          <div class="building_item_0">
                            <div class="default_box showstep1">
                              <div class="table_container2_sm mt10">
                                <div class="td">규모</div>
                                <div class="td">지하 3층 / 지상 22층</div>
                                <div class="td">사용승인일</div>
                                <div class="td">2002년 11월 28일</div>
                                <div class="td">주용도</div>
                                <div class="td">공동주택</div>
                                <div class="td">건축면적</div>
                                <div class="td">136.17㎡</div>
                                <div class="td">연면적</div>
                                <div class="td">58.77㎡</div>
                                <div class="td">대지면적</div>
                                <div class="td">58.77㎡</div>
                                <div class="td">주구조</div>
                                <div class="td">철근콘크리트구조</div>
                                <div class="td">지붕구조</div>
                                <div class="td">(철근)콘크리트</div>
                                <div class="td">엘리베이터</div>
                                <div class="td">총 3대</div>
                                <div class="td">용적률</div>
                                <div class="td">218.32%</div>
                                <div class="td">건폐율</div>
                                <div class="td">58.77%</div>
                              </div>
                            </div>
                            <div class="btn_more_open">더보기</div>
                          </div>


                          <div class="open_con_wrap building_item_2">
                            <div class="open_trigger">층별 정보 <span><img src="images/dropdown_arrow.png"></span></div>
                            <div class="con_panel">
                                <div class="default_box showstep1">
                                  <table class="table_type_1">
                                    <colgroup>
                                      <col width="60">
                                      <col width="*">
                                      <col width="100">
                                    </colgroup>
                                    <thead>
                                      <tr>
                                        <th>층수</th>
                                        <th>용도</th>
                                        <th>면적</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>B3층</td>
                                        <td>아파트</td>
                                        <td>1122.44㎡</td>
                                      </tr>
                                      <tr>
                                        <td>B3층</td>
                                        <td>아파트</td>
                                        <td>1122.44㎡</td>
                                      </tr>
                                      <tr>
                                        <td>B3층</td>
                                        <td>아파트</td>
                                        <td>1122.44㎡</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="btn_more_open">더보기</div>
                            </div>
                          </div>

                          <div class="open_con_wrap building_item_3">
                            <div class="open_trigger">전유부 <span><img src="images/dropdown_arrow.png"></span></div>
                            <div class="con_panel">
                              <div class="dropdown_box s_sm w_40">
                                <button class="dropdown_label">103동 - 102</button>
                                <ul class="optionList">
                                    <li class="optionItem">103동 - 102</li>
                                </ul>
                              </div>

                                <div class="default_box showstep1 mt10">
                                  <table class="table_type_1">
                                    <colgroup>
                                      <col width="50">
                                      <col width="50">
                                      <col width="60">
                                      <col width="*">
                                      <col width="100">
                                    </colgroup>
                                    <thead>
                                      <tr>
                                        <th>구분</th>
                                        <th>층별</th>
                                        <th>건축물</th>
                                        <th>용도</th>
                                        <th>면적</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>전유</td>
                                        <td>B1층</td>
                                        <td>주</td>
                                        <td>복도, 화장실</td>
                                        <td>1122.44㎡</td>
                                      </tr>
                                      <tr>
                                        <td>공용</td>
                                        <td>각층</td>
                                        <td>부속</td>
                                        <td>전기실, 기계실</td>
                                        <td>1122.44㎡</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>

                            </div>
                          </div>

                          <div class="open_con_wrap building_item_4">
                            <div class="open_trigger">토지정보 <span><img src="images/dropdown_arrow.png"></span></div>
                            <div class="con_panel">
                              <div class="default_box showstep1">
                                <div class="table_container2_sm mt10">
                                  <div class="td">면적</div>
                                  <div class="td">569.44㎡</div>
                                  <div class="td">지목</div>
                                  <div class="td">대</div>
                                  <div class="td">용도지역</div>
                                  <div class="td">제1종일반주거지역</div>
                                  <div class="td">이용상황</div>
                                  <div class="td">아파트</div>
                                  <div class="td">형상</div>
                                  <div class="td">사다리형</div>
                                  <div class="td">지형높이</div>
                                  <div class="td">급경사</div>
                                  <div class="td">동 개별 공시지가(원/m²)</div>
                                  <div class="td">415000</div>
                                  <div class="td">지역지구등<br>지정여부</div>
                                  <div class="td">과밀억제권역,정비구역(도렴도시환경정비사업),가축사육제한구역,대공방어협조구역(위탁고도:54-236m),도시지역,일반상업지역,4대문안</div>
                                </div>
                              </div>
                              <div class="btn_more_open">더보기</div>
                            </div>
                          </div>

                          <!-- 건물·토지정보 : e -->
                        </div>
                        <div class="sction_item">
                          <!-- 위치정보 : s -->
                          <div class="side_section">
                            <h4>위치 및 주변정보</h4>
                            <div class="container_map_wrap mt18"><img src="images/s_map.png" class="w_100"></div>
                            <div class="map_detail_wrp">
                              <ul class="tab_toggle_menu tab_type_4">
                                <li class="active"><a href="javascript:(0)">대중교통</a></li>
                                <li><a href="javascript:(0)">편의시설</a></li>
                                <li><a href="javascript:(0)">교육시설</a></li>
                              </ul>
                              <div class="tab_area_wrap">
                                <div class="traffic_wrap">
                                  <div class="traffic_tit"><img src="images/ic_subway.png">지하철</div>
                                  <p class="traffic_row">가산디지털단지역 1호선, 3호선 <span>15~20분이내</span></p>
                                  <p class="traffic_row">가산디지털단지역 7호선 <span>15~20분이내</span></p>

                                  <div class="traffic_tit mt28"><img src="images/ic_bus.png">버스</div>
                                  <p class="traffic_row">정류장 <span>15~20분이내</span></p>

                                </div>
                                <div>
                                  <div class="facility_wrap">
                                    관공서(양천세무서) 병원(다민한의원, 신천호한의원) 백화점(목동현대백화점) 공원(양천공원) 기타(안양천)
                                  </div>
                                </div>
                                <div>
                                  <div class="edu_wrap">
                                    초등학교(신목) 중학교(목동) 고등학교(신목)
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- 위치정보 : s -->
                        </div>
                        <div class="sction_item">
                          <div class="side_section">
                            <div class="flex_between">
                              <h4>매물정보</h4>
                              <button class="btn_xs btn_gray btn_all" onclick="location.href='property_map.html'">매물 더보기<img src="images/ic_list_arrow.png"></button>
                            </div>
                          </div>

                          <div class="side_section">
                              <div class="empty_wrap box_type">
                                <p>등록된 매물이 없습니다.</p>
                                <span>찾고 있는 매물이 있다면<br>검색을 통해 직접 매물을 탐색해보세요.</span>
                                <div class="mt8"><button class="btn_point_ghost btn_md" onclick="location.href='property_map.html'">매물 검색하기</button></div>
                              </div>
                          </div>


                          <div class="property_sm_list">
                            <div class="frame_img_mid">
                              <span class="btn_wish_sm" onclick="btn_wish(this)"></span>
                              <div class="img_box"><img src="images/s_3.png"></div>
                            </div>
                            <div class="property_sm_info">
                              <p class="property_sm_item_1">매매 2억 9,900만</p>
                              <p class="txt_lh_1">사무실 강남구 논현동</p>
                              <p class="txt_lh_1">62.11㎡ / 46.2㎡·3층</p>
                              <p class="property_sm_item_2">영등포시장역 도보 1분 초역세권 매물 소개를 합니다.</p>
                            </div>
                          </div>

                          <div class="property_sm_list">
                            <div class="frame_img_mid">
                              <span class="btn_wish_sm" onclick="btn_wish(this)"></span>
                              <div class="img_box"><img src="images/s_3.png"></div>
                            </div>
                            <div class="property_sm_info">
                              <p class="property_sm_item_1">매매 2억 9,900만</p>
                              <p class="txt_lh_1">사무실 강남구 논현동</p>
                              <p class="txt_lh_1">62.11㎡ / 46.2㎡·3층</p>
                              <p class="property_sm_item_2">영등포시장역 도보 1분 초역세권 매물 소개를 합니다.</p>
                            </div>
                          </div>

                          <div class="side_section">
                            <div class="btn_half_wrap">
                              <button class="btn_point btn_full_thin" onclick="location.href='offer_step_1.html'">매물 구하기</button>
                              <button class="btn_point btn_full_thin" onclick="location.href='estate_reg_1.html'">매물 내놓기</button>
                            </div>
                          </div>


                        </div>
                    </div>

                  </div>


                </div>
                <!-- map side : e -->

                <div class="map_area">
                  <div class="map_side_btn">
                    <div>
                      <button><img src="images/ic_map_activate1.png"></button>
                      <div class="btn_zoom">
                        <button><img src="images/ic_map_activate2.png"></button>
                        <button><img src="images/ic_map_activate3.png"></button>
                      </div>
                    </div>
                    <div class="btn_view_type">
                      <button>지적도</button>
                      <button>위성뷰</button>
                    </div>
                    <button><img src="images/ic_map_activate4.png"></button>
                  </div>
                  <button class="map_view_btn">익선동 <span class="txt_point">실거래가</span> 보기</button>
                  <div class="map_bottom_btn">
                    <button onclick="location.href='estate_reg_1.html'"><img src="images/ic_org_estate.png">매물 내놓기</button>
                    <button onclick="location.href='offer_step_1.html'"><img src="images/btn_point_search.png">매물 구하기</button>
                  </div>
                  <script type="text/javascript" src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId=7etdlg7znh"></script>
                  <div id="map" style="width:100%; height:100%;"></div>
                  <script>
                    var cityhall = new naver.maps.LatLng(37.5666805, 126.9784147),
                    map = new naver.maps.Map('map', {
                        center: cityhall.destinationPoint(0, 500),
                        zoom: 15
                    }),
                    marker = new naver.maps.Marker({
                        map: map,
                        position: cityhall
                    });
                    var contentString = [
                            '<div class="iw_inner detail_info_toggle">',
                            '   <h3>서울특별시청</h3>',
                            '     <div class="inner_info">',
                            '       <p>매매 <span>1,234~1,234</span></p>',
                            '       <p>임대 <span>1.2~3.4</span></p>',
                            '     </div>',
                            '</div>'
                        ].join('');

                    var infowindow = new naver.maps.InfoWindow({
                        content: contentString,
                        borderColor: "#",
                        backgroundColor: "#",
                        anchorColor: "#",
                        pixelOffset: new naver.maps.Point(60, 50)
                    });

                    infowindow.open(map, marker);

                    // side 상세화면 열기
                    document.querySelector('.detail_info_toggle').addEventListener('click', function() {
                      document.querySelector('.map_side').classList.toggle('active');
                    });
                    </script>
                </div>
            </div>

            </div>
        </div>
    <!-- nav : s -->
    <nav>
      <ul>
          <li>
            <a href="main.html"><span><img src="images/mcnu_ic_1.png" alt=""></span>홈</a>
          </li>
          <li class="active">
            <a href="sales_list.html"><span><img src="images/mcnu_ic_2.png" alt=""></span>분양현장</a>
          </li>
          <li>
            <a href="m_map.html"><span><img src="images/mcnu_ic_3.png" alt=""></span>지도</a>
          </li>
          <li>
            <a href="community_contents_list.html"><span><img src="images/mcnu_ic_5.png" alt=""></span>커뮤니티</a>
          </li>
          <li>
            <a href="my_main.html"><span><img src="images/mcnu_ic_4.png" alt=""></span>마이페이지</a>
          </li>
      </ul>
    </nav>
    <!-- nav : e -->
    <script>
    //공유하기 레이어
    $(".btn_share").click(function(){
            $(".layer_share_wrap").stop().slideToggle(0);
            return false;
        });

    //슬라이드 탭
    function showContent(index) {
        var tabContents = document.querySelectorAll('.side_tab_wrap .sction_item');
        tabContents.forEach(function(content) {
            content.classList.remove('active');
        });
        tabContents[index].classList.add('active');
    }

      //페이지 탭
      var detail_tab = new Swiper(".detail_tab", {
            slidesPerView: 'auto',
            freeMode: true,
            breakpointsInverse: true,
            breakpoints: {
                1023: {
                    allowTouchMove: true
                }
            },
            navigation: {
                  nextEl: ".swiper-button-next",
                  prevEl: ".swiper-button-prev",
                },
            });



      //컨텐츠 더보기 기능
        document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn_more_open').forEach(function(btn) {
          btn.addEventListener('click', function(e) {
            let box = this.previousElementSibling; // 클릭한 버튼의 이전 요소(박스) 선택
            let classList = box.classList; // 박스의 클래스 정보 얻기
            let contentHeight = box.offsetHeight; // 박스의 높이 얻기

            if (classList.contains('showstep2')) {
              classList.remove('showstep2');
              classList.add('showstep1');
              this.textContent = '더보기';
              this.classList.remove('close');
            } else if (classList.contains('showstep1')) {
              classList.remove('showstep1');
              classList.add('showstep2');
              this.textContent = '접기';
              this.classList.add('close');
            }
          });
        });
      });

      // 필터 열기
     const filterBtns = document.querySelectorAll('.filter_btn_trigger');
      filterBtns.forEach(btn => {
        btn.addEventListener('click', function(event) {
          const parent = this.parentElement;
          const panel = parent.querySelector('.filter_panel');

          document.querySelectorAll('.filter_panel').forEach(p => {
            if (p !== panel && p.style.display === 'block') {
              p.style.display = 'none';
            }
          });
          panel.style.display = (panel.style.display === 'block') ? 'none' : 'block';
          event.stopPropagation();
        });
      });

      document.addEventListener('click', function(event) {
        const isOutsideFilterPanel = !event.target.closest('.filter_panel');
        if (isOutsideFilterPanel) {
          document.querySelectorAll('.filter_panel').forEach(p => {
            p.style.display = 'none';
          });
        }
      });

    </script>

    <script>
      var slider = document.querySelector("#rangeItem_1");
      var valueMin = document.querySelector("#item_1_min");
      var valueMax = document.querySelector("#item_1_max");
      var item1txt = document.querySelector("#item_1_txt");

      noUiSlider.create(slider, {
          start: [0, 100],
          connect: true,
          range: {
              "min": 0,
              "max": 100
          }
      });

      slider.noUiSlider.on("update", function (values, handle) {
          if (values[0] < 0 || values[1] > 99) {
              item1txt.innerHTML = "전체";
          } else {
              valueMin.innerHTML = values[0];
              valueMax.innerHTML = values[1];
              item1txt.innerHTML = "<span id='kt_slider_basic_min'>" + values[0] + "원</span> ~ <span id='kt_slider_basic_max'>" + values[1] + "원</span>";
          }
      });
    </script>


    </body>

</x-layout>
