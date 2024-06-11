@props([
    'result' => [],
])

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
            <img src="{{ asset('assets/media/map_sample_sm.png') }}" class="size_100p">
        </div>
        <p class="txt_address">{{ $result->address }}</p>
        <p class="txt_sub_1">{{ $result->subway_name }} <span>{{ $result->subway_time }}</span></p>
        <p class="txt_sub_1"><span>{{ $result->comments }}</span></p>
    </div>

    <!-- tab : s -->
    <div class="tab_type_2 type_side">
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
            <div class="swiper-button-next"></div>
            <!-- <div class="swiper-button-prev"></div> -->
        </div>
    </div>
    <!-- tab : e -->

    <div class="side_tab_wrap">
        <div class="sction_item active">
            <!-- 거래내역 : s -->
            <div class="side_section">
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
                                    <td><span style="color: var(--main-color)">{{ $result->sale_mid_price }}만원</span>
                                    </td>
                                    <td>{{ $result->sale_max_price }}만원</td>
                                </tr>
                                <tr>
                                    <td>임대</td>
                                    <td>{{ $result->lease_min_price }}만원</td>
                                    <td><span style="color: var(--main-color)">{{ $result->lease_mid_price }}만원</td>
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
            <div class="side_section">
                <h4>조감도</h4>
                <div class="side_info_wrap mt20">
                    @foreach ($result->birdSEyeView_files as $file)
                        <img src="{{ Storage::url('file/' . $file->path . '/' . $file->path) }}" class="size_100p">
                    @endforeach
                </div>
            </div>
            <!-- 조감도 : e -->
        </div>

        <div class="sction_item">
            <!-- 건물·토지정보 : s -->
            <div class="side_section">
                <h4>건물·토지정보</h4>
            </div>

            <div class="open_con_wrap building_item_1">
                <div class="open_trigger">동별정보 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
                </div>
                <div class="con_panel">
                    <div class="default_box showstep1">
                        <table class="table_type_1">
                            <colgroup>
                                <col width="40">
                                <col width="*">
                                <col width="55">
                                <col width="50">
                                <col width="90">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="txt_sm">선택</th>
                                    <th class="txt_sm">대장종류</th>
                                    <th class="txt_sm">동</th>
                                    <th class="txt_sm">주용도</th>
                                    <th class="txt_sm">면적</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="txt_sm">
                                        <input type="radio" name="select" id="select_1" checked>
                                        <label for="select_1"><span></span></label>
                                    </td>
                                    <td class="txt_sm">총괄표제부(집합)</td>
                                    <td class="txt_sm">-</td>
                                    <td class="txt_sm">-</td>
                                    <td class="txt_sm">1582.26㎡</td>
                                </tr>
                                <tr>
                                    <td class="txt_sm">
                                        <input type="radio" name="select" id="select_1">
                                        <label for="select_1"><span></span></label>
                                    </td>
                                    <td class="txt_sm">일반건축물(일반)</td>
                                    <td class="txt_sm">관리사무소</td>
                                    <td class="txt_sm">공동주택</td>
                                    <td class="txt_sm">582.6㎡</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="btn_more_open">더보기</div>
                </div>

            </div>

            <div class="building_item_0">
                <div class="default_box showstep1">
                    <div class="table_container2_sm mt10">
                        <div class="td">규모</div>
                        <div class="td">{{ $result->min_floor }}층 / {{ $result->max_floor }}층</div>
                        <div class="td">준공일</div>
                        <div class="td">{{ $result->completion_date }}</div>
                        <div class="td">대지면적</div>
                        <div class="td">{{ $result->square }}㎡</div>
                        <div class="td">건축면적</div>
                        <div class="td">{{ $result->building_square }}㎡</div>
                        <div class="td">연면적</div>
                        <div class="td">{{ $result->total_floor_square }}㎡</div>
                        <div class="td">총 주차대수</div>
                        <div class="td">총 {{ $result->parking_count }}대</div>
                        <div class="td">시공가</div>
                        <div class="td"> {{ $result->developer ?? '-' }}</div>
                        <div class="td">시행사</div>
                        <div class="td"> {{ $result->parking_count ?? '-' }}</div>
                    </div>
                </div>
                <div class="btn_more_open">더보기</div>
            </div>


            <div class="open_con_wrap building_item_2">
                <div class="open_trigger">층별 정보 <span><img
                            src="{{ asset('assets/media/dropdown_arrow.png') }}"></span></div>
                <div class="con_panel">
                    <div class="default_box showstep1">
                        <table class="table_type_1">
                            <colgroup>
                                <col width="60">
                                <col width="*">
                                <col width="100">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>층수</th>
                                    <th>용도</th>
                                    <th>면적</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>B3층</td>
                                    <td>아파트</td>
                                    <td>1122.44㎡</td>
                                </tr>
                                <tr>
                                    <td>B3층</td>
                                    <td>아파트</td>
                                    <td>1122.44㎡</td>
                                </tr>
                                <tr>
                                    <td>B3층</td>
                                    <td>아파트</td>
                                    <td>1122.44㎡</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="btn_more_open">더보기</div>
                </div>
            </div>

            <div class="open_con_wrap building_item_3">
                <div class="open_trigger">전유부 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
                </div>
                <div class="con_panel">
                    <div class="dropdown_box s_sm w_40">
                        <button class="dropdown_label">103동 - 102</button>
                        <ul class="optionList">
                            <li class="optionItem">103동 - 102</li>
                        </ul>
                    </div>

                    <div class="default_box showstep1 mt10">
                        <table class="table_type_1">
                            <colgroup>
                                <col width="50">
                                <col width="50">
                                <col width="60">
                                <col width="*">
                                <col width="100">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>구분</th>
                                    <th>층별</th>
                                    <th>건축물</th>
                                    <th>용도</th>
                                    <th>면적</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>전유</td>
                                    <td>B1층</td>
                                    <td>주</td>
                                    <td>복도, 화장실</td>
                                    <td>1122.44㎡</td>
                                </tr>
                                <tr>
                                    <td>공용</td>
                                    <td>각층</td>
                                    <td>부속</td>
                                    <td>전기실, 기계실</td>
                                    <td>1122.44㎡</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="open_con_wrap building_item_4">
                <div class="open_trigger">토지정보 <span><img
                            src="{{ asset('assets/media/dropdown_arrow.png') }}"></span></div>
                <div class="con_panel">
                    <div class="default_box showstep1">
                        <div class="table_container2_sm mt10">
                            <div class="td">면적</div>
                            <div class="td">569.44㎡</div>
                            <div class="td">지목</div>
                            <div class="td">대</div>
                            <div class="td">용도지역</div>
                            <div class="td">제1종일반주거지역</div>
                            <div class="td">이용상황</div>
                            <div class="td">아파트</div>
                            <div class="td">형상</div>
                            <div class="td">사다리형</div>
                            <div class="td">지형높이</div>
                            <div class="td">급경사</div>
                            <div class="td">동 개별 공시지가(원/m²)</div>
                            <div class="td">415000</div>
                            <div class="td">지역지구등
                                <hr>지정여부
                            </div>
                            <div class="td">
                                과밀억제권역,정비구역(도렴도시환경정비사업),가축사육제한구역,대공방어협조구역(위탁고도:54-236m),도시지역,일반상업지역,4대문안</div>
                        </div>
                    </div>
                    <div class="btn_more_open">더보기</div>
                </div>
                <!-- 건물·토지정보 : e -->
            </div>
        </div>

        <div class="sction_item">
            <!-- 현장설명 : s -->
            <div class="side_section">
                <h4>현장설명</h4>
            </div>
            <div>
                <div class="edu_wrap building_item_2">
                    {{ nl2br($result->site_contents) }}
                </div>
                <!-- 현장설명 : e -->
            </div>

            <hr class="space exp mt20">

            <!-- 교통정보 : s -->
            <div class="side_section">
                <h4>교통정보</h4>
            </div>
            <div>
                <div class="edu_wrap building_item_2">
                    {{ nl2br($result->traffic_info) }}
                </div>
            </div>
            <!-- 교통정보 : e -->
        </div>

        <div class="sction_item">
            <!-- 특장점 : s -->
            <div class="side_section">
                <h4>특장점</h4>
            </div>
            <div>
                <div class="edu_wrap building_item_2">
                    관공서(양천세무서) 병원(다민한의원, 신천호한의원) 백화점(목동현대백화점) 공원(양천공원) 기타(안양천)
                </div>
            </div>
            <!-- 특장점 : e -->

        </div>

        <div class="sction_item">
            <!-- 층별도면 : s -->
            <div class="side_section">
                <h4>층별도면</h4>
            </div>
            <div>
                <div class="edu_wrap building_item_2">
                    관공서(양천세무서) 병원(다민한의원, 신천호한의원) 백화점(목동현대백화점) 공원(양천공원) 기타(안양천)
                </div>
                <!-- 층별도면 : e -->
            </div>
        </div>

        <div class="sction_item">
            <!-- 위치정보 : s -->
            <div class="side_section">
                <h4>위치 및 주변정보</h4>
                <div class="container_map_wrap mt18"><img src="{{ asset('assets/media/s_map.png') }}"
                        class="w_100">
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
                            <p class="traffic_row">{{ $result->subway_name }} {{ $result->subway_distance }}
                                <span>{{ $result->subway_time }}</span>
                            </p>

                            <div class="traffic_tit mt28"><img src="{{ asset('assets/media/ic_bus.png') }}">버스
                            </div>
                            <p class="traffic_row">정류장 <span>{{ $result->kaptdWtimebus }}</span></p>

                        </div>
                        <div>
                            <div class="facility_wrap">
                                {{ nl2br($result->convenientFacility) }}
                            </div>
                        </div>
                        <div>
                            <div class="edu_wrap">
                                {{ nl2br($result->educationFacility) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 위치정보 : s -->
        </div>

    </div>
</div>
