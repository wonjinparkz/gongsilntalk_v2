<x-layout>

    <div class="body gray_body">
        <div class="community_wrap">
            <div class="community_area">

                <form class="form" method="POST" action="{{ route('www.community.create') }}">
                    @csrf
                    <!-- community body : s -->
                    <div class="community_inner_wrap">
                        <div class="header_bar">
                            <div>
                                <a href="{{ URL::previous() }}"><img
                                        src="{{ asset('assets/media/header_btn_back.png') }}"></a>
                            </div>
                            <div>신규 게시글 작성</div>
                            <div></div>
                        </div>

                        <ul class="reg_bascic mt20">
                            <li>
                                @php
                                    $category = old('category') ?? -1;
                                @endphp
                                <select class="w_50" name="category" id="category">
                                    <option value="-1" @if ($category == -1) selected @endif>게시판 선택
                                    </option>
                                    <option value="0" @if ($category == 0) selected @endif>자유글
                                    </option>
                                    <option value="1" @if ($category == 1) selected @endif>질문/답변
                                    </option>
                                    <option value="2" @if ($category == 2) selected @endif>후기</option>
                                    <option value="3" @if ($category == 3) selected @endif>노하우
                                    </option>
                                </select>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('category')" />
                            </li>
                            <li>
                                <input type="text" name="title" id="title" placeholder="제목을 입력해주세요.">
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />
                            </li>
                            <li>
                                <textarea name="content" id="content" placeholder="내용을 입력해주세요."></textarea>
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                            </li>
                        </ul>

                        <!-- 사진 등록 : s -->
                        <div class="flex_between ">
                            <h6>사진 등록</h6>
                            <p class="gray_basic">최대 8장 업로드 가능 <span class="txt_point imageCount">0</span> / 8</p>
                        </div>
                        <div class="img_add_wrap draggable-zone">
                            <x-pc-image-picker :title="''" id="community" cnt="8" required="required" />
                        </div>
                        <!-- 사진 등록 : e -->

                        <div class="mt20">

                            <button type="button" id="button_disabled" class="btn_point btn_full_basic button_disabled"
                                disabled>
                                게시글 등록
                            </button>
                            <button type="button" id="button_active" class="btn_point btn_full_basic"
                                onclick="modal_open('reg')" style="display:none">
                                게시글 등록
                            </button>
                        </div>
                    </div>
                    <!-- community body : e -->
                </form>
            </div>



            <!-- nav : s -->
            <x-nav-layout />
            <!-- nav : e -->


        </div>

    </div>

    <!-- modal 등록 : s -->
    <div class="modal modal_reg">

        <div class="modal_container">
            <div class="modal_mss_wrap">
                <p class="txt_item_1">게시글을 등록하시겠습니까?</p>
            </div>

            <div class="modal_btn_wrap">
                <button class="btn_gray btn_full_thin" onclick="modal_close('reg')">취소</button>
                <button class="btn_point btn_full_thin" onclick="$('.form').submit();">게시글 등록</button>
            </div>
        </div>

    </div>
    <div class="md_overlay md_overlay_reg" onclick="modal_close('reg')"></div>
    <!-- modal 등록 : e -->

</x-layout>
<script>
    var containers = document.querySelectorAll(".draggable-zone");

    var swappable = new Sortable.default(containers, {
        draggable: ".draggable",
        handle: ".draggable .draggable-handle",
        mirror: {
            appendTo: "body",
            constrainDimensions: true
        },

    });

    $(document).ready(function() {
        button_active();
        $('input, select, textarea').change(function() {
            button_active();
        });
    });


    function button_active() {
        var title = $('#title').val();
        var content = $('#content').val();
        var category = $('#category').val();

        if (title !== '' && content !== '' && category >= 0) {
            $('#button_active').css('display', '');
            $('#button_disabled').css('display', 'none');
        } else {
            $('#button_disabled').css('display', '');
            $('#button_active').css('display', 'none');
        }
    }
</script>
