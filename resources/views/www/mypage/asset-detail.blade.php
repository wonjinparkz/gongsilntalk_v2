<x-layout>

    @php
        $price = $result->price > 0 ? $result->price : 1;
        $acquisition_tax_price = $price * ($result->acquisition_tax_rate / 100);
        $etc_price = $result->etc_price + $result->tax_price + $result->estate_price;
        $realPrice = $price + $acquisition_tax_price + $etc_price - $result->loan_price - $result->check_price;

        $myPrice = $result->month_price - ($result->loan_price * ($result->loan_rate / 100)) / 12;

        function priceRate($price)
        {
            $price = $price / 10000;
            $taxPrice = 0;
            $taxRate = 0;

            switch ($price) {
                case $price <= 1400:
                    $taxPrice = 0;
                    $taxRate = 0.06;
                    break;

                case $price <= 5000:
                    $taxPrice = 126;
                    $taxRate = 0.15;
                    break;

                case $price <= 8800:
                    $taxPrice = 576;
                    $taxRate = 0.24;
                    break;

                case $price <= 15000:
                    $taxPrice = 1544;
                    $taxRate = 0.35;
                    break;

                case $price <= 30000:
                    $taxPrice = 1994;
                    $taxRate = 0.38;
                    break;

                case $price <= 50000:
                    $taxPrice = 2594;
                    $taxRate = 0.4;
                    break;

                case $price <= 100000:
                    $taxPrice = 3594;
                    $taxRate = 0.42;
                    break;

                case $price > 100000:
                    $taxPrice = 6594;
                    $taxRate = 0.45;
                    break;
            }

            return ['taxPrice' => $taxPrice * 10000, 'taxRate' => $taxRate];
        }

        function yearRate($year)
        {
            $percent = 0;

            if ($year >= 3 && $year < 4) {
                $percent = 0.06;
            } elseif ($year >= 4 && $year < 5) {
                $percent = 0.08;
            } elseif ($year >= 5 && $year < 6) {
                $percent = 0.1;
            } elseif ($year >= 6 && $year < 7) {
                $percent = 0.12;
            } elseif ($year >= 7 && $year < 8) {
                $percent = 0.14;
            } elseif ($year >= 8 && $year < 9) {
                $percent = 0.16;
            } elseif ($year >= 9 && $year < 10) {
                $percent = 0.18;
            } elseif ($year >= 10 && $year < 11) {
                $percent = 0.2;
            } elseif ($year >= 11 && $year < 12) {
                $percent = 0.22;
            } elseif ($year >= 12 && $year < 13) {
                $percent = 0.24;
            } elseif ($year >= 13 && $year < 14) {
                $percent = 0.26;
            } elseif ($year >= 14 && $year < 15) {
                $percent = 0.28;
            } elseif ($year >= 15) {
                $percent = 0.3;
            }
            return $percent;
        }

        function year($date)
        {
            // 현재 날짜 가져오기
            $now = new DateTime();

            // 입력된 날짜를 DateTime 객체로 변환
            if (!$date instanceof DateTime) {
                $date = new DateTime($date); // 문자열 입력일 경우 변환
            }

            // 날짜 차이 계산
            $diff = $now->diff($date);

            // 연도와 개월을 계산하여 소수점 연도로 반환
            $years = $diff->y; // 차이 연도
            $months = $diff->m; // 차이 월
            $days = $diff->d; // 차이 일 (추가 확인용)

            // 보유기간 계산 (연도 + 개월/12)
            $totalYears = $years + $months / 12;

            return $totalYears;
        }

        function format_phone($phone)
        {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            $length = strlen($phone);
            switch ($length) {
                case 11:
                    return preg_replace('/([0-9]{3})([0-9]{4})([0-9]{4})/', "$1-$2-$3", $phone);
                    break;
                case 10:
                    return preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', "$1-$2-$3", $phone);
                    break;
                default:
                    return $phone;
                    break;
            }
        }

        $address_detail = isset($result->address_detail) ? $result->address_detail : '';

        if ($result->type_detail == 0) {
            $year = year($result->contracted_at);

            info($year);

            $ownership_share = $result->name_type == 1 ? $result->ownership_share / 100 : 0;

            // 지분율로 계산된 가격을 원래 가격으로 복원
            $price = $ownership_share > 0 ? $price / $ownership_share : $price;

            $avgPrice = $price / $result->area / 10000;

            $avgRate = ($industryCenterAvgPrice / $avgPrice - 1) * 100;

            // if ($avgPrice > $industryCenterAvgPrice) {
            //     $avgRate = $avgPrice / $industryCenterAvgPrice;
            // } else {
            //     $avgRate = $industryCenterAvgPrice / $avgPrice;
            // }

            $profit = $industryCenterAvgPrice - $avgPrice;

            $addPrice = $profit * $result->area;

            $avgRealPrice = $industryCenterAvgPrice * $result->area * 10000;

            $APrice =
                $industryCenterAvgPrice * 10000 * $result->area -
                $price -
                $acquisition_tax_price -
                $etc_price -
                $avgRealPrice * 0.01;

            $CPrice = $APrice * yearRate($year);
            $BPrice = ($ownership_share > 0 ? $APrice - $CPrice / $ownership_share : $APrice) - $CPrice;
            $DPrice = $BPrice - 2500000;

            info('APrice : ' . $APrice);
            info('BPrice : ' . $BPrice);
            info('CPrice : ' . $CPrice);
            info('DPrice : ' . $DPrice);

            if ($year < 1) {
                $EPrice = $DPrice * 0.5;
                $lastPrice = (($ownership_share > 0 ? $APrice / $ownership_share : $APrice) - $EPrice) / 10000;
            } elseif ($year >= 1 && $year < 2) {
                $EPrice = $DPrice * 0.4;
                $lastPrice = (($ownership_share > 0 ? $APrice / $ownership_share : $APrice) - $EPrice) / 10000;
            } elseif ($year >= 2 && $year < 3) {
                $tax = priceRate($DPrice);
                info($tax);
                $TaxRate = $tax['taxRate'];
                $TaxPrice = $tax['taxPrice'];
                $EPrice = $DPrice * $TaxRate - $TaxPrice;
                $lastPrice = (($ownership_share > 0 ? $APrice / $ownership_share : $APrice) - $EPrice) / 10000;
            } else {
                $tax = priceRate($DPrice);
                $TaxRate = $tax['taxRate'];
                $TaxPrice = $tax['taxPrice'];
                $EPrice = $DPrice * $TaxRate - $TaxPrice;
                $lastPrice = (($ownership_share > 0 ? $APrice / $ownership_share : $APrice) - $EPrice) / 10000;
            }
        }
    @endphp



    @inject('carbon', 'Carbon\Carbon')
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">{{ $result->address_detail }}</div>
        <div class="right_area"><span class="btn_dot_menu"><img
                    src="{{ asset('assets/media/header_btn_dot.png') }}"></span></div>
        <div class="layer_menu">
            <a href="{{ route('www.mypage.service.update.first.view', [$result->id]) }}">수정</a>
            <a onclick="modal_open('asset_delete');">삭제</a>
        </div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <div class="gray_body">
            <div class="inner_mid_wrap asset_detail_top_wrap">

                <div class="asset_detail_tit only_pc">

                    <h1>{{ $result->address_detail }}
                    </h1>
                    <div class="gap_8">
                        <button class="btn_point btn_sm" type="button"
                            onclick="location.href='{{ route('www.mypage.service.update.first.view', [$result->id]) }}'">수정</button>
                        <button class="btn_graylight_ghost btn_sm" type="button"
                            onclick="modal_open('asset_delete');">삭제</button>
                    </div>
                </div>

                <div class="box_01 only_pc">
                    <div class="detail_asser_total">
                        <div>
                            <label>부동산 자산</label>
                            <h1>{{ number_format($result->price) }}원</h1>
                        </div>
                        <ul class="asser_detail_item">
                            <li>

                                <p>실투자금</p>
                                <p class="item_price">{{ number_format($realPrice) }}원</p>
                            </li>
                            <li>
                                <p>월순수익</p>
                                <p class="item_price">
                                    {{ number_format($myPrice) }}원
                                </p>
                            </li>
                            <li>
                                <p>수익률</p>
                                <p class="item_price">
                                    @if ($myPrice > $realPrice)
                                        {{ number_format((($myPrice * 12) / $realPrice) * 100, 2) }}%
                                    @else
                                        {{ number_format((($myPrice * 12) / $realPrice) * 100, 2) }}%
                                    @endif
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="table_container container_sm">
                        <div class="item_sm">임대 보증금</div>
                        <div class="item_sm">{{ number_format($result->check_price) }}원</div>
                        <div class="item_sm">월임대료</div>
                        <div class="item_sm">{{ number_format($result->month_price) }}원</div>
                        <div class="item_sm">대출금액</div>
                        <div class="item_sm">{{ number_format($result->loan_price) }}원</div>
                        <div class="item_sm">대출이자</div>
                        <div class="item_sm">
                            <span class="txt_point">
                                {{ number_format(($result->loan_price * ($result->loan_rate / 100)) / 12) }}원
                            </span>
                            <span class="gray_basic">금리
                                {{ $result->loan_rate }}%</span>
                        </div>
                        <div class="item_sm">취득세</div>
                        <div class="item_sm">
                            {{ number_format($acquisition_tax_price) }}원
                            <span class="gray_basic">({{ $result->acquisition_tax_rate }}%)</span>
                        </div>
                        <div class="item_sm">기타비용</div>
                        <div class="item_sm">
                            {{ number_format($etc_price) }}원</div>
                    </div>
                </div>

                <!---------------------- m:: 총 자산 현황 s ---------------------->
                <div class="m_inner_wrap only_m">
                    <div class="asset_dashboard_wrap">
                        <div class="ds_item_1">
                            <div class="detail_open_wrap">
                                <label>총 자산 현황</label>
                                <button class="simple_toggle_trigger only_m"><img
                                        src="{{ asset('assets/media/dropdown_arrow2.png') }}" class="w_100"></button>
                            </div>

                            <h1>{{ number_format($result->price) }}원</h1>
                            <ul class="main_price_wrap">
                                <li>실투자금<p>{{ number_format($realPrice) }}원</p>
                                </li>
                                <li>월순수익<p>{{ number_format($myPrice) }}원
                                        <span>({{ number_format((($myPrice * 12) / $realPrice) * 100, 2) }}%)</span>
                                    </p>
                                </li>
                            </ul>
                            <div class="detail_price_wrap simple_toggle_layer">
                                <ul class="detail_price">
                                    <li>임대 보증금<p>{{ number_format($result->check_price) }}원</p>
                                    </li>
                                    <li>월임대료<p>{{ number_format($result->month_price) }}원</p>
                                    </li>
                                </ul>
                                <hr>
                                <ul class="detail_price">
                                    <li>대출금액<p>{{ number_format($result->loan_price) }}원</p>
                                    </li>
                                    <li>대출이자<p class="txt_point">
                                            {{ number_format(($result->loan_price * ($result->loan_rate / 100)) / 12) }}원
                                            <span class="gray_basic">금리 {{ $result->loan_rate }}%</span>
                                        </p>
                                    </li>
                                </ul>
                                <hr>
                                <ul class="detail_price">
                                    <li>취득세<p>{{ number_format($acquisition_tax_price) }}원 <span
                                                class="gray_basic">({{ $result->acquisition_tax_rate }}%)</span></p>
                                    </li>
                                    <li>기타비용<p>{{ number_format($etc_price) }}원</p>
                                    </li>
                                </ul>

                                @if ($result->type_detail == 0)
                                    <div class="price_status_box">
                                        <div class="status_item">
                                            <p>평당</p>
                                            <div>
                                                <span
                                                    {{ $profit > 0 ? 'class=status_item_red' : 'class=status_item_blue' }}>
                                                    {{ number_format($profit) }}만원 ({{ number_format($avgRate) }}%)
                                                </span>
                                            </div>
                                        </div>
                                        <div class="status_item">
                                            <p>시세차익</p>
                                            <div>
                                                <span {{ $addPrice > 0 ? 'class=status_item_red' : '' }}>
                                                    {{ $addPrice > 0 ? number_format($addPrice) : '0' }}만원
                                                </span>
                                            </div>
                                        </div>
                                        <div class="status_item">
                                            <p>양도세 납부 후 시세차익</p>
                                            <div>
                                                <span
                                                    {{ $lastPrice > 0 ? 'class=status_item_red' : 'class=status_item_blue' }}>
                                                    {{ number_format($lastPrice) }}만원
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <!---------------------- m:: 총 자산 현황 s ---------------------->

                @if ($result->type_detail == 0)
                    <div class="price_status_box only_pc">
                        <div class="status_item">
                            <p>평당</p>
                            <div>
                                <span {{ $profit > 0 ? 'class=status_item_red' : 'class=status_item_blue' }}>
                                    {{ number_format($profit) }}만원 ({{ number_format($avgRate) }}%)
                                </span>
                            </div>
                        </div>
                        <div class="status_item">
                            <p>시세차익</p>
                            <div>
                                <span {{ $addPrice > 0 ? 'class=status_item_red' : '' }}>
                                    {{ $addPrice > 0 ? number_format($addPrice) : '0' }}만원
                                </span>
                            </div>
                        </div>
                        <div class="status_item">
                            <p>양도세 납부 후 시세차익</p>
                            <div>
                                <span {{ $lastPrice > 0 ? 'class=status_item_red' : 'class=status_item_blue' }}>
                                    {{ number_format($lastPrice) }}만원
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- my_body : s -->
        <div class="inner_mid_wrap">
            <div class="box_01 m_hr_type">
                <h4>기본정보</h4>
                <div class="table_container2 info_table_wrap">
                    <div class="tr_row">
                        <div>주소</div>
                        <div>{{ $result->asset_address->address }}</div>
                        <div>부동산 유형</div>
                        <div>{{ Lang::get('commons.product_type.' . $result->type_detail) }}</div>
                    </div>
                    <div class="tr_row">
                        <div>명의구분</div>
                        <div>{{ Lang::get('commons.asset_name_type.' . $result->name_type) }}
                            <span class="txt_point">
                                {{ $result->name_type == 1 ? '(' . $result->ownership_share . '%)' : '' }}
                            </span>
                        </div>
                        <div>사업자구분</div>
                        <div>{{ Lang::get('commons.asset_business_type.' . $result->business_type) }}</div>
                    </div>
                    <div class="tr_row">
                        <div>공급면적</div>
                        <div>{{ $result->square }}㎡<span class="gray_basic">({{ $result->area }}평)</span></div>
                        <div>전용면적</div>
                        <div>{{ $result->exclusive_square }}㎡<span
                                class="gray_basic">({{ $result->exclusive_area }}평)</span></div>
                    </div>
                    <div class="tr_row border_none">
                        <div>계약일자</div>
                        <div>{{ $carbon::parse($result->contracted_at)->format('Y.m.d') }}</div>
                        @if ($result->tran_type == 1)
                            <div>등기일</div>
                            <div>
                                {{ isset($result->registered_at) ? $carbon::parse($result->registered_at)->format('Y.m.d') : '-' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="box_01 m_hr_type">
                <h4>대출정보</h4>
                <div class="table_container2 info_table_wrap">
                    <div class="tr_row">
                        <div>대출금액</div>
                        <div>{{ isset($result->loan_price) ? number_format($result->loan_price) . '원' : '-' }}</div>
                        <div>대출기간</div>
                        <div>{{ isset($result->loan_period) ? $result->loan_period . '개월' : '-' }}</div>
                    </div>
                    <div class="tr_row">
                        <div>대출일자</div>
                        <div>
                            {{ isset($result->loaned_at) ? $carbon::parse($result->loaned_at)->format('Y.m.d') : '-' }}
                        </div>
                        <div>대출방식</div>
                        <div>
                            {{ isset($result->loan_type) ? Lang::get('commons.asset_loan_type.' . $result->loan_type) : '-' }}
                        </div>
                    </div>
                    <div class="tr_row">
                        <div>대출금리</div>
                        <div><span
                                class="txt_point">{{ isset($result->loan_rate) ? $result->loan_rate . '%' : '-' }}</span>
                        </div>
                        <div>월 이자</div>
                        @php
                            if (isset($result->loan_price)) {
                                $loanP = ($result->loan_price * ($result->loan_rate / 100)) / 12;
                            } else {
                                $loanP = 0;
                            }
                        @endphp
                        <div><span
                                class="txt_point">{{ isset($result->loan_price) ? number_format($loanP) . '원' : '-' }}</span>
                        </div>
                    </div>
                    <div class="tr_row border_none">
                        <div>계약일자</div>
                        <div>
                            {{ isset($result->contracted_at) ? $carbon::parse($result->contracted_at)->format('Y.m.d') : '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="box_01 m_hr_type">
                <h4>임대차 계약정보</h4>
                <div class="table_container2 info_table_wrap">
                    <div class="tr_row">
                        <div>공실여부</div>
                        <div>{{ Lang::get('commons.asset_vacancy_type.' . $result->is_vacancy) }}</div>
                        <div>계약기간</div>
                        <div>
                            {{ isset($result->tenant_name) ? $carbon::parse($result->started_at)->format('Y.m.d') . '~' . $carbon::parse($result->ended_at)->format('Y.m.d') : '-' }}
                        </div>
                    </div>
                    <div class="tr_row">
                        <div>임차인명</div>
                        <div>{{ isset($result->tenant_name) ? $result->tenant_name : '-' }}</div>
                        <div>임차인 연락처</div>
                        <div>{{ isset($result->tenant_phone) ? format_phone($result->tenant_phone) : '-' }}</div>
                    </div>
                    <div class="tr_row">
                        <div>임대 보증금</div>
                        <div>{{ isset($result->check_price) ? number_format($result->check_price) . '원' : '-' }}</div>
                        <div>월임대료</div>
                        <div>
                            <span class="txt_point">
                                {{ isset($result->month_price) ? number_format($result->month_price) . '원' : '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="tr_row border_none">
                        <div>임대료 납부방법</div>
                        <div>
                            {{ isset($result->tenant_name) ? Lang::get('commons.asset_pay_type.' . $result->pay_type) : '-' }}
                        </div>
                        <div>월세 입금일</div>
                        <div>{{ isset($result->deposit_day) ? '매월 ' . $result->deposit_day : '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="box_01 m_hr_type">
                <h4>등록 서류</h4>
                <div class="download_wrap">
                    <div class="download_item">
                        <div class="flex_between">
                            <span class="fs_16 gray_deep">매매계약서</span>
                            <div class="relative">
                                @if (isset($result->sale_images->path))
                                    <button class="btn_graylight_ghost btn_sm btn_share" data-share="share_sale"><img
                                            src="{{ asset('assets/media/header_btn_share_deep.png') }}"
                                            class="normal"></button>
                                    <button class="btn_graylight_ghost btn_sm" type="button"
                                        onclick="location.href='{{ route('api.imagedownload', $result->sale_images->path) }}'">다운</button>

                                    <div class="layer layer_share_wrap layer_share_top share_sale">
                                        <div class="layer_title">
                                            <h5>공유하기</h5>
                                            <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                class="md_btn_close btn_share" data-share="share_sale">
                                        </div>
                                        <div class="layer_share_con">
                                            <a class="kakaotalk-sharing-btn" data-image-title="매매계약서 공유드립니다."
                                                data-image-url="{{ asset('storage/image/') . '/' . $result->sale_images->path }}">
                                                <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                                <p class="mt8">카카오톡</p>
                                            </a>
                                            <a
                                                onclick="textCopy('{{ asset('storage/image/') . '/' . $result->sale_images->path }}');$('.layer_share_wrap').stop().slideUp(0);">
                                                <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                                <p class="mt8">링크복사</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                        <div class="download_img_box">
                            @if (isset($result->sale_images->path))
                                <img src="{{ Storage::url('image/' . $result->sale_images->path) }}"
                                    onclick="imageChange('{{ Storage::url('image/' . $result->sale_images->path) }}');"
                                    style="max-width:200px;">
                            @endif
                        </div>
                    </div>

                    <div class="download_item">
                        <div class="flex_between">
                            <span class="fs_16 gray_deep">사업자등록증</span>
                            <div class="relative">
                                @if (isset($result->entre_images->path))
                                    <button class="btn_graylight_ghost btn_sm btn_share" data-share="share_entre"><img
                                            src="{{ asset('assets/media/header_btn_share_deep.png') }}"
                                            class="normal"></button>
                                    <button class="btn_graylight_ghost btn_sm" type="button"
                                        onclick="location.href='{{ route('api.imagedownload', $result->entre_images->path) }}'">다운</button>

                                    <div class="layer layer_share_wrap layer_share_top share_entre">
                                        <div class="layer_title">
                                            <h5>공유하기</h5>
                                            <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                class="md_btn_close btn_share" data-share="share_entre">
                                        </div>
                                        <div class="layer_share_con">
                                            <a class="kakaotalk-sharing-btn" data-image-title="사업자등록증 공유드립니다."
                                                data-image-url="{{ asset('storage/image/') . '/' . $result->entre_images->path }}">
                                                <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                                <p class="mt8">카카오톡</p>
                                            </a>
                                            <a
                                                onclick="textCopy('{{ asset('storage/image/') . '/' . $result->entre_images->path }}');$('.layer_share_wrap').stop().slideUp(0);">
                                                <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                                <p class="mt8">링크복사</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="download_img_box">
                            @if (isset($result->entre_images->path))
                                <img src="{{ Storage::url('image/' . $result->entre_images->path) }}"
                                    onclick="imageChange('{{ Storage::url('image/' . $result->entre_images->path) }}');"
                                    style="max-width:200px;">
                            @endif
                        </div>
                    </div>

                    <div class="download_item">
                        <div class="flex_between">
                            <span class="fs_16 gray_deep">임대차 계약서</span>
                            <div class="relative">
                                @if (isset($result->rental_images->path))
                                    <button class="btn_graylight_ghost btn_sm btn_share"
                                        data-share="share_rental"><img
                                            src="{{ asset('assets/media/header_btn_share_deep.png') }}"
                                            class="normal"></button>
                                    <button class="btn_graylight_ghost btn_sm" type="button"
                                        onclick="location.href='{{ route('api.imagedownload', $result->rental_images->path) }}'">다운</button>

                                    <div class="layer layer_share_wrap layer_share_top share_rental">
                                        <div class="layer_title">
                                            <h5>공유하기</h5>
                                            <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                class="md_btn_close btn_share" data-share="share_rental">
                                        </div>
                                        <div class="layer_share_con">
                                            <a class="kakaotalk-sharing-btn" data-image-title="임대차 계약서 공유드립니다."
                                                data-image-url="{{ asset('storage/image/') . '/' . $result->rental_images->path }}">
                                                <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                                <p class="mt8">카카오톡</p>
                                            </a>
                                            <a
                                                onclick="textCopy('{{ asset('storage/image/') . '/' . $result->rental_images->path }}');$('.layer_share_wrap').stop().slideUp(0);">
                                                <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                                <p class="mt8">링크복사</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="download_img_box">
                            @if (isset($result->rental_images->path))
                                <img src="{{ Storage::url('image/' . $result->rental_images->path) }}"
                                    onclick="imageChange('{{ Storage::url('image/' . $result->rental_images->path) }}');"
                                    style="max-width:200px;">
                            @endif
                        </div>
                    </div>

                    <div class="download_item">
                        <div class="flex_between">
                            <span class="fs_16 gray_deep">기타서류</span>
                            <div class="relative">
                                @if (isset($result->etc_images->path))
                                    <button class="btn_graylight_ghost btn_sm btn_share" data-share="share_etc"><img
                                            src="{{ asset('assets/media/header_btn_share_deep.png') }}"
                                            class="normal"></button>
                                    <button class="btn_graylight_ghost btn_sm" type="button"
                                        onclick="location.href='{{ route('api.imagedownload', $result->etc_images->path) }}'">다운</button>

                                    <div class="layer layer_share_wrap layer_share_top share_etc">
                                        <div class="layer_title">
                                            <h5>공유하기</h5>
                                            <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                class="md_btn_close btn_share" data-share="share_etc">
                                        </div>
                                        <div class="layer_share_con">
                                            <a class="kakaotalk-sharing-btn" data-image-title="기타서류 공유드립니다."
                                                data-image-url="{{ asset('storage/image/') . '/' . $result->etc_images->path }}">
                                                <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                                <p class="mt8">카카오톡</p>
                                            </a>
                                            <a
                                                onclick="textCopy('{{ asset('storage/image/') . '/' . $result->etc_images->path }}');$('.layer_share_wrap').stop().slideUp(0);">
                                                <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                                <p class="mt8">링크복사</p>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                        <div class="download_img_box">
                            @if (isset($result->etc_images->path))
                                <img src="{{ Storage::url('image/' . $result->etc_images->path) }}"
                                    onclick="imageChange('{{ Storage::url('image/' . $result->etc_images->path) }}');"
                                    style="max-width:200px;">
                            @endif
                        </div>
                    </div>

                </div>

                <!-- modal 삭제 : s -->
                <div class="modal modal_asset_delete">
                    <div class="modal_container">
                        <div class="modal_mss_wrap">
                            <p class="txt_item_1 txt_point">{{ $result->address }}</p>
                            <p class="txt_item_1">자산 목록을 삭제하시겠습니까?</p>
                            <p class="mt8 txt_item_2">삭제 후에는 되돌릴 수 없습니다.</p>
                        </div>

                        <div class="modal_btn_wrap">
                            <button class="btn_gray btn_full_thin" onclick="modal_close('asset_delete')">취소</button>
                            <button class="btn_point btn_full_thin"
                                onclick="onMyAssetDelete('{{ $result->id }}')">삭제</button>
                        </div>
                    </div>
                </div>
                <form id="deleteForm" name="deleteForm" method="post"
                    action="{{ route('www.mypage.service.one.delete') }}">
                    <input type="hidden" id="id" name="id" value="{{ $result->id }}">
                </form>
                <div class="md_overlay md_overlay_asset_delete" onclick="modal_close('asset_delete')"></div>
                <!-- modal 삭제 : e -->
            </div>


        </div>
        <!-- my_body : e -->

    </div>



    <!-- 이미지 확대 : s-->
    <div class="modal modal_mid modal_big_document">
        <img src="{{ asset('assets/media/header_btn_close_w.png') }}" class="big_img_close"
            onclick="modal_close('big_document')">
        <img src="{{ asset('assets/media/download_sample_1.png') }}" id="imagePreview" class="big_download">
    </div>
    <div class="md_overlay md_overlay_big_document" onclick="modal_close('big_document')"></div>
    <!-- 이미지 확대 : e-->

    <script>
        function imageChange(src) {
            document.getElementById("imagePreview").src = src;
            modal_open('big_document');
        }

        //기본 토글 이벤트
        $(".proposal_toggle_btn").click(function() {
            $(this).toggleClass("toggled");
            if ($(this).hasClass("toggled")) {
                $(this).css("transform", "rotate(180deg)");
            } else {
                $(this).css("transform", "rotate(0deg)");
            }

            $(".proposal_table_wrap").stop().slideToggle(300);
            return false;
        });

        // 내 자산 삭제
        var onMyAssetDelete = (id) => {
            var form = document.deleteForm;
            form.submit();
        }

        // 주소 복사
        var textCopy = (url) => {
            window.navigator.clipboard.writeText(url).then(() => {
                alert("링크가 복사 되었습니다.");
            });
        };

        //공유하기 레이어
        $(".btn_share").click(function() {
            var shareLayerClass = $(this).data("share");
            $("." + shareLayerClass).stop().slideToggle(0);
            return;
        });

        document.querySelectorAll('.kakaotalk-sharing-btn').forEach(function(button) {
            var imageUrl = button.getAttribute('data-image-url');
            var imageTitle = button.getAttribute('data-image-title');

            button.addEventListener('click', function() {
                $(".layer_share_wrap").stop().slideUp(0);

                Kakao.Share.sendDefault({
                    objectType: "feed",
                    content: {
                        title: imageTitle,
                        description: '{{ $result->asset_address->address }}' +
                            '{{ $result->is_temporary == 0 ? $address_detail : $result->address_detail }}',
                        imageUrl: imageUrl,
                        link: {
                            mobileWebUrl: imageUrl,
                            webUrl: imageUrl,
                        },
                    }
                });
            });
        });
    </script>


</x-layout>
