<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">분양현장 분양
                        관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>

                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.site.product.create.view') }}"
                        class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>
        {{-- 메인 내용 --}}
        <form id="stateUpdate" action="{{ route('admin.product.state.update') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="" />
            <input type="hidden" name="state" value="" />
        </form>

        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.site.product.list.view') }}">
                        @csrf

                        <input type="hidden" name="user_type" value="0">

                        {{-- 분양 상태 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">분양 상태</label>
                            @php
                                $is_sale = Request::get('is_sale') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="is_sale" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($is_sale < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($is_sale == 0) selected @endif>분양예정
                                    </option>
                                    <option value="1" @if ($is_sale == 1) selected @endif>분양중
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- 등록일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">등록일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'등록일을 선택해주세요.'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>

                        {{-- 지역 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">지역</label>
                            @php
                                $region_type = Request::get('region_type') ?? [];
                            @endphp
                            <div class="col-lg-10 fv-row">
                                <select name="region_type[]"class="form-select form-select-solid" data-control="select2"
                                    data-close-on-select="false" data-placeholder="지역을 선택해주세요."
                                    data-allow-clear="true" multiple="multiple">
                                    @for ($i = 0; $i < count(Lang::get('commons.site_product_region_type')); $i++)
                                        <option value="{{ $i }}"
                                            @if (in_array($i, $region_type)) selected @endif>
                                            {{ Lang::get('commons.site_product_region_type.' . $i) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
                        </div>

                        <div class="d-flex justify-content-end mt-10">
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical"
                                href="{{ route('admin.site.product.export', Request::all()) }}" target="_blank">
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
                        <table id="notice_table"
                            class="table align-middle table-bordered table-row-dashed table-hover fs-6 gy-5">
                            {{-- 테이블 헤더 --}}
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fl-7 text-uppercase gs-0">
                                    <th class="text-center w-20px">No.</th>
                                    <th class="text-center">분양상태</th>
                                    <th class="text-center min-w-250px">주소</th>
                                    <th class="text-center">건물명</th>
                                    <th class="text-center">준공일</th>
                                    <th class="text-center">등록일</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $siteProduct)
                                    <tr>
                                        {{-- 분양관리 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $siteProduct->id }}</span>
                                        </td>

                                        {{-- 분양상태 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $siteProduct->is_sale ? '분양중' : '분양예정' }}
                                            </span>
                                        </td>


                                        {{-- 주소 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.product.detail.view', [$siteProduct->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $siteProduct->address . ' ' . ($siteProduct->is_map == 1 ? $siteProduct->address_detail : $siteProduct->address_dong . ' ' . $siteProduct->address_number) }}</a>
                                        </td>

                                        {{-- 건물명 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $siteProduct->product_name }}
                                            </span>
                                        </td>

                                        {{-- 준공일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($siteProduct->completion_date)->format('Y.m.d') }}
                                            </span>
                                        </td>

                                        {{-- 등록일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($siteProduct->created_at)->format('Y.m.d') }}
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
                                                    <form action="{{ route('admin.site.product.sale.update') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $siteProduct->id }}" />
                                                        <input type="hidden" name="is_sale"
                                                            value="{{ $siteProduct->is_sale }}" />
                                                        <a href="#" onclick="parentNode.submit();"
                                                            class="menu-link px-3">
                                                            @if ($siteProduct->is_sale == 0)
                                                                분양중
                                                            @elseif ($siteProduct->is_sale == 1)
                                                                분양예정
                                                            @endif
                                                        </a>
                                                    </form>
                                                </div>
                                                {{-- 삭제 --}}
                                                <div class="menu-item px-3">
                                                    <form id="deleteKnowledgeCenter{{ $siteProduct->id }}"
                                                        action="{{ route('admin.site.product.delete') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $siteProduct->id }}" />
                                                    </form>
                                                    <a href="javascript:deleteAlert({{ $siteProduct->id }});"
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

            // 날짜 검색이 있을 경우 추가
            initDaterangepicker();
            initDaterangepicker2();

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

            function stateUpdate(id, state) {

                Swal.fire({
                    text: "상태를 변경하시겠습니까?",
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
                        $('#stateUpdate input[name="id"]').val(id);
                        $('#stateUpdate input[name="state"]').val(state);
                        $('#stateUpdate').submit();
                    }
                });
            }
        </script>
</x-admin-layout>
