<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">내 자산 관리</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">자산 등록하기 <span class="step_number"><span class="txt_point">1</span>/4</span></h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>부동산 유형 <span class="txt_point">*</span></h4>
                    <ul class="tab_type_3 tab_toggle_menu">
                        <li class="active">상업용</li>
                        <li>주거용</li>
                        <li>분양권</li>
                    </ul>
                    <div class="tab_area_wrap">
                        <div>
                            <div class="btn_radioType">
                                <input type="radio" name="commercial" id="commercial_1" value="Y">
                                <label for="commercial_1">지식산업센터</label>

                                <input type="radio" name="commercial" id="commercial_2" value="Y">
                                <label for="commercial_2">사무실</label>

                                <input type="radio" name="commercial" id="commercial_3" value="Y">
                                <label for="commercial_3">창고</label>

                                <input type="radio" name="commercial" id="commercial_4" value="Y">
                                <label for="commercial_4">상가</label>

                                <input type="radio" name="commercial" id="commercial_5" value="Y">
                                <label for="commercial_5">기숙사</label>

                                <input type="radio" name="commercial" id="commercial_6" value="Y">
                                <label for="commercial_6">건물</label>

                                <input type="radio" name="commercial" id="commercial_7" value="Y">
                                <label for="commercial_7">토지/임야</label>

                                <input type="radio" name="commercial" id="commercial_8" value="Y">
                                <label for="commercial_8">단독 공장</label>
                            </div>
                        </div>
                        <div>
                            <div class="btn_radioType">
                                <input type="radio" name="inhabitation" id="inhabitation_1" value="Y">
                                <label for="inhabitation_1">아파트</label>

                                <input type="radio" name="inhabitation" id="inhabitation_2" value="Y">
                                <label for="inhabitation_2">오피스텔</label>

                                <input type="radio" name="inhabitation" id="inhabitation_3" value="Y">
                                <label for="inhabitation_3">단독/다가구</label>

                                <input type="radio" name="inhabitation" id="inhabitation_4" value="Y">
                                <label for="inhabitation_4">다세대/빌라/연립</label>

                                <input type="radio" name="inhabitation" id="inhabitation_5" value="Y">
                                <label for="inhabitation_5">상가주택</label>

                                <input type="radio" name="inhabitation" id="inhabitation_6" value="Y">
                                <label for="inhabitation_6">주택</label>
                            </div>
                        </div>

                        <div>
                            <div class="btn_radioType">
                                <input type="radio" name="pre_sale" id="pre_sale_1" value="Y">
                                <label for="pre_sale_1">지식산업센터 분양권</label>

                                <input type="radio" name="pre_sale" id="pre_sale_2" value="Y">
                                <label for="pre_sale_2">상가 분양권</label>

                                <input type="radio" name="pre_sale" id="pre_sale_3" value="Y">
                                <label for="pre_sale_3">아파트 분양권</label>

                                <input type="radio" name="pre_sale" id="pre_sale_4" value="Y">
                                <label for="pre_sale_4">오피스텔 분양권</label>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="box_01 box_reg">
                    <h4>위치 및 주소 <span class="txt_point">*</span></h4>

                    <div class="address_reg_wrap">
                        <div class="inner_item">
                            <div class="search_address_1 active">
                                <button class="btn_graylight_ghost btn_full_thin txt_r">주소 검색</button>
                            </div>
                            <div class="search_address_2">
                                <button class="btn_graylight_ghost btn_full_thin txt_r"
                                    onclick="modal_open('address_search')">가(임시)주소 검색</button>
                            </div>
                            <div class="mt8 gap_14">
                                <input type="checkbox" name="temporary_address" id="temporary_address"
                                    value="Y">
                                <label for="temporary_address" class="gray_deep"><span></span> 가(임시)주소</label>

                                <input type="checkbox" name="unregistered" id="unregistered" value="Y">
                                <label for="unregistered" class="gray_deep"><span></span> 미등기</label>
                            </div>
                            <!----------------- M:: map : s ----------------->
                            <div class="inner_item inner_map only_m">
                                주소 검색 시,<br>해당 위치가 지도에 표시됩니다.
                            </div>
                            <!----------------- M:: map : e ----------------->
                            <div class="inner_address">
                                <div class="address_row">
                                    <span>도로명</span>서울특별시 구로구 구로동 419-1
                                </div>
                                <div class="address_row">
                                    <span>지번</span>서울특별시 구로구 구로동로 40길 2
                                </div>
                            </div>

                            <div class="detail_address_1 mt18 active">
                                <div class="flex_2">
                                    <div class="flex_1">
                                        <input type="text">
                                        <span>동</span>
                                    </div>
                                    <div class="flex_1">
                                        <input type="text">
                                        <span>호</span>
                                    </div>
                                </div>
                                <div class="mt8">
                                    <input type="checkbox" name="address_no" id="address_no_1" value="Y">
                                    <label for="address_no_1" class="gray_deep"><span></span> 동정보 없음</label>
                                </div>
                            </div>

                            <div class="detail_address_2 mt18">
                                <div>
                                    <input type="text" placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호">
                                </div>
                                <div class="mt8">
                                    <input type="checkbox" name="address_no" id="address_no_2" value="Y">
                                    <label for="address_no_2" class="gray_deep"><span></span> 상세주소 없음</label>
                                </div>
                            </div>

                            <!-- <div class="mt18">
                                <input type="text" placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호">
                            </div> -->
                        </div>
                        <div class="inner_item inner_map only_pc">
                            주소 검색 시,<br>해당 위치가 지도에 표시됩니다.
                        </div>
                    </div>
                </div>

                <div class="box_01 box_reg">
                    <h4>기본 정보</h4>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">공급 면적 <span class="txt_point">*</span></label>
                            <div class="input_pyeong_area">
                                <div><input type="text" placeholder="전용면적"> <span class="gray_deep">평</span>
                                </div>
                                <span class="gray_deep">/</span>
                                <div><input type="text" placeholder="평 입력시 자동"> <span class="gray_deep">㎡</span>
                                </div>
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">전용 면적 <span class="txt_point">*</span></label>
                            <div class="input_pyeong_area">
                                <div><input type="text" placeholder="전용면적"> <span class="gray_deep">평</span>
                                </div>
                                <span class="gray_deep">/</span>
                                <div><input type="text" placeholder="평 입력시 자동"> <span class="gray_deep">㎡</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">명의구분 <span class="txt_point">*</span></label>
                            <div class="btn_radioType">
                                <input type="radio" name="div_1" id="div_1_1" value="Y">
                                <label for="div_1_1">단독명의</label>

                                <input type="radio" name="div_1" id="div_1_2" value="Y">
                                <label for="div_1_2">공동명의</label>
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">사업자구분 <span class="txt_point">*</span></label>
                            <div class="btn_radioType">
                                <input type="radio" name="div_2" id="div_2_1" value="Y">
                                <label for="div_2_1">개인사업자</label>

                                <input type="radio" name="div_2" id="div_2_2" value="Y">
                                <label for="div_2_2">법인사업자</label>

                                <input type="radio" name="div_2" id="div_2_3" value="Y">
                                <label for="div_2_3">개인</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="step_btn_wrap">
                    <span></span>
                    <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point" onclick="location.href='{{ route('www.mypage.service.create.second.view')}}'">다음</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->

    </div>

    <!-- modal 가(임시)주소 검색 : s-->
    <div class="modal modal_mid modal_address_search">
        <div class="modal_title">
            <h5>가(임시) 주소 검색</h5>
            <img src="images/btn_md_close.png" class="md_btn_close" onclick="modal_close('address_search')">
        </div>
        <div class="modal_container">
            <ul class="adress_select tab_toggle_menu">
                <li class="active"><span id="region_input_1">시/도</span></li>
                <li><span id="region_input_2">시/군/구</span></li>
                <li><span id="region_input_3">읍/면/동</span></li>
                <li><span id="region_input_4">리</span></li>
            </ul>
            <div class="tab_area_wrap adress_select_wrap mt20">
                <div style="display: block;">
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_1" value="Y">
                            <label for="region_1_1">강원도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_2" value="Y">
                            <label for="region_1_2">경기도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_3" value="Y">
                            <label for="region_1_3">경상남도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_4" value="Y">
                            <label for="region_1_4">광주광역시</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_5" value="Y">
                            <label for="region_1_5">대구광역시</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_6" value="Y">
                            <label for="region_1_6">세종특별자치시</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_2" id="region_2_1" value="Y">
                            <label for="region_2_1">강남구</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_2" id="region_2_2" value="Y">
                            <label for="region_2_2">강동구</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_3" id="region_3_1" value="Y">
                            <label for="region_3_1">개포동</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_3" id="region_3_2" value="Y">
                            <label for="region_3_2">논현동</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_4" id="region_4_1" value="Y">
                            <label for="region_4_1">개곡리</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_4" id="region_4_2" value="Y">
                            <label for="region_4_2">개곡리</label>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button class="btn_full_basic btn_point" disabled>검색</button>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_address_search" onclick="modal_close('address_search')"></div>
    <script>
        //가(임시)주소 클릭 이벤트
        document.getElementById("temporary_address").addEventListener("change", function() {
            var address_1 = document.querySelector(".detail_address_1");
            var address_2 = document.querySelector(".detail_address_2");
            var search_1 = document.querySelector(".search_address_1");
            var search_2 = document.querySelector(".search_address_2");

            if (this.checked) {
                address_1.style.display = "none";
                address_2.classList.add("active");
                search_1.style.display = "none";
                search_2.classList.add("active");
            } else {
                address_1.style.display = "block";
                address_2.classList.remove("active");
                search_1.style.display = "block";
                search_2.classList.remove("active");
            }
        });

        //가(임시)주소 선택하기
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('label').forEach(function(label) {
                label.addEventListener("click", function() {
                    var index = label.getAttribute("for").split("_")[1]; // 인덱스 추출
                    var regionInputId = "region_input_" + index;
                    var span = document.getElementById(regionInputId);
                    span.textContent = label.textContent; // 클릭된 라벨의 텍스트를 span에 입력
                });
            });
        });
    </script>
</x-layout>
