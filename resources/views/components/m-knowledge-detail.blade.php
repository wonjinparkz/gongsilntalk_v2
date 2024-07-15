<body>
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

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('m_product_detail')">
        </div>
        <div class="m_title">{{ $result->product_name }}</div>
        <div class="right_area"><img src="{{ asset('assets/media/header_btn_share_deep.png') }}"
                onclick="modal_open_slide('share')"></div>
    </div>
    <div class="modal_slide modal_slide_share">
        <div class="slide_title_wrap">
            <span>공유하기</span>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('share')">
        </div>
        <div class="slide_modal_body">
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
    </div>
    <div class="md_slide_overlay md_slide_overlay_share" onclick="modal_close_slide('share')"></div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body map_side side_list_scroll" id="scrollContainer">
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
            <div style="width:100%;">
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
                                    <col width="100">
                                    <col width="100">
                                    <col width="100">
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
            </div>
            <!-- 거래내역 : e -->

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

            <div class="sction_item">
                <!-- 특장점 : s -->
                <div class="side_section min_height">
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
                                    <span>{{ $result->subway_time }}</span>
                                </p>

                                <div class="traffic_tit mt28"><img src="{{ asset('assets/media/ic_bus.png') }}">버스
                                </div>
                                <p class="traffic_row">정류장 <span>{{ $result->bus_stop_contents }}</span></p>

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


    <script type="text/javascript"
        src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
    </script>


    <script>
        modal_close_slide('share');

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

        var miniMap;

        window.miniMap = function() {
            try {
                miniMap = new naver.maps.Map('minimap', {
                    center: new naver.maps.LatLng({{ $result->address_lat }}, {{ $result->address_lng }}),
                    // center: new naver.maps.LatLng(37.48860419800877, 126.8880090781063),
                    zoom: 15,
                    minZoom: 13,
                    maxZoom: 20,
                    mapTypeId: naver.maps.MapTypeId.NORMAL,
                });
            } catch (error) {
                // Handle any errors that occur during map creation
                console.error('no minimap:', error.message);
            }
        }

        window.miniMap();

        // 미니맵 좌표
        // naver.maps.Event.addListener(miniMap, 'init', function() {
        //     naver.maps.Event.addListener(miniMap, 'dragend', function() {
        //         var center = miniMap.getCenter();
        //         var zoom = miniMap.getZoom();
        //         console.log('미니맵 : ', zoom);
        //     });
        // });

        // 좌표 문자열을 파싱하여 배열로 변환하는 함수
        function convertCoords(coordString) {
            // 좌표 문자열에서 [x, y] 패턴을 추출하여 배열로 변환
            var coordArray = coordString.match(/\[([^\]]+)\]/g).map(function(coord) {
                return coord.replace(/[\[\]]/g, '').split(', ').map(Number);
            });
            return coordArray;
        }

        // 테스트할 좌표 문자열
        var coordsString = "{{ $result->polygon_coordinates ?? '' }}";

        if (coordsString != '') {
            // 변환된 좌표 배열
            var convertedCoords = convertCoords(coordsString);

            // 변환된 좌표 리스트 초기화
            var transformedCoords = [];

            // 각 좌표 변환
            $.each(convertedCoords, function(index, coord) {
                transformedCoords.push(new naver.maps.LatLng(coord[1], coord[0]));
            });

            // 폴리곤 그리기
            var polygonMiniMap = new naver.maps.Polygon({
                map: miniMap,
                paths: transformedCoords,
                fillColor: '#ff0000',
                fillOpacity: 0.3,
                strokeColor: '#ff0000',
                strokeOpacity: 0.6,
                strokeWeight: 3
            });

            // 폴리곤 그리기
            polygonMap = new naver.maps.Polygon({
                map: map,
                paths: transformedCoords,
                fillColor: '#ff0000',
                fillOpacity: 0.3,
                strokeColor: '#ff0000',
                strokeOpacity: 0.6,
                strokeWeight: 3
            });

        }

        //공유하기 레이어
        $(".btn_share").click(function() {
            $(".layer_share_wrap").stop().slideToggle(0);
            return false;
        });

        // 페이지 탭
        var detail_tab = new Swiper(".detail_tab", {
            slidesPerView: 'auto',
            freeMode: true,
            breakpointsInverse: true,
            breakpoints: {
                1023: {
                    allowTouchMove: true
                }
            },
            navigation: {
                nextEl: ".detail-tab-next",
                prevEl: ".detail-tab-prev",
            },
        });

        // 탭에 클릭 이벤트 추가
        $('.detail_tab .swiper-slide').on('click', function() {
            var index = $(this).index();
            showContent(index);
        });

        // 슬라이드 탭
        function showContent(index) {
            $('.side_tab_wrap .sction_item').removeClass('active');
            $('.side_tab_wrap .sction_item').eq(index).addClass('active');
            $('.swiper-slide').removeClass('active');
            $('.swiper-slide').eq(index).addClass('active');
        }


        // 컨텐츠 더보기 기능
        $(document).off('click', '.btn_more_open').on('click', '.btn_more_open', function(e) {
            let box = $(this).prev(); // 클릭한 버튼의 이전 요소(박스) 선택
            let classList = box.attr('class').split(/\s+/); // 박스의 클래스 정보 얻기
            let contentHeight = box.height(); // 박스의 높이 얻기

            if (classList.includes('showstep2')) {
                box.removeClass('showstep2').addClass('showstep1');
                $(this).text('더보기').removeClass('close');
            } else if (classList.includes('showstep1')) {
                box.removeClass('showstep1').addClass('showstep2');
                $(this).text('접기').addClass('close');
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            initializeDropdowns();

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
                $('.dropdown_area_label').text(initialArea + '㎡');

                // 거래 그룹 필터링
                filterTransactions(type, initialArea);
            });

            // 평수 선택 이벤트 처리
            $('.areaList').on('click', '.areaItem', function() {
                var selectedArea = $(this).data('area');
                $('.dropdown_area_label').text(selectedArea + '㎡');
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

        // $('#areaTypeText').click(function() {
        //     $(this).parent().toggleClass('active');
        // });

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
            const offsetTop = tab.offsetTop - 50;
            scrollContainer.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
        }
    </script>


</body>
