<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area">
            <a href="javascript:history.go(-1)">
                <img src="{{ asset('assets/media/header_btn_back.png') }}">
            </a>
        </div>
        <div class="m_title">관심 매물</div>
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
                    <h1 class="t_center only_pc">관심 매물</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5 toggle_tab">
                            <li onclick="location.href='my_wish_list.html'" class="active">관심 매물</li>
                            <li onclick="location.href='my_recently.html'">최근 본 매물</li>
                        </ul>
                    </div>

                    <div class="wish_wrap">
                        <ul class="tab_type_6 tab_toggle_menu mt28">
                            <li class="active" onclick="loadMoreData(1, 0);">일반매물</li>
                            <li class="" onclick="loadMoreData(1, 1);">분양매물</li>
                        </ul>
                    </div>

                    <div class="my_search_wrap mt20 optionSelectBox" style="display: block;">
                        <div class="sort_wrap">
                            <div class="dropdown_box">
                                <button
                                    class="dropdown_label">{{ Request::get('payment_type') != '' ? Lang::get('commons.payment_type.' . Request::get('payment_type')) : '거래 유형' }}</button>
                                <ul class="optionList">
                                    <li class="optionItem" onclick="onPaymentTypeChange('');">전체</li>
                                    @foreach (Lang::get('commons.payment_type') as $key => $payment_type)
                                        <li class="optionItem" onclick="onPaymentTypeChange('{{ $key }}');">
                                            {{ $payment_type }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="dropdown_box">
                                <button
                                    class="dropdown_label">{{ Request::get('product_type') != '' ? Lang::get('commons.product_type.' . Request::get('product_type')) : '매물 종류' }}</button>
                                <ul class="optionList">
                                    <li class="optionItem" onclick="onProductTypeChange('');">전체</li>
                                    @foreach (Lang::get('commons.product_type') as $key => $product_type)
                                        <li class="optionItem" onclick="onProductTypeChange('{{ $key }}');">
                                            {{ $product_type }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="payment_type" name="payment_type" value="{{ Request::get('payment_type') }}">
                    <input type="hidden" id="product_type" name="product_type" value="{{ Request::get('product_type') }}">

                    <div class="tab_area_wrap">

                    </div>

                </div>
                <!-- my_body : e -->

            </div>

        </div>

    </div>

</x-layout>

<script>
    var onProductTypeChange = (index) => {
        $('#product_type').val(index);

        loadMoreData(1, 0);
    }

    var onPaymentTypeChange = (index) => {
        $('#payment_type').val(index);

        loadMoreData(1, 0);
    }

    var onLikeStateChange = (id, type) => {

        $.ajax({
            url: '{{ route('www.commons.like') }}',
            type: "post",
            data: {
                'target_id': id,
                'target_type': type
            }
        }).fail(function(jqXHR, ajaxOptions, thrownError) {
            alert('다시 시도해주세요.');
        });
    }

    loadMoreData(1, 0);

    function loadMoreData(page, type) {

        $.ajax({
                url: '{{ route('www.mypage.product.interest.list.view') }}',
                type: "get",
                data: {
                    'page': page,
                    'type': type,
                    'product_type': $('#product_type').val(),
                    'payment_type': $('#payment_type').val(),
                }
            })
            .done(function(data) {
                if (type == 1) {
                    $('.optionSelectBox').css('display', 'none');
                }else{
                    $('.optionSelectBox').css('display', 'block');
                }

                $(".tab_area_wrap").html(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('데이터를 불러오지 못했습니다.');
            });
    }
</script>
