<x-layout>
    @inject('carbon', 'Carbon\Carbon')
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="images/header_btn_close.png"></a></div>
        <div class="m_title">공지사항</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body gray_body">
        <div class="inner_wrap community_wrap">
            <div class="community_area">

                <div class="community_inner_wrap">
                    <!-- contents : s -->
                    <div class="board_detail_top">
                        <h3>{{ $result->title }}</h3>
                        <p class="txt_date mt8">{{ $carbon::parse($result->created_at)->format('Y-m-d H:m') }}
                            ·
                            조회 {{ $result->view_count }}</p>

                    </div>

                    <div class="community_contents">
                        {!! nl2br($result->content) !!}
                        @foreach ($result->images as $index => $image)
                            <div class="detail_img_wrap">
                                <img src="{{ Storage::url('image/' . $image->path) }}"
                                    onclick="modal_open('big_img_{{ $index }}')">
                            </div>
                        @endforeach
                    </div>
                    <!-- contents : e -->

                </div>

            </div>
        </div>

    </div>

    @foreach ($result->images as $index => $image)
        <!-- 이미지 확대 : s-->
        <div class="modal modal_mid modal_big_img modal_big_img_{{ $index }}">
            <img src="{{ asset('assets/media/header_btn_close_w.png') }}" class="big_img_close"
                onclick="modal_close('big_img_{{ $index }}')">
            <img src="{{ Storage::url('image/' . $image->path) }}" class="big_img">
        </div>
        <div class="md_overlay md_overlay_big_img_{{ $index }}"
            onclick="modal_close('big_img_{{ $index }}')"></div>
        <!-- 이미지 확대 : e-->
    @endforeach



</x-layout>
