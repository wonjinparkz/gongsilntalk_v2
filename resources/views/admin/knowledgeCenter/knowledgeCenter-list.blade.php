<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">지식산업센터
                        관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />

                </div>
                {{-- 페이지 버튼 --}}
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.knowledgeCenter.create.view') }}" class="btn btn-lm fw-bold btn-primary">등록</a>
                </div>
            </div>
        </div>

        {{-- 메인 내용 --}}
        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">

                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.knowledgeCenter.list.view') }}">
                        @csrf

                        {{-- 이름으로 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">이름</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="name" name="name"
                                    class="form-control form-control-solid" placeholder="이름을 입력해 주세요."
                                    value="{{ Request::get('name') }}" />
                            </div>
                        </div>

                        {{-- 전화번호 검색 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">전화번호</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="phone" name="phone"
                                    class="form-control form-control-solid" placeholder="전화번호를 입력해 주세요."
                                    value="{{ Request::get('phone') }}" />
                            </div>
                        </div>

                        {{-- 회원 가입일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">회원 가입일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'가입일을 선택해 주세요.'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>

                        {{-- 상태 선택 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">회원 상태</label>
                            @php
                                $state = Request::get('state') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="state" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($state < 0) selected @endif>전체
                                    </option>
                                    <option value="0" @if ($state == 0) selected @endif>이용중
                                    </option>
                                    <option value="1" @if ($state == 1) selected @endif>이용정지
                                    </option>
                                    <option value="2" @if ($state == 2) selected @endif>회원탈퇴
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- 유형 선택 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">회원 유형</label>
                            @php
                                $provider = Request::get('provider') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="provider" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($provider < 0) selected @endif>전체
                                    </option>
                                    <option value="E" @if ($provider == 'E') selected @endif>일반
                                    </option>
                                    <option value="K" @if ($provider == 'K') selected @endif>카카오
                                    </option>
                                    <option value="N" @if ($provider == 'N') selected @endif>네이버
                                    </option>
                                    <option value="A" @if ($provider == 'A') selected @endif>애플
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn me-10 col-lg-1 btn-primary">검색</button>
                        </div>

                        <div class="d-flex justify-content-end mt-10">
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical"
                                href="{{ route('admin.knowledgeCenter.export', Request::all()) }}" target="_blank">
                                엑셀 업로드<br>(데이터 업데이트)</a>
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical"
                                href="{{ route('admin.knowledgeCenter.export', Request::all()) }}" target="_blank">
                                엑셀 다운로드<br>(데이터 업데이트 용)</a>
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical"
                                href="{{ route('admin.knowledgeCenter.export', Request::all()) }}" target="_blank">
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
                                    <th class="text-center">회원상태</th>
                                    <th class="text-center">아이디 (이메일)</th>
                                    <th class="text-center">가입 유형</th>
                                    <th class="text-center">이름</th>
                                    <th class="text-center">가입일</th>
                                    <th class="text-center">최종접속일</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $knowledgeCenter)
                                    <tr>
                                        {{-- 회원 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $knowledgeCenter->id }}</span>
                                        </td>

                                        {{-- 회원상태 --}}
                                        <td class="text-center">
                                            {{-- 상태 뱃지 --}}
                                            @if ($knowledgeCenter->state == 0)
                                                <div class="badge badge-light-success">
                                                    이용중
                                                </div>
                                            @elseif($knowledgeCenter->state == 1)
                                                <div class="badge badge-light-warning">
                                                    이용정지
                                                </div>
                                            @else
                                                <div class="badge badge-light-danger">
                                                    회원탈퇴
                                                </div>
                                            @endif
                                        </td>

                                        {{-- 회원 이메일 --}}
                                        <td class="text-center">
                                            <div class="d-flex align-items-center">
                                                @if ($knowledgeCenter->image_path != null)
                                                    <div class="symbol symbol-30px symbol-circle me-5">
                                                        <img
                                                            src="{{ Storage::url('image/' . $knowledgeCenter->image_path) }}" />
                                                    </div>
                                                @endif
                                                <a href="{{ route('admin.knowledgeCenter.detail.view', [$knowledgeCenter->id]) }}"
                                                    class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $knowledgeCenter->email }}</a>
                                            </div>
                                        </td>

                                        {{-- 회원 가입 유형 --}}
                                        <td class="text-center">
                                            <span
                                                class="fw-bold fs-5">{{ Lang::get('commons.provider.' . $knowledgeCenter->provider) }}</span>
                                        </td>

                                        {{-- 회원 이름 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $knowledgeCenter->name }}</span>
                                        </td>

                                        {{-- 회원 가입일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($knowledgeCenter->created_at)->format('Y년 m월 d일') }}
                                            </span>
                                        </td>

                                        {{-- 회원 최종 접속일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($knowledgeCenter->last_used_at)->format('Y년 m월 d일') }}
                                            </span>
                                        </td>

                                        {{-- 동작 : 수정, 삭제 --}}
                                        <td class="text-center">
                                            {{-- 동작 버튼 --}}
                                            @if ($knowledgeCenter->state != 2)
                                                <a href="#"
                                                    class="btn btn-sm btn-success btn-active-light-primary"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">더보기</a>
                                                {{-- 동작 메뉴 --}}
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    {{-- 수정 --}}
                                                    <div class="menu-item px-3">
                                                        <form
                                                            action="{{ route('admin.knowledgeCenter.state.update') }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id"
                                                                value="{{ $knowledgeCenter->id }}" />
                                                            <input type="hidden" name="state"
                                                                value="{{ $knowledgeCenter->state }}" />
                                                            <a href="#" onclick="parentNode.submit();"
                                                                class="menu-link px-3">
                                                                @if ($knowledgeCenter->state == 0)
                                                                    이용정지
                                                                @elseif ($knowledgeCenter->state == 1)
                                                                    이용중
                                                                @endif
                                                            </a>
                                                        </form>
                                                    </div>
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

        initDaterangepicker();
    </script>
</x-admin-layout>
