<x-layout>

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
                                value="{{ $searchInput ?? old('searchInput') }}">

                            <img src="{{ asset('assets/media/btn_solid_delete.png') }}" alt="del" class="btn_del">
                            <button><img src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
                        </div>
                    </div>
                </form>

                <!-- tab : s -->
                <div class="tab_type_2 type_basic mt8">
                    <div class="swiper detail_tab">
                        <div class="swiper-wrapper menu">
                            <div class="swiper-slide active"><a onclick="community()">공톡 컨텐츠</a></div>
                            <div class="swiper-slide"><a onclick="community()">커뮤니티</a></div>
                        </div>
                    </div>
                </div>
                <!-- tab : s -->

                <div class="community_inner_wrap mt20">
                    <div class="list_sort_wrap">
                        <span>검색결과 154건</span>
                        <ul class="list_sort toggle_tab ">
                            <li class="active"><a href="#">최신순</a></li>
                            <li><a href="#">추천순</a></li>
                        </ul>
                    </div>


                    <!-- community list : s -->
                    <div class="community_list">
                        <li>
                            <span class="community_category">공톡 유튜브</span>
                            <a href="community_detail.html" class="community_list_link mt8">
                                <div class="community_row_wrap">

                                    <div class="community_row_body">
                                        <h3><span class="txt_point">공실앤톡 App</span> - 수익률 계산기 편 제목이 길어지면</h3>
                                        <div class="txt_item_1">공실앤톡 app 사용 방법 수익률 계산기편입니다. 부동산 수익률이 궁금할 때 공실앤톡 앱을
                                            통해서
                                        </div>
                                        <div class="txt_item_2 mt8">
                                            <span>2023.04.02 · </span>
                                            <span>추천 12 · </span>
                                            <span>댓글 278</span>
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
                        <li>
                            <span class="community_category">공톡 매거진</span>
                            <a href="community_detail.html" class="community_list_link mt8">
                                <div class="community_row_wrap">
                                    <div class="community_row_body">
                                        <h3><span class="txt_point">공실앤톡 App</span> - 수익률 계산기 편 제목이 길어지면</h3>
                                        <div class="txt_item_1">공실앤톡 app 사용 방법 수익률 계산기편입니다. 부동산 수익률이 궁금할 때 공실앤톡 앱을
                                            통해서
                                        </div>
                                        <div class="txt_item_2 mt8">
                                            <span>2023.04.02 · </span>
                                            <span>추천 12 · </span>
                                            <span>댓글 278</span>
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
                        <li>
                            <span class="community_category">자유글</span>
                            <a href="community_detail.html" class="community_list_link mt8">
                                <div class="community_row_wrap">
                                    <div class="community_row_body">
                                        <h3><span class="txt_point">공실앤톡 App</span> - 수익률 계산기 편 제목이 길어지면</h3>
                                        <div class="txt_item_1">공실앤톡 app 사용 방법 수익률 계산기편입니다. 부동산 수익률이 궁금할 때 공실앤톡 앱을
                                            통해서
                                        </div>
                                        <div class="txt_item_2 mt8">
                                            <span>2023.04.02 · </span>
                                            <span>추천 12 · </span>
                                            <span>댓글 278</span>
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
    // 쿠키에 저장하는 함수
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        const expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    // 저장 버튼 클릭 시 검색어를 쿠키에 저장하고 리스트에 추가
    $('#saveSearch').click(function() {
        const searchInputValue = $('#searchInput').val();
        if (searchInputValue !== "") {
            let existingTerms = getCookie('communitySearchTerm');
            if (existingTerms !== "") {
                existingTerms += ',' + searchInputValue;
            } else {
                existingTerms = searchInputValue;
            }
            setCookie('communitySearchTerm', existingTerms, 365); // 30일 동안 쿠키 저장

        } else {
            alert('검색어를 입력하세요.');
        }
    });
</script>
