<x-layout>

    <!-- top : s -->
    <div class="room_info_wrap">
        <div class="inner_wrap room_info_inner">
            <div>
                <span class="txt_item_1">서울시 강남구 역삼동·아파트</span>
                <span class="txt_item_2">공급 88.45㎡ / 전용 79.33㎡</span>
            </div>
            <div class="txt_item_3">
                매매 20억 4000만
            </div>
        </div>
    </div>
    <!-- top : e -->

    <!-- m::header bar : s -->
    <div class="m_header transparent">
        <div class="left_area">
            <a href="javascript:history.go(-1)" class="btn_back"><img src="images/header_btn_back_w.png"></a>
            <span>매물번호 354483</span>
        </div>
        <div class="right_area">
            <a href="#" class="btn_share"><img src="images/header_btn_share_w.png"
                    onclick="modal_open_slide('share')"></a>
        </div>
    </div>
    <div class="modal_slide modal_slide_share">
        <div class="slide_title_wrap">
            <span>공유하기</span>
            <img src="images/btn_md_close.png" onclick="modal_close_slide('share')">
        </div>
        <div class="slide_modal_body">
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
    </div>
    <div class="md_slide_overlay md_slide_overlay_share" onclick="modal_close_slide('share')"></div>
    <!-- m::header bar : s -->


    <div class="body">
        <div class="inner_wrap">
            <!-- section 1 : s -->
            <div class="room_section_1">
                <div class="room_detail_img">
                    <div class="swiper room_img">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="img_box"><img src="images/s_1.png"></div>
                            </div>
                            <div class="swiper-slide">
                                <div class="img_box"><img src="images/s_2.png"></div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <span class="swiper-pagination"></span>
                    </div>
                </div>

                <div class="room_detail_info">
                    <p class="txt_item_1">매물번호 35448331</p>
                    <div class="txt_change_wrap">
                        <div class="txt_item_2"><span>매매</span> 20억 4,000만</div>
                        <div class="txt_item_3">강남구 역삼동 아파트</div>
                    </div>
                    <div class="txt_item_4">강남역 도보 3분</div>
                    <div class="txt_item_5">
                        <span>전용</span> 79.33㎡ &nbsp;
                        <span>전용</span> 2,640만원
                    </div>
                    <ul class="txt_item_6">
                        <li>
                            11층/12층<p>해당/전체층</p><i>|</i>
                        </li>
                        <li>
                            2023년 <span>사용승인</span>
                            <p>사용승인연도</p><i>|</i>
                        </li>
                        <li>
                            <span>관리비</span> 100만원<p>관리비</p>
                        </li>
                    </ul>
                    <div class="detail_btn_wrap">
                        <span class="btn_room_wish" onclick="btn_wish(this)">관심 매물 등록</span>
                        <span class="btn_room_share btn_share"></span>
                        <!-- 공유하기 : s -->
                        <div class="layer layer_share_wrap">
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
                </div>
            </div>
            <a href="#" class="btn_3d"><img src="images/ic_3d.png" alt="3d 매물보기">3D로 매물보기</a>

        </div>
        <!-- section 1 : e -->



        <!-- tab : s -->
        <div class="tab_type_2">
            <div class="inner_wrap">
                <div class="swiper-container detail_tab">
                    <div class="swiper-wrapper menu">
                        <div class="swiper-slide active"><a href="#tab_area_1">가격정보</a></div>
                        <div class="swiper-slide"><a href="#tab_area_2">상세정보</a></div>
                        <div class="swiper-slide"><a href="#tab_area_3">상세설명</a></div>
                        <div class="swiper-slide"><a href="#tab_area_4">위치 및 주변정보</a></div>
                        <div class="swiper-slide"><a href="#tab_area_5">중개사 정보</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tab : s -->



        <!-- section 2 : s -->
        <div class="inner_wrap room_section_wrap">

            <div>
                <section id="tab_area_1" class="page">
                    <h3>가격정보</h3>
                    <div class="table_container">
                        <div>매매가</div>
                        <div class="item_col_3">20억 4,000만원 <span class="gray_basic">(2,400만/㎡)</span></div>
                        <div>관리비</div>
                        <div class="item_col_3">10만원 <span class="gray_basic only_m">청소비, 인터넷, 수선유지비</span></div>
                        <div>기존 임대차 내용</div>
                        <div class="item_col_3">보증금 2,000만 / 월세 600만</div>
                        <div>융자금</div>
                        <div class="item_col_3">없음</div>
                    </div>
                </section>

                <div id="tab_area_2" class="page">
                    <section>
                        <h3>상세정보</h3>
                        <div class="table_container">
                            <div>매물 종류</div>
                            <div>아파트</div>
                            <div>주용도</div>
                            <div>공동주택</div>
                            <div>소재지</div>
                            <div class="item_col_3">서울시 강남구 역삼동</div>
                            <div>공급/전용면적</div>
                            <div>88.45㎡ / 79.33㎡</div>
                            <div>전용률</div>
                            <div>55%</div>
                            <div>해당층/전체층</div>
                            <div>11층 / 12층</div>
                            <div>입주가능일</div>
                            <div>2023.06.15 <span class="gray_basic">협의가능</span></div>
                            <div>방향</div>
                            <div>남향 <span class="gray_basic">거실기준</span></div>
                            <div>방/욕실 수</div>
                            <div>2개 / 1개</div>
                            <div>현관구조</div>
                            <div>계단식</div>
                            <div>난방종류</div>
                            <div>개별난방</div>
                            <div>엘리베이터</div>
                            <div>있음</div>
                            <div>주차 여부</div>
                            <div>가능, 주차비 3만원</div>
                        </div>
                    </section>

                    <section>
                        <h3>옵션 <span class="fs_16 gray_basic txt_normal">18개</span></h3>
                        <article class="room_option_wrap">
                            <p class="option_title">시설</p>
                            <div class="swiper option_swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="images/option_1_1.png" alt="창고">
                                        <p>창고</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_1_2.png" alt="급수시설">
                                        <p>급수시설</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_1_3.png" alt="급배기시설">
                                        <p>급배기시설</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_1_4.png" alt="환기시설">
                                        <p>환기시설</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_1_5.png" alt="휴게공간">
                                        <p>휴게공간</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_1_6.png" alt="베란다">
                                        <p>베란다</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_1_7.png" alt="테라스">
                                        <p>테라스</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="room_option_wrap">
                            <p class="option_title">보안</p>
                            <div class="swiper option_swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="images/option_2_1.png" alt="CCTV">
                                        <p>CCTV</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_2.png" alt="자체경비원">
                                        <p>자체경비원</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_3.png" alt="디지털도어락">
                                        <p>디지털도어락</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_4.png" alt="관리인 상주">
                                        <p>관리인 상주</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_5.png" alt="소화기">
                                        <p>소화기</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_6.png" alt="화재감지기">
                                        <p>화재감지기</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_7.png" alt="화재경보기">
                                        <p>화재경보기</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_8.png" alt="카드키">
                                        <p>카드키</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_9.png" alt="무인택배함">
                                        <p>무인택배함</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_10.png" alt="방범창">
                                        <p>방범창</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_2_11.png" alt="비디오폰">
                                        <p>비디오폰</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="room_option_wrap">
                            <p class="option_title">주방</p>
                            <div class="swiper option_swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="images/option_3_1.png" alt="인덕션">
                                        <p>인덕션</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_3_2.png" alt="가스레인지">
                                        <p>가스레인지</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_3_3.png" alt="전자레인지">
                                        <p>전자레인지</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_3_4.png" alt="오븐">
                                        <p>오븐</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_3_5.png" alt="식기세척기">
                                        <p>식기세척기</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_3_6.png" alt="싱크대">
                                        <p>싱크대</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="room_option_wrap">
                            <p class="option_title">가전</p>
                            <div class="swiper option_swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="images/option_4_1.png" alt="무선인터넷">
                                        <p>무선인터넷</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_4_2.png" alt="에어컨">
                                        <p>에어컨</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_4_3.png" alt="세탁기">
                                        <p>세탁기</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_4_4.png" alt="냉장고">
                                        <p>냉장고</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_4_5.png" alt="TV">
                                        <p>TV</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_4_6.png" alt="비데">
                                        <p>비데</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="room_option_wrap">
                            <p class="option_title">가구</p>
                            <div class="swiper option_swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="images/option_5_1.png" alt="붙박이장">
                                        <p>붙박이장</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_5_2.png" alt="드레스룸">
                                        <p>드레스룸</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_5_3.png" alt="신발장">
                                        <p>신발장</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_5_4.png" alt="욕조">
                                        <p>욕조</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_5_5.png" alt="식탁">
                                        <p>식탁</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <article class="room_option_wrap">
                            <p class="option_title">기타</p>
                            <div class="swiper option_swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><img src="images/option_6_1.png" alt="베란다">
                                        <p>베란다</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_6_2.png" alt="테라스">
                                        <p>테라스</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_6_3.png" alt="발코니">
                                        <p>발코니</p>
                                    </div>
                                    <div class="swiper-slide"><img src="images/option_6_4.png" alt="욕조">
                                        <p>마당</p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </section>
                </div>

                <div class="page" id="tab_area_3">
                    <section>
                        <h3>상세설명</h3>
                        <div class="detail_info_container">
                            구로역 도보 1분 초역세권 매물<br>
                            보기 드문 4분거리 구로역 근처 좋은 매물 소개드립니다.<br>
                            *1. 실평수 14평의 넓게 나온 분리형 원룸입니다.<br>
                            2. 주차비 없는 자주식 주차로 어떤 차종이든 가능합니다.<br>3. 아일랜드 식탁이 있는 편리한 부엌구조입니다.<br><br>
                            구로역 도보 1분 초역세권 매물<br>
                            보기 드문 4분거리 구로역 근처 좋은 매물 소개드립니다.<br>
                            *1. 실평수 14평의 넓게 나온 분리형 원룸입니다.<br>
                        </div>
                        <!-- 닫기 열기 텍스트는 css에 있음 -->
                        <!-- <input type="checkbox" class="detail_info_container_btn"> -->
                        <div class="mt28">
                            <button class="btn_point_ghost btn_full_basic" target="_blank"
                                onclick="location.href='https://rt.molit.go.kr/'">실거래가 확인하러 가기</button>
                        </div>


                    </section>

                </div>

                <section class="page" id="tab_area_4">
                    <h3>위치 및 주변정보</h3>
                    <div class="container_map_wrap"><img src="images/s_map.png" class="w_100"></div>
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
                </section>

                <div class="page" id="tab_area_5">
                    <section>
                        <h3>중개보수</h3>
                        <ul class="mediation_price">
                            <li>
                                <div class="gray_deep">중개보수<span class="gray_basic">(부가세 별도)</span></div>
                                <div class="txt_point">660,000원</div>
                            </li>
                            <li>
                                <div class="gray_deep">상한요율</div>
                                <div>0.3%</div>
                            </li>
                        </ul>
                        <p class="gray_basic mt20">중개보수는 실제 적용되는 금액과 다를 수 있습니다.</p>
                    </section>

                    <div class="agent_box only_m">
                        <div class="agent_box_info">
                            <div class="agent_box_img">
                                <div class="img_box"><img src="images/default_img.png"></div>
                            </div>
                            <h4>공실앤톡부동산중개사무소</h4>
                            <p>대표중개사 홍길동</p>
                        </div>
                        <hr class="mt18">
                        <div class="add_info_wrap">
                            <div class="info_row"><span class="gray_deep">주소 </span>울시 구로구 공원로 99, 102호</div>
                            <div class="info_row"><span class="gray_deep">중개등록번호</span>12345-1234-12345</div>
                        </div>
                        <button class="btn_point btn_full_thin">문의하기</button>
                    </div>

                    <section>
                        <h3>이 중개사의 다른 매물</h3>
                        <div class="swiper mediation_room">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <a href="#">
                                        <div class="mediation_room_img">
                                            <div class="img_box"><img src="images/s_1.png"></div>
                                        </div>
                                        <p class="mediation_txt_item1">매매 13억 2,000만원</p>
                                        <p class="mediation_txt_item2">사무실 강남구 논현동</p>
                                        <p class="mediation_txt_item3">62.11㎡ / 46.2㎡·3층</p>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#">
                                        <div class="mediation_room_img">
                                            <div class="img_box"><img src="images/s_1.png"></div>
                                        </div>
                                        <p class="mediation_txt_item1">매매 13억 2,000만원</p>
                                        <p class="mediation_txt_item2">사무실 강남구 논현동</p>
                                        <p class="mediation_txt_item3">62.11㎡ / 46.2㎡·3층</p>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#">
                                        <div class="mediation_room_img">
                                            <div class="img_box"><img src="images/s_1.png"></div>
                                        </div>
                                        <p class="mediation_txt_item1">매매 13억 2,000만원</p>
                                        <p class="mediation_txt_item2">사무실 강남구 논현동</p>
                                        <p class="mediation_txt_item3">62.11㎡ / 46.2㎡·3층</p>
                                    </a>
                                </div>
                            </div>

                            <div class="t_center">
                                <a href="#" class="btn_more">더 많은 매물 보러가기</a>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="btn_floting_wrap">
                    <div class="btn_floting top">
                        <a href="#"><img src="images/btn_unit.png"></a><br>
                        <a href="javascript:window.scrollTo(0,0);"><img src="images/btn_top.png"></a>
                    </div>
                </div>
            </div>
            <div>
                <div class="agent_box only_pc">
                    <div class="agent_box_info">
                        <div class="agent_box_img">
                            <div class="img_box"><img src="images/default_img.png"></div>
                        </div>
                        <h4>공실앤톡부동산중개사무소</h4>
                        <p>대표중개사 홍길동</p>
                    </div>
                    <hr class="mt18">
                    <div class="add_info_wrap">
                        <div class="info_row"><span class="gray_deep">주소 </span>울시 구로구 공원로 99, 102호</div>
                        <div class="info_row"><span class="gray_deep">중개등록번호</span>12345-1234-12345</div>
                    </div>
                    <button class="btn_point btn_full_thin">문의하기</button>
                </div>
            </div>
        </div>
        <!-- section 2 : e -->

        <!-- mobile : bottom floting menu : s -->
        <div class="room_bottom_wrap">
            <div class="btn_bottom_wish" onclick="btn_wish(this)"><span></span>관심매물</div>
            <button class="btn_point btn_full_floting">문의하기</button>
        </div>
        <!-- mobile : bottom floting menu : e -->

    </div>



    <script>
        //방 이미지
        var room_img = new Swiper(".room_img", {
            pagination: {
                el: ".swiper-pagination",
                type: "fraction",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        //중개사의 다른 매물
        var mediation_room = new Swiper(".mediation_room", {
            slidesPerView: 3,
            spaceBetween: 30,
            breakpoints: {
                // 화면의 넓이가 320px 이상일 때
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // 화면의 넓이가 640px 이상일 때
                640: {
                    slidesPerView: 3,
                    spaceBetween: 30
                }
            }
        });

        //페이지 탭
        var detail_tab = new Swiper(".detail_tab", {
            slidesPerView: 'auto',
            freeMode: true,
            breakpointsInverse: true,
            breakpoints: {
                1023: {
                    allowTouchMove: false
                }
            }
        });

        //옵션
        var option_swiper = new Swiper(".option_swiper", {
            slidesPerView: 'auto',
            freeMode: true,
            breakpointsInverse: true,
            breakpoints: {
                1023: {
                    // allowTouchMove: false
                }
            }
        });

        // 관심매물 토글버튼
        function btn_wish(element) {
            if ($(element).hasClass("on")) {
                $(element).removeClass("on");
            } else {
                $(element).addClass("on");
            }
        }

        //공유하기 레이어
        $(".btn_share").click(function() {
            $(".layer_share_wrap").stop().slideToggle(0);
            return false;
        });

        // top 버튼
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.top').fadeIn();
                } else {
                    $('.top').fadeOut();
                }
            });
            $('.top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });
        });

        // 모바일 header
        let criteria_scroll_top = 0;
        $(window).on('scroll', function() {
            let scrollTop = $(this).scrollTop();
            if (scrollTop > criteria_scroll_top) {
                $('.m_header').removeClass('transparent');
                $('.m_header').find('.btn_back').find('img').attr('src', 'images/header_btn_back_deep.png');
                $('.m_header').find('.btn_share').find('img').attr('src', 'images/header_btn_share_deep.png');
            } else {
                $('.m_header').addClass('transparent');
                $('.m_header').find('.btn_back').find('img').attr('src', 'images/header_btn_back_w.png');
                $('.m_header').find('.btn_share').find('img').attr('src', 'images/header_btn_share_w.png');
            }
        })
    </script>
</x-layout>
