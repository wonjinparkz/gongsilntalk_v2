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
<div class="side_fixed">


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
                        <div class="swiper-slide active"><a href="javascript:(0)" onclick="showContent(0)">거래내역</a>
                        </div>
                        <div class="swiper-slide"><a href="javascript:(0)" onclick="showContent(1)">건물·토지정보</a></div>
                        <div class="swiper-slide"><a href="javascript:(0)" onclick="showContent(2)">위치 및 주변정보</a></div>
                        <div class="swiper-slide"><a href="javascript:(0)" onclick="showContent(3)">매물정보</a></div>
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
                                        <td>{{ $result->sale_mid_price }}만원</td>
                                        <td>{{ $result->sale_max_price }}만원</td>
                                    </tr>
                                    <tr>
                                        <td>임대</td>
                                        <td>{{ $result->lease_min_price }}만원</td>
                                        <td>{{ $result->lease_mid_price }}만원</td>
                                        <td>{{ $result->lease_max_price }}만원</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr class="space exp mt20">

                    <h4 class="mt20">조감도</h4>

                    <div class="side_info_wrap mt20">
                        <div>
                            @foreach ($result->birdSEyeView_files as $file)
                                <img src="{{ Storage::url('file/' . $file->path . '/' . $file->path) }}"
                                    class="size_100p">
                            @endforeach
                        </div>
                    </div>
                    <hr class="space exp mt20">

                    <h4 class="mt20">건물정보</h4>

                    <div class="side_info_wrap mt20">
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
                                <div class="td">총{{ $result->parking_count }}대</div>
                                <div class="td">시공사</div>
                                <div class="td">{{ $result->comstruction_company ?? '-' }}</div>
                                <div class="td">시행사</div>
                                <div class="td">{{ $result->developer ?? '-' }}</div>
                            </div>
                        </div>
                        <div class="btn_more_open">더보기</div>
                    </div>

                </div>

            </div>


        </div>
    </div>

</div>
