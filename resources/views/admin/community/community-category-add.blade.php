<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'커뮤니티 카테고리 등록'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.community.category.create') }}">
                @csrf

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">커뮤니티 카테고리 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="제목" value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">커뮤니티 카테고리 내용</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="content" class="form-control form-control-solid mb-5" rows="5" placeholder="내용">{{ old('content') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'카테고리 이미지'" required="required" id="category" />

                    {{-- 파일 --}}
                    <x-admin-file-picker :title="'카테고리 파일'" required="required" id="category" />

                    {{-- 게시 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">게시 상태</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                            $state = old('state') ?? 0;
                            @endphp
                            <select id="stateOption" name="state" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                                <option value="0" @if ($state == 0) selected @endif>공개</option>
                                <option value="1" @if ($state == 1) selected @endif>비공개</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('state')" />
                </div>
                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">취소</button>
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

        //
    </script>
</x-admin-layout>
