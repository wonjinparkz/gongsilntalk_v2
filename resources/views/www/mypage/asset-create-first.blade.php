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

        <form method="get" action="{{ route('www.mypage.service.create.second.view') }}" id="create_form"
            name="create_form">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">자산 등록하기 <span class="step_number"><span class="txt_point">1</span>/4</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>부동산 유형 <span class="txt_point">*</span></h4>
                        <ul class="tab_type_3 tab_toggle_menu">
                            <li class="active" onclick="onTypeChange(0);">상업용</li>
                            <li onclick="onTypeChange(1);">주거용</li>
                            <li onclick="onTypeChange(2);">분양권</li>
                        </ul>
                        <div class="tab_area_wrap">
                            <div>
                                <div class="btn_radioType">
                                    <input type="radio" name="type_detail" id="type_detail_1" value="0" checked>
                                    <label for="type_detail_1">지식산업센터</label>

                                    <input type="radio" name="type_detail" id="type_detail_2" value="1">
                                    <label for="type_detail_2">사무실</label>

                                    <input type="radio" name="type_detail" id="type_detail_3" value="2">
                                    <label for="type_detail_3">창고</label>

                                    <input type="radio" name="type_detail" id="type_detail_4" value="3">
                                    <label for="type_detail_4">상가</label>

                                    <input type="radio" name="type_detail" id="type_detail_5" value="4">
                                    <label for="type_detail_5">기숙사</label>

                                    <input type="radio" name="type_detail" id="type_detail_6" value="5">
                                    <label for="type_detail_6">건물</label>

                                    <input type="radio" name="type_detail" id="type_detail_7" value="6">
                                    <label for="type_detail_7">토지/임야</label>

                                    <input type="radio" name="type_detail" id="type_detail_8" value="7">
                                    <label for="type_detail_8">단독 공장</label>
                                </div>
                            </div>
                            <div>
                                <div class="btn_radioType">
                                    <input type="radio" name="type_detail" id="type_detail_9" value="8">
                                    <label for="type_detail_9">아파트</label>

                                    <input type="radio" name="type_detail" id="type_detail_10" value="9">
                                    <label for="type_detail_10">오피스텔</label>

                                    <input type="radio" name="type_detail" id="type_detail_11" value="10">
                                    <label for="type_detail_11">단독/다가구</label>

                                    <input type="radio" name="type_detail" id="type_detail_12" value="11">
                                    <label for="type_detail_12">다세대/빌라/연립</label>

                                    <input type="radio" name="type_detail" id="type_detail_13" value="12">
                                    <label for="type_detail_13">상가주택</label>

                                    <input type="radio" name="type_detail" id="type_detail_14" value="13">
                                    <label for="type_detail_14">주택</label>
                                </div>
                            </div>

                            <div>
                                <div class="btn_radioType">
                                    <input type="radio" name="type_detail" id="type_detail_15" value="14">
                                    <label for="type_detail_15">지식산업센터 분양권</label>

                                    <input type="radio" name="type_detail" id="type_detail_16" value="15">
                                    <label for="type_detail_16">상가 분양권</label>

                                    <input type="radio" name="type_detail" id="type_detail_17" value="16">
                                    <label for="type_detail_17">아파트 분양권</label>

                                    <input type="radio" name="type_detail" id="type_detail_18" value="17">
                                    <label for="type_detail_18">오피스텔 분양권</label>
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
                        <input type="text" name="address" id="address" value="" style="display: none;">
                        <input type="hidden" name="old_address" id="old_address" value="">

                        <input type="hidden" name="asset_address_id" id="asset_address_id" value="N">

                        <div class="address_reg_wrap">
                            <div class="inner_item">
                                <div class="search_address_1 active">
                                    <button class="btn_graylight_ghost btn_full_thin txt_r" type="button"
                                        onclick="getAddress()">주소
                                        검색</button>
                                </div>
                                <div class="search_address_2">
                                    <button class="btn_graylight_ghost btn_full_thin txt_r" type="button"
                                        onclick="modal_open('address_search')">(구)주소 검색</button>
                                </div>
                                <div class="mt8 gap_14">
                                    <input type="checkbox" name="is_map" id="is_map" value="Y">
                                    <label for="is_map" class="gray_deep"><span></span> (구)주소</label>
                                </div>
                                <!----------------- M:: map : s ----------------->
                                <div class="inner_item inner_map only_m mapOnlyMobile">
                                    <div id="mapWrap" class="mapWrap"
                                        style="width: 100%; height: 100%; border-left: 1px solid #ddd;"></div>
                                    {{-- 주소 검색 시,<br>해당 위치가 지도에 표시됩니다. --}}
                                </div>
                                <!----------------- M:: map : e ----------------->
                                <div class="inner_address">
                                    <div class="address_row" id="roadName">
                                    </div>
                                    <div class="address_row" id="jibunName">
                                    </div>
                                </div>

                                <div class="detail_address_2 mt18 active">
                                    <div>
                                        <input type="text" id="address_detail" name="address_detail"
                                            value="{{ old('address_detail') }}"
                                            placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호">
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
                            <div class="inner_item inner_map only_pc mapOnlyPc">

                            </div>
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <h4>기본 정보</h4>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">공급 면적 <span class="txt_point">*</span></label>
                                <div class="input_pyeong_area">
                                    <div><input type="text" id="area" name="area" placeholder="공급 면적"
                                            inputmode="numeric" oninput="onlyNumbers(this);area_change('');">
                                        <span class="gray_deep">평</span>
                                    </div>
                                    <span class="gray_deep">/</span>
                                    <div><input type="text" id="square" name="square" inputmode="numeric"
                                            oninput="imsi(this); square_change('');" placeholder="평 입력시 자동">
                                        <span class="gray_deep">㎡</span>
                                    </div>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">전용 면적 <span class="txt_point">*</span></label>
                                <div class="input_pyeong_area">
                                    <div><input type="text" id="exclusive_area" name="exclusive_area"
                                            inputmode="numeric" oninput="onlyNumbers(this);area_change('exclusive_')"
                                            placeholder="전용 면적"> <span class="gray_deep">평</span>
                                    </div>
                                    <span class="gray_deep">/</span>
                                    <div><input type="text" id="exclusive_square" name="exclusive_square"
                                            inputmode="numeric" oninput="imsi(this); square_change('exclusive_')"
                                            placeholder="평 입력시 자동">
                                        <span class="gray_deep">㎡</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">명의구분 <span class="txt_point">*</span></label>
                                <div class="btn_radioType">
                                    <input type="radio" name="name_type" id="name_type_1" value="0" checked>
                                    <label for="name_type_1" onclick="showDiv('share', 0)">단독명의</label>

                                    <input type="radio" name="name_type" id="name_type_2" value="1">
                                    <label for="name_type_2" onclick="showDiv('share', 1)">공동명의</label>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">사업자구분 <span class="txt_point">*</span></label>
                                <div class="btn_radioType">
                                    <input type="radio" name="business_type" id="business_type_1" value="0"
                                        checked>
                                    <label for="business_type_1">개인사업자</label>

                                    <input type="radio" name="business_type" id="business_type_2" value="1">
                                    <label for="business_type_2">법인사업자</label>

                                    <input type="radio" name="business_type" id="business_type_3" value="2">
                                    <label for="business_type_3">개인</label>
                                </div>
                            </div>
                        </div>
                        <div class="reg_mid_wrap">
                            <div class="share_wrap mt8">
                                <div class="share_item open_key active"></div>
                                <div class="share_item open_key">
                                    <div class="reg_item">
                                        <div class="input_pyeong_area">
                                            <div>
                                                <label class="input_label">
                                                    지분율
                                                </label>
                                                <input type="text" name="ownership_share" placeholder="예)70"
                                                    inputmode="numeric"
                                                    oninput="onlyNumbers(this); validateInput(this, 100);">
                                                <span class="gray_deep">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="step_btn_wrap">
                        <span></span>
                        <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point" id="nextPageButton" name="nextPageButton"
                            type="button" onclick="onFormSubmit();" disabled>다음</button>
                    </div>
                </div>
            </div>
            <!-- my_body : e -->

            <input type="hidden" id="is_temporary" name="is_temporary" value="0">
            <input type="hidden" id="is_unregistered" name="is_unregistered" value="0">
            <input type="hidden" id="type" name="type" value="0">
        </form>
    </div>

    <!-- modal 주소 추가 할건지 안내 : s-->
    <div class="modal modal_address_add">
        <div class="modal_container">
            <div class="modal_mss_wrap">
                <p class="txt_item_1">등록 내역이 있는 주소 입니다.</p>
                <p class="txt_item_1 txt_point">동일한 주소로 신규 부동산 등록을</p>
                <p class="txt_item_1 txt_point">진행하시겠습니까?</p>
            </div>

            <div class="modal_btn_wrap">
                <button class="btn_gray btn_full_thin" type="button" onclick="onAssetAddressDelete();">취소</button>
                <button class="btn_point btn_full_thin" type="button" onclick="modal_close('address_add')">등록
                    진행</button>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_address_add" onclick="modal_close('address_add')"></div>
    <!-- modal 주소 추가 할건지 안내 : e-->

    <x-user-temporary-address />

    <script type="text/javascript"
        src="https://business.juso.go.kr/juso_support_center/js/addrlink/map/jusoro_map_api.min.js?confmKey={{ env('CONFM_MAP_KEY') }}&skinType=1">
    </script>
    <style>
        .zoomIcon {
            padding: 0px !important;
        }
    </style>

    <script>
        //입력란 열고 닫기
        function showDiv(className, index) {
            var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }

        // 평수 제곱 변환
        function square_change(name) {
            var area_name = name + 'area';
            var square_name = name + 'square';

            var square = $('#' + square_name).val();

            if (square > 0) {
                var convertedArea = Math.round(square / 3.3058); // 평수로 변환하여 정수로 반올림
                $('#' + area_name).val(convertedArea);
            } else {
                $('#' + square_name).val('');
                $('#' + area_name).val('');
            }
        }

        // 평수 제곱 변환
        function area_change(name) {

            var area_name = name + 'area';
            var square_name = name + 'square';

            var area = $('#' + area_name).val();

            if (area > 0) {
                var convertedSquare = (area * 3.3058).toString();
                var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
                $('#' + square_name).val(convertedSquare.substr(0, decimalIndex));
            } else {
                $('#' + area_name).val('');
                $('#' + square_name).val('');
            }
        }



        function onTypeChange(index) {
            $('#type').val(index);
            if (index == 1) {
                $("#type_detail_9").prop("checked", true);
            } else if (index == 2) {
                $("#type_detail_15").prop("checked", true);
            } else {
                $("#type_detail_1").prop("checked", true);
            }
        }

        function onFormSubmit() {

            // 임시 주소 인지 체크
            if (document.getElementById('is_map').checked == true) {
                $('#is_temporary').val(1);
            }

            var form = document.create_form;
            form.submit();
        }

        function isStringValue(val) {
            return !!val?.trim()
        }

        function debounce(func, timeout = 300) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        function confirm_check() {

            var minusVal = 0;

            if (document.getElementById('address_no_2').checked == false) {
                ($('#address_detail').val() != '') ? true: minusVal++;
            }
            ($('#address').val() != '') ? true: minusVal++;
            ($('#area').val() != '') ? true: minusVal++;
            ($('#square').val() != '') ? true: minusVal++;
            ($('#exclusive_area').val() != '') ? true: minusVal++;
            ($('#exclusive_square').val() != '') ? true: minusVal++;

            if (minusVal == 0) {
                document.getElementById('nextPageButton').disabled = false;
            } else {
                document.getElementById('nextPageButton').disabled = true;
            }
        }

        const processChange = debounce(() => confirm_check());

        addEventListener("input", (event) => {
            processChange();
        });

        addEventListener("checkbox", (event) => {
            processChange();
        });


        $(document).ready(function() {

            // 모바일 / PC 각 div 에 mapOnlyMobile / mapOnlyPc 클래스 명 추가해주세요!
            if (document.body.offsetWidth > 767) {
                var mobileDiv = document.querySelector(".mapOnlyMobile");
                var pcDiv = document.querySelector(".mapOnlyPc");
                while (mobileDiv.firstChild) {
                    pcDiv.appendChild(mobileDiv.firstChild);
                }
            }

            var type = sessionStorage.getItem("typeSession");

            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
                .remove();
        });

        function formSetting() {

            var is_temporary = $('#is_map').is(':checked');
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

            $('.find_form').submit();
        }

        $('#address_no_2').click(function() {
            if ($(this).is(':checked')) {
                $('#address_detail').val('');
                $('#address_detail').attr('disabled', true);
            } else {
                $('#address_detail').attr('disabled', false);
            }
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
            "width=450,height=420, scrollbars=yes, resizable=yes");
    }


    function jusoCallBack(rtRoadFullAddr, rtAddrPart1, rtAddrDetail, rtAddrPart2, rtEngAddr, rtJibunAddr, rtZipNo,
        rtAdmCd, rtRnMgtSn, rtBdMgtSn, rtDetBdNmList, rtBdNm, rtBdKdcd, rtSiNm, rtSggNm, rtEmdNm, rtLiNm, rtRn,
        rtUdrtYn, rtBuldMnnm, rtBuldSlno, rtMtYn, rtLnbrMnnm, rtLnbrSlno, rtEmdNo, relJibun, rtentX, rtentY) {

        $('#roadName').html('<span>도로명</span>' + rtAddrPart1);
        $('#jibunName').html('<span>지번</span>' + rtJibunAddr);

        $('#address').val(rtAddrPart1);
        $('#old_address').val(rtJibunAddr);

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

        confirm_check();
        usersAddressList($('#old_address').val());
    }

    // type1.좌표정보(GRS80, EPSG:5179)
    function callJusoroMapApiType1(rtentX, rtentY) {
        window.postMessage({
            functionName: 'callJusoroMapApi',
            params: [rtentX, rtentY]
        }, '*');
    }

    function usersAddressList(address) {

        $.ajax({
            type: "GET",
            url: "{{ route('www.my.address.list') }}",
            data: {
                'old_address': address
            },
            success: function(result) {
                console.log(result.result);
                if (result.result == null) {
                    console.log('없어요');
                } else {
                    $('#asset_address_id').val(result.result.id);
                    modal_open('address_add');
                    console.log('있네여');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("주소 목록을 불러오지 못했습니다.")
            }
        });
    }

    function onAssetAddressDelete() {
        $('#asset_address_id').val('N');

        modal_close('address_add');
    }
</script>
