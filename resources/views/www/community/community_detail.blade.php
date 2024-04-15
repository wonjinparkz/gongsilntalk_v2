<x-layout>

    <input type="hidden" name="id" id="id" value="{{ $result->id }}">
    <input type="hidden" name="type" id="type"
        value="{{ request()->query('community') == 0 ? 'magazine' : 'community' }}">

    <div class="body gray_body">
        <div class="inner_wrap community_wrap">
            <div class="community_area">

                <div class="community_inner_wrap">
                    <div class="header_bar">
                        <div>
                            <a
                                href="{{ str_contains(Route::currentRouteName(), 'create') ? URL::previous() : route('www.community.list.view', ['community' => '1']) }}"><img
                                    src="{{ asset('assets/media/header_btn_back.png') }}"></a>
                        </div>
                        <div>
                            <a class="btn_share"><img src="{{ asset('assets/media/header_btn_share.png') }}"></a>
                            @if (request()->query('community') == 1 && (Auth::guard('web')->user()->id ?? 0) > 0)
                                <a class="dot_btn btn_dot_menu"><img
                                        src="{{ asset('assets/media/header_btn_dot.png') }}"></a>
                            @endif

                            <!-- 공유하기 : s -->
                            <div class="layer layer_share_wrap layer_share_top">
                                <div class="layer_title">
                                    <h5>공유하기</h5>
                                    <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                        class="md_btn_close btn_share">
                                </div>
                                <div class="layer_share_con">
                                    <a href="#">
                                        <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                        <p class="mt8">카카오톡</p>
                                    </a>
                                    <a href="#">
                                        <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                        <p class="mt8">링크복사</p>
                                    </a>
                                </div>
                            </div>
                            <!-- 공유하기 : e -->
                            @if (request()->query('community') == 1 && $result->author == (Auth::guard('web')->user()->id ?? 0))
                                <div class="layer_menu">
                                    <a href="{{ route('www.community.update.view', [$result->id]) }}">수정</a>
                                    <a href="#">삭제</a>
                                </div>
                            @else
                                <div class="layer_menu">
                                    <a href="community_modify.html">신고</a>
                                    <a href="#">차단</a>
                                </div>
                            @endif

                        </div>
                    </div>


                    <!-- contents : s -->
                    <div class="community_detail_top">
                        @if ((request()->query('community') ?? 0) == 0 ? 'active' : '')
                            <span class="community_mark">
                                {{ Commons::get_magazineTypeTitle($result->type) }}
                            </span>
                        @else
                            <span class="community_mark">
                                {{ Commons::get_communityTypeTitle($result->category) }}
                            </span>
                        @endif
                        <h3>{{ $result->title }}</h3>
                        @inject('carbon', 'Carbon\Carbon')
                        @if (request()->query('community'))
                            <div class="detail_user">
                                <div class="list_user_photo">
                                    <div class="img_box">
                                        @if ($result->users->images != null)
                                            @foreach ($result->users->images as $image)
                                                <img src="{{ Storage::url('image/' . $image->path) }}" />
                                            @endforeach
                                        @else
                                            <img src="{{ asset('assets/media/default_user.png') }}" />
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <span class="txt_name">{{ $result->users->nickname }}</span>
                                    <p class="txt_date">{{ $carbon::parse($result->created_at)->format('Y-m-d H:m') }}
                                        ·
                                        조회 {{ $result->view_count }}</p>
                                </div>
                            </div>
                        @else
                            <div class="detail_user">
                                <div>
                                    <p class="txt_date">{{ $carbon::parse($result->created_at)->format('Y-m-d H:m') }}
                                        · 조회 {{ $result->view_count }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="community_contents">
                        @if ($result->url != '')
                            <div class="detail_img_wrap">
                                <iframe width="100%" height="350" src="{{ $result->url }}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                        {!! nl2br($result->content) !!}
                        @foreach ($result->images as $image)
                            <div class="detail_img_wrap">
                                <img src="{{ Storage::url('image/' . $image->path) }}" onclick="modal_open('big_img')">
                            </div>
                        @endforeach

                        <div class="like_wrap">
                            <a href="javascript:void(0)" class="btn_like {{ $result->like_id > 0 ? 'on' : '' }}"
                                onclick="btn_like(this)"></a>
                            <span id="like_count">{{ $result->like_count }}</span>
                        </div>
                    </div>
                    <!-- contents : e -->

                    <x-community-reply />

                </div>

            </div>
        </div>

    </div>

    <!-- 이미지 확대 : s-->
    <div class="modal modal_mid modal_big_img">
        <img src="{{ asset('assets/media/header_btn_close_w.png') }}" class="big_img_close"
            onclick="modal_close('big_img')">
        <img src="{{ asset('assets/media/s_8.png') }}">
    </div>
    <div class="md_overlay md_overlay_big_img" onclick="modal_close('big_img')"></div>
    <!-- 이미지 확대 : e-->

    <!-- modal 신고하기 : s -->
    <div class="modal modal_mid modal_report">
        <div class="modal_title">
            <h5>신고하기</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('report')">
        </div>
        <div class="modal_container">
            <div class="dropdown_box w_full">
                <button class="dropdown_label">신고항목을 선택 하세요. </button>
                <ul class="optionList">
                    <li class="optionItem">욕설, 비방, 차별, 혐오</li>
                    <li class="optionItem">광고, 홍보, 영리목적</li>
                    <li class="optionItem">불법정보</li>
                    <li class="optionItem">음란, 청소년 유해</li>
                    <li class="optionItem">개인정보 노출, 유포</li>
                    <li class="optionItem">도배, 스팸</li>
                    <li class="optionItem">기타</li>
                </ul>
            </div>
            <div class="mt10">
                <textarea placeholder="신고사유를 입력하세요."></textarea>
            </div>
            <div class="mt10">
                <button class="btn_point btn_full_basic"><b>신고하기</b></button>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_report" onclick="modal_close('report')"></div>
    <!-- modal 신고하기 : s -->

    <script>
        // 좋아요 토글버튼
        function btn_like(element) {
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
                    'target_id': $('#id').val(),
                    'target_type': $('#type').val(),
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
                    type: "post", //전송타입
                    url: "{{ route('www.commons.like') }}",
                    data: formData,
                    success: function(data, status, xhr) {},
                    error: function(xhr, status, e) {}
                });
            }
        }

        //공유하기 레이어
        $(".btn_share").click(function() {
            $(".layer_share_wrap").stop().slideToggle(0);
            return false;
        });
    </script>


</x-layout>
