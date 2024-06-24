<x-layout>
    @inject('carbon', 'Carbon\Carbon')
    @php
        $square = $result->square ?? 1;
        $price = $result->priceInfo->price;
        $service_price = $result->service_price;
        $month_price = $result->priceInfo->month_price;
        $loan_type = $result->loan_type;
        $current_price = $result->priceInfo->current_price;
        $current_month_price = $result->priceInfo->current_month_price;
        $commission = $result->commission !== null ? number_format($result->commission) : '0';
        if ($square == 0) {
            $square = 1;
        }

        $approveDate = $result->approve_date ?? '-';
        $displayDate = $approveDate !== '-' ? Str::substr($approveDate, 0, 4) : '-'; // 사용승인연도

        $formatPrice = Commons::get_priceTrans($price); // 매매가
        $formatMonthPrice = Commons::get_priceTrans($month_price); // 월세
        $formatAveragePrice = Commons::get_priceTrans($price / $square); // 평단가 = 가격 / 분양면적(공급면적)
        $formatServicePrice = Commons::get_priceTrans($service_price); // 관리비
        $formatCurrentPrice = Commons::get_priceTrans($current_price); // 현재 매물 보증금
        $formatCurrentMonthPrice = Commons::get_priceTrans($current_month_price); // 현재 매물 월임대료
    @endphp
    <!-- top : s -->
    <div class="room_info_wrap">
        <div class="inner_wrap room_info_inner">
            <div>
                <span
                    class="txt_item_1">{{ $result->region_address }}·{{ Lang::get('commons.product_type.' . $result->type) }}</span>
                <span class="txt_item_2 square">공급 {{ $result->square ?? '-' }}㎡ / 전용
                    {{ $result->exclusive_square ?? '-' }}㎡</span>
                <span class="txt_item_2 area" style="display: none">공급 {{ $result->area ?? '-' }}㎡ / 전용
                    {{ $result->exclusive_area ?? '-' }}평</span>
            </div>
            <div class="txt_item_3">
                {{ Lang::get('commons.payment_type.' . $result->priceInfo->payment_type) }}
                {{-- 20억 4000만 --}}
                {{ $formatPrice }}
                {{-- 월세/단기임대 --}}
                @if (in_array($result->priceInfo->payment_type, [2, 4]))
                    / {{ $formatMonthPrice }}
                @endif
            </div>
        </div>
    </div>
    <!-- top : e -->

    <!-- m::header bar : s -->
    <div class="m_header transparent">
        <div class="left_area">
            <a href="javascript:history.go(-1)" class="btn_back"><img
                    src="{{ asset('assets/media/header_btn_back_w.png') }}"></a>
            <span>매물번호 {{ $result->product_number }}</span>
        </div>
        <div class="right_area">
            <a href="#" class="btn_share"><img src="{{ asset('assets/media/header_btn_share_w.png') }}"
                    onclick="modal_open_slide('share')"></a>
        </div>
    </div>
    <div class="modal_slide modal_slide_share">
        <div class="slide_title_wrap">
            <span>공유하기</span>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('share')">
        </div>
        <div class="slide_modal_body">
            <div class="layer_share_con">
                <a class="kakaotalk-sharing-btn" href="javascript:;">
                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                    <p class="mt8">카카오톡</p>
                </a>
                <a href="javascript:void(0);" onclick="urlCopy();">
                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
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

                            @if (count($result->images) > 0)
                                @foreach ($result->images as $item)
                                    <div class="swiper-slide">
                                        <div class="img_box">
                                            <img src="{{ Storage::url('image/' . $item->path) }}"
                                                onerror="this.src='{{ asset('assets/media/s_1.png') }}';">
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            {{-- <div class="swiper-slide">
                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                            </div>
                            <div class="swiper-slide">
                                <div class="img_box"><img src="{{ asset('assets/media/s_2.png') }}"></div>
                            </div> --}}
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <span class="swiper-pagination"></span>
                    </div>
                </div>

                {{-- 매물 요약 정보 - 상단 --}}
                <div class="room_detail_info">
                    <p class="txt_item_1">매물번호 {{ $result->product_number }}</p>
                    <div class="txt_change_wrap">
                        <div class="txt_item_2">
                            <span>{{ Lang::get('commons.payment_type.' . $result->priceInfo->payment_type) }}</span>
                            {{ $formatPrice }}
                            {{-- 월세/단기임대 --}}
                            @if (in_array($result->priceInfo->payment_type, [2, 4]))
                                / {{ $formatMonthPrice }}
                            @endif
                        </div>
                        <div class="txt_item_3">{{ $result->region_address }}</div>
                    </div>

                    {{-- https://devtalk.kakao.com/t/api/126032 --}}
                    {{-- <div class="txt_item_4">강남역 도보 3분</div> --}}
                    <div class="txt_item_4"></div>
                    <div class="txt_item_5">
                        <span>전용</span>
                        <spann class="square">{{ $result->exclusive_square ?? '-' }}㎡</spann> &nbsp;
                        <spann class="area" style="display: none">{{ $result->exclusive_area ?? '-' }}평</spann>
                        &nbsp;
                        @if ($result->priceInfo->payment_type == 0)
                            <span>평단가</span> {{ $formatAveragePrice }}
                        @endif
                    </div>
                    {{-- 매물 요약 정보 - 하단 --}}
                    <ul class="txt_item_6">
                        <li>
                            {{ $result->floor_number ?? '-' }}층/{{ $result->total_floor_number ?? '-' }}층<p>해당/전체층</p>
                            <i>|</i>
                        </li>
                        <li>
                            {{ $displayDate }}년 <span>사용승인</span>
                            <p>사용승인연도</p><i>|</i>
                        </li>
                        <li>
                            <span>관리비</span>
                            @if ($result->is_service === 0)
                                {{ $formatServicePrice }}<p>관리비</p>
                            @else
                                없음
                            @endif
                        </li>
                    </ul>
                    <div class="detail_btn_wrap">
                        <span class="btn_room_wish {{ $result->like_id > 0 ? 'on' : '' }}" onclick="btn_wish(this)">관심
                            매물 등록</span>
                        <span class="btn_room_share btn_share"></span>
                        <!-- 공유하기 : s -->
                        <div class="layer layer_share_wrap">
                            <div class="layer_title">
                                <h5>공유하기</h5>
                                <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close btn_share">
                            </div>
                            <div class="layer_share_con">
                                <a class="kakaotalk-sharing-btn" href="javascript:;">
                                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                    <p class="mt8">카카오톡</p>
                                </a>
                                <a href="javascript:void(0);" onclick="urlCopy();">
                                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                    <p class="mt8">링크복사</p>
                                </a>
                            </div>
                        </div>
                        <!-- 공유하기 : e -->
                    </div>
                </div>
            </div>
            @if ($result->image_link != null)
                <a href="{{ $result->image_link ?? '#' }}" class="btn_3d"><img
                        src="{{ asset('assets/media/ic_3d.png') }}" alt="3d 매물보기">3D로 매물보기 </a>
            @endif

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


        @php
            $paymentTypes = [
                0 => '매매가',
                1 => '임대',
                2 => '단기임대',
                3 => '전세가',
                4 => '월세가',
                5 => '전매가',
            ];
            $paymentType = $result->priceInfo->payment_type;
            $isDiscussion = $result->priceInfo->is_price_discussion == 1 ? '협의가능' : '';
        @endphp
        <!-- section 2 : s -->
        <div class="inner_wrap room_section_wrap">
            {{-- 가격정보 --}}
            <div>
                <section id="tab_area_1" class="page">
                    <h3>가격정보</h3>
                    <div class="table_container">
                        @if (isset($paymentTypes[$paymentType]))
                            <div>
                                {{ $paymentTypes[$paymentType] }}
                                @if ($paymentType != 0)
                                    <span class="gray_basic">({{ $isDiscussion }}/㎡)</span>
                                @endif
                            </div>
                        @endif
                        <div class="item_col_3">{{ $formatPrice }}
                            <span class="gray_basic">({{ $formatAveragePrice }}/㎡)</span>
                        </div>
                        <div>관리비</div>
                        <div class="item_col_3">
                            @if ($result->is_service === 0)
                                {{ $formatServicePrice }}
                                <span class="gray_basic only_m">
                                    @php
                                        $serviceTypes = [];
                                        foreach ($result->productServices as $productService) {
                                            $serviceTypes[] = Lang::get(
                                                'commons.product_type.' . $productService->type,
                                            );
                                        }
                                    @endphp
                                    {{ join(', ', $serviceTypes) }}
                                </span>
                            @else
                                없음
                            @endif
                        </div>
                        {{-- 기존 임대차 내용 없음으로 선택한 경우 노출하지 않음 --}}
                        @if ($result->priceInfo->is_use == 1)
                            <div>융자금</div>
                            <div class="item_col_3">
                                @if ($result->loan_type == 1)
                                    30%미만 {{ number_format($result->loan_price) }}원
                                @elseif($result->loan_type == 2)
                                    30%이상 {{ number_format($result->loan_price) }}원
                                @else
                                    없음
                                @endif
                            </div>
                        @endif
                        {{--
                            매매일 때
                            기존 임대차 내용 없음으로 선택한 경우 노출하지 않음
                            --}}
                        @if ($result->priceInfo->payment_type == 0 && $result->priceInfo->is_use == 1)
                            <div>기존 임대차 내용</div>
                            <div class="item_col_3">보증금 {{ $formatCurrentPrice }} / 월세 {{ $formatCurrentMonthPrice }}
                            </div>
                        @endif
                    </div>
                </section>

                <div id="tab_area_2" class="page">
                    <section>
                        <h3>상세정보</h3>
                        <div class="table_container">
                            <div>매물 종류</div>
                            <div>{{ Lang::get('commons.product_type.' . $result->type) }}</div>
                            <div>주용도</div>
                            <div>{{ Lang::get('commons.building_type.' . $result->building_type) }}</div>
                            <div>소재지</div>
                            <div class="item_col_3">{{ $result->address }}</div>
                            <div>공급/전용면적</div>
                            <div>공급 {{ $result->square ?? '-' }}㎡ / 전용
                                {{ $result->exclusive_square ?? '-' }}㎡</div>
                            {{-- 전용면적 / 공급면적 * 100 --}}
                            <div>전용률</div>
                            <div>{{ round(($result->exclusive_square / $result->square) * 100) }}%</div>
                            <div>해당층/전체층</div>
                            <div>{{ $result->floor_number . '층 / ' . $result->total_floor_number . '층' }}</div>
                            <div>입주가능일</div>
                            <div>
                                {{-- 2023.06.15 <span class="gray_basic">협의가능</span> --}}
                                @if ($result->move_type == 0)
                                    즉시입주
                                @elseif($result->move_type == 1)
                                    날짜협의
                                @else
                                    {{ $carbon::parse($result->move_date)->format('Y.m.d') }}
                                @endif
                            </div>
                            <div>방향</div>
                            <div>{{ Lang::get('commons.direction_type.' . $result->productAddInfo->direction_type) }}향
                                <span class="gray_basic">거실기준</span>
                            </div>
                            {{-- <div>남향 <span class="gray_basic">거실기준</span></div> --}}
                            <div>방/욕실 수</div>
                            <div>{{ $result->productAddInfo->room_count }}개 /
                                {{ $result->productAddInfo->bathroom_count }}개</div>
                            <div>현관구조</div>
                            <div>계단식</div>
                            <div>난방종류</div>
                            <div>{{ Lang::get('commons.heating_type.' . $result->productAddInfo->heating_type) }}</div>
                            <div>엘리베이터</div>
                            <div>있음</div>
                            <div>주차 여부</div>
                            <div>
                                @switch($result->parking_type)
                                    @case(0)
                                    @break

                                    @case(1)
                                        가능,
                                        {{ $result->parking_price == null || $result->parking_price == 0 ? '무료주차' : Commons::get_priceTrans($result->parking_price) }}
                                    @break

                                    @case(2)
                                        불가능
                                    @break

                                    @default
                                @endswitch
                                {{-- 가능, 주차비 3만원 --}}
                            </div>
                        </div>
                    </section>

                    @php
                        $optionCount = collect($result->productOptions)->count(); // 옵션 개수
                        // 시설
                        $facility = collect($result->productOptions)->contains(function ($item) {
                            return in_array($item->type, [0, 1]);
                        });
                        // 보안
                        $security = collect($result->productOptions)->contains(function ($item) {
                            return in_array($item->type, [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]);
                        });
                        // 주방
                        $kitchen = collect($result->productOptions)->contains(function ($item) {
                            return in_array($item->type, [13, 14, 15, 16, 17, 18]);
                        });
                        // 가전
                        $home_appliances = collect($result->productOptions)->contains(function ($item) {
                            return in_array($item->type, [19, 20, 21, 22, 23, 24]);
                        });
                        // 가구
                        $furniture = collect($result->productOptions)->contains(function ($item) {
                            return in_array($item->type, [25, 26, 27, 28, 29]);
                        });
                        // 기타
                        $etc = collect($result->productOptions)->contains(function ($item) {
                            return in_array($item->type, [30, 31, 32, 33]);
                        });

                    @endphp
                    <section>
                        @if ($facility > 0)
                            <h3>옵션 <span class="fs_16 gray_basic txt_normal">{{ $optionCount }}개</span></h3>
                            <article class="room_option_wrap">
                                <p class="option_title">시설</p>
                                <div class="swiper option_swiper">
                                    <div class="swiper-wrapper">

                                        @foreach ($result->productOptions as $item)
                                            @if (in_array($item->type, [0, 1]))
                                                @php
                                                    $imageNumber = $item->type == 0 ? 6 : ($item->type == 1 ? 7 : '');
                                                @endphp
                                                <div class="swiper-slide">
                                                    <img
                                                        src="{{ asset('assets/media/option_1_' . $imageNumber . '.png') }}">
                                                    <p>{{ Lang::get('commons.option_facility.' . $item->type) }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @endif

                        @if ($security > 0)
                            <article class="room_option_wrap">
                                <p class="option_title">보안</p>
                                <div class="swiper option_swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($result->productOptions as $item)
                                            @if (in_array($item->type, [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]))
                                                @php
                                                    $typeToImageNumber = [
                                                        2 => 3,
                                                        3 => 8,
                                                        4 => 9,
                                                        5 => 10,
                                                        6 => 11,
                                                        7 => 6,
                                                        8 => 7,
                                                        9 => 8,
                                                        10 => 1,
                                                        11 => 2,
                                                        12 => 4,
                                                    ];
                                                    $imageNumber = $typeToImageNumber[$item->type] ?? '';
                                                @endphp
                                                <div class="swiper-slide">
                                                    <img
                                                        src="{{ asset('assets/media/option_2_' . $imageNumber . '.png') }}">
                                                    <p>{{ Lang::get('commons.option_security.' . $item->type) }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @endif

                        @if ($kitchen > 0)
                            <article class="room_option_wrap">
                                <p class="option_title">주방</p>
                                <div class="swiper option_swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($result->productOptions as $item)
                                            @if (in_array($item->type, [13, 14, 15, 16, 17, 18]))
                                                @php
                                                    $typeToImageNumber = [
                                                        13 => 1,
                                                        14 => 2,
                                                        15 => 3,
                                                        16 => 4,
                                                        17 => 5,
                                                        18 => 6,
                                                    ];
                                                    $imageNumber = $typeToImageNumber[$item->type] ?? '';
                                                @endphp
                                                <div class="swiper-slide">
                                                    <img
                                                        src="{{ asset('assets/media/option_3_' . $imageNumber . '.png') }}">
                                                    <p>{{ Lang::get('commons.option_kitchen.' . $item->type) }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @endif

                        @if ($home_appliances > 0)
                            <article class="room_option_wrap">
                                <p class="option_title">가전</p>
                                <div class="swiper option_swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($result->productOptions as $item)
                                            @if (in_array($item->type, [19, 20, 21, 22, 23, 24]))
                                                @php
                                                    $typeToImageNumber = [
                                                        19 => 1,
                                                        20 => 2,
                                                        21 => 3,
                                                        22 => 4,
                                                        23 => 5,
                                                        24 => 6,
                                                    ];
                                                    $imageNumber = $typeToImageNumber[$item->type] ?? '';
                                                @endphp
                                                <div class="swiper-slide">
                                                    <img
                                                        src="{{ asset('assets/media/option_4_' . $imageNumber . '.png') }}">
                                                    <p>{{ Lang::get('commons.option_home_appliances.' . $item->type) }}
                                                    </p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @endif

                        @if ($furniture > 0)
                            <article class="room_option_wrap">
                                <p class="option_title">가구</p>
                                <div class="swiper option_swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($result->productOptions as $item)
                                            @if (in_array($item->type, [25, 26, 27, 28, 29]))
                                                @php
                                                    $typeToImageNumber = [
                                                        25 => 1,
                                                        26 => 2,
                                                        27 => 3,
                                                        28 => 4,
                                                        29 => 5,
                                                        30 => 6,
                                                    ];
                                                    $imageNumber = $typeToImageNumber[$item->type] ?? '';
                                                @endphp
                                                <div class="swiper-slide">
                                                    <img
                                                        src="{{ asset('assets/media/option_5_' . $imageNumber . '.png') }}">
                                                    <p>{{ Lang::get('commons.option_furniture.' . $item->type) }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @endif

                        @if ($etc > 0)
                            <article class="room_option_wrap">
                                <p class="option_title">기타</p>
                                <div class="swiper option_swiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($result->productOptions as $item)
                                            @if (in_array($item->type, [30, 31, 32, 33]))
                                                @php
                                                    $typeToImageNumber = [
                                                        30 => 1,
                                                        31 => 2,
                                                        32 => 3,
                                                        33 => 4,
                                                    ];
                                                    $imageNumber = $typeToImageNumber[$item->type] ?? '';
                                                @endphp
                                                <div class="swiper-slide">
                                                    <img
                                                        src="{{ asset('assets/media/option_6_' . $imageNumber . '.png') }}">
                                                    <p>{{ Lang::get('commons.option_etc.' . $item->type) }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </article>
                        @endif
                    </section>
                </div>

                <div class="page" id="tab_area_3">
                    <section>
                        <h3>상세설명</h3>
                        <div class="detail_info_container">
                            @php
                                if ($result->contents != '') {
                                    echo nl2br($result->contents);
                                } else {
                                    echo '-';
                                }
                            @endphp
                        </div>
                        <!-- 닫기 열기 텍스트는 css에 있음 -->
                        <!-- <input type="checkbox" class="detail_info_container_btn"> -->
                        <div class="mt28">
                            <button class="btn_point_ghost btn_full_basic" target="_blank"
                                onclick="location.href='https://rt.molit.go.kr/'">실거래가 확인하러 가기</button>
                        </div>


                    </section>

                </div>

                {{-- 기획서, 디자인없는 탭 일단 주석함 --}}
                {{-- <section class="page" id="tab_area_4">
                    <h3>위치 및 주변정보</h3>
                    <div class="container_map_wrap"><img src="{{ asset('assets/media/s_map.png') }}" class="w_100">
                    </div>
                    <div class="map_detail_wrp">
                        <ul class="tab_toggle_menu tab_type_4">
                            <li class="active"><a href="javascript:(0)">대중교통</a></li>
                            <li><a href="javascript:(0)">편의시설</a></li>
                            <li><a href="javascript:(0)">교육시설</a></li>
                        </ul>
                        <div class="tab_area_wrap">
                            <div class="traffic_wrap">
                                <div class="traffic_tit"><img src="{{ asset('assets/media/ic_subway.png') }}">지하철
                                </div>
                                <p class="traffic_row">가산디지털단지역 1호선, 3호선 <span>15~20분이내</span></p>
                                <p class="traffic_row">가산디지털단지역 7호선 <span>15~20분이내</span></p>

                                <div class="traffic_tit mt28"><img src="{{ asset('assets/media/ic_bus.png') }}">버스
                                </div>
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
                </section> --}}

                <div class="page" id="tab_area_5">
                    <section>
                        <h3>중개보수</h3>
                        <ul class="mediation_price">
                            <li>
                                <div class="gray_deep">중개보수<span class="gray_basic">(부가세 별도)</span></div>
                                <div class="txt_point">{{ $commission }}원</div>
                            </li>
                            <li>
                                <div class="gray_deep">상한요율</div>
                                <div>{{ $result->commission_rate ?? '0' }}%</div>
                            </li>
                        </ul>
                        <p class="gray_basic mt20">중개보수는 실제 적용되는 금액과 다를 수 있습니다.</p>
                    </section>

                    <div class="agent_box only_m">
                        <div class="agent_box_info">
                            <div class="agent_box_img">
                                <div class="img_box">
                                    @if (count($result->users->images) > 0)
                                        <img src="{{ Storage::url('image/' . $result->users->images[0]->path) }}"
                                            onerror="this.src='{{ asset('assets/media/default_img.png') }}';"
                                            loading="lazy">
                                    @else
                                        <img src="{{ asset('assets/media/default_img.png') }}">
                                    @endif
                                </div>
                            </div>
                            <h4>{{ $result->users->company_name ?? '-' }}</h4>
                            <p>대표중개사 {{ $result->users->company_ceo ?? '-' }}</p>
                        </div>
                        <hr class="mt18">
                        <div class="add_info_wrap">
                            <div class="info_row"><span class="gray_deep">주소
                                </span>{{ implode(', ', array_filter([$result->users->company_address ?? '', $result->users->company_address_detail ?? '-'])) }}
                            </div>
                            <div class="info_row">
                                <span class="gray_deep">중개등록번호</span>{{ $result->users->company_number ?? '-' }}
                            </div>
                        </div>
                        <button class="btn_point btn_full_thin" onclick="modal_open('agent_qa')">문의하기</button>
                    </div>

                    <section>
                        <h3>이 중개사의 다른 매물</h3>
                        <div class="swiper mediation_room">
                            <div class="swiper-wrapper">
                                @foreach ($result->users->product as $item)
                                    {{-- {{ $item->priceInfo->price }} --}}
                                    @if ($result->id == $item->id)
                                        @continue
                                    @endif
                                    <div class="swiper-slide">
                                        <a href="{{ route('www.map.room.detail', [$item->id]) }}">
                                            <div class="mediation_room_img">
                                                <div class="img_box"><img
                                                        src="{{ Storage::url('image/' . $item->images[0]->path) }}"
                                                        onerror="this.src='{{ asset('assets/media/s_1.png') }}';">
                                                </div>
                                            </div>
                                            <p class="mediation_txt_item1">
                                                {{ Lang::get('commons.payment_type.' . $item->priceInfo->payment_type) }}
                                                {{ Commons::get_priceTrans($item->priceInfo->price) }}
                                                {{-- 월세/단기임대 --}}
                                                @if (in_array($item->priceInfo->payment_type, [2, 4]))
                                                    / {{ Commons::get_priceTrans($item->priceInfo->month_price) }}
                                                @endif
                                            </p>
                                            <p class="mediation_txt_item2">{{ $item->region_address }}</p>
                                            <p class="mediation_txt_item3">{{ $item->square ?? '-' }}㎡ /
                                                {{ $item->exclusive_square ?? '-' }}㎡·{{ $item->floor_number ?? '-' }}층
                                            </p>
                                            {{-- <p class="mediation_txt_item3">62.11㎡ / 46.2㎡·3층</p> --}}
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="t_center">
                                <a href="{{ route('www.map.agent.detail', [$result->users_id]) }}" class="btn_more">더
                                    많은 매물 보러가기</a>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="btn_floting_wrap">
                    <div class="btn_floting top">
                        <img src="{{ asset('assets/media/btn_unit.png') }}" class="toggle_unit" id="toggle_unit"
                            onclick="toggleImage()"><br>
                        <a href="javascript:window.scrollTo(0,0);" class="floting_top"><img
                                src="{{ asset('assets/media/btn_top.png') }}"></a>
                    </div>
                </div>
            </div>
            <div>
                <div class="agent_box only_pc">
                    <div class="agent_box_info">
                        <div class="agent_box_img">
                            <div class="img_box" style="height:60px; width:60px;">
                                @if ($result->users->image != null)
                                    <img src="{{ Storage::url('image/' . $result->users->image->path) }}">
                                @else
                                    <img src="{{ asset('assets/media/default_img.png') }}">
                                @endif
                            </div>
                        </div>
                        <h4>{{ $result->users->company_name ?? '-' }}</h4>
                        <p>대표중개사 {{ $result->users->company_ceo ?? $result->users->name }}</p>
                    </div>
                    <hr class="mt18">
                    <div class="add_info_wrap">
                        <div class="info_row"><span class="gray_deep">주소
                            </span>{{ implode(', ', array_filter([$result->users->company_address ?? '', $result->users->company_address_detail ?? '-'])) }}
                        </div>
                        <div class="info_row"><span class="gray_deep">중개등록번호
                            </span>{{ $result->users->company_number ?? '-' }}</div>
                    </div>
                    <button class="btn_point btn_full_thin" onclick="modal_open('agent_qa')">문의하기</button>
                </div>
            </div>
        </div>
        <!-- section 2 : e -->

        <!-- mobile : bottom floting menu : s -->
        <div class="room_bottom_wrap">
            <div class="btn_bottom_wish {{ $result->like_id > 0 ? 'on' : '' }}" onclick="btn_wish(this)">
                <span></span>관심매물
            </div>
            <button class="btn_point btn_full_floting" onclick="modal_open('agent_qa')">문의하기</button>
        </div>
        <!-- mobile : bottom floting menu : e -->

    </div>

    <!-- modal 문의하기 : s-->
    <div class="modal modal_mid modal_agent_qa">
        <div class="modal_title">
            <h5>문의하기</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('agent_qa')">
        </div>
        <div class="modal_container">
            <div class="agent_popup_info">
                <div class="agent_box_info">
                    <div class="agent_box_img">
                        <div class="img_box">
                            @if (count($result->users->images) > 0)
                                <img src="{{ Storage::url('image/' . $result->users->images[0]->path) }}"
                                    onerror="this.src='{{ asset('assets/media/default_img.png') }}';"
                                    loading="lazy">
                            @else
                                <img src="{{ asset('assets/media/default_img.png') }}">
                            @endif
                        </div>
                    </div>
                    <h4><a href="{{ route('www.map.agent.detail', [$result->users_id]) }}">{{ $result->users->company_name ?? '-' }}
                            <img src="{{ asset('assets/media/ic_list_arrow.png') }}"></a>
                    </h4>
                    <p class="gray_deep">대표중개사 {{ $result->users->company_ceo ?? $result->users->name }}</p>
                </div>
                <div class="agent_popup_detail">
                    <p><span>주소</span>
                        {{ implode(', ', array_filter([$result->users->company_address ?? '', $result->users->company_address_detail ?? '-'])) }}
                    </p>
                    <p><span>중개등록번호</span> {{ $result->users->company_number ?? '-' }}</p>
                    <p><span>대표번호</span> {{ $result->users->company_phone ?? '-' }}</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="agent_contact_wrap">
            <a href="tel:{{ $result->users->phone }}">
                <div class="agent_popup_call"><img src="{{ asset('assets/media/ic_point_call.png') }}">
                    {{ $result->users->phone }}
                </div>
            </a>
            <div class="agent_popup_num">매물번호 {{ $result->product_number }}</div>
            <div class="agent_popup_noti">중개사무소에 연락하여 문의해보세요.<br>공실앤톡에서 보고 문의드린다 말씀하시면,<br>빠른 예약이 가능합니다.</div>
        </div>

    </div>
    <div class="md_overlay md_overlay_agent_qa" onclick="modal_close('agent_qa')"></div>
    <!-- modal 문의하기 : e-->

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

        // 좋아요 토글버튼
        function btn_wish(element) {
            var id = {{ $result->id }}

            var login_check =
                @if (Auth::guard('web')->check())
                    false
                @else
                    true
                @endif ;

            if (login_check) {
                // dialog('로그인이 필요합니다.\n로그인 하시겠어요?', '로그인', '아니요', login);
                return;
            } else {
                var formData = {
                    'target_id': id,
                    'target_type': 'product',
                };

                if ($(element).hasClass("on")) {
                    $(element).removeClass("on");
                } else {
                    $(element).addClass("on");
                }

                $.ajax({
                    type: "post", //전송타입
                    url: "{{ route('www.commons.like') }}",
                    data: formData,
                    success: function(data, status, xhr) {},
                    error: function(xhr, status, e) {}
                });
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
            $('.floting_top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });
        });

        // 단위 변경
        function toggleImage() {

            var image = document.getElementById('toggle_unit');
            const square = document.querySelectorAll(".square");
            const area = document.querySelectorAll(".area");
            if (image.src.match('btn_unit.png')) {
                // m2 -> 평
                image.src = "{{ asset('assets/media/btn_unit2.png') }}";
                square.forEach(square => {
                    square.style.display = "none";
                });
                area.forEach(area => {
                    area.style.display = "";
                });
            } else {
                // 평 -> m2
                image.src = "{{ asset('assets/media/btn_unit.png') }}";
                square.forEach(square => {
                    square.style.display = "";
                });
                area.forEach(area => {
                    area.style.display = "none";
                });
            }
        }

        // 모바일 header
        let criteria_scroll_top = 0;
        $(window).on('scroll', function() {
            let scrollTop = $(this).scrollTop();
            if (scrollTop > criteria_scroll_top) {
                $('.m_header').removeClass('transparent');
                $('.m_header').find('.btn_back').find('img').attr('src',
                    '{{ asset('assets/media/header_btn_back_deep.png') }}');
                $('.m_header').find('.btn_share').find('img').attr('src',
                    '{{ asset('assets/media/header_btn_share_deep.png') }}');
            } else {
                $('.m_header').addClass('transparent');
                $('.m_header').find('.btn_back').find('img').attr('src',
                    '{{ asset('assets/media/header_btn_back_w.png') }}');
                $('.m_header').find('.btn_share').find('img').attr('src',
                    '{{ asset('assets/media/header_btn_share_w.png') }}');
            }
        })
    </script>

    {{-- 카카오톡 공유 --}}
    {{-- JavaScript 키, url 변경 수정필요 --}}
    <script src="https://t1.kakaocdn.net/kakao_js_sdk/2.7.2/kakao.min.js"
        integrity="sha384-TiCUE00h649CAMonG018J2ujOgDKW/kVWlChEuu4jK2vxfAAD0eZxzCKakxg55G4" crossorigin="anonymous">
    </script>
    <script>
        Kakao.init('053a66b906cb1cf1d805d47831668657'); // 사용하려는 앱의 JavaScript 키 입력
    </script>

    <script>
        var title = '공실앤톡';
        var imageUrl = "{{ asset('assets/media/default_gs.png') }}";
        var url = "http://localhost"
        var detailUrl = "{{ route('www.map.room.detail', [$result->id]) }}"
        Kakao.Share.createDefaultButton({
            container: '.kakaotalk-sharing-btn',
            objectType: 'feed',
            content: {
                title: title,
                imageUrl: imageUrl,
                link: {
                    // [내 애플리케이션] > [플랫폼] 에서 등록한 사이트 도메인과 일치해야 함
                    mobileWebUrl: url,
                    webUrl: url,
                },
            },
            // social: {
            //     likeCount: 286,
            //     commentCount: 45,
            //     sharedCount: 845,
            // },
            buttons: [{
                    title: '웹으로 보기',
                    link: {
                        mobileWebUrl: detailUrl,
                        webUrl: detailUrl,
                    },
                },
                // {
                //     title: '앱으로 보기',
                //     link: {
                //         mobileWebUrl: detailUrl,
                //         webUrl: detailUrl,
                //     },
                // },
            ],
        });

        function urlCopy() {
            navigator.clipboard.writeText(detailUrl).then(res => {
                alert("링크복사 되었습니다.");
            })
        }
    </script>
</x-layout>
