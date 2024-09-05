@if ($type == 0)

    <!-- 일반매물 : s -->
    <div>

        @if ($result->total() < 1)
            <!-- 데이터가 없을 경우 : s -->
            <div class="empty_wrap">
                <p>등록한 매물이 없습니다.</p>
                <span>매물을 등록하고 간편하게 관리해보세요.</span>
            </div>
            <!-- 데이터가 없을 경우 : e -->
        @else
            <table class="table_basic mt20">
                <colgroup>
                    <col width="50">
                    <col width="100">
                    <col width="80">
                </colgroup>
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkAll" id="checkAll">
                            <label for="checkAll"><span></span></label>
                        </th>
                        <th>매물번호</th>
                        <th>사진</th>
                        <th>매물 종류</th>
                        <th>주소</th>
                        <th>면적 <button class="inner_change_button sizeBtnEvent" type="button" onclick="sizeChange();">
                                <img src="{{ asset('assets/media/ic_change.png') }}"> <span
                                    class="txt_unit sizeBtn">평</span>
                            </button>
                        </th>
                        <th>거래정보</th>
                        <th>관리</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($result) > 0)
                        @foreach ($result as $product)
                            <tr>
                                <td class="td_center">
                                    <input type="checkbox" name="checkOne" id="checkOne_{{ $product->id }}"
                                        class="chkbox" value="{{ $product->id }}">
                                    <label for="checkOne_{{ $product->id }}"><span></span></label>
                                </td>
                                <td><span class="gray_deep">{{ $product->product_number }}</span></td>
                                <td>
                                    <div class="list_thumb_1">
                                        <div class="img_box">
                                            @if (count($product->images) > 0)
                                                <img src="{{ Storage::url('image/' . $product->images[0]->path) }}">
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ Lang::get('commons.product_type.' . $product->type) }}</td>
                                <td>
                                    {{ $product->address . ' ' . $product->address_detail }}
                                </td>
                                <td class="square">
                                    {{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                                    {{ $product->square }}㎡<br>{{ $product->type != 7 ? '전용 ' . $product->exclusive_square : '' }}㎡
                                </td>
                                <td class="area" style="display: none">
                                    {{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                                    {{ $product->area }}평<br>{{ $product->type != 7 ? '전용' . $product->exclusive_area : '' }}평
                                </td>
                                <td>{{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}<br>
                                    {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                                    {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                                </td>
                                <td><button class="btn_gray_ghost btn_sm" type="button"
                                        onclick="modal_open('delete_{{ $product->id }}')">삭제</button></td>
                            </tr>

                            <!-- modal 삭제 : s -->
                            <div class="modal modal_delete_{{ $product->id }}">

                                <div class="modal_container">
                                    <div class="modal_mss_wrap">
                                        <p class="txt_item_1 txt_point">
                                            {{ $product->address }} <br>
                                            {{ Lang::get('commons.product_type.' . $product->type) }}
                                            {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                                            {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                                            {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                                        </p>
                                        <p class="txt_item_1">매물을 삭제하시겠습니까?</p>
                                        <p class="mt8 txt_item_2">삭제 후에는 되돌릴 수 없습니다.</p>
                                    </div>

                                    <div class="modal_btn_wrap">
                                        <button class="btn_gray btn_full_thin" type="button"
                                            onclick="modal_close('delete_{{ $product->id }}')">취소</button>
                                        <button class="btn_point btn_full_thin" type="button"
                                            onclick="onDelete('{{ $product->id }}');">삭제</button>
                                    </div>
                                </div>

                            </div>
                            <div class="md_overlay md_overlay_delete_{{ $product->id }}"
                                onclick="modal_close('delete_{{ $product->id }}')"></div>
                            <!-- modal 삭제 : e -->
                        @endforeach
                    @endif
                </tbody>
            </table>


            <!-- paging : s -->
            {{ $result->onEachSide(1)->links('components.pc-my-page-interest-pagination') }}
            <!-- paging : e -->

        @endif

    </div>
    <!-- 일반매물 : e -->
@else
    <!--  분양매물 : s -->
    <div>
        @if ($result->total() < 1)
            <!-- 데이터가 없을 경우 : s -->
            <div class="empty_wrap">
                <p>등록한 매물이 없습니다.</p>
                <span>매물을 등록하고 간편하게 관리해보세요.</span>
            </div>
            <!-- 데이터가 없을 경우 : e -->
        @else
            <table class="table_basic mt20">
                <colgroup>
                    <col width="50">
                    <col width="100">
                    <col width="80">
                </colgroup>
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkAll" id="checkAll">
                            <label for="checkAll"><span></span></label>
                        </th>
                        <th>매물번호</th>
                        <th>사진</th>
                        <th>매물 종류</th>
                        <th>주소</th>
                        <th>면적 <button class="inner_change_button sizeBtnEvent" type="button" onclick="sizeChange();">
                                <img src="{{ asset('assets/media/ic_change.png') }}"> <span
                                    class="txt_unit sizeBtn">평</span>
                            </button>
                        </th>
                        <th>거래정보</th>
                        <th>관리</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($result) > 0)
                        @foreach ($result as $product)
                            <tr>
                                <td class="td_center">
                                    <input type="checkbox" name="checkOne" id="checkOne_{{ $product->id }}"
                                        class="chkbox" value="{{ $product->id }}">
                                    <label for="checkOne_{{ $product->id }}"><span></span></label>
                                </td>
                                <td><span class="gray_deep">{{ $product->product_number }}</span></td>
                                <td>
                                    <div class="list_thumb_1">
                                        <div class="img_box">
                                            <img src="{{ Storage::url('image/' . $product->images[0]->path) }}">
                                        </div>
                                    </div>
                                </td>
                                <td>{{ Lang::get('commons.product_type.' . $product->type) }}</td>
                                <td>
                                    {{ $product->address . ' ' . $product->address_detail }}
                                </td>
                                <td class="square">
                                    {{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                                    {{ $product->square }}㎡
                                    @if ($product->exclusive_square > 0)
                                        <br> {{ $product->type != 7 ? '전용 ' . $product->exclusive_square : '' }}㎡
                                    @endif
                                </td>
                                <td class="area" style="display: none">
                                    {{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                                    {{ $product->area }}평
                                    @if ($product->exclusive_area > 0)
                                        <br> {{ $product->type != 7 ? '전용 ' . $product->exclusive_area : '' }}평
                                    @endif
                                </td>
                                <td>{{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}<br>
                                    {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                                    {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                                </td>
                                <td><button class="btn_gray_ghost btn_sm" type="button"
                                        onclick="modal_open('delete_{{ $product->id }}')">삭제</button></td>
                            </tr>

                            <!-- modal 삭제 : s -->
                            <div class="modal modal_delete_{{ $product->id }}">

                                <div class="modal_container">
                                    <div class="modal_mss_wrap">
                                        <p class="txt_item_1 txt_point">
                                            {{ $product->address }} <br>
                                            {{ Lang::get('commons.product_type.' . $product->type) }}
                                            {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                                            {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                                            {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                                        </p>
                                        <p class="txt_item_1">매물을 삭제하시겠습니까?</p>
                                        <p class="mt8 txt_item_2">삭제 후에는 되돌릴 수 없습니다.</p>
                                    </div>

                                    <div class="modal_btn_wrap">
                                        <button class="btn_gray btn_full_thin" type="button"
                                            onclick="modal_close('delete_{{ $product->id }}')">취소</button>
                                        <button class="btn_point btn_full_thin" type="button"
                                            onclick="onDelete('{{ $product->id }}');">삭제</button>
                                    </div>
                                </div>

                            </div>
                            <div class="md_overlay md_overlay_delete_{{ $product->id }}"
                                onclick="modal_close('delete_{{ $product->id }}')"></div>
                            <!-- modal 삭제 : e -->
                        @endforeach
                    @endif
                </tbody>
            </table>
            <!-- paging : s -->
            {{ $result->onEachSide(1)->links('components.pc-my-page-recently-pagination') }}
            <!-- paging : e -->
        @endif
    </div>
    <!--  분양매물 : e -->

@endif

<script>
    $("input[name=checkAll]").click(function() {
        if ($(this).is(":checked") === true)
            $("input[name=checkOne]").prop("checked", true);
        else
            $("input[name=checkOne]").prop("checked", false);
    });
</script>
