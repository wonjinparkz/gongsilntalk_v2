<x-admin-layout>
    {{-- FORM START  --}}
    <form class="form" method="POST" action="{{ route('admin.apt.name.create') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $result->id }}" />
        <input type="hidden" name="lasturl" value="{{ URL::previous() }}">
        <div class="app-container container-xxl">

            <x-screen-card :title="'아파트 단지명 등록'">

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
                                value="{{ $result->kaptCode }}" />
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

            {{-- Footer Bottom START --}}
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary">저장</button>
            </div>
            {{-- Footer END --}}

            {{-- FORM END --}}

        </div>
    </form>

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";
    </script>
</x-admin-layout>
