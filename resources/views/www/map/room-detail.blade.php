<x-layout>
    @inject('carbon', 'Carbon\Carbon')
    @php
        $exclusive_square = $result->exclusive_square > 0 ? $result->exclusive_square : 1;
        $exclusive_area = $result->exclusive_area > 0 ? $result->exclusive_area : 1;
        $price = $result->priceInfo->price;
        $service_price = $result->service_price;
        $month_price = $result->priceInfo->month_price;
        $loan_type = $result->loan_type;
        $current_price = $result->priceInfo->current_price;
        $current_month_price = $result->priceInfo->current_month_price;
        $commission = $result->commission !== null ? number_format($result->commission) : '0';

        $approveDate = $result->approve_date ?? '-';
        $displayDate = $approveDate !== '-' ? Str::substr($approveDate, 0, 4) : '-'; // 사용승인연도

        $formatPrice = Commons::get_priceTrans($price); // 매매가
        $formatMonthPrice = Commons::get_priceTrans($month_price); // 월세
        $formatAveragePrice = Commons::get_priceTrans($price / $result->square); // 평단가 = 가격 / 분양면적(공급면적)
        $formatAveragePrice1 = Commons::get_priceTrans($price / $result->area); // 평단가 = 가격 / 분양면적(공급면적)
        $formatServicePrice = Commons::get_priceTrans($service_price); // 관리비
        $formatCurrentPrice = Commons::get_priceTrans($current_price); // 현재 매물 보증금
        $formatCurrentMonthPrice = Commons::get_priceTrans($current_month_price); // 현재 매물 월임대료
    @endphp

    <script type="text/javascript"
        src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
    </script>

    <!-- top : s -->
    <div class="room_info_wrap">
        <div class="inner_wrap room_info_inner">
            <div>
                <span
                    class="txt_item_1">{{ $result->region_address }}·{{ Lang::get('commons.product_type.' . $result->type) }}</span>
                @if ($result->type != 6)
                    <span class="txt_item_2 square">공급 {{ $result->square ?? '-' }}㎡ / 전용
                        {{ $result->exclusive_square ?? '-' }}㎡</span>
                    <span class="txt_item_2 area" style="display: none">공급 {{ $result->area ?? '-' }}평 / 전용
                        {{ $result->exclusive_area ?? '-' }}평</span>
                @else
                    <span class="txt_item_2 square">{{ $result->square ?? '-' }}㎡ </span>
                    <span class="txt_item_2 area" style="display: none">{{ $result->area ?? '-' }}평 </span>
                @endif
            </div>
            <div class="txt_item_3">
                {{ Lang::get('commons.payment_type.' . $result->priceInfo->payment_type) }}
                {{-- 20억 4000만 --}}
                {{ $formatPrice }}
                {{-- 월세/단기임대 --}}
                @if (in_array($result->priceInfo->payment_type, [1, 2, 4]))
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
                        </div>
                        <div class="swiper-button-next"><img src="{{ asset('assets/media/arrow_w_next.png') }}">
                        </div>
                        <div class="swiper-button-prev"><img src="{{ asset('assets/media/arrow_w_prev.png') }}">
                        </div>
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
                            @if (in_array($result->priceInfo->payment_type, [1, 2, 4]))
                                / {{ $formatMonthPrice }}
                            @endif
                        </div>
                        <div class="txt_item_3">{{ $result->region_address }}</div>
                    </div>

                    {{-- https://devtalk.kakao.com/t/api/126032 --}}
                    {{-- <div class="txt_item_4">강남역 도보 3분</div> --}}
                    <div class="txt_item_4"></div>
                    <div class="txt_item_5">
                        @if ($result->type != 6)
                            <span>전용</span>
                            <spann class="square">{{ $result->exclusive_square ?? '-' }}㎡</spann> &nbsp;
                            <spann class="area" style="display: none">{{ $result->exclusive_area ?? '-' }}평</spann>
                        @else
                            <span>대지</span>
                            <spann class="square">{{ $result->square ?? '-' }}㎡</spann> &nbsp;
                            <spann class="area" style="display: none">{{ $result->area ?? '-' }}평</spann>
                        @endif
                        &nbsp;

                        @if ($result->priceInfo->payment_type == 0)
                            <span>단가</span>
                            <spann class="square">{{ $formatAveragePrice }}</spann> &nbsp;
                            <spann class="area" style="display: none">{{ $formatAveragePrice1 }}</spann>
                        @endif
                    </div>
                    {{-- 매물 요약 정보 - 하단 --}}
                    @if ($result->type != 6)
                        <ul class="txt_item_6">
                            <li>
                                {{ $result->floor_number ?? '-' }}층/{{ $result->total_floor_number ?? '-' }}층<p>해당/전체층
                                </p>
                                <i>|</i>
                            </li>
                            <li>
                                {{ $displayDate }}년 <span>{{ $result->type < 14 ? '사용승인' : '준공일' }}</span>
                                <p>{{ $result->type < 14 ? '사용승인' : '준공일' }}연도</p><i>|</i>
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
                    @endif
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
                        <div class="swiper-slide"><a href="#tab_area_4">위치정보</a></div>
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
                3 => '전세',
                4 => '월세',
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
                            </div>
                        @endif
                        <div class="item_col_3">{{ $formatPrice }}
                            @if (in_array($result->priceInfo->payment_type, [1, 2, 4]))
                                / {{ $formatMonthPrice }}
                            @endif
                        </div>
                        <div>관리비</div>
                        <div class="item_col_3">
                            @if ($result->is_service === 0)
                                {{ $formatServicePrice }}
                                <span class="gray_basic">
                                    @php
                                        $serviceTypes = [];
                                        foreach ($result->productServices as $productService) {
                                            $serviceTypes[] = Lang::get(
                                                'commons.service_type.' . $productService->type,
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
                        {{--
                            매매일 때
                            기존 임대차 내용 없음으로 선택한 경우 노출하지 않음
                            --}}
                        <div>기존 임대차 내용</div>
                        <div class="item_col_3">
                            @if ($result->priceInfo->is_use == 1)
                                보증금 {{ $formatCurrentPrice }} / 월세 {{ $formatCurrentMonthPrice }}
                            @else
                                없음
                            @endif
                        </div>

                        {{-- 상가 권리금 --}}
                        @if ($result->type == 3)
                            <div>권리금</div>
                            <div class="item_col_3">
                                @if ($result->priceInfo->is_premium == 1)
                                    {{ number_format($result->priceInfo->premium_price) }}원
                                @else
                                    없음
                                @endif
                            </div>
                        @endif
                    </div>
                </section>

                <div id="tab_area_2" class="page">
                    <section>
                        <h3>상세정보</h3>
                        <div class="table_container">
                            @php
                                $type = $result->type;

                                if ($type == 14) {
                                    $type = 0;
                                } elseif ($type == 15) {
                                    $type = 3;
                                } elseif ($type == 16) {
                                    $type = 8;
                                } elseif ($type == 17) {
                                    $type = 9;
                                }
                            @endphp
                            @if ($type != 6)
                                <div>매물 종류</div>
                                <div>{{ Lang::get('commons.product_type.' . $type) }}</div>
                                <div>소재지</div>
                                <div>{{ $result->region_address }}</div>
                                @if (!in_array($type, [5, 7]))
                                    <div>공급/전용면적</div>
                                    <div class="area_chage">공급 {{ $result->square ?? '-' }}㎡ / 전용
                                        {{ $result->exclusive_square ?? '-' }}㎡</div>
                                    <div>전용률</div>
                                    <div>{{ round(($result->exclusive_square / $result->square) * 100) }}%</div>
                                    <div>해당층/전체층</div>
                                    <div>{{ $result->floor_number . '층 / ' . $result->total_floor_number . '층' }}</div>
                                @endif
                                @if (in_array($type, [5, 7]))
                                    <div>대지/연면적</div>
                                    <div class="area_chage">대지 {{ $result->square ?? '-' }}㎡ / 연
                                        {{ $result->total_floor_square ?? '-' }}㎡</div>
                                    @if ($type == 7)
                                        <div>전용면적</div>
                                        <div class="area_chage">
                                            {{ $result->exclusive_square ?? '-' }}㎡
                                        </div>
                                        <div>전용률</div>
                                        <div>{{ round(($result->exclusive_square / $result->square) * 100) }}%</div>
                                    @endif
                                    <div>최저층/최고층</div>
                                    <div>{{ $result->lowest_floor_number . '층 / ' . $result->top_floor_number . '층' }}
                                    </div>
                                @endif
                                <div>입주가능일</div>
                                <div>
                                    @if ($result->move_type == 0)
                                        즉시입주
                                    @elseif($result->move_type == 1)
                                        날짜협의
                                    @else
                                        {{ $carbon::parse($result->move_date)->format('Y.m.d') }}
                                    @endif
                                </div>
                                @if (in_array($type, [0, 1, 2, 4, 7]))
                                    @if ($type != 7)
                                        <div>인테리어 여부</div>
                                        <div>
                                            @if ($result->productAddInfo->interior_type == 1)
                                                있음
                                            @elseif ($result->productAddInfo->interior_type == 2)
                                                없음
                                            @else
                                                -
                                            @endif
                                        </div>
                                        <div>하중 (평당)</div>
                                        <div>
                                            {{ $result->productAddInfo->weight != '' ? $result->productAddInfo->weight . '톤' : '-' }}
                                        </div>
                                    @endif
                                    @if ($type == 7)
                                        <div>도크</div>
                                        <div>{{ $result->productAddInfo->is_dock == 0 ? '없음' : '있음' }}</div>
                                        <div>호이스트</div>
                                        <div>{{ $result->productAddInfo->is_hoist == 0 ? '없음' : '있음' }}</div>
                                    @endif
                                    <div>승강시설</div>
                                    <div>{{ $result->productAddInfo->is_elevator == 0 ? '없음' : '있음' }}</div>
                                    <div>화물용 승강시설</div>
                                    <div>{{ $result->productAddInfo->is_goods_elevator == 0 ? '없음' : '있음' }}</div>
                                    <div>층고</div>
                                    <div>
                                        {{ $result->productAddInfo->floor_height_type != '' ? Lang::get('commons.floor_height_type.' . $result->productAddInfo->floor_height_type) : '-' }}
                                    </div>
                                    <div>사용전력</div>
                                    <div>
                                        {{ $result->productAddInfo->wattage_type != '' ? Lang::get('commons.wattage_type.' . $result->productAddInfo->wattage_type) : '-' }}
                                    </div>
                                @endif
                                @if ($type == 3)
                                    <div>현 업종</div>
                                    <div>
                                        {{ Lang::get('commons.product_business_type.' . $result->productAddInfo->current_business_type) }}
                                    </div>
                                    <div>추천 업종</div>
                                    <div>
                                        {{ Lang::get('commons.product_business_type.' . $result->productAddInfo->recommend_business_type) }}
                                    </div>
                                @endif
                                <div>건물 방향</div>
                                <div>
                                    @if ($result->productAddInfo->direction_type != '')
                                        {{ Lang::get('commons.direction_type.' . $result->productAddInfo->direction_type) }}향
                                        <span class="gray_basic">(주 출입구 기준)</span>
                                    @endif
                                </div>
                                @if (!in_array($type, [0, 1, 2, 3, 4, 5, 7]))
                                    <div>방/욕실 수</div>
                                    <div>{{ $result->productAddInfo->room_count }}개 /
                                        {{ $result->productAddInfo->bathroom_count }}개</div>
                                @endif
                                @if ($result->product_type == 9)
                                    <div>구조</div>
                                    <div>
                                        @if ($result->productAddInfo->structure_type == 1)
                                            복층
                                        @elseif ($result->productAddInfo->structure_type == 2)
                                            1.5룸/주방분리형
                                        @else
                                            선택안함
                                        @endif
                                    </div>
                                    <div>빌트인</div>
                                    <div>
                                        @if ($result->productAddInfo->builtin_type == 1)
                                            있음
                                        @elseif ($result->productAddInfo->builtin_type == 2)
                                            없음
                                        @else
                                            선택안함
                                        @endif
                                    </div>
                                @endif
                                <div>냉방종류</div>
                                <div>
                                    {{ $result->productAddInfo->cooling_type != '' ? Lang::get('commons.cooling_type.' . $result->productAddInfo->cooling_type) : '-' }}
                                </div>
                                <div>난방종류</div>
                                <div>
                                    {{ $result->productAddInfo->heating_type != '' ? Lang::get('commons.heating_type.' . $result->productAddInfo->heating_type) : '-' }}
                                </div>
                                @if (!in_array($type, [0, 1, 2, 4, 7]))
                                    <div>승강시설</div>
                                    <div>{{ $result->is_elevator == 0 ? '없음' : '있음' }}</div>
                                @endif
                                <div>주차 가능 여부</div>
                                <div>
                                    @if ($result->parking_type == 0)
                                        -
                                    @elseif ($result->parking_type == 1)
                                        가능
                                    @elseif ($result->parking_type == 2)
                                        불가능
                                    @endif
                                </div>
                                @if ($result->product_type == 9)
                                    <div>전입신고</div>
                                    <div>
                                        @if ($result->productAddInfo->declare_type == 1)
                                            가능
                                        @elseif ($result->productAddInfo->declare_type == 2)
                                            불가능
                                        @else
                                            선택안함
                                        @endif
                                    </div>
                                @endif
                                <div>주용도</div>
                                <div>{{ Lang::get('commons.building_type.' . $result->building_type) }}</div>
                                @if ($type == 7)
                                    <div>추천 용도</div>
                                    <div>
                                        {{ $result->productAddInfo->recommend_business_type > 0 ? Lang::get('commons.product_business_type.' . $result->productAddInfo->recommend_business_type) : '-' }}
                                    </div>
                                @endif
                                <div>{{ $result->type > 13 ? '준공예정일' : '사용승인일' }}</div>
                                <div>{{ $carbon::parse($result->approve_date)->format('Y.m.d') }}</div>
                            @elseif($type == 6)
                                <div>매물 종류</div>
                                <div>{{ Lang::get('commons.product_type.' . $type) }}</div>
                                <div>현용도</div>
                                <div>{{ Lang::get('commons.building_type.' . $result->building_type) }}</div>
                                <div>소재지</div>
                                <div class="item_col_3">{{ $result->address }}</div>
                                <div>대지면적</div>
                                <div class="area_chage">{{ $result->square ?? '-' }}㎡</div>
                                <div>국토이용</div>
                                <div>
                                    @if ($result->productAddInfo->land_use_type == 1)
                                        해당
                                    @elseif ($result->productAddInfo->land_use_type == 2)
                                        미해당
                                    @else
                                        선택안함
                                    @endif
                                </div>
                                <div>도시계획</div>
                                <div>
                                    @if ($result->productAddInfo->city_plan_type == 1)
                                        있음
                                    @elseif ($result->productAddInfo->city_plan_type == 2)
                                        없음
                                    @else
                                        선택안함
                                    @endif
                                </div>
                                <div>건축허가</div>
                                <div>
                                    @if ($result->productAddInfo->building_permit_type == 1)
                                        발급
                                    @elseif ($result->productAddInfo->building_permit_type == 2)
                                        미발급
                                    @else
                                        선택안함
                                    @endif
                                </div>
                                <div>토지거래허가</div>
                                <div>
                                    @if ($result->productAddInfo->land_permit_type == 1)
                                        해당
                                    @elseif ($result->productAddInfo->land_permit_type == 2)
                                        미해당
                                    @else
                                        선택안함
                                    @endif
                                </div>
                                <div>진입도로</div>
                                <div>
                                    @if ($result->productAddInfo->access_load_type == 1)
                                        있음
                                    @elseif ($result->productAddInfo->access_load_type == 2)
                                        없음
                                    @else
                                        선택안함
                                    @endif
                                </div>
                            @endif
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
                            <div>
                                <h3>{{ $result->comments }}</h3>
                            </div>
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

                {{-- 위치정보 --}}
                <section class="page" id="tab_area_4">
                    <h3>위치정보</h3>
                    <div class="sales_map_wrap">
                        <div id="map" class="map_size">
                        </div>
                    </div>
                </section>

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
                                                <div class="img_box">
                                                    @if (count($item->images) > 0)
                                                        <img src="{{ Storage::url('image/' . $item->images[0]->path) }}"
                                                            onerror="this.src='{{ asset('assets/media/s_1.png') }}';">
                                                    @else
                                                        <img src="{{ asset('assets/media/s_1.png') }}">
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="mediation_txt_item1">
                                                {{ isset($item->priceInfo) ? Lang::get('commons.payment_type.' . $item->priceInfo->payment_type) : 0 }}
                                                {{ isset($item->priceInfo) ? Commons::get_priceTrans($item->priceInfo->price) : 0 }}
                                                {{-- {{ Commons::get_priceTrans($item->priceInfo->price) }} --}}
                                                {{-- 월세/단기임대 --}}
                                                @if (isset($item->priceInfo) && in_array($item->priceInfo->payment_type, [1, 2, 4]))
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
                                <a href="{{ route('www.map.agent.detail', ['id' => $result->users_id]) }}"
                                    class="btn_more">더
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

            @if ($result->user_type == 1)
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
                            <p>대표중개사 {{ $result->users->company_ceo ?? '-' }}</p>
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
            @endif
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
                    <h4><a href="{{ route('www.map.agent.detail', ['id' => $result->users_id]) }}">{{ $result->users->company_name ?? '-' }}
                            <img src="{{ asset('assets/media/ic_list_arrow.png') }}"></a>
                    </h4>
                    <p class="gray_deep">대표중개사 {{ $result->users->company_ceo ?? '-' }}</p>
                </div>
                <div class="agent_popup_detail">
                    <p><span>주소</span>
                        {{ implode(', ', array_filter([$result->users->company_address ?? '', $result->users->company_address_detail ?? ''])) }}
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
            // $(window).scroll(function() {
            //     if ($(this).scrollTop() > 300) {
            //         $('.top').fadeIn();
            //     } else {
            //         $('.top').fadeOut();
            //     }
            // });
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
                $('.area_chage').text($(".area.txt_item_2").text());
            } else {
                // 평 -> m2
                image.src = "{{ asset('assets/media/btn_unit.png') }}";
                square.forEach(square => {
                    square.style.display = "";
                });
                area.forEach(area => {
                    area.style.display = "none";
                });
                $('.area_chage').text($(".square.txt_item_2").text());
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

        var map = new naver.maps.Map('map', {
            center: new naver.maps.LatLng('{{ $result->address_lat }}', '{{ $result->address_lng }}'),
            zoom: 15,
            mapDataControl: false,
            scaleControl: false,
            mapTypeControl: false
        });

        marker = new naver.maps.Marker({
            position: new naver.maps.LatLng('{{ $result->address_lat }}', '{{ $result->address_lng }}'),
            map: map,
            icon: {
                url: "{{ asset('assets/media/map_marker_default.png') }}",

                size: new naver.maps.Size(100, 100), //아이콘 크기
                scaledSize: new naver.maps.Size(30, 43), //아이콘 크기
                origin: new naver.maps.Point(0, 0),
                anchor: new naver.maps.Point(11, 35)
            }
        });
    </script>

    {{-- 카카오톡 공유 --}}

    <script>
        document.querySelectorAll('.kakaotalk-sharing-btn').forEach(function(button) {
            Kakao.Share.createDefaultButton({
                container: button,
                objectType: "feed",
                content: {
                    title: '{{ $result->region_address }}·{{ Lang::get('commons.product_type.' . $result->type) }}',
                    description: '{{ $result->comments }}',
                    imageUrl: "{{ $result->images ? asset('storage/image/' . $result->images[0]->path) : asset('assets/media/default_gs.png') }}",
                    link: {
                        mobileWebUrl: `{!! url()->full() !!}`,
                        webUrl: `{!! url()->full() !!}`,
                    },
                }
            });
        });

        function urlCopy() {
            navigator.clipboard.writeText('{!! url()->full() !!}').then(res => {
                alert("링크복사 되었습니다.");
            })
        }
    </script>
</x-layout>
