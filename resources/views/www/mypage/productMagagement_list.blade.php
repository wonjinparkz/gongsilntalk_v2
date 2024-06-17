<x-layout>

    <!-- m::header bar : s -->
    <div class="m_header">
        <div class="left_area"></div>
        <div class="m_title">마이페이지</div>
        <div class="right_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_alarm.png') }}"></a></div>
    </div>
    <!-- m::header bar : s -->

    <div class="body">

        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body my_main_body inner_wrap">
                    <h1 class="t_center">내 매물관리</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5 toggle_tab">
                            <li class="active" onclick="loadMoreData(1, 0);">
                                등록요청<span>{{ number_format($countList->request_count) }}</span></li>
                            <li onclick="loadMoreData(1, 1);">
                                등록완료<span>{{ number_format($countList->transactions_count) }}</span></li>
                        </ul>
                    </div>

                    <div>
                        <div class="my_search_wrap">
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
                                <input type="text" placeholder="매물번호/주소로 검색">
                                <button><img src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
                            </div>
                        </div>

                        <div class="border_top">
                            <div>
                                {{-- <input type="checkbox" name="checkAll" id="checkAll">
                                <label for="checkAll"><span></span></label> --}}
                            </div>
                            <div class="right_spacing">
                                <button class="btn_gray_ghost btn_sm" type="button" onclick="modal_open('delete')">선택
                                    삭제</button>
                                <button class="btn_point btn_sm"
                                    onclick="location.href='{{ route('www.product.create.view') }}'">신규
                                    매물
                                    등록</button>
                            </div>
                        </div>
                        <div class="productListDiv">

                        </div>


                        <!-- modal 선택 삭제 : s -->
                        <div class="modal modal_delete">

                            <div class="modal_container">
                                <div class="modal_mss_wrap">
                                    <p class="txt_item_1 txt_point">
                                    </p>
                                    <p class="txt_item_1">선택하신 매물을 삭제하시겠습니까?</p>
                                    <p class="mt8 txt_item_2">삭제 후에는 되돌릴 수 없습니다.</p>
                                </div>

                                <div class="modal_btn_wrap">
                                    <button class="btn_gray btn_full_thin" type="button"
                                        onclick="modal_close('delete')">취소</button>
                                    <button class="btn_point btn_full_thin" type="button"
                                        onclick="onDeleteAll();">삭제</button>
                                </div>
                            </div>

                        </div>
                        <div class="md_overlay md_overlay_delete" onclick="modal_close('delete')"></div>
                        <!-- modal 선택 삭제 : e -->

                    </div>
                    <!-- my_body : e -->

                </div>

            </div>

        </div>
        <input type="hidden" id="productListType" name="productListType" value="0">
</x-layout>

<script>

    // 전체 삭제
    function onDeleteAll() {
        const query = 'input[name="checkOne"]:checked';
        const selectedEls = document.querySelectorAll(query);

        let checkedArray = [];
        selectedEls.forEach((el) => {
            checkedArray.push(el.value);
        });

        onDelete(checkedArray);
    }

    // 삭제
    function onDelete(id) {

        $.ajax({
                url: '{{ route('www.mypage.product.magagement.delete') }}',
                type: "post",
                data: {
                    'id[]': id
                }
            })
            .done(function(data) {
                location.reload();
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('다시 시도해주세요.');
            });
    }

    // 평 변환
    function sizeChange() {

        let squareText = '';
        let areaText = '';

        const btnInfo = document.querySelector(".sizeBtn");
        const button = document.querySelector(".sizeBtnEvent");


        if (btnInfo.textContent === "평") {
            btnInfo.textContent = "㎡";
            squareText = 'none';
            areaText = '';
        } else {
            btnInfo.textContent = "평";
            squareText = '';
            areaText = 'none';
        }

        const squareList = document.querySelectorAll(".square");
        const areaList = document.querySelectorAll(".area");

        squareList.forEach(element => {
            element.style.display = squareText;
        });
        areaList.forEach(element => {
            element.style.display = areaText;
        });
    }

    loadMoreData(1, 0);

    function loadMoreData(page, type) {
        $('#productListType').val(type);
        $.ajax({
                url: '{{ route('www.mypage.product.magagement.list.view') }}',
                type: "get",
                data: {
                    'page': page,
                    'type': type,
                    'product_type': $('#product_type').val(),
                    'payment_type': $('#payment_type').val(),
                }
            })
            .done(function(data) {
                $(".productListDiv").html(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('데이터를 불러오지 못했습니다.');
            });
    }
</script>
