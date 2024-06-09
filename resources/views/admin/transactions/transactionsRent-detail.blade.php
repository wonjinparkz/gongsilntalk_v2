<x-admin-layout>
    <div class="app-container container-xxl">
        {{-- FORM START  --}}

        <x-screen-card :title="'아파트 전월세 실거래가 상세'">

            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 매칭여부 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">매칭여부</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->is_matching ? '매칭 완료' : '매칭 전' }}" />
                    </div>
                </div>

                {{-- 갱신요구권 사용 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">갱신요구권 사용</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->renewalRight ?? '-' }}" />
                    </div>
                </div>

                {{-- 계약구분 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">계약구분</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->contract_type }}" />
                    </div>
                </div>

                {{-- 계약기간 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">계약기간</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->contract_at }}" />
                    </div>
                </div>

                {{-- 년 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">년</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->year }}" />
                    </div>
                </div>

                {{-- 월 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">월</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->month }}" />
                    </div>
                </div>

                {{-- 일 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">일</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->day }}" />
                    </div>
                </div>

                {{-- 아파트 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">아파트</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->aptName }}" />
                    </div>
                </div>

                {{-- 전용면적 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">전용면적</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->exclusiveArea }}" />
                    </div>
                </div>

                {{-- 보증금액 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">보증금액</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ trim($result->transactionPrice) . '만원' }}" />
                    </div>
                </div>

                {{-- 월세금액 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">월세금액</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ trim($result->transactionMonthPrice) . '만원' }}" />
                    </div>
                </div>

                {{-- 층 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">층</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->floor }}" />
                    </div>
                </div>

                {{-- 종전계약보증금 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">종전계약보증금</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->roadName ?? '-' }}" />
                    </div>
                </div>

                {{-- 종전계약월세 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">종전계약월세</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->roadName ?? '-' }}" />
                    </div>
                </div>


                {{-- 건축년도 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">건축년도</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->constructionYear }}" />
                    </div>
                </div>

                {{-- 지역코드 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">지역코드</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->regionCode }}" />
                    </div>
                </div>

                {{-- 법정동 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">법정동</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
                            value="{{ $result->legalDong }}" />
                    </div>
                </div>

                {{-- 지번 --}}
                <div class="col-lg-12 row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">지번</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" disabled class="form-control form-control-solid" placeholder="-"
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
