<!-- comment : s -->
<div class="comment_total">댓글 278</div>
<ul class="comment_list">
    <li>
        <div class="txt_user">
            <p>주이사</p>
            <div class="more_menu_wrap">
                <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}" class="menu_more"></button>
                <div class="more_menu">
                    <a href="javascript:(0)" onclick="modal_open('report')">신고</a>
                    <a href="#">차단</a>
                </div>
            </div>
        </div>
        <div class="comment_con">본질을 담고 있는 것 같아서 읽으며 많이 공감했습니다. 지금의 세대는 '못'하는 것이 아니라 '안'하는 것이라고
            생각하는데, 그만큼 그 길만이 정답이 아니라는 걸 알아버렸기 때문이라는 생각도 듭니다. 옛날 같았으면 흔히들 말하는 적령기에 달성해햐하는 과업(?)들이
            있었죠.</div>
        <div class="mt8">
            <span class="txt_date">2023.04.02 · 16:23 </span>
            <button class="btn_re" onclick="reg_reply(0)">답글 쓰기</button>
        </div>
    </li>
    <li>
        <div class="txt_user">
            <p>홍길동</p>
            <div class="more_menu_wrap">
                <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                        class="menu_more"></button>
                <div class="more_menu">
                    <a href="javascript:(0)" onclick="modal_open('report')">신고</a>
                    <a href="#">차단</a>
                </div>
            </div>
        </div>
        <div class="comment_con"><span class="txt_user_tag">@user194</span> 분위기도 정말 한 몫하는 것 같구요..
            사회적으로 어쩌구저쩌구 해라하는 분위기가 아니니깐요.. 서로를 배려하는 분위기도 아니죠.</div>
        <div class="mt8">
            <span class="txt_date">2023.04.02 · 16:23 </span>
            <button class="btn_re" onclick="reg_reply(0)">답글 쓰기</button>
        </div>
    </li>
    <li>
        <div class="txt_user">
            <p>이주임</p>
            <div class="more_menu_wrap">
                <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                        class="menu_more"></button>
                <div class="more_menu">
                    <a href="#">삭제</a>
                </div>
            </div>
        </div>
        <div class="comment_con">진짜 틀린말이 하나도 없는 글이네요... 어렵디 어렵습니다.</div>
        <div class="mt8">
            <span class="txt_date">2023.04.02 · 16:23 </span>
            <button class="btn_re" onclick="reg_reply(0)">답글 쓰기</button>
        </div>
    </li>
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
    <span class="comment_nik">@주이사</span>
    <textarea placeholder="공실앤톡에 로그인하고 댓글을 작성해보세요." class="comment_reg"></textarea>
    <button class="comment_reg_btn">등록</button>
</div>
<!-- 댓글 작성 : e -->


<script>
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
