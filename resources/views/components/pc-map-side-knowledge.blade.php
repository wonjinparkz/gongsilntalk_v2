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
@endphp
<div class="map_side_body">
    <div class="side_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">{{ $result->product_name }}</div>
        <div class="right_area"><a href="#" class="btn_share"><img
                    src="{{ asset('assets/media/header_btn_share_deep.png') }}"></a></div>
        <!-- 공유하기 : s -->
        <div class="layer layer_share_wrap layer_share_top">
            <div class="layer_title">
                <h5>공유하기</h5>
                <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close btn_share">
            </div>
            <div class="layer_share_con">
                <a class="kakaotalk-sharing-btn" onclick="modal_close_slide('share');"
                    data-title="{{ $result->product_name }} 실거래가" data-description="{{ $result->address }}"
                    data-image-url="{{ asset('storage/file/' . $result->birdSEyeView_files[0]->path . '/' . $result->birdSEyeView_files[0]->path) }}"
                    data-m_link="{{ route('www.map.mobile', ['markerId' => $result->id, 'markerType' => 'knowledge', 'lat' => $result->address_lat, 'lng' => $result->address_lng]) }}" data-pc_link="{{ route('www.map.map', ['markerId' => $result->id, 'markerType' => 'knowledge', 'lat' => $result->address_lat, 'lng' => $result->address_lng]) }}">
                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                    <p class="mt8">카카오톡</p>
                </a>
                <a
                    onclick="textCopy('{{ route('www.map.map', ['markerId' => $result->id, 'markerType' => 'knowledge', 'lat' => $result->address_lat, 'lng' => $result->address_lng]) }}'); modal_close_slide('share');">
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
            <p class="txt_address">{{ $result->address }}</p>
            <p class="txt_sub_1">{{ $result->subway_name }} <span>{{ $result->subway_time }}</span></p>
            <p class="txt_sub_1"><span>{{ $result->comments }}</span></p>
        </div>

        <!-- tab : s -->
        <div class="tab_type_2 type_side" id="tabList" onclick="scrollToTab(this)">
            <div style="width: 100%;">
                <div class="swiper detail_tab">
                    <div class="swiper-wrapper menu toggle_menu">
                        <div class="swiper-slide active"><a>거래내역</a></div>
                        <div class="swiper-slide"><a>조감도</a></div>
                        <div class="swiper-slide"><a>건물정보</a></div>
                        <div class="swiper-slide"><a>현장설명</a></div>
                        <div class="swiper-slide"><a>특장점</a></div>
                        <div class="swiper-slide"><a>층별도면</a></div>
                        <div class="swiper-slide"><a>위치 및 주변정보</a></div>
                    </div>
                </div>
                <div class="swiper-button-next detail-tab-next"><img
                        src="{{ asset('assets/media/ic_list_arrow.png') }}" style="width:10px;"></div>
                <!-- <div class="swiper-button-prev detail-tab-prev"></div> -->
            </div>
        </div>
        <!-- tab : e -->

        <div class="side_tab_wrap">
            <div class="sction_item active">
                <!-- 거래내역 : s -->
                <div class="side_section min_height">
                    <div class="flex_between">
                        <h4>거래내역</h4>
                        <p class="txt_sub_1"><span>* 부동산 매물정보 기준</span></p>
                    </div>
                    <div class="mt20">
                        <div class="table_container2_sm mt10">
                            <table class="table_type_1">
                                <colgroup>
                                    <col width="50">
                                    <col width="120">
                                    <col width="120">
                                    <col width="120">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>최저가</th>
                                        <th>평균가</th>
                                        <th>최고가</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>매매</td>
                                        <td>{{ $result->sale_min_price }}만원</td>
                                        <td><span
                                                style="color: var(--main-color)">{{ $result->sale_mid_price }}만원</span>
                                        </td>
                                        <td>{{ $result->sale_max_price }}만원</td>
                                    </tr>
                                    <tr>
                                        <td>임대</td>
                                        <td>{{ $result->lease_min_price }}만원</td>
                                        <td><span style="color: var(--main-color)">{{ $result->lease_mid_price }}만원
                                        </td>
                                        <td>{{ $result->lease_max_price }}만원</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- 거래내역 : e -->
            </div>

            <div class="sction_item">
                <!-- 조감도 : s -->
                <div class="side_section min_height">
                    <h4>조감도</h4>
                    <div class="side_info_wrap mt20">
                        @foreach ($result->birdSEyeView_files as $file)
                            <img src="{{ Storage::url('file/' . $file->path . '/' . $file->path) }}" class="size_100p">
                        @endforeach
                    </div>
                </div>
                <!-- 조감도 : e -->
            </div>

            <div class="sction_item min_height">
                <!-- 건물·토지정보 : s -->
                @if (count($BrTitleInfo) > 0 || count($BrRecapTitleInfo) > 0)
                    <x-pc-buildingledger :BrTitleInfo="$BrTitleInfo" :BrRecapTitleInfo="$BrRecapTitleInfo" :BrFlrOulnInfo="$BrFlrOulnInfo" :BrExposInfo="$BrExposInfo"
                        :BrExposPubuseAreaInfo="$BrExposPubuseAreaInfo" :characteristics_json="$result->characteristics_json" :useWFS_json="$result->useWFS_json" />
                @else
                    <div class="side_section">
                        <h4>건물·토지정보</h4>
                    </div>

                    <div class="">
                        <div class="default_box showstep1">
                            <div class="table_container2_sm mt10">
                                <div class="td">규모</div>
                                <div class="td">{{ $result->min_floor ?? '-' }}층 /
                                    {{ $result->max_floor ?? '-' }}층
                                </div>
                                <div class="td">준공일</div>
                                @inject('carbon', 'Carbon\Carbon')
                                <div class="td">{{ $carbon::parse($result->completion_date)->format('Y.m.d') }}
                                </div>
                                <div class="td">건축면적</div>
                                <div class="td">
                                    {{ number_format($result->building_area) }}평 /
                                    {{ number_format($result->building_square, 2) }}㎡
                                </div>
                                <div class="td">연면적</div>
                                <div class="td">
                                    {{ number_format($result->total_floor_area) }}평 /
                                    {{ number_format($result->total_floor_square, 2) }}㎡
                                </div>
                                <div class="td">대지면적</div>
                                <div class="td">
                                    {{ number_format($result->area) }}평 / {{ number_format($result->square, 2) }}㎡
                                </div>
                                <div class="td">주차대수</div>
                                <div class="td">{{ number_format($result->parking_count) }}</div>
                                <div class="td">세대수</div>
                                <div class="td">{{ number_format($result->generation_count) }}</div>
                                <div class="td">시공사</div>
                                <div class="td">{{ $result->comstruction_company ?? '-' }}</div>
                                <div class="td">시행사</div>
                                <div class="td">{{ $result->developer ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="btn_more_open">더보기</div>
                    </div>

                    @if ($result->characteristics_json != '')
                        @php
                            // 주어진 문자열
                            $encodedString = $result->characteristics_json;
                            // HTML 엔티티를 디코드
                            $decodedString = html_entity_decode($encodedString);

                            // JSON 문자열을 PHP 배열로 변환
                            $jsonArray = json_decode($decodedString, true);

                            // 특정 키의 값 추출

                            // JSON 문자열을 PHP 배열로 변환
                            if ($result->useWFS_json != '') {
                                $WFSencodedString = $result->useWFS_json;
                                $WFSdecodedString = html_entity_decode($WFSencodedString);
                                $useWFSArray = json_decode($WFSdecodedString, true);
                                $prpos = $useWFSArray['prpos_area_dstrc_nm_list'] ?? '-';
                            }
                        @endphp
                        <div class="open_con_wrap building_item_4">
                            <div class="open_trigger">토지정보 <span><img
                                        src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
                            </div>
                            <div class="con_panel">
                                <div class="default_box showstep1">
                                    <div class="table_container2_sm mt10">
                                        <div class="td">면적</div>
                                        <div class="td">{{ number_format($jsonArray['lndpclAr'], 2) }}㎡</div>
                                        <div class="td">지목</div>
                                        <div class="td">{{ $jsonArray['lndcgrCodeNm'] }}</div>
                                        <div class="td">용도지역</div>
                                        <div class="td">{{ $jsonArray['prposArea1Nm'] }}</div>
                                        <div class="td">이용상황</div>
                                        <div class="td">{{ $jsonArray['ladUseSittnNm'] }}</div>
                                        <div class="td">형상</div>
                                        <div class="td">{{ $jsonArray['tpgrphFrmCodeNm'] }}</div>
                                        <div class="td">지형높이</div>
                                        <div class="td">{{ $jsonArray['tpgrphHgCodeNm'] }}</div>
                                        <div class="td">동 개별 공시지가(원/m²)</div>
                                        <div class="td">{{ number_format($jsonArray['pblntfPclnd']) }}</div>
                                        <div class="td">지역지구등<br>지정여부</div>
                                        <div class="td">{{ $prpos ?? '-' }}</div>
                                    </div>
                                </div>
                                <div class="btn_more_open">더보기</div>
                            </div>
                        </div>
                    @endif
                @endif
                <!-- 건물·토지정보 : e -->
            </div>

            <div class="sction_item min_height">
                <!-- 현장설명 : s -->
                <div class="side_section">
                    <h4>현장설명</h4>

                    <div class="txt_lh_1 mt20">
                        {!! nl2br($result->site_contents) !!}
                    </div>

                    <h4 class="mt40">교통정보</h4>
                    <div class="txt_lh_1 mt20">
                        {!! nl2br($result->traffic_info) !!}
                    </div>

                </div>
                <!-- 현장설명 : e -->

            </div>

            <div class="sction_item min_height">
                <!-- 특장점 : s -->
                <div class="side_section">
                    <h4>특장점</h4>
                </div>
                <div>
                    <div class="swiper features features1">
                        <div class="swiper-wrapper">
                            @foreach ($result->features_files as $file)
                                <div class="swiper-slide">
                                    <img src="{{ Storage::url('file/' . $file->path . '/' . $file->path) }}"
                                        class="size_100p">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next features-doc-next"><img
                                src="{{ asset('assets/media/arrow_w_next.png') }}"></div>
                        <div class="swiper-button-prev features-doc-prev"><img
                                src="{{ asset('assets/media/arrow_w_prev.png') }}"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!-- 특장점 : e -->

            </div>

            <div class="sction_item min_height">
                <!-- 층별도면 : s -->
                <div class="side_section">
                    <h4>층별도면</h4>
                </div>
                <div>
                    <div class="swiper features floor">
                        <div class="swiper-wrapper">
                            @foreach ($result->floorPlan_files as $file)
                                <div class="swiper-slide">
                                    <img src="{{ Storage::url('file/' . $file->path . '/' . $file->path) }}"
                                        class="size_100p">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next floor-doc-next"><img
                                src="{{ asset('assets/media/arrow_w_next.png') }}"></div>
                        <div class="swiper-button-prev floor-doc-prev"><img
                                src="{{ asset('assets/media/arrow_w_prev.png') }}"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <!-- 층별도면 : e -->
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
                                <p class="traffic_row">{{ $result->subway_name }} {{ $result->subway_distance }}
                                    {{ $result->subway_time }}
                                </p>

                                <div class="traffic_tit mt28"><img src="{{ asset('assets/media/ic_bus.png') }}">버스
                                    정류장
                                </div>
                                <p class="traffic_row">{!! nl2br($result->bus_stop_contents) !!}</p>

                            </div>
                            <div>
                                <div class="facility_wrap">
                                    {!! nl2br($result->facilities_contents) !!}
                                </div>
                            </div>
                            <div>
                                <div class="edu_wrap">
                                    {!! nl2br($result->education_contents) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 위치정보 : s -->
            </div>

        </div>
    </div>
</div>

<script>
    // 특장점
    var features = new Swiper(".features1", {
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".features-doc-next",
            prevEl: ".features-doc-prev",
        },
    });
    // 층별도면
    var floor = new Swiper(".floor", {
        pagination: {
            el: ".swiper-pagination",
            type: "fraction",
        },
        navigation: {
            nextEl: ".floor-doc-next",
            prevEl: ".floor-doc-prev",
        },
    });

    // 탭메뉴 토글기능
    $(document).ready(function() {
        initializeDropdowns();

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
