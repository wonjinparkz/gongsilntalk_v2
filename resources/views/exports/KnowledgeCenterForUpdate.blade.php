<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>건물명</th>
            <th>주소</th>
            <th>최저 매매호가(단위:만원)</th>
            <th>평균 매매호가(단위:만원)</th>
            <th>최대 매매호가(단위:만원)</th>
            <th>최저 임대호가(단위:만원)</th>
            <th>평규 임대호가(단위:만원)</th>
            <th>최대 임대호가(단위:만원)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($result as $knowledgeCenter)
            <tr>
                {{-- 회원 번호 --}}
                <td>
                    {{ $knowledgeCenter->id }}
                </td>

                {{-- 건물명 --}}
                <td>
                    {{ $knowledgeCenter->product_name }}
                </td>

                {{-- 주소 --}}
                <td>
                    {{ $knowledgeCenter->address }}
                </td>

                {{-- 최저 매매호가(단위:만원) --}}
                <td>
                    {{ $knowledgeCenter->sale_min_price }}
                </td>

                {{-- 평균 매매호가(단위:만원) --}}
                <td>
                    {{ $knowledgeCenter->sale_mid_price }}
                </td>

                {{-- 최대 매매호가(단위:만원) --}}
                <td>
                    {{ $knowledgeCenter->sale_max_price }}
                </td>

                {{-- 최저 임대호가(단위:만원) --}}
                <td>
                    {{ $knowledgeCenter->lease_min_price }}
                </td>

                {{-- 평균 임대호가(단위:만원) --}}
                <td>
                    {{ $knowledgeCenter->lease_mid_price }}
                </td>

                {{-- 최대 임대호가(단위:만원) --}}
                <td>
                    {{ $knowledgeCenter->lease_max_price }}
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
