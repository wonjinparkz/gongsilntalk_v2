<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'지식산업센터 등록'">
        </x-screen-card>
        {{-- FORM START  --}}
        <form class="form" method="POST" action="{{ route('admin.popup.create') }}">
            @csrf
            <x-screen-card :title="'기본 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">팝업 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="product_name" class="form-control form-control-solid" placeholder="제목" value="{{ old('product_name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('product_name')" />

                        </div>
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">팝업 내용</label>
                        <div class="col-lg-2 fv-row">
                            <input type="text" name="product_name" class="form-control form-control-solid" placeholder="제목" value="{{ old('product_name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('product_name')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="product_name" class="form-control form-control-solid" placeholder="제목" value="{{ old('product_name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('product_name')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="product_name" class="form-control form-control-solid" placeholder="제목" value="{{ old('product_name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('product_name')" />
                        </div>
                    </div>

                    {{-- 작성일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">게시기간</label>
                        <div class="col-lg-8 fv-row">
                            <x-admin-date-picker :title="'게시 시작일 검색'" :from_name="'started_at'" :to_name="'ended_at'" />
                        </div>
                    </div>


                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'팝업 이미지'" id="popup" />


                    {{-- 게시 타입 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label  fw-semibold fs-6">게시 타겟</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                            $type = old('type') ?? 0;
                            @endphp
                            <select name="type" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="0" @if ($type==0) selected @endif>사용자</option>
                                <option value="1" @if ($type==1) selected @endif>파트너</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('type')" />
                    </div>

                    {{-- 게시 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">게시 상태</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                            $isBlind = old('is_blind') ?? 0;
                            @endphp
                            <select name="is_blind" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="0" @if ($isBlind==0) selected @endif>공개</option>
                                <option value="1" @if ($isBlind==1) selected @endif>비공개</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
                    </div>

                    {{-- FORM END --}}
                </div>

            </x-screen-card>
            <x-screen-card :title="'상세 정보'">
                {{-- FORM START  --}}
                @csrf
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">팝업 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid" placeholder="제목" value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">팝업 내용</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="content" class="form-control form-control-solid mb-5" rows="5" placeholder="내용">{{ old('content') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    {{-- 작성일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">게시기간</label>
                        <div class="col-lg-8 fv-row">
                            <x-admin-date-picker :title="'게시 시작일 검색'" :from_name="'started_at'" :to_name="'ended_at'" />
                        </div>
                    </div>


                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'팝업 이미지'" id="popup" />


                    {{-- 게시 타입 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label  fw-semibold fs-6">게시 타겟</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                            $type = old('type') ?? 0;
                            @endphp
                            <select name="type" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="0" @if ($type==0) selected @endif>사용자</option>
                                <option value="1" @if ($type==1) selected @endif>파트너</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('type')" />
                    </div>

                    {{-- 게시 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">게시 상태</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                            $isBlind = old('is_blind') ?? 0;
                            @endphp
                            <select name="is_blind" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="0" @if ($isBlind==0) selected @endif>공개</option>
                                <option value="1" @if ($isBlind==1) selected @endif>비공개</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
                    </div>

                    {{-- Footer Bottom START --}}
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary">등록</button>
                    </div>
                    {{-- Footer END --}}
                </div>
            </x-screen-card>

        </form>
        {{-- FORM END --}}
        <x-screen-card :title="'건축물 대장'">
            {{-- FORM START  --}}
            @csrf
            {{-- 내용 START --}}
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">표지부</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">총괄표제부</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">층별개요</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">전유부</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">전유공용면적</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
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

        initImageDropzone();

        // 날짜 검색이 있을 경우 추가
        initDaterangepicker();
    </script>
</x-admin-layout>
