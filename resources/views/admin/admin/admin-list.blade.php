<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">관리자
                        목록
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admins.create.view') }}" class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>
        {{-- 메인 내용 --}}
        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">

                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admins.list.view') }}">
                        @csrf

                        {{-- 제목 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">관리자 이름</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name" class="form-control form-control-solid"
                                    placeholder="관리자 이름" value="{{ Request::get('name') }}" />
                            </div>
                        </div>

                        {{-- 등록일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">관리자 등록일</label>
                            <div class="col-lg-8 fv-row">
                                {{-- 데이트 피커 --}}
                                <input class="form-control form-control-solid" placeholder="작성일 검색"
                                    id="daterangepicker" />
                                {{-- 검색 시작일 --}}
                                <input type="hidden" id="from_created_at" name="from_created_at"
                                    value="{{ Request::get('from_created_at') }}">
                                {{-- 검색 종료일 --}}
                                <input type="hidden" id="to_created_at" name="to_created_at"
                                    value="{{ Request::get('to_created_at') }}">
                            </div>
                        </div>

                        {{-- 상태 선택 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">관리자 상태</label>
                            @php
                                $state = Request::get('state') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="state" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="-1" @if ($state < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($state == 0) selected @endif>사용가능
                                    </option>
                                    <option value="1" @if ($state == 1) selected @endif>사용불가능
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
                        </div>

                    </form>

                </div>


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
                                    <th class="text-center w-20px">ID.</th>
                                    <th class="text-center">아이디</th>
                                    <th class="text-center">관리자 이름</th>
                                    <th class="text-center">관리자 전화번호</th>
                                    <th class="text-center">상태</th>
                                    <th class="text-center">등록일</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $manager)
                                    {{-- 관리자 ID --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5">{{ $manager->id }}</span>
                                    </td>

                                    {{-- 관리자 아이디 --}}
                                    <td class="text-center">
                                        <a href="{{ route('admins.detail.view', [$manager->id]) }}"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $manager->admin_id }}</a>
                                    </td>

                                    {{-- 관리자 이름 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-gray-800 ">{{ $manager->name }}</span>
                                    </td>

                                    {{-- 관리자 전화번호 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-gray-800 ">{{ $manager->phone }}</span>
                                    </td>

                                    {{-- 상태 --}}
                                    <td class="text-center">
                                        {{-- 상태 뱃지 --}}
                                        @if ($manager->state == 0)
                                            <div class="badge badge-light-success">
                                                사용가능
                                            </div>
                                        @else
                                            <div class="badge badge-light-danger">
                                                사용불가능
                                            </div>
                                        @endif
                                    </td>

                                    {{-- 등록일 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5">
                                            @inject('carbon', 'Carbon\Carbon')
                                            {{ $carbon::parse($manager->created_at)->format('Y.m.d') }}
                                        </span>
                                    </td>
                                    {{-- 동작 : 수정, 삭제 --}}
                                    <td class="text-center">
                                        {{-- 동작 버튼 --}}
                                        @if (Auth::guard('admin')->user()->id != $manager->id)
                                            <a href="#" class="btn btn-sm btn-success btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">더보기</a>
                                            {{-- 동작 메뉴 --}}
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                {{-- 수정 --}}
                                                <div class="menu-item px-3">
                                                    <form
                                                        action="{{ route('admins.state.update') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $manager->id }}" />
                                                        <input type="hidden" name="state"
                                                            value="{{ $manager->state }}" />
                                                            <a href="#" onclick="parentNode.submit();"
                                                                class="menu-link px-3">
                                                                @if ($manager->state == 0)
                                                                    사용불가능
                                                                @elseif ($manager->state == 1)
                                                                    사용가능
                                                                @endif
                                                            </a>
                                                    </form>

                                                </div>

                                                {{-- 삭제 --}}
                                                <div class="menu-item px-3">
                                                    <form id="deleteManager{{ $manager->id }}"
                                                        action="{{ route('admins.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $manager->id }}" />
                                                    </form>
                                                    <a href="javascript:deleteAlert({{ $manager->id }});"
                                                        class="menu-link px-3">삭제</a>
                                                </div>
                                            </div>
                                        @endif


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
                    $('#deleteManager' + id).submit();
                }
            });
        }
    </script>
</x-admin-layout>
