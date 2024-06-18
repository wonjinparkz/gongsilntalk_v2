@foreach ($property as $property)
    <!-- list : s -->
    <div class="property_sm_list">
        <div class="frame_img_mid">
            <span class="btn_wish_sm" onclick="btn_wish(this)"></span>
            <div class="img_box"><img src="{{ asset('assets/media/s_3.png') }}"></div>
        </div>
        <a href="{{ route('www.map.room.detail', [$property->id]) }}">
            <div class="property_sm_info">
                <p class="property_sm_item_1">매매 2억 9,900만</p>
                <p class="txt_lh_1">사무실 강남구 논현동</p>
                <p class="txt_lh_1">62.11㎡ / 46.2㎡·3층</p>
                <p class="property_sm_item_2">영등포시장역 도보 1분 초역세권 매물 소개를 합니다.</p>
            </div>
        </a>
    </div>
    <!-- list : e -->
@endforeach
