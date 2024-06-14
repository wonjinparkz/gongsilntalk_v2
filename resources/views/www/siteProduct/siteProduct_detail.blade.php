<x-layout>
    <script type="text/javascript"
        src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
    </script>

    <!-- Pannellum library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pannellum/2.5.6/pannellum.css"
        integrity="sha512-UoT/Ca6+2kRekuB1IDZgwtDt0ZUfsweWmyNhMqhG4hpnf7sFnhrLrO0zHJr2vFp7eZEvJ3FN58dhVx+YMJMt2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pannellum/2.5.6/pannellum.js"
        integrity="sha512-EmZuy6vd0ns9wP+3l1hETKq/vNGELFRuLfazPnKKBbDpgZL0sZ7qyao5KgVbGJKOWlAFPNn6G9naB/8WnKN43Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        #panorama-360-view {
            width: 1175px;
            height: 570px;
        }
    </style>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">{{ $result->title }}</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        <div class="sales_bar_wrap only_pc">
            <div class="inner_wrap sales_name_bar">
                <div>
                    <p class="txt_location">{{ $result->region_address }}</p>
                    <h1>{{ $result->title }}</h1>
                </div>
                <div class="sales_bar_right">
                    <span class="header_btn_wish {{ isset($result->like_id) ? 'on' : '' }}"
                        onclick="onLikeStateChange('{{ $result->id }}', 'site_product');btn_wish(this)"></span>
                    <a href="#"><img src="{{ asset('assets/media/header_btn_alarm.png') }}"
                            class="header_ic_btn"></a>
                    <a href="#"><img src="{{ asset('assets/media/header_btn_share_deep.png') }}"
                            class="header_ic_btn"></a>
                    <button class="btn_graydeep_ghost btn_md_bold">분양문의</button>
                </div>
            </div>
        </div>

        <div class="template_wrap">
            <div class="template_txt_wrap">
                <p class="txt_tit">{{ $result->title }}</p>
                <p class="txt_con">{!! $result->contents !!}</p>
            </div>
            <div class="template_img">
                <div class="img_box"><img
                        src="{{ Storage::url('image/' . $result->images[0]->path) }}"onerror="this.onerror=null; this.src='{{ asset('assets/media/s_3.png') }}'">
                </div>
            </div>
        </div>

        <!-- tab : s -->
        <div class="tab_type_2 sales_tab">
            <div class="inner_wrap">
                <div class="swiper detail_tab">
                    <div class="swiper-wrapper menu">
                        <div class="swiper-slide active"><a href="#tab_area_1">기본정보</a></div>
                        <div class="swiper-slide"><a href="#tab_area_2">층별정보</a></div>
                        <div class="swiper-slide"><a href="#tab_area_3">프리미엄</a></div>
                        <div class="swiper-slide"><a href="#tab_area_4">분양일정</a></div>
                        <div class="swiper-slide"><a href="#tab_area_5">오시는길</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tab : e -->


        <!-- 기본정보 : s -->
        <div class="inner_wrap sales_section_1">
            <section id="tab_area_1" class="page">
                <div class="flex_between">
                    <h3>기본정보</h3>
                    <div class="change_unit toggle_menu">
                        <div class="active" onclick="onSizeTextChange(0);">㎡</div>
                        <div onclick="onSizeTextChange(1);">평</div>
                    </div>
                </div>

                <input type="hidden" id="area" name="area" value="{{ $result->area }}">
                <input type="hidden" id="square" name="square" value="{{ $result->square }}">
                <input type="hidden" id="building_area" name="building_area" value="{{ $result->building_area }}">
                <input type="hidden" id="building_square" name="building_square"
                    value="{{ $result->building_square }}">
                <input type="hidden" id="total_floor_area" name="total_floor_area"
                    value="{{ $result->total_floor_area }}">
                <input type="hidden" id="total_floor_square" name="total_floor_square"
                    value="{{ $result->total_floor_square }}">


                <div class="table_container sales_table_info">
                    <div>주소</div>
                    <div>{{ $result->address }}</div>
                    <div>규모</div>
                    <div>{{ $result->min_floor }}층 / {{ $result->max_floor }}층 {{ $result->dong_count }}개동</div>
                    <div>총 세대수</div>
                    <div>{{ $result->generation_count }}실</div>
                    <div>주차대수</div>
                    <div>{{ $result->parking_count }}대</div>
                    <div>대지면적</div>
                    <div id="basicArea">{{ $result->square }}㎡</div>
                    <div>건축면적</div>
                    <div id="buildingArea">{{ $result->building_square }}㎡</div>
                    <div>연면적</div>
                    <div id="totalFloorArea">{{ $result->total_floor_square }}㎡</div>
                    <div>용적률/건폐율</div>
                    <div>{{ $result->floor_area_ratio }}% / {{ $result->builging_ratio }}%</div>
                    <div>준공일</div>
                    <div>{{ $result->completion_date }}</div>
                    <div>입주예정</div>
                    <div>{{ $result->expected_move_date }}</div>
                    <div>시행사</div>
                    <div>{{ $result->developer ?? '-' }}</div>
                    <div>시공사</div>
                    <div>{{ $result->comstruction_company ?? '-' }}</div>
                </div>

                <div class="detail_camera_wrap">
                    <div class="gray_basic">*클릭을 통해 직접 건물 내부를 이동하며 확인해보세요.</div>
                    <div class="mt8" onclick="onMetaLink();">
                        <div id="panorama-360-view"></div>
                    </div>
                </div>
            </section>
        </div>

        <section class="sales_section_2 page">
            <div class="inner_wrap">
                <h3>교육자료</h3>

                <div class="swiper edu_document">
                    <div class="swiper-wrapper">
                        @foreach ($result->edu_images as $image)
                            <div class="swiper-slide"><img src="{{ Storage::url('image/' . $image->path) }}"
                                    class="document_img">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- 기본정보 : s -->

        <!-- 층별정보  : s -->
        <div class="inner_wrap sales_section_2-2">
            <h3>층별정보</h3>
            <section id="tab_area_2" class="page">

                <ul class="tab_type_6 toggle_tab mt28">
                    @php
                        $floorFirstArr = [];
                        $floorFirstInfo = [];
                    @endphp


                    @foreach ($result->dongInfo as $key => $dongInfo)
                        @php
                            if ($key == 0) {
                                $floorFirstArr = $dongInfo->floorInfo;
                            }
                        @endphp
                        <li {{ $key == 0 ? 'class=active' : '' }} onclick="onFloorListGet('{{ $dongInfo->id }}');">
                            {{ $dongInfo->dong_name }}</li>
                    @endforeach
                </ul>

                <div class="black_filter only_pc mt28" id="floorListPc">
                    @foreach ($floorFirstArr as $key => $floorInfo)
                        @php
                            if ($key == 0) {
                                $floorFirstInfo = $floorInfo;
                            }
                        @endphp

                        <div class="cell">
                            <input type="radio" name="floor" id="floor_{{ $floorInfo->id }}"
                                {{ $key == 0 ? 'checked' : '' }} value="{{ $floorInfo->id }}"
                                onclick="onFloorDetailListGet('{{ $floorInfo->id }}');">
                            <label for="floor_{{ $floorInfo->id }}">{{ $floorInfo->floor_name }}</label>
                        </div>
                    @endforeach
                </div>

                <select class="sales_floor_select only_m" id="floorListMobile" name="floorListMobile"
                    onchange="onFloorDetailChange();">
                    @foreach ($floorFirstArr as $floorInfo)
                        <option value="{{ $floorInfo->id }}">{{ $floorInfo->floor_name }}</option>
                    @endforeach
                </select>

                <div>
                    @php
                        $typeArray = [];
                        $floorFirstInfo->is_neighborhood_life ? array_push($typeArray, '근린지원시설') : '';
                        $floorFirstInfo->is_industry_center ? array_push($typeArray, '지식산업센터') : '';
                        $floorFirstInfo->is_warehouse ? array_push($typeArray, '공동창고') : '';
                        $floorFirstInfo->is_dormitory ? array_push($typeArray, '기숙사,유치원') : '';
                        $floorFirstInfo->is_business_support ? array_push($typeArray, '업무지원시설') : '';
                    @endphp
                    <div class="floor_title">{{ $floorFirstInfo->floor_name }}</div>
                    <div class="floor_info">{{ implode('/', $typeArray) }}</div>
                    <div><img id="floorDetailImage"
                            src="{{ Storage::url('image/' . $floorFirstInfo->images->path) }}" class="w_100">
                    </div>
                </div>
            </section>
        </div>
        <!-- 층별정보  : e -->

        <!-- 프리미엄  : s -->
        <div class="inner_wrap sales_section_3">
            <section id="tab_area_3" class="page">
                <h3>프리미엄</h3>

                <div class="premium_wrap">
                    <div class="premium_cell">
                        <label>01</label>
                        <p>{{ $result->premiumInfo->title_1 }}</p>
                        <div>{!! $result->premiumInfo->contents_1 !!}</div>
                    </div>
                    <div class="premium_cell">
                        <label>02</label>
                        <p>{{ $result->premiumInfo->title_2 }}</p>
                        <div>{!! $result->premiumInfo->contents_2 !!}
                        </div>
                    </div>
                    @if ($result->premiumInfo->is_blind_1 != 1)
                        <div class="premium_cell">
                            <label>03</label>
                            <p>{{ $result->premiumInfo->title_3 }}</p>
                            <div>{!! $result->premiumInfo->contents_3 !!}
                            </div>
                        </div>
                        <div class="premium_cell">
                            <label>04</label>
                            <p>{{ $result->premiumInfo->title_4 }}</p>
                            <div>{!! $result->premiumInfo->contents_4 !!}</div>
                        </div>
                    @endif
                    @if ($result->premiumInfo->is_blind_2 != 1)
                        <div class="premium_cell">
                            <label>05</label>
                            <p>{{ $result->premiumInfo->title_5 }}</p>
                            <div>{!! $result->premiumInfo->contents_5 !!}</div>
                        </div>
                        <div class="premium_cell">
                            <label>06</label>
                            <p>{{ $result->premiumInfo->title_6 }}</p>
                            <div>{!! $result->premiumInfo->contents_6 !!}</div>
                        </div>
                    @endif

                </div>
            </section>
        </div>
        <!-- 프리미엄  : e -->

        <!-- 분양일정  : s -->
        <div class="inner_wrap sales_section_4">
            <section id="tab_area_4" class="page">
                <h3>분양일정</h3>
                <p class="txt_item_1">*분양 일정은 건설사 사정에 따라 변경될 수 있습니다.</p>

                @php
                    $yearArray = [];
                    $dateJson = [];
                    foreach ($result->scheduleInfo as $schedule) {
                        array_push($yearArray, date('Y', strtotime($schedule->start_date)));
                    }
                    $yearArray = array_unique($yearArray);

                    foreach ($yearArray as $year) {
                        $dateJson[$year] = [];
                        foreach ($result->scheduleInfo as $key => $schedule) {
                            if (date('Y', strtotime($schedule->start_date)) == $year) {
                                array_push($dateJson[$year], $schedule);
                            }
                        }
                    }
                @endphp

                @foreach ($yearArray as $year)
                    <div class="sales_schedule_wrap">
                        <div class="item_year">{{ $year }}년</div>
                        <ul class="sales_schedule_list">

                            @foreach ($dateJson[$year] as $schedule)
                                <li>
                                    <div class="schedule_item_1">{{ date('Y.m.d', strtotime($schedule->start_date)) }}
                                    </div>
                                    <div class="schedule_item_2">{{ $schedule->title }}
                                        @if (date('Y.m.d', strtotime($schedule->start_date)) == date('Y.m.d'))
                                            <span class="schedule_item_3">D-DAY</span>
                                        @elseif (date('Y.m.d', strtotime($schedule->start_date)) > date('Y.m.d'))
                                            <span
                                                class="schedule_item_3">D-{{ floor((strtotime(date($schedule->start_date)) - strtotime(date('Y-m-d', time()))) / 86400) }}</span>
                                        @else
                                            <span></span>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </section>
        </div>
        <!-- 분양일정  : e -->

        <!-- 오시는길  : s -->
        <div class="inner_wrap sales_section_5">
            <section id="tab_area_5" class="page">
                <h3>오시는 길</h3>

                <div class="sales_address_info">
                    <div class="txt_sales_address">{{ $result->address }}</div>
                    <button class="btn_gray_ghost btn_sm only_pc"type="button" onclick="textCopy();">주소복사</button>
                </div>

                <div class="sales_map_wrap">
                    <div id="map" style="width:100%; height:500px">
                    </div>
                </div>

                <div class="m_address_btn only_m">
                    <button class="btn_gray_ghost btn_sm" type="button" onclick="textCopy();">주소복사</button>
                </div>
            </section>
        </div>
        <!-- 오시는길  : e -->


        <!-- floating btn : s -->
        <div class="floating_btn_wrap only_m">
            <a href="javascript:void(0)" class="floating_wish"
                onclick="onLikeStateChange('{{ $result->id }}', 'site_product');btn_wish(this);">관심등록</a>
            <button class="btn_point btn_full_floting">분양문의</button>
        </div>
        <!-- floating btn : e -->



    </div>
    <script>
        var onMetaLink = () => {
            // location.href = '{{ $result->matterport_link }}';
        }

        pannellum.viewer('panorama-360-view', {
            "type": "equirectangular",
            "panorama": "{{ Storage::url('file/' . $result->files[0]->path . '/' . $result->files[0]->path) }}",
            "autoLoad": true
        })

        // 좋아요
        var onLikeStateChange = (id, type) => {

            $.ajax({
                url: '{{ route('www.commons.like') }}',
                type: "post",
                data: {
                    'target_id': id,
                    'target_type': type
                }
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('다시 시도해주세요.');
            });
        }

        // 주소 복사
        var textCopy = () => {
            window.navigator.clipboard.writeText('{{ $result->address }}').then(() => {
                alert("주소가 복사 되었습니다.");
            });
        };

        // 지도
        var map = new naver.maps.Map('map', {
            center: new naver.maps.LatLng('{{ $result->address_lat }}', '{{ $result->address_lng }}'),
            zoom: 15
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

        function onFloorDetailChange() {
            let checkRadioValue = $('select[name=floorListMobile] option:selected').val();
            onFloorDetailListGet(checkRadioValue);
        }

        // 층 상세 정보 가져오기
        function onFloorDetailListGet(id) {
            $.ajax({
                url: '{{ route('www.site.product.floor.detail') }}',
                method: 'get',
                data: {
                    'floor_id': id
                },
                success: function(data, status, xhr) {
                    let arrayFloorType = [];

                    (data.result.is_neighborhood_life) ? arrayFloorType.push('근린지원시설'): '';
                    (data.result.is_industry_center) ? arrayFloorType.push('지식산업센터'): '';
                    (data.result.is_warehouse) ? arrayFloorType.push('공동창고'): '';
                    (data.result.is_dormitory) ? arrayFloorType.push('기숙사,유치원'): '';
                    (data.result.is_business_support) ? arrayFloorType.push('업무지원시설'): '';

                    $('.floor_title').text(data.result.floor_name);
                    document.getElementById("floorDetailImage").src = '{{ Storage::url('image/') }}' + data
                        .result.images.path;

                    $('.floor_info').text(arrayFloorType.join('/'));

                }
            });
        }

        // 각 동별 층 가져오기
        function onFloorListGet(id) {
            $.ajax({
                url: '{{ route('www.site.product.floor.list') }}',
                method: 'get',
                data: {
                    'dong_id': id
                },
                success: function(data, status, xhr) {
                    let divTag = '';
                    let divTagM = '';
                    data.result.forEach(element => {
                        divTag += `
                            <div class="cell">
                                <input type="radio" name="floor" id="floor_${element.id}"
                                    value="${element.id}" onclick="onFloorDetailListGet('${element.id}');">
                                <label for="floor_${element.id}">${element.floor_name}</label>
                            </div>
                        `;

                        divTagM += `
                            <option value="${element.id}">${element.floor_name}</option>
                        `;
                    });

                    $('#floorListPc').html(divTag);
                    $('#floorListMobile').html(divTagM);
                }
            });
        }

        // 평/제곱미터 변환
        function onSizeTextChange(type) {
            if (type == 0) {
                $('#basicArea').text($('#square').val() + '㎡');
                $('#buildingArea').text($('#building_square').val() + '㎡');
                $('#totalFloorArea').text($('#total_floor_square').val() + '㎡');
            } else if (type == 1) {
                $('#basicArea').text($('#area').val() + '평');
                $('#buildingArea').text($('#building_area').val() + '평');
                $('#totalFloorArea').text($('#total_floor_area').val() + '평');
            }
        }

        // 관심 토글버튼
        function btn_wish(element) {
            if ($(element).hasClass("on")) {
                $(element).removeClass("on");
            } else {
                $(element).addClass("on");
            }
        }

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

        //교육자료
        var edu_document = new Swiper(".edu_document", {
            pagination: {
                el: ".swiper-pagination",
                type: "fraction",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

</x-layout>
