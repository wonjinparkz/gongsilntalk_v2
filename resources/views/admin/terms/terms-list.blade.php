<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">약관 관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.terms.create.view') }}" class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>
        {{-- 메인 내용 --}}
        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.terms.list.view') }}">
                        @csrf

                        {{-- 제목 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">약관 제목</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="title" name="title"
                                    class="form-control form-control-solid" placeholder="제목 + 내용"
                                    value="{{ Request::get('title') }}" />
                            </div>
                        </div>

                        {{-- 작성일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">약관 작성일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'작성일 검색'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>

                        {{-- 게시 타겟 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">약관 게시타겟</label>
                            @php
                                $type = Request::get('type') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="type" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($type < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($type == 0) selected @endif>사용자
                                    </option>
                                    <option value="1" @if ($type == 1) selected @endif>파트너
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- 상태 선택 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">약관 종류</label>
                            @php
                                $kind = Request::get('kind') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="kind" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($kind < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($kind == 0) selected @endif>이용약관
                                    </option>
                                    <option value="1" @if ($kind == 1) selected @endif>개인정보처리방침
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
                        </div>

                    </form>

                </div>
                {{-- 테이블 영역 --}}
                <div class="card card-flush shadow-sm mt-10">
                    {{ $result->links('components.pagination-info') }}
                    {{-- 데이터 내용 --}}
                    <div class="card-body pt-0 table-responsive">
                        {{-- 테이블 --}}
                        <table id="notice_table"
                            class="table align-middle table-bordered table-row-dashed table-hover fs-6 gy-5">
                            {{-- 테이블 헤더 --}}
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fl-7 text-uppercase gs-0">
                                    <th class="text-center w-20px">No.</th>
                                    <th class="text-center min-w-250px">제목</th>
                                    <th class="text-center">약관종류</th>
                                    <th class="text-center">게시타겟</th>
                                    <th class="text-center">작성일</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $term)
                                    <tr>
                                        {{-- 공지사항 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $term->id }}</span>
                                        </td>

                                        {{-- 공지사항 제목 --}}
                                        <td class="text-center">
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('admin.terms.detail.view', [$term->id]) }}"
                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $term->title }}</a>

                                                <a href="{{ route('terms.preview', ['kind' => $term->kind, 'type' => $term->type]) }}"
                                                    class="ms-3 ps-2 pe-2 badge badge-square badge-secondary"
                                                    target='_blank'>미리보기</a>
                                            </div>
                                        </td>

                                        {{-- 약관 종류 --}}
                                        <td class="text-center">

                                            <span class="fw-bold fs-5">
                                                @if ($term->kind == 0)
                                                    이용약관
                                                @else
                                                    개인정보처리방침
                                                @endif
                                            </span>

                                        </td>

                                        {{-- 게시 타겟 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @if ($term->type == 0)
                                                    사용자
                                                @else
                                                    파트너
                                                @endif
                                            </span>
                                        </td>

                                        {{-- 작성일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($term->created_at)->format('Y년 m월 d일 H:i:s') }}
                                            </span>
                                        </td>
                                        {{-- 동작 : 수정, 삭제 --}}
                                        <td class="text-center">
                                            {{-- 동작 버튼 --}}
                                            <a href="#" class="btn btn-sm btn-success btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">더보기</a>
                                            {{-- 동작 메뉴 --}}
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                {{-- 삭제 --}}
                                                <div class="menu-item px-3">
                                                    <form id="deleteTerms{{ $term->id }}"
                                                        action="{{ route('admin.terms.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $term->id }}" />
                                                    </form>
                                                    <a href="javascript:deleteAlert({{ $term->id }});"
                                                        class="menu-link px-3">삭제</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    {{ $result->onEachSide(1)->links('components.pagination') }}
                </div>
            </div>

        </div>
    </div>


    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

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
                    $('#deleteTerms' + id).submit();
                }
            });
        }
    </script>
</x-admin-layout>
