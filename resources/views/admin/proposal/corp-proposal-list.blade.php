<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">기업 이전 제안서
                        관리
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
                        action="{{ route('admin.corp.proposal.list.view') }}">
                        @csrf

                        {{-- 일반 회원 이름 또는 중개사무소 명 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">일반 회원 이름 또는 중개사무소 명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-solid" placeholder="검색어를 입력해 주세요."
                                    value="{{ Request::get('name') }}" />
                            </div>
                        </div>

                        {{-- 일반 회원 연락처 또는 중개사 회원 담당자 연락처 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">일반 회원 연락처 또는 중개사 회원 담당자 연락처</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="phone" name="phone"
                                    class="form-control form-control-solid" placeholder="검색어를 입력해 주세요."
                                    value="{{ Request::get('phone') }}" />
                            </div>
                        </div>

                        {{-- 회원 유형 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">회원 유형</label>
                            @php
                                $isBlind = Request::get('member_type') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="member_type" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($isBlind < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($isBlind == 0) selected @endif>일반 회원
                                    </option>
                                    <option value="1" @if ($isBlind == 1) selected @endif>중개사 회원
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

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn me-10 col-lg-1 btn-primary">검색</button>
                        </div>

                        <div class="d-flex justify-content-end mt-10">
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical"
                                href="{{ route('admin.corp.proposal.export', Request::all()) }}" target="_blank">
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
                        <table id="proposal_table"
                            class="table align-middle table-bordered table-row-dashed table-hover fs-6 gy-5">
                            {{-- 테이블 헤더 --}}
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fl-7 text-uppercase gs-0">
                                    <th class="text-center w-20px">No.</th>
                                    <th class="text-center">일반 회원 이름<br>또는 중개사무소 명</th>
                                    <th class="text-center">일반 회원 연락처<br>또는 중개사무소 연락처</th>
                                    <th class="text-center w-200px">제안서 명</th>
                                    <th class="text-center">희망면적</th>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">예산</th>
                                    <th class="text-center">회원 유형</th>
                                    <th class="text-center">받은 제안서 개수</th>
                                    <th class="text-center">등록일</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $proposal)
                                    <tr>
                                        {{-- 매물 제안서 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $proposal->id }}</span>
                                        </td>

                                        {{-- 일반 회원 이름 또는 중개사무소 명 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $proposal->users->type == 0 ? $proposal->users->name : $proposal->users->company_name }}
                                            </span>
                                        </td>

                                        {{-- 일반 회원 연락처 또는 중개사무소 연락처 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $proposal->users->phone }}
                                            </span>
                                        </td>

                                        {{-- 제안서 명 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.corp.proposal.detail.view', [$proposal->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                {{ $proposal->title }}
                                            </a>
                                        </td>



                                        {{-- 희망면적 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $proposal->area }}
                                            </span>
                                        </td>

                                        {{-- ID --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $proposal->users->email }}
                                            </span>
                                        </td>

                                        {{-- 예산 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $proposal->payment_type == 0 ? '매매 ' . Commons::get_priceTrans($proposal->price) : '월세 ' . Commons::get_priceTrans($proposal->price) . '/' . Commons::get_priceTrans($proposal->month_price) }}
                                            </span>
                                        </td>

                                        {{-- 회원 유형 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $proposal->users->type == 0 ? '일반 회원' : '중개사 회원' }}
                                            </span>
                                        </td>

                                        {{-- 받은 제안서 개수 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ count($proposal->products) }}
                                            </span>
                                        </td>

                                        {{-- 등록일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($proposal->created_at)->format('Y.m.d') }}
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

        $("#proposal_table").DataTable({
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
                    $('#deleteproposal' + id).submit();
                }
            });
        }
    </script>
</x-admin-layout>
