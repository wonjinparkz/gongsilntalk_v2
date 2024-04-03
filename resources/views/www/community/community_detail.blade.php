<x-layout>

    <input type="hidden" name="id" id="id" value="{{ $result->id }}">
    <input type="hidden" name="type" id="type" value="community">

    <div class="body gray_body">
        <div class="inner_wrap community_wrap">
            <div class="community_area">

                <div class="community_inner_wrap">
                    <div class="header_bar">
                        <div>
                            <a
                                href="{{ str_contains(Route::currentRouteName(), 'create') ? URL::previous() : route('www.community.list.view', ['community' => '1']) }}"><img
                                    src="{{ asset('assets/media/header_btn_back.png') }}"></a>
                        </div>
                        <div>
                            <a href="javascript:(0)" class="btn_share"><img
                                    src="{{ asset('assets/media/header_btn_share.png') }}"></a>
                            <a href="#" class="dot_btn btn_dot_menu"><img
                                    src="{{ asset('assets/media/header_btn_dot.png') }}"></a>
                            <!-- 공유하기 : s -->
                            <div class="layer layer_share_wrap layer_share_top">
                                <div class="layer_title">
                                    <h5>공유하기</h5>
                                    <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                        class="md_btn_close btn_share">
                                </div>
                                <div class="layer_share_con">
                                    <a href="#">
                                        <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                        <p class="mt8">카카오톡</p>
                                    </a>
                                    <a href="#">
                                        <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                        <p class="mt8">링크복사</p>
                                    </a>
                                </div>
                            </div>
                            <!-- 공유하기 : e -->

                            <div class="layer_menu">
                                <a href="community_modify.html">수정</a>
                                <a href="#">삭제</a>
                            </div>

                        </div>
                    </div>


                    <!-- contents : s -->
                    <div class="community_detail_top">
                        <span class="community_mark">공톡 매거진</span>
                        <h3>{{ $result->title }}</h3>
                        @inject('carbon', 'Carbon\Carbon')
                        @if (request()->query('community'))
                            <div class="detail_user">
                                <div class="list_user_photo">
                                    <div class="img_box">
                                        <img src="{{ asset('assets/media/default_gs.png') }}">
                                    </div>
                                </div>
                                <div>
                                    <span class="txt_name">홍길동</span>
                                    <p class="txt_date">{{ $carbon::parse($result->created_at)->format('Y-m-d H:m') }}
                                        ·
                                        조회 {{ $result->view_count }}</p>
                                </div>
                            </div>
                        @else
                            <div class="detail_user">
                                <div>
                                    <p class="txt_date">{{ $carbon::parse($result->created_at)->format('Y-m-d H:m') }}
                                        · 조회 {{ $result->view_count }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="community_contents">
                        @if ($result->url != '')
                            <div class="detail_img_wrap">
                                <iframe width="100%" height="350" src="{{ $result->url }}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                        @endif
                        {!! $result->content !!}
                        @foreach ($result->images as $image)
                            <div class="detail_img_wrap">
                                <img src="{{ Storage::url('image/' . $image->path) }}" onclick="modal_open('big_img')">
                            </div>
                        @endforeach

                        <div class="like_wrap">
                            <a href="javascript:void(0)" class="btn_like {{ $result->like_id > 0 ? 'on' : '' }}"
                                onclick="btn_like(this)"></a>
                            <span id="like_count">2</span>
                        </div>
                    </div>
                    <!-- contents : e -->

                    <!-- comment : s -->
                    <div class="comment_total">댓글 278</div>
                    <ul class="comment_list">
                        <li>
                            <div class="txt_user">
                                <p>주이사</p>
                                <div class="more_menu_wrap">
                                    <button class="more_button"><img src="{{ asset('assets/media/btn_dot.png') }}"
                                            class="menu_more"></button>
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
                                <a class="no_next" href="#1"><img
                                        src="{{ asset('assets/media/btn_prev.png') }}" alt=""></a>
                            </li>
                            <li class="active">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li class="btn_next">
                                <a class="no_next" href="#1"><img
                                        src="{{ asset('assets/media/btn_next.png') }}" alt=""></a>
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

                    <!-- 이미지 확대 : s-->
                    <div class="modal modal_mid modal_big_img">
                        <img src="{{ asset('assets/media/header_btn_close_w.png') }}" class="big_img_close"
                            onclick="modal_close('big_img')">
                        <img src="{{ asset('assets/media/s_8.png') }}">
                    </div>
                    <div class="md_overlay md_overlay_big_img" onclick="modal_close('big_img')"></div>
                    <!-- 이미지 확대 : e-->

                </div>

            </div>
        </div>

    </div>

    <!-- modal 신고하기 : s -->
    <div class="modal modal_mid modal_report">
        <div class="modal_title">
            <h5>신고하기</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('report')">
        </div>
        <div class="modal_container">
            <div class="dropdown_box w_full">
                <button class="dropdown_label">신고항목을 선택 하세요. </button>
                <ul class="optionList">
                    <li class="optionItem">욕설, 비방, 차별, 혐오</li>
                    <li class="optionItem">광고, 홍보, 영리목적</li>
                    <li class="optionItem">불법정보</li>
                    <li class="optionItem">음란, 청소년 유해</li>
                    <li class="optionItem">개인정보 노출, 유포</li>
                    <li class="optionItem">도배, 스팸</li>
                    <li class="optionItem">기타</li>
                </ul>
            </div>
            <div class="mt10">
                <textarea placeholder="신고사유를 입력하세요."></textarea>
            </div>
            <div class="mt10">
                <button class="btn_point btn_full_basic"><b>신고하기</b></button>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_report" onclick="modal_close('report')"></div>
    <!-- modal 신고하기 : s -->

    <script>
        // 좋아요 토글버튼
        function btn_like(element) {
            var login_check =
                @if (Auth::guard('web')->check())
                    false
                @else
                    true
                @endif ;

            if (login_check) {
                dialog('로그인이 필요합니다.\n로그인 하시겠어요?', '로그인', '아니요', login);
            } else {

                var formData = {
                    'target_id': $('#id').val(),
                    'target_type': $('#type').val(),
                };

                var likeCount = parseInt($("#like_count").text());


                if ($(element).hasClass("on")) {
                    $(element).removeClass("on");
                    likeCount--;
                } else {
                    $(element).addClass("on");
                    likeCount++;
                }

                $("#like_count").text(likeCount);

                $.ajax({
                    type: "post", //전송타입
                    url: "{{ route('www.commons.like') }}",
                    data: formData,
                    success: function(data, status, xhr) {},
                    error: function(xhr, status, e) {}
                });
            }
        }

        //공유하기 레이어
        $(".btn_share").click(function() {
            $(".layer_share_wrap").stop().slideToggle(0);
            return false;
        });


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


</x-layout>
