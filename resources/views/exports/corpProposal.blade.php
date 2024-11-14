<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>중개사무소 명</th>
            <th>중개사무소 연락처</th>
            <th>제안서 명</th>
            <th>기업명</th>
            <th>ID</th>
            <th>받은 제안서 개수</th>
            <th>등록일</th>
        </tr>
    </thead>
    <tbody>
        @inject('carbon', 'Carbon\Carbon')
        @foreach ($result as $proposal)
            <tr>
                {{-- 매물 제안서 번호 --}}
                <td>
                    {{ $proposal->id }}
                </td>

                {{-- 중개사무소 명 --}}
                <td>
                    {{ $proposal->users->type == 0 ? $proposal->users->name : $proposal->users->company_name }}
                </td>

                {{-- 중개사무소 연락처 --}}
                <td>
                    {{ $proposal->users->phone }}
                </td>

                {{-- 제안서 명 --}}
                <td>
                    {{ $proposal->corp_name }} 제안서
                </td>

                {{-- 기업명 --}}
                <td>
                    {{ $proposal->corp_name }}
                </td>

                {{-- ID --}}
                <td>
                    {{ $proposal->users->email }}
                </td>

                {{-- 받은 제안서 개수 --}}
                <td>
                    {{ count($proposal->products) }}
                </td>

                {{-- 등록일 --}}
                <td>
                    @inject('carbon', 'Carbon\Carbon')
                    {{ $carbon::parse($proposal->created_at)->format('Y.m.d') }}
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
