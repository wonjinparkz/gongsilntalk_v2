@props([
    'result' => [],
    'replys' => [],
    'route' => 'admin.magazine.detail.view',
])

<form class="form card-body row border-top p-9 align-items-center" method="GET"
    action="{{ route($route, $result->id) }}">
    @csrf

    {{-- 작성자 닉네임 --}}
    <div class="col-lg-12 row mb-6">
        <label class="col-lg-2 col-form-label fw-semibold fs-6">작성자 닉네임</label>
        <div class="col-lg-8 fv-row">
            <input type="text" id="author_nickname" name="author_nickname" class="form-control form-control-solid"
                placeholder="작성자 닉네임을 입력해주세요." value="{{ Request::get('author_nickname') }}" />
        </div>
    </div>

    {{-- 정렬 기준 --}}
    <div class="col-lg-12 row mb-6">
        <label class="col-lg-2 col-form-label fw-semibold fs-6">정렬 기준</label>
        <div class="col-lg-3 fv-row">
            @php
                $orderBy = Request::get('orderBy') ?? -1;
            @endphp
            <select name="orderBy" class="form-select form-select-solid" data-control="select2" data-hide-search="true">
                <option value="-1" @if ($orderBy < 0) selected @endif>등록일 내림차순
                </option>
                <option value="1" @if ($orderBy == 1) selected @endif>신고수 많은 순
                </option>
            </select>
        </div>
    </div>

    {{-- 회원 유형 --}}
    <div class="col-lg-12 row mb-6">
        <label class="col-lg-2 col-form-label fw-semibold fs-6">회원 유형</label>
        <div class="col-lg-3 fv-row">
            @php
                $member_type = Request::get('member_type') ?? -1;
            @endphp
            <select name="member_type" class="form-select form-select-solid" data-control="select2"
                data-hide-search="true">
                <option value="-1" @if ($member_type < 0) selected @endif>전체
                </option>
                <option value="0" @if ($member_type == 0) selected @endif>일반 회원
                </option>
                <option value="1" @if ($member_type == 1) selected @endif>중개사 회원
                </option>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-10">
        <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
    </div>

</form>

{{ $replys->links('components.pagination-info') }}
{{-- 데이터 내용 --}}
<div class="card-body pt-0 table-responsive">
    {{-- 테이블 --}}
    <table id="notice_table" class="table align-middle table-row-dashed fs-6 gy-4">
        {{-- 테이블 헤더 --}}
        <thead>
            <tr class="text-start text-gray-400 fw-bold fl-7 text-uppercase gs-0">
                <th class="text-center w-20px">No.</th>
                <th class="text-center">회원 유형</th>
                <th class="text-center">닉네임</th>
                <th class="text-center min-w-250px">댓글 내용</th>
                <th class="text-center">신고수</th>
                <th class="text-center">공개 여부</th>
                <th class="text-center">등록일</th>
                <th class="text-center">동작</th>
                <th class="text-center"></th>
            </tr>
        </thead>

        {{-- 테이블 내용 --}}
        <tbody class="fw-semibold text-gray-600">
            @foreach ($replys as $reply)
                <tr>
                    {{-- 댓글 번호 --}}
                    <td class="text-center">
                        <span class="fw-bold fs-5">{{ $reply->id }}</span>
                    </td>

                    {{-- 댓글 작성자 --}}
                    <td class="text-center">
                        <span class="fw-bold fs-5">{{ $reply->author_type == 0 ? '일반 회원' : '중개사 회원' }}</span>
                    </td>

                    {{-- 댓글 작성자 --}}
                    <td class="text-center">
                        <span class="fw-bold fs-5">{{ $reply->author_name }}</span>
                    </td>

                    {{-- 댓글 내용 --}}
                    <td class="text-center">
                        <span class="fw-bold fs-5">{{ $reply->content }}</span>
                    </td>

                    {{-- 커뮤니티 신고수 --}}
                    <td class="text-center">
                        <span class="fw-bold fs-5">{{ $reply->report_count }}</span>
                    </td>


                    {{-- 상태 --}}
                    <td class="text-center">
                        {{-- 상태 뱃지 --}}
                        @if ($reply->is_blind == 0)
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
                            {{ $carbon::parse($reply->created_at)->format('Y년 m월 d일') }}
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
                                <form action="{{ route('admin.community.reply.update.state') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $reply->id }}" />
                                    <input type="hidden" name="is_blind" value="{{ $reply->is_blind }}" />
                                    <a href="#" onclick="parentNode.submit();" class="menu-link px-3">
                                        @if ($reply->is_blind == 0)
                                            비공개
                                        @elseif ($reply->is_blind == 1)
                                            공개
                                        @endif
                                    </a>
                                </form>
                            </div>
                        </div>
                    </td>

                    {{-- 더보기 --}}
                    <td class="text-center">
                        @if (count($reply->rereplies) > 0)
                            <button id="toggle_button_{{ $reply->id }}" type="button"
                                onclick="toggleReply('{{ $reply->id }}');"
                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px active">
                                <i class="fs-3 m-0 fa-solid fa-plus"></i>
                            </button>
                        @endif
                    </td>

                </tr>

                @foreach ($reply->rereplies as $rereply)
                    <tr class="reply_{{ $reply->id }} collapse hide">
                        {{-- 대댓글 표시 --}}
                        <td class="text-center">
                            <i class="fa-solid fa-reply fa-rotate-180"></i>
                        </td>
                        {{-- 댓글 작성자 --}}
                        <td class="text-center">
                            <span class="fw-bold fs-5">{{ $rereply->author_type == 0 ? '일반 회원' : '중개사 회원' }}</span>
                        </td>

                        {{-- 댓글 작성자 --}}
                        <td class="text-center">
                            <span class="fw-bold fs-5">{{ $rereply->author_name }}</span>
                        </td>

                        {{-- 댓글 내용 --}}
                        <td class="text-center">
                            <span class="fw-bold fs-5">{{ $rereply->content }}</span>
                        </td>

                        {{-- 커뮤니티 신고수 --}}
                        <td class="text-center">
                            <span class="fw-bold fs-5">{{ $rereply->report_count }}</span>
                        </td>

                        {{-- 상태 --}}
                        <td class="text-center">
                            {{-- 상태 뱃지 --}}

                            @if ($rereply->state == 0)
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
                                {{ $carbon::parse($rereply->created_at)->format('Y년 m월 d일') }}
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
                                    <form action="{{ route('admin.community.reply.update.state') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $rereply->id }}" />
                                        <input type="hidden" name="state" value="{{ $rereply->state }}" />
                                        <a href="#" onclick="parentNode.submit();" class="menu-link px-3">
                                            @if ($rereply->is_blind == 0)
                                                비공개
                                            @elseif ($rereply->is_blind == 1)
                                                공개
                                            @endif
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach


        </tbody>
    </table>

</div>
{{ $replys->onEachSide(1)->links('components.pagination') }}

<script>
    // 대댓글 열기
    function toggleReply(id) {

        var reply = $(".reply_" + id);
        var toggleButton = $("#toggle_button_" + id);
        if (reply.hasClass('collapse show')) {
            reply.collapse('hide');
            toggleButton.html('<i class="fs-3 m-0 fa-solid fa-plus"></i>');
        } else {
            reply.collapse('show');
            toggleButton.html('<i class="fs-3 m-0 fa-solid fa-minus"></i>');
        }

    }
</script>
