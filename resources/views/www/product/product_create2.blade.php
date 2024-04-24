<x-layout>

    <form class="find_form" method="POST" action="{{ route('www.product.create.address.check') }}" name="create_check">
        <input name="address_lng" id="address_lng" value="">
        <input name="address_lat" id="address_lat" value="">
    </form>

    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span class="txt_point">2</span>/3</span>
            </h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>위치 및 주소 <span class="txt_point">*</span></h4>

                    <div class="address_reg_wrap">
                        <div class="inner_item">
                            <div class="search_address_1 active">
                                <button class="btn_graylight_ghost btn_full_thin txt_r" onclick="getAddress()">
                                    주소 검색
                                </button>
                            </div>
                            <div class="search_address_2">
                                <button class="btn_graylight_ghost btn_full_thin txt_r"
                                    onclick="modal_open('address_search')">가(임시)주소 검색</button>
                            </div>
                            <div class="mt8 gap_14">
                                <input type="checkbox" name="temporary_address" id="temporary_address" value="Y">
                                <label for="temporary_address" class="gray_deep"><span></span> 가(임시)주소</label>
                                <div id="is_unregistered" style="display: none">
                                    <input type="checkbox" name="unregistered" id="unregistered" value="Y">
                                    <label for="unregistered" class="gray_deep"><span></span> 미등기</label>
                                </div>
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
                                <div>
                                    <input type="text" name="address_detail" id="address_detail"
                                        placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호">
                                </div>
                                <div class="mt8">
                                    <input type="checkbox" name="address_no" id="address_no_2" value="Y">
                                    <label for="address_no_2" class="gray_deep"><span></span> 상세주소 없음</label>
                                </div>
                            </div>

                            <div class="detail_address_2 mt18">
                                <div class="flex_2">
                                    <div class="flex_1">
                                        <input type="text" name="address_dong" id="address_dong">
                                        <span>동</span>
                                    </div>
                                    <div class="flex_1">
                                        <input type="text" name="address_number" id="address_number">
                                        <span>호</span>
                                    </div>
                                </div>
                                <div class="mt8">
                                    <input type="checkbox" name="address_no" id="address_no_1" value="Y">
                                    <label for="address_no_1" class="gray_deep"><span></span> 동정보 없음</label>
                                </div>
                            </div>

                        </div>

                        <div class="inner_item inner_map only_pc">
                            <div id="is_temporary_0">
                                주소 검색 시,<br>해당 위치가 지도에 표시됩니다.
                            </div>
                            <div id="is_temporary_1" style="display: none">
                                가(임시)주소 선택시,<br>지도 노출이 불가능합니다.
                            </div>
                        </div>

                    </div>
                </div>

                <div class="step_btn_wrap">
                    <button class="btn_full_basic btn_graylight_ghost"
                        onclick="location.href='estate_reg_1.html'">이전</button>
                    <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point" onclick="location.href='estate_reg_3.html'">다음</button>
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
                <li><span id="region_input_2">시/군/구</span></li>
                <li><span id="region_input_3">읍/면/동</span></li>
                <li><span id="region_input_4">리</span></li>
            </ul>
            <div class="tab_area_wrap adress_select_wrap  mt20">
                <div>
                    <div class="point_sm_filter cell_4 city">
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_1" value="Y">
                            <label class="label" for="region_1_1">강원도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_2" value="Y">
                            <label class="label" for="region_1_2">경기도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_3" value="Y">
                            <label class="label" for="region_1_3">경상남도</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_4" value="Y">
                            <label class="label" for="region_1_4">광주광역시</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_5" value="Y">
                            <label class="label" for="region_1_5">대구광역시</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_1" id="region_1_6" value="Y">
                            <label class="label" for="region_1_6">세종특별자치시</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_2" id="region_2_1" value="Y">
                            <label class="label" for="region_2_1">강남구</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_2" id="region_2_2" value="Y">
                            <label class="label" for="region_2_2">강동구</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_3" id="region_3_1" value="Y">
                            <label class="label" for="region_3_1">개포동</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_3" id="region_3_2" value="Y">
                            <label class="label" for="region_3_2">논현동</label>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="point_sm_filter cell_4">
                        <div class="cell">
                            <input type="radio" name="region_4" id="region_4_1" value="Y">
                            <label class="label" for="region_4_1">개곡리</label>
                        </div>
                        <div class="cell">
                            <input type="radio" name="region_4" id="region_4_2" value="Y">
                            <label class="label" for="region_4_2">개곡리</label>
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
    <!-- modal 가(임시)주소 검색 : e-->

    <script>
        $(document).ready(function() {
            var type = sessionStorage.getItem("typeSession")

            // 매물 타입이 분양권일 경우 활성화
            if (type > 13) {
                $('#is_unregistered').css('display', '')
            }

            // 기본 세팅
            var regcode = '*00000000';

            // 시군구 가져오는 api
            var gatewayUrl =
                "https://grpc-proxy-server-mkvo6j4wsq-du.a.run.app/v1/regcodes?regcode_pattern=" + regcode;

            $.ajax({
                url: gatewayUrl,
                method: "GET",
                dataType: "json",
                success: function(response) {
                    // Check if 'regcodes' property exists and is an array
                    if (response.regcodes && Array.isArray(response.regcodes)) {
                        var div = $("#city_code");

                        // Iterate over the 'regcodes' array
                        response.regcodes.forEach(function(regcodeObj) {
                            // Assuming 'code' is the property you want to use for the option value
                            var regcode = regcodeObj.code;
                            // Assuming 'name' is the property you want to use for the option text
                            var name = regcodeObj.name;
                            regcode.substring(0, 2)
                            div.append(`<div class="cell">`+
                                            `<input type="radio" name="region_1" id="region_1_N" value="`+ regcode.substring(0, 2)+`">`+
                                            `<label class="label" for="region_1_N">` + name + `</label>`+
                                        `</div>`);
                        });
                    } else {
                        console.error("Invalid response format. 'regcodes' array not found.");
                    }
                },
                error: function(error) {
                    console.error("Error fetching regcodes:", error);
                }
            });
        });

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

        //가(임시)주소 선택하기
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.label').forEach(function(label) {
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

        console.log('RoadFullAddr:', rtRoadFullAddr);
        console.log('AddrPart1:', rtAddrPart1);
        console.log('AddrDetail:', rtAddrDetail);
        console.log('AddrPart2:', rtAddrPart2);
        console.log('EngAddr:', rtEngAddr);
        console.log('JibunAddr:', rtJibunAddr);
        console.log('ZipNo:', rtZipNo);
        console.log('AdmCd:', rtAdmCd);
        console.log('RnMgtSn:', rtRnMgtSn);
        console.log('BdMgtSn:', rtBdMgtSn);
        console.log('DetBdNmList:', rtDetBdNmList);
        console.log('BdNm:', rtBdNm);
        console.log('BdKdcd:', rtBdKdcd);
        console.log('SiNm:', rtSiNm);
        console.log('SggNm:', rtSggNm);
        console.log('EmdNm:', rtEmdNm);
        console.log('LiNm:', rtLiNm);
        console.log('Rn:', rtRn);
        console.log('UdrtYn:', rtUdrtYn);
        console.log('BuldMnnm:', rtBuldMnnm);
        console.log('BuldSlno:', rtBuldSlno);
        console.log('MtYn:', rtMtYn);
        console.log('LnbrMnnm:', rtLnbrMnnm);
        console.log('LnbrSlno:', rtLnbrSlno);
        console.log('EmdNo:', rtEmdNo);
        console.log('lJibun:', relJibun);
        console.log('entX:', rtentX);
        console.log('entY:', rtentY);

        $('#roadName').html('<span>도로명</span>' + rtAddrPart1);
        $('#jibunName').html('<span>지번</span>' + rtJibunAddr);

        if (!$("#address_detail").prop('disabled')) {
            $('#address_detail').val(rtAddrDetail);
        }


        var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

        $('input[name=address_lng]').val(wgs84Coords[0]);
        $('input[name=address_lat]').val(wgs84Coords[1]);

        console.log('주소 검색 끝!');

    }
</script>
