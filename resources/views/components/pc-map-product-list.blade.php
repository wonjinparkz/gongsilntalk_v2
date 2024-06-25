@props([
    'productList' => [],
])

<div class="side_section">
    <div class="flex_between">
        <h4>매물정보</h4>
        <button class="btn_xs btn_gray btn_all" onclick="mapTypeChage(1)">매물 더보기<img
                src="{{ asset('assets/media/ic_list_arrow.png') }}"></button>
    </div>
</div>

@if (count($productList) > 0)
    @foreach ($productList as $product)
        <div class="property_sm_list" onclick="location.href='{{ route('www.map.room.detail', [$product->id]) }}'">
            <div class="frame_img_mid">
                <span class="btn_wish_sm {{ $product->like_id > 0 ? 'on' : '' }}"
                    onclick="btn_wish(this, {{ $product->id }})"></span>
                <div class="img_box"><img src="{{ Storage::url('image/' . $product->images[0]->path) }}"></div>
            </div>
            <div class="property_sm_info">
                <p class="property_sm_item_1">
                    {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                    {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                    {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                </p>
                <p class="txt_lh_1">{{ Lang::get('commons.product_type.' . $product->type) }}
                    {{ $product->region_address }}</p>
                <p class="txt_lh_1">{{ $product->square }}㎡
                    {{ $product->type != 7 ? ' / ' . $product->exclusive_square : '' }}㎡·{{ $product->floor_number }}층
                </p>
                <p class="property_sm_item_2">{{ $product->comments }}</p>
            </div>
        </div>
    @endforeach
@else
    <div class="side_section">
        <div class="empty_wrap box_type">
            <p>등록된 매물이 없습니다.</p>
            <span>찾고 있는 매물이 있다면<br>검색을 통해 직접 매물을 탐색해보세요.</span>
            <div class="mt8"><button class="btn_point_ghost btn_md" onclick="mapTypeChage(1)">매물
                    검색하기</button></div>
        </div>
    </div>
@endif


<div class="side_section">
    <div class="btn_half_wrap">
        <button class="btn_point btn_full_thin"
            onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'">매물
            구하기</button>
        <button class="btn_point btn_full_thin" onclick="location.href='{{ route('www.product.create.view') }}'">매물
            내놓기</button>
    </div>
</div>
