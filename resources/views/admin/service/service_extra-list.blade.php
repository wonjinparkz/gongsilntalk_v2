<x-admin-layout>
    <div class="app-container container-xxl">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">
                        부가 서비스 관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
            </div>
        </div>
        <x-screen-card :title="'추천 분양현장'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.recommend.service.create') }}">
                @csrf

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'서비스 이미지'" id="recommend_service" cnt="1" required="required"
                        :images="$recommend->images ?? []" />

                    {{-- 노출여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">노출여부</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('recommend_is_blind')
                                    ? old('recommend_is_blind')
                                    : $recommend->is_blind ?? 0;
                            @endphp
                            <select name="recommend_is_blind" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>노출</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>미노출</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('recommend_is_blind')" />
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">서비스 내용</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="recommend_content" class="form-control form-control-solid"
                                placeholder="80자 이내로 서비스에 대한 내용을 입력해주세요."
                                value="{{ old('recommend_content') ? old('recommend_content') : $recommend->content ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('recommend_content')" />
                        </div>
                    </div>

                    {{-- 연결 페이지 링크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">연결 페이지 링크</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="recommend_url" class="form-control form-control-solid"
                                placeholder="링크를 입력해주세요."
                                value="{{ old('recommend_url') ? old('recommend_url') : $recommend->url ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('recommend_url')" />
                        </div>
                    </div>

                </div>

                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">저장</button>
                </div>
                {{-- Footer END --}}
            </form>
            {{-- FORM END --}}
        </x-screen-card>

        <x-screen-card :title="'실시간 매물지도'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.property.service.create') }}">
                @csrf

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'서비스 이미지'" id="property_service" cnt="1" required="required"
                        :images="$property->images ?? []" />

                    {{-- 노출여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">노출여부</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('property_is_blind')
                                    ? old('property_is_blind')
                                    : $property->is_blind ?? 0;
                            @endphp
                            <select name="property_is_blind" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>노출</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>미노출</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('property_is_blind')" />
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">서비스 내용</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="property_content" class="form-control form-control-solid"
                                placeholder="80자 이내로 서비스에 대한 내용을 입력해주세요."
                                value="{{ old('property_content') ? old('property_content') : $property->content ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('property_content')" />
                        </div>
                    </div>

                    {{-- 연결 페이지 링크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">연결 페이지 링크</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="property_url" class="form-control form-control-solid"
                                placeholder="링크를 입력해주세요."
                                value="{{ old('property_url') ? old('property_url') : $property->url ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('property_url')" />
                        </div>
                    </div>

                </div>

                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">저장</button>
                </div>
                {{-- Footer END --}}
            </form>
            {{-- FORM END --}}
        </x-screen-card>

        <x-screen-card :title="'내 자산관리'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.asset.service.create') }}">
                @csrf

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'서비스 이미지'" id="asset_service" cnt="1" required="required"
                        :images="$asset->images ?? []" />

                    {{-- 노출여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">노출여부</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('asset_is_blind') ? old('asset_is_blind') : $asset->is_blind ?? 0;
                            @endphp
                            <select name="asset_is_blind" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>노출</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>미노출</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('asset_is_blind')" />
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">서비스 내용</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="asset_content" class="form-control form-control-solid"
                                placeholder="80자 이내로 서비스에 대한 내용을 입력해주세요."
                                value="{{ old('asset_content') ? old('asset_content') : $asset->content ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('asset_content')" />
                        </div>
                    </div>

                    {{-- 연결 페이지 링크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">연결 페이지 링크</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="asset_url" class="form-control form-control-solid"
                                placeholder="링크를 입력해주세요."
                                value="{{ old('asset_url') ? old('asset_url') : $asset->url ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('asset_url')" />
                        </div>
                    </div>

                </div>

                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">저장</button>
                </div>
                {{-- Footer END --}}
            </form>
            {{-- FORM END --}}
        </x-screen-card>

        <x-screen-card :title="'수익률 계산기'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.arithmometer.service.create') }}">
                @csrf

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'서비스 이미지'" id="arithmometer_service" cnt="1" required="required"
                        :images="$arithmometer->images ?? []" />

                    {{-- 노출여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">노출여부</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('arithmometer_is_blind') ? old('arithmometer_is_blind') : $arithmometer->is_blind ?? 0;
                            @endphp
                            <select name="arithmometer_is_blind" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>노출</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>미노출</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('arithmometer_is_blind')" />
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">서비스 내용</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="arithmometer_content" class="form-control form-control-solid"
                                placeholder="80자 이내로 서비스에 대한 내용을 입력해주세요."
                                value="{{ old('arithmometer_content') ? old('arithmometer_content') : $arithmometer->content ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('arithmometer_content')" />
                        </div>
                    </div>

                    {{-- 연결 페이지 링크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">연결 페이지 링크</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="arithmometer_url" class="form-control form-control-solid"
                                placeholder="링크를 입력해주세요."
                                value="{{ old('arithmometer_url') ? old('arithmometer_url') : $arithmometer->url ?? '' }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('arithmometer_url')" />
                        </div>
                    </div>

                </div>

                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">저장</button>
                </div>
                {{-- Footer END --}}
            </form>
            {{-- FORM END --}}
        </x-screen-card>

        <x-screen-card :title="'앱 다운로드'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.app.download.service.create') }}">
                @csrf

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'서비스 이미지'" id="app_download_service" cnt="1" required="required"
                        :images="$app_download->images ?? []" />

                    {{-- 노출여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">노출여부</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('app_download_is_blind') ? old('app_download_is_blind') : $app_download->is_blind ?? 0;
                            @endphp
                            <select name="app_download_is_blind" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>노출</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>미노출</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('app_download_is_blind')" />
                    </div>

                </div>

                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">저장</button>
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
    </script>
</x-admin-layout>
