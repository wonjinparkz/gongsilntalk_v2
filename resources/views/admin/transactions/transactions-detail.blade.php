<x-admin-layout>
    <div class="app-container container-xxl">
        {{-- FORM START  --}}

        <x-screen-card :title="'아파트 매매 실거래가 상세'">

            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 매칭여부 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">매칭여부</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="매칭여부"
                            value="{{ $result->is_matching ? '매칭 완료' : '매칭 전' }}" />
                    </div>
                </div>

                {{-- 년 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">년</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="년"
                            value="{{ $result->year }}" />
                    </div>
                </div>

                {{-- 월 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">월</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="월"
                            value="{{ $result->month }}" />
                    </div>
                </div>

                {{-- 일 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">일</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="일"
                            value="{{ $result->day }}" />
                    </div>
                </div>

                {{-- 아파트 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">아파트</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="아파트"
                            value="{{ $result->aptName }}" />
                    </div>
                </div>

                {{-- 전용면적 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">전용면적</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="전용면적"
                            value="{{ $result->exclusiveArea }}" />
                    </div>
                </div>

                {{-- 거래금액 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">거래금액</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="거래금액"
                            value="{{ trim($result->transactionPrice) . '만원' }}" />
                    </div>
                </div>

                {{-- 층 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">층</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="층"
                            value="{{ $result->floor }}" />
                    </div>
                </div>

                {{-- 도로명 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">도로명</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="도로명"
                            value="{{ $result->roadName }}" />
                    </div>
                </div>

                {{-- 도로명코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">도로명코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="도로명코드"
                            value="{{ $result->roadCode }}" />
                    </div>
                </div>

                {{-- 건축년도 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">건축년도</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="건축년도"
                            value="{{ $result->constructionYear }}" />
                    </div>
                </div>

                {{-- 지역코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">지역코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="지역코드"
                            value="{{ $result->regionCode }}" />
                    </div>
                </div>

                {{-- 도로명건물본번호코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">도로명건물본번호코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="도로명건물본번호코드"
                            value="{{ $result->roadBuildingMainCode }}" />
                    </div>
                </div>

                {{-- 도로명건물부번호코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">도로명건물부번호코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="도로명건물부번호코드"
                            value="{{ $result->roadBuildingSubCode }}" />
                    </div>
                </div>

                {{-- 도로명시군구코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">도로명시군구코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="도로명시군구코드"
                            value="{{ $result->roadCityCode }}" />
                    </div>
                </div>

                {{-- 도로명일련번호코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">도로명일련번호코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid"
                            placeholder="도로명일련번호코드" value="{{ $result->roadSerialCode }}" />
                    </div>
                </div>

                {{-- 도로명지상지하코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">도로명지상지하코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid"
                            placeholder="도로명지상지하코드" value="{{ $result->roadUpDownCode }}" />
                    </div>
                </div>

                {{-- 법정동 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">법정동</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="법정동"
                            value="{{ $result->legalDong }}" />
                    </div>
                </div>

                {{-- 법정동본번코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">법정동본번코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="법정동본번코드"
                            value="{{ $result->legalDongMainNumberCode }}" />
                    </div>
                </div>

                {{-- 법정동부번코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">법정동부번코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="법정동부번코드"
                            value="{{ $result->legalDongSubNumberCode }}" />
                    </div>
                </div>

                {{-- 법정동시군구코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">법정동시군구코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="법정동시군구코드"
                            value="{{ $result->legalDongCityCode }}" />
                    </div>
                </div>

                {{-- 법정동읍면동코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">법정동읍면동코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="법정동읍면동코드"
                            value="{{ $result->legalDongDistrictCode }}" />
                    </div>
                </div>

                {{-- 법정동지번코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">법정동지번코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="법정동지번코드"
                            value="{{ $result->legalDongCode }}" />
                    </div>
                </div>

                {{-- 일련번호 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">일련번호</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="일련번호"
                            value="{{ $result->serialNumber }}" />
                    </div>
                </div>

                {{-- 지번 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">지번</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="지번"
                            value="{{ $result->jibun }}" />
                    </div>
                </div>

            </div>
        </x-screen-card>

    </div>

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";
    </script>


</x-admin-layout>
