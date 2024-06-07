<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">
                        아파트 단지 관리
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
                        action="{{ route('admin.apt.complex.list.view') }}">
                        @csrf

                        {{-- 아파트 단지명 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">아파트 단지명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="kaptName" name="kaptName"
                                    class="form-control form-control-solid" placeholder="검색어 입력"
                                    value="{{ Request::get('kaptName') }}" />
                            </div>
                        </div>

                        {{-- 단지 코드 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">단지 코드</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="kaptCode" name="kaptCode"
                                    class="form-control form-control-solid" placeholder="검색어 입력"
                                    value="{{ Request::get('kaptCode') }}" />
                            </div>
                        </div>


                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
                        </div>

                    </form>

                    <div class="d-flex justify-content-end mb-10">
                        <button type="button" onclick="location.href='{{ route('data.apt') }}'"
                            class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" target="_blank">
                            1. 데이터 가져오기</button>
                        <button type="button" onclick="location.href='{{ route('data.transcations.apt.connextion') }}'"
                            class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" target="_blank">
                            2. 실거래가 연결하기</button>
                        {{-- <button type="button" onclick="location.href='{{ route('data.apt.base') }}'"
                            class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" target="_blank">
                            2. 데이터 가져오기</button>
                        <button type="button" onclick="location.href='{{ route('data.apt.detail') }}'"
                            class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" target="_blank">
                            3. 데이터 가져오기</button>
                        <button type="button" onclick="location.href='{{ route('data.apt.map') }}'"
                            class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" target="_blank">
                            4. 데이터 가져오기</button> --}}

                    </div>

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
                                    <th class="text-center min-w-100px">아파트 단지명</th>
                                    <th class="text-center">단지코드</th>
                                    <th class="text-center">시도</th>
                                    <th class="text-center">시군구</th>
                                    <th class="text-center">읍면동</th>
                                    <th class="text-center">실거래 매매<br>건수</th>
                                    <th class="text-center">마지막 매매<br>거래일</th>
                                    <th class="text-center">실거래 전/월세<br>건수</th>
                                    <th class="text-center">마지막 전/월세<br>거래일</th>
                                    <th class="text-center">건축물대장<br>마지막 업데이트일</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $apt)
                                    <tr>
                                        {{-- 아파트 관리 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $apt->id }}</span>
                                        </td>

                                        {{-- 아파트 단지명 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.apt.complex.detail.view', [$apt->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $apt->kaptName }}</a>
                                        </td>


                                        {{-- 단지코드 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $apt->kaptCode }}
                                            </span>
                                        </td>

                                        {{-- 시도 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $apt->as1 }}
                                            </span>
                                        </td>

                                        {{-- 시군구 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $apt->as2 }}
                                            </span>
                                        </td>

                                        {{-- 읍면동 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $apt->as3 }}
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
                                                    <form id="deletebanner{{ $apt->id }}"
                                                        action="{{ route('admin.apt.complex.delete') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $apt->id }}" />
                                                    </form>
                                                    <a href="javascript:deleteAlert({{ $apt->id }});"
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
                        $('#deletebanner' + id).submit();
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
