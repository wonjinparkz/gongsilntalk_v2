<x-layout>

    <input type="hidden" name="id" id="id" value="{{ $result->id }}">
    <input type="hidden" name="type" id="type"
        value="{{ request()->query('community') == 0 ? 'magazine' : 'community' }}">


    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back_deep.png') }}"></a></div>
        {{-- <div class="m_title">커뮤니티 상세</div> --}}
        <div class="right_area">
            <img src="{{ asset('assets/media/header_btn_share_deep.png') }}" onclick="modal_open_slide('share')">
            <a href="#" class="dot_btn btn_dot_menu"><img
                    src="{{ asset('assets/media/header_btn_dot.png') }}"></a>
        </div>
    </div>
    <div class="modal_slide modal_slide_share">
        <div class="slide_title_wrap">
            <span>공유하기</span>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('share')">
        </div>
        <div class="slide_modal_body">
            <div class="layer_share_con">
                <a class="kakaotalk-sharing-btn">
                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                    <p class="mt8">카카오톡</p>
                </a>
                <a href="#">
                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
                    <p class="mt8">링크복사</p>
                </a>
            </div>
        </div>
    </div>
    <div class="md_slide_overlay md_slide_overlay_share" onclick="modal_close_slide('share')"></div>
    <!----------------------------- m::header bar : s ----------------------------->

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
                                    <a class="kakaotalk-sharing-btn">
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
                                    <a href="{{ route('www.community.delete', ['id' => $result->id]) }}">삭제</a>
                                </div>
                            @else
                                <div class="layer_menu">
                                    <a onclick="modal_open('report');">신고</a>
                                    <a
                                        href="{{ route('www.community.block', ['block_community_id' => $result->id]) }}">차단</a>
                                </div>
                            @endif
                        </div>
                    </div>


                    <!-- content : s -->
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

                    <div class="community_content">
                        @if ($result->url != '')
                            <div class="detail_img_wrap">
                                <iframe width="100%" height="350" src="{{ $result->url }}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                        {!! nl2br($result->content) !!}
                        @foreach ($result->images as $index => $image)
                            @php
                                $detailImage = $image->path;
                            @endphp
                            <div class="detail_img_wrap">
                                <img src="{{ Storage::url('image/' . $image->path) }}"
                                    onclick="modal_open('big_img_{{ $index }}')">
                            </div>
                        @endforeach

                        <div class="like_wrap">
                            <a href="javascript:void(0)" class="btn_like {{ $result->like_id > 0 ? 'on' : '' }}"
                                onclick="btn_like(this)"></a>
                            <span id="like_count">{{ $result->like_count }}</span>
                        </div>
                    </div>
                    <!-- content : e -->

                    <x-community-reply :replys="$replys" :community_id="$result->id" :replyCount="$replyCount" />

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

    <!-- modal 신고하기 : s -->
    <div class="modal modal_mid modal_report">
        <div class="modal_title">
            <h5>신고하기</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('report')">
        </div>
        <div class="modal_container">
            <form id="communityReportForm" method="post" action="{{ route('www.community.report') }}">
                <div class="dropdown_box w_full">
                    <button class="dropdown_label" type="button">신고항목을 선택 하세요. </button>
                    <ul class="optionList">
                        <li class="optionItem" onclick="reportTypeSettingCommunity(0);">욕설, 비방, 차별, 혐오</li>
                        <li class="optionItem" onclick="reportTypeSettingCommunity(1);">광고, 홍보, 영리목적</li>
                        <li class="optionItem" onclick="reportTypeSettingCommunity(2);">불법정보</li>
                        <li class="optionItem" onclick="reportTypeSettingCommunity(3);">음란, 청소년 유해</li>
                        <li class="optionItem" onclick="reportTypeSettingCommunity(4);">개인정보 노출, 유포</li>
                        <li class="optionItem" onclick="reportTypeSettingCommunity(5);">도배, 스팸</li>
                        <li class="optionItem" onclick="reportTypeSettingCommunity(6);">기타</li>
                    </ul>
                </div>
                <input type="hidden" id="target_id" name="target_id" value="{{ $result->id }}">
                <input type="hidden" id="target_type" name="target_type"
                    value="{{ request()->query('community') }}">
                <input type="hidden" id="community_report_type" name="community_report_type" value="">
                <div class="mt10">
                    <textarea id="community_report_reason" name="community_report_reason" placeholder="신고사유를 입력하세요."></textarea>
                </div>
                <div class="mt10">
                    <button class="btn_point btn_full_basic" type="button"
                        onclick="onCommunityReportSubmit();"><b>신고하기</b></button>
                </div>
            </form>
        </div>
    </div>
    <div class="md_overlay md_overlay_report" onclick="modal_close('report')"></div>
    <!-- modal 신고하기 : s -->

    <script>
        function onCommunityReportSubmit() {
            $('#communityReportForm').submit();
        }

        function reportTypeSettingCommunity(index) {
            $('#community_report_type').val(index);
        }
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
    <script src="https://t1.kakaocdn.net/kakao_js_sdk/2.7.2/kakao.min.js"
        integrity="sha384-TiCUE00h649CAMonG018J2ujOgDKW/kVWlChEuu4jK2vxfAAD0eZxzCKakxg55G4" crossorigin="anonymous">
    </script>
    <script>
        Kakao.init('0137e2c7fcf3ebb6956ea376bc415ebc'); // 사용하려는 앱의 JavaScript 키 입력
    </script>

    <a id="create-kakaotalk-sharing-btn" href="javascript:;">
        <img src="https://developers.kakao.com/assets/img/about/logos/kakaotalksharing/kakaotalk_sharing_btn_medium.png"
            alt="카카오톡 공유 보내기 버튼" />
    </a>

    @php
        $cleaned_content = strip_tags($result->content);
    @endphp
    <script>
        Kakao.Share.createDefaultButton({
            container: "#create-kakaotalk-sharing-btn",
            objectType: "feed",
            content: {
                title: '{{ $result->title }}',
                description: '{{ mb_strlen($cleaned_content) > 50 ? mb_substr($cleaned_content, 0, 50) . '...' : $cleaned_content }}',
                imageUrl: "{{ $result->image ? Storage::url('image/' . $result->image[0]->path) : '' }}",
                link: {
                    mobileWebUrl: `{{ url->full() }}`,
                    webUrl: `{{ url->full() }}`,
                },
            }
        });
    </script>



</x-layout>
