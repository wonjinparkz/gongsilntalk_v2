<x-admin-layout>
    @php
        $title = '';

        switch ($type) {
            case '0':
                $title = '공톡 유튜브';
                break;
            case '1':
                $title = '공톡 매거진';
                break;
            case '2':
                $title = '공톡 뉴스';
                break;
            default:
                $title = '매거진';
                break;
        }
    @endphp

    <div class="app-container container-xxl">
        <x-screen-card :title="$title . ' 등록'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.magazine.create') }}">
                @csrf
                <input type="hidden" name="type" value="{{ $type }}">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6"> 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="제목" value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    @if ($type == 0)
                        {{-- 유튜브 URL --}}
                        <div class="row mb-6">
                            <label class="required col-lg-4 col-form-label fw-semibold fs-6"> 유튜브 URL</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="url" class="form-control form-control-solid"
                                    placeholder="유튜브 URL" value="{{ old('url') }}" />
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('url')" />

                            </div>
                        </div>

                        {{-- 간략소개 --}}
                        <div class="row mb-6">
                            <label class="required col-lg-4 col-form-label fw-semibold fs-6"> 간략소개</label>

                            <div class="col-lg-8 fv-row">
                                <input type="text" name="content" class="form-control form-control-solid"
                                    placeholder="간략소개" value="{{ old('content') }}" />
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                            </div>

                        </div>
                    @endif

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'대표 이미지'" required="required" cnt="1" id="magazine" />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('magazine_image_ids')" />


                    @if ($type != 0)
                        {{-- 내용 --}}
                        <div class="row mb-6">
                            <label class="required col-lg-4 col-form-label fw-semibold fs-6"> 내용</label>

                            <div class="col-lg-12 fv-row">
                                <x-admin-editor :name="'content'" />
                            </div>
                        </div>
                    @endif


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
