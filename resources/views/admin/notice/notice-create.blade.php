<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'공지사항 등록'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.notice.create') }}">
                @csrf
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">공지사항 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid" placeholder="제목"
                                value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'공지사항 이미지'" id="notice" cnt="1" required="required" />

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">공지사항 내용</label>
                        <div class="col-lg-8 fv-row">
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
