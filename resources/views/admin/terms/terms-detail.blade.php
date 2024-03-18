<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'약관 상세보기'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.terms.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />
                <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">약관 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="제목" value="{{ old('title') ? old('title') : $result->title }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">약관 내용</label>
                        <div class="col-lg-12 fv-row">
                            <x-admin-editor :name="'content'" :content="$result->content" />
                        </div>
                    </div>

                    {{-- 게시 타입 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label  fw-semibold fs-6">게시 타겟</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $type = old('type') ?? $result->type;
                            @endphp
                            <select name="type" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($type == 0) selected @endif>사용자</option>
                                <option value="1" @if ($type == 1) selected @endif>파트너</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('type')" />
                    </div>

                    {{-- 게시 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">게시 유형</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $kind = old('kind') ?? $result->kind;
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
</x-admin-layout>
