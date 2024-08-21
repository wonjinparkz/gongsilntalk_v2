<x-layout>

    <form class="find_form" method="GET" action="{{ route('www.corp.proposal.product.create2.view') }}"
        name="create_check">
        <input type="hidden" name="corp_proposal_id" id="corp_proposal_id" value="{{ $corp_proposal_id }}">
        <input type="hidden" name="product_type" id="product_type" value="{{ old('product_type') ?? '0' }}">
        <input type="hidden" name="type" id="type" value="{{ old('type') ?? '0' }}">
        <input type="hidden" name="address_lng" id="address_lng" value="{{ old('address_lng') ?? '' }}">
        <input type="hidden" name="address_lat" id="address_lat" value="{{ old('address_lat') ?? '' }}">
        <input type="hidden" name="region_code" id="region_code" value="{{ old('region_code') ?? '' }}">
        <input type="hidden" name="region_address" id="region_address" value="{{ old('region_address') ?? '' }}">
        <input type="hidden" name="address" id="address" value="{{ old('address') ?? '' }}">

        <!----------------------------- m::header bar : s ----------------------------->
        <div class="m_header">
            <div class="left_area"><a href="javascript:history.go(-1)"><img
                        src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
            <div class="m_title">신규 건물 <span class="gray_basic"><span class="txt_point">1</span>/3</span></div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">신규 건물 등록 <span class="step_number"><span
                            class="txt_point">1</span>/3</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>매물 유형 <span class="txt_point">*</span></h4>
                        <ul class="tab_type_3 tab_toggle_menu">
                            <li class="active" onclick="showDiv('category', 0)">상업용</li>
                            <li onclick="showDiv('category', 1)">주거용</li>
                        </ul>
                        <div class="tab_area_wrap">

                            <div>
                                <div class="btn_radioType">
                                    @for ($i = 0; $i < 6; $i++)
                                        <input type="radio" name="input_type" id="type_{{ $i }}"
                                            value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                                        <label
                                            for="type_{{ $i }}">{{ Lang::get('commons.corp_product_type.' . $i) }}</label>
                                    @endfor
                                </div>
                            </div>

                            <div>
                                <div class="btn_radioType">
                                    @for ($i = 6; $i < count(Lang::get('commons.corp_product_type')); $i++)
                                        <input type="radio" name="input_type" id="type_{{ $i }}"
                                            value="{{ $i }}">
                                        <label
                                            for="type_{{ $i }}">{{ Lang::get('commons.corp_product_type.' . $i) }}</label>
                                    @endfor
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="offer_step_wrap">
                        <div class="box_01 box_reg">
                            <h4>위치 및 주소 <span class="txt_point">*</span></h4>

                            <div class="address_reg_wrap">
                                <div class="inner_item">
                                    <div class="search_address_1 active">
                                        <button type="button" class="btn_graylight_ghost btn_full_thin txt_r"
                                            onclick="getAddress()">
                                            주소 검색
                                        </button>
                                    </div>
                                    <div class="search_address_2">
                                        <button type="button" class="btn_graylight_ghost btn_full_thin txt_r"
                                            onclick="modal_open('address_search')">(구)주소 검색</button>
                                    </div>
                                    <div class="mt8 gap_14">
                                        <input type="checkbox" name="is_map" id="is_map" value="1">
                                        <label for="is_map" class="gray_deep"><span></span> (구)주소</label>
                                    </div>
                                    <!----------------- M:: map : s ----------------->
                                    <div class="inner_item inner_map only_m mapOnlyMobile">
                                        <div id="mapWrap" class="mapWrap"
                                            style="width: 100%; height: 100%; border-left: 1px solid #ddd;"></div>
                                        <div class="is_map_1" style="display: none">
                                            (구)주소 선택시,<br>지도 노출이 불가능합니다.
                                        </div>
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
                                            <div class="col-lg-5 fv-row">
                                                <label class="gray_deep">상세주소 <span class="txt_point">*</span></label>
                                                <input type="text" class="mt8" name="address_detail"
                                                    id="address_detail" placeholder="상세주소 입력 예) 1동 101호">
                                            </div>
                                            <div class="col-lg-5 fv-row">
                                                <label class="gray_deep">건물명 <span class="txt_point">*</span></label>
                                                <input type="text" class="mt8" name="product_name"
                                                    id="product_name" placeholder="건물명을 입력해주세요">
                                            </div>
                                        </div>
                                        <div class="mt8">
                                            <input type="checkbox" name="is_address_detail" id="is_address_detail"
                                                value="1">
                                            <label for="is_address_detail" class="gray_deep"><span></span> 상세주소
                                                없음</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="inner_item inner_map only_pc mapOnlyPc">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="step_btn_wrap">
                        <span></span>
                        <button class="btn_full_basic btn_point confirm" disabled onclick="formSetting();">다음</button>
                    </div>
                </div>
            </div>
            <!-- my_body : e -->

        </div>

    </form>


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
        $(document).ready(function() {
            confirm_check();

            // 모바일 / PC 각 div 에 mapOnlyMobile / mapOnlyPc 클래스 명 추가해주세요!
            if (document.body.offsetWidth > 767) {
                var mobileDiv = document.querySelector(".mapOnlyMobile");
                var pcDiv = document.querySelector(".mapOnlyPc");
                while (mobileDiv.firstChild) {
                    pcDiv.appendChild(mobileDiv.firstChild);
                }
            }

            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
                .remove();
        });

        $('input[type="checkbox"]').on('click chage keyup', function() {
            confirm_check();
        });

        $('input[type="radio"]').on('click chage keyup', function() {
            confirm_check();
        });

        $('input[type="number"]').on('chage keyup', function() {
            confirm_check();
        });

        $('input[type="text"]').on('chage keyup', function() {
            confirm_check();
        });

        function confirm_check() {
            var type = $('input[name="input_type"]:checked').val();
            var address = $('#address').val();
            var address_detail = $('#address_detail').val();
            var is_address_detail = $('#is_address_detail').is(':checked');
            var product_name = $('#product_name').val();

            if (type != '' && address != '' && product_name != '' && (is_address_detail || (!
                    is_address_detail && address_detail != ''))) {
                return $('.confirm').attr("disabled", false);
            } else {
                return $('.confirm').attr("disabled", true);
            }
        }

        function formSetting() {
            var is_map = $('#is_map').is(":checked");

            var corp_proposal_id = $('#corp_proposal_id').val();
            var product_type = $('#product_type').val();
            var type = $('#type').val();
            var address_lng = $('#address_lng').val();
            var address_lat = $('#address_lat').val();
            var region_code = $('#region_code').val();
            var region_address = $('#region_address').val();
            var address = $('#address').val();
            var product_name = $('#product_name').val();

            sessionStorage.setItem("is_mapSession", is_map ? '0' : '1');
            sessionStorage.setItem("corp_proposal_idSession", corp_proposal_id);
            sessionStorage.setItem("product_typeSession", product_type);
            sessionStorage.setItem("typeSession", type);
            sessionStorage.setItem("address_lngSession", address_lng);
            sessionStorage.setItem("address_latSession", address_lat);
            sessionStorage.setItem("region_codeSession", region_code);
            sessionStorage.setItem("region_addressSession", region_address);
            sessionStorage.setItem("addressSession", address);
            sessionStorage.setItem("product_nameSession", address_detail);

            $('.find_form').submit();
        }

        //입력란 열고 닫기
        function showDiv(className, index) {
            $('#product_type').val(index);

            if (index == 0) {
                $('#type_0').click();
            } else if (index == 1) {
                $('#type_6').click();
            }
        }

        function is_address() {
            if ($('#is_address_detail').is(':checked')) {
                $('#address_detail').val('');
                $('#address_detail').attr('disabled', true);
            } else {
                $('#address_detail').attr('disabled', false);
            }
        }
        $('#is_address_detail').click(function() {
            if ($(this).is(':checked')) {
                $('#address_detail').val('');
                $('#address_detail').attr('disabled', true);
            } else {
                $('#address_detail').attr('disabled', false);
            }
        });

        // $('#is_product_name').click(function() {
        //     if ($(this).is(':checked')) {
        //         $('#product_name').val('');
        //         $('#product_name').attr('disabled', true);
        //     } else {
        //         $('#product_name').attr('disabled', false);
        //     }
        // });
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
                "width=450,height=420, scrollbars=yes, resizable=yes");
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

            $('#address').val(rtAddrPart1)
            $('#address_detail').val(rtAddrDetail)

            $('#region_code').val(rtAdmCd);
            $('#region_address').val(rtSiNm + ' ' + rtSggNm + ' ' + rtEmdNm + ' ' + rtLiNm);

            var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

            $('input[name=address_lng]').val(wgs84Coords[0]);
            $('input[name=address_lat]').val(wgs84Coords[1]);

            callJusoroMapApiType1(rtentX, rtentY);

            console.log('주소 검색 끝!');

            confirm_check();

        }

        // type1.좌표정보(GRS80, EPSG:5179)
        function callJusoroMapApiType1(rtentX, rtentY) {
            window.postMessage({
                functionName: 'callJusoroMapApi',
                params: [rtentX, rtentY]
            }, '*');
        }
    </script>

</x-layout>
