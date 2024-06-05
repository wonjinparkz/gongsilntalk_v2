<x-layout>


    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 제안서 받기 <span class="gray_basic"><span class="txt_point">1</span>/3</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->


    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 제안서 받기 <span class="step_number"><span class="txt_point">1</span>/3</span>
            </h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>어디에 매물을 얻고 싶으신가요?</h4>
                    <div class="w_30">
                        <div class="search_wrap">
                            <input type="text" placeholder="시·군·구로 검색해주세요">
                            <button><img src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
                        </div>
                        <p class="mt4 gray_basic fs_13">서울특별시, 경기도권 지역만 검색 가능합니다.</p>
                    </div>
                    <div>
                        <p class="txt_max_count">중복선택가능 <span>3</span> / 3</p>
                        <div class="keyword_wrap">
                            <div class="keyword_item">서울시 서초구 <button onclick="keyword_item(this)"><img
                                        src="{{ asset('assets/media/btn_solid_delete.png') }}"></button></div>
                            <div class="keyword_item">서울시 동대문구 <button onclick="keyword_item(this)"><img
                                        src="{{ asset('assets/media/btn_solid_delete.png') }}"></button></div>
                        </div>
                    </div>
                </div>

                <div class="box_01 box_reg">
                    <h4>원하시는 매물 조건을 알려주세요.</h4>
                    <div class="btn_radioType">
                        <input type="radio" name="type" id="type_1" value="Y" checked>
                        <label for="type_1" onclick="showContent(0)">상가</label>

                        <input type="radio" name="type" id="type_2" value="Y">
                        <label for="type_2" onclick="showContent(1)">지산/사무실/창고</label>

                        <input type="radio" name="type" id="type_3" value="Y">
                        <label for="type_3" onclick="showContent(1)">단독공장</label>
                    </div>

                    <div>
                        <label class="input_label">희망 면적 <span>*</span></label>
                        <div class="input_pyeong_area w_30">
                            <input type="text" placeholder="희망 면적"> <span class="gray_deep">평 /</span>
                            <input type="text" placeholder="평 입력시 자동"> <span class="gray_deep">㎡</span>
                        </div>
                    </div>

                    <div class="type_item_wrap">
                        <div class="type_item active">
                            <div>
                                <label class="input_label">희망 업종</label>
                                <div class="dropdown_box only_pc mt8 w_30">
                                    <button class="dropdown_label">희망 업종 선택 </button>
                                    <ul class="optionList">
                                        <li class="optionItem">휴게음식점</li>
                                        <li class="optionItem">일반음식점</li>
                                        <li class="optionItem">주류점</li>
                                        <li class="optionItem">오락스포츠</li>
                                        <li class="optionItem">판매업</li>
                                        <li class="optionItem">숙박업</li>
                                        <li class="optionItem">기타업종</li>
                                    </ul>
                                </div>
                                <!----------------------- M::희망 업종 : s ----------------------->
                                <div class="dropdown_box m_full only_m mt8">
                                    <button class="dropdown_label" onclick="modal_open_slide('biz_type')">희망 업종
                                        선택</button>
                                </div>
                                <div class="modal_slide modal_slide_biz_type">
                                    <div class="slide_title_wrap">
                                        <span>희망 업종 선택</span>
                                        <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                            onclick="modal_close_slide('biz_type')">
                                    </div>
                                    <ul class="slide_modal_menu">
                                        <li><a href="#">휴게음식점</a></li>
                                        <li><a href="#">일반음식점</a></li>
                                        <li><a href="#">주류점</a></li>
                                        <li><a href="#">오락스포츠</a></li>
                                        <li><a href="#">판매업</a></li>
                                        <li><a href="#">숙박업</a></li>
                                        <li><a href="#">기타업종</a></li>
                                    </ul>
                                </div>
                                <div class="md_slide_overlay md_slide_overlay_biz_type"
                                    onclick="modal_close_slide('biz_type')"></div>
                                <!----------------------- M::희망 업종 : e ----------------------->

                            </div>
                        </div>

                        <div class="type_item">
                            <div class="reg_item w_30">
                                <label class="input_label">사용 인원<span>*</span></label>
                                <div class="flex_1 flex_between">
                                    <input type="text"> <span>명</span>
                                </div>
                                <p class="fs_13 gray_basic mt8">인원 당 2.5평을 추천해드립니다.</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="input_label">입주 가능일 <span>*</span></label>
                        <div class="btn_radioType self_day_check mt8">
                            <input type="radio" name="day" id="day_1" value="Y">
                            <label for="day_1" onclick="toggleCalendar(0)">즉시 입주</label>

                            <input type="radio" name="day" id="day_2" value="Y">
                            <label for="day_2" onclick="toggleCalendar(0)">날짜 협의</label>

                            <input type="radio" name="day" id="day_3" value="Y">
                            <label for="day_3" onclick="toggleCalendar(1)">직접 입력</label>
                        </div>
                        <div class="self_day_wrap">
                            <div class="self_day_item"></div>
                            <div class="self_day_item w_30">
                                <div class="input_calendar_term">
                                    <div>
                                        <label class="input_label">계약시작일</label>
                                        <input type="text" placeholder="예) 20230101">
                                    </div>
                                    <span>~</span>
                                    <div>
                                        <label class="input_label">계약종료일</label>
                                        <input type="text" placeholder="예) 20230101">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="step_btn_wrap">
                    <span></span>
                    <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point"
                        onclick="location.href='{{ route('www.mypage.user.offer.second.create.view') }}'">다음</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->

    </div>

    <script>
        //직접입력
        function toggleCalendar(index) {
            var tabContents = document.querySelectorAll('.self_day_wrap .self_day_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }

        //매물조건 구분
        function showContent(index) {
            var tabContents = document.querySelectorAll('.type_item_wrap .type_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }

        // 매물지역 삭제
        function keyword_item(button) {
            var div = button.parentNode;
            div.parentNode.removeChild(div);
        }
    </script>
</x-layout>
