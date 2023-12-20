<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'커뮤니티 카테고리 상세'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.community.category.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />

                <input type="hidden" name="lasturl" value="{{ URL::previous() }}">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">카테고리 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="제목" value="{{ old('title') ? old('title') : $result->title }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">카테고리 내용</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="content" class="form-control form-control-solid mb-5" rows="5" placeholder="내용">{{ old('content') ? old('content') : $result->content }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'카테고리 이미지'" required="required" id="category" :images="$result->images" />

                    {{-- 파일 --}}
                    <x-admin-file-picker :title="'카테고리 파일'" required="required" id="category" :files="$result->files" />

                    {{-- 게시 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">게시 상태</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $state = old('state') ?? $result->state;
                            @endphp
                            <select id="stateOption" name="state" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true">
                                <option value="0" @if ($state == 0) selected @endif>공개</option>
                                <option value="1" @if ($state == 1) selected @endif>비공개</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('state')" />
                    </div>


                </div>
                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">수정</button>
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
