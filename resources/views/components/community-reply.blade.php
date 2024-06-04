@props(['replys' => [], 'community_id' => 0])

<!-- comment : s -->

@inject('carbon', 'Carbon\Carbon')

<div class="comment_total">댓글 {{ $replys->count() }}</div>
<ul class="comment_list">
    @foreach ($replys as $reply)
        <li>
            <div class="txt_user">
                <p>{{ $reply->author_name }}</p>
                <div class="more_menu_wrap">
                    <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                            class="menu_more"></button>
                    <div class="more_menu">
                        <a href="javascript:(0)" onclick="modal_open('report')">신고</a>
                        <a href="#">차단</a>
                    </div>
                </div>
            </div>
            <div class="comment_con">
                @php
                    echo $reply->content;
                @endphp
            </div>
            <div class="mt8">
                <span class="txt_date">{{ $carbon::parse($reply->created_at)->format('Y.m.d H:m') }}</span>
                <button class="btn_re"
                    onclick="replyInfoSetting('{{ $reply->author_name }}', '{{ $reply->id }}');reg_reply(0)">답글
                    쓰기</button>
            </div>
        </li>

        {{-- 밑에는 대댓! --}}
        @foreach ($reply->rereplies as $rereply)
            <li>
                <div class="txt_user">
                    <p>{{ $rereply->author_name }}</p>
                    <div class="more_menu_wrap">
                        <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                                class="menu_more"></button>
                        <div class="more_menu">
                            <a href="javascript:(0)" onclick="modal_open('report')">신고</a>
                            <a href="#">차단</a>
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
                    <span class="txt_date">{{ $carbon::parse($rereply->created_at)->format('Y.m.d H:m') }} </span>
                    <button class="btn_re" onclick="replyInfoSetting('{{ $rereply->author_name }}', '{{ $rereply->id }}');reg_reply(0)">답글 쓰기</button>
                </div>
            </li>
            @foreach ($rereply->rereplies as $rerereply)
                <li>
                    <div class="txt_user">
                        <p>{{ $rerereply->author_name }}</p>
                        <div class="more_menu_wrap">
                            <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                                    class="menu_more"></button>
                            <div class="more_menu">
                                <a href="javascript:(0)" onclick="modal_open('report')">신고</a>
                                <a href="#">차단</a>
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
                        <span class="txt_date">{{ $carbon::parse($rerereply->created_at)->format('Y.m.d H:m') }}
                        </span>
                        <button class="btn_re" onclick="replyInfoSetting('{{ $rerereply->author_name }}', '{{ $rerereply->id }}');reg_reply(0)">답글 쓰기</button>
                    </div>
                </li>
            @endforeach
        @endforeach
    @endforeach

</ul>
<!-- comment : e -->

<!-- paging : s -->
<div class="paging">
    <ul class="btn_wrap">
        <li class="btn_prev">
            <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_prev.png') }}" alt=""></a>
        </li>
        <li class="active">1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li class="btn_next">
            <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_next.png') }}" alt=""></a>
        </li>
    </ul>
</div>
<!-- paging : e -->


<!-- 댓글 작성 : s -->
<div class="comment_reg_wrap" id="cmt_area">
    <form id="replyCreateForm" method="post" action="{{ route('www.reply.create') }}">
        <span class="comment_nik" id="reNickname" name="reNickname">@주이사</span>
        <textarea placeholder="공실앤톡에 로그인하고 댓글을 작성해보세요." id="reply_comment" name="reply_comment" class="comment_reg"></textarea>
        <input type="hidden" id="community_id" name="community_id" value="{{ $community_id }}">
        <input type="hidden" id="parent_id" name="parent_id" value="">
        <input type="hidden" id="community_type" name="community_type"
            value="{{ request()->query('community') == 0 ? 'magazine' : 'community' }}">
    </form>
    <button class="comment_reg_btn" type="button" onclick="replyCreateSubmit();">등록</button>
</div>
<!-- 댓글 작성 : e -->


<script>
    function replyInfoSetting(name, parent_id) {
        $('#reNickname').text('@' + name);
        $('#parent_id').val(parent_id);
    }

    function replyCreateSubmit() {
        $('#replyCreateForm').submit();
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
