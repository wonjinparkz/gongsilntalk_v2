<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">1:1 문의 관리
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
                        action="{{ route('admin.qa.list.view') }}">
                        @csrf

                        {{-- 제목 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">1:1 문의 제목</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="title" name="title"
                                    class="form-control form-control-solid" placeholder="제목 + 내용"
                                    value="{{ Request::get('title') }}" />
                            </div>
                        </div>

                        {{-- 작성일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">1:1 문의 작성일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'작성일 검색'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>


                        {{-- 답변 상태 선택 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">1:1 답변 상태</label>
                            @php
                                $isReply = Request::get('is_reply') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="is_reply" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($isReply < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($isReply == 0) selected @endif>미답변
                                    </option>
                                    <option value="1" @if ($isReply == 1) selected @endif>답변 완료
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- 카테고리 선택 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">1:1 답변 카테고리</label>
                            @php
                                $category = Request::get('category') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="category" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($category < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($category == 0) selected @endif>신고
                                    </option>
                                    <option value="1" @if ($category == 1) selected @endif>건의
                                    </option>
                                    <option value="2" @if ($category == 2) selected @endif>기타
                                    </option>
                                </select>
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
                                    <th class="text-center min-w-250px">제목</th>
                                    <th class="text-center">카테고리</th>
                                    <th class="text-center">문의회원</th>
                                    <th class="text-center">답변 여부</th>
                                    <th class="text-center">작성일</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $qa)
                                    <tr>
                                        {{-- 1:1 문의 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $qa->id }}</span>
                                        </td>

                                        {{-- 1:1 문의 제목 --}}
                                        <td class="text-center">
                                            <div class="d-inline-block align-items-center text-truncate" style="max-width: 250px;">
                                                <a href="{{ route('admin.qa.detail.view', [$qa->id]) }}"
                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $qa->title }}</a>
                                                @if ($qa->images != null && count($qa->images) > 0)
                                                    <div class="ms-2 badge badge-light-success">
                                                        이미지 {{ count($qa->images) }} 개
                                                    </div>
                                                @endif
                                            </div>
                                        </td>

                                        {{-- 카테고리 --}}
                                        <td class="text-center">
                                            {{-- 상태 뱃지 --}}
                                            <span class="fw-bold fs-5">
                                            @if ($qa->category == 0)
                                                신고
                                            @elseif ($qa->category == 1)
                                                건의
                                            @else
                                                기타
                                            @endif
                                            </span>
                                        </td>

                                        {{-- 작성자 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $qa->users->name }}</span>
                                        </td>

                                        {{-- 답변 여부 --}}
                                        <td class="text-center">
                                            {{-- 상태 뱃지 --}}
                                            @if ($qa->is_reply == 0)
                                                <div class="badge badge-light-danger">
                                                    미답변
                                                </div>
                                            @else
                                                <div class="badge badge-light-success">
                                                    답변완료
                                                </div>
                                            @endif
                                        </td>

                                        {{-- 작성일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($qa->created_at)->format('Y년 m월 d일 H:i:s') }}
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


    {{--
    * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var hostUrl = "assets/";

        // 날짜 검색이 있을 경우 추가
        initDaterangepicker();
    </script>
</x-admin-layout>
