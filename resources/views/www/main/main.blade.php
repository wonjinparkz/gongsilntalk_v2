<x-layout>

    <div class="body">

        <!---------------------------------- only m : s ---------------------------------->
        <div class="only_m">

            <!-- m::header bar : s -->
            <div class="m_header">
                <div class="left_area"><a href="main.html"><img src="{{ asset('assets/media/header_logo.png') }}"
                            alt="공실앤톡 로고"></a></div>
                <!-- <div class="m_title">홈</div> -->
                <div class="right_area">
                    <a href="#">
                        <div class="user_profileImg">
                            <div class="img_box"><img src="{{ asset('assets/media/s_3.png') }}"></div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- m::header bar : s -->

            <div class="m_inner_wrap m_main_wrap">
                <h4>어떤 매물을 찾고 계신가요?</h4>
                <div class="main_search">
                    <input type="text" placeholder="단지명, 동이름, 지하철역으로 검색">
                    <button><img src="{{ asset('assets/media/btn_point_search.png') }}" alt="검색"></button>
                </div>

                <div class="m_main_bn_1">
                    <a href="#">
                        <div>
                            <h1>AI기반<br>매물 매칭 시스템</h1>
                            <p>전국 지식산업센터,<br>30초만에 매물 제안 받으세요.</p>
                        </div>
                    </a>
                </div>

                <div class="m_main_bn_2">
                    <a href="#"><img src="{{ asset('assets/media/main_bn_2.png') }}" alt="매물 지도"></a>
                    <a href="#"><img src="{{ asset('assets/media/main_bn_3.png') }}" alt="분양 현장"></a>
                </div>

                <div class="m_main_bn_3">
                    <a href="#">
                        <span>구하기</span> <img src="{{ asset('assets/media/ic_arrow_more.png') }}">
                        <p>공간을 구하고 있어요.</p>
                    </a>
                    <span class="v_line"></span>
                    <a href="#">
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
                        <div class="swiper-slide">
                            <div class="img_box"><img src="{{ asset('assets/media/main_s1_1.png') }}"></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_box"><img src="{{ asset('assets/media/main_s1_1.png') }}"></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_box"><img src="{{ asset('assets/media/main_s1_1.png') }}"></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="img_box"><img src="{{ asset('assets/media/main_s1_1.png') }}"></div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination_wrap">
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
            <script>
                var bullet = ['매물제안서 받기', '인테리어 무료견적', '주변 데이터 분석', '신규 매물 내놓기'];
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
            <section class="section_2">
                <div class="section_2_wrap">
                    <div class="main_2_wrap">

                        <div class="main_2">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <p class="txt_item_1">01</p>
                                        <p class="txt_item_1">원하는 매물의 정보를 입력해주세요.</p>
                                        <p class="txt_item_2">
                                            먼저 상가와 사무실 선택한 후, <br>
                                            찾기 원하는 매물의 조건을 상세히 입력해주세요. <br>
                                            최대 세줄까지 입력 가능합니다.
                                        </p>
                                        <button>서비스 바로가기</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <p class="txt_item_1">02</p>
                                        <p class="txt_item_1">두번째 정보를 입력해 볼까요.</p>
                                        <p class="txt_item_2">
                                            먼저 상가와 사무실 선택한 후, <br>
                                            찾기 원하는 매물의 조건을 상세히 입력해주세요. <br>
                                            최대 세줄까지 입력 가능합니다.
                                        </p>
                                        <button>서비스 바로가기</button>
                                    </div>
                                    <div class="swiper-slide">
                                        <p class="txt_item_1">03</p>
                                        <p class="txt_item_1">원하는 매물의 정보를 입력해주세요.</p>
                                        <p class="txt_item_2">
                                            먼저 상가와 사무실 선택한 후, <br>
                                            찾기 원하는 매물의 조건을 상세히 입력해주세요. <br>
                                            최대 세줄까지 입력 가능합니다.
                                        </p>
                                        <button>서비스 바로가기</button>
                                    </div>
                                </div>
                            </div>
                            <div class="main_2_btn">
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>


                        <div class="main_2_img">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/media/screen_1.png') }}" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/media/screen_1.png') }}" alt="">
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="{{ asset('assets/media/screen_1.png') }}" alt="">
                                    </div>
                                </div>
                                <!-- <div class="sub_nav">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                  </div> -->
                                <!-- <div class="swiper-pagination"></div> -->
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


            <!-- section 3 : s -->
            <section class="section_3">
                <span>누적 이용 사용자 수 12345</span>
            </section>
            <!-- section 3 : e -->


            <!-- section 4 : s -->
            <section class="section_4">

            </section>
            <!-- section 4 : e -->


            <!-- section 5 : s -->
            <section class="section_5">

            </section>
            <!-- section 5 : e -->


            <!-- section 6 : s -->
            <section class="section_6">

            </section>
            <!-- section 6 : e -->


            <!-- section 7 : s -->
            <section class="section_7">

            </section>
            <!-- section 7 : e -->


            <!-- section 8 : s -->
            <section class="section_8">

            </section>
            <!-- section 8 : e -->


            <!-- section 9 : s -->
            <section class="section_9">

            </section>
            <!-- section 9 : e -->

        </div>
        <!---------------------------------- only pc : e ---------------------------------->


    </div>


</x-layout>
