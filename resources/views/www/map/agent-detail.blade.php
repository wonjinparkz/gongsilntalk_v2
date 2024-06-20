<x-layout>
    <!-- m::header bar : s -->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">{{ $result->company_name ?? '-' }}</div>
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
                <a id="kakaotalk-sharing-btn" href="javascript:;">
                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                    <p class="mt8">카카오톡</p>
                </a>
                <a href="javascript:void(0);" onclick="urlCopy();">
                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
                    <p class="mt8">링크복사</p>
                </a>
            </div>
        </div>
    </div>
    <div class="md_slide_overlay md_slide_overlay_share" onclick="modal_close_slide('share')"></div>
    <!-- m::header bar : s -->
    @php
        $address = $result->company_address ?? null;
        $addressDetail = $result->company_address_detail ?? null;
    @endphp

    <div class="body">
        <div class="agent_head">
            <div class="agent_img">
                <div class="img_box"><img src="{{ asset('assets/media/default_img.png') }}"></div>
            </div>
            <div class="agent_detail_info">
                <h3>{{ $result->company_name ?? '-' }}</h3>
                <div class="info_row"><span>대표</span>{{ $result->company_ceo ?? '-' }}</div>
                <div class="info_row"><span>주소</span>{{ $address ? $address . ' ' . $addressDetail : '-' }} </div>
                <div class="info_row"><span>대표번호</span>{{ $result->company_phone ?? '-' }}</div>
                <div class="info_row"><span>휴대전화</span>{{ $result->phone ?? '-' }}</div>
            </div>
        </div>


        <div class="inner_wrap bottom_space">
            <!-- PC::filter : s -->
            <div class="mt28 only_pc">
                <div class="dropdown_box w_10">
                    <button class="dropdown_label">거래유형 </button>
                    <ul class="optionList">
                        <li class="optionItem">전체</li>
                        @for ($i = 0; $i < count(Lang::get('commons.payment_type')); $i++)
                            @if ($i == 3 || $i == 4)
                                @continue
                            @endif
                            <li class="optionItem">{{ Lang::get('commons.payment_type.' . $i) }}</li>
                        @endfor
                    </ul>
                </div>
            </div>
            <!-- PC::filter : e -->

            <!-- M::filter : s -->
            <div class="m_sales_filter_wrap agent_filter_wrap">
                <div class="m_dropdown_double_wrap">
                    <button class="btn_dropdown" onclick="modal_open_slide('transaction_type')">거래유형</button>
                </div>
            </div>
            <div class="modal_slide modal_slide_transaction_type">
                <div class="slide_title_wrap">
                    <span>거래유형 선택</span>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}"
                        onclick="modal_close_slide('transaction_type')">
                </div>
                <ul class="slide_modal_menu">
                    <li><a href="#">전체</a></li>
                    <li><a href="#">매매</a></li>
                    <li><a href="#">임대</a></li>
                    <li><a href="#">단기임대</a></li>
                    <li><a href="#">전매</a></li>
                </ul>
            </div>
            <div class="md_slide_overlay md_slide_overlay_transaction_type"
                onclick="modal_close_slide('transaction_type')"></div>
            <!-- M::filter : e -->

            <div class="flex_between agent_sort_wrap">
                <div class="txt_search_total">분양목록 총 <span class="txt_point">44건</span></div>
                <ul class="list_sort2 normal_type toggle_tab">
                    <li class="active"><a href="#">최신순</a></li>
                    <li><a href="#">높은가격순</a></li>
                    <li><a href="#">면적순</a></li>
                </ul>
            </div>


            <div class="sales_list_wrap">
                <!-- card : s -->
                @foreach ($productList as $item)
                    {{-- {{ $item }} --}}
                    <div class="sales_card">
                        <span class="sales_list_wish" onclick="btn_wish(this)"></span>
                        <a href="{{ route('www.map.room.detail', [$item->id]) }}">
                            <div class="sales_card_img">
                                <div class="img_box">
                                    @if (count($item->images) > 0)
                                        <img src="{{ Storage::url('image/' . $item->images[0]->path) }}"
                                            onerror="this.src='{{ asset('assets/media/s_1.png') }}';" loading="lazy">
                                    @else
                                        <img src="{{ asset('assets/media/s_1.png') }}">
                                    @endif
                                </div>
                            </div>
                            <div class="sales_list_con">
                                <p class="txt_item_1">
                                    {{ Lang::get('commons.payment_type.' . $item->priceInfo->payment_type) }}
                                    {{ Commons::get_priceTrans($item->priceInfo->price) }}
                                    {{-- 월세/단기임대 --}}
                                    @if (in_array($item->priceInfo->payment_type, [2, 4]))
                                        / {{ Commons::get_priceTrans($item->priceInfo->month_price) }}
                                    @endif
                                </p>
                                <p class="txt_item_4">{{ $item->region_address }}</p>
                                <p class="txt_item_2">{{ $item->square ?? '-' }}㎡ /
                                    {{ $item->exclusive_square ?? '-' }}㎡·{{ $item->floor_number ?? '-' }}층
                                </p>
                                <p class="txt_item_3">{{ $item->contents ?? '' }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{ $productList->onEachSide(1)->links('components.pc-pagination') }}
        </div>
    </div>


    <script src="https://t1.kakaocdn.net/kakao_js_sdk/2.7.2/kakao.min.js"
        integrity="sha384-TiCUE00h649CAMonG018J2ujOgDKW/kVWlChEuu4jK2vxfAAD0eZxzCKakxg55G4" crossorigin="anonymous">
    </script>
    <script>
        Kakao.init('053a66b906cb1cf1d805d47831668657'); // 사용하려는 앱의 JavaScript 키 입력
    </script>

    <script>
        // 관심매물 토글버튼
        function btn_wish(element) {
            if ($(element).hasClass("on")) {
                $(element).removeClass("on");
            } else {
                $(element).addClass("on");
            }
        }
    </script>

    <script>
        var title = '공실앤톡';
        var imageUrl = "{{ asset('assets/media/default_gs.png') }}";
        var url = "http://localhost"
        var detailUrl = "{{ route('www.map.agent.detail', [$result->id]) }}"
        Kakao.Share.createDefaultButton({
            container: '#kakaotalk-sharing-btn',
            objectType: 'feed',
            content: {
                title: title,
                imageUrl: imageUrl,
                link: {
                    // [내 애플리케이션] > [플랫폼] 에서 등록한 사이트 도메인과 일치해야 함
                    mobileWebUrl: url,
                    webUrl: url,
                },
            },
            // social: {
            //     likeCount: 286,
            //     commentCount: 45,
            //     sharedCount: 845,
            // },
            buttons: [{
                    title: '웹으로 보기',
                    link: {
                        mobileWebUrl: detailUrl,
                        webUrl: detailUrl,
                    },
                },
                // {
                //     title: '앱으로 보기',
                //     link: {
                //         mobileWebUrl: detailUrl,
                //         webUrl: detailUrl,
                //     },
                // },
            ],
        });

        function urlCopy() {
            navigator.clipboard.writeText(detailUrl).then(res => {
                alert("링크복사 되었습니다.");
            })
        }
    </script>
</x-layout>
