<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">커뮤니티 관리
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
                        action="{{ route('admin.community.list.view') }}">
                        @csrf


                        {{-- 제목 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">제목</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="title" name="title"
                                    class="form-control form-control-solid" placeholder="제목 + 내용"
                                    value="{{ Request::get('title') }}" />
                            </div>
                        </div>

                        {{-- 작성일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">작성일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'작성일을 선택해주세요.'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>


                        {{-- 작성자 닉네임 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">작성자 닉네임</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="author_nickname" name="author_nickname"
                                    class="form-control form-control-solid" placeholder="닉네임을 입력해주세요."
                                    value="{{ Request::get('author_nickname') }}" />
                            </div>
                        </div>


                        {{-- 카테고리 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">카테고리</label>
                            <div class="col-lg-8 fv-row">

                                @php
                                    $selectedCategory = Request::get('category') ?? [];
                                @endphp
                                <select name="category[]"class="form-select form-select-solid" data-control="select2"
                                    data-close-on-select="false" data-placeholder="카테고리를 선택해주세요."
                                    data-allow-clear="true" multiple="multiple">
                                    @for ($i = 0; $i < count(Lang::get('commons.community_category')); $i++)
                                        <option value="{{ $i }}"
                                            @if (in_array($i, $selectedCategory)) selected @endif>
                                            {{ Lang::get('commons.community_category.' . $i) }}</option>
                                    @endfor
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
                                    <th class="text-center w-250px">제목</th>
                                    <th class="text-center">작성자 닉네임</th>
                                    <th class="text-center">추천수</th>
                                    <th class="text-center">조회수</th>
                                    <th class="text-center">공개 여부</th>
                                    <th class="text-center">등록일</th>
                                    <th class="text-center">동작</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $community)
                                    <tr>
                                        {{-- 커뮤니티 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $community->id }}</span>
                                        </td>

                                        {{-- 커뮤니티 제목 --}}
                                        <td class="text-center ">
                                            <a href="{{ route('admin.community.detail.view', [$community->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold ">{{ $community->title }}</a>
                                        </td>

                                        {{-- 커뮤니티 작성자 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $community->author_nickname }}</span>
                                        </td>

                                        {{-- 커뮤니티 좋아요수 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $community->like_count }}</span>
                                        </td>

                                        {{-- 커뮤니티 조회수 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $community->view_count }}</span>
                                        </td>

                                        {{-- 상태 --}}
                                        <td class="text-center">
                                            {{-- 상태 뱃지 --}}
                                            @if ($community->is_blind == 0)
                                                <div class="badge badge-light-success">
                                                    공개
                                                </div>
                                            @else
                                                <div class="badge badge-light-danger">
                                                    비공개
                                                </div>
                                            @endif
                                        </td>

                                        {{-- 등록일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($community->created_at)->format('Y년 m월 d일') }}
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
                                                    <form action="{{ route('admin.community.update.state') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id"
                                                            value="{{ $community->id }}" />
                                                        <input type="hidden" name="is_blind"
                                                            value="{{ $community->is_blind }}" />
                                                        <a href="#" onclick="parentNode.submit();"
                                                            class="menu-link px-3">
                                                            @if ($community->is_blind == 0)
                                                                비공개
                                                            @elseif ($community->is_blind == 1)
                                                                공개
                                                            @endif
                                                        </a>
                                                    </form>
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
