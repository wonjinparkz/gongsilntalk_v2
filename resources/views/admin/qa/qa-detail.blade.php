<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'1:1 문의 상세'">
            {{-- FORM START  --}}

            <form id="update" name="update" class="form" method="POST" action="{{ route('admin.qa.reply.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />
                <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">


                    {{-- 작성자 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">작성자 닉네임</label>
                        <div class="col-lg-8 fv-row">
                            <input disabled type="name" name="name" class="form-control form-control-solid"
                                value={{ $result->users->name }} />
                        </div>
                    </div>

                    {{-- 카테고리 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">카테고리</label>
                        <div class="col-lg-8 fv-row">
                            <input disabled type="category" name="category" class="form-control form-control-solid"
                                value=@if ($result->category == 0) 신고 @elseif ($result->category == 1) 건의 @else 기타 @endif />
                        </div>
                    </div>

                    {{-- 문의일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">문의일</label>
                        <div class="col-lg-8 fv-row">
                            <input disabled type="text" name="title" class="form-control form-control-solid"
                                value="{{ $result->created_at->format('Y년 m월 d일 H:i') }}" />
                        </div>
                    </div>

                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">1:1 문의 제목</label>
                        <div class="col-lg-8 fv-row">
                            <input disabled type="text" name="title" class="form-control form-control-solid"
                                value="{{ $result->title }}" />
                        </div>
                    </div>

                    {{-- 문의 내용 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">1:1 문의 내용</label>
                        <div class="col-lg-8 fv-row">
                            <textarea disabled name="content" class="form-control form-control-solid mb-5" rows="5">{{ $result->content }}</textarea>
                        </div>
                    </div>

                    <hr class="mb-10 mt-6">

                    {{-- 답변 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">1:1 문의 답변</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="reply_content" class="form-control form-control-solid mb-5" rows="5" placeholder="답변 작성">{{ old('reply_content') ?? $result->reply_content }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('reply_content')" />
                        </div>
                    </div>

                </div>
                <!--내용 END-->
            </form>

            <form id="deleteReply" name="deleteReply" action="{{ route('admin.qa.reply.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />
                <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">
            </form>
            {{-- FORM END --}}

            {{-- Footer Bottom START --}}
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button onclick="updateAlert();" class="btn btn-primary">답변 저장</button>
                &nbsp;
                <button onclick="deleteAlert({{ $result->id }});" class="btn btn-danger">답변 삭제</button>
            </div>
            {{-- Footer END --}}

        </x-screen-card>
    </div>

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        initDaterangepicker();

        // 삭제 물음
        function deleteAlert(id) {
            Swal.fire({
                text: "답변을 삭제하시겠습니까?",
                icon: "question",
                dangerMode: true,
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonText: "취소",
                confirmButtonText: "확인",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary"
                }
            }).then(function(result) {
                if (result.value) {
                    $('#deleteReply').submit();
                }
            });
        }

        // 답변 등록
        function updateAlert() {
            $('#update').submit();
        }
    </script>
</x-admin-layout>
