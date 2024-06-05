<x-layout>
    @php
        function priceChange($price)
        {
            if ($price < 0 || empty($price)) {
                $price = 0;
            }

            $priceUnit = ['원', '만', '억', '조', '경'];
            $expUnit = 10000;
            $resultArray = [];
            $result = '';

            foreach ($priceUnit as $k => $v) {
                $unitResult = ($price % pow($expUnit, $k + 1)) / pow($expUnit, $k);
                $unitResult = floor($unitResult);

                if ($unitResult > 0) {
                    $resultArray[$k] = $unitResult;
                }
            }

            if (count($resultArray) > 0) {
                foreach ($resultArray as $k => $v) {
                    $result = $v . $priceUnit[$k] . ' ' . $result;
                }
            }

            return $result;
        }
    @endphp
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
                <div class="my_body">
                    <div class="inner_wrap m_inner_wrap">
                        <h1 class="t_center only_pc">기업 이전 제안서</h1>

                        <div class="company_name">
                            <h3>{{ $corpInfo->corp_name }}</h3>
                            <button><img src="{{ asset('assets/media/ic_pen.png') }}" class="w_20p"
                                    onclick="modal_open('modify')"></button>
                        </div>

                        @if (count($proposal) < 1)
                            <!-- 데이터가 없을 경우 : s -->
                            <div class="empty_wrap">
                                <p>작성한 제안 건물이 없습니다.</p>
                                <span>제안하고자 하는 건물을 추가하고, 제안서 작성을 완료해주세요.</span>
                            </div>
                            <!-- 데이터가 없을 경우 : e -->
                        @else
                            <!-- Only PC list : s -->
                            @foreach ($proposal as $address)
                                <div class="proposal_group">
                                    <p class="group_tit">{{ $address->city }}</p>
                                    <table class="table_basic only_pc">
                                        <colgroup>
                                            <col width="60">
                                            <col width="150">
                                            <col width="*">
                                            <col width="150">
                                            <col width="200">
                                            <col width="120">
                                            <col width="140">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th>번호</th>
                                                <th>건물명</th>
                                                <th>주소</th>
                                                <th>면적 <button
                                                        class="inner_change_button sizeBtnEvent{{ $address->id }}"
                                                        type="button" onclick="sizeChange('{{ $address->id }}');">
                                                        <img src="{{ asset('assets/media/ic_change.png') }}">
                                                        <span
                                                            class="txt_unit sizeBtn{{ $address->id }}">평</span></button>
                                                </th>
                                                <th>거래정보</th>
                                                <th>층정보</th>
                                                <th>관리</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($address->products as $index => $product)
                                                <tr>
                                                    <td class="td_center">{{ $index + 1 }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->address }}</td>

                                                    <td class="square_{{ $address->id }}">
                                                        {{ $product->exclusive_area }}㎡</td>
                                                    <td class="area_{{ $address->id }}" style="display:none;">
                                                        {{ $product->exclusive_square }}평</td>

                                                    <td>{{ Lang::get('commons.payment_type.' . $product->price->payment_type) }}
                                                        @if ($product->price->payment_type == 4)
                                                            {{ priceChange($product->price->price) }} /
                                                            {{ priceChange($product->price->month_price) }}원
                                                        @else
                                                            {{ priceChange($product->price->price) }}원
                                                        @endif
                                                    </td>
                                                    <td>{{ $product->floor_number }}층/{{ $product->total_floor_number }}층
                                                    </td>
                                                    <td>
                                                        <button class="btn_gray_ghost btn_sm">수정</button>
                                                        <button class="btn_gray_ghost btn_sm">삭제</button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <!-- Only PC list : e -->
                            @endforeach
                    </div>

                    <!----------------------- m:: s ----------------------->
                    <div class="m_inner_wrap only_m">
                        <ul class="m_asset_list">
                            <li class="accordion">
                                <p class="trigger">
                                    영등포 양평자이타워
                                    <img src="{{ asset('assets/media/dropdown_arrow.png') }}" class="dropdown_arrow">
                                </p>
                                <div class="m_asset_detail_row panel">
                                    <div class="list_detail_item">주소 <span class="gray_deep">양평동1가 104-1</span></div>
                                    <div class="list_detail_item">층정보 <span class="gray_deep">13/20층</span></div>
                                    <div class="list_detail_item">전용면적 <span class="gray_deep">1234.12평</span></div>
                                    <div class="list_detail_item">거래정보 <span class="txt_point">매매 14억 2,000만</span>
                                    </div>
                                    <div class="gap_8">
                                        <button class="btn_graylight_ghost btn_sm_full mt10"
                                            onclick="location.href='#'">수정</button>
                                        <button class="btn_graylight_ghost btn_sm_full mt10">삭제</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!----------------------- m:: e ----------------------->

                    @endif

                    <div class="bottom_btn_wrap">
                        <button class="btn_basic btn_point_ghost" onclick="location.href='#'">제안서 다운</button>
                        <button class="btn_basic btn_point"
                            onclick="location.href='{{ route('www.corp.proposal.product.create.view', $corpInfo->id) }}'">
                            신규 건물 추가
                        </button>
                    </div>

                </div>

                <!-- my_body : e -->
            </div>

        </div>
    </div>

    <!-- modal 제목수정 : s -->
    <div class="modal modal_modify">
        <div class="modal_title">
            <h5>기업명 수정</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('modify')">
        </div>
        <div class="modal_container">
            <form id="nameUpdateForm" method="post" action="{{ route('www.corp.proposal.name.update') }}">
                <ul class="reg_bascic">
                    <li>
                        <label>기업명</label>
                        <input type="text" id="corp_name" name="corp_name" value="{{ $corpInfo->corp_name }}">
                        <input type="hidden" id="corp_id" name="corp_id" value="{{ $corpInfo->id }}">
                    </li>
                </ul>
                <div class="mt40">
                    <button class="btn_point btn_full_thin" type="button" onclick="onNameChange();">수정</button>
                </div>
            </form>
        </div>
    </div>
    <div class="md_overlay md_overlay_modify" onclick="modal_close('modify')"></div>
    <!-- modal 제목수정 : e -->

    <script>
        function onNameChange() {
            $('#nameUpdateForm').submit();
        }

        // 평 변환
        function sizeChange(id) {

            let squareText = '';
            let areaText = '';

            const btnInfo = document.querySelector(".sizeBtn" + id);
            const button = document.querySelector(".sizeBtnEvent" + id);

            if (btnInfo.textContent === "평") {
                btnInfo.textContent = "㎡";
                squareText = 'none';
                areaText = '';
            } else {
                btnInfo.textContent = "평";
                squareText = '';
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
    </script>
</x-layout>
