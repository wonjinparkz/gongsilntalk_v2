<x-layout>

    <!-- m::header bar : s -->
    <div class="m_header">
        <div class="left_area"></div>
        <div class="m_title">실시간 분양현장</div>
        <div class="right_area"></div>
    </div>
    <!-- m::header bar : s -->

    <div class="body gray_body">
        <form action="{{ route('www.site.product.list.view') }}" method="GET" id="searchForm">
            @php
                $region = Request::get('region') ?? [];
                $m_region = Request::get('m_region') ?? [];
            @endphp
            <input type="hidden" id="is_sale" name="is_sale" value="">
            <!-- PC::filter : s -->
            <div class="sales_list_top">
                <div class="inner_wrap ">
                    <h1 class="t_center">실시간 분양현장</h1>
                    <div>
                        <div class="dropdown_box w_10">
                            @php
                                $stateText = '상태구분';
                                switch (Request::get('is_sale')) {
                                    case '':
                                        $stateText = '상태구분';
                                        break;
                                    case 0:
                                        $stateText = '분양예정';
                                        break;
                                    case 1:
                                        $stateText = '분양중';
                                        break;
                                    case 2:
                                        $stateText = '분양완료';
                                        break;

                                    default:
                                        $stateText = '상태구분';
                                        break;
                                }
                            @endphp
                            <button type="button" class="dropdown_label">{{ $stateText }} </button>
                            <ul class="optionList">
                                <li class="optionItem" onclick="onSaleChange('');">전체</li>
                                <li class="optionItem" onclick="onSaleChange('0');">분양예정</li>
                                <li class="optionItem" onclick="onSaleChange('1');">분양중</li>
                                <li class="optionItem" onclick="onSaleChange('2');">분양완료</li>
                            </ul>
                        </div>
                    </div>

                    <div class="point_filter mt18">
                        <div class="cell">
                            <input type="checkbox" onclick="selectAll();formSubmit();" name="region[]" id="region_"
                                {{ count($region) < 1 ? 'checked' : '' }} value="">
                            <label for="region_">전체</label>
                        </div>
                        @for ($i = 0; $i < count(Lang::get('commons.site_product_region_type')); $i++)
                            <div class="cell">
                                <input type="checkbox" onclick="formSubmit();" name="region[]"
                                    id="region_{{ $i }}" value="{{ $i }}"
                                    {{ in_array($i, $region) ? 'checked' : '' }}>
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
                    <button type="button" class="btn_dropdown"
                        onclick="modal_open_slide('state')">{{ $stateText }}</button>
                    <button type="button" class="btn_dropdown" onclick="modal_open_slide('region')">지역구분</button>
                </div>
            </div>

            <div class="modal_slide modal_slide_state">
                <div class="slide_title_wrap">
                    <span>상태구분 선택</span>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('state')">
                </div>
                <ul class="slide_modal_menu">
                    <li onclick="onSaleChange('');"><a href="#">전체</a></li>
                    <li onclick="onSaleChange('0');"><a href="#">분양예정</a></li>
                    <li onclick="onSaleChange('1');"><a href="#">분양중</a></li>
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
                        <input type="checkbox" onclick="selectAll();formSubmit();" name="m_region[]" id="m_region_"
                            {{ count($m_region) < 1 ? 'checked' : '' }} value="">
                        <label for="m_region_">전체</label>
                    </li>
                    @for ($i = 0; $i < count(Lang::get('commons.site_product_region_type')); $i++)
                        <li>
                            <input type="checkbox" onclick="formSubmit();" name="m_region[]"
                                id="m_region_{{ $i }}" value="{{ $i }}"
                                {{ in_array($i, $m_region) ? 'checked' : '' }}>
                            <label
                                for="m_region_{{ $i }}">{{ Lang::get('commons.site_product_region_type.' . $i) }}</label>
                        </li>
                    @endfor
                </ul>
                <button class="btn_slide btn_point" type="button" onclick="modal_close_slide('region')">선택하기</button>
            </div>
            <div class="md_slide_overlay md_slide_overlay_region" onclick="modal_close_slide('region')"></div>
            <!-- M::filter : e -->
        </form>

        <div class="inner_wrap bottom_space">
            <div class="txt_search_total">분양목록 총 <span class="txt_point">{{ count($result) }}건</span></div>

            <div class="sales_list_wrap">

                @foreach ($result as $siteProduct)
                    <!-- card : s -->
                    <div class="sales_card">
                        <span class="sales_list_wish  {{ $siteProduct->like_id != '' ? 'on' : '' }}"
                            onclick="btn_like(this, {{ $siteProduct->id }})"></span>
                        <a href="{{ route('www.site.product.detail.view', $siteProduct->id) }}">
                            <div class="sales_card_img">
                                <div class="img_box">
                                    <img src="{{ Storage::url('image/' . $siteProduct->main_images[0]->path) }}"
                                        style="max-width:280px; max-height:186px; filter:{{ $siteProduct->is_sale == 2 ? 'grayscale(100%)' : '' }}"
                                        onerror="this.onerror=null; this.src='{{ asset('assets/media/s_1.png') }}'">
                                </div>
                            </div>
                            <div class="sales_list_con">
                                @php
                                    $mark_proceeding = '';
                                    $sale_type = '';
                                    switch ($siteProduct->is_sale) {
                                        case 0:
                                            $mark_proceeding = 'mark_plans';
                                            $sale_type = '분양예정';
                                            break;
                                        case 1:
                                            $mark_proceeding = 'mark_proceeding';
                                            $sale_type = '분양중';
                                            break;
                                        case 2:
                                            $mark_proceeding = 'mark_complete';
                                            $sale_type = '분양완료';
                                            break;
                                    }
                                @endphp
                                <span class="{{ $mark_proceeding }}">
                                    {{ $sale_type }}
                                </span>
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
            <x-nav-layout />
            <!-- nav : e -->


        </div>

    </div>
    <script>
        function onSaleChange(string) {
            $('#is_sale').val(string);
            formSubmit();
        }

        function selectAll() {
            const checkboxes = document.getElementsByName('region[]');
            const m_checkboxes = document.getElementsByName('m_region[]');

            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            })
            m_checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            })
        }

        function formSubmit() {
            $('#region_').prop('checked', false);
            $('#m_region_').prop('checked', false);

            $('#searchForm').submit();
        }

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
                    url: '{{ route('www.commons.like') }}',
                    type: "post",
                    data: {
                        'target_id': id,
                        'target_type': 'site_product'
                    }
                }).fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('다시 시도해주세요.');
                });
            }
        }
    </script>


</x-layout>
