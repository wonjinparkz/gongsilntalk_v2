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
                    <div class="my_side_top">
                        <div class="my_profile_img">
                            <div class="img_box"><img src="{{ asset('assets/media/default_user.png') }}"></div>
                        </div>
                        <span class="user_name">홍길동님</span>
                    </div>
                    <ul class="my_gnb">
                        <li>
                            <a href="my_estate_list.html">내 매물 관리</a>
                        </li>
                        <li>
                            <a href="my_wish_list.html">관심매물/최근 본 매물</a>
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
                            <a href="my_community_list.html">커뮤니티 게시글 관리</a>
                        </li>
                        <li class="active only_pc">
                            <a href="alarm_list.html">알림</a>
                        </li>
                    </ul>
                    <button class="btn_call">
                        <img src="{{ asset('assets/media/ic_call.png') }}"> 고객센터 문의
                    </button>
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">알림</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5 toggle_tab">
                            <li class="active">전체 알림</li>
                            <li>분양현장 알림</li>
                        </ul>
                    </div>

                    <div class="flex_between my_body_top">
                        <div>
                            미확인 알림 <span class="txt_point">2건</span>
                        </div>

                        <div class="gray_basic">
                            *일주일 후에 자동 삭제됩니다.
                        </div>
                    </div>


                    <!-- 데이터가 없을 경우 : s -->
                    <div class="empty_wrap">
                        <p>새로운 알림이 없습니다.</p>
                        <span>분양현장에서 마음에 드는 분양 매물의<br>‘알림 받기’ 등록을 해보세요.</span>
                        <div class="mt8"><button class="btn_point btn_md_bold">분양현장 바로가기</button></div>
                    </div>
                    <!-- 데이터가 없을 경우 : e -->

                    <!-- list : s -->
                    <div class="alarm_list_wrap">
                        <!-- 전체알림 : s -->
                        <div class="alarm_list">
                            <div>
                                <p class="alarm_item_1"><span class="alarm_tit">등기일 입력 안내<i
                                            title="new"></i></span><span class="alarm_date">2시간전</span></p>
                                <p class="alarm_info"><b>홍길동</b>님이 <b>강남구 역삼동 123-12 / 아파트</b>에 투어를 요청했어요.</p>
                            </div>
                            <div>
                                <button class="btn_sm btn_gray_ghost" onclick="modal_open('check')">요청확인</button>
                            </div>
                        </div>
                        <div class="alarm_list">
                            <div>
                                <p class="alarm_item_1"><span class="alarm_tit">등기일 입력 안내<i
                                            title="new"></i></span><span class="alarm_date">2시간전</span></p>
                                <p class="alarm_info">등록한 자산 <b>삼성 해링턴 타워</b>의 등기일을 업데이트 해주세요.</p>
                            </div>
                            <div>
                                <button class="btn_sm btn_gray_ghost">바로가기</button>
                            </div>
                        </div>
                        <!-- 전체알림 : e -->
                        <!-- 분양현장 알림 : s -->
                        <div class="alarm_list alarm_list_2" onclick="location.href='my_estate_list.html'">
                            <div class="alarm_dday">
                                <p class="alarm_item_1"><span class="alarm_tit">정당 계약일 D-1<i
                                            title="new"></i></span><span class="alarm_date">2시간전</span></p>
                            </div>
                            <div class="alarm_info alarm_address">지식산업센터 놀라움 마곡 서울시 강서구 강동동</div>
                            <div class="alarm_arrow">
                                <img src="{{ asset('assets/media/ic_list_arrow.png') }}" class="w_8p">
                            </div>
                        </div>
                        <!-- 분양현장 알림 : e -->
                    </div>


                    <!-- list : e -->




                </div>
                <!-- my_body : e -->

            </div>

            <!-- modal 요청확인 : s -->
            <div class="modal modal_mid modal_check">
                <div class="modal_title">
                    <h5>투어 요청 확인</h5>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                        onclick="modal_close('check')">
                </div>
                <div class="modal_container">
                    <h6>요청자 정보</h6>
                    <div class="table_container_sm mt8">
                        <div class="td">이름</div>
                        <div class="td">홍길동</div>
                        <div class="td">연락처</div>
                        <div class="td">010-1234-1234</div>
                    </div>

                    <div class="flex_between mt20">
                        <h6>투어 요청 매물 정보</h6>
                        <button class="btn_gray_ghost btn_sm">상세보기</button>
                    </div>
                    <div class="table_container_sm mt8">
                        <div class="td">사진</div>
                        <div class="td">
                            <div class="frame_img_sm">
                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                            </div>
                        </div>
                        <div class="td">주소</div>
                        <div class="td">강남구 역삼동 123-12</div>
                        <div class="td">거래정보</div>
                        <div class="td">임대 3억 2,200만 / 4,500만 <span class="gray_basic">(800만/평)</span></div>
                        <div class="td">면적</div>
                        <div class="td">전용 105.12평 <span class="gray_basic">(347.50㎡)</span></div>
                        <div class="td">층정보</div>
                        <div class="td">3층 / 12층</div>
                        <div class="td">관리비</div>
                        <div class="td">관리비 10만</div>
                    </div>

                </div>
            </div>
            <div class="md_overlay md_overlay_check" onclick="modal_close('check')"></div>
            <!-- modal 요청확인 : e -->

            <!-- nav : s -->
            <nav>
                <ul>
                    <li>
                        <a href="main.html"><span><img src="{{ asset('assets/media/mcnu_ic_1.png') }}"
                                    alt=""></span>홈</a>
                    </li>
                    <li>
                        <a href="sales_list.html"><span><img src="{{ asset('assets/media/mcnu_ic_2.png') }}"
                                    alt=""></span>분양현장</a>
                    </li>
                    <li>
                        <a href="map.html"><span><img src="{{ asset('assets/media/mcnu_ic_3.png') }}"
                                    alt=""></span>지도</a>
                    </li>
                    <li>
                        <a href="community_contents_list.html"><span><img
                                    src="{{ asset('assets/media/mcnu_ic_5.png') }}" alt=""></span>커뮤니티</a>
                    </li>
                    <li class="active">
                        <a href="my_main.html"><span><img src="{{ asset('assets/media/mcnu_ic_4.png') }}"
                                    alt=""></span>마이메뉴</a>
                    </li>
                </ul>
            </nav>
            <!-- nav : e -->


        </div>

    </div>


</x-layout>
