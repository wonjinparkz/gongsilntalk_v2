<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">
                        아파트 매매 실거래가 관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.store.create.view') }}" class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>
        {{-- 메인 내용 --}}

        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.store.list.view') }}">
                        @csrf

                        {{-- 아파트 명 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">아파트 명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="kstoreName" name="kstoreName"
                                    class="form-control form-control-solid" placeholder="검색어 입력"
                                    value="{{ Request::get('kstoreName') }}" />
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
                        </div>
                        <div class="d-flex justify-content-end mb-10">
                            {{-- <button type="button" onclick="location.href='{{ route('data.transcations.apt') }}'"
                                class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" target="_blank">
                                1. 데이터 가져오기</button> --}}
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_1">
                                데이터 가져오기</a>
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
                                    <th class="text-center">법정동시군구코드</th>
                                    <th class="text-center">법정동읍면동코드</th>
                                    <th class="text-center">계약년도</th>
                                    <th class="text-center">계약 월</th>
                                    <th class="text-center min-w-100px">아파트 명</th>
                                    <th class="text-center">명칭 여부</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $store)
                                    <tr>
                                        {{-- 아파트 관리 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $store->id }}</span>
                                        </td>

                                        {{-- 법정동시군구코드 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $store->legalDongCityCode }}
                                            </span>
                                        </td>

                                        {{-- 법정동읍면동코드 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $store->legalDongDistrictCode }}
                                            </span>
                                        </td>

                                        {{-- 계약년도 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $store->year }}
                                            </span>
                                        </td>

                                        {{-- 계약 월 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $store->month }}
                                            </span>
                                        </td>

                                        {{-- 아파트 명 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.store.detail.view', [$store->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $store->aptName }}</a>
                                        </td>

                                        {{-- 공개여부 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $store->is_matching ? '매칭 완료' : '매칭 전' }}
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
                                                {{-- 수정 --}}
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('admin.store.state.update') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $store->id }}" />
                                                        <input type="hidden" name="is_blind"
                                                            value="{{ $store->is_blind }}" />
                                                        <a href="#" onclick="parentNode.submit();"
                                                            class="menu-link px-3">
                                                            @if ($store->is_blind == 0)
                                                                비공개
                                                            @elseif ($store->is_blind == 1)
                                                                공개
                                                            @endif
                                                        </a>
                                                    </form>
                                                </div>
                                                {{-- 삭제 --}}
                                                <div class="menu-item px-3">
                                                    <form id="deleteStore{{ $store->id }}"
                                                        action="{{ route('admin.store.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $store->id }}" />
                                                    </form>
                                                    <a href="javascript:deleteAlert({{ $store->id }});"
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


        {{-- 실거래가 업데이트 모달창 --}}
        <div class="modal fade" tabindex="-1" id="kt_modal_1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">실거래가 업데이트</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <form action="{{ route('data.transcations.apt') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body row">
                            <div class="col-lg-12 row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">지역 선택</label>
                                <div class="col-lg-10 fv-row">
                                    <select name="type[]"class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="지역 선택" data-allow-clear="true">
                                        <option value=""></option>
                                        @for ($i = 0; $i < count(Lang::get('commons.product_type')); $i++)
                                            <option value="{{ $i }}">
                                                {{ Lang::get('commons.product_type.' . $i) }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">취소</button>
                            <button type="submit" class="btn btn-primary">업데이트</button>
                        </div>
                    </form>
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
                        $('#deleteStore' + id).submit();
                    }
                });
            }

            function orderUpdate() {
                var values = []; // 중복 값 저장할 배열
                var data = {};

                $('.setid').each(function(index) {
                    var id = $(this).val();
                    var value = $('#setorder_' + id).val();
                    data[id] = value;
                    if (value !== '') {
                        values.push(value);
                    }
                });

                if (Object.keys(data).length <= 0) {
                    return;
                }

                if (new Set(values).size !== values.length) {
                    alert('중복된 순서가 있습니다.', "확인");
                } else {
                    $('#order_data').val(JSON.stringify(data));
                    $('#orderUpdate').submit();
                }
            }
        </script>

        <script>
            // 지역 가져오는 api
            function get_region(regcode, region) {
                var gatewayUrl =
                    "https://grpc-proxy-server-mkvo6j4wsq-du.a.run.app/v1/regcodes?regcode_pattern=" + regcode +
                    "&is_ignore_zero=true";

                $.ajax({
                    url: gatewayUrl,
                    method: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.regcodes && Array.isArray(response.regcodes)) {

                        }
                    },
                    error: function(error) {
                        console.error("Error fetching regcodes:", error);
                    }
                });
            }
        </script>
</x-admin-layout>
