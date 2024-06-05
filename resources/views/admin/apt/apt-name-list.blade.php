<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">
                        아파트 단지명 관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.apt.name.create.view') }}" class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>
        {{-- 메인 내용 --}}

        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.apt.name.list.view') }}">
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
                                    <th class="text-center">유사 단지명</th>
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
                                            <a href="{{ route('admin.apt.name.detail.view', [$apt->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $apt->kaptName }}</a>
                                        </td>


                                        {{-- 단지코드 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $apt->kaptCode }}
                                            </span>
                                        </td>

                                        {{-- 단지코드 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $apt->complex_name }}
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
                                                        action="{{ route('admin.apt.name.delete') }}"
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


        <!-- modal 등록 : s -->
        <div class="modal modal_reg">

            <div class="modal_container">
                <div class="modal_mss_wrap">
                    <p class="txt_item_1">게시글을 등록하시겠습니까?</p>
                </div>

                <div class="modal_btn_wrap">
                    <button class="btn_gray btn_full_thin" onclick="modal_close('reg')">취소</button>
                    <button class="btn_point btn_full_thin" onclick="$('.form').submit();">게시글 등록</button>
                </div>
            </div>

        </div>
        <div class="md_overlay md_overlay_reg" onclick="modal_close('reg')"></div>
        <!-- modal 등록 : e -->



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
