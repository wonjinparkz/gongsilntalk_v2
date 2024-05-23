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

                    <input type="hidden" name="address_lng" id="address_lng" value="">
                    <input type="hidden" name="address_lat" id="address_lat" value="">
                    <input type="hidden" name="region_code" id="region_code" value="">
                    <input type="hidden" name="region_address" id="region_address" value="">
                    <input type="hidden" name="address" id="address" value="">
                    <input type="hidden" name="jibunName" id="jibunName" value="">

                    <div class="address_reg_wrap">
                        <div class="inner_item">
                            <div class="search_address_1 active">
                                <button class="btn_graylight_ghost btn_full_thin txt_r" onclick="getAddress()">주소
                                    검색</button>
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
                                <div class="address_row" id="roadName">
                                </div>
                                <div class="address_row" id="jibunName">
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
                            <script type="text/javascript"
                                src="https://business.juso.go.kr/juso_support_center/js/addrlink/map/jusoro_map_api.min.js?confmKey={{ env('CONFM_MAP_KEY') }}&skinType=1">
                            </script>
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
                    <button class="btn_full_basic btn_point"
                        onclick="location.href='{{ route('www.mypage.service.create.second.view') }}'">다음</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->

    </div>

    <!-- modal 가(임시)주소 검색 : s-->
    <div class="modal modal_mid modal_address_search">
        <div class="modal_title">
            <h5>가(임시) 주소 검색</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('address_search')">
        </div>
        <div class="modal_container">
            <ul class="adress_select tab_toggle_menu">
                <li class="active"><span id="region_input_1">시/도</span></li>
                <li style="display:none"><span id="region_input_2">시/군/구</span></li>
                <li style="display:none"><span id="region_input_3">읍/면/동</span></li>
                <li style="display:none"><span id="region_input_4">리</span></li>
            </ul>
            <div class="tab_area_wrap adress_select_wrap  mt20">
                <div>
                    <div class="point_sm_filter cell_4" id="region_code_1">

                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4" id="region_code_2">

                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4"id="region_code_3">

                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4" id="region_code_4">

                    </div>
                </div>
            </div>
            <div>
                <button class="btn_full_basic btn_point mt20" id="seach_address" onclick="seach_address()"
                    disabled>검색</button>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_address_search" onclick="modal_close('address_search')"></div>
    <!-- modal 가(임시)주소 검색 : e-->


</x-layout>

<script>
    $(document).ready(function() {
        var type = sessionStorage.getItem("typeSession");

        // 매물 타입이 분양권일 경우 활성화
        if (type > 13) {
            $('#is_unregistered').css('display', '');
        };

        // 지역구 가져오기
        get_region('*00000000', '1');

        $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
        $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
            .remove();
    });

    function confrim_check() {
        var is_temporary = $('#temporary_address').is(':checked');
        var is_address_no_1 = $('#address_no_1').is(':checked');
        var is_address_no_2 = $('#address_no_2').is(':checked');

        var region_code = $('#region_code').val();
        var address = $('#address').val();
        var address_detail = $('#address_detail').val();
        var address_dong = $('#address_dong').val();
        var address_number = $('#address_number').val();

        if (is_temporary) {
            if (region_code == '' || address == '' || address_number == '' || (!is_address_no_1 && address_dong ==
                    '')) {
                return $('.confirm').attr("disabled", true);
            }
        } else {
            if (region_code == '' || address == '' || (!is_address_no_2 && address_detail ==
                    '')) {
                return $('.confirm').attr("disabled", true);
            }
        }

        $('.confirm').attr("disabled", false);
    }

    $('input').on("change click", function() {
        confrim_check();
    });

    function formSetting() {

        var is_temporary = $('#temporary_address').is(':checked');
        var is_address_no_1 = $('#address_no_1').is(':checked');
        var is_address_no_2 = $('#address_no_2').is(':checked');

        if (is_temporary) {
            $('#address_detail').val('')
        } else {
            $('#address_dong').val('')
            $('#address_number').val('')
        }

        var address_lng = $('#address_lng').val();
        var address_lat = $('#address_lat').val();
        var region_code = $('#region_code').val();
        var region_address = $('#region_address').val();
        var address = $('#address').val();
        var address_detail = $('#address_detail').val();
        var address_dong = $('#address_dong').val();
        var address_number = $('#address_number').val();

        sessionStorage.setItem("address_lngSession", address_lng);
        sessionStorage.setItem("address_latSession", address_lat);
        sessionStorage.setItem("region_codeSession", region_code);
        sessionStorage.setItem("region_addressSession", region_address);
        sessionStorage.setItem("addressSession", address);

        sessionStorage.setItem("address_dongSession", address_dong);
        sessionStorage.setItem("address_numberSession", address_number);
        sessionStorage.setItem("address_detailSession", address_detail);

        $('.find_form').submit();
    }


    // 지역 가져오는 api
    function get_region(regcode, region) {
        var gatewayUrl =
            "https://grpc-proxy-server-mkvo6j4wsq-du.a.run.app/v1/regcodes?regcode_pattern=" + regcode +
            "&is_ignore_zero=true";

        $.ajax({
            url: gatewayUrl,
            method: "GET",
            dataType: "json",
            success: function(response) {
                // Check if 'regcodes' property exists and is an array
                if (response.regcodes && Array.isArray(response.regcodes)) {
                    var div = $("#region_code_" + region);
                    div.empty();

                    // Iterate over the 'regcodes' array
                    if (region == 1) {
                        response.regcodes.forEach(function(regcodeObj, index) {
                            // Assuming 'code' is the property you want to use for the option value
                            var regcode = regcodeObj.code;
                            // Assuming 'name' is the property you want to use for the option text
                            var name = regcodeObj.name;
                            div.append(`<div class="cell">` +
                                `<input type="radio" name="region_` + region +
                                `" id="region_` + region + `_` + (
                                    index + 1) + `" value="` +
                                regcode.substring(0, 2) + `">` +
                                `<label class="label" for="region_` + region + `_` + (
                                    index + 1) +
                                `">` +
                                name +
                                `</label>` +
                                `</div>`);
                        });
                    } else if (region != 1) {
                        var options = [];
                        for (var i = 0; i < response.regcodes.length; i++) {
                            var regcodeObj = response.regcodes[i];
                            var regcode = regcodeObj.code;
                            var nameParts = regcodeObj.name.split(' ');
                            if (region == 2) {
                                regcode = regcode.substring(4, 5) > 0 ? regcode.substring(0, 5) : regcode
                                    .substring(0, 4)
                                var name = nameParts.length > 1 ? nameParts.slice(1).join(' ') : regcodeObj
                                    .name;
                            } else if (region == 3) {
                                regcode = regcode.substring(0, 8)
                                var name = nameParts.length > 2 ? nameParts.slice(2).join(' ') : regcodeObj
                                    .name;
                            } else if (region == 4) {
                                regcode = regcode
                                var name = nameParts.length > 3 ? nameParts.slice(3).join(' ') : regcodeObj
                                    .name;
                            }
                            options.push({
                                name: name,
                                value: regcode
                            });
                        }

                        // Sort options based on the 'name' property
                        options.sort(function(a, b) {
                            return a.name.localeCompare(b.name);
                        });

                        // Append sorted options to the select element
                        for (var i = 0; i < options.length; i++) {
                            div.append(`<div class="cell">` +
                                `<input type="radio" name="region_` + region +
                                `" id="region_` + region + `_` + (
                                    i + 1) + `" value="` +
                                options[i].value + `">` +
                                `<label class="label" for="region_` + region + `_` + (
                                    i + 1) +
                                `">` +
                                options[i].name +
                                `</label>` +
                                `</div>`);
                        }
                    }

                    // 하위 선택할 수 있게 보여줌
                    $('#region_input_' + region).parents('li').css('display', '')
                    $('#region_input_' + region).click();

                    $('#seach_address').attr("disabled", true);

                } else {
                    console.error("Invalid response format. 'regcodes' array not found.", region);
                    if (region == 4) {
                        var span = document.getElementById('region_input_4');
                        span.parentElement.style.display = 'none';
                        $('#seach_address').attr("disabled", false);
                    }
                }
            },
            error: function(error) {
                console.error("Error fetching regcodes:", error);
            }
        });
    }

    function seach_address() {
        var sidoName = $('input[name="region_1"]:checked').next('label').text();
        var sigunguName = $('input[name="region_2"]:checked').next('label').text();
        var dongName = $('input[name="region_3"]:checked').next('label').text();
        var riName = $('input[name="region_4"]:checked').next('label').text();

        var address = sidoName + ' ' + sigunguName + ' ' + dongName + ' ' + riName;

        $('#region_code').val();

        modal_close('address_search')

        $('#roadName').html('<span>도로명</span>' + address + ' 999-99');
        $('#address').val(address + ' 999-99');
        $('#region_address').val(address);
        confrim_check();
    }

    $('#address_no_1').click(function() {
        if ($(this).is(':checked')) {
            $('#address_dong').val('');
            $('#address_dong').attr('disabled', true);
        } else {
            $('#address_dong').attr('disabled', false);
        }
    });

    $('#address_no_2').click(function() {
        if ($(this).is(':checked')) {
            $('#address_detail').val('');
            $('#address_detail').attr('disabled', true);
        } else {
            $('#address_detail').attr('disabled', false);
        }
    });


    //가(임시)주소 클릭 이벤트
    document.getElementById("temporary_address").addEventListener("change", function() {
        var address_1 = document.querySelector(".detail_address_1");
        var address_2 = document.querySelector(".detail_address_2");
        var search_1 = document.querySelector(".search_address_1");
        var search_2 = document.querySelector(".search_address_2");
        var is_temporary_0 = document.querySelector("#is_temporary_0");
        var is_temporary_1 = document.querySelector("#is_temporary_1");

        $('#address').val('');
        $('#roadName').empty();
        $('#jibunName').empty();
        $('#address_detail').val('');
        $('#address_dong').val('');
        $('#address_number').val('');

        if (this.checked) {
            address_1.style.display = "none";
            address_2.classList.add("active");
            search_1.style.display = "none";
            search_2.classList.add("active");
            is_temporary_0.style.display = "none";
            is_temporary_1.style.display = "block";
        } else {
            address_1.style.display = "block";
            address_2.classList.remove("active");
            search_1.style.display = "block";
            search_2.classList.remove("active");
            is_temporary_0.style.display = "block";
            is_temporary_1.style.display = "none";
        }
    });

    // //가(임시)주소 선택하기
    // document.addEventListener("DOMContentLoaded", function() {
    //     document.querySelectorAll('.label').forEach(function(label) {
    //         label.addEventListener("click", function() {
    //             var index = label.getAttribute("for").split("_")[1]; // 인덱스 추출
    //             var regionInputId = "region_input_" + index;
    //             var span = document.getElementById(regionInputId);
    //             span.textContent = label.textContent; // 클릭된 라벨의 텍스트를 span에 입력
    //         });
    //     });
    // });

    // DOMContentLoaded 이벤트가 먼저 실행되므로,
    // 이벤트 리스너를 사용하여 동적으로 생성된 요소에 대한 처리를 추가합니다.
    // document.addEventListener("DOMContentLoaded", function() {
    //     // 모든 라벨에 대한 클릭 이벤트 처리
    //     document.addEventListener("click", function(event) {
    //         var clickedElement = event.target; // 클릭된 요소를 가져옴

    //         // 클릭된 요소가 라벨인 경우
    //         if (clickedElement.classList.contains('label')) {
    //             var forAttr = clickedElement.getAttribute("for"); // for 속성 값 가져오기
    //             var index = forAttr.split("_")[1]; // 인덱스 추출
    //             var regionInputId = "region_input_" + index;
    //             var span = document.getElementById(regionInputId);
    //             span.textContent = clickedElement.textContent; // 클릭된 라벨의 텍스트를 span에 입력
    //         }
    //     });
    // });

    document.addEventListener("DOMContentLoaded", function() {


        // 초기 텍스트 배열
        var initialTexts = ["시/도", "시/군/구", "읍/면/동", "리"];

        // 모든 라벨에 대한 클릭 이벤트 처리
        document.addEventListener("click", function(event) {
            var clickedElement = event.target; // 클릭된 요소를 가져옴

            // 클릭된 요소가 라벨인 경우
            if (clickedElement.classList.contains('label')) {
                var forAttr = clickedElement.getAttribute("for"); // for 속성 값 가져오기
                var index = forAttr.split("_")[1]; // 인덱스 추출
                var regionInputId = "region_input_" + index;
                var span = document.getElementById(regionInputId);

                // 현재 클릭된 라벨의 인덱스
                var currentIndex = parseInt(index) + 1;

                // 현재 클릭된 라벨의 상위 항목을 초기화
                resetUpperRegions(currentIndex);



                // 해당 라벨의 텍스트 설정
                span.textContent = clickedElement.textContent; // 클릭된 라벨의 텍스트를 span에 입력

                var region_code = '';
                // 주소 가져오기
                if (currentIndex < 5) {
                    check_code = $('#' + forAttr).val();
                    if (currentIndex == 2) {
                        region_code = check_code + '*00000'
                    } else if (currentIndex == 3) {
                        region_code = check_code + '*00'
                    } else if (currentIndex == 4) {
                        region_code = check_code + '*'
                    }
                    get_region(region_code, currentIndex);
                } else {
                    $('#seach_address').attr("disabled", false);
                }

                $('#region_code').val(check_code);

            }
        });

        // 상위 지역을 초기화하는 함수
        function resetUpperRegions(currentIndex) {
            for (var i = currentIndex; i <= 4; i++) {
                var regionInputId = "region_input_" + i;
                var span = document.getElementById(regionInputId);
                if (span) {
                    span.textContent = initialTexts[i - 1]; // 초기화 텍스트 설정
                    span.parentElement.style.display = 'none';
                    // 라디오 버튼 해제
                    var radioButtons = document.querySelectorAll('[name="region_' + (i) + '"]');
                    radioButtons.forEach(function(radioButton) {
                        radioButton.checked = false;
                    });
                }
            }
        }
    });
</script>


<script language="javascript">
    // opener관련 오류가 발생하는 경우 아래 주석을 해지하고, 사용자의 도메인정보를 입력합니다. ("팝업API 호출 소스"도 동일하게 적용시켜야 합니다.)
    // document.domain = "{{ env('APP_URL') }}";

    function getAddress() {
        //IE에서 opener관련 오류가 발생하는 경우, window에 이름을 명시해줍니다.
        window.name = "jusoPopup";

        //주소검색을 수행할 팝업 페이지를 호출합니다.
        //호출된 페이지(jusoPopup.jsp)에서 실제 주소검색URL(https://business.juso.go.kr/addrlink/addrLinkUrlJsonp.do)를 호출하게 됩니다.
        var pop = window.open("{{ route('api.popupOpen.getAddress') }}", "pop",
            "width=570,height=420, scrollbars=yes, resizable=yes");
    }


    function jusoCallBack(rtRoadFullAddr, rtAddrPart1, rtAddrDetail, rtAddrPart2, rtEngAddr, rtJibunAddr, rtZipNo,
        rtAdmCd, rtRnMgtSn, rtBdMgtSn, rtDetBdNmList, rtBdNm, rtBdKdcd, rtSiNm, rtSggNm, rtEmdNm, rtLiNm, rtRn,
        rtUdrtYn, rtBuldMnnm, rtBuldSlno, rtMtYn, rtLnbrMnnm, rtLnbrSlno, rtEmdNo, relJibun, rtentX, rtentY) {
        // 팝업페이지에서 주소입력한 정보를 받아서, 현 페이지에 정보를 등록합니다.

        // console.log('RoadFullAddr:', rtRoadFullAddr);
        // console.log('AddrPart1:', rtAddrPart1);
        // console.log('AddrDetail:', rtAddrDetail);
        // console.log('AddrPart2:', rtAddrPart2);
        // console.log('EngAddr:', rtEngAddr);
        // console.log('JibunAddr:', rtJibunAddr);
        // console.log('ZipNo:', rtZipNo);
        // console.log('AdmCd:', rtAdmCd);
        // console.log('RnMgtSn:', rtRnMgtSn);
        // console.log('BdMgtSn:', rtBdMgtSn);
        // console.log('DetBdNmList:', rtDetBdNmList);
        // console.log('BdNm:', rtBdNm);
        // console.log('BdKdcd:', rtBdKdcd);
        // console.log('SiNm:', rtSiNm);
        // console.log('SggNm:', rtSggNm);
        // console.log('EmdNm:', rtEmdNm);
        // console.log('LiNm:', rtLiNm);
        // console.log('Rn:', rtRn);
        // console.log('UdrtYn:', rtUdrtYn);
        // console.log('BuldMnnm:', rtBuldMnnm);
        // console.log('BuldSlno:', rtBuldSlno);
        // console.log('MtYn:', rtMtYn);
        // console.log('LnbrMnnm:', rtLnbrMnnm);
        // console.log('LnbrSlno:', rtLnbrSlno);
        // console.log('EmdNo:', rtEmdNo);
        // console.log('lJibun:', relJibun);
        // console.log('entX:', rtentX);
        // console.log('entY:', rtentY);

        $('#roadName').html('<span>도로명</span>' + rtAddrPart1);
        $('#jibunName').html('<span>지번</span>' + rtJibunAddr);

        $('#address').val(rtAddrPart1)

        if (!$("#address_detail").prop('disabled')) {
            $('#address_detail').val(rtAddrDetail);
        }

        $('#region_code').val(rtAdmCd);
        $('#region_address').val(rtSiNm + ' ' + rtSggNm + ' ' + rtEmdNm + ' ' + rtLiNm);

        var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

        $('input[name=address_lng]').val(wgs84Coords[0]);
        $('input[name=address_lat]').val(wgs84Coords[1]);

        callJusoroMapApiType1(rtentX, rtentY);

        console.log('주소 검색 끝!');

        confrim_check();

    }

    // type1.좌표정보(GRS80, EPSG:5179)
    function callJusoroMapApiType1(rtentX, rtentY) {
        window.postMessage({
            functionName: 'callJusoroMapApi',
            params: [rtentX, rtentY]
        }, '*');
    }
</script>
