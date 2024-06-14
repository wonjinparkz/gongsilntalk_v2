<x-layout>
    @inject('carbon', 'Carbon\Carbon')
    <div class="body gray_body">
        <div class="community_wrap">
            <div class="community_area">
                <!-- community top : s -->
                <div class="community_inner_wrap">
                    <div class="community_top">
                        <div class="community_top_tab">
                            <ul class="community_menu tab_toggle_menu">
                                <li class="{{ request()->query('community') == 0 ? 'active' : '' }}">
                                    <a href="{{ route('www.community.list.view', ['community' => '0']) }}">
                                        공톡 컨텐츠
                                    </a>
                                </li>
                                <li class="{{ request()->query('community') == 1 ? 'active' : '' }}">
                                    <a href="{{ route('www.community.list.view', ['community' => '1']) }}">
                                        커뮤니티
                                    </a>
                                </li>
                            </ul>
                            <div class="tab_area_wrap1">
                                <div>
                                    @if (request()->query('community') == 0)
                                        <ul class="tab_type_1 toggle_tab">
                                            <li class="{{ request()->query('type') == 0 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('www.community.list.view', ['community' => '0', 'type' => '0']) }}">
                                                    공톡 유튜브
                                                </a>
                                            </li>
                                            <li class="{{ request()->query('type') == 1 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('www.community.list.view', ['community' => '0', 'type' => '1']) }}">
                                                    공톡 매거진
                                                </a>
                                            </li>
                                            <li class="{{ request()->query('type') == 2 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('www.community.list.view', ['community' => '0', 'type' => '2']) }}">
                                                    공톡 뉴스
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                <div>
                                    @if (request()->query('community') == 1)
                                        <ul class="tab_type_1 toggle_tab">
                                            <li class="{{ request()->query('type') == 0 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('www.community.list.view', ['community' => '1', 'type' => '0']) }}">
                                                    자유글
                                                </a>
                                            </li>
                                            <li class="{{ request()->query('type') == 1 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('www.community.list.view', ['community' => '1', 'type' => '1']) }}">
                                                    질문/답변
                                                </a>
                                            </li>
                                            <li class="{{ request()->query('type') == 2 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('www.community.list.view', ['community' => '1', 'type' => '2']) }}">
                                                    후기
                                                </a>
                                            </li>
                                            <li class="{{ request()->query('type') == 3 ? 'active' : '' }}">
                                                <a
                                                    href="{{ route('www.community.list.view', ['community' => '1', 'type' => '3']) }}">
                                                    노하우
                                                </a>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('www.community.search.view') }}"><img
                                src="{{ asset('assets/media/btn_search.png') }}" class="w_22p"></a>
                    </div>
                    <ul class="cmm_noti_wrap">
                        @foreach ($noticeList as $notice)
                            <li><span>공지</span>
                                <a href="#">
                                    {{ $notice->title }} -
                                    {{ $carbon::parse($notice->created_at)->format('y.m.d') }}
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
                        <li class="{{ request()->query('order') == 0 ? 'active' : '' }}">
                            <a href="javascript:(0)" onclick="changeorderOption('0')">최신순</a>
                        </li>
                        <li class="{{ request()->query('order') == 1 ? 'active' : '' }}">
                            <a href="javascript:(0)" onclick="changeorderOption('1')">추천순</a>
                        </li>
                        <li class="{{ request()->query('order') == 2 ? 'active' : '' }}">
                            <a href="javascript:(0)" onclick="changeorderOption('2')">댓글순</a>
                        </li>
                    </ul>
                    <!-- community list : s -->
                    <div class="community_list">
                        @foreach ($result as $community)
                            @if ($community->report_id)
                                <li>
                                    <div class="flex_between">
                                        <span class="gray_basic">신고한 글입니다.</span>
                                    </div>
                                </li>
                            @elseif ($community->block_id)
                                <li>
                                    <div class="flex_between">
                                        <span class="gray_basic">차단한 글입니다.</span>
                                        <button class="btn_graylight_ghost btn_sm">차단 해제</button>
                                    </div>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('www.community.detail.view', ['id' => $community->id, 'community' => request()->query('community') ?? 0]) }}"
                                        class="community_list_link">
                                        <div class="community_row_wrap">
                                            <div class="community_row_body">
                                                <h3>{{ $community->title }}</h3>
                                                <div class="txt_item_1">
                                                    {{ str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($community->content))) }}
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
                                                @if (count($community->images) > 0)
                                                    <img
                                                        src="{{ Storage::url('image/' . $community->images[0]->path) }}">
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </div>
                    <!-- community list : e -->

                    <div class="mt20 t_right only_pc">
                        <button class="btn_gray_ghost btn_md"
                            onclick="location.href='{{ route('www.community.create.view') }}'"><img
                                src="{{ asset('assets/media/ic_pen.png') }}">글쓰기</button>
                    </div>
                    <button onclick="location.href='{{ route('www.community.create.view') }}'">
                        <img src="{{ asset('assets/media/floting_btn.png') }}" class="floting_right_btn only_m">
                    </button>

                    {{ $result->onEachSide(1)->links('components.pc-pagination') }}
                </div>
                <!-- community body : e -->

            </div>



            <!-- nav : s -->
            <x-nav-layout />
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

    var currentUrl = new URL(document.location);
    // order by 설정
    function changeorderOption(order) {
        currentUrl.searchParams.set('order', order);
        location.href = currentUrl;
    }
</script>
