<x-layout>


    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 제안서 받기 <span class="gray_basic"><span class="txt_point">2</span>/3</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->


    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 제안서 받기 <span class="step_number"><span class="txt_point">2</span>/3</span>
            </h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>예산을 알려주세요.</h4>
                    <div class="btn_radioType">
                        <input type="radio" name="budget_type" id="budget_type_1" value="Y">
                        <label for="budget_type_1" onclick="showDiv('type', 0)">매매</label>

                        <input type="radio" name="budget_type" id="budget_type_2" value="Y">
                        <label for="budget_type_2" onclick="showDiv('type', 1)">임대</label>
                    </div>
                    <div class="type_wrap">
                        <div class="type_item open_key">
                            <div class="w_30">
                                <label class="input_label">매매가 <span>*</span></label>
                                <div class="flex_1 flex_between">
                                    <input type="text"> <span>원</span>
                                </div>
                            </div>
                        </div>
                        <div class="type_item open_key">
                            <div class="w_30">
                                <label class="input_label">보증금 <span>*</span></label>
                                <div class="flex_1 flex_between">
                                    <input type="text"> <span>원</span>
                                </div>
                            </div>
                            <div class="w_30 mt28">
                                <label class="input_label">월 임대료 <span>*</span></label>
                                <div class="flex_1 flex_between">
                                    <input type="text"> <span>원</span>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="box_01 box_reg">
                    <h4>제안 받을 의뢰인의 정보를 입력해주세요.</h4>
                    <div class="w_30">
                        <label class="input_label">의뢰인명 <span>*</span></label>
                        <input type="text" placeholder="예) 홍길동">
                    </div>

                    <!-- 지산/사무실/창고, 단독공장 일 경우 -->
                    <div>지산/사무실/창고, 단독공장 일 경우 개발시 삭제</div>
                    <div class="w_30">
                        <label class="input_label">회사명 <span>*</span></label>
                        <input type="text" placeholder="예) 홍길동">
                    </div>

                    <div class="w_30">
                        <label class="input_label">업종</label>
                        <div class="dropdown_box only_pc mt8">
                            <button class="dropdown_label">업종 선택</button>
                            <ul class="optionList">
                                <li class="optionItem">농업, 임업 및 어업</li>
                                <li class="optionItem">광업</li>
                                <li class="optionItem">제조업</li>
                                <li class="optionItem">전기, 가스, 증기 및 공기조절 공급업</li>
                                <li class="optionItem">수도, 하수 및 폐기물 처리, 원료 재생업</li>
                                <li class="optionItem">건설업</li>
                                <li class="optionItem">도매 및 소매업</li>
                                <li class="optionItem">운수 및 창고업</li>
                                <li class="optionItem">숙박 및 음식점업</li>
                                <li class="optionItem">정보통신업</li>
                                <li class="optionItem">금융 및 보험업</li>
                                <li class="optionItem">부동산업</li>
                                <li class="optionItem">전문, 과학 및 기술 서비스업</li>
                                <li class="optionItem">사업시설 관리, 사업 지원 및 임대 서비스업</li>
                                <li class="optionItem">공공 행정, 국방 및 사회보장 행정</li>
                                <li class="optionItem">교육 서비스업</li>
                                <li class="optionItem">보건업 및 사회복지 서비스업</li>
                                <li class="optionItem">예술, 스포츠 및 여가관련 서비스업</li>
                                <li class="optionItem">협회 및 단체, 수리 및 기타 개인 서비스업</li>
                                <li class="optionItem">가구 내 고용활동 및 미분류 자가 소비생산업</li>
                                <li class="optionItem">국제 및 외국기관</li>
                            </ul>
                        </div>
                        <!----------------------- M::희망 업종 : s ----------------------->
                        <div class="dropdown_box m_full only_m mt8">
                            <button class="dropdown_label" onclick="modal_open_slide('biz_type')">희망 업종 선택</button>
                        </div>
                        <div class="modal_slide modal_slide_biz_type">
                            <div class="slide_title_wrap">
                                <span>희망 업종 선택</span>
                                <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('biz_type')">
                            </div>
                            <ul class="slide_modal_menu">
                                <li><a href="#">휴게음식점</a></li>
                                <li><a href="#">농업, 임업 및 어업</a></li>
                                <li><a href="#">광업</a></li>
                                <li><a href="#">제조업</a></li>
                                <li><a href="#">전기, 가스, 증기 및 공기조절 공급업</a></li>
                                <li><a href="#">수도, 하수 및 폐기물 처리, 원료 재생업</a></li>
                                <li><a href="#">건설업</a></li>
                                <li><a href="#">도매 및 소매업</a></li>
                                <li><a href="#">운수 및 창고업</a></li>
                                <li><a href="#">숙박 및 음식점업</a></li>
                                <li><a href="#">정보통신업</a></li>
                                <li><a href="#">금융 및 보험업</a></li>
                                <li><a href="#">부동산업</a></li>
                                <li><a href="#">전문, 과학 및 기술 서비스업</a></li>
                                <li><a href="#">사업시설 관리, 사업 지원 및 임대 서비스업</a></li>
                                <li><a href="#">공공 행정, 국방 및 사회보장 행정</a></li>
                                <li><a href="#">교육 서비스업</a></li>
                                <li><a href="#">보건업 및 사회복지 서비스업</a></li>
                                <li><a href="#">예술, 스포츠 및 여가관련 서비스업</a></li>
                                <li><a href="#">협회 및 단체, 수리 및 기타 개인 서비스업</a></li>
                                <li><a href="#">가구 내 고용활동 및 미분류 자가 소비생산업</a></li>
                                <li><a href="#">국제 및 외국기관</a></li>
                            </ul>
                        </div>
                        <div class="md_slide_overlay md_slide_overlay_biz_type"
                            onclick="modal_close_slide('biz_type')"></div>
                        <!----------------------- M::희망 업종 : e ----------------------->
                    </div>
                </div>

                <div class="step_btn_wrap">
                    <button class="btn_full_basic btn_graylight_ghost"
                        onclick="location.href='offer_step_1.html'">이전</button>
                    <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point" onclick="location.href='{{route('www.mypage.user.offer.third.create.view')}}'">다음</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->

    </div>

    <script>
        //기본 토글 이벤트
        $(".proposal_toggle_btn").click(function() {
            $(this).toggleClass("toggled");
            if ($(this).hasClass("toggled")) {
                $(this).css("transform", "rotate(180deg)");
            } else {
                $(this).css("transform", "rotate(0deg)");
            }

            $(".proposal_table_wrap").stop().slideToggle(300);
            return false;
        });

        //입력란 열고 닫기
        function showDiv(className, index) {
            var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }
    </script>

</x-layout>
