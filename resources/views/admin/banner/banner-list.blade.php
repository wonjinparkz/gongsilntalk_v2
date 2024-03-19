<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">배너 관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.banner.create.view') }}" class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>
        {{-- 메인 내용 --}}

        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.banner.list.view') }}">
                        @csrf

                        {{-- 배너 명 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">배너 명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-solid" placeholder="검색어 입력"
                                    value="{{ Request::get('name') }}" />
                            </div>
                        </div>

                        {{-- 등록일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">등록일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'등록일을 선택해주세요.'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>


                        {{-- 공개여부 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">공개여부</label>
                            @php
                                $isBlind = Request::get('is_blind') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="is_blind" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($isBlind < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($isBlind == 0) selected @endif>공개
                                    </option>
                                    <option value="1" @if ($isBlind == 1) selected @endif>비공개
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
                        </div>

                    </form>

                    <form id="orderUpdate" action="{{ route('admin.banner.order.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_data" id="order_data" value="" />
                    </form>
                    <div class="d-flex justify-content-end mb-10">
                        <button type="submit" onclick="orderUpdate()"
                            class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical" target="_blank">
                            순서 저장</button>
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
                                    <th class="text-center">노출순서</th>
                                    <th class="text-center min-w-250px">배너명</th>
                                    <th class="text-center">공개 여부</th>
                                    <th class="text-center">작성일</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $banner)
                                    <tr>
                                        {{-- 배너관리 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $banner->id }}</span>
                                        </td>

                                        <td class="text-center">
                                            <input class="fw-bold fs-5 w-100px max-w-300px text-center setorder"
                                                type="text" name="setorder" id="setorder_{{ $banner->id }}"
                                                value="{{ $banner->order }}">
                                            <input class="setid" type="hidden" name="setid"
                                                id="setid_{{ $banner->id }}" value="{{ $banner->id }}">
                                        </td>

                                        {{-- 배너 제목 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.banner.detail.view', [$banner->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $banner->name }}</a>
                                        </td>

                                        {{-- 상태 --}}
                                        <td class="text-center">
                                            {{-- 상태 뱃지 --}}
                                            @if ($banner->is_blind == 0)
                                                <div class="badge badge-light-success">
                                                    공개
                                                </div>
                                            @else
                                                <div class="badge badge-light-danger">
                                                    비공개
                                                </div>
                                            @endif
                                        </td>

                                        {{-- 작성일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($banner->created_at)->format('Y.m.d') }}
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
                                                    <form action="{{ route('admin.banner.state.update') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $banner->id }}" />
                                                        <input type="hidden" name="is_blind"
                                                            value="{{ $banner->is_blind }}" />
                                                        <a href="#" onclick="parentNode.submit();"
                                                            class="menu-link px-3">
                                                            @if ($banner->is_blind == 0)
                                                                비공개
                                                            @elseif ($banner->is_blind == 1)
                                                                공개
                                                            @endif
                                                        </a>
                                                    </form>
                                                </div>

                                                {{-- 삭제 --}}
                                                <div class="menu-item px-3">
                                                    <form id="deletebanner{{ $banner->id }}"
                                                        action="{{ route('admin.banner.delete') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $banner->id }}" />
                                                    </form>
                                                    <a href="javascript:deleteAlert({{ $banner->id }});"
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
            initDaterangepicker3();

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

                var confrim = false;

                $('.setid').each(function(index) {
                    var id = $(this).val();
                    var value = $('#setorder_' + id).val();

                    // 중복된 값인지 확인
                    if (values.indexOf(value) !== -1) {
                        confrim = false;
                        return;
                    } else {
                        confrim = true;
                        values.push(value);
                        data[id] = value;
                    }
                });

                console.log(data);

                if(confrim){
                    $('#order_data').val(JSON.stringify(data));
                    $('#orderUpdate').submit();
                }else {
                    alert('중복된 순서가 있습니다.');
                }
            }
        </script>
</x-admin-layout>
