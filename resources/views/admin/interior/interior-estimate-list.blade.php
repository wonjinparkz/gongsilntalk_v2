<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">인테리어 견적
                        받기 관리
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
                        action="{{ route('admin.interior.estimate.list.view') }}">
                        @csrf

                        {{-- 제목 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">회사명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="company_name" name="company_name"
                                    class="form-control form-control-solid" placeholder="검색어 입력"
                                    value="{{ Request::get('company_name') }}" />
                            </div>
                        </div>

                        {{-- 작성일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">작성일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'작성일 검색'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>


                        {{-- 카테고리 선택 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">인테리어 상담</label>
                            @php
                                $type = Request::get('type') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="type" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($type < 0) selected @endif>전체
                                    </option>
                                    @foreach (Lang::get('commons.interior_type') as $index => $interior)
                                        <option value="{{ $index }}"
                                            @if ($type == $index) selected @endif>
                                            {{ $interior }}
                                        </option>
                                    @endforeach

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
                                    <th class="text-center">인테리어 상담</th>
                                    <th class="text-center">회사명</th>
                                    <th class="text-center">연락처</th>
                                    <th class="text-center">담당자 성함</th>
                                    <th class="text-center">면적</th>
                                    <th class="text-center">사용 인원</th>
                                    <th class="text-center">입주 예정 지역</th>
                                    <th class="text-center">입주 예정일</th>
                                    <th class="text-center">등록일</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $interior)
                                    <tr>
                                        {{-- 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $interior->id }}</span>
                                        </td>

                                        {{-- 인테리어 상담 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                |
                                                @foreach ($interior->types as $types)
                                                    {{ Lang::get('commons.interior_type.' . $types->type) }} |
                                                @endforeach
                                            </span>
                                        </td>

                                        {{-- 회사명 --}}
                                        <td class="text-center">
                                            <div class="d-inline-block align-items-center text-truncate"
                                                style="max-width: 250px;">
                                                <a href="{{ route('admin.interior.estimate.detail.view', [$interior->id]) }}"
                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $interior->company_name }}</a>
                                            </div>
                                        </td>

                                        {{-- 연락처 --}}
                                        <td class="text-center">
                                            {{-- 상태 뱃지 --}}
                                            <span class="fw-bold fs-5">
                                                {{ $interior->company_phone }}
                                            </span>
                                        </td>

                                        {{-- 담당자 성함 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $interior->user_name }}</span>
                                        </td>

                                        {{-- 면적 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $interior->area }}평</span>
                                        </td>

                                        {{-- 사용인원 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $interior->users_count }}명</span>
                                        </td>

                                        {{-- 입주 예정 지역 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $interior->place }}</span>
                                        </td>

                                        {{-- 입주 예정일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $interior->move_date }}</span>
                                        </td>

                                        {{-- 작성일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($interior->created_at)->format('Y년 m월 d일') }}
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
