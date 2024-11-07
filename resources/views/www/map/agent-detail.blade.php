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
                <div class="img_box">
                    @if ($result->image != null)
                        <img src="{{ Storage::url('image/' . $result->image->path) }}">
                    @else
                        <img src="{{ asset('assets/media/default_img.png') }}">
                    @endif
                </div>
            </div>
            <div class="agent_detail_info">
                <h3>{{ $result->company_name ?? '-' }}</h3>
                <div class="info_row"><span>대표</span>{{ $result->company_ceo ?? '-' }}</div>
                <div class="info_row"><span>주소</span>{{ $address ? $address . ' ' . $addressDetail : '-' }} </div>
                <div class="info_row"><span>대표번호</span>{{ $result->company_phone ?? '-' }}</div>
                <div class="info_row"><span>휴대전화</span>{{ $result->phone ?? '-' }}</div>
            </div>
        </div>

        <div class="room_bottom_wrap">
            <button class="btn_point btn_full_floting" onclick="modal_open('agent_qa')">문의하기</button>
        </div>

        <!-- modal 문의하기 : s-->
        <div class="modal modal_mid modal_agent_qa">
            <div class="modal_title">
                <h5>문의하기</h5>
                <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                    onclick="modal_close('agent_qa')">
            </div>
            <div class="modal_container">
                <div class="agent_popup_info">
                    <div class="agent_box_info">
                        <div class="agent_box_img">
                            <div class="img_box">
                                @if (count($result->images) > 0)
                                    <img src="{{ Storage::url('image/' . $result->images[0]->path) }}"
                                        onerror="this.src='{{ asset('assets/media/default_img.png') }}';"
                                        loading="lazy">
                                @else
                                    <img src="{{ asset('assets/media/default_img.png') }}">
                                @endif
                            </div>
                        </div>
                        <h4>{{ $result->company_name ?? '-' }}
                        </h4>
                        <p class="gray_deep">대표중개사 {{ $result->company_ceo ?? '-' }}</p>
                    </div>
                    <div class="agent_popup_detail">
                        <p><span>주소</span>
                            {{ implode(', ', array_filter([$result->company_address ?? '', $result->company_address_detail ?? ''])) }}
                        </p>
                        <p><span>중개등록번호</span> {{ $result->brokerage_number ?? '-' }}</p>
                        <p><span>대표번호</span> {{ $result->company_phone ?? '-' }}</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="agent_contact_wrap">
                <a href="tel:{{ $result->phone }}">
                    <div class="agent_popup_call"><img src="{{ asset('assets/media/ic_point_call.png') }}">
                        {{ $result->phone }}
                    </div>
                </a>
                <div class="agent_popup_num">매물번호 {{ $result->product_number }}</div>
                <div class="agent_popup_noti">중개사무소에 연락하여 문의해보세요.<br>공실앤톡에서 보고 문의드린다 말씀하시면,<br>빠른 예약이 가능합니다.</div>
            </div>

        </div>
        <div class="md_overlay md_overlay_agent_qa" onclick="modal_close('agent_qa')"></div>
        <!-- modal 문의하기 : e-->


        <div class="inner_wrap bottom_space">
            <!-- PC::filter : s -->
            <div class="my_search_wrap optionSelectBox">
                <div class="mt28 sort_wrap">
                    <div class="dropdown_box">
                        <button class="dropdown_label" data-initial-title="거래유형">거래유형</button>
                        <ul class="optionList">
                            <li class="optionItem" onclick="typeChange('')">전체</li>
                            @for ($i = 0; $i < count(Lang::get('commons.payment_type')); $i++)
                                @if ($i == 3 || $i == 4)
                                    @continue
                                @endif
                                <li class="optionItem" onclick="typeChange({{ $i }})">
                                    {{ Lang::get('commons.payment_type.' . $i) }}</li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
            <!-- PC::filter : e -->


            <div class="flex_between agent_sort_wrap">
                <div class="txt_search_total">분양목록 총 <span class="txt_point">0건</span></div>
                <ul class="list_sort2 normal_type toggle_tab">
                    <li class="active new_desc"><a href="javascript:;">최신순</a></li>
                    <li class="price"><a href="javascript:;">높은가격순</a></li>
                    <li class="area"><a href="javascript:;">면적순</a></li>
                </ul>
            </div>

            <div class="productListDiv"></div>
            {{-- <x-corp-product-list :productList="$productList" /> --}}
        </div>
    </div>

    <input type="hidden" id="orderby" name="orderby" value="">
    <input type="hidden" id="paymentType" name="paymentType" value="">
    <input type="hidden" id="id" name="id" value="{{ $result->id }}">
    <script>
        // 거래 유형
        function typeChange(type) {
            $('#paymentType').val(type);
            loadMoreData(1);
        }



        //정렬
        // 최신순
        const new_desc = document.querySelector(".new_desc");
        new_desc.addEventListener("click", function() {
            $('#orderby').val('new_desc');
            loadMoreData(1);
        });

        // 가격순
        const price = document.querySelector(".price");
        price.addEventListener("click", function() {
            $('#orderby').val('price');
            loadMoreData(1);
        });

        // 면적순
        const area = document.querySelector(".area");
        area.addEventListener("click", function() {
            $('#orderby').val('area');
            loadMoreData(1);
        });

        var page = 1;
        loadMoreData(page);

        // 페이징
        function loadMoreData(page) {
            $.ajax({
                    url: '{{ Request::url() }}',
                    data: {
                        page: page,
                        id: $('#id').val(),
                        payment_type: $('#paymentType').val(),
                        orderby: $('#orderby').val()
                    },
                    type: "get",
                    beforeSend: function() {
                        // $('.ajax-load').show();
                    }
                })
                .done(function(data) {
                    $(".productListDiv").html(data.html);
                    var countElement = $('.txt_point').text(data.count + '건');
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {});
        }

        // 좋아요 토글버튼
        function btn_wish(element) {
            var id = element.getAttribute('value');

            var login_check =
                @if (Auth::guard('web')->check())
                    false
                @else
                    true
                @endif ;

            if (login_check) {
                dialog('로그인이 필요합니다.\n로그인 하시겠어요?', '로그인', '아니요', login);
                return;
            } else {
                var formData = {
                    'target_id': id,
                    'target_type': 'product',
                };

                if ($(element).hasClass("on")) {
                    $(element).removeClass("on");
                } else {
                    $(element).addClass("on");
                }

                $.ajax({
                    type: "post", //전송타입
                    url: "{{ route('www.commons.like') }}",
                    data: formData,
                    success: function(data, status, xhr) {},
                    error: function(xhr, status, e) {}
                });
            }
        }
    </script>

    {{-- 카카오톡 공유 --}}
    <script>
        var title = '공실앤톡';
        var imageUrl = "{{ asset('assets/media/default_gs.png') }}";
        var url = "{{ env('APP_URL') }}"
        var detailUrl = "{{ route('www.map.agent.detail', ['id' => $result->id]) }}"
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
            buttons: [{
                title: '웹으로 보기',
                link: {
                    mobileWebUrl: detailUrl,
                    webUrl: detailUrl,
                },
            }, ],
        });

        function urlCopy() {
            navigator.clipboard.writeText(detailUrl).then(res => {
                alert("링크복사 되었습니다.");
            })
        }
    </script>
</x-layout>
