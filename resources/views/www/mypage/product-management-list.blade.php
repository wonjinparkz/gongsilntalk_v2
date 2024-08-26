<x-layout>

    <!-- m::header bar : s -->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">마이페이지</div>
        <div class="right_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_alarm.png') }}"></a></div>
    </div>
    <!-- m::header bar : s -->

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
                                등록요청<span>{{ number_format(isset($countList->request_count) ? $countList->request_count : 0) }}</span>
                            </li>
                            <li onclick="loadMoreData(1, 1);">
                                등록완료<span>{{ number_format(isset($countList->transactions_count) ? $countList->transactions_count : 0) }}</span>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <div class="my_search_wrap only_pc">
                            <div class="sort_wrap">
                                <div class="dropdown_box">
                                    <button class="dropdown_label" data-initial-title="거래 유형">거래 유형</button>
                                    <ul class="optionList">
                                        <li class="optionItem" onclick="onPaymentTypeChange('');">전체</li>
                                        @foreach (Lang::get('commons.payment_type') as $key => $payment_type)
                                            <li class="optionItem"
                                                onclick="onPaymentTypeChange('{{ $key }}');">
                                                {{ $payment_type }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="dropdown_box">
                                    <button class="dropdown_label" data-initial-title="매물 종류">매물 종류</button>
                                    <ul class="optionList">
                                        <li class="optionItem" onclick="onProductTypeChange('');">전체</li>
                                        @foreach (Lang::get('commons.product_type') as $key => $product_type)
                                            <li class="optionItem"
                                                onclick="onProductTypeChange('{{ $key }}');">
                                                {{ $product_type }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="search_wrap">
                                <input type="text" id="searchText" name="searchText" placeholder="매물번호/주소로 검색">
                                <button type="button" onclick="onSearchTextChange();"><img
                                        src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
                            </div>
                        </div>

                        <!-- M::filter : s -->
                        <div class="mt18 only_m">
                            <div class="m_dropdown_double_wrap">
                                <button class="btn_dropdown" onclick="modal_open_slide('transaction_type')">거래
                                    유형</button>
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
                                <li onclick="onPaymentTypeChange('');"><a href="#">전체</a></li>
                                @foreach (Lang::get('commons.payment_type') as $key => $payment_type)
                                    <li onclick="onPaymentTypeChange('{{ $key }}');">
                                        <a href="#">{{ $payment_type }}</a></li>
                                @endforeach
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
                                <li onclick="onProductTypeChange('');"><a href="#">전체</a></li>
                                @foreach (Lang::get('commons.product_type') as $key => $product_type)
                                    <li onclick="onProductTypeChange('{{ $key }}');">
                                        <a href="#">{{ $product_type }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="md_slide_overlay md_slide_overlay_estate_kind"
                            onclick="modal_close_slide('estate_kind')"></div>
                        <!-- M::filter : e -->

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
        <input type="hidden" id="productType" name="productType" value="">
        <input type="hidden" id="paymentType" name="paymentType" value="">
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
        $.ajax({
                url: '{{ route('www.mypage.product.magagement.main.view') }}',
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
</script>
