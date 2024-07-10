<x-layout>

    <div class="body gray_body">
        <div class="community_wrap">
            <div class="community_area">

                <form class="form" method="POST" action="{{ route('www.community.update') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $result->id }}" />
                    <input type="hidden" name="last_url" value="{{ old('last_url') ?? URL::previous() }}">
                    <!-- community body : s -->
                    <div class="community_inner_wrap">
                        <div class="header_bar">
                            <div>
                                <a
                                    href="{{ str_contains(Route::currentRouteName(), 'update') ? URL::previous() : route('www.community.list.view', ['community' => '1']) }}"><img
                                        src="{{ asset('assets/media/header_btn_back.png') }}"></a>
                            </div>
                            <div>신규 게시글 작성</div>
                            <div></div>
                        </div>

                        <ul class="reg_bascic mt20">
                            <li>
                                @php
                                    $category = old('category') ?? $result->category;
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
                                <input type="text" name="title" id="title" placeholder="제목을 입력해주세요."
                                    value="{{ old('title') ?? $result->title }}">
                            </li>
                            <li>
                                <textarea name="content" id="content" placeholder="내용을 입력해주세요.">{{ old('content') ?? $result->content }}</textarea>
                            </li>
                        </ul>

                        <!-- 사진 등록 : s -->
                        <div class="flex_between ">
                            <h6>사진 등록</h6>
                            <p class="gray_basic">최대 8장 업로드 가능 <span
                                    class="txt_point imageCount">{{ count($result->images) }}</span> / 8</p>
                        </div>
                        <div class="img_add_wrap draggable-zone">
                            <x-pc-image-picker :title="''" id="community" cnt="8" required="required"
                                :images="$result->images" />
                        </div>
                        <!-- 사진 등록 : e -->

                        <div class="mt20">
                            <button class="btn_point btn_full_basic"
                                onclick="location.href='community_contents_list.html'">게시글 수정</button>
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
</x-layout>
