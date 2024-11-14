@props(['replys' => [], 'community_id' => 0, 'replyCount' => 0])

@php
    $nowUser = Auth::guard('web')->user()->id ?? '';
@endphp


<!-- comment : s -->
@inject('carbon', 'Carbon\Carbon')

<div class="comment_total">댓글 {{ $replyCount }}</div>
<ul class="comment_list">
    @foreach ($replys as $reply)
        @if ($reply->block_id == '')
            @if ($reply->is_delete == 0)
                <li>
                    <div class="txt_user">
                        <p>{{ $reply->author_name }}</p>
                        <div class="more_menu_wrap">
                            <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                                    class="menu_more"></button>
                            <div class="more_menu">
                                @if ($nowUser == $reply->author)
                                    {{-- <a href="javascript:(0)">수정</a> --}}
                                    <a href="{{ route('www.reply.delete', ['id' => $reply->id]) }}">삭제</a>
                                @else
                                    <a
                                        onclick="reportReplyIdSetting('{{ $reply->id }}');modal_open('reply_report')">신고</a>
                                    <a href="{{ route('www.reply.block', ['block_reply_id' => $reply->id]) }}">차단</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="comment_con">
                        @php
                            echo $reply->content;
                        @endphp
                    </div>
                    <div class="mt8">
                        <span class="txt_date">{{ $carbon::parse($reply->created_at)->format('Y.m.d H:i') }}</span>
                        <button class="btn_re"
                            onclick="replyInfoSetting('{{ $reply->author_name }}', '{{ $reply->id }}');reg_reply(0)">답글
                            쓰기</button>
                    </div>
                </li>
            @endif
        @endif

        {{-- 밑에는 대댓! --}}
        @foreach ($reply->rereplies as $rereply)
            @if ($rereply->is_delete == 0)
                <li>
                    <div class="txt_user">
                        <p>{{ $rereply->author_name }}</p>
                        <div class="more_menu_wrap">
                            <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                                    class="menu_more"></button>
                            <div class="more_menu">
                                @if ($nowUser == $rereply->author)
                                    {{-- <a href="javascript:(0)">수정</a> --}}
                                    <a href="{{ route('www.reply.delete', ['id' => $rereply->id]) }}">삭제</a>
                                @else
                                    <a
                                        onclick="reportReplyIdSetting('{{ $rereply->id }}');modal_open('reply_report')">신고</a>
                                    <a href="{{ route('www.reply.block', ['block_reply_id' => $rereply->id]) }}">차단</a>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="comment_con">
                        <span class="txt_user_tag">@ {{ $reply->author_name }}</span>
                        @php
                            echo $rereply->content;
                        @endphp
                    </div>
                    <div class="mt8">
                        <span class="txt_date">{{ $carbon::parse($rereply->created_at)->format('Y.m.d H:i') }} </span>
                        <button class="btn_re"
                            onclick="replyInfoSetting('{{ $rereply->author_name }}', '{{ $rereply->id }}');reg_reply(0)">답글
                            쓰기</button>
                    </div>
                </li>
            @endif
            @foreach ($rereply->rereplies as $rerereply)
                @if ($rerereply->is_delete == 0)
                    <li>
                        <div class="txt_user">
                            <p>{{ $rerereply->author_name }}</p>
                            <div class="more_menu_wrap">
                                <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                                        class="menu_more"></button>
                                <div class="more_menu">
                                    @if ($nowUser == $rerereply->author)
                                        {{-- <a href="javascript:(0)">수정</a> --}}
                                        <a href="{{ route('www.reply.delete', ['id' => $rerereply->id]) }}">삭제</a>
                                    @else
                                        <a
                                            onclick="reportReplyIdSetting('{{ $rerereply->id }}');modal_open('reply_report')">신고</a>
                                        <a
                                            href="{{ route('www.reply.block', ['block_reply_id' => $rerereply->id]) }}">차단</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="comment_con">
                            <span class="txt_user_tag">@ {{ $rereply->author_name }}</span>
                            @php
                                echo $rerereply->content;
                            @endphp
                        </div>
                        <div class="mt8">
                            <span class="txt_date">{{ $carbon::parse($rerereply->created_at)->format('Y.m.d H:i') }}
                            </span>
                            <button class="btn_re"
                                onclick="replyInfoSetting('{{ $rerereply->author_name }}', '{{ $rerereply->id }}');reg_reply(0)">답글
                                쓰기</button>
                        </div>
                    </li>
                @endif
            @endforeach
        @endforeach
    @endforeach

</ul>
<!-- comment : e -->

<!-- modal 신고하기 : s -->
<div class="modal modal_mid modal_reply_report">
    <div class="modal_title">
        <h5>신고하기</h5>
        <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
            onclick="modal_close('reply_report')">
    </div>
    <div class="modal_container">
        <form id="replyReportForm" method="post" action="{{ route('www.reply.report') }}">
            <div class="dropdown_box w_full">

                <button type="button" class="dropdown_label">신고항목을 선택 하세요. </button>
                <ul class="optionList">
                    <li class="optionItem" onclick="reportTypeSetting(0);">욕설, 비방, 차별, 혐오</li>
                    <li class="optionItem" onclick="reportTypeSetting(1);">광고, 홍보, 영리목적</li>
                    <li class="optionItem" onclick="reportTypeSetting(2);">불법정보</li>
                    <li class="optionItem" onclick="reportTypeSetting(3);">음란, 청소년 유해</li>
                    <li class="optionItem" onclick="reportTypeSetting(4);">개인정보 노출, 유포</li>
                    <li class="optionItem" onclick="reportTypeSetting(5);">도배, 스팸</li>
                    <li class="optionItem" onclick="reportTypeSetting(6);">기타</li>
                </ul>
            </div>
            <div class="mt10">
                <textarea id="report_reason" name="report_reason" placeholder="신고사유를 입력하세요."></textarea>
            </div>
            <input type="hidden" id="report_reply_id" name="report_reply_id" value="">
            <input type="hidden" id="report_type" name="report_type" value="">
            <div class="mt10">
                <button class="btn_point btn_full_basic" type="button"
                    onclick="onReplyReportSubmit();"><b>신고하기</b></button>
            </div>
        </form>
    </div>
</div>
<div class="md_overlay md_overlay_reply_report" onclick="modal_close('reply_report')"></div>
<!-- modal 신고하기 : s -->

<!-- paging : s -->
<div class="paging">
    <ul class="btn_wrap">
        @if (!$replys->onFirstPage())
            <li class="btn_prev">
                <a class="no_next" onclick="$replys->previousPageUrl()"><img
                        src="{{ asset('assets/media/btn_prev.png') }}" alt=""></a>
            </li>
        @endif
        @for ($i = 1; $i <= $replys->lastPage(); $i++)
            <li {{ $replys->currentPage() == $i ? 'class=active' : '' }}
                onclick="location.href = '{{ route('www.community.detail.view', ['id' => $community_id, 'community' => request()->query('community'), 'page' => $i]) }}'">
                {{ $i }}</li>
        @endfor
        @if ($replys->hasMorePages())
            <li class="btn_next">
                <a class="no_next" onclick="$replys->nextPageUrl()"><img
                        src="{{ asset('assets/media/btn_next.png') }}" alt=""></a>
            </li>
        @endif
    </ul>
</div>
<!-- paging : e -->

@php
    $infoText = '';
    if (isset(Auth::guard('web')->user()->id)) {
        $infoText = '댓글을 작성해보세요.';
    } else {
        $infoText = '공실앤톡에 로그인하고 댓글을 작성해보세요.';
    }

@endphp

<!-- 댓글 작성 : s -->
<div class="comment_reg_wrap" id="cmt_area">
    <form id="replyCreateForm" method="post" action="{{ route('www.reply.create') }}">
        <span class="comment_nik" id="reNickname" name="reNickname">@주이사</span>
        <textarea placeholder="{{ $infoText }}" id="reply_comment" name="reply_comment" class="comment_reg"></textarea>
        <input type="hidden" id="community_id" name="community_id" value="{{ $community_id }}">
        <input type="hidden" id="parent_id" name="parent_id" value="">
        <input type="hidden" id="community_type" name="community_type"
            value="{{ request()->query('community') == 0 ? 'magazine' : 'community' }}">
    </form>
    <button class="comment_reg_btn" type="button" onclick="replyCreateSubmit();">등록</button>
</div>
<!-- 댓글 작성 : e -->


<script>
    function reportTypeSetting(index) {
        $('#report_type').val(index);
    }

    function reportReplyIdSetting(index) {
        $('#report_reply_id').val(index);
    }

    function replyInfoSetting(name, parent_id) {
        $('#reNickname').text('@' + name);
        $('#parent_id').val(parent_id);
    }

    function replyCreateSubmit() {
        $('#replyCreateForm').submit();
    }

    function onReplyReportSubmit() {
        $('#replyReportForm').submit();
    }

    // 댓글 입력되면 버튼 노출/토글
    $(".comment_reg").on("propertychange change keyup paste input", function() {
        if ($(this).val().length === 0) {
            $('.comment_reg_btn').removeClass('on');
            $('.comment_reg').css('text-indent', 0);
            $('.cmt_reg .tag').hide();

        } else {
            $('.comment_reg_btn').addClass('on');
        };
    })

    //답글쓰기
    function reg_reply() {
        $('.comment_reg').focus();
        $('.comment_reg_wrap .comment_nik').show();
        let tag_height = $('.comment_reg_wrap .comment_nik').height();
        $('.comment_reg').css('padding-top', tag_height + 12);

        if (/Mobi|Android/i.test(navigator.userAgent)) {
            $('.comment_reg').css('padding-top', 0); // Set text-indent to 0 for mobile
        } else {
            $('.comment_reg').css('padding-top', tag_height +
                12); // Set text-indent to calculated value for non-mobile devices
        }
        var textareaElement = document.getElementById("cmt_area");
        window.scrollTo({
            top: textareaElement.offsetTop,
        });
    }

    function reply_back_close() {
        $('.comment_reg').val('');
        $('.comment_reg_wrap .comment_nik').css('display', 'none');
        $('#reply_back').css('display', 'none');
    }

    //댓글 more 버튼 클릭시 이벤트
    var menuWraps = document.querySelectorAll(".more_menu_wrap");
    menuWraps.forEach(function(menuWrap) {
        var button = menuWrap.querySelector(".more_button");
        var menu = menuWrap.querySelector(".more_menu");

        button.addEventListener("click", function() {
            var allMenus = document.querySelectorAll(".more_menu");
            allMenus.forEach(function(m) {
                if (m !== menu) {
                    m.style.display = "none";
                }
            });

            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        });
    });
</script>
