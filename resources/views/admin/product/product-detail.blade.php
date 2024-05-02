<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'등록자 정보'">

            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 아이디 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">ID</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="아이디"
                            value="{{ $result->users->email }}" />
                    </div>
                </div>

                {{-- 이름 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">이름</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="이름"
                            value="{{ $result->users->name }}" />
                    </div>
                </div>

                {{-- 전화번호 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">전화번호</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="전화번호"
                            value="{{ $result->users->phone }}" />
                    </div>
                </div>


            </div>
            <!--내용 END-->
        </x-screen-card>
    </div>

    <div class="app-container container-xxl">
        <x-screen-card :title="'매물 기본 정보'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.product.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />
                <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 매물종류 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">매물종류</label>
                        <div class="col-lg-10 fv-row">
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">주거용</label>
                                <div class="col-lg-8 fv-row">
                                    @for ($i = 8; $i < 14; $i++)
                                        <label
                                            class="form-check form-check-custom form-check-inline form-check-solid me-5 p-1">
                                            <input class="form-check-input" name="type" type="radio"
                                                value="{{ $i }}">
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.product_type.' . $i) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">상업용</label>
                                <div class="col-lg-8 fv-row">
                                    @for ($i = 0; $i < 8; $i++)
                                        <label
                                            class="form-check form-check-custom form-check-inline form-check-solid me-5 p-1">
                                            <input class="form-check-input" name="type" type="radio"
                                                value="{{ $i }}">
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.product_type.' . $i) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">분양권</label>
                                <div class="col-lg-8 fv-row">
                                    @for ($i = 14; $i < Count(Lang::get('commons.product_type')); $i++)
                                        <label
                                            class="form-check form-check-custom form-check-inline form-check-solid me-5 p-1">
                                            <input class="form-check-input" name="type" type="radio"
                                                value="{{ $i }}">
                                            <span
                                                class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.product_type.' . $i) }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 주소 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                        <div class="col-lg-10 fv-row">
                            <a onclick="getAddress()" class="btn btn-outline"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                주소 검색 </a>
                            <a class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#modal_address_search"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                가(임시)주소 검색 </a>

                            <label class="form-check form-check-custom form-check-inline p-1">
                                <input class="form-check-input" name="temporary_address" id="temporary_address"
                                    type="checkbox" value="{{ $i }}">
                                <span class="fw-semibold ps-2 fs-6">가(임시)주소</span>
                            </label>

                            <input type="text" name="address" id="address" class="form-control form-control-solid "
                                readonly placeholder=""
                                value="{{ old('address') ? old('address') : $result->address }}" />

                            <div class="mb-6"
                                style="border: 1px solid #D2D1D0; border-radius: 5px; display: flex; align-items: center; color:#D2D1D0; justify-content:center; text-align: center; line-height: 1.4; height: 400px; margin-top:18px;">
                                <div id="is_temporary_0">
                                    주소 검색 시,<br>해당 위치가 지도에 표시됩니다.
                                </div>
                                <div id="is_temporary_1" style="display: none">
                                    가(임시)주소 선택시,<br>지도 노출이 불가능합니다.
                                </div>
                            </div>

                            <div>
                                <span class="fs-6">상세주소</span>
                                <input type="text" name="address_detail" id="address_detail"
                                    class="form-control form-control-solid" placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호"
                                    value="{{ old('address_detail') ? old('address_detail') : $result->address_detail }}">
                                <label class="form-check form-check-custom form-check-inline p-1">
                                    <input class="form-check-input" name="is_address_detail" id="is_address_detail"
                                        type="checkbox" value="123">
                                    <span class="fw-semibold ps-2 fs-6">상세주소 없음</span>
                                </label>
                            </div>

                            <div>
                                <span class="fs-6">상세주소</span>
                                <input type="text" name="address_detail" id="address_detail"
                                    class="form-control form-control-solid"
                                    placeholder="건물명, 동/호 또는 상세주소 입력 예) 1동 101호"
                                    value="{{ old('address_detail') ? old('address_detail') : $result->address_detail }}">
                                <label class="form-check form-check-custom form-check-inline p-1">
                                    <input class="form-check-input" name="is_address_detail" id="is_address_detail"
                                        type="checkbox" value="123">
                                    <span class="fw-semibold ps-2 fs-6">상세주소 없음</span>
                                </label>
                            </div>

                            <input type="hidden" name="region_code" id="region_code"
                                value="{{ old('region_code') ? old('region_code') : $result->region_code }}">
                            <input type="hidden" name="address_lat" id="address_lat"
                                value="{{ old('address_lat') ? old('address_lat') : $result->address_lat }}">
                            <input type="hidden" name="address_lng" id="address_lng"
                                value="{{ old('address_lng') ? old('address_lng') : $result->address_lng }}">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('address')" />
                        </div>
                    </div>

                    {{-- 등록자 id --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">일반회원 매물명</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="name" class="form-control form-control-solid"
                                placeholder="일반회원 매물의 이름을 입력해주세요"
                                value="{{ old('name') ? old('name') : $result->name }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />

                        </div>
                    </div>

                    {{-- 노출여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">노출여부</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('is_blind') ?? $result->is_blind;
                            @endphp
                            <select name="is_blind" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>공개</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>비공개</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
                    </div>

                    {{-- 연결 페이지 링크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">연결 페이지 링크</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="url" class="form-control form-control-solid"
                                placeholder="링크를 입력해주세요." value="{{ old('url') ? old('url') : $result->url }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('url')" />
                        </div>
                    </div>


                    {{-- 게시 타입 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label  fw-semibold fs-6">노출대상</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $type = old('type') ?? $result->type;
                            @endphp
                            <select name="type" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($type == 0) selected @endif>PC</option>
                                <option value="1" @if ($type == 1) selected @endif>모바일</option>
                            </select>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('state')" />
                        </div>
                    </div>

                </div>
                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">수정</button>
                </div>
                {{-- Footer END --}}
            </form>
            {{-- FORM END --}}

        </x-screen-card>
    </div>

    <!-- modal 가(임시)주소 검색 : s-->
    <div class="modal fade" tabindex="-1" id="modal_address_search">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">가(임시) 주소 검색</h5>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1">X</span><span
                                class="path2"></span></i>
                        <!--end::Close-->
                    </div>
                </div>
                <div class="modal-body">
                    <ul class="adress_select tab_toggle_menu">
                        <li class="active"><span id="region_input_1">시/도</span></li>
                        <li style="display:none"><span id="region_input_2">시/군/구</span></li>
                        <li style="display:none"><span id="region_input_3">읍/면/동</span></li>
                        <li style="display:none"><span id="region_input_4">리</span></li>
                    </ul>
                    <div class="tab_area_wrap adress_select_wrap  mt20">
                        <div>
                            <div class="point_sm_filter cell_4" id="region_code_1">
                                <div class="cell"><input type="radio" name="region_1" id="region_1_1"
                                        value="11"><label class="label" for="region_1_1">서울특별시</label></div>
                            </div>
                            <div class="point_sm_filter cell_4" id="region_code_2">
                                <div class="cell"><input type="radio" name="region_1" id="region_1_2"
                                        value="11"><label class="label" for="region_1_2">서울특별시</label></div>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">닫기</button>
                        <button type="button" class="btn btn-primary" id="seach_address" onclick="seach_address()"disabled>
                            검색
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal 가(임시)주소 검색 : e-->

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        initDaterangepicker();

        // 이미지 드롭 존 있을 경우
        initImageDropzone();
    </script>

    <script>
        $('#is_address_detail').click(function() {
            if ($(this).is(':checked')) {
                $('#address_detail').val('');
                $('#address_detail').attr('disabled', true);
            } else {
                $('#address_detail').attr('disabled', false);
            }
        });

        $('#is_address_dong').click(function() {
            if ($(this).is(':checked')) {
                $('#address_dong').val('');
                $('#address_dong').attr('disabled', true);
            } else {
                $('#address_dong').attr('disabled', false);
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
                address_2.style.display = "active";
                search_1.style.display = "none";
                search_2.style.display = "active";
                is_temporary_0.style.display = "none";
                is_temporary_1.style.display = "block";
            } else {
                address_1.style.display = "block";
                address_2.style.display = "active";
                search_1.style.display = "block";
                search_2.style.display = "active";
                is_temporary_0.style.display = "block";
                is_temporary_1.style.display = "none";
            }
        });

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

            $('#address').val(rtAddrPart1)

            if (!$("#address_detail").prop('disabled')) {
                $('#address_detail').val(rtAddrDetail);
            }

            $('#region_code').val(rtAdmCd);

            var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

            $('input[name=address_lng]').val(wgs84Coords[0]);
            $('input[name=address_lat]').val(wgs84Coords[1]);

            console.log('주소 검색 끝!');

            confrim_check();

        }
    </script>

</x-admin-layout>
