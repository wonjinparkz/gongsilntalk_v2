<x-admin-layout>
    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">
                        게시글 신고 관리
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
                        action="{{ route('admin.report.community.list.view') }}">
                        @csrf
                        {{-- 신고한 회원 닉네임 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">신고한 회원 닉네임</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="author_nickname" name="author_nickname"
                                    class="form-control form-control-solid" placeholder="닉네임을 입력해주세요."
                                    value="{{ Request::get('author_nickname') }}" />
                            </div>
                        </div>

                        {{-- 신고대상 회원 닉네임 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">신고대상 회원 닉네임</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="report_nickname" name="report_nickname"
                                    class="form-control form-control-solid" placeholder="닉네임을 입력해주세요."
                                    value="{{ Request::get('report_nickname') }}" />
                            </div>
                        </div>

                        @php
                            $report_type = Request::get('report_type') ?? '-1';
                        @endphp
                        {{-- 신고 유형 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">신고 유형</label>
                            <div class="col-lg-8 fv-row">
                                <select id="report_type" name="report_type" class="form-select form-select-solid"
                                    data-control="select2" data-hide-search="true">
                                    <option value="-1" @if ('-1' == $report_type) selected @endif>전체</option>
                                    @for ($i = 0; $i < count(Lang::get('commons.report_type')); $i++)
                                        <option value="{{ $i }}"
                                            @if ($i == $report_type) selected @endif>
                                            {{ Lang::get('commons.report_type.' . $i) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        {{-- 신고일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">신고일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'신고일을 선택해주세요.'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
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
                                    <th class="text-center">신고한 회원유형</th>
                                    <th class="text-center">신고한 회원 닉네임</th>
                                    <th class="text-center">신고 대상 회원유형</th>
                                    <th class="text-center">신고 대상 닉네임</th>
                                    <th class="text-center">신고 유형</th>
                                    <th class="text-center min-w-250px">신고사유</th>
                                    <th class="text-center">신고일</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $report)
                                    <tr>
                                        {{-- 게시글 신고 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $report->id }}</span>
                                        </td>

                                        {{-- 신고한 회원유형 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $report->author_type == 0 ? '일반 회원' : '중개사 회원' }}
                                            </span>
                                        </td>

                                        {{-- 신고한 회원 닉네임 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $report->author_nickname }}
                                            </span>
                                        </td>

                                        {{-- 신고 대상 회원유형 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $report->community->users->type == 0 ? '일반 회원' : '중개사 회원' }}
                                            </span>
                                        </td>

                                        {{-- 신고 대상 닉네임 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $report->community->users->nickname }}
                                            </span>
                                        </td>

                                        {{-- 신고 유형 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ Lang::get('commons.report_type.' . $report->type) }}
                                            </span>
                                        </td>

                                        {{-- 신고 유형 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $report->reason }}
                                            </span>
                                        </td>

                                        {{-- 작성일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($report->created_at)->format('Y.m.d') }}
                                            </span>
                                        </td>

                                        {{-- 게시 상태 --}}
                                        <td class="text-center">
                                            @if ($report->community->is_delete == 0)
                                                <a href="{{ route('admin.community.detail.view', [$report->target_id]) }}"
                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold">
                                                    원글보기
                                                </a>
                                            @else
                                                <div class="badge badge-light-warning">
                                                    삭제
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
    </script>
</x-admin-layout>
