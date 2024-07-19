<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'인테리어 견적 상세'">

            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 카테고리 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">카테고리</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid"
                            value="|@foreach ($result->types as $types){{ Lang::get('commons.interior_type.' . $types->type) }} | @endforeach" />
                    </div>
                </div>

                {{-- 회사명 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">회사명</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value="{{ $result->company_name }}" />
                    </div>
                </div>

                {{-- 연락처 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">연락처</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value="{{ $result->company_phone }}" />
                    </div>
                </div>

                {{-- 담당자 성함 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">담당자 성함</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value="{{ $result->user_name }}" />
                    </div>
                </div>

                {{-- 면적 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">면적</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value="{{ $result->area }} 평" />
                    </div>
                </div>

                {{-- 사용 인원 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">사용 인원</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value="{{ $result->users_count }} 명" />
                    </div>
                </div>

                {{-- 입주 예정 지역 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">입주 예정 지역</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value="{{ $result->place }}" />
                    </div>
                </div>

                {{-- 입주 예정일 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">입주 예정일</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value="{{ $result->move_date }}" />
                    </div>
                </div>


                {{-- 등록일 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">등록일</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid"
                            value="{{ $result->created_at->format('Y년 m월 d일') }}" />
                    </div>
                </div>

            </div>
            <!--내용 END-->

        </x-screen-card>
    </div>

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        initDaterangepicker();
    </script>
</x-admin-layout>
