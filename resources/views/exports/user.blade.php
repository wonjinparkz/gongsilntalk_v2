<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>회원 상태</th>
            <th>아이디(이메일)</th>
            <th>가입 유형</th>
            <th>이름</th>
            <th>전화번호</th>
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
                    @if ($user->state == 1)
                        이용중
                    @elseif($user->state == 0)
                        탈퇴
                    @elseif($user->state == 2)
                        이용 정지
                    @endif
                </td>

                {{-- 회원 이메일 --}}
                <td>
                    {{ $user->email }}
                </td>

                {{-- 회원 가입유형 --}}
                <td>
                    {{ Lang::get('commons.provider.' . $user->provider) }}
                </td>

                {{-- 사용자 이름 --}}
                <td>
                    {{ $user->name }}
                </td>

                {{-- 전화번호 --}}
                <td>
                    {{ $user->phone }}
                </td>

                {{-- 회원 가입일 --}}
                <td>
                    {{ $carbon::parse($user->created_at)->format('Y년 m월 d일') }}
                </td>

                {{-- 최종 접속일 --}}
                <td>
                    @if ($user->last_used_at != null)
                        {{ $carbon::parse($user->last_used_at)->format('Y년 m월 d일') }}
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
