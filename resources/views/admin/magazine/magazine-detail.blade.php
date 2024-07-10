<x-admin-layout>
    @php
        $title = '';

        switch ($result->type) {
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
        <x-screen-card :title="$title . ' 상세'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admin.magazine.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />
                <input type="hidden" name="type" value="{{ $result->type }}" />
                <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">제목</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="제목" value="{{ old('title') ? old('title') : $result->title }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />

                        </div>
                    </div>

                    @if ($result->type == 0)
                        {{-- 유튜브 URL --}}
                        <div class="row mb-6">
                            <label class="required col-lg-4 col-form-label fw-semibold fs-6"> 유튜브 URL</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="url" class="form-control form-control-solid"
                                    placeholder="유튜브 URL" value="{{ old('url') ? old('url') : $result->url }}" />
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('url')" />

                            </div>
                        </div>

                        {{-- 간략소개 --}}
                        <div class="row mb-6">
                            <label class="required col-lg-4 col-form-label fw-semibold fs-6"> 간략소개</label>

                            <div class="col-lg-8 fv-row">
                                <input type="text" name="content" class="form-control form-control-solid"
                                    placeholder="간략소개"
                                    value="{{ old('content') ? old('content') : $result->content }}" />
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                            </div>

                        </div>
                    @endif

                    {{-- 이미지 --}}
                    <x-admin-image-picker :title="'대표 이미지'" :id="'magazine'" required="required" cnt="1"
                        :images="$result->images" />

                    {{-- 작성일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">작성일</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold fs-5">
                                @inject('carbon', 'Carbon\Carbon')
                                {{ $carbon::parse($result->created_at)->format('Y년 m월 d일 H:i') }}
                            </span>
                        </div>
                    </div>

                    {{-- 조회수 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">조회수</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold fs-5">
                                {{ $result->view_count }}
                            </span>
                        </div>
                    </div>

                    {{-- 추천수 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">추천수</label>

                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold fs-5">
                                {{ $result->like_count }}
                            </span>
                        </div>
                    </div>

                    @if ($result->type != 0)
                        {{-- 내용 --}}
                        <div class="row mb-6">
                            <label class="required col-lg-4 col-form-label fw-semibold fs-6">내용</label>
                            <div class="col-lg-12 fv-row">
                                <x-admin-editor :name="'content'" :content="old('content') ? old('content') : $result->content" />
                            </div>
                        </div>
                    @endif

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

        <x-screen-card :title="$title . ' 댓글'">
            <x-admin-community-reply :result="$result" :replys="$replys" :route="'admin.magazine.detail.view'" />
        </x-screen-card>

    </div>

    {{--
           * 페이지에서 사용하는 자바스크립트
        --}}
    <script>
        var hostUrl = "assets/";

        // 이미지 드롭 존 있을 경우
        initImageDropzone();

        // 대댓글 열기
        function toggleReply(id) {

            var reply = $(".reply_" + id);
            var toggleButton = $("#toggle_button_" + id);
            if (reply.hasClass('collapse show')) {
                reply.collapse('hide');
                toggleButton.html('<i class="fs-3 m-0 fa-solid fa-plus"></i>');
            } else {
                reply.collapse('show');
                toggleButton.html('<i class="fs-3 m-0 fa-solid fa-minus"></i>');
            }

        }
    </script>
</x-admin-layout>
