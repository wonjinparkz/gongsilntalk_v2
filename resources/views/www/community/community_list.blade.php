<x-layout>
    @inject('carbon', 'Carbon\Carbon')
    <div class="body gray_body">
        <div class="community_wrap">
            <div class="community_area">
                <!-- community top : s -->
                <div class="community_inner_wrap">
                    <div class="community_top">
                        <ul class="community_menu toggle_tab">
                            <li class="active"><a href="{{ route('www.community.list.view', ['community' => '0']) }}">공톡
                                    컨텐츠</a>
                            </li>
                            <li><a href="{{ route('www.community.list.view', ['community' => '1']) }}">커뮤니티</a></li>
                        </ul>
                        <a href="community_search.html"><img src="{{ asset('assets/media/btn_search.png') }}"
                                class="w_22p"></a>
                    </div>
                    <ul class="tab_type_1 toggle_tab">
                        <li class="active"><a
                                href="{{ route('www.community.list.view', ['community' => '0', 'type' => '0']) }}">공톡
                                유튜브</a></li>
                        <li><a href="{{ route('www.community.list.view', ['community' => '0', 'type' => '1']) }}">공톡
                                매거진</a></li>
                        <li><a href="{{ route('www.community.list.view', ['community' => '0', 'type' => '2']) }}">공톡
                                뉴스</a></li>
                    </ul>
                    <ul class="cmm_noti_wrap">
                        @foreach ($noticeList as $notice)
                            <li><span>공지</span>
                                <a href="#">
                                    {{ $notice->title }} - {{ $carbon::parse($notice->created_at)->format('y.m.d') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- community top : e -->
                <hr class="space">

                <!-- community body : s -->
                <div class="community_inner_wrap">
                    <ul class="list_sort toggle_tab only_pc mt28">
                        <li class="active"><a href="#">최신순</a></li>
                        <li><a href="#">추천순</a></li>
                        <li><a href="#">댓글순</a></li>
                    </ul>
                    <!-- community list : s -->
                    <div class="community_list">
                        @foreach ($result as $community)
                            @if ($community->report_id)
                                <li class="recruit_noti">
                                    <p>신고한 게시글입니다.</p>
                                </li>
                            @elseif ($community->block_id)
                                <li class="recruit_noti">
                                    <p>차단한 게시글입니다.<br><a href="javascript:void(0)"
                                            onclick="block({{ $community->id }}, 'job_post')">차단해제</a>
                                    </p>
                                </li>
                            @else
                                <li>
                                    <a href="community_detail.html" class="community_list_link">
                                        <div class="community_row_wrap">
                                            <div class="community_row_body">
                                                <h3>{{ $community->title }}</h3>
                                                <div class="txt_item_1">
                                                    {!! $community->content !!}
                                                </div>
                                                <div class="txt_item_2 mt8">
                                                    <span>{{ $carbon::parse($community->created_at)->format('y.m.d') }}
                                                        ·
                                                    </span>
                                                    <span>추천 {{ $community->like_count }} · </span>
                                                    <span>댓글 {{ count($community->replys) }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="community_row_img">
                                            <div class="img_box">
                                                <img src="{{ asset('assets/media/s_1.png') }}">
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        <li>
                            <div class="flex_between">
                                <span class="gray_basic">차단한 글입니다.</span>
                                <button class="btn_graylight_ghost btn_sm">차단 해제</button>
                            </div>
                        </li>
                        <li>
                            <div class="flex_between">
                                <span class="gray_basic">신고한 글입니다.</span>
                            </div>
                        </li>

                    </div>
                    <!-- community list : e -->

                    <div class="mt20 t_right only_pc">
                        <button class="btn_gray_ghost btn_md" onclick="location.href='community_reg.html'"><img
                                src="{{ asset('assets/media/ic_pen.png') }}">글쓰기</button>
                    </div>
                    <button onclick="location.href='community_reg.html'"><img
                            src="{{ asset('assets/media/floting_btn.png') }}"
                            class="floting_right_btn only_m"></button>

                    <!-- paging : s -->
                    <div class="paging only_pc">
                        <ul class="btn_wrap">
                            <li class="btn_prev">
                                <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_prev.png') }}"
                                        alt=""></a>
                            </li>
                            <li class="active">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li class="btn_next">
                                <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_next.png') }}"
                                        alt=""></a>
                            </li>
                        </ul>
                    </div>
                    <!-- paging : e -->
                </div>
                <!-- community body : e -->

            </div>



            <!-- nav : s -->
            <nav>
                <ul>
                    <li>
                        <a href="main.html"><span><img src="{{ asset('assets/media/mcnu_ic_1.png') }}"
                                    alt=""></span>홈</a>
                    </li>
                    <li>
                        <a href="sales_list.html"><span><img src="{{ asset('assets/media/mcnu_ic_2.png') }}"
                                    alt=""></span>분양현장</a>
                    </li>
                    <li>
                        <a href="m_map.html"><span><img src="{{ asset('assets/media/mcnu_ic_3.png') }}"
                                    alt=""></span>지도</a>
                    </li>
                    <li class="active">
                        <a href="community_contents_list.html"><span><img
                                    src="{{ asset('assets/media/mcnu_ic_5.png') }}" alt=""></span>커뮤니티</a>
                    </li>
                    <li>
                        <a href="my_main.html"><span><img src="{{ asset('assets/media/mcnu_ic_4.png') }}"
                                    alt=""></span>마이페이지</a>
                    </li>
                </ul>
            </nav>
            <!-- nav : e -->


        </div>

    </div>
</x-layout>

<script>
    // 차단 / 차단해제
    function block(id, type) {

        var login_check =
            @if (Auth::guard('web')->check())
                false
            @else
                true
            @endif ;

        if (login_check) {
            dialog('로그인이 필요합니다.\n로그인 하시겠어요?', '로그인', '아니요', login);
        } else {
            dialog('게시글 차단을 해제할까요?', '해제', '취소', function() {
                var formData = {
                    'target_id': id,
                    'target_type': type,
                };

                $.ajax({
                    type: "post", //전송타입
                    url: "",
                    data: formData,
                    success: function(data, status, xhr) {
                        if (data.result.block_user_id == undefined) {
                            location.reload();
                        } else {
                            window.location.replace(document.referrer);
                        }
                    },
                    error: function(xhr, status, e) {}
                });
            });
        }
    }
</script>
