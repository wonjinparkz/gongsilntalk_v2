<x-layout>

    <div class="body">

        @php
            $notToday = $_COOKIE['notToday'] ?? 'N';
        @endphp

        <!-- popup : s -->
        @if (count($popups) > 0)
            @if ($notToday == 'N' || $notToday == null)
                <div class="main_popup">
                    <div class="popup_wrap">
                        <div class="popup_bn_swiper">
                            <div class="swiper-wrapper"
                                style="text-align: center; transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                                @foreach ($popups as $item)
                                    @if (isset($item->images))
                                        <div class="swiper-slide swiper-slide-active">
                                            <a href="{{ $item->url ?? route('www.main.main') }}">
                                                <div class="img_box" style="text-align:center; height:90%; width:100%;">
                                                    <img style="height:100%;"
                                                        src="{{ Storage::url('image/' . $item->images[0]->path) }}"
                                                        onerror="this.src='{{ asset('assets/media/s_2.png') }}';"
                                                        alt="">
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach

                                {{-- <div class="swiper-slide swiper-slide-active">
                                    <a href="#">
                                        <div class="img_box" style="text-align:center; height:90%; width:100%;">
                                            <img style="height:100%;" src="{{ asset('assets/media/s_2.png') }}"
                                                alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a href="#">
                                        <div class="img_box" style="text-align:center; height:90%; width:100%;">
                                            <img style="height:100%;" src="{{ asset('assets/media/s_8.png') }}"
                                                alt="">
                                        </div>
                                    </a>
                                </div> --}}
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="popup_bottom">
                            <span class="today_close" onclick="todayClosePopup();">오늘 하루 보지 않기</span>
                            <span class="close" onclick="closePopup();">닫기</span>
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
        <div class="only_m">

            <!-- m::header bar : s -->
            <div class="m_header">
                <div class="left_area"><a href="{{ route('www.main.main') }}"><img
                            src="{{ asset('assets/media/header_logo.png') }}" alt="공실앤톡 로고"></a></div>
                <!-- <div class="m_title">홈</div> -->
                <div class="right_area">
                    @guest
                    @else
                        <a>
                            <div class="user_profileImg">
                                <div class="img_box"><img src="{{ asset('assets/media/default_user.png') }}"></div>
                            </div>
                        </a>
                    @endguest
                </div>
            </div>
            <!-- m::header bar : s -->

            <div class="m_inner_wrap m_main_wrap">
                <h4>어떤 매물을 찾고 계신가요?</h4>
                <div class="main_search">
                    <input type="text" id="search_input" name="search_input" placeholder="단지명, 동이름, 지하철역으로 검색"
                        value="{{ $_GET['search_input'] ?? '' }}"
                        onkeyup="if(window.event.keyCode==13){search_request();}">
                    <button onclick="search_request()"><img src="{{ asset('assets/media/btn_point_search.png') }}"
                            alt="검색"></button>
                </div>

                <div class="m_main_bn_1">
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
                </div>

                <div class="swiper m_main_bn_4">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="{{ asset('assets/media/main_slide_bn_1.png') }}"></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/media/main_slide_bn_1.png') }}"></div>
                        <div class="swiper-slide"><img src="{{ asset('assets/media/main_slide_bn_1.png') }}"></div>
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
        </div>
        <!-- nav : s -->
        <x-nav-layout />
        <!-- nav : e -->
        <!---------------------------------- only m : e ---------------------------------->

        <!---------------------------------- only pc : s ---------------------------------->
        <div class="only_pc">
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
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
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
                                            <button onclick="location.href='{{ $item->url }}' ">서비스 바로가기</button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="main_2_btn">
                                <div class="swiper-button-prev"><img
                                        src="{{ asset('assets/media/bn_arrow_prev.png') }}" alt=""></div>
                                <div class="swiper-button-next"><img
                                        src="{{ asset('assets/media/bn_arrow_next.png') }}" alt=""></div>
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

                    <ul class="property_img_wrap">
                        <li class="active">사무실</li>
                        <li>공장/창고</li>
                        <li>건물</li>
                        <li>상가</li>
                    </ul>

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
                            <p class="box_item_1">오피스 인테리어</p>
                            <div class="box_item_2">기업의 규모와 관계 없이 무료 3D도면을 제공<br>드리며, 회사의 정체성을 담은 완성도 높고<br>책임감 있는 설계와
                                공사를 진행합니다.</div>
                            <div class="tag_area">
                                <span class="txt_tag">#무료 3D도면 제공</span>
                            </div>
                            <button>자세히보기</button>
                        </div>

                        <div class="con_box">
                            <p class="box_item_1">퍼시스 가구</p>
                            <div class="box_item_2">국내 사무가구 1위 브랜드, 퍼시스(FURSYS)<br>가구와 모든 서비스를 합리적인 단가로 제공<br>받으실 수
                                있습니다.</div>
                            <div class="tag_area">
                                <span class="txt_tag">#퍼시스 가구</span>
                                <span class="txt_tag">#합리적인 가격</span>
                            </div>
                            <button>자세히보기</button>
                        </div>

                        <div class="con_box">
                            <p class="box_item_1">데스커 가구</p>
                            <div class="box_item_2">본질에 집중하고, 깔끔한 디자인의 데스커<br>(DESKER)입니다. 데스커 기업전용 서비스를<br>데스커 공식
                                에이트에게 받으실 수 있습니다.</div>
                            <div class="tag_area">
                                <span class="txt_tag">#데스커 가구</span>
                                <span class="txt_tag">#기업전용 서비스</span>
                            </div>
                            <button>자세히보기</button>
                        </div>
                    </div>
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
            <section class="section_review">
                {{-- <p class="txt_item_1">기업이 인정하는 공실앤톡</p> --}}
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
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
            </section>
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
            <section class="section_download">
                <div class="inner_wrap">
                    <div class="main_download_wrap">
                        <div class="download_info_wrap">
                            <p class="txt_item_1">더욱 편리하게<br>앱을 이용해보세요.</p>
                            <p class="txt_item_2">언제 어디서나 공실앤톡을 이용해 보세요.</p>
                            <div class="main_download_btn">
                                <button class="btn_point btn_basic"><img
                                        src="{{ asset('assets/media/ic_download_aos.png') }}">안드로이드</button>
                                <button class="btn_point btn_basic"><img
                                        src="{{ asset('assets/media/ic_download_ios.png') }}">아이폰</button>
                            </div>
                        </div>
                        <div><img src="{{ asset('assets/media/section_img_download.png') }}" class="download_img">
                        </div>
                    </div>
                </div>
            </section>
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
                    <button class="btn_point btn_basic">제휴 및 전속계약 문의</button>
                </div>
            </section>
            <!-- section 9 : e -->

        </div>
        <!---------------------------------- only pc : e ---------------------------------->


    </div>


</x-layout>


<script>
    // 검색 추가
    function search_request() {
        var search_input = $("#search_input").val();
        if (search_input == "") {
            alert("매물을 입력해주세요.", "확인");
            return;
        }
        location.href = "{{ route('www.map.mobile') }}" + "?search_input=" + search_input;
    }

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
