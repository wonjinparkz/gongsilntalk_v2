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
                <div class="my_body inner_wrap">
                    <h1 class="t_center only_pc">내 매물관리</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5 toggle_tab">
                            <li class="active">전체<span>62</span></li>
                            <li>거래중<span>8</span></li>
                            <li>거래완료<span>32</span></li>
                            <li>비공개/등록만료<span>3</span></li>
                        </ul>
                    </div>

                    <div class="my_search_wrap only_pc">
                        <div class="sort_wrap">
                            <div class="dropdown_box">
                                <button class="dropdown_label">거래 유형</button>
                                <ul class="optionList">
                                    <li class="optionItem">전체</li>
                                    <li class="optionItem">매매</li>
                                    <li class="optionItem">임대</li>
                                    <li class="optionItem">단기임대</li>
                                    <li class="optionItem">전세</li>
                                    <li class="optionItem">월세</li>
                                    <li class="optionItem">전매</li>
                                </ul>
                            </div>
                            <div class="dropdown_box">
                                <button class="dropdown_label">매물 종류</button>
                                <ul class="optionList">
                                    <li class="optionItem">지산/사무실/창고</li>
                                    <li class="optionItem">상가</li>
                                    <li class="optionItem">건물</li>
                                    <li class="optionItem">토지/임야</li>
                                    <li class="optionItem">단독공장</li>
                                    <li class="optionItem">아파트</li>
                                    <li class="optionItem">오피스텔</li>
                                    <li class="optionItem">단독/다가구</li>
                                    <li class="optionItem">다세대/빌라/연립</li>
                                    <li class="optionItem">상가주택</li>
                                    <li class="optionItem">주택</li>
                                    <li class="optionItem">지식산업센터 분양권</li>
                                    <li class="optionItem">상가 분양권</li>
                                    <li class="optionItem">아파트 분양권</li>
                                    <li class="optionItem">오피스텔 분양권</li>
                                </ul>
                            </div>
                        </div>

                        <div class="search_wrap">
                            <input type="text" placeholder="매물번호/주소/비공개 메모로 검색">
                            <button><img src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
                        </div>
                    </div>

                    <!-- M::filter : s -->
                    <div class="mt18 only_m">
                        <div class="m_dropdown_double_wrap">
                            <button class="btn_dropdown" onclick="modal_open_slide('transaction_type')">거래 유형</button>
                            <button class="btn_dropdown" onclick="modal_open_slide('estate_kind')">매물 종류</button>
                        </div>
                    </div>

                    <div class="modal_slide modal_slide_transaction_type">
                        <div class="slide_title_wrap">
                            <span>거래 유형</span>
                            <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                onclick="modal_close_slide('transaction_type')">
                        </div>
                        <ul class="slide_modal_menu">
                            <li><a href="#">전체</a></li>
                            <li><a href="#">매매</a></li>
                            <li><a href="#">임대</a></li>
                            <li><a href="#">단기임대</a></li>
                            <li><a href="#">전세</a></li>
                            <li><a href="#">월세</a></li>
                            <li><a href="#">전매</a></li>
                        </ul>
                    </div>
                    <div class="md_slide_overlay md_slide_overlay_transaction_type"
                        onclick="modal_close_slide('transaction_type')"></div>

                    <div class="modal_slide modal_slide_estate_kind">
                        <div class="slide_title_wrap">
                            <span>매물 종류</span>
                            <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                onclick="modal_close_slide('estate_kind')">
                        </div>
                        <ul class="slide_modal_menu">
                            <li><a href="#">지산/사무실/창고</a></li>
                            <li><a href="#">상가</a></li>
                            <li><a href="#">건물</a></li>
                            <li><a href="#">토지/임야</a></li>
                            <li><a href="#">단독공장</a></li>
                            <li><a href="#">아파트</a></li>
                            <li><a href="#">오피스텔</a></li>
                            <li><a href="#">단독/다가구</a></li>
                            <li><a href="#">다세대/빌라/연립</a></li>
                            <li><a href="#">상가주택</a></li>
                            <li><a href="#">주택</a></li>
                            <li><a href="#">지식산업센터 분양권</a></li>
                            <li><a href="#">상가 분양권</a></li>
                            <li><a href="#">아파트 분양권</a></li>
                            <li><a href="#">오피스텔 분양권</a></li>
                        </ul>
                    </div>
                    <div class="md_slide_overlay md_slide_overlay_estate_kind"
                        onclick="modal_close_slide('estate_kind')"></div>
                    <!-- M::filter : e -->

                    <div class="border_top">
                        <div>
                            <!-- <input type="checkbox" name="checkAll" id="checkAll">
                          <label for="checkAll"><span></span></label> -->
                        </div>
                        <div class="right_spacing">
                            <button class="btn_gray_ghost btn_sm" onclick="modal_open('asset_delete')">선택 삭제</button>
                            <button class="btn_point btn_sm" onclick="location.href='realtor_estate_reg_1.html'">신규 매물
                                등록</button>
                        </div>
                    </div>

                    <!-- 데이터가 없을 경우 : s -->
                    <!-- <div class="empty_wrap">
                        <p>등록한 매물이 없습니다.</p>
                        <span>매물을 등록하고 간편하게 관리해보세요.</span>
                      </div> -->
                    <!-- 데이터가 없을 경우 : e -->

                    <!-- Only PC list : s -->
                    <table class="table_basic mt20 only_pc">
                        <colgroup>
                            <col width="40">
                            <col width="75">
                            <col width="110">
                            <col width="80">
                            <col width="120">
                            <col width="*">
                            <col width="120">
                            <col width="130">
                            <col width="180">
                            <col width="140">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkAll" id="checkAll">
                                    <label for="checkAll"><span></span></label>
                                </th>
                                <th>매물번호</th>
                                <th>상태</th>
                                <th>사진</th>
                                <th>매물 종류</th>
                                <th>주소</th>
                                <th>면적 <button class="inner_change_button"><img
                                            src="{{ asset('assets/media/ic_change.png') }}"> <span
                                            class="txt_unit">평</span></button></th>
                                <th>거래정보</th>
                                <th>비공개 메모</th>
                                <th>관리</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="td_center">
                                    <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
                                    <label for="checkOne_1"><span></span></label>
                                </td>
                                <td><span class="gray_deep">123456</span></td>
                                <td>
                                    <div class="dropdown_box s_xs">
                                        <button class="dropdown_label">거래중</button>
                                        <ul class="optionList">
                                            <li class="optionItem">거래중</li>
                                            <li class="optionItem">거래완료</li>
                                            <li class="optionItem">비공개</li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="list_thumb_1">
                                        <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                                    </div>
                                </td>
                                <td>오피스텔</td>
                                <td>서울시 마포구 합정동 서희스타힐스 1105호</td>
                                <td>공급 1234.12㎡<br>전용 1234.12㎡</td>
                                <td>매매<br>12억 2,000만</td>
                                <td>
                                    <div class="txt_memo">
                                        <p class="txt_item">등록된 메모가 없습니다.</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="gap_8">
                                        <button class="btn_gray_ghost btn_sm"
                                            onclick="location.href='realtor_estate_modify.html'">수정</button>
                                        <button class="btn_gray_ghost btn_sm">삭제</button>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td class="td_center">
                                    <input type="checkbox" name="checkOne" id="checkOne_2" value="Y">
                                    <label for="checkOne_2"><span></span></label>
                                </td>
                                <td><span class="gray_deep">123456</span></td>
                                <td>
                                    <p class="txt_point">등록만료</p>
                                </td>
                                <td>
                                    <div class="list_thumb_1">
                                        <div class="img_box"><img src="{{ asset('assets/media/s_2.png') }}"></div>
                                    </div>
                                </td>
                                <td>오피스텔</td>
                                <td>서울시 마포구 합정동 서희스타힐스 1105호</td>
                                <td>공급 1234.12㎡<br>전용 1234.12㎡</td>
                                <td>매매<br>12억 2,000만</td>
                                <td>
                                    <div class="txt_memo">
                                        전반적으로 알아서 해달라 하심. 중요한 사항만 전화로 바로 여쭤보기.
                                    </div>
                                </td>
                                <td>
                                    <div class="gap_8">
                                        <button class="btn_gray_ghost btn_sm">재등록</button>
                                        <button class="btn_gray_ghost btn_sm">삭제</button>
                                    </div>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- paging : s -->
                    <div class="paging only_pc">
                        <ul class="btn_wrap">
                            <li class="btn_prev">
                                <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_prev.png') }}"
                                        alt=""></a>
                            </li>
                            <li class="active">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li class="btn_next">
                                <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_next.png') }}"
                                        alt=""></a>
                            </li>
                        </ul>
                    </div>
                    <!-- paging : e -->
                    <!-- Only PC list : e -->

                    <!----------------------------- Only M list : s ----------------------------->
                    <ul class="list_m_basic only_m mt8">
                        <li>
                            <div class="flex_between">
                                <div>
                                    <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
                                    <label for="checkOne_1"><span></span></label>
                                    <span class="gray_deep">매물번호 168752</span>
                                </div>
                                <button class="btn_gray_ghost btn_sm">삭제</button>
                            </div>
                            <div class="list_m_cnt">
                                <div class="list_thumb_1">
                                    <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                                </div>
                                <div class="list_view">
                                    <p class="tit">아파트</p>
                                    <p class="summary">서울시 마포구 합정동, 서희스타힐스 1동 1105호</p>
                                    <p class="txt_item_1">공급 32.88㎡ / 전용 29.15㎡</p>
                                    <p class="txt_item_2">월세 13억 2,000 / 4,000만</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex_between">
                                <div>
                                    <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
                                    <label for="checkOne_1"><span></span></label>
                                    <span class="gray_deep">매물번호 168752</span>
                                </div>
                                <button class="btn_gray_ghost btn_sm">삭제</button>
                            </div>
                            <div class="list_m_cnt">
                                <div class="list_thumb_1">
                                    <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                                </div>
                                <div class="list_view">
                                    <p class="tit">아파트</p>
                                    <p class="summary">서울시 마포구 합정동, 서희스타힐스 1동 1105호</p>
                                    <p class="txt_item_1">공급 32.88㎡ / 전용 29.15㎡</p>
                                    <p class="txt_item_2">월세 13억 2,000 / 4,000만</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="flex_between">
                                <div>
                                    <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
                                    <label for="checkOne_1"><span></span></label>
                                    <span class="gray_deep">매물번호 168752</span>
                                </div>
                                <button class="btn_gray_ghost btn_sm">삭제</button>
                            </div>
                            <div class="list_m_cnt">
                                <div class="list_thumb_1">
                                    <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                                </div>
                                <div class="list_view">
                                    <p class="tit">아파트</p>
                                    <p class="summary">서울시 마포구 합정동, 서희스타힐스 1동 1105호</p>
                                    <p class="txt_item_1">공급 32.88㎡ / 전용 29.15㎡</p>
                                    <p class="txt_item_2">월세 13억 2,000 / 4,000만</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <!----------------------------- Only M list : e ----------------------------->
                </div>
                <!-- my_body : e -->

            </div>


        </div>

    </div>

    <!-- modal 삭제 : s -->
    <div class="modal modal_asset_delete">
        <div class="modal_container">
            <div class="modal_mss_wrap">
                <p class="txt_item_1 txt_point">서울시 마포구 합정동<br>오피스텔 매매 12억 2000만</p>
                <p class="txt_item_1">매물을 삭제하시겠습니까?</p>
                <p class="mt8 txt_item_2">매물 미노출을 원할 시, 비공개 기능을 이용해보세요.</p>
            </div>

            <div class="modal_btn_wrap">
                <button class="btn_gray btn_full_thin" onclick="modal_close('asset_delete')">취소</button>
                <button class="btn_point btn_full_thin" onclick="modal_close('asset_delete')">삭제</button>
            </div>
        </div>

    </div>
    <div class="md_overlay md_overlay_asset_delete" onclick="modal_close('asset_delete')"></div>
    <!-- modal 삭제 : e -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const button = document.querySelector(".inner_change_button");
            const unitSpan = button.querySelector(".txt_unit");

            button.addEventListener("click", function() {
                if (unitSpan.textContent === "평") {
                    unitSpan.textContent = "㎡";
                } else {
                    unitSpan.textContent = "평";
                }
            });
        });
    </script>

</x-layout>
