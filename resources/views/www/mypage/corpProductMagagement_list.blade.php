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
                            <li class="active" onclick="loadMoreData(1, 0);">
                                전체<span>{{ number_format(isset($countList->all_count) ? $countList->all_count : 0) }}</span>
                            </li>
                            <li onclick="loadMoreData(1, 1);">
                                거래중<span>{{ number_format(isset($countList->req_count) ? $countList->req_count : 0) }}</span>
                            </li>
                            <li onclick="loadMoreData(1, 2);">
                                거래완료<span>{{ number_format(isset($countList->done_count) ? $countList->done_count : 0) }}</span>
                            </li>
                            <li onclick="loadMoreData(1, 3);">
                                비공개/등록만료<span>{{ number_format(isset($countList->non_count) ? $countList->non_count : 0) }}</span>
                            </li>
                        </ul>
                    </div>

                    <div class="my_search_wrap optionSelectBox">
                        <div class="sort_wrap">
                            <div class="dropdown_box">
                                <button class="dropdown_label" data-initial-title="거래 유형">거래 유형</button>
                                <ul class="optionList">
                                    <li class="optionItem" onclick="onPaymentTypeChange('');">전체</li>
                                    @foreach (Lang::get('commons.payment_type') as $key => $payment_type)
                                        <li class="optionItem" onclick="onPaymentTypeChange('{{ $key }}');">
                                            {{ $payment_type }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="dropdown_box">
                                <button class="dropdown_label" data-initial-title="매물 종류">매물 종류</button>
                                <ul class="optionList">
                                    <li class="optionItem" onclick="onProductTypeChange('');">전체</li>
                                    @foreach (Lang::get('commons.product_type') as $key => $product_type)
                                        <li class="optionItem" onclick="onProductTypeChange('{{ $key }}');">
                                            {{ $product_type }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="search_wrap only_pc">
                            <input type="text" id="searchText" name="searchText" placeholder="매물번호/주소/비공개 메모로 검색">
                            <button type="button" onclick="onSearchTextChange();"><img
                                    src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
                        </div>
                    </div>

                    <div class="border_top">
                        <div>
                        </div>
                        <div class="right_spacing">
                            <button class="btn_gray_ghost btn_sm" type="button" onclick="modal_open('delete')">선택
                                삭제</button>
                            <button class="btn_point btn_sm"
                                onclick="location.href='{{ route('www.corp.product.create.view') }}'">신규 매물
                                등록</button>
                        </div>
                    </div>

                    <div class="border_top">
                        <span class="gray_basic">* 거래완료 처리시 재등록, 수정 불가하니 정확하게 확인 후 선택하세요.</span>
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
    <input type="hidden" id="productListPage" name="productListPage" value="0">
    <input type="hidden" id="productType" name="productType" value="">
    <input type="hidden" id="paymentType" name="paymentType" value="">

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

        var onSearchTextChange = () => {
            loadMoreData(1, $('#productListType').val());
        }

        var onProductTypeChange = (index) => {
            $('#productType').val(index);

            loadMoreData(1, $('#productListType').val());
        }

        var onPaymentTypeChange = (index) => {
            $('#paymentType').val(index);

            loadMoreData(1, $('#productListType').val());
        }

        loadMoreData(1, 0);

        function loadMoreData(page, type) {
            $('#productListType').val(type);
            $('#productListPage').val(page);
            $.ajax({
                    url: '{{ route('www.mypage.corp.product.magagement.list.view') }}',
                    type: "get",
                    data: {
                        'page': page,
                        'type': type,
                        'product_type': $('#productType').val(),
                        'payment_type': $('#paymentType').val(),
                        'search_text': $('#searchText').val()
                    }
                })
                .done(function(data) {
                    $(".productListDiv").html(data.html);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('데이터를 불러오지 못했습니다.');
                });
        }

        function loadPageData(page) {
            loadMoreData(page, $('#productListType').val());
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

        function stateChangeModal(id, state) {
            $("#state_update_" + id).val(state);
            modal_open("state_update_" + id);
        }

        function stateChange(id) {
            let state = $("#state_update_" + id).val();
            $.ajax({
                    url: '{{ route('www.mypage.product.state.change') }}',
                    type: "post",
                    data: {
                        'id': id,
                        'state': state
                    }
                })
                .done(function(data) {
                    loadMoreData($('#productListPage').val(), $('#productListType').val());
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('데이터를 불러오지 못했습니다.');
                });

        }
    </script>

</x-layout>
