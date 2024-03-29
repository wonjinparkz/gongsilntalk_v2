<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'약관 등록'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.terms.create') }}">
                @csrf
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">약관 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid" placeholder="제목"
                                value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">약관 내용</label>
                        <div class="col-lg-12 fv-row">
                            <x-admin-editor :name="'content'" />
                        </div>
                    </div>

                    {{-- 약관 종류 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">약관 종류</label>
                        <div class="col-lg-4 d-flex align-items-center">
                            @php
                                $kind = old('kind') ?? 0;
                            @endphp
                            <select name="kind" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                @for ($i = 0; $i < count(Lang::get('commons.kind')); $i++)
                                    <option value="{{ $i }}"
                                        @if ($i == $kind) selected @endif>
                                        {{ Lang::get('commons.kind.' . $i) }}</option>
                                @endfor
                                </option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('kind')" />
                    </div>

                    {{-- 노출 대상 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label  fw-semibold fs-6">노출 대상</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $type = old('type') ?? 0;
                            @endphp
                            <select name="type" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($type == 0) selected @endif>일반 회원</option>
                                <option value="1" @if ($type == 1) selected @endif>중개사 회원</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('type')" />
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
    {{-- <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script> --}}

</x-admin-layout>
