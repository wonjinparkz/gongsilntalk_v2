<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>분양상태</th>
            <th>주소</th>
            <th>건물명</th>
            <th>준공일</th>
            <th>등록일</th>
        </tr>
    </thead>
    <tbody>
        @inject('carbon', 'Carbon\Carbon')
        @foreach ($result as $siteProduct)
            <tr>
                {{-- 회원 번호 --}}
                <td>
                    {{ $siteProduct->id }}
                </td>

                {{-- 회원 번호 --}}
                <td>
                    {{ $siteProduct->is_sale ? '분양중' : '분양예정' }}
                </td>

                {{-- 주소 --}}
                <td>
                    {{ $siteProduct->address }}
                </td>

                {{-- 건물명 --}}
                <td>
                    {{ $siteProduct->product_name }}
                </td>

                {{-- 준공일 --}}
                <td>
                    {{ $carbon::parse($siteProduct->completion_date)->format('Y.m.d') }}
                </td>

                {{-- 등록일 --}}
                <td>
                    {{ $carbon::parse($siteProduct->created_at)->format('Y.m.d') }}
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
