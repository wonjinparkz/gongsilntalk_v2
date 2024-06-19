@foreach ($agent as $agent)
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
                    @if ($agent->images > 0)
                        <img src="{{ Storage::url('image/' . $agent->images->path) }}"
                            onerror="this.src='{{ asset('assets/media/default_img.png') }}';">
                    @else
                        <img src="{{ asset('assets/media/default_img.png') }}">
                    @endif
                    {{-- <img src="{{ Storage::url('image/' . $agent->images[0]->path) }}"
                        onerror="this.src='{{ asset('assets/media/default_img.png') }}';"> --}}
                </div>
                {{-- <div class="img_box"><img src="{{ asset('assets/media/default_img.png') }}"></div> --}}
            </div>
        </div>
    </a>
    <!-- list : e -->
@endforeach
