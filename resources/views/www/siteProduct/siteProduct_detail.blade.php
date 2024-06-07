<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">{{ $result->title }}</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        <div class="sales_bar_wrap only_pc">
            <div class="inner_wrap sales_name_bar">
                <div>
                    <p class="txt_location">{{ $result->region_address }}</p>
                    <h1>{{ $result->title }}</h1>
                </div>
                <div class="sales_bar_right">
                    <span class="header_btn_wish" onclick="btn_wish(this)"></span>
                    <a href="#"><img src="{{ asset('assets/media/header_btn_alarm.png') }}"
                            class="header_ic_btn"></a>
                    <a href="#"><img src="{{ asset('assets/media/header_btn_share_deep.png') }}"
                            class="header_ic_btn"></a>
                    <button class="btn_graydeep_ghost btn_md_bold">분양문의</button>
                </div>
            </div>
        </div>

        <div class="template_wrap">
            <div class="template_txt_wrap">
                <p class="txt_tit">지식산업센터타이틀</p>
                <p class="txt_con">대변화의 시작! <br>지식산업센터의 혁신을 그리다</p>
            </div>
            <div class="template_img">
                <div class="img_box"><img src="{{ asset('assets/media/s_3.png') }}"></div>
            </div>
        </div>

        <!-- tab : s -->
        <div class="tab_type_2 sales_tab">
            <div class="inner_wrap">
                <div class="swiper detail_tab">
                    <div class="swiper-wrapper menu">
                        <div class="swiper-slide active"><a href="#tab_area_1">기본정보</a></div>
                        <div class="swiper-slide"><a href="#tab_area_2">층별정보</a></div>
                        <div class="swiper-slide"><a href="#tab_area_3">프리미엄</a></div>
                        <div class="swiper-slide"><a href="#tab_area_4">분양일정</a></div>
                        <div class="swiper-slide"><a href="#tab_area_5">오시는길</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- tab : e -->


        <!-- 기본정보 : s -->
        <div class="inner_wrap sales_section_1">
            <section id="tab_area_1" class="page">
                <div class="flex_between">
                    <h3>기본정보</h3>
                    <div class="change_unit toggle_menu">
                        <div class="active">㎡</div>
                        <div>평</div>
                    </div>
                </div>

                <div class="table_container sales_table_info">
                    <div>주소</div>
                    <div>{{ $result->address }}</div>
                    <div>규모</div>
                    <div>{{ $result->min_floor }}층 / {{ $result->max_floor }}층 {{ $result->dong_count }}개동</div>
                    <div>총 세대수</div>
                    <div>{{ $result->generation_count }}실</div>
                    <div>주차대수</div>
                    <div>{{ $result->parking_count }}대</div>
                    <div>대지면적</div>
                    <div class="area" style="display:none">{{ $result->area }}평</div>
                    <div class="square">{{ $result->square }}㎡</div>
                    <div>건축면적</div>
                    <div class="area" style="display:none">{{ $result->building_area }}평</div>
                    <div class="square">{{ $result->building_square }}㎡</div>
                    <div>연면적</div>
                    <div class="area" style="display:none">{{ $result->total_floor_area }}평</div>
                    <div class="square">{{ $result->total_floor_square }}㎡</div>
                    <div>용적률/건폐율</div>
                    <div>{{ $result->floor_area_ratio }}% / {{ $result->builging_ratio }}%</div>
                    <div>준공일</div>
                    <div>{{ $result->completion_date }}</div>
                    <div>입주예정</div>
                    <div>{{ $result->expected_move_date }}</div>
                    <div>시행사</div>
                    <div>{{ $result->developer }}</div>
                    <div>시공사</div>
                    <div>{{ $result->comstruction_company }}</div>
                </div>

                <div class="detail_camera_wrap">
                    <div class="gray_basic">*클릭을 통해 직접 건물 내부를 이동하며 확인해보세요.</div>
                    <div class="mt8">
                        <img src="{{ asset('assets/media/s_4.png') }}" class="w_100">
                    </div>
                </div>
            </section>
        </div>

        <section class="sales_section_2 page">
            <div class="inner_wrap">
                <h3>교육자료</h3>

                <div class="swiper edu_document">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="{{ asset('assets/media/s_5.png') }}" class="document_img">
                        </div>
                        <div class="swiper-slide"><img src="{{ asset('assets/media/s_5.png') }}" class="document_img">
                        </div>
                        <div class="swiper-slide"><img src="{{ asset('assets/media/s_5.png') }}" class="document_img">
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section>
        <!-- 기본정보 : s -->

        <!-- 층별정보  : s -->
        <div class="inner_wrap sales_section_2-2">
            <h3>층별정보</h3>
            <section id="tab_area_2" class="page">

                <ul class="tab_type_6 toggle_tab mt28">
                    @foreach ($result->dongInfo as $dongInfo)
                        <li class="active">{{ $dongInfo->dong_name }}</li>
                    @endforeach
                    <li class="active">1동</li>
                    <li>2동</li>
                </ul>

                <div class="black_filter only_pc mt28">
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_1" value="Y">
                        <label for="floor_1">B2 ~ B1층</label>
                    </div>
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_2" value="Y">
                        <label for="floor_2">1층</label>
                    </div>
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_3" value="Y">
                        <label for="floor_3">2층</label>
                    </div>
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_4" value="Y">
                        <label for="floor_4">3층</label>
                    </div>
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_5" value="Y">
                        <label for="floor_5">8층</label>
                    </div>
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_6" value="Y">
                        <label for="floor_6">9층</label>
                    </div>
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_7" value="Y">
                        <label for="floor_7">10층 ~ 14층</label>
                    </div>
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_8" value="Y">
                        <label for="floor_8">15층 ~ 22층</label>
                    </div>
                    <div class="cell">
                        <input type="radio" name="floor" id="floor_9" value="Y">
                        <label for="floor_9">23층</label>
                    </div>
                </div>

                <select class="sales_floor_select only_m">
                    <option>B2 ~ B1층</option>
                    <option>1층</option>
                    <option>2층</option>
                </select>

                <div>
                    <div class="floor_title">22층 ~ 15층</div>
                    <div class="floor_info">근린생활시설</div>
                    <div><img src="{{ asset('assets/media/s_6.png') }}" class="w_100"></div>
                </div>
            </section>
        </div>
        <!-- 층별정보  : e -->

        <!-- 프리미엄  : s -->
        <div class="inner_wrap sales_section_3">
            <section id="tab_area_3" class="page">
                <h3>프리미엄</h3>

                <div class="premium_wrap">
                    <div class="premium_cell">
                        <label>01</label>
                        <p>광역 접근성 대폭 향상 및 기대감</p>
                        <div>탁트인 시원한 풍경으로 바쁜 일상속에 삶의 여유와 활력을 주는 완벽한 브랜드 라이프를 선사합니다.</div>
                    </div>
                    <div class="premium_cell">
                        <label>02</label>
                        <p>모던한 디자인의 랜더마크적 공간 설계</p>
                        <div>탁트인 시원한 풍경으로 바쁜 일상속에 삶의 여유와 활력을 주는 완벽한 브랜드 라이프를 선사합니다. 되도록이면 세줄을 초과하지 않도록 작성하는 편이 좋습니다.
                        </div>
                    </div>
                    <div class="premium_cell">
                        <label>03</label>
                        <p>다양한 업종의 입주가능성</p>
                        <div>탁트인 시원한 풍경으로 바쁜 일상속에 삶의 여유와 활력을 주는 완벽한 브랜드 라이프를 선사합니다. 되도록이면 세줄을 초과하지 않도록 작성하는 편이 좋습니다.
                        </div>
                    </div>
                    <div class="premium_cell">
                        <label>04</label>
                        <p>풍부하게 모두 갖춘 최적의 인프라</p>
                        <div>남다른 일상을 선사할 품격 높은 커뮤니티로, 새로운 삶의 장을 제공합니다. 최대 세줄까지만 기입되도록 작성하는 편이 좋습니다.</div>
                    </div>
                </div>
            </section>
        </div>
        <!-- 프리미엄  : e -->

        <!-- 분양일정  : s -->
        <div class="inner_wrap sales_section_4">
            <section id="tab_area_4" class="page">
                <h3>분양일정</h3>
                <p class="txt_item_1">*분양 일정은 건설사 사정에 따라 변경될 수 있습니다.</p>

                <div class="sales_schedule_wrap">
                    <div class="item_year">2023년</div>
                    <ul class="sales_schedule_list">
                        <li>
                            <div class="schedule_item_1">23.05.02</div>
                            <div class="schedule_item_2">주택전시관 오픈 <span></span></div>
                        </li>
                        <li>
                            <div class="schedule_item_1">23.05.10</div>
                            <div class="schedule_item_2">특별공급 청약 <span></span></div>
                        </li>
                        <li>
                            <div class="schedule_item_1">23.05.10</div>
                            <div class="schedule_item_2">특별공급 청약 <span class="schedule_item_3">D-DAY</span></div>
                        </li>
                    </ul>
                </div>

                <div class="sales_schedule_wrap">
                    <div class="item_year">2027년</div>
                    <ul class="sales_schedule_list">
                        <li>
                            <div class="schedule_item_1">23.11.02</div>
                            <div class="schedule_item_2">입주예정일 <span class="schedule_item_3">예정</span></div>
                        </li>
                    </ul>
                </div>

            </section>
        </div>
        <!-- 분양일정  : e -->

        <!-- 오시는길  : s -->
        <div class="inner_wrap sales_section_5">
            <section id="tab_area_5" class="page">
                <h3>오시는 길</h3>

                <div class="sales_address_info">
                    <div class="txt_sales_address">경기도 군포시 당동 425-50</div>
                    <button class="btn_gray_ghost btn_sm only_pc">주소복사</button>
                </div>

                <div class="sales_map_wrap">
                    <img src="{{ asset('assets/media/s_7.png') }}" class="w_100">
                </div>

                <div class="m_address_btn only_m">
                    <button class="btn_gray_ghost btn_sm">주소복사</button>
                </div>
            </section>
        </div>
        <!-- 오시는길  : e -->


        <!-- floating btn : s -->
        <div class="floating_btn_wrap only_m">
            <a href="javascript:void(0)" class="floating_wish" onclick="btn_wish(this)">관심등록</a>
            <button class="btn_point btn_full_floting">분양문의</button>
        </div>
        <!-- floating btn : e -->



    </div>
    <script>
        // 관심 토글버튼
        function btn_wish(element) {
            if ($(element).hasClass("on")) {
                $(element).removeClass("on");
            } else {
                $(element).addClass("on");
            }
        }

        //페이지 탭
        var detail_tab = new Swiper(".detail_tab", {
            slidesPerView: 'auto',
            freeMode: true,
            breakpointsInverse: true,
            breakpoints: {
                1023: {
                    allowTouchMove: false
                }
            }
        });

        //교육자료
        var edu_document = new Swiper(".edu_document", {
            pagination: {
                el: ".swiper-pagination",
                type: "fraction",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

</x-layout>
