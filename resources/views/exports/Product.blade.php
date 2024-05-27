<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>매물번호</th>
            <th>매물상태</th>
            <th>주소</th>
            <th>요청자 명</th>
            <th>매물 종류</th>
            <th>거래 유형</th>
            <th>등록일</th>
            <th>처리일</th>
        </tr>
    </thead>
    <tbody>
        @inject('carbon', 'Carbon\Carbon')
        @foreach ($result as $product)
            <tr>
                {{-- 회원 번호 --}}
                <td>
                    {{ $product->id }}
                </td>

                {{-- 매물번호 --}}
                <td>
                    {{ $product->product_number }}
                </td>

                {{-- 매물상태 --}}
                <td>
                    {{ Lang::get('commons.product_state.' . $product->state) }}
                </td>

                {{-- 주소 --}}
                <td>
                    {{ $product->address . ' ' . ($product->is_map == 1 ? $product->address_detail : $product->address_dong . ' ' . $product->address_number) }}
                </td>

                {{-- 요청자 명 --}}
                <td>
                    {{ $product->users->name }}
                </td>

                {{-- 매물종류 --}}
                <td>
                    {{ Lang::get('commons.product_type.' . $product->type) }}
                </td>

                {{-- 거래 유형 --}}
                <td>
                    {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                </td>

                {{-- 등록일 --}}
                <td>
                    {{ $carbon::parse($product->created_at)->format('Y.m.d') }}
                </td>

                {{-- 처리일 --}}
                <td>
                    {{ $carbon::parse($product->updated_at)->format('Y.m.d') }}
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
