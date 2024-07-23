<x-admin-layout>
    {{-- FORM START  --}}
    <div class="app-container container-xxl">
        <form class="form" method="POST" action="{{ route('admin.apt.complex.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $result->id }}" />
            <input type="hidden" name="lasturl" value="{{ URL::previous() }}">

            <x-screen-card :title="'아파트 단지 상세'">
            </x-screen-card>
            <x-screen-card :title="'단지 정보'">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- PNU --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">PNU</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="PNU"
                                value="{{ $result->pnu }}" />
                        </div>
                    </div>

                    {{-- 단지코드 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">단지코드</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="단지코드"
                                value="{{ $result->kaptCode }}" />
                        </div>
                    </div>

                    {{-- 단지명 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">단지명</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="kaptName" class="form-control" placeholder="단지명"
                                value="{{ old('kaptName') ? old('kaptName') : $result->kaptName }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('kaptName')" />

                        </div>
                    </div>

                    {{-- 법정동코드 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">법정동코드</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="법정동코드"
                                value="{{ $result->bjdCode }}" />
                        </div>
                    </div>

                    {{-- 시도 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">시도</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="시도"
                                value="{{ $result->as1 }}" />
                        </div>
                    </div>

                    {{-- 시군구 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">시군구</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="시군구"
                                value="{{ $result->as2 }}" />
                        </div>
                    </div>

                    {{-- 읍면동 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">읍면동</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="읍면동"
                                value="{{ $result->as3 }}" />
                        </div>
                    </div>


                </div>
                <!--내용 END-->

            </x-screen-card>

            <x-screen-card :title="'단지 기본 정보'">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 주소 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                        <div class="col-lg-10 fv-row">
                            <a onclick="getAddress()" class="btn btn-outline"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                주소 검색 </a>
                            <span class="fw-bolder">{{ $result->kaptAddr }}</span>
                            <input type="hidden" name="address_lat" id="address_lat" value="{{ $result->y }}">
                            <input type="hidden" name="address_lng" id="address_lng" value="{{ $result->x }}">
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
                    </div>

                    {{-- 주변 지하철 정보 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">주변 지하철 정보</label>
                        <div class="col-lg-9 fv-row row">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">역 명</span>
                                    <input type="text" name="subwayStation" class="form-control" placeholder="역 명"
                                        value="{{ old('subwayStation') ? old('subwayStation') : $result->subwayStation }}" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">호선</span>
                                    <input type="text" name="subwayLine" class="form-control" placeholder="호선"
                                        value="{{ old('subwayLine') ? old('subwayLine') : $result->subwayLine }}" />
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2">이동 시간</span>
                                    <input type="text" name="kaptdWtimesub" class="form-control" placeholder=""
                                        value="{{ old('kaptdWtimesub') ? old('kaptdWtimesub') : $result->kaptdWtimesub }}" />
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
                                <input type="text" name="kaptdWtimebus" class="form-control" placeholder=""
                                    value="{{ old('kaptdWtimebus') ? old('kaptdWtimebus') : $result->kaptdWtimebus }}" />
                            </div>
                        </div>
                    </div>

                    {{-- 편의 시설 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">편의 시설</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="convenientFacility" class="form-control mb-5" rows="5"
                                placeholder="주변 편의시설, 역세권 등의 정보를 입력해주세요.">{{ old('convenientFacility') ? old('convenientFacility') : $result->convenientFacility }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('convenientFacility')" />
                        </div>
                    </div>

                    {{-- 교육 시설 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">교육 시설</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="educationFacility" class="form-control  mb-5" rows="5" placeholder="주변 교 시설을 입력하세요.">{{ old('educationFacility') ? old('educationFacility') : $result->educationFacility }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('educationFacility')" />
                        </div>
                    </div>

                </div>
                <!--내용 END-->

            </x-screen-card>

            <x-screen-card :title="'실거래가 연결 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 매매 실거래 건수 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">매매 실거래 건수</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="매매 실거래 건수" value="0" />
                        </div>
                    </div>
                    {{-- 마지막 매매 거래일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 매매 거래일</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="마지막 매매 거래일" value="-" />
                        </div>
                    </div>

                    {{-- 전/월세 실거래 건수 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">전/월세 실거래 건수</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="전/월세 실거래 건수" value="0" />
                        </div>
                    </div>

                    {{-- 마지막 전/월세 거래일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 전/월세 거래일</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="마지막 전/월세 거래일" value="-" />
                        </div>
                    </div>

                </div>
            </x-screen-card>
        </form>

        {{-- FORM END --}}
        <x-screen-card :title="'건축물 대장'">
            <x-admin-buildingledger :class="'App\Models\DataApt'" :result="$result" isUpdate="true" />
        </x-screen-card>

        {{-- Footer Bottom START --}}
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="submit" class="btn btn-primary">수정</button>
        </div>
        {{-- Footer END --}}

        {{-- FORM END --}}

    </div>

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

            loadingStart();

            var AdmCd = String(rtAdmCd);
            var MtYn = rtMtYn == '0' ? '1' : '2';
            var LnbrMnnm = String(rtLnbrMnnm).padStart(4, '0');
            var LnbrSlno = String(rtLnbrSlno).padStart(4, '0');

            var pnu = AdmCd + MtYn + LnbrMnnm + LnbrSlno;
            gte_useWFS(pnu);

            var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

            $('input[name=address_lng]').val(wgs84Coords[0]);
            $('input[name=address_lat]').val(wgs84Coords[1]);

            callJusoroMapApiType1(rtentX, rtentY);

            $('input[name=pnu]').val(pnu);
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
