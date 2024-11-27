@if ($type == 0)

    <!-- 일반매물 : s -->
    <div>
        {{-- <div class="my_search_wrap mt20">
            <div class="sort_wrap">
                <div class="dropdown_box">
                    <button
                        class="dropdown_label">{{ Request::get('payment_type') != '' ? Lang::get('commons.payment_type.' . Request::get('payment_type')) : '거래 유형' }}</button>
                    <ul class="optionList">
                        <li class="optionItem" onclick="onPaymentTypeChange('');">전체</li>
                        @foreach (Lang::get('commons.payment_type') as $key => $payment_type)
                            <li class="optionItem" onclick="onPaymentTypeChange('{{ $key }}');">
                                {{ $payment_type }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="dropdown_box">
                    <button
                        class="dropdown_label">{{ Request::get('product_type') != '' ? Lang::get('commons.product_type.' . Request::get('product_type')) : '매물 종류' }}</button>
                    <ul class="optionList">
                        <li class="optionItem" onclick="onProductTypeChange('');">전체</li>
                        @foreach (Lang::get('commons.product_type') as $key => $product_type)
                            <li class="optionItem" onclick="onProductTypeChange('{{ $key }}');">
                                {{ $product_type }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}

        <div class="txt_search_total">
            <span class="gray_basic">※ 거래완료일 경우 확인되지 않습니다.</span>
            <div class="mt8">
                총 <span class="txt_point">{{ $result->total() }}개</span>의 관심 매물
            </div>
        </div>

        @if ($result->total() < 1)
            <!-- 데이터가 없을 경우 : s -->
            <div class="empty_wrap only_pc">
                <p>관심 등록된 매물이 없습니다.</p>
                <span>매물지도에서 마음에 드는 매물을 찾아<br>관심 매물로 등록해보세요.</span>
                <div class="mt8">
                    <button class="btn_point btn_md_bold"
                        onclick="location.href='{{ route('www.map.map', ['mapType' => 1]) }}'">매물 찾아보기</button>
                </div>
            </div>
            <div class="empty_wrap only_m">
                <p>관심 등록된 매물이 없습니다.</p>
                <span>매물지도에서 마음에 드는 매물을 찾아<br>관심 매물로 등록해보세요.</span>
                <div class="mt8">
                    <button class="btn_point btn_md_bold"
                        onclick="location.href='{{ route('www.map.mobile', ['mapType' => 1]) }}'">매물 찾아보기</button>
                </div>
            </div>
            <!-- 데이터가 없을 경우 : e -->
        @else
            <div class="sales_list_wrap">
                @foreach ($result as $product)
                    <div class="sales_card">
                        <span class="sales_list_wish {{ isset($product->like_id) ? 'on' : '' }}"
                            onclick="onLikeStateChange('{{ $product->id }}', 'product');btn_wish(this);"></span>
                        <a href="{{ route('www.map.room.detail', [$product->id]) }}">
                            <div class="sales_card_img">
                                <div class="img_box">
                                    <img src="{{ Storage::url('image/' . $product->images[0]->path) }}"
                                        style="max-height:186px;">
                                </div>
                            </div>
                            <div class="sales_list_con">
                                <p class="txt_item_1">
                                    {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                                    {{ $product->priceInfo->price > 0 ? mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) : $product->priceInfo->price }}
                                    {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . ($product->priceInfo->month_price > 0 ? mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : $product->priceInfo->month_price) : '' }}
                                </p>
                                <p class="txt_item_4">
                                    {{ $product->region_address }}
                                </p>
                                <p class="txt_item_2">
                                    {{ isset($product->area) ? $product->area . '㎡ / ' : '' }}
                                    {{ $product->exclusive_square }}㎡
                                    {{ isset($product->floor_number) ? '·' . $product->floor_number . '층' : '' }}
                                </p>
                                <p class="txt_item_3">
                                    {{ isset($product->comments) ? $product->comments : $product->contents }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>


            <!-- paging : s -->
            {{ $result->onEachSide(1)->links('components.pc-my-page-interest-pagination') }}
            {{ $result->onEachSide(1)->links('components.m-my-page-interest-pagination') }}
            <!-- paging : e -->

        @endif

    </div>
    <!-- 일반매물 : e -->
@else
    <!--  분양매물 : s -->
    <div>
        <div class="txt_search_total">
            총 <span class="txt_point">{{ $result->total() }}개</span>의 관심 매물
        </div>
        @if ($result->total() < 1)
            <!-- 데이터가 없을 경우 : s -->
            <div class="empty_wrap">
                <p>관심 등록된 매물이 없습니다.</p>
                <span>매물지도에서 마음에 드는 매물을 찾아<br>관심 매물로 등록해보세요.</span>
                <div class="mt8"><button class="btn_point btn_md_bold"
                        onclick="location.href='{{ route('www.site.product.list.view') }}'">매물
                        찾아보기</button></div>
            </div>
            <!-- 데이터가 없을 경우 : e -->
        @else
            <div class="sales_list_wrap">
                @foreach ($result as $product)
                    <div class="sales_card">
                        <span class="sales_list_wish {{ isset($product->like_id) ? 'on' : '' }}"
                            onclick="onLikeStateChange('{{ $product->id }}', 'site_product');btn_wish(this)"></span>
                        <a href="{{ route('www.site.product.detail.view', [$product->id]) }}">
                            <div class="sales_card_img">
                                <div class="img_box"><img
                                        src="{{ Storage::url('image/' . $product->images[0]->path) }}"
                                        style="max-height:186px; filter:{{ $product->is_sale == 2 ? 'grayscale(100%)' : '' }}">
                                </div>
                            </div>
                            <div class="sales_list_con">
                                @php
                                    $mark_proceeding = '';
                                    $sale_type = '';
                                    switch ($product->is_sale) {
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
                                <p class="txt_item_1">{{ $product->product_name }}</p>
                                <p class="txt_item_2">{{ $product->address }}</p>
                                <p class="txt_item_3">{{ $product->comments }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <!-- paging : s -->
            {{ $result->onEachSide(1)->links('components.pc-my-page-recently-pagination') }}
            {{ $result->onEachSide(1)->links('components.m-my-page-recently-pagination') }}
            <!-- paging : e -->
        @endif
    </div>
    <!--  분양매물 : e -->

@endif
