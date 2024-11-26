@if ($result->total() < 1)
    <!-- 데이터가 없을 경우 : s -->
    <div class="empty_wrap">
        <p>등록한 매물이 없습니다.</p>
        <span>매물을 등록하고 간편하게 관리해보세요.</span>
    </div>
    <!-- 데이터가 없을 경우 : e -->
@else
    <!-- Only PC list : s -->
    <table class="table_basic mt20 only_pc">
        <colgroup>
            <col width="40">
            <col width="110">
            <col width="110">
            <col width="80">
            <col width="120">
            <col width="*">
            <col width="120">
            <col width="130">
            <col width="180">
            <col width="130">
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
                <th>면적 <button class="inner_change_button sizeBtnEvent" type="button" onclick="sizeChange();"><img
                            src="{{ asset('assets/media/ic_change.png') }}"> <span
                            class="txt_unit sizeBtn">평</span></button>
                </th>
                <th>거래정보</th>
                <th>비공개 메모</th>
                <th>관리</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($result as $product)
                <tr>
                    <td class="td_center">
                        <input type="checkbox" name="checkOne" id="checkOne_{{ $product->id }}"
                            value="{{ $product->id }}">
                        <label for="checkOne_{{ $product->id }}"><span></span></label>
                    </td>
                    <td><span class="gray_deep">{{ $product->product_number }}</span></td>
                    <td>
                        @if ($product->state == 1 || $product->state == 3)
                            <div class="dropdown_box s_xs" onclick="openList(this);">
                                <button
                                    class="dropdown_label">{{ Lang::get('commons.product_state.' . $product->state) }}</button>
                                <ul class="optionList">
                                    <li class="optionItem" onclick="stateChangeModal('{{ $product->id }}', 1);">거래중
                                    </li>
                                    <li class="optionItem" onclick="stateChangeModal('{{ $product->id }}', 2);">거래완료
                                    </li>
                                    <li class="optionItem" onclick="stateChangeModal('{{ $product->id }}', 3);">비공개
                                    </li>
                                </ul>
                            </div>
                        @elseif ($product->state == 2)
                            <p>{{ Lang::get('commons.product_state.' . $product->state) }}</p>
                        @else
                            <p class="txt_point">{{ Lang::get('commons.product_state.' . $product->state) }}</p>
                        @endif
                    </td>
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
                        <a href="{{ route('www.map.room.detail', [$product->id]) }}"
                            style="text-decoration: underline;">{{ $product->address . ' ' . $product->address_detail }}</a>
                    </td>
                    <td class="square">{{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                        {{ $product->square }}㎡<br>
                        @if ($product->exclusive_square > 0)
                            {{ $product->type != 7 ? '전용 ' . $product->exclusive_square : '' }}㎡
                        @endif
                    </td>
                    <td class="area" style="display: none">
                        {{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                        {{ $product->area }}평
                        @if ($product->exclusive_area > 0)
                            <br> {{ $product->type != 7 ? '전용' . $product->exclusive_area : '' }}평
                        @endif
                    </td>
                    <td>{{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}<br>
                        {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                        {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                    </td>
                    <td>
                        <div class="txt_memo">
                            @if ($product->non_memo == '')
                                <p class="txt_item">등록된 메모가 없습니다.</p>
                            @else
                                {{ $product->non_memo }}
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="gap_8">
                            @if ($product->state < 4)
                                @if ($product->state != 2)
                                    <button class="btn_gray_ghost btn_sm"
                                        onclick="location.href='{{ route('www.mypage.corp.product.magagement.update.view', [$product->id]) }}'">수정</button>
                                @endif
                            @else
                                <button class="btn_gray_ghost btn_sm"
                                    onclick="location.href='{{ route('www.corp.proudct.re.register', [$product->id]) }}'">재등록</button>
                            @endif
                            <button class="btn_gray_ghost btn_sm" type="button"
                                onclick="modal_open('asset_delete_{{ $product->id }}')">삭제</button>
                        </div>

                    </td>
                </tr>

                <!-- modal 삭제 : s -->
                <div class="modal modal_asset_delete_{{ $product->id }}">
                    <div class="modal_container">
                        <div class="modal_mss_wrap">
                            <p class="txt_item_1 txt_point"> {{ $product->address }} <br>
                                {{ Lang::get('commons.product_type.' . $product->type) }}
                                {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                                {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                                {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                            </p>
                            <p class="txt_item_1">매물을 삭제하시겠습니까?</p>
                            <p class="mt8 txt_item_2">매물 미노출을 원할 시, 비공개 기능을 이용해보세요.</p>
                        </div>

                        <div class="modal_btn_wrap">
                            <button class="btn_gray btn_full_thin"
                                onclick="modal_close('asset_delete_{{ $product->id }}')">취소</button>
                            <button class="btn_point btn_full_thin"
                                onclick="onDelete('{{ $product->id }}');">삭제</button>
                        </div>
                    </div>

                </div>
                <div class="md_overlay md_overlay_asset_delete_{{ $product->id }}"
                    onclick="modal_close('asset_delete_{{ $product->id }}')"></div>
                <!-- modal 삭제 : e -->

                <!-- modal 상태수정 : s -->
                <div class="modal modal_state_update_{{ $product->id }}">
                    <div class="modal_container">
                        <div class="modal_mss_wrap">
                            <p class="txt_item_1 txt_point"> {{ $product->address }} <br>
                                {{ Lang::get('commons.product_type.' . $product->type) }}
                                {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                                {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                                {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                            </p>
                            <p class="txt_item_1">매물 상태를 수정하시겠습니까?</p>
                        </div>

                        <div class="modal_btn_wrap">
                            <button class="btn_gray btn_full_thin"
                                onclick="modal_close('state_update_{{ $product->id }}')">취소</button>
                            <button class="btn_point btn_full_thin"
                                onclick="stateChange('{{ $product->id }}');modal_close('state_update_{{ $product->id }}');">수정</button>
                            <input hidden id="state_update_{{ $product->id }}" value="">
                        </div>
                    </div>

                </div>
                <div class="md_overlay md_overlay_state_update_{{ $product->id }}"
                    onclick="modal_close('state_update_{{ $product->id }}')"></div>
                <!-- modal 상태수정 : e -->
            @endforeach
        </tbody>
    </table>

    <!-- paging : s -->
    {{ $result->onEachSide(1)->links('components.pc-my-page-pagination') }}
    <!-- paging : e -->

    <!-- Only PC list : e -->

    <!----------------------------- Only M list : s ----------------------------->
    <ul class="list_m_basic only_m mt8">
        @foreach ($result as $product)
            <li>
                <div class="flex_between">
                    <div>
                        <input type="checkbox" name="mobile_checkOne" id="mobile_checkOne_{{ $product->id }}"
                            value="{{ $product->id }}">
                        <label for="mobile_checkOne_{{ $product->id }}"><span></span></label>
                        <span class="gray_deep">매물번호 {{ $product->product_number }}</span>
                    </div>
                    @if ($product->state < 4)
                        <button class="btn_gray_ghost btn_sm"
                            onclick="location.href='{{ route('www.mypage.corp.product.magagement.update.view', [$product->id]) }}'">수정</button>
                    @else
                        <button class="btn_gray_ghost btn_sm"
                            onclick="location.href='{{ route('www.corp.proudct.re.register', [$product->id]) }}'">재등록</button>
                    @endif
                    <button class="btn_gray_ghost btn_sm"
                        onclick="modal_open('asset_delete_{{ $product->id }}')">삭제</button>
                </div>
                <div class="list_m_cnt">
                    <div class="list_thumb_1">
                        <a href="{{ route('www.map.room.detail', [$product->id]) }}">
                            <div class="img_box">
                                @if (count($product->images) > 0)
                                    <img src="{{ Storage::url('image/' . $product->images[0]->path) }}">
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="list_view">
                        <p class="tit">{{ Lang::get('commons.product_type.' . $product->type) }}</p>
                        <p class="summary">
                            {{ $product->address . ' ' . $product->address_detail }}
                        </p>
                        <p class="txt_item_1">{{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                            {{ $product->square }}㎡
                            @if ($product->exclusive_square > 0)
                                / {{ $product->type != 7 ? '전용 ' . $product->exclusive_square : '' }}㎡
                            @endif
                        </p>
                        <p class="txt_item_2">
                            {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                            {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                            {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                        </p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    <!----------------------------- Only M list : e ----------------------------->
@endif



<script>
    function openList(elem) {
        if (elem.className == 'dropdown_box s_xs') {
            elem.className += ' active';
        } else {
            elem.className = 'dropdown_box s_xs';
        }
    }

    $("input[name=checkAll]").click(function() {
        if ($(this).is(":checked") === true)
            $("input[name=checkOne]").prop("checked", true);
        else
            $("input[name=checkOne]").prop("checked", false);
    });
</script>
