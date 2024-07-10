<x-layout>
    @inject('carbon', 'Carbon\Carbon')
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">게시글 검색</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body gray_body">
        <div class="community_wrap">
            <div class="community_area">

                <form class="form" method="GET" action="{{ route('www.community.search.list.view') }}">
                    @csrf

                    <input type="hidden" name="community" id="community" value="{{ old('community') ?? 0 }}">

                    <!-- community body : s -->
                    <div class="community_inner_wrap">

                        <div class="community_search_wrap flex_between">
                            <input type="text" name="searchInput" id="searchInput" placeholder="검색어를 입력해주세요."
                                value="{{ $searchInput }}">

                            <img src="{{ asset('assets/media/btn_solid_delete.png') }}" alt="del" class="btn_del">
                            <button id="saveSearch">
                                <img src="{{ asset('assets/media/btn_search.png') }}" alt="검색">
                            </button>
                        </div>
                    </div>
                </form>

                <!-- tab : s -->
                <div class="tab_type_2 type_basic mt8">
                    <div class="swiper detail_tab">
                        <div class="swiper-wrapper menu">
                            <div class="swiper-slide {{ request()->query('community') == 0 ? 'active' : '' }}"><a
                                    onclick="communitySearch(0)">공톡 컨텐츠</a></div>
                            <div class="swiper-slide {{ request()->query('community') == 1 ? 'active' : '' }}"><a
                                    onclick="communitySearch(1)">커뮤니티</a></div>
                        </div>
                    </div>
                </div>
                <!-- tab : s -->

                <div class="community_inner_wrap mt20">
                    <div class="list_sort_wrap">
                        {{ $result->links('components.pagination-info') }}
                        <ul class="list_sort toggle_tab ">
                            <li class="{{ request()->query('order') == 0 ? 'active' : '' }}">
                                <a onclick="changeorderOption('0')">최신순</a>
                            </li>
                            <li class="{{ request()->query('order') == 1 ? 'active' : '' }}">
                                <a onclick="changeorderOption('1')">추천순</a>
                            </li>
                            <li class="{{ request()->query('order') == 2 ? 'active' : '' }}">
                                <a onclick="changeorderOption('2')">댓글순</a>
                            </li>
                        </ul>
                    </div>


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
                                    @if ((request()->query('community') ?? 0) == 0 ? 'active' : '')
                                        <span class="community_category">
                                            {{ Commons::get_magazineTypeTitle($community->type) }}
                                        </span>
                                    @else
                                        <span class="community_category">
                                            {{ Commons::get_communityTypeTitle($community->category) }}
                                        </span>
                                    @endif
                                    <a href="{{ route('www.community.detail.view', ['id' => $community->id, 'community' => request()->query('community') ?? 0]) }}"
                                        class="community_list_link mt8">
                                        <div class="community_row_wrap">
                                            <div class="community_row_body">
                                                <h3>{!! Commons::get_searchTitle($searchInput, $community->title) !!}</h3>
                                                <div class="txt_item_1">
                                                    {!! Commons::get_searchContent($searchInput, strip_tags(htmlspecialchars_decode($community->content))) !!}
                                                </div>
                                                <div class="txt_item_2 mt8">
                                                    <span>{{ $carbon::parse($community->created_at)->format('y.m.d') }}
                                                        ·
                                                    </span>
                                                    <span>추천 {{ $community->like_count }} · </span>
                                                    <span>댓글 {{ number_format($community->replys_count) }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="community_row_img">
                                            @if (count($community->images) > 0)
                                                <div class="img_box">
                                                    <img
                                                        src="{{ Storage::url('image/' . $community->images[0]->path) }}">
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach

                    </div>
                    <!-- community list : e -->

                    @if (request()->query('community') == 1)
                        <div class="mt20 t_right only_pc">
                            <button class="btn_gray_ghost btn_md"
                                onclick="location.href='{{ route('www.community.create.view') }}'"><img
                                    src="{{ asset('assets/media/ic_pen.png') }}">글쓰기</button>
                        </div>
                    @endif
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
    var currentUrl = new URL(document.location);
    // order by 설정
    function changeorderOption(order) {
        currentUrl.searchParams.set('order', order);
        location.href = currentUrl;
    }

    // 쿠키에 저장하는 함수
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    // 쿠키에서 불러오는 함수
    function getCookie(cname) {
        const name = cname + "=";
        const decodedCookie = decodeURIComponent(document.cookie);
        const ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    // 저장 버튼 클릭 시 검색어를 쿠키에 저장하고 리스트에 추가
    $('#saveSearch').click(function() {
        const searchInputValue = $('#searchInput').val();
        if (searchInputValue !== "") {
            let existingTerms = getCookie('communitySearchTerm');
            if (existingTerms !== "") {
                const termsArray = existingTerms.split(',');
                if (termsArray.indexOf(searchInputValue) === -1) {
                    existingTerms += ',' + searchInputValue;
                } else {
                    return; // 중복되면 함수 종료
                }
            } else {
                existingTerms = searchInputValue;
            }
            setCookie('communitySearchTerm', existingTerms, 365); // 365일 동안 쿠키 저장

        } else {
            event.preventDefault(); // 폼 제출 방지
            alert('검색어를 입력하세요.');
        }
    });

    function communitySearch(community) {
        $('#community').val(community);
        $('.form').submit();
    }
</script>
