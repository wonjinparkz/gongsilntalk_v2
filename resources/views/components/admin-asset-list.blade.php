@props([
    'result' => [],
])

@foreach ($result as $address)
    {{-- 데이터 내용 --}}
    <div class="card-body pt-0 table-responsive">
        {{-- 테이블 --}}
        <table id="notice_table" class="table align-middle table-row-dashed fs-6 gy-4">
            {{-- 테이블 헤더 --}}
            <h4>{{ $address->address }}</h4>
            <p class="asset_row_total">총 {{ count($address->asset) }}개</p>
            <thead>
                <tr class="text-start text-gray-400 fw-bold fl-7 text-uppercase gs-0">
                    <th class="text-center w-80px">번호</th>
                    <th class="text-center w-200px">상세주소</th>
                    <th class="text-center w-200px">부동산유형</th>
                    <th class="text-center">면적
                        <button class="btn btn-outline sizeBtnEvent{{ $address->id }}"
                            style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 50px;" type="button"
                            onclick="sizeChange('{{ $address->id }}');">
                            <img style="width: 10px;" src="{{ asset('assets/media/ic_change.png') }}">
                            <span class="txt_unit sizeBtn{{ $address->id }}">평</span>
                        </button>
                    </th>
                    <th class="text-center w-200px">보증금</th>
                    <th class="text-center w-150px">월임대료</th>
                    <th class="text-center">월순수익</th>
                    <th class="text-center">수익률</th>
                </tr>
            </thead>

            {{-- 테이블 내용 --}}
            <tbody class="fw-bold text-center">
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

                        $myPrice = $asset->month_price - ($asset->loan_price * ($asset->loan_rate / 100)) / 12;
                    @endphp
                    <tr class="cursor_pointer">
                        <td class="">{{ $key + 1 }}</td>
                        @php
                            $address_detail = isset($asset->address_dong) ? $asset->address_dong . '동 ' : '';
                            $address_detail .= $asset->address_detail . '호';
                        @endphp
                        <td class="">
                            {{ $asset->is_temporary == 0 ? $address_detail : $asset->address_detail }}
                        </td>
                        <td class="">{{ Lang::get('commons.product_type.' . $asset->type_detail) }}</td>
                        <td class="square_{{ $address->id }}">{{ $asset->exclusive_square }}㎡
                        </td>
                        <td class="area_{{ $address->id }}" style="display:none;">
                            {{ $asset->exclusive_area }}평
                        </td>
                        <td class="">{{ number_format($asset->check_price) }}원</td>
                        <td class="">{{ number_format($asset->month_price) }}원</td>
                        <td class="gsntalk-color"><span class="txt_point">{{ number_format($myPrice) }}원</span>
                        </td>
                        <td class="gsntalk-color"><span
                                class="txt_point">{{ round(($myPrice / $realPrice) * 100, 2) }}%</span>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>

    </div>
@endforeach

<script>
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
</script>
