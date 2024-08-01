<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'메인 서비스 등록'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.service.create') }}">
                @csrf

                <input type="hidden" name="type" value="0">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'서비스 이미지'" id="service" cnt="1" required="required" size="445 x 667" />

                    {{-- 서비스명 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">서비스명</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="name" class="form-control form-control-solid"
                                placeholder="서비스의 이름을 입력해주세요." value="{{ old('name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />
                        </div>
                    </div>

                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">서비스 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="서비스의 제목을 입력해주세요." value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 노출여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">노출여부</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('is_blind') ?? 0;
                            @endphp
                            <select name="is_blind" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>노출</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>미노출</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">서비스 내용</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="content" class="form-control form-control-solid"
                                placeholder="80자 이내로 서비스에 대한 내용을 입력해주세요." value="{{ old('content') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    {{-- 연결 페이지 링크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">연결 페이지 링크</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="url" class="form-control form-control-solid"
                                placeholder="링크를 입력해주세요." value="{{ old('url') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('url')" />
                        </div>
                    </div>

                    <!--내용 END-->
                    {{-- Footer Bottom START --}}
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary">등록</button>
                    </div>
                    {{-- Footer END --}}
            </form>
            {{-- FORM END --}}

        </x-screen-card>
    </div>

    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        initImageDropzone();

        // 날짜 검색이 있을 경우 추가
        initDaterangepicker3();
    </script>
</x-admin-layout>
