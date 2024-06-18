@props([
    'result' => [],
])

@php

    function decodeJsonData($data)
    {
        $decodedData = [];

        // Null check for the input data
        if ($data !== null) {
            foreach ($data as $info) {
                $jsonData = json_decode($info->json_data ?? null, true);

                if ($jsonData !== null) {
                    $decodedData[] = $jsonData;
                }
            }
        }

        return $decodedData;
    }

    // Null check for each $result property before calling the function
    $BrTitleInfo = isset($result->BrTitleInfo) ? decodeJsonData($result->BrTitleInfo) : [];
    $BrRecapTitleInfo = isset($result->BrRecapTitleInfo) ? decodeJsonData($result->BrRecapTitleInfo) : [];
    $BrFlrOulnInfo = isset($result->BrFlrOulnInfo) ? decodeJsonData($result->BrFlrOulnInfo) : [];
    $BrExposInfo = isset($result->BrExposInfo) ? decodeJsonData($result->BrExposInfo) : [];
    $BrExposPubuseAreaInfo = isset($result->BrExposPubuseAreaInfo)
        ? decodeJsonData($result->BrExposPubuseAreaInfo)
        : [];

    // 모든 표제부 층 정보를 가져와 상단 층별정보에 값 넣어주기
    $floor = 0;
    $floorMin = 100;
    $Minfloor = 0;

    if (count($BrTitleInfo) > 0) {
        foreach ($BrTitleInfo as $key => $info) {
            $Tfloor = $info['grndFlrCnt'];
            $TMinfloor = $info['ugrndFlrCnt'];

            if ($Tfloor > $floor) {
                $floor = $Tfloor;
            }

            if ($TMinfloor > $Minfloor) {
                $Minfloor = $TMinfloor;
            }

            if ($Tfloor < $floorMin) {
                // grndFlrCnt에서 가장 낮은 값을 찾기 위해 $Tfloor를 사용
                $floorMin = $Tfloor;
            }
        }
    }
@endphp
<div class="side_header">
    <div class="left_area"><a href="javascript:history.go(-1)"><img
                src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
    <div class="m_title">{{ $result->kaptName }}</div>
    <div class="right_area"><a href="#" class="btn_share"><img
                src="{{ asset('assets/media/header_btn_share_deep.png') }}"></a></div>
    <!-- 공유하기 : s -->
    <div class="layer layer_share_wrap layer_share_top">
        <div class="layer_title">
            <h5>공유하기</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close btn_share">
        </div>
        <div class="layer_share_con">
            <a href="#">
                <img src="{{ asset('assets/media/share_ic_01.png') }}">
                <p class="mt8">카카오톡</p>
            </a>
            <a href="#">
                <img src="{{ asset('assets/media/share_ic_02.png') }}">
                <p class="mt8">링크복사</p>
            </a>
        </div>
    </div>
    <!-- 공유하기 : e -->
</div>

<div class="side_fixed">
    <div class="top_wrap flex_between">
        <ul class="tab_type_3 toggle_tab">
            @if (count($result->transactions) > 0)
                <li class="active" data-type="sale">매매</li>
            @endif
            @if (count($result->transactionsRent) > 0)
                <li class="" data-type="rent">전월세</li>
            @endif
        </ul>

        @if (count($result->exclusiveAreasSale) > 0)
            <div class="dropdown_box s_sm">
                <button class="dropdown_label">{{ $result->exclusiveAreasSale[0] }}㎡</button>
                <ul class="optionList areaList transactionsType">
                    @foreach ($result->exclusiveAreasSale as $area)
                        <li class="optionItem areaItem sale rent" data-area="{{ $area }}">{{ $area }}㎡
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>
<script></script>

<div class="scroll_wrap_1">
    <hr class="space">
    <div class="estate_link">
        <a href="{{ route('www.product.create.view') }}" class="flex_between">
            <span><img src="{{ asset('assets/media/ic_org_estate.png') }}" class="ic_left_20"> 부동산 내놓기</span>
            <span><img src="{{ asset('assets/media/ic_list_arrow.png') }}" class="ic_10"></span>
        </a>
    </div>
    <hr class="space">

    <div class="side_info_wrap">
        <div>
            <div id="minimap" style="width:100%; height:330px;" class="size_100p"></div>
            {{-- <img src="{{ asset('assets/media/map_sample_sm.png') }}" class="size_100p"> --}}
        </div>
        <p class="txt_address">{{ $result->kaptAddr }}</p>
        <p class="txt_sub_1">{{ $result->subwayStation }} {{ $result->subwayLine }}
            <span>{{ $result->kaptdWtimesub }}</span>
        </p>
        <ul class="info_detail">
            <li>
                <p>{{ $result->kaptDongCnt }}동</p><label>총 동수</label>
            </li>
            <li>
                <p>{{ $result->kaptdaCnt }}세대</p><label>총 세대수</label>
            </li>
            <li>
                <p>
                    {{ $Minfloor > 0 ? 'B' . $Minfloor : ($floor > 0 ? $floorMin : '-') }}층/{{ $floor > 0 ? $floor : '-' }}층
                </p>
                <label>최저/최고</label>
            </li>
            <li>
                <p>{{ $result->kaptUsedate != '' ? substr($result->kaptUsedate, 0, 4) : '-' }}년</p><label>준공년도</label>
            </li>
        </ul>
    </div>

    <!-- tab : s -->
    <div class="tab_type_2 type_side">
        <div style="width: 100%;">
            <div class="swiper detail_tab">
                <div class="swiper-wrapper menu toggle_menu">
                    <div class="swiper-slide active"><a>가격·거래내역</a></div>
                    <div class="swiper-slide"><a>건물·토지정보</a></div>
                    <div class="swiper-slide"><a>위치 및 주변정보</a></div>
                    <div class="swiper-slide"><a>매물정보</a></div>
                </div>
            </div>
            <div class="swiper-button-next detail-tab-next"></div>
            <!-- <div class="swiper-button-prev detail-tab-prev"></div> -->
        </div>
    </div>
    <!-- tab : e -->

    <div class="side_tab_wrap">
        <div class="sction_item active">
            <div id="saleContent" class="content_item">
                <!-- 매매 거래내역 : s -->
                <div class="side_section">
                    <h4>매매 거래내역</h4>
                    <!-- 데이터 없을 경우 -->
                    @if (count($result->groupedTransactions) <= 0)
                        <div class="empty_wrap sm_type">
                            <span>실거래 내역이 없습니다.</span>
                        </div>
                    @else
                        <div id="saleTransactionContainer">
                            @foreach ($result->groupedTransactions as $area => $group)
                                @php
                                    $latestTransaction = $group->first();
                                    $previousTransaction = $group->skip(1)->first();
                                    $priceChange = 0;
                                    $priceChangePercent = 0;
                                    $latestPrice = 0;
                                    if ($latestTransaction) {
                                        $latestPrice = (float) str_replace(
                                            ',',
                                            '',
                                            $latestTransaction->transactionPrice,
                                        );
                                        if ($previousTransaction) {
                                            $previousPrice = (float) str_replace(
                                                ',',
                                                '',
                                                $previousTransaction->transactionPrice,
                                            );
                                            $priceChange = $latestPrice - $previousPrice;
                                            if ($previousPrice != 0) {
                                                $priceChangePercent = ($priceChange / $previousPrice) * 100;
                                            }
                                        }
                                    }
                                    $priceChangeClass =
                                        $priceChange > 0
                                            ? 'status_item_red'
                                            : ($priceChange < 0
                                                ? 'status_item_blue'
                                                : 'status_item_normal');

                                @endphp
                                <div class="transactionGroup" data-area="{{ $latestTransaction->exclusiveArea }}">

                                    <div class="transaction_box mt10">
                                        <div class="gray_deep">
                                            <span
                                                class="transaction_price">{{ Commons::getformatPrice($latestPrice) }}</span>({{ $latestTransaction->floor }}층)
                                        </div>
                                        <div class="{{ $priceChangeClass }}">
                                            @if ($priceChangeClass != 'status_item_normal')
                                                {{ Commons::getformatPrice($priceChange) }}
                                                ({{ number_format($priceChangePercent, 2) }}%)
                                            @endif
                                        </div>
                                    </div>

                                    <div class="table_container2_sm mt10">
                                        <div class="td">거래일시</div>
                                        <div class="td">
                                            {{ $latestTransaction->year . '.' . $latestTransaction->month }}
                                        </div>
                                        <div class="td">거래 총면적</div>
                                        <div class="td">전용 {{ $latestTransaction->exclusiveArea }}㎡</div>
                                        <div class="td">면적당 단가</div>
                                        <div class="td">전용
                                            {{ Commons::getformatPrice($latestPrice / $latestTransaction->exclusiveArea) }}/㎡
                                        </div>
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
                                                    @foreach ($group as $transaction)
                                                        @php
                                                            $transactionPrice = (float) str_replace(
                                                                ',',
                                                                '',
                                                                $transaction->transactionPrice,
                                                            );
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $transaction->year . '.' . $transaction->month }}
                                                            </td>
                                                            <td>{{ Commons::getformatPrice($transactionPrice) }}</td>
                                                            <td>{{ $transaction->floor }}층</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="btn_more_open">더보기</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- 매매 거래내역 : e -->
            </div>

            <div id="rentContent" class="content_item">
                <!-- 전월세 거래내역 : s -->
                <div class="side_section">
                    <h4>전월세 거래내역</h4>
                    <!-- 데이터 없을 경우 -->
                    @if (count($result->groupedTransactionsRent) <= 0)
                        <div class="empty_wrap sm_type">
                            <span>실거래 내역이 없습니다.</span>
                        </div>
                    @else
                        <div id="rentTransactionContainer">
                            @foreach ($result->groupedTransactionsRent as $area => $group)
                                @php
                                    $filteredGroup = $group->filter(function ($transaction) {
                                        return $transaction->transactionMonthPrice < 1;
                                    });

                                    $Transaction = $group->first();

                                    $latestTransaction = $filteredGroup->first();
                                    $previousTransaction = $filteredGroup->skip(1)->first();
                                    $priceChange = 0;
                                    $priceChangePercent = 0;
                                    if ($latestTransaction && $previousTransaction) {
                                        $latestPrice = (float) str_replace(
                                            ',',
                                            '',
                                            $latestTransaction->transactionPrice,
                                        );
                                        $previousPrice = (float) str_replace(
                                            ',',
                                            '',
                                            $previousTransaction->transactionPrice,
                                        );
                                        $priceChange = $latestPrice - $previousPrice;
                                        if ($previousPrice != 0) {
                                            $priceChangePercent = ($priceChange / $previousPrice) * 100;
                                        }
                                    }
                                    $priceChangeClass = $priceChange > 0 ? 'status_item_red' : 'status_item_blue';
                                @endphp

                                <div class="transactionGroup" data-area="{{ $Transaction->exclusiveArea }}">
                                    @if (count($filteredGroup) > 0)
                                        <div class="transaction_box mt10">
                                            <div class="gray_deep">
                                                <span
                                                    class="transaction_price">{{ Commons::getformatPrice($latestPrice) }}</span>({{ $latestTransaction->floor }}층)
                                            </div>
                                            <div class="{{ $priceChangeClass }}">
                                                {{ Commons::getformatPrice($priceChange) }}
                                                ({{ number_format($priceChangePercent, 2) }}%)
                                            </div>
                                        </div>

                                        <div class="table_container2_sm mt10">
                                            <div class="td">거래일시</div>
                                            <div class="td">
                                                {{ $latestTransaction->year . '.' . $latestTransaction->month }}
                                            </div>
                                            <div class="td">거래 총면적</div>
                                            <div class="td">전용 {{ $latestTransaction->exclusiveArea }}㎡</div>
                                            <div class="td">면적당 단가</div>
                                            <div class="td">전용
                                                {{ Commons::getformatPrice($latestPrice / $latestTransaction->exclusiveArea) }}/㎡
                                            </div>
                                        </div>
                                    @endif
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
                                                    @foreach ($group as $transaction)
                                                        @php
                                                            $transactionPrice = (float) str_replace(
                                                                ',',
                                                                '',
                                                                $transaction->transactionPrice,
                                                            );
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $transaction->year . '.' . $transaction->month }}
                                                            </td>
                                                            <td>{{ Commons::getformatPrice($transactionPrice) }}
                                                            </td>
                                                            <td>{{ $transaction->floor }}층</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="btn_more_open">더보기</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- 전월세 거래내역 : e -->
            </div>
        </div>

        <div class="sction_item">
            <!-- 건물·토지정보 : s -->
            <x-pc-buildingledger :BrTitleInfo="$BrTitleInfo" :BrRecapTitleInfo="$BrRecapTitleInfo" :BrFlrOulnInfo="$BrFlrOulnInfo" :BrExposInfo="$BrExposInfo"
                :BrExposPubuseAreaInfo="$BrExposPubuseAreaInfo" :characteristics_json="$result->characteristics_json" :useWFS_json="$result->useWFS_json" />
            <!-- 건물·토지정보 : e -->
        </div>
        <div class="sction_item">
            <!-- 위치정보 : s -->
            <div class="side_section">
                <h4>위치 및 주변정보</h4>
                <div class="container_map_wrap mt18">
                    <x-pc-around-map :address_lat="$result->address_lat" :address_lng="$result->address_lng" />
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
                            <p class="traffic_row">{{ $result->subwayStation }} {{ $result->subwayLine }}
                                <span>{{ $result->kaptdWtimesub }}</span>
                            </p>

                            <div class="traffic_tit mt28"><img src="{{ asset('assets/media/ic_bus.png') }}">버스
                            </div>
                            <p class="traffic_row">정류장 <span>{{ $result->kaptdWtimebus }}</span></p>

                        </div>
                        <div>
                            <div class="facility_wrap">
                                {!! nl2br($result->convenientFacility) !!}
                            </div>
                        </div>
                        <div>
                            <div class="edu_wrap">
                                {!! nl2br($result->educationFacility) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 위치정보 : e -->
        </div>
        <div class="sction_item">
            <!-- 매물정보 : s -->
            <x-pc-map-product-list :productList="$result->productList" />
            <!-- 매물정보 : e -->
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {

        $('#saleContent').show();
        $('#rentContent').hide();

        // 매매/전월세 탭 클릭 이벤트 처리
        $('.toggle_tab li').on('click', function() {
            var type = $(this).data('type');

            $('.toggle_tab li').removeClass('active');
            $(this).addClass('active');

            // 선택된 타입에 따라 컨텐츠 표시
            if (type === 'sale') {
                $('#saleContent').show();
                $('#rentContent').hide();
            } else if (type === 'rent') {
                $('#saleContent').hide();
                $('#rentContent').show();
            }

            // 드롭다운 옵션 필터링
            $('.areaItem').hide();
            $('.areaItem.' + type).show();

            // 드롭다운 레이블 초기화
            var initialArea = $('.areaItem.' + type).first().data('area');
            $('.dropdown_label').text(initialArea + '㎡');

            // 거래 그룹 필터링
            filterTransactions(type, initialArea);
        });

        // 평수 선택 이벤트 처리
        $('.areaList').on('click', '.areaItem', function() {
            var selectedArea = $(this).data('area');
            $('.dropdown_label').text(selectedArea + '㎡');

            var type = $('.toggle_tab li.active').data('type');
            filterTransactions(type, selectedArea);
        });

        // 초기 로드 시 첫 번째 평수 그룹만 표시
        var initialType = $('.toggle_tab li.active').data('type');
        var initialArea = $('.areaItem.' + initialType).first().data('area');
        filterTransactions(initialType, initialArea);

        function filterTransactions(type, area) {
            if (type === 'sale') {
                $('#saleTransactionContainer .transactionGroup').each(function() {
                    if ($(this).data('area') == area) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            } else if (type === 'rent') {
                $('#rentTransactionContainer .transactionGroup').each(function() {
                    if ($(this).data('area') == area) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        }

    });
</script>
