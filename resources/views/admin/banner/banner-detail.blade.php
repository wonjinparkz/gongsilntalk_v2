<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'메인 베너 상세'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.banner.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />
                <input type="hidden" name="lasturl" value="{{ URL::previous() }}">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 이미지 --}}
                    <x-admin-image-picker :title="'배너 이미지'" :id="'banner'" cnt="1" required="required"
                        :images="$result->images" />

                    {{-- 배너명 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">배너명</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="name" class="form-control form-control-solid mb-5" rows="5" placeholder="배너의 이름을 입력해주세요.">{{ old('name') ? old('name') : $result->name }}</textarea>
                            {{-- <input type="text" name="name" class="form-control form-control-solid"
                                placeholder="배너의 이름을 입력해주세요." value="{{ old('name') ? old('name') : $result->name }}" /> --}}
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />

                        </div>
                    </div>

                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">배너 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="제목" value="{{ old('title') ? old('title') : $result->title }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 노출여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">노출여부</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('is_blind') ?? $result->is_blind;
                            @endphp
                            <select id="stateOption" name="is_blind" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>노출</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>미노출</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">팝업 내용</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="content" class="form-control form-control-solid mb-5" rows="5" placeholder="80자 이내로 배너에 대한 내용을 입력해주세요.">{{ old('content') ? old('content') : $result->content }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    {{-- 연결 페이지 링크 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">연결 페이지 링크</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="url" class="form-control form-control-solid"
                                placeholder="링크를 입력해주세요." value="{{ old('url') ? old('url') : $result->url }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('url')" />
                        </div>
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

        initDaterangepicker3();
    </script>
</x-admin-layout>
