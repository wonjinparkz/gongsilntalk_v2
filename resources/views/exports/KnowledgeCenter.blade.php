<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>건물명</th>
            <th>주소</th>
            <th>준공일</th>
            <th>매매호가(단위:만원)</th>
            <th>임대호가(단위:만원)</th>
            <th>등록일</th>
            <th>도면여부</th>
            <th>공개여부</th>
            <th>한줄요약</th>
        </tr>
    </thead>
    <tbody>
        @inject('carbon', 'Carbon\Carbon')
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

                {{-- 준공일 --}}
                <td>
                    {{ $knowledgeCenter->completion_date }}
                </td>

                {{-- 매매호가(단위:만원) --}}
                <td>
                    {{ $knowledgeCenter->sale_min_price . '-' . $knowledgeCenter->sale_mid_price . '-' . $knowledgeCenter->sale_max_price }}
                </td>

                {{-- 임대호가(단위:만원) --}}
                <td>
                    {{ $knowledgeCenter->lease_min_price . '-' . $knowledgeCenter->lease_mid_price . '-' . $knowledgeCenter->lease_max_price }}
                </td>

                {{-- 등록일 --}}
                <td>
                    {{ $carbon::parse($knowledgeCenter->created_at)->format('Y년 m월 d일') }}
                </td>

                {{-- 도면 여부 --}}
                <td>
                    @if ($knowledgeCenter->floorPlan_files != null && count($knowledgeCenter->floorPlan_files) > 0)
                        O
                    @else
                        X
                    @endif
                </td>

                {{-- 공개여부 --}}
                <td>
                    {{ $knowledgeCenter->is_blind ? '비공개' : '공개' }}
                </td>

                {{-- 공개여부 --}}
                <td>{{ $knowledgeCenter->comments }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
