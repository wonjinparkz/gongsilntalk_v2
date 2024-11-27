@props(['productList' => []])

<div class="sales_list_wrap">
    <!-- card : s -->
    @foreach ($productList as $item)
        {{-- {{ $item }} --}}
        <div class="sales_card">
            <span class="sales_list_wish {{ $item->like_id > 0 ? 'on' : '' }}" value="{{ $item->id }}"
                onclick="btn_wish(this)"></span>
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
                        @if (in_array($item->priceInfo->payment_type, [1, 2, 4]))
                            / {{ Commons::get_priceTrans($item->priceInfo->month_price) }}
                        @endif
                    </p>
                    <p class="txt_item_4">{{ $item->region_address }}</p>
                    <p class="txt_item_2">{{ $item->square ?? '-' }}㎡
                        @if ($item->exclusive_square > 0)
                            / {{ $item->type != 7 ? '전용 ' . $item->exclusive_square : '' }}㎡
                        @endif
                        {{ $item->floor_number != '' ? '·' . $item->floor_number . '층' : '' }}
                    </p>
                    <p class="txt_item_3">{{ $item->contents ?? '' }}</p>
                </div>
            </a>
        </div>
    @endforeach
</div>

{{ $productList->onEachSide(1)->links('components.pc-pagination') }}
{{ $productList->onEachSide(1)->links('components.m-pagination') }}
