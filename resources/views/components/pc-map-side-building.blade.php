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

    // 총괄표제부
    $dongCount = '-';
    $mainUse = '-';

    if (count($BrRecapTitleInfo) > 0) {
        $mainBldcnt = $BrRecapTitleInfo[0]['mainBldcnt'];
        $mainPurpsCdNm = $BrRecapTitleInfo[0]['mainPurpsCdNm'];
        if ($mainBldcnt > 0 || $mainBldcnt != '') {
            $dongCount = $mainBldcnt;
        }
        if ($mainPurpsCdNm > 0 || $mainPurpsCdNm != '') {
            $mainUse = $mainPurpsCdNm;
        }
    }

    // 모든 표제부 층 정보를 가져와 상단 층별정보에 값 넣어주기
    $maxGroundFloor = 0; // 최고 지상층
    $minGroundFloor = null; // 최저 지상층
    $maxUndergroundFloor = null; // 최고 지하층
    $useAprDay = '-'; // 사용 승인일 초기값

    if (count($BrTitleInfo) > 0) {
        foreach ($BrTitleInfo as $info) {
            $currentGroundFloor = $info['grndFlrCnt']; // 현재 지상층 수
            $currentUndergroundFloor = isset($info['ugrndFlrCnt']) ? $info['ugrndFlrCnt'] : null; // 현재 지하층 수, 없으면 null

            // 최고 지상층 찾기
            if ($currentGroundFloor > $maxGroundFloor) {
                $maxGroundFloor = $currentGroundFloor;
            }

            // 최저 지상층 찾기
            if (is_null($minGroundFloor) || $currentGroundFloor < $minGroundFloor) {
                $minGroundFloor = $currentGroundFloor;
            }

            // 최고 지하층 찾기
            if (
                !is_null($currentUndergroundFloor) &&
                $currentUndergroundFloor > 0 &&
                $currentUndergroundFloor > $maxUndergroundFloor
            ) {
                $maxUndergroundFloor = $currentUndergroundFloor;
            }

            // 사용 승인일 처리
            if (!empty($info['useAprDay'])) {
                $useAprDay = substr($info['useAprDay'], 0, 4); // YYYY 형식으로 년도만 추출
            }

            // 주용도 처리
            if (!empty($info['mainPurpsCdNm']) && $mainUse == '-') {
                $mainUse = $info['mainPurpsCdNm'];
            }
        }
    }

    // 지하층이 없으면 지상 1층을 최저층으로 표시, 지하층이 있으면 최저층은 지하층
    $minFloorDisplay = is_null($maxUndergroundFloor) ? 1 : 'B' . $maxUndergroundFloor;
    $maxFloorDisplay = $maxGroundFloor > 0 ? $maxGroundFloor : '-';

@endphp

<div class="map_side_body">
    <div class="side_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">{{ $result->kbuildingName }}</div>
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
                <a
                    onclick="textCopy('{{ route('www.map.map', ['markerId' => $result->id, 'markerType' => 'building', 'lat' => $result->address_lat, 'lng' => $result->address_lng]) }}'); modal_close_slide('share');">
                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
                    <p class="mt8">링크복사</p>
                </a>
            </div>
        </div>
        <!-- 공유하기 : e -->
    </div>

    <div class="scroll_wrap_1" id="scrollContainer">
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
                <div id="minimap" style="width:100%; height:230px;" class="size_100p"></div>
            </div>
            <p class="txt_address">{{ $result->kbuildingAddr }}</p>
            <p class="txt_sub_1">{{ $result->subwayStation }} {{ $result->subwayLine }}
                <span>{{ $result->kbuildingdWtimesub }}</span>
            </p>
            <ul class="info_detail">
                <li>
                    <p>{{ $dongCount }}동</p><label>총 동수</label>
                </li>
                <li>
                    <p>{{ $mainUse }}</p><label>주용도</label>
                </li>
                <li>
                    <p>
                        {{ $minFloorDisplay . '층/' . $maxFloorDisplay . '층' }}
                    </p>
                    <label>최저/최고</label>
                </li>
                <li>
                    <p>{{ $useAprDay }}년</p><label>준공년도</label>
                </li>
            </ul>
        </div>

        <!-- tab : s -->
        <div class="tab_type_2 type_side" id="tabList" onclick="scrollToTab(this)">
            <div style="width: 100%;">
                <div class="swiper detail_tab">
                    <div class="swiper-wrapper menu toggle_menu">
                        <div class="swiper-slide active"><a href="javascript:void(0);">가격·거래내역</a></div>
                        <div class="swiper-slide"><a href="javascript:void(0);">건물·토지정보</a></div>
                        <div class="swiper-slide"><a href="javascript:void(0);">위치 및 주변정보</a></div>
                        <div class="swiper-slide"><a href="javascript:void(0);">매물정보</a></div>
                    </div>
                </div>
                <div class="swiper-button-next detail-tab-next"></div>
                <!-- <div class="swiper-button-prev detail-tab-prev"></div> -->
            </div>
        </div>
        <!-- tab : e -->

        <div class="side_tab_wrap">
            <div class="sction_item active">
                <!-- 거래내역 : s -->
                <div class="side_section min_height">
                    <h4>거래내역</h4>
                    <!-- 데이터 없을 경우 -->
                    <div class="sm_type mt10">
                        <button class="btn_point btn_md_full" onclick="location.href='//rtdown.molit.go.kr/'">실거래가
                            보러가기</button>
                    </div>
                </div>
                <!-- 거래내역 : e -->
            </div>
            <div class="sction_item min_height">
                <!-- 건물·토지정보 : s -->
                <x-pc-buildingledger :BrTitleInfo="$BrTitleInfo" :BrRecapTitleInfo="$BrRecapTitleInfo" :BrFlrOulnInfo="$BrFlrOulnInfo" :BrExposInfo="$BrExposInfo"
                    :BrExposPubuseAreaInfo="$BrExposPubuseAreaInfo" :characteristics_json="$result->characteristics_json" :useWFS_json="$result->useWFS_json" />
                <!-- 건물·토지정보 : e -->
            </div>
            <div class="sction_item">
                <!-- 위치정보 : s -->
                <div class="side_section min_height">
                    <h4>위치 및 주변정보</h4>
                    <div class="container_map_wrap mt18">
                        <x-pc-around-map :address_lat="$result->address_lat" :address_lng="$result->address_lng" />
                    </div>
                    <div class="map_detail_wrp">
                        <ul class="tab_sm_menu tab_type_4">
                            <li class="active"><a href="javascript:(0)">대중교통</a></li>
                            <li><a href="javascript:(0)">편의시설</a></li>
                            <li><a href="javascript:(0)">교육시설</a></li>
                        </ul>
                        <div class="tab_sm_wrap">
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
                <!-- 위치정보 : s -->
            </div>
            <div class="sction_item min_height">
                <!-- 매물정보 : s -->
                <x-pc-map-product-list :productList="$result->productList" />
                <!-- 매물정보 : e -->
            </div>
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
            $('.optionItem').hide();
            $('.optionItem.' + type).show();

            // 드롭다운 레이블 초기화
            var initialArea = $('.optionItem.' + type).first().data('area');
            $('.dropdown_label').text(initialArea + '㎡');

            // 거래 그룹 필터링
            filterTransactions(type, initialArea);
        });

        // 평수 선택 이벤트 처리
        $('.optionList').on('click', '.optionItem', function() {
            var selectedArea = $(this).data('area');
            $('.dropdown_label').text(selectedArea + '㎡');

            var type = $('.toggle_tab li.active').data('type');
            filterTransactions(type, selectedArea);
        });

        // 초기 로드 시 첫 번째 평수 그룹만 표시
        var initialType = $('.toggle_tab li.active').data('type');
        var initialArea = $('.optionItem.' + initialType).first().data('area');
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

    // 탭메뉴 토글기능
    $(document).ready(function() {
        $(".tab_sm_wrap > div").hide();
        $(".tab_sm_wrap > div").first().show();
        $(".tab_sm_menu li").click(function() {
            var list = $(this).index();
            $(".tab_sm_menu li").removeClass("active");
            $(this).addClass("active");

            $(".tab_sm_wrap > div").hide();
            $(".tab_sm_wrap > div").eq(list).show();
        });
    });

    // 탭 상단 고정
    function scrollToTab(tab) {
        const scrollContainer = document.getElementById('scrollContainer');
        const offsetTop = tab.offsetTop - 1;
        scrollContainer.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    }
</script>
