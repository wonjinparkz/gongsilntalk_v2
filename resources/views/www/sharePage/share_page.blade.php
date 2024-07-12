<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicon.png') }}">

    <!--메타 : 메타 태그만 사용-->
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!--내부 기본 CSS : 내부에서 생성한 CSS만 사용-->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user_style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style_responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/external.css') }}">

    <!--외부 CSS : 외부 모듈에서 제공된 CSS만 사용-->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--내부 기본 JS : 내부에서 생성한 JS 경우만 사용 하며. 이를 사용하기 위한 라이브러만사용(jquery.js) -->
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}"></script>

    <!--외부 JS : 외부 모듈에서 제공된 JS만 사용-->
    <script src="{{ asset('assets/js/swiper.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/proj4.js') }}"></script>
    <script src="{{ asset('assets/external_js/html2canvas.js') }}"></script>

    <script src="{{ asset('assets/js/scroll_page.js') }}"></script>

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>

    {{-- 지도 관련 api --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script type="text/javascript"
        src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
    </script>
</head>

@php
    function priceChange($price)
    {
        if ($price < 0 || empty($price)) {
            $price = 0;
        }

        $priceUnit = ['원', '만', '억', '조', '경'];
        $expUnit = 10000;
        $resultArray = [];
        $result = '';

        foreach ($priceUnit as $k => $v) {
            $unitResult = ($price % pow($expUnit, $k + 1)) / pow($expUnit, $k);
            $unitResult = floor($unitResult);

            if ($unitResult > 0) {
                $resultArray[$k] = $unitResult;
            }
        }

        if (count($resultArray) > 0) {
            foreach ($resultArray as $k => $v) {
                $result = number_format($v) . $priceUnit[$k] . $result;
            }
        }

        return $result;
    }
@endphp
@inject('carbon', 'Carbon\Carbon')

<body style="margin: 0;">

    <div class="share_body">
        <div class="share_tit">
            공실앤톡
        </div>

        <div class="share_section">
            <div class="section_tit_wrap">
                <h5>신청 조건</h5>
                <button class="simple_toggle_trigger"><img
                        src="{{ asset('assets/media/dropdown_arrow.png') }}"></button>
            </div>
            <div class="simple_toggle_layer">
                <div class="table_container columns_2 share_table">
                    <div>희망 지역</div>
                    <div>
                        @foreach ($proposal->regions as $key => $region)
                            @if ($key != 0)
                                ,
                            @endif
                            {{ $region->city_name }} {{ $region->region_name }}
                        @endforeach
                    </div>

                    @if ($proposal->type == 0)
                        <div>희망 업종</div>
                        <div>
                            {{ Lang::get('commons.product_business_type.' . $proposal->business_type) }}
                        </div>
                    @else
                        <div>사용인원</div>
                        <div>{{ number_format($proposal->users_count) }}명</div>
                    @endif
                    <div>희망 면적</div>
                    <div>{{ $proposal->square }}㎡<span class="gray_basic">({{ $proposal->area }}평)</span>
                    </div>
                    <div>예산</div>
                    <div>
                        {{ $proposal->payment_type == 0 ? '매매 ' . priceChange($proposal->price) . '원' : '임대 ' . priceChange($proposal->price) . '원 / ' . priceChange($proposal->month_price) . '원' }}
                    </div>
                    @if ($proposal->type == 0)
                        <div>희망 상가 층</div>
                        <div>{{ Lang::get('commons.floor_type.' . $proposal->floor_type) }}</div>
                    @endif
                    <div>입주가능일</div>
                    <div>
                        {{ $proposal->move_type != 2 ? Lang::get('commons.move_type.' . $proposal->move_type) : $carbon::parse($proposal->start_move_date)->format('Y.m.d') . ' ~ ' . $carbon::parse($proposal->ended_move_date)->format('Y.m.d') }}
                    </div>
                    <div>인테리어 유무</div>
                    <div>{{ Lang::get('commons.interior_type.' . $proposal->interior_type) }}</div>
                    <div>요청사항</div>
                    <div>{{ $proposal->content ?? '-' }}</div>
                </div>
            </div>

        </div>

        <div class="share_section">
            <h5>{{ $proposal->title }}</h5>
            <div class="txt_date mt4">{{ $carbon::parse($proposal->created_at)->format('Y.m.d') }}</div>

            <div class="share_map_wrap">
                <div id="map" style="width:100%;height:200px;border-radius:8px; border: 1px solid #D2D1D0;">
                </div>
            </div>
        </div>

        <div class="share_section">
            <div class="proposal_detail_s3">
                <div class="flex_between">
                    <div class="result_count">제안된 매물 <span class="txt_point">{{ count($proposal->products) }}개</span>
                    </div>
                    <div class="gray_basic">단위 : 원</div>
                </div>

                <div class="">
                    @if (count($proposal->products) < 1)
                        @php
                            $lat = 37.5664056;
                            $lng = 126.9778222;

                        @endphp
                    @else
                        @foreach ($proposal->products as $key => $product)
                            @php
                                if ($key == 0) {
                                    $lat = $product->product->address_lat;
                                    $lng = $product->product->address_lng;
                                }

                            @endphp
                            <div class="share_offer_list_card">
                                <div class="flex_between">
                                    <div>
                                        <span class="number_box">{{ $key + 1 }}</span>
                                        <span class="gray_deep">{{ $product->product->address }}</span>
                                    </div>
                                </div>
                                <div class="flex_between mt10">
                                    <div class="frame_img_mid">
                                        <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                                    </div>
                                    <div class="share_offer_card_info">
                                        <p class="txt_item_1">
                                            @php
                                                $monthPrice = '';
                                                $priceArea = 0.0;
                                                $price = $product->product->priceInfo->price ?? 0;
                                                $month_price = $product->product->priceInfo->month_price ?? 0;
                                                $exclusive_area = $product->product->exclusive_area ?? 0;

                                                if (
                                                    $product->product->priceInfo->payment_type == 1 ||
                                                    $product->product->priceInfo->payment_type == 2 ||
                                                    $product->product->priceInfo->payment_type == 4
                                                ) {
                                                    if ($month_price > 0) {
                                                        $monthPrice =
                                                            ' / ' . ($month_price > 0 ? priceChange($month_price) : 0);
                                                        if ($exclusive_area > 0) {
                                                            $priceArea =
                                                                $month_price / $product->product->exclusive_area;
                                                        }
                                                    }
                                                } else {
                                                    $monthPrice = '';
                                                    if ($price > 0 && $exclusive_area > 0) {
                                                        $priceArea = $price / $product->product->exclusive_area;
                                                    }
                                                }
                                            @endphp
                                            {{ Lang::get('commons.payment_type.' . $product->product->priceInfo->payment_type) }}
                                            {{ $price > 0 ? priceChange($price) : 0 }}
                                            {{ $monthPrice }}
                                            <span>({{ priceChange($priceArea) }}/평)</span>
                                        </p>
                                        <p class="txt_item_2">전용
                                            {{ $product->product->exclusive_area }}평·{{ $product->product->floor_number }}층
                                            /
                                            {{ $product->product->total_floor_number }}층</p>
                                        <p class="txt_item_3">
                                            {{ $product->product->is_service == 0 ? '관리비 ' . number_format($product->product->service_price) . '원' : '-' }}
                                        </p>
                                    </div>
                                </div>
                                <!-- <div class="btn_half_wrap">
                            <button class="btn_gray_ghost btn_md_full">상세보기</button>
                            <button class="btn_point_ghost btn_md_full txt_bold">투어 요청</button>
                        </div> -->
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </div>



        <div class="share_btn_floting">
            <button class="btn_point btn_full_basic" onclick="location.href='{{ env('APP_URL') }}'">공실앤톡 사이트
                방문하기</button>
        </div>

        <div class="my_inner_wrap">
            <div class="my_wrap">



            </div>




        </div>

    </div>
</body>

<script>
    function btn_pw_change() {
        var btn_pw = document.getElementById("btn_pw");
        var input_pw = document.getElementById("input_pw");

        if (btn_pw.style.display === "none") {
            btn_pw.style.display = "inline-block";
            input_pw.style.display = "none";
        } else {
            btn_pw.style.display = "none";
            input_pw.style.display = "inline-block";
        }
    }

    let markerList = {};

    var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng('{{ $lat }}', '{{ $lng }}'),
        zoom: 15
    });

    @foreach ($proposal->products as $key => $product)
        markerList[`marker${'{{ $key + 1 }}'}`] = new naver.maps.Marker({
            position: new naver.maps.LatLng('{{ $product->product->address_lat }}',
                '{{ $product->product->address_lng }}'),
            map: map,

            icon: {
                content: `<div class="marker_default detail_info_toggle"><span>{{ $key + 1 }}</span></div>`,
                size: new naver.maps.Size(100, 100), //아이콘 크기
                scaledSize: new naver.maps.Size(30, 43), //아이콘 크기
                origin: new naver.maps.Point(0, 0),
                anchor: new naver.maps.Point(11, 35)
            }
        });

        naver.maps.Event.addListener(markerList[`marker${'{{ $key + 1 }}'}`], "click", () => {
            onMarkerClick('{{ $key + 1 }}');
        });
    @endforeach

    function onMarkerClick(index) {
        document.getElementById(index + "_product_tr").scrollIntoView(true);
    }
</script>
