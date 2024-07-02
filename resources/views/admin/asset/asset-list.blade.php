<x-admin-layout>
    <form action="{{ route('admin.user.state.update') }}" method="POST" id="stateUpdate">
        <input type="hidden" name="id" id="form_id" value="" />
        <input type="hidden" name="state" id="form_state" value="" />
    </form>
    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">일반 회원
                        자산관리
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
                        action="{{ route('admin.user.list.view') }}">
                        @csrf

                        {{-- 회원명으로 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">회원명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="user_name" name="user_name"
                                    class="form-control form-control-solid" placeholder="회원명을 입력해주세요."
                                    value="{{ Request::get('user_name') }}" />
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
                        {{-- <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">공개여부</label>
                            @php
                                $is_blind = Request::get('is_blind') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="is_blind" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($is_blind < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($is_blind == 0) selected @endif>공개
                                    </option>
                                    <option value="1" @if ($is_blind == 1) selected @endif>비공개
                                    </option>
                                </select>
                            </div>
                        </div> --}}

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn me-10 col-lg-1 btn-primary">검색</button>
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
                                    <th class="text-center">회원 ID</th>
                                    <th class="text-center">회원 이름</th>
                                    <th class="text-center">총 자산 현황</th>
                                    <th class="text-center">연락처</th>
                                    <th class="text-center">등록한 자산 개수</th>
                                    <th class="text-center">최근 등록일</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $user)
                                    <tr>
                                        {{-- 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $user->id }}</span>
                                        </td>

                                        {{-- 회원 아이디 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.asset.detail.view', [$user->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $user->email }}</a>
                                        </td>

                                        {{-- 회원 이름 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $user->name }}</span>
                                        </td>

                                        {{-- 총 자산 현황 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ number_format($user->total_price) }}</span>
                                        </td>

                                        {{-- 회원 연락처 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $user->phone }}</span>
                                        </td>

                                        {{-- 등록한 자산 개수 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $user->total_count }}</span>
                                        </td>

                                        {{-- 최근 등록일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($user->created_at)->format('Y.m.d') }}
                                            </span>
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


        // 승인 물음
        function stateAlert(type, id, state) {
            console.log('확인', type);
            switch (type) {
                case "1":
                    text = "선택하신 회원을 이용정지 하시겠습니까?";
                    break;
                case "2":
                    text = "선택하신 회원과 계약해지 하시겠습니까?";
                    break;
                case "3":
                    text = "선택하신 회원을\n이용정지 해체 하시겠습까?";
                    break;
                case "4":
                    text = "선택하신 회원과 재계약 하시겠습니까?";
                    break;
                default:
                    text = "";
                    break;
            }

            Swal.fire({
                html: text,
                dangerMode: false,
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonText: "취소",
                confirmButtonText: "확인",
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-secondary"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    $('#form_id').val(id);
                    $('#form_state').val(state);
                    $('#stateUpdate').submit();
                }
            });
        }
    </script>
</x-admin-layout>
