<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">마이메뉴</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">커뮤니티 게시글 관리</h1>

                    <div class="flex_between my_body_top">
                        <div>
                            <input type="checkbox" name="checkAll" id="checkAll">
                            <label for="checkAll"><span></span>전체선택</label>
                        </div>

                        <button class="btn_gray_ghost btn_sm">선택 삭제</button>
                    </div>


                    @if ($result_community)
                        <!-- list : s -->

                        <table class="board_list">
                            <colgroup class="only_pc">
                                <col width="60">
                                <col width="100">
                                <col width="*">
                                <col width="150">
                                <col width="100">
                            </colgroup>
                            <thead class="only_pc">
                                <tr>
                                    <th></th>
                                    <th>번호</th>
                                    <th>제목</th>
                                    <th>작성일</th>
                                    <th>조회수</th>
                                </tr>
                            </thead>
                            <tbody>
                                @inject('carbon', 'Carbon\Carbon')
                                @foreach ($result_community as $community)
                                    <tr>
                                        <td colspan="5">
                                            <div class="board_row">
                                                <div class="board_item_2">
                                                    <input type="checkbox" name="checkOne" id="checkOne_1"
                                                        value="Y">
                                                    <label for="checkOne_1"><span></span></label>
                                                </div>
                                                <div class="board_inner_row">
                                                    <div class="board_item_4 only_pc">{{ $community->id }}</div>
                                                    <div class="board_item_1"><a
                                                            href="{{ route('www.community.detail.view', ['id' => $community->id, 'community' => 1]) }}"><span
                                                                class="gray_deep">[{{ Commons::get_communityTypeTitle($community->category) }}]</span>
                                                            {{ $community->title }}</a> <span
                                                            class="txt_point">[{{ number_format($community->replys_count) }}]</span>
                                                    </div>
                                                    <div class="board_item_3 gray_basic">
                                                        {{ $carbon::parse($community->created_at)->format('Y-m-d H:m') }}<span
                                                            class="gray_basic"> · 조회 {{ $community->view_count }}</span>
                                                    </div>
                                                    <div class="board_item_4 gray_basic only_pc">
                                                        {{ $community->view_count }}</div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- list : e -->

                        <!-- paging : s -->
                        <div class="paging only_pc">
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
                    @else
                        <!-- 데이터가 없을 경우 : s -->
                        <div class="empty_wrap">
                            <p>작성한 게시글이 없습니다.</p>
                            <span>커뮤니티에서 글을 작성하고<br>다양한 부동산 관련 정보를 나눠보세요.</span>
                        </div>
                        <!-- 데이터가 없을 경우 : e -->
                    @endif




                </div>
                <!-- my_body : e -->

            </div>

            <!-- modal 요청확인 : s -->
            <div class="modal modal_mid modal_check">
                <div class="modal_title">
                    <h5>투어 요청 확인</h5>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                        onclick="modal_close('check')">
                </div>
                <div class="modal_container">
                    <h6>요청자 정보</h6>
                    <div class="table_container_sm mt8">
                        <div class="td">이름</div>
                        <div class="td">홍길동</div>
                        <div class="td">연락처</div>
                        <div class="td">010-1234-1234</div>
                    </div>

                    <div class="flex_between mt20">
                        <h6>투어 요청 매물 정보</h6>
                        <button class="btn_gray_ghost btn_sm">상세보기</button>
                    </div>
                    <div class="table_container_sm mt8">
                        <div class="td">사진</div>
                        <div class="td">
                            <div class="frame_img_sm">
                                <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                            </div>
                        </div>
                        <div class="td">주소</div>
                        <div class="td">강남구 역삼동 123-12</div>
                        <div class="td">거래정보</div>
                        <div class="td">임대 3억 2,200만 / 4,500만 <span class="gray_basic">(800만/평)</span></div>
                        <div class="td">면적</div>
                        <div class="td">전용 105.12평 <span class="gray_basic">(347.50㎡)</span></div>
                        <div class="td">층정보</div>
                        <div class="td">3층 / 12층</div>
                        <div class="td">관리비</div>
                        <div class="td">관리비 10만</div>
                    </div>

                </div>
            </div>
            <div class="md_overlay md_overlay_check" onclick="modal_close('check')"></div>
            <!-- modal 요청확인 : e -->

        </div>

    </div>

</x-layout>
