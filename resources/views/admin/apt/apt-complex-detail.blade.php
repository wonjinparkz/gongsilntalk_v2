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

                </div>
                <!--내용 END-->
            </x-screen-card>


            <x-screen-card :title="'단지 기본 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

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
</x-admin-layout>
