<x-layout>

    <div class="body">

        @php
            $notToday = $_COOKIE['notToday'] ?? 'N';
        @endphp

        <!-- popup new : s -->
        <div class="only_pc">
            <div class="popup_area">
                @if (count($popups) > 0)
                    @foreach ($popups as $item)
                        @php
                            $notTodayId = $_COOKIE['notToday_' . $item->id] ?? 'N';
                        @endphp
                        @if ($notTodayId == 'N' || $notTodayId == null)
                            <div class="popup_div popup_div_{{ $item->id }}">
                                <div class="popup_img">
                                    <a href="{{ $item->url ?? route('www.main.main') }}"
                                        onclick="window.open(this.href, '_blank', 'width=800, height=600'); return false;">
                                        <div class="img_box"><img
                                                src="{{ Storage::url('image/' . $item->images[0]->path) }}">
                                        </div>
                                    </a>
                                </div>
                                <div class="popup_bottom">
                                    <span class="today_close" onclick="todayClosePopupEach({{ $item->id }});">오늘 하루
                                        보지 않기</span>
                                    <span class="close" onclick="closePopupEach({{ $item->id }});">닫기</span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        <!-- popup new : e -->

        <!-- popup : s -->
        @if (count($popups) > 0)
            @if ($notToday == 'N' || $notToday == null)
                <div class="only_m">
                    <div class="main_popup">
                        <div class="popup_wrap">
                            <div class="popup_bn_swiper">
                                <div class="swiper-wrapper"
                                    style="text-align: center; transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                                    @foreach ($popups as $item)
                                        @if (isset($item->images))
                                            <div class="swiper-slide swiper-slide-active">
                                                <a href="{{ $item->url ?? route('www.main.main') }}">
                                                    <div class="img_box" style="text-align:center; width:100%;">
                                                        <img style="height:100%;"
                                                            src="{{ Storage::url('image/' . $item->images[0]->path) }}"
                                                            onerror="this.src='{{ asset('assets/media/s_2.png') }}';"
                                                            alt="">
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                            <div class="popup_bottom">
                                <span class="today_close" onclick="todayClosePopup();">오늘 하루 보지 않기</span>
                                <span class="close" onclick="closePopup();">닫기</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <!-- popup : e -->

        <script>
            var popup_bn_swiper = new Swiper(".popup_bn_swiper", {
                slidesPerView: 1,
                pagination: {
                    el: ".popup_bn_swiper .swiper-pagination",
                    clickable: true,
                },
                // autoplay: {
                //     delay: 1800,
                //     stopOnLastSlide: false,
                //     disableOnInteraction: true,
                // },
                // breakpoints: {
                //     800: {
                //         slidesPerView: 1,
                //         spaceBetween: 1,
                //     },
                // },
            });
        </script>

        <!---------------------------------- only m : s ---------------------------------->
        <div class="m_main_body only_m">

            <!-- m::header bar : s -->
            <div class="m_main_header">
                <div class="left_area"><a href="{{ route('www.main.main') }}"><img
                            src="{{ asset('assets/media/header_logo.png') }}" class="m_header_logo" alt="공실앤톡 로고"></a>
                </div>
                <button class="main_btn_call" onclick="location.href='tel:1600-5734'">
                    <img src="{{ asset('assets/media/ic_phone.png') }}">1600-5734
                </button>

                <!-- <div class="right_area">
                    @guest
@else
    <a>
                                                                                                                                                                                            <div class="user_profileImg">
                                                                                                                                                                                                <div class="img_box"><img src="{{ asset('assets/media/default_user.png') }}"></div>
                                                                                                                                                                                            </div>
                                                                                                                                                                                        </a>
                    @endguest
                </div> -->
            </div>
            <!-- m::header bar : s -->

            <div class="m_inner_wrap m_main_wrap">
                <h4>어떤 매물을 찾고 계신가요?</h4>
                <div class="main_search flex_between">
                    <input type="text" id="search_input" name="search_input" placeholder="단지명, 동이름, 지하철역으로 검색"
                        autocomplete='off'>
                    <img src="{{ asset('assets/media/btn_solid_delete.png') }}" alt="del" class="btn_del"
                        style="display: none">
                    <button onclick="search_request()"><img src="{{ asset('assets/media/btn_org_search.png') }}"
                            alt="검색" class="main_btn_searh"></button>
                </div>
                <div class="search_open main_search_open" id="search_open_layer">
                    <div class="search_recent">
                        <div id="search_history">
                            <div class="txt_point">최근 검색</div>
                        </div>
                        <div class="side_search_list" id="history_search_list">
                        </div>

                        <div class="side_search_list" id="search_list">
                            {{-- <div class="side_search_no_row">최그 검색어가 없습니다.</div>
                            <div class="side_search_list_row"><a href="#">서울시 구로구 구로동</a> <button><img
                                        src="{{ asset('assets/media/list_delete.png') }}"></button></div>
                            <div class="side_search_list_row"><a href="#">서울시 구로구 구로동 735-26 (구로동교회)</a> <button><img
                                        src="{{ asset('assets/media/list_delete.png') }}"></button></div>
                            <div class="side_search_list_row"><a href="#">서울시 구로구 구로동 735-26 (구로동교회)</a> <button><img
                                        src="{{ asset('assets/media/list_delete.png') }}"></button></div>
                            <div class="side_search_list_row"><a href="#">서울시 <span>구로</span>구 구로동 735-26 (구로동교회)</a>
                            </div>
                            {{-- <div class="side_search_list_row"><a href="#">서울시 <span>구로</span>구 궁동</a></div> --}}
                            {{-- <div class="side_search_list_row"><a href="#">서울시 <span>구로</span>구 항동</a></div>
                            <div class="side_search_list_row"><a href="#">서울시 <span>구로</span>구 고척동</a></div> --}}
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        loadSearchTerms();
                    });

                    function loadSearchTerms() {
                        $('#history_search_list').empty();
                        const searchTerm = getCookie('mapSearchTerm');
                        if (searchTerm !== "") {
                            const searchTerms = JSON.parse(searchTerm);
                            if (searchTerms.length > 0) {
                                $.each(searchTerms, function(index, value) {
                                    const term = JSON.parse(value);
                                    addSearchTermToList(term);
                                });
                            } else {
                                $('#history_search_list').append('<div class="side_search_no_row">최근 검색어가 없습니다.</div>');
                            }
                        } else {
                            $('#history_search_list').append('<div class="side_search_no_row">최근 검색어가 없습니다.</div>');
                        }
                    }

                    // 검색어를 리스트에 추가하는 함수
                    function addSearchTermToList(term) {
                        const lat = term.lat;
                        const lng = term.lng;
                        const name = term.name;
                        var list = `
            <div class="side_search_list_row">
                <a onclick="search_click('${lat}', '${lng}', '${name}')">${name}</a>
                <button class="deleteBtn">
                    <img src="{{ asset('assets/media/list_delete.png') }}">
                </button>
            </div>`;
                        $('#history_search_list').append(list);
                    }

                    // 삭제 버튼 클릭 시 해당 검색어 삭제
                    $('#history_search_list').on('click', '.deleteBtn', function() {
                        const termToRemove = $(this).closest('.side_search_list_row').find('a').text().trim();
                        removeSearchTermFromCookie(termToRemove);
                        $(this).closest('.side_search_list_row').remove();
                    });

                    // 쿠키에서 특정 검색어를 삭제하는 함수
                    function removeSearchTermFromCookie(term) {
                        let existingTerms = getCookie('mapSearchTerm');
                        if (existingTerms !== "") {
                            let termsArray = JSON.parse(existingTerms);
                            termsArray = termsArray.filter(item => JSON.parse(item).name !== term);
                            setCookie('mapSearchTerm', JSON.stringify(termsArray), 365); // 365일 동안 쿠키 저장
                        }
                    }

                    $('#search_input').on('keyup', function() {
                        $('#search_list').empty();
                        var search = $(this).val();
                        if (search == '') {
                            $('#search_history').show();
                            $('#history_search_list').show();
                            return;
                        }
                        $('#search_history').hide();
                        $('#history_search_list').hide();
                        if (search != '') {
                            $.ajax({
                                url: "{{ route('api.search.address') }}",
                                type: "post",
                                data: {
                                    'search': search
                                },
                                success: function(data, status, xhr) {
                                    $('#search_list').empty();
                                    var subwayList = data.result['subwayList'];
                                    var regionList = data.result['regionList'];
                                    var productList = data.result['productList'];
                                    subwayList.forEach(function(item, index) {
                                        var name = item.subway_name + ' ' + `[${item.line}]`;
                                        var Sname = getSearchContent(search, name);
                                        var list_row = `
                            <div class="side_search_list_row" onclick="search_click('${item.y}', '${item.x}', '${name}')">
                                <a>${Sname}</a>
                            </div>`;
                                        $('#search_list').append(list_row);
                                    });
                                    regionList.forEach(function(item, index) {
                                        var name = item.sido + ' ' + item.sigungu + ' ' + item.dong;
                                        var Sname = getSearchContent(search, name);
                                        var list_row = `
                            <div class="side_search_list_row" onclick="search_click('${item.address_lat}', '${item.address_lng}', '${name}')">
                                <a>${Sname}</a>
                            </div>`;
                                        $('#search_list').append(list_row);
                                    });
                                    productList.forEach(function(item, index) {
                                        var name = item.kaptName;
                                        var Sname = getSearchContent(search, name);
                                        var list_row = `
                        <div class="side_search_list_row" onclick="search_click('${item.y}', '${item.x}', '${name}')">
                            <a>${Sname}</a>
                        </div>`;
                                        $('#search_list').append(list_row);
                                    });
                                },
                                error: function(xhr, status, e) {}
                            });
                        }
                    });

                    // 위치 조정
                    function search_click(lat, lng, name) {
                        $('#search_open_layer').css('display', 'none');
                        $('.btn_del').css('display', 'inline-block');

                        const searchInputValue = name;
                        if (searchInputValue !== "") {
                            let existingTerms = getCookie('mapSearchTerm');
                            let newTerm = JSON.stringify({
                                name: searchInputValue,
                                lat: lat,
                                lng: lng
                            });

                            if (existingTerms !== "") {
                                let termsArray = JSON.parse(existingTerms);
                                if (!termsArray.some(term => JSON.parse(term).name === searchInputValue)) {
                                    termsArray.push(newTerm);
                                    setCookie('mapSearchTerm', JSON.stringify(termsArray), 365); // 365일 동안 쿠키 저장
                                }
                            } else {
                                let termsArray = [newTerm];
                                setCookie('mapSearchTerm', JSON.stringify(termsArray), 365); // 365일 동안 쿠키 저장
                            }
                        }
                        loadSearchTerms();
                        location.href = "{{ route('www.map.mobile') }}" + "?lat=" + lat + "&lng=" + lng + "&zoom=16" + "&search_name=" + name;
                    }

                    function setCookie(cname, cvalue, exdays) {
                        const d = new Date();
                        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                        let expires = "expires=" + d.toUTCString();
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
                </script>

                <div class="bn_group_1_wrap">
                    @guest
                        <div class="bn_item_1"
                            onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'">
                            <div>
                                <div class="bn_txt">전국지식산업센터 · 사무실 · 상가</div>
                                <div class="bn_tit"><span>30초</span> 만에<br>부동산 매물 찾기</div>
                                <div><button>AI 매물 검색 <img src="{{ asset('assets/media/ic_btn_arrow.png') }}"
                                            class=""></button></div>
                            </div>
                            <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_1.png') }}"></div>
                        </div>
                    @else
                        @if (Auth::guard('web')->user()->phone == null)
                            <div class="bn_item_1" onclick="modal_open('add_info')">
                                <div>
                                    <div class="bn_txt">전국지식산업센터 · 사무실 · 상가</div>
                                    <div class="bn_tit"><span>30초</span> 만에<br>부동산 매물 찾기</div>
                                    <div><button>AI 매물 검색 <img src="{{ asset('assets/media/ic_btn_arrow.png') }}"
                                                class=""></button></div>
                                </div>
                                <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_1.png') }}"></div>
                            </div>
                        @else
                            <div class="bn_item_1"
                                onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'">
                                <div>
                                    <div class="bn_txt">전국지식산업센터 · 사무실 · 상가</div>
                                    <div class="bn_tit"><span>30초</span> 만에<br>부동산 매물 찾기</div>
                                    <div><button>AI 매물 검색 <img src="{{ asset('assets/media/ic_btn_arrow.png') }}"
                                                class=""></button></div>
                                </div>
                                <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_1.png') }}"></div>
                            </div>
                        @endif
                    @endguest
                    <div class="bn_group_2_wrap">
                        @guest
                            <div class="bn_item_2"
                                onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'">
                                <div class="bn_txt_item">
                                    <div class="bn_tit">구하기</div>
                                    <div class="bn_txt">맞춤 제안서 받기</div>
                                </div>
                                <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_2.png') }}"></div>
                            </div>
                        @else
                            @if (Auth::guard('web')->user()->phone == null)
                                <div class="bn_item_2" onclick="modal_open('add_info')">
                                    <div class="bn_txt_item">
                                        <div class="bn_tit">구하기</div>
                                        <div class="bn_txt">맞춤 제안서 받기</div>
                                    </div>
                                    <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_2.png') }}"></div>
                                </div>
                            @else
                                <div class="bn_item_2"
                                    onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'">
                                    <div class="bn_txt_item">
                                        <div class="bn_tit">구하기</div>
                                        <div class="bn_txt">맞춤 제안서 받기</div>
                                    </div>
                                    <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_2.png') }}"></div>
                                </div>
                            @endif
                        @endguest
                        @guest
                            <div class="bn_item_2" onclick="location.href='{{ route('www.corp.product.create.view') }}'">
                                <div class="bn_txt_item">
                                    <div class="bn_tit">내놓기</div>
                                    <div class="bn_txt">내 매물 등록하기</div>
                                </div>
                                <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_3.png') }}"></div>
                            </div>
                        @else
                            @if (Auth::guard('web')->user()->type == 0)
                                @if (Auth::guard('web')->user()->phone == null)
                                    <div class="bn_item_2" onclick="modal_open('add_info')">
                                        <div class="bn_txt_item">
                                            <div class="bn_tit">내놓기</div>
                                            <div class="bn_txt">내 매물 등록하기</div>
                                        </div>
                                        <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_3.png') }}"></div>
                                    </div>
                                @else
                                    <div class="bn_item_2"
                                        onclick="location.href='{{ route('www.product.create.view') }}'">
                                        <div class="bn_txt_item">
                                            <div class="bn_tit">내놓기</div>
                                            <div class="bn_txt">내 매물 등록하기</div>
                                        </div>
                                        <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_3.png') }}"></div>
                                    </div>
                                @endif
                            @else
                                <div class="bn_item_2"
                                    onclick="location.href='{{ route('www.corp.product.create.view') }}'">
                                    <div class="bn_txt_item">
                                        <div class="bn_tit">내놓기</div>
                                        <div class="bn_txt">내 매물 등록하기</div>
                                    </div>
                                    <div class="bn_img"><img src="{{ asset('assets/media/m_bn_img_3.png') }}"></div>
                                </div>
                            @endif
                        @endguest
                    </div>
                </div>

                <div class="bn_group_3_wrap">
                    <div class="bn_item_3 bg_1" onclick="location.href='{{ route('www.map.mobile') }}'">
                        <div class="bn_tit">
                            <span>매물·실거래가</span><br>지도 검색
                        </div>
                        <div class="bn_txt">원하는 정보, 한번에<br>알아보기</div>
                    </div>
                    <div class="bn_item_3 bg_2" onclick="location.href='{{ route('www.site.product.list.view') }}'">
                        <div class="bn_tit">
                            <span>실시간</span> 분양 현장
                        </div>
                        <div class="bn_txt">전국 지식산업센터<br>분양 현장 알아보기</div>
                    </div>

                </div>


                <!-- <div class="m_main_bn_1">
                    <a href="{{ route('www.mypage.proposal.list.view') }}">
                        <div>
                            <h1>AI기반<br>매물 매칭 시스템</h1>
                            <p>전국 지식산업센터,<br>30초만에 매물 제안 받으세요.</p>
                        </div>
                    </a>
                </div>

                <div class="m_main_bn_2">
                    <a href="{{ route('www.map.mobile') }}"><img src="{{ asset('assets/media/main_bn_2.png') }}"
                            alt="매물 지도"></a>
                    <a href="{{ route('www.site.product.list.view') }}"><img
                            src="{{ asset('assets/media/main_bn_3.png') }}" alt="분양 현장"></a>
                </div>

                <div class="m_main_bn_3">
                    <a href="{{ route('www.map.mobile') }}">
                        <span>구하기</span> <img src="{{ asset('assets/media/ic_arrow_more.png') }}">
                        <p>공간을 구하고 있어요.</p>
                    </a>
                    <span class="v_line"></span>
                    <a href="{{ route('www.product.create.view') }}">
                        <span>내놓기</span> <img src="{{ asset('assets/media/ic_arrow_more.png') }}">
                        <p>여기 공실이 있어요.</p>
                    </a>
                </div>-->

                <div class="swiper m_main_bn_4">
                    <div class="swiper-wrapper">
                        @foreach ($banner_bottom as $bottom)
                            <div class="swiper-slide">
                                <a @if ($bottom->url != '') href='{{ $bottom->url }}' @endif>
                                    <img src="{{ Storage::url('image/' . $bottom->images[0]->path) }}">
                                </a>
                            </div>
                        @endforeach
                        {{-- <div class="swiper-slide"><img src="{{ asset('assets/media/main_slide_bn_1.png') }}"></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/media/main_slide_bn_1.png') }}"></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/media/main_slide_bn_1.png') }}"></div> --}}
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <script>
                    var m_main_bn_4 = new Swiper(".m_main_bn_4", {
                        pagination: {
                            el: ".swiper-pagination",
                        },
                    });
                </script>


            </div>
            <!-- <div class="cs_bn">
                <a href="{{ route('www.consulting.create.view') }}">
                    <button>
                        <img src="{{ asset('assets/media/quick_bn_3.png') }}">
                        <p>상담문의</p>
                    </button>
                </a>
                <button onclick="location.href='tel:1600-5734' ">
                    <img src="{{ asset('assets/media/ic_point_call.png') }}">
                    <p>1600-5734</p>
                </button>
            </div> -->

        </div>
        <!-- nav : s -->
        <x-nav-layout />
        <!-- nav : e -->
        <!---------------------------------- only m : e ---------------------------------->

        <!---------------------------------- only pc : s ---------------------------------->
        <div class="only_pc">
            <div class="right_side_wrap">
                <div class="right_side">
                    @guest
                        <button class="quick_bn" onclick="location.href='{{ route('www.product.create.view') }}' ">
                            <img src="{{ asset('assets/media/ic_org_estate.png') }}">
                            <p>매물 내놓기</p>
                        </button>
                    @else
                        @if (Auth::guard('web')->user()->type == 0)
                            @if (Auth::guard('web')->user()->phone == null)
                                <button class="quick_bn" onclick="modal_open('add_info')">
                                    <img src="{{ asset('assets/media/ic_org_estate.png') }}">
                                    <p>매물 내놓기</p>
                                </button>
                            @else
                                <button class="quick_bn"
                                    onclick="location.href='{{ route('www.product.create.view') }}' ">
                                    <img src="{{ asset('assets/media/ic_org_estate.png') }}">
                                    <p>매물 내놓기</p>
                                </button>
                            @endif
                        @else
                            <button class="quick_bn"
                                onclick="location.href='{{ route('www.corp.product.create.view') }}' ">
                                <img src="{{ asset('assets/media/ic_org_estate.png') }}">
                                <p>매물 내놓기</p>
                            </button>
                        @endif
                    @endguest
                    @guest
                        <button class="quick_bn"
                            onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}' ">
                            <img src="{{ asset('assets/media/btn_point_search.png') }}">
                            <p>매물 구하기</p>
                        </button>
                    @else
                        @if (Auth::guard('web')->user()->phone == null)
                            <button class="quick_bn" onclick="modal_open('add_info')">
                                <img src="{{ asset('assets/media/btn_point_search.png') }}">
                                <p>매물 구하기</p>
                            </button>
                        @else
                            <button class="quick_bn"
                                onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}' ">
                                <img src="{{ asset('assets/media/btn_point_search.png') }}">
                                <p>매물 구하기</p>
                            </button>
                        @endif
                    @endguest
                    <a href="{{ route('www.consulting.create.view') }}">
                        <button class="quick_bn">
                            <img src="{{ asset('assets/media/quick_bn_3.png') }}">
                            <p>상담문의</p>
                        </button>
                    </a>
                    <button class="quick_bn" onclick="location.href='tel:1600-5734' ">
                        <img src="{{ asset('assets/media/ic_point_call.png') }}">
                        <p>1600-5734</p>
                    </button>
                </div>
            </div>
            <!-- section 1 : s -->
            <section class="section_1">
                <div class="swiper main_1">
                    <div class="swiper-wrapper">
                        @php
                            $banner_title = [];
                            foreach ($banner_main as $item) {
                                array_push($banner_title, $item->title);
                                // $banner_title[] = $item->title;
                            }
                        @endphp
                        @foreach ($banner_main as $item)
                            <div class="swiper-slide">
                                <div class="txt_area">
                                    <div class="main_1_tit">{!! nl2br($item->name) !!}</div>
                                    <div class="main_1_sub">{!! nl2br($item->content) !!}</div>
                                    <button onclick="location.href='{{ $item->url }}' ">더 알아보기</button>
                                </div>
                                <div class="img_box">
                                    @if (count($item->images) > 0)
                                        <img src="{{ Storage::url('image/' . $item->images[0]->path) }}"
                                            onerror="this.src='{{ asset('assets/media/main_s1_1.png') }}';">
                                    @else
                                        <img src="{{ asset('assets/media/main_s1_1.png') }}">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="btn_arrow_wrap">
                        <div class="swiper-button-next"><img src="{{ asset('assets/media/arrow_w_next.png') }}">
                        </div>
                        <div class="swiper-button-prev"><img src="{{ asset('assets/media/arrow_w_prev.png') }}">
                        </div>
                    </div>

                    <div class="swiper-pagination_wrap">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
            <script>
                var bullet = @json($banner_title);
                var main_1 = new Swiper(".main_1", {
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    pagination: {
                        el: '.main_1 .swiper-pagination',
                        clickable: true,
                        renderBullet: function(index, className) {
                            return '<div class="' + className + '"><span>' + (bullet[index]) + '</span></div>';
                        }
                    },
                });
            </script>
            <!-- section 1 : e -->


            <!-- section 2 : s -->
            {{--  최대 5개 --}}
            <section class="section_2">
                <div class="section_2_wrap">
                    <div class="main_2_wrap">

                        <div class="main_2">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($banner_service as $key => $item)
                                        <div class="swiper-slide">
                                            <p class="txt_item_1">{{ sprintf('%02d', $key + 1) }}</p>
                                            <p class="txt_item_1">{{ $item->title }}</p>
                                            <p class="txt_item_2">{!! nl2br($item->content) !!}</p>
                                            <button onclick="location.href='{{ $item->url }}' ">서비스
                                                바로가기</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="main_2_btn">
                                <div class="swiper-button-prev"><img
                                        src="{{ asset('assets/media/bn_arrow_prev.png') }}" alt="">
                                </div>
                                <div class="swiper-button-next"><img
                                        src="{{ asset('assets/media/bn_arrow_next.png') }}" alt="">
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>


                        <div class="main_2_img">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($banner_service as $item)
                                        <div class="swiper-slide">
                                            @if (count($item->images) > 0)
                                                <img src="{{ Storage::url('image/' . $item->images[0]->path) }}"
                                                    onerror="this.src='{{ asset('assets/media/screen_1.png') }}';">
                                            @else
                                                <img src="{{ asset('assets/media/screen_1.png') }}" alt="">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <script>
                var main_2 = new Swiper('.main_2 .swiper-container', {
                    effect: 'fade',
                    navigation: {
                        nextEl: '.main_2 .swiper-button-next',
                        prevEl: '.main_2 .swiper-button-prev',
                    },
                    pagination: {
                        el: '.main_2 .swiper-pagination',
                        type: "fraction",
                        clickable: true,
                    },
                });
                var main_2_img = new Swiper('.main_2_img .swiper-container', {
                    navigation: {
                        nextEl: '.main_2 .swiper-button-next',
                        prevEl: '.main_2 .swiper-button-prev',
                    },
                });
            </script>
            <!-- section 2 : e -->

            <!-- section 7 : s -->
            <section class="section_property">
                <div class="inner_wrap">
                    <div class="txt_item_1">어떤 매물을 찾으시나요?</div>
                    <div class="txt_item_2">원하시는 부동산을 찾아보세요.</div>
                    <a href="{{ route('www.mypage.user.offer.first.create.view') }}">
                        <ul class="property_img_wrap">
                            <li class="active">사무실</li>
                            <li>공장/창고</li>
                            <li>건물</li>
                            <li>상가</li>
                        </ul>
                    </a>
                </div>
            </section>
            <script>
                $(document).ready(function() {
                    $('.property_img_wrap li').hover(function() {
                        $(this).addClass('active').siblings().removeClass('active');
                    });
                });
            </script>
            <!-- section 7 : e -->

            <!-- section 4 : s -->
            <section class="section_4">
                <div class="inner_wrap">
                    <div class="txt_item_1">공간은 공간 전문가에게</div>
                    <div class="txt_item_2">
                        지금 상담을 신청하고 우리 회사에 꼭 맞는 공간을 완성해보세요.<br>
                        #무료 3D도면 제공 #퍼시스가구 #합리적 가격 #데스커가구 #기업전용서비스
                    </div>
                    <div class="con_box_wrap">
                        <div class="con_box">
                            <img src="{{ asset('assets/media/cst_img_1.png') }}" alt="">
                            <div class="con_w_box">
                                <p class="box_item_1">오피스 인테리어</p>
                                <div class="box_item_2">기업의 규모와 관계 없이 무료 3D도면을 제공<br>드리며, 회사의 정체성을 담은 완성도
                                    높고<br>책임감 있는
                                    설계와
                                    공사를 진행합니다.</div>
                                <div class="tag_area">
                                    <span class="txt_tag">#무료 3D도면 제공</span>
                                </div>
                                <a href="https://xn--s39awro00dcgl.com/portfolio?category=666C5Dz078"
                                    onclick="window.open(this.href, '_blank', 'width=800, height=600'); return false;">
                                    <button>자세히보기</button>
                                </a>
                            </div>


                        </div>

                        <div class="con_box">
                            <img src="{{ asset('assets/media/cst_img_2.png') }}" alt="">
                            <div class="con_w_box">
                                <p class="box_item_1">퍼시스 가구</p>
                                <div class="box_item_2">국내 사무가구 1위 브랜드, 퍼시스(FURSYS)<br>가구와 모든 서비스를 합리적인 단가로
                                    제공<br>받으실 수
                                    있습니다.</div>
                                <div class="tag_area">
                                    <span class="txt_tag">#퍼시스 가구</span>
                                    <span class="txt_tag">#합리적인 가격</span>
                                </div>
                                <a href="https://xn--s39awro00dcgl.com/portfolio?category=54K087K540"
                                    onclick="window.open(this.href, '_blank', 'width=800, height=600'); return false;">
                                    <button>자세히보기</button>
                                </a>
                            </div>
                        </div>

                        <div class="con_box">
                            <img src="{{ asset('assets/media/cst_img_3.png') }}" alt="">
                            <div class="con_w_box">
                                <p class="box_item_1">데스커 가구</p>
                                <div class="box_item_2">본질에 집중하고, 깔끔한 디자인의 데스커<br>(DESKER)입니다. 데스커 기업전용
                                    서비스를<br>데스커 공식
                                    에이트에게 받으실 수 있습니다.</div>
                                <div class="tag_area">
                                    <span class="txt_tag">#데스커 가구</span>
                                    <span class="txt_tag">#기업전용 서비스</span>
                                </div>
                                <a href="https://xn--s39awro00dcgl.com/portfolio?category=726406uT5e"
                                    onclick="window.open(this.href, '_blank', 'width=800, height=600'); return false;">
                                    <button>자세히보기</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- QA-64 디자인 변경 필요 --}}
                <div class="con_box_wrap">
                    <a href='https://xn--s39awro00dcgl.com/portfolio'
                        onclick="window.open(this.href, '_blank', 'width=800, height=600'); return false;">
                        <button class="btn_black_ghost btn_basic">
                            더 많은 사례 확인하기
                        </button>
                    </a>

                    <a href="{{ route('www.interior.estimate.create.view') }}">
                        <button class="btn_point btn_basic">
                            공간 컨설팅 신청하기
                        </button>
                    </a>
                </div>

            </section>
            <!-- section 4 : e -->


            <!-- section 3 : s -->
            <section class="section_3">
                <!-- <span>누적 이용 사용자 수 12345</span> -->
                <div class="swiper noticeSwiper">
                    <div class="swiper-wrapper">
                        @foreach ($banner_text as $item)
                            <div class="swiper-slide">
                                <span>
                                    <img src="{{ asset('assets/media/ic_quotes_1.png') }}">
                                    {{ $item->title }}
                                    <img src="{{ asset('assets/media/ic_quotes_1.png') }}" class="img_rotate">
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <script>
                var noticeSwiper = new Swiper(".noticeSwiper", {
                    spaceBetween: 22,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                    },
                    speed: 5000,
                    loop: true,
                    direction: 'vertical',
                    loopAdditionalSlides: 1,
                    autoHeight: true,
                });
            </script>
            <!-- section 3 : e -->

            <!-- section 10 : s -->
            <section class="section_10">
                <div class="inner_wrap">
                    <div class="txt_item_1">퍼시스와 함께한 공간 컨설팅,<br>다양한 납품 사례가 증명합니다</div>
                    <div class="txt_item_2">
                        다양한 고객들의 니즈와 오피스의 컨설팅 사례들,<br>그 모든 니즈를 채워줄 수 있는 토탈 서비스를 <span>무료</span>로 제공합니다.
                    </div>

                    <ul class="brand_wrap">
                        <li><img src="{{ asset('assets/media/brand_01.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_02.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_03.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_04.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_05.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_06.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_07.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_08.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_09.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_10.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_11.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_12.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_13.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_14.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_15.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_16.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_17.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_18.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_19.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_20.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_21.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_22.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_23.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_24.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_25.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_26.png') }}"></li>
                        <li><img src="{{ asset('assets/media/brand_27.png') }}"></li>
                    </ul>
                </div>

            </section>
            <!-- section 10 : e -->


            <!-- section 6 : s -->
            <!--  <section class="section_review">
                <p class="txt_item_1">기업이 인정하는 공실앤톡</p>
                <div class="swiper reviewSwiper" dir="ltr">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <h1>솔직히 반신반의 했는데, 이보다 더 좋은 부동산 서비스 찾기도 힘들어요.</h1>
                            <p>전담 매니저들이 건물 이슈, 사무 공간 관리까지 맡아 알아서 해주기 때문에 확실히 좋은 더
                                서비스를 받는다는 느낌이 듭니다. 솔직히 부동산 관리하기가 이 서류 챙기고, 저 서류
                                챙기고… 나중에 찾으려고 하면 없고. 이런 저런 불편함이 많았는데, 이렇게 매물 자체를
                                등록해놓고 한번에 관리하니까 얼마나 편한지 몰라요!!</p>
                            <div class="bottom_wrap">
                                <div class="review_star">★★★★★</div>
                                <div class="review_user_info">홍*동님 | 2023.04.08</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <h1>매물 관리는 공실앤톡 하나로 끝나요!</h1>
                            <p>전담 매니저들이 건물 이슈, 사무 공간 관리까지 맡아 알아서 해주기 때문에 확실히 좋은 더
                                서비스를 받는다는 느낌이 듭니다. 솔직히 부동산 관리하기가 이 서류 챙기고, 저 서류
                                챙기고… 나중에 찾으려고 하면 없고. 이런 저런 불편함이 많았는데, 이렇게 매물 자체를
                                등록해놓고 한번에 관리하니까 얼마나 편한지 몰라요!!</p>
                            <div class="bottom_wrap">
                                <div class="review_star">★★★★★</div>
                                <div class="review_user_info">홍*동님 | 2023.04.08</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <h1>솔직히 반신반의 했는데, 이보다 더 좋은 부동산 서비스 찾기도 힘들어요.</h1>
                            <p>전담 매니저들이 건물 이슈, 사무 공간 관리까지 맡아 알아서 해주기 때문에 확실히 좋은 더
                                서비스를 받는다는 느낌이 듭니다. 솔직히 부동산 관리하기가 이 서류 챙기고, 저 서류
                                챙기고… 나중에 찾으려고 하면 없고. 이런 저런 불편함이 많았는데, 이렇게 매물 자체를
                                등록해놓고 한번에 관리하니까 얼마나 편한지 몰라요!!</p>
                            <div class="bottom_wrap">
                                <div class="review_star">★★★★★</div>
                                <div class="review_user_info">홍*동님 | 2023.04.08</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <h1>매물 관리는 공실앤톡 하나로 끝나요!</h1>
                            <p>전담 매니저들이 건물 이슈, 사무 공간 관리까지 맡아 알아서 해주기 때문에 확실히 좋은 더
                                서비스를 받는다는 느낌이 듭니다. 솔직히 부동산 관리하기가 이 서류 챙기고, 저 서류
                                챙기고… 나중에 찾으려고 하면 없고. 이런 저런 불편함이 많았는데, 이렇게 매물 자체를
                                등록해놓고 한번에 관리하니까 얼마나 편한지 몰라요!!</p>
                            <div class="bottom_wrap">
                                <div class="review_star">★★★★★</div>
                                <div class="review_user_info">홍*동님 | 2023.04.08</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <h1>이보다 더 좋은 부동산 서비스 찾기도 힘들어요.</h1>
                            <p>솔직히 부동산 관리하기가 이 서류 챙기고, 저 서류
                                챙기고… 나중에 찾으려고 하면 없고. 이런 저런 불편함이 많았는데, 이렇게 매물 자체를
                                등록해놓고 한번에 관리하니까 얼마나 편한지 몰라요!!</p>
                            <div class="bottom_wrap">
                                <div class="review_star">★★★★★</div>
                                <div class="review_user_info">홍*동님 | 2023.04.08</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <h1>매물 관리는 공실앤톡 하나로 끝나요!</h1>
                            <p>전담 매니저들이 건물 이슈, 사무 공간 관리까지 맡아 알아서 해주기 때문에 확실히 좋은 더
                                서비스를 받는다는 느낌이 듭니다. 솔직히 부동산 관리하기가 이 서류 챙기고, 저 서류
                                챙기고… 나중에 찾으려고 하면 없고. 이런 저런 불편함이 많았는데, 이렇게 매물 자체를
                                등록해놓고 한번에 관리하니까 얼마나 편한지 몰라요!!</p>
                            <div class="bottom_wrap">
                                <div class="review_star">★★★★★</div>
                                <div class="review_user_info">홍*동님 | 2023.04.08</div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <h1>이제 정착하네요.</h1>
                            <p>전담 매니저들이 건물 이슈, 사무 공간 관리까지 맡아 알아서 해주기 때문에 확실히 좋은 더
                                서비스를 받는다는 느낌이 듭니다. 솔직히 부동산 관리하기가 이 서류 챙기고, 저 서류
                                챙기고… 나중에 찾으려고 하면 없고. 이런 저런 불편함이 많았는데, 이렇게 매물 자체를
                                등록해놓고 한번에 관리하니까 얼마나 편한지 몰라요!!</p>
                            <div class="bottom_wrap">
                                <div class="review_star">★★★★★</div>
                                <div class="review_user_info">홍*동님 | 2023.04.08</div>
                            </div>
                        </div>
                        <div class="swiper-slide">Slide 8</div>
                    </div>
                </div>
            </section>   -->
            <script>
                var reviewSwiper = new Swiper(".reviewSwiper", {
                    spaceBetween: 22,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                    },
                    speed: 5000,
                    loop: true,
                    loopAdditionalSlides: 1,
                    slidesPerView: 5,
                    autoHeight: true,
                });
            </script>
            <!-- section 6 : e -->

            <!-- section 5 : s -->
            <section class="section_extra_service">
                <h1>공실앤톡 부가서비스 혜택까지,<br>다양하게 경험해보세요</h1>
                <div class="swiper ex_serviceSwiper">
                    <div class="swiper-wrapper">
                        @php
                            $banner_title = [];
                            foreach ($banner_extra_service as $item) {
                                array_push($banner_title, $item->title);
                                // $banner_title[] = $item->title;
                            }
                        @endphp
                        @foreach ($banner_extra_service as $item)
                            <div class="swiper-slide">
                                <div class="ex_service_container">
                                    <div class="txt_item_1">{{ $item->title }}</div>
                                    <div class="txt_item_2">{!! nl2br($item->content) !!}</div>
                                    <button onclick="location.href='{{ $item->url }}' ">서비스 바로가기</button>
                                </div>
                                <div class="img_box">
                                    @if (count($item->images) > 0)
                                        <img src="{{ Storage::url('image/' . $item->images[0]->path) }}"
                                            onerror="this.src='{{ asset('assets/media/s_9.png') }}';">
                                    @else
                                        <img src="{{ asset('assets/media/s_9.png') }}">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination_wrap">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
            <script>
                var bullet = @json($banner_title);;
                var ex_serviceSwiper = new Swiper(".ex_serviceSwiper", {
                    touchRatio: 0,
                    pagination: {
                        el: '.ex_serviceSwiper .swiper-pagination',
                        clickable: true,
                        renderBullet: function(index, className) {
                            return '<div class="' + className + '"><span>' + (bullet[index]) + '</span></div>';
                        }
                    },
                });
            </script>
            <!-- section 5 : e -->



            <!-- section 8 : s -->
            @if ($app_download)
                <section class="section_download">
                    <div class="inner_wrap">
                        <div class="main_download_wrap">
                            <div class="download_info_wrap">
                                <p class="txt_item_1">더욱 편리하게<br>앱을 이용해보세요.</p>
                                <p class="txt_item_2">언제 어디서나 공실앤톡을 이용해 보세요.</p>
                                <div class="main_download_btn">
                                    <button class="btn_point btn_basic"
                                        onclick="location.href='https://play.google.com/store/apps/details?id=com.gsntalk'"><img
                                            src="{{ asset('assets/media/ic_download_aos.png') }}">안드로이드</button>
                                    <button class="btn_point btn_basic"
                                        onclick="location.href='https://apps.apple.com/kr/app/%EA%B3%B5%EC%8B%A4%EC%95%A4%ED%86%A1-%EC%A7%80%EC%8B%9D%EC%82%B0%EC%97%85%EC%84%BC%ED%84%B0-%EC%82%AC%EB%AC%B4%EC%8B%A4-%EA%B3%B5%EC%9E%A5-%EC%83%81%EA%B0%80-%EA%B3%B5%EC%8B%A4%EA%B4%80%EB%A6%AC/id6593676137'"><img
                                            src="{{ asset('assets/media/ic_download_ios.png') }}">아이폰</button>
                                </div>
                            </div>
                            <div><img src="{{ Storage::url('image/' . $app_download->images[0]->path) }}"
                                    class="download_img">
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <!-- section 8 : e -->



            <!-- section 9 : s -->
            <section class="section_join">
                <div class="item_box">
                    <h1>중개사 모집</h1>
                    <p>공실앤톡 파트너스 중개사가 되어 부동산 광고를 직접 경험해 보세요.</p>
                    <button class="btn_point btn_basic"
                        onclick="location.href='{{ route('www.register.corp.register.view') }}'">공인중개사
                        회원가입</button>
                </div>
                {{--  카카오톡 상담으로 연결 --}}
                <div class="item_box">
                    <h1>부동산 전속계약 및 제휴 문의</h1>
                    <p>공실앤톡과 업무 협약 및 제휴, 부동산 전속계약 체결을 원하는 업체는 아래로 신청해주세요.</p>
                    <a href="{{ route('www.consulting.create.view') }}">
                        <button class="btn_point btn_basic">제휴 및 전속계약 문의</button>
                    </a>
                </div>
            </section>
            <!-- section 9 : e -->

        </div>
        <!---------------------------------- only pc : e ---------------------------------->


    </div>


</x-layout>


<script>
    var today = getCookie('notToday');
    if (today == 'Y') {
        $(".main_popup").css({
            display: "none"
        });
    }

    // 하루동안 닫기
    function todayClosePopup() {
        setCookie('notToday', 'Y', 1);

        $(".main_popup").css({
            display: "none"
        });
    }

    // 그냥 닫기
    function closePopup(element) {
        $(".main_popup").css({
            display: "none"
        });
    }

    // pc 팝업 하루동안 닫기
    function todayClosePopupEach(id) {
        setCookie('notToday_' + id, 'Y', 1);

        $(".popup_div_" + id).css({
            display: "none"
        });
    }
    // pc 팝업 닫기
    function closePopupEach(id) {
        $(".popup_div_" + id).css({
            display: "none"
        });
    }

    // 쿠키 만들기
    function setCookie(name, value, expiredays) {
        var todayDate = new Date();
        todayDate = new Date(parseInt(todayDate.getTime() / 86400000) * 86400000 + 54000000);

        if (todayDate > new Date()) {
            expiredays = expiredays - 1;
        }

        todayDate.setDate(todayDate.getDate() + expiredays);

        document.cookie = name + '=' + escape(value) + '; path=/; expires=' + todayDate.toGMTString() + ';'
    }

    // 쿠키 가져오기
    function getCookie(name) {
        var cName = name + "=";
        var x = 0;
        var i = 0;
        while (i <= document.cookie.length) {
            var y = (x + cName.length);
            if (document.cookie.substring(x, y) == cName) {
                if ((endOfCookie = document.cookie.indexOf(";", y)) == -1)
                    endOfCookie = document.cookie.length;
                return unescape(document.cookie.substring(y, endOfCookie));
            }
            x = document.cookie.indexOf(" ", x) + 1;
            if (x == 0)
                break;
        }
        return "";
    }
</script>
