<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>회원 상태</th>
            <th>아이디(이메일)</th>
            <th>담당자 이름</th>
            <th>담당자 전화번호</th>
            <th>중개사무소명</th>
            <th>대표 전화번호</th>
            <th>사업자 등록번호</th>
            <th>중개등록번호</th>
            <th>대표자 명</th>
            <th>가입일</th>
            <th>최종 접속일</th>
            <th>메모</th>
        </tr>
    </thead>
    <tbody>
        @inject('carbon', 'Carbon\Carbon')
        @foreach ($result as $user)
            <tr>
                {{-- 회원 번호 --}}
                <td>{{ $user->id }}</td>

                {{-- 회원상태 --}}
                <td>
                    {{-- 상태 뱃지 --}}
                    @if ($user->state == 0)
                        이용중
                    @elseif($user->state == 1)
                        이용정지
                    @elseif($user->state == 2)
                        탈퇴
                    @elseif($user->state == 3)
                        계약해지
                    @endif
                </td>

                {{-- 회원 이메일 --}}
                <td>
                    {{ $user->email }}
                </td>

                {{-- 담당자 이름 --}}
                <td>
                    {{ $user->name }}
                </td>

                {{-- 전화번호 --}}
                <td>
                    {{ $user->phone }}
                </td>

                {{-- 중개사무소명 --}}
                <td>
                    {{ $user->company_name }}
                </td>

                {{-- 대표 전화번호 --}}
                <td>
                    {{ $user->company_phone }}
                </td>

                {{-- 사업자 등록번호 --}}
                <td>
                    {{ $user->company_number }}
                </td>

                {{-- 중개등록번호 --}}
                <td>
                    {{ $user->brokerage_number }}
                </td>

                {{-- 대표자 명 --}}
                <td>
                    {{ $user->company_ceo }}
                </td>

                {{-- 회원 가입일 --}}
                <td>
                    {{ $carbon::parse($user->created_at)->format('Y.m.d') }}
                </td>

                {{-- 최종 접속일 --}}
                <td>
                    @if ($user->last_used_at != null)
                        {{ $carbon::parse($user->last_used_at)->format('Y.m.d') }}
                    @else
                        -
                    @endif
                </td>

                <td>
                    {{ $user->memo }}
                </td>


            </tr>
        @endforeach
    </tbody>
</table>
