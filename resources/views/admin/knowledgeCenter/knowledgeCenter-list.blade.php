<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">지식산업센터
                        관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />

                </div>
                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.knowledgeCenter.create.view') }}"
                        class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>

        {{-- 메인 내용 --}}
        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">

                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.knowledgeCenter.list.view') }}">
                        @csrf

                        {{-- 건물명으로 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">건물명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="product_name" name="product_name"
                                    class="form-control form-control-solid" placeholder="건물명을 입력해주세요."
                                    value="{{ Request::get('product_name') }}" />
                            </div>
                        </div>

                        {{-- 주소로 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">주소</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="address" name="address"
                                    class="form-control form-control-solid" placeholder="주소 중 일부를 입력해주세요."
                                    value="{{ Request::get('address') }}" />
                            </div>
                        </div>

                        {{-- 한줄요약으로 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">한줄요약</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="comments" name="comments"
                                    class="form-control form-control-solid" placeholder="한줄요약을 입력해주세요."
                                    value="{{ Request::get('comments') }}" />
                            </div>
                        </div>

                        {{-- 등록일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">등록일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'등록일을 선택해주세요.'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn me-10 col-lg-1 btn-primary">검색</button>
                        </div>

                        <div class="d-flex justify-content-end mt-10">
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_1">
                                엑셀 업로드<br>(데이터 업데이트)</a>
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical"
                                href="{{ route('admin.knowledgeCenter.forupdate.export', Request::all()) }}"
                                target="_blank">
                                엑셀 다운로드<br>(데이터 업데이트 용)</a>
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical"
                                href="{{ route('admin.knowledgeCenter.export', Request::all()) }}" target="_blank">
                                엑셀 다운로드</a>
                        </div>

                    </form>

                </div>

                {{-- 테이블 영역 --}}
                <div class="card card-flush shadow-sm mt-10">
                    {{ $result->links('components.pagination-info') }}
                    {{-- 데이터 내용 --}}
                    <div class="card-body pt-0 table-responsive">

                        {{-- 테이블 --}}
                        <table id="knowledgeCenter_table"
                            class="table align-middle table-bordered table-row-dashed table-hover fs-6 gy-5">
                            {{-- 테이블 헤더 --}}
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fl-7 text-uppercase gs-0">
                                    <th class="text-center w-20px">No.</th>
                                    <th class="text-center">건물명</th>
                                    <th class="text-center">주소</th>
                                    <th class="text-center">준공일</th>
                                    <th class="text-center">매매호가(단위:만원)</th>
                                    <th class="text-center">임대호가(단위:만원)</th>
                                    <th class="text-center">등록일</th>
                                    <th class="text-center w-70px">도면여부</th>
                                    <th class="text-center">공개여부</th>
                                    <th class="text-center">한줄요약</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $knowledgeCenter)
                                    <tr>
                                        {{-- 회원 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $knowledgeCenter->id }}</span>
                                        </td>

                                        {{-- 건물명 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $knowledgeCenter->product_name }}</span>
                                        </td>

                                        {{-- 주소 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.knowledgeCenter.detail.view', [$knowledgeCenter->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $knowledgeCenter->address }}</a>
                                        </td>

                                        {{-- 준공일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $knowledgeCenter->completion_date }}</span>
                                        </td>

                                        {{-- 매매호가(단위:만원) --}}
                                        <td class="text-center">
                                            <span
                                                class="fw-bold fs-5">{{ $knowledgeCenter->sale_min_price . '-' . $knowledgeCenter->sale_mid_price . '-' . $knowledgeCenter->sale_max_price }}</span>
                                        </td>

                                        {{-- 임대호가(단위:만원) --}}
                                        <td class="text-center">
                                            <span
                                                class="fw-bold fs-5">{{ $knowledgeCenter->lease_min_price . '-' . $knowledgeCenter->lease_mid_price . '-' . $knowledgeCenter->lease_max_price }}</span>
                                        </td>

                                        {{-- 등록일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($knowledgeCenter->created_at)->format('Y년 m월 d일') }}
                                            </span>
                                        </td>

                                        {{-- 도면 여부 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @if ($knowledgeCenter->floorPlan_files != null && count($knowledgeCenter->floorPlan_files) > 0)
                                                    O
                                                @else
                                                    X
                                                @endif
                                            </span>
                                        </td>

                                        {{-- 공개여부 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $knowledgeCenter->is_blind ? '비공개' : '공개' }}
                                            </span>
                                        </td>
                                        {{-- 한줄요약 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $knowledgeCenter->comments }}
                                            </span>
                                        </td>

                                        {{-- 동작 : 수정, 삭제 --}}
                                        <td class="text-center">
                                            {{-- 동작 버튼 --}}
                                            <a href="#" class="btn btn-sm btn-success btn-active-light-primary"
                                                data-kt-menu-trigger="click"
                                                data-kt-menu-placement="bottom-end">더보기</a>
                                            {{-- 동작 메뉴 --}}
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                {{-- 수정 --}}
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('admin.knowledgeCenter.state.update') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $knowledgeCenter->id }}" />
                                                        <input type="hidden" name="is_blind"
                                                            value="{{ $knowledgeCenter->is_blind }}" />
                                                        <a href="#" onclick="parentNode.submit();"
                                                            class="menu-link px-3">
                                                            @if ($knowledgeCenter->is_blind == 0)
                                                                비공개
                                                            @elseif ($knowledgeCenter->is_blind == 1)
                                                                공개
                                                            @endif
                                                        </a>
                                                    </form>
                                                </div>
                                                {{-- 삭제 --}}
                                                <div class="menu-item px-3">
                                                    <form id="deleteKnowledgeCenter{{ $knowledgeCenter->id }}"
                                                        action="{{ route('admin.knowledgeCenter.delete') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $knowledgeCenter->id }}" />
                                                    </form>
                                                    <a href="javascript:deleteAlert({{ $knowledgeCenter->id }});"
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

    {{-- 엑셀 업로드 모달창 --}}
    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">엑셀 업로드</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('admin.knowledgeCenter.update.excel') }}" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        {{-- 층별도면 --}}
                        <input type="file" name="excel_file" accept=".xlsx, .xls">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">취소</button>
                        <button type="submit" class="btn btn-primary">업데이트</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var hostUrl = "assets/";

        initDaterangepicker();

        $("#knowledgeCenter_table").DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": false,
            "dom": "<'table-responsive'tr>"
        });

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
                    $('#deleteKnowledgeCenter' + id).submit();
                }
            });
        }
    </script>
</x-admin-layout>
