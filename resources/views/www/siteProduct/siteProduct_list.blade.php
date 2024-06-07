<x-layout>

    <!-- m::header bar : s -->
    <div class="m_header">
        <div class="left_area"></div>
        <div class="m_title">실시간 분양현장</div>
        <div class="right_area"></div>
    </div>
    <!-- m::header bar : s -->

    <div class="body gray_body">
        <!-- PC::filter : s -->
        <div class="sales_list_top">
            <div class="inner_wrap ">
                <h1 class="t_center">실시간 분양현장</h1>
                <div>
                    <div class="dropdown_box w_10">
                        <button class="dropdown_label">상태구분 </button>
                        <ul class="optionList">
                            <li class="optionItem">전체</li>
                            <li class="optionItem">분양예정</li>
                            <li class="optionItem">분양중</li>
                        </ul>
                    </div>
                </div>

                <div class="point_filter mt18">
                    <div class="cell">
                        <input type="checkbox" name="region[]" id="region_" value="">
                        <label for="region_">전체</label>
                    </div>
                    @for ($i = 0; $i < count(Lang::get('commons.site_product_region_type')); $i++)
                        <div class="cell">
                            <input type="checkbox" name="region[]" id="region_{{ $i }}"
                                value="{{ $i }}">
                            <label
                                for="region_{{ $i }}">{{ Lang::get('commons.site_product_region_type.' . $i) }}</label>
                        </div>
                    @endfor
                </div>

            </div>
        </div>
        <!-- PC::filter : e -->

        <!-- M::filter : s -->
        <div class="m_sales_filter_wrap">
            <div class="m_dropdown_double_wrap">
                <button class="btn_dropdown" onclick="modal_open_slide('state')">상태구분</button>
                <button class="btn_dropdown" onclick="modal_open_slide('region')">지역구분</button>
            </div>
        </div>
        <div class="modal_slide modal_slide_state">
            <div class="slide_title_wrap">
                <span>상태구분 선택</span>
                <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('state')">
            </div>
            <ul class="slide_modal_menu">
                <li><a href="#">전체</a></li>
                <li><a href="#">분양예정</a></li>
                <li><a href="#">분양중</a></li>
            </ul>
        </div>
        <div class="md_slide_overlay md_slide_overlay_state" onclick="modal_close_slide('state')"></div>

        <div class="modal_slide modal_slide_region">
            <div class="slide_title_wrap">
                <span>지역구분 선택</span>
                <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('region')">
            </div>
            <ul class="slide_select_menu">
                <li>
                    <input type="checkbox" name="m_region[]" id="m_region_" value="">
                    <label for="m_region_">전체</label>
                </li>
                @for ($i = 0; $i < count(Lang::get('commons.site_product_region_type')); $i++)
                    <li>
                        <input type="checkbox" name="m_region" id="m_region_{{ $i }}"
                            value="{{ $i }}">
                        <label
                            for="m_region_{{ $i }}">{{ Lang::get('commons.site_product_region_type.' . $i) }}</label>
                    </li>
                @endfor
            </ul>
            <button class="btn_slide btn_point" onclick="modal_close_slide('region')">선택하기</button>
        </div>
        <div class="md_slide_overlay md_slide_overlay_region" onclick="modal_close_slide('region')"></div>
        <!-- M::filter : e -->

        <div class="inner_wrap bottom_space">
            <div class="txt_search_total">분양목록 총 <span class="txt_point">44건</span></div>

            <div class="sales_list_wrap">

                @foreach ($result as $siteProduct)
                    <!-- card : s -->
                    <div class="sales_card">
                        <span class="sales_list_wish  {{ $siteProduct->like_id > 0 ? 'on' : '' }}"
                            onclick="btn_like(this, {{ $siteProduct->id }})"></span>
                        <a href="{{ route('www.site.product.detail.view', $siteProduct->id) }}">
                            <div class="sales_card_img">
                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                            </div>
                            <div class="sales_list_con">
                                <span
                                    class="{{ $siteProduct->is_sale ? 'mark_proceeding' : 'mark_plans' }}">{{ $siteProduct->is_sale ? '분양중' : '분양예정' }}</span>
                                <p class="txt_item_1">{{ $siteProduct->title }}</p>
                                <p class="txt_item_2">{{ $siteProduct->region_address }}</p>
                                <p class="txt_item_3">{{ $siteProduct->comments }}</p>
                            </div>
                        </a>
                    </div>
                    <!-- card : e -->
                @endforeach

            </div>

            <!-- paging : s -->
            {{ $result->onEachSide(1)->links('components.pc-pagination') }}
            <!-- paging : e -->

            <!-- nav : s -->
            <nav>
                <ul>
                    <li>
                        <a href="main.html"><span><img src="{{ asset('assets/media/mcnu_ic_1.png') }}"
                                    alt=""></span>홈</a>
                    </li>
                    <li class="active">
                        <a href="sales_list.html"><span><img src="{{ asset('assets/media/mcnu_ic_2.png') }}"
                                    alt=""></span>분양현장</a>
                    </li>
                    <li>
                        <a href="m_map.html"><span><img src="{{ asset('assets/media/mcnu_ic_3.png') }}"
                                    alt=""></span>지도</a>
                    </li>
                    <li>
                        <a href="community_contents_list.html"><span><img
                                    src="{{ asset('assets/media/mcnu_ic_5.png') }}" alt=""></span>커뮤니티</a>
                    </li>
                    <li>
                        <a href="my_main.html"><span><img src="{{ asset('assets/media/mcnu_ic_4.png') }}"
                                    alt=""></span>마이페이지</a>
                    </li>
                </ul>
            </nav>
            <!-- nav : e -->


        </div>

    </div>
    <script>
        // 관심매물 토글버튼
        function btn_like(element, id) {
            var login_check =
                @if (Auth::guard('web')->check())
                    false
                @else
                    true
                @endif ;

            if (login_check) {
                // dialog('로그인이 필요합니다.\n로그인 하시겠어요?', '로그인', '아니요', login);
                return;
            } else {

                var formData = {
                    'target_id': id,
                    'target_type': 'siteProduct',
                };

                var likeCount = parseInt($("#like_count").text());


                if ($(element).hasClass("on")) {
                    $(element).removeClass("on");
                    likeCount--;
                } else {
                    $(element).addClass("on");
                    likeCount++;
                }

                $("#like_count").text(likeCount);

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


</x-layout>
