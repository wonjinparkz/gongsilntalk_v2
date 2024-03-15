<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'커뮤니티 상세'">
            {{-- FORM START  --}}
            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 제목 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">제목</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {{ $result->title }}
                        </span>
                    </div>
                </div>

                {{-- 작성자 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">작성자</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {{ $result->author_nickname }}
                        </span>
                    </div>
                </div>


                {{-- 업로드 이미지 미리보기 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">대표 이미지</label>
                    <div class="x_scroll_img_reg col-lg-8">
                        <ul class="img_reg_ul" id="image_reg">
                            @foreach ($result->images as $image)
                                <div class="symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px">
                                    <a class="col symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px"
                                        data-fslightbox="lightbox-basic"
                                        href="{{ Storage::url('image/' . $image->path) }}">
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px w-175px"
                                            style="background-image:url({{ Storage::url('image/' . $image->path) }})">
                                        </div>
                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"><i
                                                class="bi bi-eye-fill text-white fs-3x"></i></div>
                                    </a>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- 업로드 이미지 미리보기 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">상세 이미지</label>
                    <div class="x_scroll_img_reg col-lg-8">
                        <ul class="img_reg_ul" id="image_reg">
                            @foreach ($result->images_detail as $image)
                                <div class="symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px">
                                    <a class="col symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px"
                                        data-fslightbox="lightbox-basic"
                                        href="{{ Storage::url('image/' . $image->path) }}">
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px w-175px"
                                            style="background-image:url({{ Storage::url('image/' . $image->path) }})">
                                        </div>
                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"><i
                                                class="bi bi-eye-fill text-white fs-3x"></i></div>
                                    </a>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- 내용 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">내용</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {!! nl2br($result->content) !!}
                        </span>
                    </div>
                </div>

                {{-- 작성일 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">작성일</label>

                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            @inject('carbon', 'Carbon\Carbon')
                            {{ $carbon::parse($result->created_at)->format('Y년 m월 d일 H:m') }}
                        </span>
                    </div>
                </div>

                {{-- 조회수 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">조회수</label>

                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {{ $result->view_count }}
                        </span>
                    </div>
                </div>

                {{-- 추천수 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">추천수</label>

                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {{ $result->like_count }}
                        </span>
                    </div>
                </div>

            </div>
            <!--내용 END-->

        </x-screen-card>

        <x-screen-card :title="'댓글'">
            <form class="form card-body row border-top p-9 align-items-center" method="GET"
                action="{{ route('admin.community.detail.view', $result->id) }}">
                @csrf
                {{-- 제목 --}}
                <div class="col-lg-6 row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">댓글 내용</label>
                    <div class="col-lg-8 fv-row">
                        <input type="text" id="content" name="content" class="form-control form-control-solid"
                            placeholder="내용" value="{{ Request::get('content') }}" />
                    </div>
                </div>

                {{-- 작성일 --}}
                <div class="col-lg-6 row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">등록일</label>
                    <div class="col-lg-8 fv-row">
                        {{-- 데이트 피커 --}}
                        <input class="form-control form-control-solid" placeholder="등록일 검색" id="daterangepicker" />
                        {{-- 검색 시작일 --}}
                        <input type="hidden" id="from_created_at" name="from_created_at"
                            value="{{ Request::get('from_created_at') }}">
                        {{-- 검색 종료일 --}}
                        <input type="hidden" id="to_created_at" name="to_created_at"
                            value="{{ Request::get('to_created_at') }}">
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
                            <th class="text-center">댓글 작성자</th>
                            <th class="text-center min-w-250px">내용</th>
                            <th class="text-center">좋아요수</th>
                            <th class="text-center">차단수</th>
                            <th class="text-center">신고수</th>
                            <th class="text-center">상태</th>
                            <th class="text-center">삭제여부</th>
                            <th class="text-center">작성일</th>
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
                                    <span class="fw-bold fs-5">{{ $reply->author_name }}</span>
                                </td>

                                {{-- 댓글 내용 --}}
                                <td class="text-center">
                                    <span class="fw-bold fs-5">{{ $reply->content }}</span>
                                </td>

                                {{-- 커뮤니티 좋아요수 --}}
                                <td class="text-center">
                                    <span class="fw-bold fs-5">{{ $reply->like_count }}</span>
                                </td>

                                {{-- 커뮤니티 차단수 --}}
                                <td class="text-center">
                                    <span class="fw-bold fs-5">{{ $reply->block_count }}</span>
                                </td>

                                {{-- 커뮤니티 신고수 --}}
                                <td class="text-center">
                                    <span class="fw-bold fs-5">{{ $reply->report_count }}</span>
                                </td>


                                {{-- 상태 --}}
                                <td class="text-center">
                                    {{-- 상태 뱃지 --}}
                                    @if ($reply->state == 0)
                                        <div class="badge badge-light-success">
                                            공개
                                        </div>
                                    @else
                                        <div class="badge badge-light-danger">
                                            비공개
                                        </div>
                                    @endif
                                </td>

                                {{-- 삭제 여부 --}}
                                <td class="text-center">
                                    @if ($reply->delete == 1)
                                        <div class="badge badge-light-danger">
                                            삭제
                                        </div>
                                    @endif
                                </td>

                                {{-- 작성일 --}}
                                <td class="text-center">
                                    <span class="fw-bold fs-5">
                                        @inject('carbon', 'Carbon\Carbon')
                                        {{ $carbon::parse($reply->created_at)->format('Y년 m월 d일 H:i:s') }}
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
                                            <form action="{{ route('admin.community.reply.update.state') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $reply->id }}" />
                                                <input type="hidden" name="state" value="{{ $reply->state }}" />
                                                <a href="#" onclick="parentNode.submit();"
                                                    class="menu-link px-3">
                                                    @if ($reply->state == 0)
                                                        비공개
                                                    @elseif ($reply->state == 1)
                                                        공개
                                                    @endif
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                {{-- 더보기 --}}
                                <td class="text-center">
                                    <button id="toggle_button_1" type="button" onclick="toggleReply('1');"
                                        class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px active">
                                        <i class="fs-3 m-0 fa-solid fa-plus"></i>
                                    </button>
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
                                        <span class="fw-bold fs-5">{{ $rereply->author_name }}</span>
                                    </td>
                                    {{-- 댓글 내용 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5">{{ $rereply->content }}</span>
                                    </td>

                                    {{-- 커뮤니티 좋아요수 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5">{{ $rereply->like_count }}</span>
                                    </td>

                                    {{-- 커뮤니티 차단수 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5">{{ $rereply->block_count }}</span>
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

                                    {{-- 삭제 여부 --}}
                                    <td class="text-center">
                                        @if ($rereply->delete == 1)
                                            <div class="badge badge-light-danger">
                                                삭제
                                            </div>
                                        @endif
                                    </td>

                                    {{-- 작성일 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5">
                                            @inject('carbon', 'Carbon\Carbon')
                                            {{ $carbon::parse($rereply->created_at)->format('Y년 m월 d일 H:i:s') }}
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
                                                <form action="{{ route('admin.community.reply.update.state') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $rereply->id }}" />
                                                    <input type="hidden" name="state"
                                                        value="{{ $rereply->state }}" />
                                                    <a href="#" onclick="parentNode.submit();"
                                                        class="menu-link px-3">
                                                        @if ($rereply->state == 0)
                                                            비공개
                                                        @elseif ($rereply->state == 1)
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
        </x-screen-card>

    </div>

    {{--
           * 페이지에서 사용하는 자바스크립트
        --}}
    <script>
        var hostUrl = "assets/";

        initDaterangepicker();

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
</x-admin-layout>
