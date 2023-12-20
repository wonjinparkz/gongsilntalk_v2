<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'매거진 등록'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.magazine.create') }}">
                @csrf
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">매거진 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid" placeholder="제목"
                                value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'매거진 이미지'" id="magazine" />

                    {{-- 카테고리 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label  fw-semibold fs-6">매거진 카테고리</label>
                        <div class="col-lg-4 d-flex align-items-center">
                            @php
                                $magazineCategoryId = old('magazine_category_id');
                            @endphp
                            <select name="magazine_category_id" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="" @if ($magazineCategoryId == null) selected @endif>카테고리를 선택해주세요
                                </option>
                                @foreach ($categoryList as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($magazineCategoryId == $category->id) selected @endif>{{ $category->title }}
                                    </option>
                                @endforeach


                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('magazine_category_id')" />
                    </div>

                    {{-- 게시 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">게시 상태</label>
                        <div class="col-lg-4 d-flex align-items-center">
                            @php
                                $isBlind = old('is_blind') ?? 0;
                            @endphp
                            <select name="is_blind" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>공개</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>비공개</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('state')" />
                    </div>


                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">매거진 내용</label>
                        <div class="col-lg-12 fv-row">
                            <x-admin-editor :name="'content'" />
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
    </script>
</x-admin-layout>
