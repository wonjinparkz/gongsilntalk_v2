@foreach ($agent as $agent)
    <!-- list : s -->
    <a href="agent_detail.html">
        <div class="agent_sm_list">
            <div class="agent_sm_info">
                <p class="agent_txt_item_1">주식회사더블유파트너즈부동산중개</p>
                <p class="agent_txt_item_2">서울특별시 중구 세종대로 136 3층 S3002호</p>
            </div>
            <div class="frame_img_sm">
                <div class="img_box"><img src="{{ asset('assets/media/default_img.png') }}"></div>
            </div>
        </div>
    </a>
    <!-- list : e -->
@endforeach
