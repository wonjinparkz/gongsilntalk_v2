<x-layout>

    @php

        function onDateChange($created_date)
        {
            $to = new DateTime();
            $from = new DateTime($created_date);

            $chkday = $created_date;
            $nowday = date('Y-m-d H:i:s');

            $gapMinute = (int) ((strtotime($nowday) - strtotime($chkday)) / 60);

            $date = date_diff($from, $to)->days;

            if ($date == 0) {
                $dateText = '방금';

                if ($gapMinute > 0) {
                    if ($gapMinute > 60) {
                        $dateText = floor($gapMinute / 60) . '시간 전';
                    } else {
                        $dateText = $gapMinute . '분 전';
                    }
                }
            } else {
                if ($date < 7) {
                    $dateText = $date . '일 전';
                } elseif ($date > 6 && $date < 30) {
                    $dateText = floor($date / 7) . '주 전';
                } elseif ($date > 29 && $date < 366) {
                    $dateText = floor($date / 30) . '달 전';
                } elseif ($date > 365) {
                    $dateText = floor($date / 365) . '년 전';
                }
            }

            return $dateText;
        }

    @endphp
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
                    <h1 class="t_center only_pc">알림</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5 toggle_tab">
                            <li class="active">전체 알림</li>
                            <li>분양현장 알림</li>
                        </ul>
                    </div>

                    <div class="flex_between my_body_top">
                        <div>
                            미확인 알림 <span class="txt_point">{{ $checkCount }}건</span>
                        </div>

                        <div class="gray_basic">
                            *일주일 후에 자동 삭제됩니다.
                        </div>
                    </div>

                    @if (count($alarmList) < 1)
                        <!-- 데이터가 없을 경우 : s -->
                        <div class="empty_wrap">
                            <p>새로운 알림이 없습니다.</p>
                            <span>분양현장에서 마음에 드는 분양 매물의<br>‘알림 받기’ 등록을 해보세요.</span>
                            <div class="mt8"><button class="btn_point btn_md_bold">분양현장 바로가기</button></div>
                        </div>
                        <!-- 데이터가 없을 경우 : e -->
                    @else
                        <!-- list : s -->
                        <div class="alarm_list_wrap">
                            @foreach ($alarmList as $alarm)
                                <!-- 전체알림 : s -->

                                <div class="alarm_list">
                                    <div>
                                        <p class="alarm_item_1">
                                            <span class="alarm_tit">{{ $alarm->title }}
                                                @if ($alarm->readed_at == null)
                                                    <i title="new"></i>
                                                @endif
                                            </span>
                                            <span class="alarm_date">{{ onDateChange($alarm->created_at) }}</span>
                                        </p>
                                        <p class="alarm_info">{!! $alarm->body !!}</p>
                                    </div>
                                    <div>
                                        {{-- 투어 요청 안내 알림 --}}
                                        <button class="btn_sm btn_gray_ghost" type="button"
                                            onclick="modal_open('check')">요청확인</button>

                                        {{-- 등기일 입력 안내 알림 --}}
                                        {{-- <button class="btn_sm btn_gray_ghost">바로가기</button> --}}
                                    </div>
                                </div>

                                <!-- 전체알림 : e -->
                                <!-- 분양현장 알림 : s -->
                                {{-- <div class="alarm_list alarm_list_2" onclick="location.href='my_estate_list.html'">
                                <div class="alarm_dday">
                                    <p class="alarm_item_1"><span class="alarm_tit">정당 계약일 D-1<i
                                                title="new"></i></span><span class="alarm_date">2시간전</span></p>
                                </div>
                                <div class="alarm_info alarm_address">지식산업센터 놀라움 마곡 서울시 강서구 강동동</div>
                                <div class="alarm_arrow">
                                    <img src="{{ asset('assets/media/ic_list_arrow.png') }}" class="w_8p">
                                </div>
                            </div> --}}
                                <!-- 분양현장 알림 : e -->
                            @endforeach
                        </div>
                    @endif
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
                        <a href="javascript:history.go(-1)"><span><img src="{{ asset('assets/media/mcnu_ic_4.png') }}"
                                    alt=""></span>마이메뉴</a>
                    </li>
                </ul>
            </nav>
            <!-- nav : e -->


        </div>

    </div>


</x-layout>
