<x-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script type="text/javascript"
        src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
    </script>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">마이메뉴</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        @inject('carbon', 'Carbon\Carbon')
        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">제안 받은 매물 목록</h1>

                    <div class="proposal_detail_wrap">
                        <div class="flex_between">
                            <h3>신청 조건</h3>
                            <button class="proposal_toggle_btn"><img
                                    src="{{ asset('assets/media/dropdown_arrow.png') }}" class="w_100"></button>
                        </div>

                        <div class="proposal_table_wrap">
                            <div class="table_container">
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
                                    {{ $proposal->payment_type == 0 ? '매매 ' . Commons::get_priceTrans($proposal->price) : '월세 ' . Commons::get_priceTrans($proposal->price) . ' / ' . Commons::get_priceTrans($proposal->month_price) }}
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
                                <div {{ $proposal->type != 0 ? 'class=item_col_3' : '' }}>
                                    {{ $proposal->content ?? '-' }}</div>
                            </div>
                        </div>


                        <div class="proposal_detail_s2" id="proposal_detail_s2">
                            <div class="proposal_detail_row">
                                <div class="proposal_item_1">
                                    <h4>{{ $proposal->title }}</h4>
                                    <p class="txt_date mt4">
                                        {{ $carbon::parse($proposal->created_at)->format('Y.m.d') }}</p>
                                </div>
                                <!-- <button class="btn_gray_ghost btn_sm" type="button"
                                    onclick="downloadPDF();">공유하기</button> -->
                                <button class="btn_gray_ghost btn_sm btn_share" type="button">공유하기</button>
                                <!-- 공유하기 : s -->
                                <div class="layer layer_share_wrap">
                                    <div class="layer_title">
                                        <h5>공유하기</h5>
                                        <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                            class="md_btn_close btn_share">
                                    </div>
                                    <div class="layer_share_con">
                                        <a class="kakaotalk-sharing-btn">
                                            <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                            <p class="mt8">카카오톡</p>
                                        </a>
                                        <a onclick="textCopy('{!! url()->full() !!}');$('.md_btn_close').click();">
                                            <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                            <p class="mt8">링크복사</p>
                                        </a>
                                    </div>
                                </div>
                                <!-- 공유하기 : e -->
                            </div>


                            <div class="mt18">
                                {{-- <img src="{{ asset('assets/media/s_7.png') }}"
                                    style="width:100%; height:385px; border-radius:8px; border: 1px solid #D2D1D0;"> --}}
                                <div id="map"
                                    style="width:100%;height:385px;border-radius:8px; border: 1px solid #D2D1D0;">
                                </div>
                            </div>
                        </div>

                        <div class="proposal_detail_s3" id="proposal_detail_s3">
                            <div class="flex_between">
                                <div class="result_count">제안된 매물 <span
                                        class="txt_point">{{ count($proposal->products) }}개</span></div>
                                <div class="gray_basic">단위 : 원</div>
                            </div>

                            <table class="table_basic mt12 only_pc">
                                <colgroup>
                                    <col width="80">
                                    <col width="80">
                                    <col width="240">
                                    <col width="*">
                                    <col width="120">
                                    <col width="100">
                                    <col width="100">
                                    <col width="80">
                                    <col width="100">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>번호</th>
                                        <th>사진</th>
                                        <th>거래 정보</th>
                                        <th>주소</th>
                                        <th>면적</th>
                                        <th>층정보</th>
                                        <th>관리비</th>
                                        <th>관심매물</th>
                                        <th>투어</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $lat = 37.5664056;
                                        $lng = 126.9778222;

                                    @endphp
                                    @if (count($proposal->products) > 0)

                                        @foreach ($proposal->products as $key => $product)
                                            @php
                                                if ($key == 0) {
                                                    $lat = $product->product->address_lat;
                                                    $lng = $product->product->address_lng;
                                                }

                                            @endphp
                                            <tr id="{{ $key + 1 }}_product_tr">
                                                <td><span class="number_box">{{ $key + 1 }}</span></td>
                                                <td>
                                                    <div class="frame_img_mid">
                                                        <div class="img_box">
                                                            <img
                                                                src="{{ Storage::url('image/' . $product->product->images[0]->path) }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
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
                                                                    ' / ' .
                                                                    ($month_price > 0
                                                                        ? Commons::get_priceTrans($month_price)
                                                                        : 0);
                                                                if ($exclusive_area > 0) {
                                                                    $priceArea =
                                                                        $month_price /
                                                                        $product->product->exclusive_area;
                                                                }
                                                            }
                                                        } else {
                                                            $monthPrice = '';
                                                            if ($price > 0 && $exclusive_area > 0) {
                                                                $priceArea = $price / $product->product->exclusive_area;
                                                            }
                                                        }
                                                    @endphp
                                                    <span>{{ Lang::get('commons.payment_type.' . $product->product->priceInfo->payment_type) }}
                                                        {{ $price > 0 ? Commons::get_priceTrans($price) : 0 }}
                                                        {{ $monthPrice }}
                                                    </span><br>
                                                    <span class="area">({{ number_format($priceArea) }}/평)</span>
                                                </td>
                                                <td>{{ $product->product->address }} </td>
                                                <td>전용 {{ $product->product->exclusive_square }}㎡</td>
                                                <td>{{ $product->product->floor_number }}층 /
                                                    {{ $product->product->total_floor_number }}층</td>
                                                <td>{{ $product->product->is_service == 0 ? '관리비 ' . number_format($product->product->service_price) . '원' : '-' }}
                                                </td>
                                                <td><button
                                                        class="btn_like {{ $product->product->like_id != '' ? 'on' : '' }}"
                                                        onclick="onLikeStateChange('{{ $product->product->id }}', 'product');btn_like(this)"></button>
                                                </td>
                                                <td><button class="btn_point_ghost btn_sm" type="button"
                                                        onclick="modal_open('tour_{{ $product->product->id }}')">투어
                                                        요청</button></td>
                                            </tr>

                                            <!-- modal 투어 요청 : s -->
                                            <div class="modal modal_tour_{{ $product->product->id }}">

                                                <div class="modal_container">
                                                    <div class="modal_mss_wrap">
                                                        <p class="txt_item_1 txt_point">
                                                            {{ $product->product->address }}</p>
                                                        <p class="txt_item_1">투어를 요청할까요?</p>
                                                        <p class="mt8 txt_item_2">담당자 확인 후, 휴대폰 번호로 연락드려요.</p>
                                                    </div>

                                                    <div class="modal_btn_wrap">
                                                        <button class="btn_gray btn_full_thin" type="button"
                                                            onclick="modal_close('tour_{{ $product->product->id }}')">취소</button>
                                                        <button class="btn_point btn_full_thin" type="button"
                                                            onclick="onTourCreate('{{ $product->product->id }}');">요청</button>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="md_overlay md_overlay_tour_{{ $product->product->id }}"
                                                onclick="modal_close('tour_{{ $product->product->id }}')"></div>
                                            <!-- modal 투어 요청 : e -->

                                            <form method="POST" id="tourForm_{{ $product->product->id }}"
                                                action="{{ route('www.mypage.user.tour.create') }}">
                                                <input type="hidden" id="tour_id" name="tour_id"
                                                    value="{{ $product->product->id }}">
                                            </form>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9">
                                                <!-- 데이터가 없을 경우 : s -->
                                                <div class="empty_wrap">
                                                    <p>조건에 맞는 매물이 없습니다.</p>
                                                    <span>관리자가 조건에 맞는 매물이 있는지 재확인 후에<br>다시 연락드릴테니, 조금만 기다려주세요!</span>
                                                </div>
                                                <!-- 데이터가 없을 경우 : e -->
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if (count($proposal->products) > 0)

                                <!----------------------------- m::list : s ----------------------------->
                                <div class="only_m">
                                    @foreach ($proposal->products as $key => $product)
                                        <div class="m_offer_list_card">
                                            <div class="flex_between">
                                                <div>
                                                    <span class="number_box">{{ $key + 1 }}</span>
                                                    <span class="gray_deep">{{ $product->product->address }}</span>
                                                </div>
                                                <button
                                                    class="btn_like {{ $product->product->like_id != '' ? 'on' : '' }}"
                                                    onclick="onLikeStateChange('{{ $product->product->id }}', 'product');btn_like(this)"></button>
                                            </div>
                                            <div class="flex_between mt10">
                                                <div class="frame_img_mid">
                                                    <div class="img_box"><img
                                                            src="{{ Storage::url('image/' . $product->product->images[0]->path) }}">
                                                    </div>
                                                </div>
                                                <div class="offer_card_info">
                                                    <p class="txt_item_1">
                                                        @php
                                                            $monthPrice = '';
                                                            $priceArea = 0.0;
                                                            $price = $product->product->priceInfo->price ?? 0;
                                                            $month_price =
                                                                $product->product->priceInfo->month_price ?? 0;
                                                            $exclusive_area = $product->product->exclusive_area ?? 0;

                                                            if (
                                                                $product->product->priceInfo->payment_type == 1 ||
                                                                $product->product->priceInfo->payment_type == 2 ||
                                                                $product->product->priceInfo->payment_type == 4
                                                            ) {
                                                                if ($month_price > 0) {
                                                                    $monthPrice =
                                                                        ' / ' .
                                                                        ($month_price > 0
                                                                            ? Commons::get_priceTrans($month_price)
                                                                            : 0);
                                                                    if ($exclusive_area > 0) {
                                                                        $priceArea =
                                                                            $month_price /
                                                                            $product->product->exclusive_area;
                                                                    }
                                                                }
                                                            } else {
                                                                $monthPrice = '';
                                                                if ($price > 0 && $exclusive_area > 0) {
                                                                    $priceArea =
                                                                        $price / $product->product->exclusive_area;
                                                                }
                                                            }
                                                        @endphp
                                                        {{ Lang::get('commons.payment_type.' . $product->product->priceInfo->payment_type) }}
                                                        {{ $price > 0 ? Commons::get_priceTrans($price) : 0 }}
                                                        {{ $monthPrice }}
                                                        <span>({{ number_format($priceArea) }}/평)</span>
                                                    </p>
                                                    <p class="txt_item_2">전용
                                                        {{ $product->product->exclusive_area }}평·{{ $product->product->floor_number }}층
                                                        /
                                                        {{ $product->product->total_floor_number }}층</p>
                                                    <p class="txt_item_3">
                                                        관리비
                                                        {{ $product->product->is_service == 0 ? number_format($product->product->service_price) . '원' : '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="btn_half_wrap">
                                                <button class="btn_gray_ghost btn_md_full"
                                                    onclick="location.href='{{ route('www.map.room.detail', [$product->product->id]) }}'">상세보기</button>
                                                <button class="btn_point_ghost btn_md_full txt_bold" type="button"
                                                    onclick="modal_open('tour_{{ $product->product->id }}')">투어
                                                    요청</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!----------------------------- m::list : e ----------------------------->
                            @endif
                        </div>

                    </div>


                </div>
                <!-- my_body : e -->
            </div>



        </div>

    </div>

    <script>
        // 주소 복사
        var textCopy = (url) => {
            window.navigator.clipboard.writeText(url).then(() => {
                alert("링크가 복사 되었습니다.");
            });
        };

        //공유하기 레이어
        $(".btn_share").click(function() {
            $(".layer_share_wrap").stop().slideToggle(0);
            return false;
        });


        @php
            // content 변수에서 HTML 태그 제거
            $cleaned_content = strip_tags(html_entity_decode($proposal->content));

            // content 변수에서 줄바꿈 처리
            $cleaned_content = preg_replace("/\r|\n/", ' ', $cleaned_content);

            // 길이 제한 및 줄임표 추가
            $shortened_content = mb_strlen($cleaned_content) > 50 ? mb_substr($cleaned_content, 0, 50) . '...' : $cleaned_content;
        @endphp

        document.querySelectorAll('.kakaotalk-sharing-btn').forEach(function(button) {
            Kakao.Share.createDefaultButton({
                container: button,
                objectType: "feed",
                content: {
                    title: '{{ $proposal->title }}',
                    description: '{{ $shortened_content }}',
                    imageUrl: "",
                    link: {
                        mobileWebUrl: `{{ env('APP_URL') }}/share/proposal/detail?id={{ $proposal->id }}`,
                        webUrl: `{{ env('APP_URL') }}/share/proposal/detail?id={{ $proposal->id }}`,
                    },
                }
            });
        });

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

        function onTourCreate(id) {
            $('#tourForm_' + id).submit();
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

        function downloadPDF() {
            const element = document.getElementById('proposal_detail_s3');
            html2canvas(element).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF();
                const imgProps = pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save("매물 제안서.pdf");
            });
        }
    </script>


</x-layout>
