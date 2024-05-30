<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">내 자산 관리</div>
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
                <div class="my_body">
                    <div class="inner_wrap m_inner_wrap">
                        <h1 class="t_center only_pc">내 자산 관리</h1>

                        <div class="asset_dashboard_wrap">
                            <div class="ds_item_1">
                                <div class="detail_open_wrap">
                                    <label>총 자산 현황</label>
                                    <button class="simple_toggle_trigger only_m"><img
                                            src="{{ asset('assets/media/dropdown_arrow.png') }}"
                                            class="w_100"></button>
                                </div>

                                <h1>{{ number_format($addressData->price) }}원</h1>
                                <ul class="main_price_wrap">
                                    <li>실투자금<p>{{ number_format($addressData->price - $addressData->loan_price) }}원</p>
                                    </li>
                                    @php
                                        $monthProfitPrice = 0;
                                    @endphp
                                    <li>월순수익<p id="monthProfit">27,750,000원 <span>(14.08%)</span></p>
                                    </li>
                                </ul>
                                <div class="detail_price_wrap simple_toggle_layer">
                                    <ul class="detail_price">
                                        <li>임대 보증금<p>{{ number_format($addressData->check_price) }}원</p>
                                        </li>
                                        <li>월임대료<p>{{ number_format($addressData->month_price) }}원</p>
                                        </li>
                                    </ul>
                                    <hr>
                                    <ul class="detail_price">
                                        <li>총 대출금액<p>{{ number_format($addressData->loan_price) }}원</p>
                                        </li>
                                        <li>총 대출이자<p>{{ number_format($addressData->loan_rate_price) }}원</p>
                                        </li>
                                    </ul>
                                    <hr>
                                    <ul class="detail_price">
                                        <li>취득세<p>{{ number_format($addressData->price * 0.4) }}원</p>
                                        </li>
                                        <li>기타비용<p>
                                                {{ number_format($addressData->etc_price) }}원
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="ds_item_2">
                                <div>임대 보증금</div>
                                <div>{{ number_format($addressData->check_price) }}원</div>
                                <div>월임대료</div>
                                <div>{{ number_format($addressData->month_price) }}원</div>
                                <div>총 대출금액</div>
                                <div>{{ number_format($addressData->loan_price) }}원</div>
                                <div>총 대출이자</div>
                                <div>{{ number_format($addressData->loan_rate_price) }}원</div>
                                <div>취득세</div>
                                <div>{{ number_format($addressData->price * 0.4) }}원</div>
                                <div>기타비용</div>
                                <div>
                                    {{ number_format($addressData->etc_price) }}원
                                </div>
                            </div>

                        </div>

                        <div class="flex_between my_body_top only_pc">
                            <h1>내 자산 목록</h1>
                            <button class="btn_point btn_sm"
                                onclick="location.href='{{ route('www.mypage.service.create.first.view') }}'">신규 자산
                                등록</button>
                        </div>

                        <!-- 데이터가 없을 경우 : s -->
                        @if (count($addressList) < 1)
                            <div class="empty_wrap">
                                <p>등록한 자산이 없습니다.</p>
                                <span>자산을 등록하고 간편하게 관리해보세요.</span>
                            </div>
                        @endif
                        <!-- 데이터가 없을 경우 : e -->

                        <!-- Only PC list : s -->
                        @foreach ($addressList as $address)
                            <div class="box_01 only_pc addressBox{{ $address->id }}">
                                <div class="asset_top_row">
                                    <h4>{{ $address->address }}</h4>
                                    <button class="btn_graylight_ghost btn_sm"
                                        onclick="modal_open('asset_delete_{{ $address->id }}')">삭제</button>
                                </div>
                                <p class="asset_row_total">총 {{ count($address->asset) }}개</p>
                                <table class="table_basic mt10">
                                    <colgroup>
                                        <col width="60">
                                        <col width="*">
                                        <col width="120">
                                        <col width="120">
                                        <col width="150">
                                        <col width="120">
                                        <col width="120">
                                        <col width="100">
                                        <col width="30">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>번호</th>
                                            <th>상세주소</th>
                                            <th>부동산 유형</th>
                                            <th>전용면적
                                                <button class="inner_change_button sizeBtnEvent{{ $address->id }}"
                                                    type="button" onclick="sizeChange('{{ $address->id }}');">
                                                    <img src="{{ asset('assets/media/ic_change.png') }}">
                                                    <span class="txt_unit sizeBtn{{ $address->id }}">평</span>
                                                </button>
                                            </th>
                                            <th>보증금</th>
                                            <th>월임대료 </th>
                                            <th>월순수익</th>
                                            <th>수익률</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($address->asset as $key => $asset)
                                            @php
                                                $acquisition_tax_price =
                                                    $asset->price * ($asset->acquisition_tax_rate / 100);
                                                $etc_price =
                                                    $asset->etc_price + $asset->tax_price + $asset->estate_price;
                                                $realPrice =
                                                    $asset->price +
                                                    $acquisition_tax_price +
                                                    $etc_price -
                                                    $asset->loan_price -
                                                    $asset->check_price;

                                                $myPrice =
                                                    $asset->month_price -
                                                    ($asset->loan_price * ($asset->loan_rate / 100)) / 12;
                                            @endphp
                                            <tr class="cursor_pointer"
                                                onclick="location.href='{{ route('www.mypage.service.detail.view', [$asset->id]) }}'">
                                                <td>{{ $key + 1 }}</td>
                                                @php
                                                    $address_detail = isset($asset->address_dong)
                                                        ? $asset->address_dong . '동 '
                                                        : '';
                                                    $address_detail .= $asset->address_detail . '호';
                                                @endphp
                                                <td>{{ $asset->is_temporary == 0 ? $address_detail : $asset->address_detail }}
                                                </td>
                                                <td>{{ Lang::get('commons.product_type.' . $asset->type_detail) }}</td>
                                                <td class="square_{{ $address->id }}">{{ $asset->exclusive_square }}㎡
                                                </td>
                                                <td class="area_{{ $address->id }}" style="display:none;">
                                                    {{ $asset->exclusive_area }}평
                                                </td>
                                                <td>{{ number_format($asset->check_price) }}원</td>
                                                <td>{{ number_format($asset->month_price) }}원</td>
                                                <td><span class="txt_point">{{ number_format($myPrice) }}원</span>
                                                </td>
                                                <td><span
                                                        class="txt_point">{{ round(($myPrice / $realPrice) * 100, 2) }}%</span>
                                                </td>
                                                <td><img src="{{ asset('assets/media/ic_list_arrow.png') }}"
                                                        class="w_8p">
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                        <!-- Only PC list : e -->

                    </div>

                    @php
                        $monthProfitRate = 0;
                        $price_1 = isset($monthProfitPrice) ? $monthProfitPrice : 1;
                        $price_2 = isset($addressData->price) ? $addressData->price : 1;
                        $monthProfitRate = round($price_1 / $price_2, 2);
                    @endphp


                    <!----------------------- m:: s ----------------------->
                    <div class="m_asset_reg only_m"
                        onclick="location.href='{{ route('www.mypage.service.create.first.view') }}'">
                        <div class="fs_16"><img src="{{ asset('assets/media/ic_org_estate.png') }}" class="ic_estate">
                            신규 자산 등록</div>
                        <i><img src="{{ asset('assets/media/ic_list_arrow.png') }}"></i>
                    </div>
                    @foreach ($addressList as $address)
                        <div class="m_asset_wrap only_m addressBox{{ $address->id }}">
                            <div>
                                <div class="m_asset_top">
                                    <h5>{{ $address->address }}</h5>
                                    <button class="btn_graylight_ghost btn_sm"
                                        onclick="modal_open('asset_delete_{{ $address->id }}')">삭제</button>
                                </div>
                                <p class="asset_row_total">총 {{ count($address->asset) }}개</p>
                            </div>
                            <ul class="m_asset_list">
                                @foreach ($address->asset as $key => $asset)
                                    @php
                                        $acquisition_tax_price = $asset->price * ($asset->acquisition_tax_rate / 100);
                                        $etc_price = $asset->etc_price + $asset->tax_price + $asset->estate_price;
                                        $realPrice =
                                            $asset->price +
                                            $acquisition_tax_price +
                                            $etc_price -
                                            $asset->loan_price -
                                            $asset->check_price;

                                        $myPrice =
                                            $asset->month_price - ($asset->loan_price * ($asset->loan_rate / 100)) / 12;
                                    @endphp
                                    <li class="accordion">
                                        <p class="trigger">
                                            {{ $asset->address_dong }} {{ $asset->address_detail }}
                                            <img src="{{ asset('assets/media/dropdown_arrow.png') }}"
                                                class="dropdown_arrow">
                                        </p>
                                        <div class="m_asset_detail_row panel">
                                            <div class="list_detail_item">보증금 <span
                                                    class="gray_deep">{{ number_format($asset->check_price) }}원</span>
                                            </div>
                                            <div class="list_detail_item">월임대료 <span
                                                    class="gray_deep">{{ number_format($asset->month_price) }}원</span>
                                            </div>
                                            <div class="list_detail_item">월순수익 <span
                                                    class="txt_point">{{ number_format($myPrice) }}원</span>
                                            </div>
                                            <div class="list_detail_item">수익률 <span
                                                    class="txt_point">{{ round(($myPrice / $realPrice) * 100, 2) }}%</span>
                                            </div>
                                            <button class="btn_graylight_ghost btn_sm_full mt10"
                                                onclick="location.href='{{ route('www.mypage.service.detail.view', [$asset->id]) }}'">자세히보기</button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    <!----------------------- m:: e ----------------------->
                </div>
                <!-- my_body : e -->

                <!-- modal 삭제 : s -->
                @foreach ($addressList as $address)
                    <div class="modal modal_asset_delete_{{ $address->id }}">
                        <div class="modal_container">
                            <div class="modal_mss_wrap">
                                <p class="txt_item_1 txt_point">{{ $address->address }}</p>
                                <p class="txt_item_1">자산 목록을 삭제하시겠습니까?</p>
                                <p class="mt8 txt_item_2">삭제 후에는 되돌릴 수 없습니다.</p>
                            </div>

                            <div class="modal_btn_wrap">
                                <button class="btn_gray btn_full_thin"
                                    onclick="modal_close('asset_delete_{{ $address->id }}')">취소</button>
                                <button class="btn_point btn_full_thin"
                                    onclick="addressDelete('{{ $address->id }}')">삭제</button>
                            </div>
                        </div>

                    </div>
                    <div class="md_overlay md_overlay_asset_delete_{{ $address->id }}"
                        onclick="modal_close('asset_delete_{{ $address->id }}')"></div>
                @endforeach
                <!-- modal 삭제 : e -->

            </div>

        </div>

    </div>
    <script>
        document.getElementById('monthProfit').innerText =
            "{{ number_format($monthProfitPrice) }}원 ({{ number_format($monthProfitRate) }}%)";

        // 평 변환
        function sizeChange(id) {

            let squareText = '';
            let areaText = '';

            const btnInfo = document.querySelector(".sizeBtn" + id);
            const button = document.querySelector(".sizeBtnEvent" + id);


            if (btnInfo.textContent === "평") {
                btnInfo.textContent = "㎡";
                squareText = 'none';
                areaText = 'block';
            } else {
                btnInfo.textContent = "평";
                squareText = 'block';
                areaText = 'none';
            }

            const squareList = document.querySelectorAll(".square_" + id);
            const areaList = document.querySelectorAll(".area_" + id);

            squareList.forEach(element => {
                element.style.display = squareText;
            });
            areaList.forEach(element => {
                element.style.display = areaText;
            });
        }

        // 주소 삭제
        function addressDelete(id) {

            $.ajax({
                type: "POST",
                url: "{{ route('www.mypage.service.delete') }}",
                data: {
                    'id': id
                },
                success: function(result) {
                    const boxList = document.querySelectorAll(".addressBox" + id);

                    boxList.forEach(element => {
                        element.style.display = "none";
                    });
                    modal_close('asset_delete_' + id);

                    location.reload();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("다시 시도해주세요.")
                }
            });
        }
    </script>

</x-layout>
