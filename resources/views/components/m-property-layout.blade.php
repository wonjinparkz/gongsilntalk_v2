@if (count($property) > 0)
    @foreach ($property as $property)
        <!-- list : s -->
        <div class="property_sm_list">
            <div class="frame_img_mid">
                <span class="btn_wish_sm" onclick="btn_wish(this)"></span>
                <div class="img_box">
                    @if (count($property->images) > 0)
                        <img src="{{ Storage::url('image/' . $property->images[0]->path) }}"
                            onerror="this.src='{{ asset('assets/media/s_3.png') }}';" loading="lazy">
                    @else
                        <img src="{{ asset('assets/media/s_3.png') }}">
                    @endif
                </div>
            </div>
            <a href="{{ route('www.map.room.detail', [$property->id]) }}">
                <div class="property_sm_info">
                    <p class="property_sm_item_1">
                        {{ Lang::get('commons.payment_type.' . $property->priceInfo->payment_type) }}
                        {{ Commons::get_priceTrans($property->priceInfo->price) }}
                        {{-- 월세/단기임대 --}}
                        @if (in_array($property->priceInfo->payment_type, [2, 4]))
                            / {{ Commons::get_priceTrans($property->priceInfo->month_price) }}
                        @endif
                    </p>
                    <p class="txt_lh_1">{{ Lang::get('commons.product_type.' . $property->type) }}
                        {{ $property->region_address }}</p>
                    <p class="txt_lh_1">{{ $property->square ?? '-' }}㎡ /
                        {{ $property->exclusive_square ?? '-' }}㎡·{{ $property->floor_number ?? '-' }}층</p>
                    <p class="property_sm_item_2">{{ $property->contents ?? '' }}</p>
                </div>
            </a>
        </div>
        <!-- list : e -->
    @endforeach
@else
    <div class="empty_wrap">
        <p><img src="{{ asset('assets/media/img_empty_1.png') }}" class="empty_img"></p>
        <span>조건에 맞는 매물이 없습니다.<br>지도를 이동하거나, 검색 필터를 조정해보세요.</span>
    </div>
@endif
