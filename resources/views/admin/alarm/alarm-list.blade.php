<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">알림 관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
            </div>
        </div>
        {{-- 메인 내용 --}}
        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.alarm.view') }}">
                        @csrf

                        {{-- 이메일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">사용자</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="email" name="email"
                                    class="form-control form-control-solid" placeholder="이메일"
                                    value="{{ Request::get('email') }}" />
                            </div>
                        </div>

                        {{-- 게시 타겟 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">알림 발송 타겟</label>
                            @php
                                $target = Request::get('target') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="target" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($target < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($target == 0) selected @endif>사용자
                                    </option>
                                    <option value="1" @if ($target == 1) selected @endif>파트너
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
                        </div>

                    </form>
                </div>
                {{-- 발송 --}}

                <div class="card card-flush shadow-sm mt-10">
                    <form class="form card-body row border-top p-9 align-items-center" method="POST"
                        action="{{ route('admin.alarm.send') }}">
                        @csrf

                        {{-- 발송할 사용자 수  --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">발송할 사용자 수</label>
                            <label class="col-lg-8 fv-row">

                            </label>
                        </div>

                        {{-- 이메일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">메세지</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="message" name="message"
                                    class="form-control form-control-solid" placeholder="메세지"
                                    value="{{ Request::get('message') }}" />
                            </div>
                        </div>


                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">알림 발송</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>


    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        // 날짜 검색이 있을 경우 추가
        initDaterangepicker();

        // 삭제 물음
        function deleteAlert(id) {
            Swal.fire({
                text: "삭제하시겠습니까?\n삭제후에는 되돌릴 수 없습니다!",
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
                    $('#deleteNotice' + id).submit();
                }
            });
        }
    </script>
</x-admin-layout>
