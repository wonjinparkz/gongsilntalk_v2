@if (count($agentList) > 0)
    @foreach ($agentList as $agent)
        @php
            $address = $agent->company_address ?? null;
            $addressDetail = $agent->company_address_detail ?? null;
        @endphp
        <!-- list : s -->
        <a href="{{ route('www.map.agent.detail', [$agent->id]) }}">
            <div class="agent_sm_list">
                <div class="agent_sm_info">
                    <p class="agent_txt_item_1">{{ $agent->company_name }}</p>
                    <p class="agent_txt_item_2">{{ $address ? $address . ' ' . $addressDetail : '-' }} </p>
                </div>
                <div class="frame_img_sm">
                    <div class="img_box">
                        @if (count($agent->images) > 0)
                            <img src="{{ Storage::url('image/' . $agent->images->path) }}"
                                onerror="this.src='{{ asset('assets/media/default_img.png') }}';" loading="lazy">
                        @else
                            <img src="{{ asset('assets/media/default_img.png') }}">
                        @endif
                    </div>
                </div>
            </div>
        </a>
        <!-- list : e -->
    @endforeach
@else
    <div class="empty_wrap">
        <p><img src="{{ asset('assets/media/img_empty_1.png') }}" class="empty_img"></p>
        <span>조건에 맞는 중개사무소가 없습니다.<br>지도를 이동하거나, 검색 필터를 조정해보세요.</span>
    </div>
@endif

<script>
    $('#agent_count').html({{ count($agentList) }});
</script>
