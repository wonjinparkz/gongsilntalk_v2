<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'팝업관리 상세'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.popup.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />
                <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">팝업 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="제목" value="{{ old('title') ? old('title') : $result->title }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">팝업 내용</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="content" class="form-control form-control-solid mb-5" rows="5" placeholder="내용">{{ old('content') ? old('content') : $result->content }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    {{-- 게시기간 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">게시기간</label>
                        <div class="col-lg-8 fv-row">
                            <x-admin-date-picker :title="'게시기간'" :from_name="'started_at'" :to_name="'ended_at'" :from_date="old('started_at') ?? $result->started_at"
                                :to_date="old('ended_at') ?? $result->ended_at" />
                        </div>
                    </div>

                    {{-- 이미지 --}}
                    <x-admin-image-picker :title="'팝업 이미지'" :id="'popup'" :images="$result->images" />


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
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('state')" />
                        </div>
                    </div>

                    {{-- 게시 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">게시 상태</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('is_blind') ?? $result->is_blind;
                            @endphp
                            <select id="stateOption" name="is_blind" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>공개</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>비공개</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
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

        initDaterangepicker();

        // 이미지 드롭 존 있을 경우
        initImageDropzone();
    </script>
</x-admin-layout>
