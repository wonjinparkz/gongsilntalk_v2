<x-admin-layout>
    @inject('carbon', 'Carbon\Carbon');
    <div class="app-container container-xxl">
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">
                        자산 현황
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />

                </div>
            </div>
        </div>
        {{-- FORM START  --}}

        {{-- 내용 START --}}
        <x-screen-card :title="'회원 정보'">
            <div class="card-body border-top p-9">
                <div class="row">

                    {{-- 이름 --}}
                    <div class="col-lg-12">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">이름</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="이름"
                                value="{{ $user->name }}" />
                        </div>
                    </div>

                    {{-- ID --}}
                    <div class="col-lg-12">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">ID</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="ID"
                                value="{{ $user->email }}" />
                        </div>
                    </div>

                    {{-- 총 자산 현황 --}}
                    <div class="col-lg-12">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">총 자산 현황</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="총 자산 현황"
                                value="{{ number_format($addressData->price) }}" />
                        </div>
                    </div>

                    {{-- 최근 등록일 --}}
                    <div class="col-lg-12">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">최근 등록일</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="최근 등록일"
                                value="{{ $carbon::parse($addressData->max_created_at)->format('Y.m.d') }}" />
                        </div>
                    </div>

                </div>

            </div>
        </x-screen-card>
        <!--내용 END-->

        {{-- 내용 START --}}
        <x-screen-card :title="'자산 정보'">
            <div class="card-body border-top p-9">
                <div class="row">
                    @php
                        $monthProfitPrice = 0;
                        $monthProfitRate = 0;
                        $price_1 = isset($monthProfitPrice) ? $monthProfitPrice : 1;
                        $price_2 = isset($addressData->price) ? $addressData->price : 1;
                        $monthProfitRate = round($price_1 / $price_2, 2);
                    @endphp
                    {{-- 자산정보 --}}
                    <div class="row">
                        <label class="col-lg-6 fs-2 flex-column">
                            <span class="fw-bold text-gray-700">총 자산 현황</span>
                            <p class="fw-bold">{{ number_format($addressData->price) }}원</p>
                        </label>
                        <label class="col-lg-2 fw-bold fs-2 flex-column">
                            <span>실투자금</span>
                            <p class="fw-bold gsntalk-color">
                                {{ number_format($addressData->price - $addressData->loan_price) }}원</p>
                        </label>
                        <label class="col-lg-2 fw-bold fs-2 flex-column">
                            <span>월순수익</span>
                            <p class="fw-bold gsntalk-color">
                                {{ number_format($monthProfitPrice) }}원</p>
                        </label>
                        <label class="col-lg-2 fw-bold fs-2 flex-column">
                            <span>수익률</span>
                            <p class="fw-bold gsntalk-color">{{ number_format($monthProfitRate) }}%</p>
                        </label>
                    </div>

                    {{-- 총 자산 현황 --}}
                    <div class="row">
                        <div class="col-lg-6 row">
                            <label class="col-lg-2 col-form-label fw-semibold fs-5">최근 등록일</label>
                            <div class="col-lg-10 fv-row">
                                <span class="col-form-label fw-semibold fs-5">123</span>
                            </div>
                        </div>
                        <div class="col-lg-6 row">
                            <label class="col-lg-2 col-form-label fw-semibold fs-5">최근 등록일</label>
                            <div class="col-lg-10 fv-row">
                                <span class="fw-bold fs-5">123</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </x-screen-card>
        <!--내용 END-->

        {{-- FORM END --}}
    </div>

    {{--
           * 페이지에서 사용하는 자바스크립트
        --}}
    <script>
        var hostUrl = "assets/";
    </script>
</x-admin-layout>
