<x-layout>

    <div class="body gray_body">
        <div class="community_wrap">
            <div class="community_area">
                <!-- community top : s -->
                <div class="community_inner_wrap">
                    <div class="header_bar">
                        <div>
                            <a href="community_contents_list.html"><img
                                    src="{{ asset('assets/media/header_btn_back.png') }}"></a>
                        </div>
                        <div>
                            <h4>게시글 검색</h4>
                        </div>
                        <div></div>
                    </div>
                </div>
                <!-- community top : e -->

                <!-- community body : s -->
                <div class="community_inner_wrap search_page">
                    <form class="form" method="GET" action="{{ route('www.community.search.list.view') }}">
                        @csrf
                        <div class="community_search_wrap flex_between">
                            <input type="text" id="searchInput" name="searchInput" placeholder="검색어를 입력해주세요.">
                            <img src="{{ asset('assets/media/btn_solid_delete.png') }}" alt="del" class="btn_del">
                            <button id="saveSearch">
                                <img src="{{ asset('assets/media/btn_search.png') }}" alt="검색">
                            </button>
                        </div>
                    </form>

                    <div class="flex_between mt20">
                        <div class="txt_point">최근 검색</div>
                        <button class="gray_basic" id="clearAll">전체 삭제</button>
                    </div>

                    <ul class="search_word_list mt8" id="searchList">

                    </ul>
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

    // 페이지 로드 시 저장된 검색어가 있으면 검색어 리스트에 표시
    $(document).ready(function() {
        const searchTerm = getCookie('communitySearchTerm');
        if (searchTerm !== "") {
            const searchTerms = searchTerm.split(',');
            $.each(searchTerms, function(index, value) {
                addSearchTermToList(value);
            });
        }
    });

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
            addSearchTermToList(searchInputValue);

        } else {
            event.preventDefault(); // 폼 제출 방지
            alert('검색어를 입력하세요.');
        }
    });

    // 검색어를 리스트에 추가하는 함수
    function addSearchTermToList(searchTerm) {
        var list = "<li class='search_item'>" +
            "<a href='javascript:void(0)' onclick='communitySearch(\"" + searchTerm + "\")' class='gray_deep'>" + searchTerm + "</a>"+
            "<button class='deleteBtn'>" +
            "<img src='{{ asset('assets/media/list_delete.png') }}' class='ic_16'>" +
            "</button>" +
            "</li>"
        $('#searchList').append(list);
    }

    // 삭제 버튼 클릭 시 해당 검색어 삭제
    $('#searchList').on('click', '.deleteBtn', function() {
        const termToRemove = $(this).closest('li').text().trim();
        removeSearchTermFromCookie(termToRemove);
        $(this).closest('li').remove();
    });

    // 쿠키에서 특정 검색어를 삭제하는 함수
    function removeSearchTermFromCookie(term) {
        let existingTerms = getCookie('communitySearchTerm');
        if (existingTerms !== "") {
            const termsArray = existingTerms.split(',');
            const index = termsArray.indexOf(term);
            if (index !== -1) {
                termsArray.splice(index, 1);
                const updatedTerms = termsArray.join(',');
                setCookie('communitySearchTerm', updatedTerms, 365); // 30일 동안 쿠키 저장
            }
        }
    }

    // 전체 삭제 버튼 클릭 시 모든 검색어 삭제
    $('#clearAll').click(function() {
        setCookie('communitySearchTerm', "", -1); // 쿠키 삭제
        $('#searchList').empty(); // 리스트 비우기
    });

    function communitySearch(searchTerm) {
        $('#searchInput').val(searchTerm);
        $('.form').submit();
    }
</script>
