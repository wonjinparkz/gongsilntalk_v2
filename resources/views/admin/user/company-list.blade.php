<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">승인 요청
                        중개사
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
                        action="{{ route('admin.company.list.view') }}">
                        @csrf

                        {{-- 이름으로 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">담당자 이름</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-solid" placeholder="이름을 입력해주세요."
                                    value="{{ Request::get('name') }}" />
                            </div>
                        </div>

                        {{-- 전화번호 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">전화번호</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="phone" name="phone"
                                    class="form-control form-control-solid" placeholder="전화번호를 입력해주세요."
                                    value="{{ Request::get('phone') }}" />
                            </div>
                        </div>

                        {{-- 회원 가입일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">회원 가입일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'가입일을 선택해주세요.'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>

                        {{-- 중개사무소명 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">중개사무소명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="company_name" name="company_name"
                                    class="form-control form-control-solid" placeholder="중개사무소명을 입력해주세요."
                                    value="{{ Request::get('company_name') }}" />
                            </div>
                        </div>

                        {{-- 상태 선택 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">승인 상태</label>
                            @php
                                $company_state = Request::get('company_state') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="company_state" class="form-select form-select-solid"
                                    data-control="select2" data-hide-search="true">
                                    <option value="" @if ($company_state < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($company_state == 0) selected @endif>승인요청
                                    </option>
                                    <option value="2" @if ($company_state == 2) selected @endif>반려
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn me-10 col-lg-1 btn-primary">검색</button>
                            <a class="btn btn-lm fw-bold btn-success"
                                href="{{ route('admin.company.export', Request::all()) }}" target="_blank">엑셀
                                다운로드</a>
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
                                    <th class="text-center">승인 상태</th>
                                    <th class="text-center">아이디 (이메일)</th>
                                    <th class="text-center">담당자 이름</th>
                                    <th class="text-center">중개사무소명</th>
                                    <th class="text-center">가입일</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $user)
                                    <tr>
                                        {{-- 회원 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $user->id }}</span>
                                        </td>

                                        {{-- 회원상태 --}}
                                        <td class="text-center">
                                            {{-- 상태 뱃지 --}}
                                            @if ($user->state == 0)
                                                <div class="badge badge-light-success">
                                                    이용중
                                                </div>
                                            @elseif($user->state == 1)
                                                <div class="badge badge-light-warning">
                                                    이용정지
                                                </div>
                                            @elseif($user->state == 2)
                                                <div class="badge badge-light-warning">
                                                    회원탈퇴
                                                </div>
                                            @elseif($user->state == 3)
                                                <div class="badge badge-light-danger">
                                                    계약해지
                                                </div>
                                            @endif
                                        </td>

                                        {{-- 회원 이메일 --}}
                                        <td class="text-center">
                                            <div class="d-flex align-items-center">
                                                @if ($user->image_path != null)
                                                    <div class="symbol symbol-30px symbol-circle me-5">
                                                        <img src="{{ Storage::url('image/' . $user->image_path) }}" />
                                                    </div>
                                                @endif
                                                <a href="{{ route('admin.company.detail.view', [$user->id]) }}"
                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $user->email }}</a>
                                            </div>
                                        </td>

                                        {{-- 회원 이름 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $user->name }}</span>
                                        </td>

                                        {{-- 중개사무소명 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $user->company_name }}</span>
                                        </td>

                                        {{-- 회원 가입일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($user->created_at)->format('Y년 m월 d일') }}
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
    </script>
</x-admin-layout>
