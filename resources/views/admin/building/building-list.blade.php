<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">
                        건물 관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.building.create.view') }}" class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>
        {{-- 메인 내용 --}}

        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.building.list.view') }}">
                        @csrf

                        {{-- 건물명 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">건물명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="kbuildingName" name="kbuildingName"
                                    class="form-control form-control-solid" placeholder="검색어 입력"
                                    value="{{ Request::get('kbuildingName') }}" />
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
                                    <th class="text-center min-w-100px">건물명</th>
                                    <th class="text-center">시도</th>
                                    <th class="text-center">시군구</th>
                                    <th class="text-center">읍면동</th>
                                    <th class="text-center">실거래 매매<br>건수</th>
                                    <th class="text-center">마지막 매매<br>거래일</th>
                                    <th class="text-center">실거래 전/월세<br>건수</th>
                                    <th class="text-center">마지막 전/월세<br>거래일</th>
                                    <th class="text-center">건축물대장<br>마지막 업데이트일</th>
                                    <th class="text-center">공개여부</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $building)
                                    <tr>
                                        {{-- 아파트 관리 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $building->id }}</span>
                                        </td>

                                        {{-- 건물명 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.building.detail.view', [$building->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $building->kbuildingName }}</a>
                                        </td>


                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $building->as1 }}
                                            </span>
                                        </td>

                                        {{-- 시군구 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $building->as2 }}
                                            </span>
                                        </td>

                                        {{-- 읍면동 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $building->as3 }}
                                            </span>
                                        </td>

                                        {{-- 실거래 매매 건수 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                0
                                            </span>
                                        </td>

                                        {{-- 마지막 매매 거래일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                0
                                            </span>
                                        </td>

                                        {{-- 실거래 전/월세 건수 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                0
                                            </span>
                                        </td>

                                        {{-- 마지막 전/월세 거래일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                0
                                            </span>
                                        </td>

                                        {{-- 건축물대장 마지막 업데이트일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                0
                                            </span>
                                        </td>

                                        {{-- 공개여부 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $building->is_blind ? '비공개' : '공개' }}
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
                                                    <form action="{{ route('admin.building.state.update') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $building->id }}" />
                                                        <input type="hidden" name="is_blind"
                                                            value="{{ $building->is_blind }}" />
                                                        <a href="#" onclick="parentNode.submit();"
                                                            class="menu-link px-3">
                                                            @if ($building->is_blind == 0)
                                                                비공개
                                                            @elseif ($building->is_blind == 1)
                                                                공개
                                                            @endif
                                                        </a>
                                                    </form>
                                                </div>
                                                {{-- 삭제 --}}
                                                <div class="menu-item px-3">
                                                    <form id="deleteStore{{ $building->id }}"
                                                        action="{{ route('admin.building.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $building->id }}" />
                                                    </form>
                                                    <a href="javascript:deleteAlert({{ $building->id }});"
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
</x-admin-layout>
