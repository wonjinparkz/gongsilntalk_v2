<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">중개사무소 정보 입력</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        <div class="inner_wrap">
            <form class="form" method="POST" action="{{ route('www.register.join.check') }}">
                <div class="col-md-6 box_member">
                    <h2 class="only_pc">중개사무소 정보 입력</h2>
                    <ul class="login_wrap reg_bascic">
                        <li>
                            <p class="txt_sub">‘중개사무소 조회하기’로 중개사무소를 검색하시면 관련 정보가 자동입력됩니다.</p>
                            <div class="mt10">
                                <button type="button" class="btn_black_ghost btn_full_basic"
                                    onclick="modal_open('realtor_search')">중개사무소
                                    조회하기</button>
                            </div>
                            <div class="realtor_result">
                                <div>사업자 상호</div>
                                <div id="company_name">{{ old('company_name') ?? '' }}</div>
                                <input class="input_check" type="hidden" name="company_name"
                                    value="{{ old('company_name') ?? '' }}">
                                <div>대표자명</div>
                                <div id="company_ceo">{{ old('company_ceo') ?? '' }}</div>
                                <input class="input_check" type="hidden" name="company_ceo"
                                    value="{{ old('company_ceo') ?? '' }}">
                                <div>중개등록번호</div>
                                <div id="brokerage_number">{{ old('brokerage_number') ?? '' }}</div>
                                <input class="input_check" type="hidden" name="brokerage_number"
                                    value="{{ old('brokerage_number') ?? '' }}">
                            </div>
                        </li>
                        <li>
                            <label>사업자 등록 번호 <span class="txt_point">*</span></label>
                            <input class="input_check" type="text" id="company_number" name="company_number"
                                placeholder="123-45-67590" oninput="autoHyphen(this)" maxlength="12"
                                value="{{ old('company_number') ?? '' }}">
                        </li>
                        <li>
                            <label>대표 번호</label>
                            <input type="text" id="company_phone" name="company_phone" placeholder="숫자만 입력해  주세요."
                                value="{{ old('company_phone') ?? '' }}">
                        </li>
                        <li>
                            <label>주소지</label>
                            <div class="flex_1">
                                <input type="text" id="company_address" name="company_address" readonly
                                    value="{{ old('company_address') ?? '' }}">
                                <input type="hidden" id="company_postcode" name="company_postcode"
                                    value="{{ old('company_postcode') ?? '' }}">
                                <input type="hidden" id="company_address_lat" name="company_address_lat"
                                    value="{{ old('company_address_lat') ?? '' }}">
                                <input type="hidden" id="company_address_lng" name="company_address_lng"
                                    value="{{ old('company_address_lng') ?? '' }}">
                                <button type="button" class="btn_point" onclick="getAddress()">검색</button>
                            </div>
                            <div class="mt8">
                                <input type="text" id="company_address_detail" name="company_address_detail"
                                    placeholder="상세주소를 입력해 주세요." value="{{ old('company_address_detail') ?? '' }}">
                            </div>
                        </li>
                        <li>
                            <label>개업일 <span class="txt_point">*</span></label>
                            <input class="input_check" type="text" placeholder="20240101" id="opening_date"
                                maxlength="8" name="opening_date" value="{{ old('opening_date') ?? '' }}">
                        </li>
                        <li>
                            <div class="file_reg_wrap">
                                <div class="file_item">
                                    <label>사업자등록증</label>
                                    <x-one-image-picker :title="''" id="company" cnt="1"
                                        required="required" />
                                    {{-- <div class="file_area file_load">
                                    <img src="{{ asset('assets/media/download_sample_2.png') }}">
                                </div> --}}
                                </div>

                                <div class="file_item">
                                    <label>중개등록증</label>
                                    <x-one-image-picker :title="''" id="business" cnt="1"
                                        required="required" />
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="mt40">
                        <button type="button" class="btn_point btn_full_basic confirm" disabled
                            onclick="businessCheck();">다음</button>
                    </div>

                </div>

            </form>
        </div>

    </div>

    <!-- modal 중개사무소 조회 : s-->
    <div class="modal modal_mid modal_realtor_search">
        <div class="modal_title">
            <h5>중개사무소 조회</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('realtor_search')">
        </div>
        <div class="modal_container">
            <div class="flex_1">
                <input type="text" id="corp_ceo" placeholder="중개사무소명 또는 중개업자명으로 검색">
                <button type="button" class="btn_point" id="search_button">검색</button>
            </div>
            <div class="search_result_wrap">
                <div class="empty_wrap sm_type"><span>중개사무소 개설 등록 당시<br>신고한 내용을 기준으로 검색해주세요.</span></div>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_realtor_search" onclick="modal_close('realtor_search')"></div>
    <!-- modal 중개사무소 조회 : e-->


</x-layout>
<script>
    const autoHyphen = (target) => {
        target.value = target.value
            .replace(/[^0-9]/g, '')
            .replace(/^(\d{0,3})(\d{0,2})(\d{0,5})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
    }

    $('#search_button').click(function() {
        if ($('#corp_ceo').val() == "") {
            alert("중개사무소명 또는 중개업자명을 입력해 주세요.");
            return;
        }

        var data = {};
        // data.key = "E2C5234B-AE55-3D0D-91C0-6A61FFE0A48B";
        data.key = "{{ env('V_WORD_KEY') }}";
        data.domain = "k-late.com";
        data.format = "json";
        data.numOfRows = "30";
        data.pageNo = "1";
        var searchQuery = $('#corp_ceo').val();

        function searchByBsnmCmpnm(callback) {
            data.bsnmCmpnm = searchQuery;
            data.brkrNm = "";
            $.ajax({
                type: "get",
                dataType: "jsonp",
                url: "https://api.vworld.kr/ned/data/getEBBrokerInfo",
                data: data,
                async: false,
                success: function(data) {
                    callback(data);
                },
                error: function(xhr, stat, err) {
                    callback(null);
                }
            });
        }

        function searchByBrkrNm(callback) {
            data.bsnmCmpnm = "";
            data.brkrNm = searchQuery;
            $.ajax({
                type: "get",
                dataType: "jsonp",
                url: "https://api.vworld.kr/ned/data/getEBBrokerInfo",
                data: data,
                async: false,
                success: function(data) {
                    callback(data);
                },
                error: function(xhr, stat, err) {
                    callback(null);
                }
            });
        }

        function highlight(text, keyword) {
            var regex = new RegExp('(' + keyword + ')', 'gi');
            return text.replace(regex, '<span class="">$1</span>');
        }

        function renderResults(results) {
            var $wrap = $('.search_result_wrap');
            var $emptyWrap = $('.empty_wrap');
            $wrap.find('.result_row').remove();

            if (results && results.EDBrokers && results.EDBrokers.field && results.EDBrokers.field.length > 0) {
                $emptyWrap.hide();
                results.EDBrokers.field.forEach(function(result) {
                    console.log(result);
                    var bsnmCmpnm = result.bsnmCmpnm || "";
                    var brkrNm = result.brkrNm || "";
                    var ldCodeNm = result.ldCodeNm || "";
                    var jurirno = result.jurirno || "";

                    var highlightedBsnmCmpnm = highlight(bsnmCmpnm, searchQuery);

                    var resultHtml = `
                    <div class="result_row" data-bsnmcmpnm="${bsnmCmpnm}" data-brkrnm="${brkrNm}" data-jurirno="${jurirno}">
                            ${highlightedBsnmCmpnm}
                            <p>${brkrNm}, ${ldCodeNm}</p>
                        </div>`;
                    $wrap.append(resultHtml);
                });

                // Add click event listener to result rows
                $('.result_row').click(function() {
                    $('#company_name').text($(this).data('bsnmcmpnm'));
                    $('#company_ceo').text($(this).data('brkrnm'));
                    $('#brokerage_number').text($(this).data('jurirno'));
                    $('input[name="company_name"').val($(this).data('bsnmcmpnm'));
                    $('input[name="company_ceo"').val($(this).data('brkrnm'));
                    $('input[name="brokerage_number"').val($(this).data('jurirno')).trigger('change');;
                    modal_close('realtor_search');
                });
            } else {
                $emptyWrap.show();
            }
        }

        searchByBsnmCmpnm(function(resultByBsnmCmpnm) {
            if (resultByBsnmCmpnm && resultByBsnmCmpnm.EDBrokers && resultByBsnmCmpnm.EDBrokers.field
                .length > 0) {
                renderResults(resultByBsnmCmpnm);
            } else {
                searchByBrkrNm(function(resultByBrkrNm) {
                    if (resultByBrkrNm && resultByBrkrNm.EDBrokers && resultByBrkrNm.EDBrokers
                        .field.length > 0) {
                        renderResults(resultByBrkrNm);
                    } else {
                        renderResults(null);
                    }
                });
            }
        });
    });

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

        var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

        $('input[name="company_address"]').val(rtRoadFullAddr);
        $('input[name="company_address_lng"]').val(wgs84Coords[0]);
        $('input[name="company_address_lat"]').val(wgs84Coords[1]);
        $('input[name="company_address_detail"]').val(rtAddrDetail);
        $('input[name="company_postcode"]').val(rtZipNo);

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

    }


    $('.input_check').on("keyup change", function() {
        let allFilled = true;

        $('.input_check').each(function() {
            if ($(this).val().trim() === '') {
                allFilled = false;
                return false; // break out of the loop
            }
        });

        if (allFilled) {
            $('.confirm').attr("disabled", false);
        } else {
            $('.confirm').attr("disabled", true);
        }
    });

    function businessCheck() {
        var data = {
            "businesses": [{
                "b_no": $('#company_number').val().replace(/-/g, ''),
                "start_dt": $('#opening_date').val(),
                "p_nm": $('input[name="company_ceo"]').val(),
                "p_nm2": "",
                "b_nm": "",
                "corp_no": "",
                "b_sector": "",
                "b_type": "",
                "b_adr": ""
            }]
        }
        console.log(data);

        $.ajax({
            url: "https://api.odcloud.kr/api/nts-businessman/v1/validate?serviceKey={{ env('API_DATE_KEY') }}", // serviceKey 값을 xxxxxx에 입력
            type: "POST",
            data: JSON.stringify(data), // json 을 string으로 변환하여 전송
            dataType: "JSON",
            contentType: "application/json",
            accept: "application/json",
            success: function(result) {
                var data = result.data;

                data.forEach(function(el, index) {
                    if (el.valid == "01") {
                        $('form').submit();
                    } else {
                        alert('사업자 정보가 확인되지 않습니다.\n사업자 등록번호, 개업일, 대표자명을 확인 후 다시 시도해 주세요.');
                    }
                });
            },
            error: function(result) {
                console.log(result.responseText); //responseText의 에러메세지 확인
                alert(result.responseText);
            }
        });

    }
</script>

{{-- http://www.data.go.kr/images/biz/swagger/nts-swagger#/definitions/BusinessDescription --}}
