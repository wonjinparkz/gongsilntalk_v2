<x-admin-layout>
    <div class="app-container container-xxl">
        {{-- FORM START  --}}
        <form class="form" method="POST" action="{{ route('admin.store.create') }}">
            @csrf

            <x-screen-card :title="'상가 상세'">
            </x-screen-card>
            <x-screen-card :title="'기본 정보'">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 주소 --}}
                    <div class="row mb-6">

                        <label class="col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                        <div class="col-lg-10 fv-row">
                            <a onclick="getAddress()" class="btn btn-outline mb-md-5 search_address_1"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                주소 검색 </a>
                            <a class="btn btn-outline mb-md-5 search_address_2" data-bs-toggle="modal"
                                data-bs-target="#modal_address_search"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;
                                ">
                                (구)주소 검색 </a>
                            <input type="text" name="address" id="address" class="form-control form-control-solid "
                                readonly placeholder="" value="{{ old('address') ?? $result->kstoreAddr }}" />
                            <input type="hidden" name="pnu" id="pnu" class="form-control form-control-solid "
                                readonly placeholder="" value="{{ old('pnu') ?? $result->pnu }}" />
                            <input type="hidden" name="address_lat" id="address_lat"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('address_lat') ?? $result->y }}" />
                            <input type="hidden" name="address_lng" id="address_lng"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('address_lng') ?? $result->x }}" />
                            <input type="hidden" name="polygon_coordinates" id="polygon_coordinates"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('polygon_coordinates') ?? $result->polygon_coordinates }}" />
                            <input type="hidden" name="characteristics_json" id="characteristics_json"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('characteristics_json') ?? $result->characteristics_json }}" />
                            <input type="hidden" name="useWFS_json" id="useWFS_json"
                                class="form-control form-control-solid " readonly placeholder=""
                                value="{{ old('useWFS_json') ?? $result->useWFS_json }}" />
                            <span class="fw-bolder"></span>
                            <div class="mb-6"
                                style="border: 1px solid #D2D1D0; border-radius: 5px; display: flex; align-items: center; color:#D2D1D0; justify-content:center; text-align: center; line-height: 1.4; height: 500px; margin-top:18px; position: relative;">
                                <div id="is_temporary_0"
                                    style="position: absolute; width: 100%; height: 100%; display:;">
                                    <div id="mapWrap" class="mapWrap"
                                        style="width: 100%; height: 100%; border-left: 1px solid #ddd;"></div>
                                </div>
                                <div id="is_temporary_1" style="display: ">
                                    좌표가 없는 지도는 노출이 불가능합니다.
                                </div>
                            </div>
                        </div>

                        {{-- 상가명 --}}
                        <div class="row mb-6">
                            <label class="required col-lg-3 col-form-label fw-semibold fs-6">상가명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="kstoreName" class="form-control" placeholder="상가명"
                                    value="{{ old('kstoreName') ?? $result->kstoreName }}" />
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('kstoreName')" />

                            </div>
                        </div>

                        {{-- 법정동코드 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">법정동코드</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="region_code" id="region_code" readonly class="form-control form-control-solid"
                                    placeholder="법정동코드" value="{{ old('region_code') ?? $result->bjdCode }}" />
                            </div>
                        </div>

                        {{-- 시도 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">시도</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="as1" readonly class="form-control form-control-solid"
                                    placeholder="시도" value="{{ old('as1') ?? $result->as1 }}" />
                            </div>
                        </div>

                        {{-- 시군구 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">시군구</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="as2" readonly class="form-control form-control-solid"
                                    placeholder="시군구" value="{{ old('as2') ?? $result->as2 }}" />
                            </div>
                        </div>

                        {{-- 읍면동 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">읍면동</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="as3" readonly class="form-control form-control-solid"
                                    placeholder="읍면동" value="{{ old('as3') ?? $result->as3 }}" />
                            </div>
                        </div>

                        {{-- 리 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">리</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="as4" readonly class="form-control form-control-solid"
                                    placeholder="리" value="{{ old('as4') ?? $result->as4 }}" />
                            </div>
                        </div>

                        {{-- 주변 지하철 정보 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">주변 지하철 정보</label>
                            <div class="col-lg-9 fv-row row">
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">역 명</span>
                                        <input type="text" name="subwayStation" class="form-control"
                                            placeholder="역 명"
                                            value="{{ old('subwayStation') ?? $result->subwayStation }}" />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">호선</span>
                                        <input type="text" name="subwayLine" class="form-control"
                                            placeholder="호선"
                                            value="{{ old('subwayLine') ?? $result->subwayLine }}" />
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">이동 시간</span>
                                        <input type="text" name="kstoredWtimesub" class="form-control"
                                            placeholder=""
                                            value="{{ old('kstoredWtimesub') ?? $result->kstoredWtimesub }}" />
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- 주변 버스 정보 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">주변 버스 정보</label>
                            <div class="col-lg-3 fv-row">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">이동 시간</span>
                                    <input type="text" name="kstoredWtimebus" class="form-control" placeholder=""
                                        value="{{ old('kstoredWtimebus') ?? $result->kstoredWtimebus }}" />
                                </div>
                            </div>
                        </div>

                        {{-- 편의 시설 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">편의 시설</label>
                            <div class="col-lg-9 fv-row">
                                <textarea name="convenientFacility" class="form-control mb-5" rows="5"
                                    placeholder="주변 편의시설, 역세권 등의 정보를 입력해주세요.">{{ old('convenientFacility') ?? $result->convenientFacility }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('convenientFacility')" />
                            </div>
                        </div>

                        {{-- 교육 시설 --}}
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6">교육 시설</label>
                            <div class="col-lg-9 fv-row">
                                <textarea name="educationFacility" class="form-control  mb-5" rows="5" placeholder="주변 교 시설을 입력하세요.">{{ old('educationFacility') ?? $result->educationFacility }}</textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('educationFacility')" />
                            </div>
                        </div>


                    </div>
                    <!--내용 END-->

                </div>
            </x-screen-card>
        </form>

        <x-screen-card :title="'건축물 대장'">
            <x-admin-buildingledger :class="'App\Models\DataStore'" :result="$result" />
        </x-screen-card>

        {{-- FORM END --}}

        {{-- Footer Bottom START --}}
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="submit" class="btn btn-primary">저장</button>
        </div>
        {{-- Footer END --}}

        {{-- FORM END --}}

    </div>

    <x-admin-temporary-address isMapClick="false" isPnu="true" isData="true" />

    {{-- 지도 맵 api js --}}
    <script type="text/javascript"
        src="https://business.juso.go.kr/juso_support_center/js/addrlink/map/jusoro_map_api.min.js?confmKey={{ env('CONFM_MAP_KEY') }}&skinType=1">
    </script>
    <style>
        .zoomIcon {
            padding: 0px !important;
        }
    </style>
    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        $(document).ready(function() {

            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
            $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
                .remove();

            var address_lat = $('input[name=address_lat]').val();
            var address_lng = $('input[name=address_lng]').val();

            if (address_lat != '' && address_lng != '') {
                var wgs84Coords = get_coordinate_conversion1(address_lng, address_lat)
                setTimeout(function() {
                    callJusoroMapApiType1(wgs84Coords[0], wgs84Coords[1]);
                }, 2000);
            } else {
                setTimeout(function() {
                    $('#is_temporary_0').hide()
                }, 2000);
            }

        });

        // type1.좌표정보(GRS80, EPSG:5179)
        function callJusoroMapApiType1(rtentX, rtentY) {
            window.postMessage({
                functionName: 'callJusoroMapApi',
                params: [rtentX, rtentY]
            }, '*');

            $('#is_temporary_0').show();
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
            $('input[name=address]').val(rtRoadFullAddr);

            var AdmCd = String(rtAdmCd);
            var MtYn = rtMtYn == '0' ? '1' : '2';
            var LnbrMnnm = String(rtLnbrMnnm).padStart(4, '0');
            var LnbrSlno = String(rtLnbrSlno).padStart(4, '0');

            var pnu = AdmCd + MtYn + LnbrMnnm + LnbrSlno;

            $('input[name=pnu]').val(pnu);

            $('input[name="region_code"]').val(rtAdmCd);
            $('input[name="as1"]').val(rtSiNm);
            $('input[name="as2"]').val(rtSggNm);
            $('input[name="as3"]').val(rtEmdNm);
            $('input[name="as4"]').val(rtLiNm);

            // loadingStart();

            var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)


            $('input[name=address_lng]').val(wgs84Coords[0]);
            $('input[name=address_lat]').val(wgs84Coords[1]);

            callJusoroMapApiType1(rtentX, rtentY);

            loadingStart();

            gte_useWFS(pnu);

            setTimeout(function() {}, 1000);
            setTimeout(function() {
                get_coordinates(pnu);
            }, 2000);
            setTimeout(function() {
                get_characteristics(pnu);
            }, 3000);


            setTimeout(function() {
                loadingEnd();
            }, 4000);


        }
    </script>

</x-admin-layout>
