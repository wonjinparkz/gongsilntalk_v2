<x-layout>

    @php

        function priceChange($price)
        {
            if ($price < 0 || empty($price)) {
                $price = 0;
            }

            $priceUnit = ['', '만', '억', '조', '경'];
            $expUnit = 10000;
            $resultArray = [];
            $result = '';

            foreach ($priceUnit as $k => $v) {
                $unitResult = ($price % pow($expUnit, $k + 1)) / pow($expUnit, $k);
                $unitResult = floor($unitResult);

                if ($unitResult > 0) {
                    $resultArray[$k] = $unitResult;
                }
            }

            if (count($resultArray) > 0) {
                foreach ($resultArray as $k => $v) {
                    $result = number_format($v) . $priceUnit[$k] . $result;
                }
            }

            return $result;
        }

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

        function format_tel($tel)
        {
            $tel = preg_replace('/[^0-9]/', '', $tel);

            return preg_replace(
                '/(^02.{0}|^01.{1}|^15.{2}|^16.{2}|^18.{2}|[0-9]{3})([0-9]+)([0-9]{4})/',
                '$1-$2-$3',
                $tel,
            );
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
                                @php
                                    Log::info($alarm->product);
                                @endphp

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
                                        @if ($alarm->title == '투어 요청 안내')
                                            <button class="btn_sm btn_gray_ghost" type="button"
                                                onclick="modal_open('check_{{ $alarm->id }}')">요청확인</button>

                                            <!-- modal 요청확인 : s -->
                                            <div class="modal modal_mid modal_check_{{ $alarm->id }}">
                                                <div class="modal_title">
                                                    <h5>투어 요청 확인</h5>
                                                    <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                        class="md_btn_close"
                                                        onclick="modal_close('check_{{ $alarm->id }}')">
                                                </div>
                                                <div class="modal_container">
                                                    <h6>요청자 정보</h6>
                                                    <div class="table_container_sm mt8">
                                                        <div class="td">이름</div>
                                                        <div class="td">{{ $alarm->tour_users->name }}</div>
                                                        <div class="td">연락처</div>
                                                        <div class="td">{{ format_tel($alarm->tour_users->phone) }}
                                                        </div>
                                                    </div>

                                                    <div class="flex_between mt20">
                                                        <h6>투어 요청 매물 정보</h6>
                                                        <button class="btn_gray_ghost btn_sm">상세보기</button>
                                                    </div>
                                                    <div class="table_container_sm mt8">
                                                        <div class="td">사진</div>
                                                        <div class="td">
                                                            <div class="frame_img_sm">
                                                                <div class="img_box">
                                                                    <img
                                                                        src="{{ Storage::url('image/' . $alarm->product->images[0]->path) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="td">주소</div>
                                                        <div class="td">{{ $alarm->product->address }}</div>
                                                        <div class="td">거래정보</div>
                                                        @php
                                                            $monthPrice = '';
                                                            $priceArea = 0.0;
                                                            if (
                                                                $alarm->product->priceInfo->payment_type == 1 ||
                                                                $alarm->product->priceInfo->payment_type == 2 ||
                                                                $alarm->product->priceInfo->payment_type == 4
                                                            ) {
                                                                $monthPrice =
                                                                    ' / ' .
                                                                    priceChange(
                                                                        $alarm->product->priceInfo->month_price,
                                                                    );
                                                                $priceArea =
                                                                    $alarm->product->priceInfo->month_price /
                                                                    $alarm->product->exclusive_area;
                                                            } else {
                                                                $monthPrice = '';
                                                                $priceArea =
                                                                    $alarm->product->priceInfo->price /
                                                                    $alarm->product->exclusive_area;
                                                            }

                                                        @endphp

                                                        <div class="td">
                                                            {{ Lang::get('commons.payment_type.' . $alarm->product->priceInfo->payment_type) }}
                                                            {{ priceChange($alarm->product->priceInfo->price) }}
                                                            {{ $monthPrice }}
                                                            <span
                                                                class="gray_basic">({{ priceChange($priceArea) }}/평)</span>
                                                        </div>
                                                        <div class="td">면적</div>
                                                        <div class="td">전용 {{ $alarm->product->exclusive_area }}평
                                                            <span
                                                                class="gray_basic">({{ $alarm->product->exclusive_square }}㎡)</span>
                                                        </div>
                                                        <div class="td">층정보</div>
                                                        <div class="td">{{ $alarm->product->floor_number }}층 /
                                                            {{ $alarm->product->total_floor_number }}층</div>
                                                        <div class="td">관리비</div>
                                                        <div class="td">
                                                            {{ $alarm->product->is_service == 0 ? '관리비 ' . number_format($alarm->product->service_price) . '원' : '-' }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="md_overlay md_overlay_check_{{ $alarm->id }}"
                                                onclick="modal_close('check_{{ $alarm->id }}')"></div>
                                            <!-- modal 요청확인 : e -->
                                        @else
                                            {{-- 등기일 입력 안내 알림 --}}
                                            <button class="btn_sm btn_gray_ghost">바로가기</button>
                                        @endif
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


            <!-- nav : s -->
            {{-- <nav>
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
            </nav> --}}
            <!-- nav : e -->

        </div>

    </div>


</x-layout>
