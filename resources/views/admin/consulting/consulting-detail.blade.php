<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'컨설팅 상담 상세'">
            {{-- FORM START  --}}

            {{-- 내용 START --}}
            <div class="card-body border-top p-9">


                {{-- 작성자 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">작성자</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value={{ $result->name }} />
                    </div>
                </div>

                {{-- 전화번호 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">전화번호</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value={{ $result->phone }} />
                    </div>
                </div>

                {{-- 이메일 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">이메일</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled class="form-control form-control-solid" value={{ $result->email }} />
                    </div>
                </div>

                {{-- 작성일 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">작성일</label>
                    <div class="col-lg-8 fv-row">
                        <input disabled type="text" name="title" class="form-control form-control-solid"
                            value="{{ $result->created_at->format('Y년 m월 d일 H:i') }}" />
                    </div>
                </div>

                {{-- 상담 목적 --}}
                <div class="row mb-6">
                    <label class="col-lg-2 col-form-label fw-semibold fs-6">상담 목적</label>
                    <div class="col-lg-8 fv-row">
                        <textarea disabled name="content" class="form-control form-control-solid mb-5" rows="5">{{ $result->content }}</textarea>
                    </div>
                </div>

                <form id="updateState" name="updateState" action="{{ route('admin.consulting.state.update') }}"
                    method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $result->id }}" />
                    <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">
                </form>
                {{-- FORM END --}}

                {{-- Footer Bottom START --}}
                @if ($result->state == 0)
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button onclick="updateAlert();" class="btn btn-primary">상담 완료</button>
                    </div>
                @endif

            </div>
            <!--내용 END-->
        </x-screen-card>
    </div>

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        initDaterangepicker();

        // 삭제 물음
        function updateAlert(id) {
            Swal.fire({
                text: "상담을 완료 처리하시겠습니까?",
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
                    $('#updateState').submit();
                }
            });
        }
    </script>
</x-admin-layout>
