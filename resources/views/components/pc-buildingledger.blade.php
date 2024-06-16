@props([
    'BrTitleInfo' => [],
    'BrRecapTitleInfo' => [],
    'BrFlrOulnInfo' => [],
    'BrExposInfo' => [],
    'BrExposPubuseAreaInfo' => [],
])
@inject('carbon', 'Carbon\Carbon')

<!-- 건물·토지정보 : s -->
<div class="side_section">
    <h4>건물·토지정보</h4>
</div>

<div class="open_con_wrap building_item_1">
    <div class="open_trigger">동별정보 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
    </div>
    <div class="con_panel">
        <div class="default_box showstep1">
            <table class="table_type_1">
                <colgroup>
                    <col width="40">
                    <col width="*">
                    <col width="55">
                    <col width="50">
                    <col width="90">
                </colgroup>
                <thead>
                    <tr>
                        <th class="txt_sm">선택</th>
                        <th class="txt_sm">대장종류</th>
                        <th class="txt_sm">동</th>
                        <th class="txt_sm">주용도</th>
                        <th class="txt_sm">면적</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        Log::info('BrExposInfo', $BrExposInfo);
                        $index = 0;
                    @endphp
                    @if (count($BrRecapTitleInfo) > 0)
                        @foreach ($BrRecapTitleInfo as $info)
                            <tr>
                                <td class="txt_sm">
                                    <input type="radio" name="dong" id="dong_{{ $index }}" value="총괄표제부"
                                        checked>
                                    <label for="dong_{{ $index++ }}"><span></span></label>
                                </td>
                                <td class="txt_sm">
                                    {{ $info['regstrKindCdNm'] }}
                                    {{ $info['regstrGbCdNm'] != '' ? '(' . $info['regstrGbCdNm'] . ')' : '' }}
                                </td>
                                <td class="txt_sm">-</td>
                                <td class="txt_sm">-</td>
                                <td class="txt_sm">{{ $info['archArea'] != '' ? $info['archArea'] . '㎡' : '-' }}</td>
                            </tr>
                        @endforeach
                    @endif
                    @php
                        $dongName = [];
                    @endphp
                    @if (count($BrTitleInfo) > 0)
                        @foreach ($BrTitleInfo as $info)
                            @php
                                $dongName[] = str_replace(' ', '', $info['dongNm']);
                            @endphp
                            <tr>
                                <td class="txt_sm">
                                    <input type="radio" name="dong" id="dong_{{ $index }}"
                                        value="{{ str_replace(' ', '', $info['dongNm']) }}">
                                    <label for="dong_{{ $index++ }}"><span></span></label>
                                </td>
                                <td class="txt_sm">
                                    {{ $info['regstrKindCdNm'] }}
                                    {{ $info['regstrGbCdNm'] != '' ? '(' . $info['regstrGbCdNm'] . ')' : '' }}
                                </td>
                                <td class="txt_sm">{{ $info['dongNm'] ?? '-' }}</td>
                                <td class="txt_sm">{{ $info['mainPurpsCdNm'] ?? '-' }}</td>
                                <td class="txt_sm">{{ $info['archArea'] != '' ? $info['archArea'] . '㎡' : '-' }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="btn_more_open">더보기</div>
    </div>

</div>
@php
    $index = 0;
@endphp
@if (count($BrRecapTitleInfo) > 0)
    @foreach ($BrRecapTitleInfo as $info)
        <div class="총괄표제부 dongInfo">
            <div class="default_box showstep1">
                <div class="table_container2_sm mt10">
                    <div class="td">규모</div>
                    <div class="td">-층 / -층</div>
                    <div class="td">사용승인일</div>
                    <div class="td">{{ $carbon::parse($info['useAprDay'])->format('Y년 m월 d일') }}</div>
                    {{-- <div class="td">{{ date_format($info['useAprDay'], 'Y년 m월 d일') }}</div> --}}
                    <div class="td">주용도</div>
                    <div class="td">{{ $info['mainPurpsCdNm'] ?? '-' }}</div>
                    <div class="td">건축면적</div>
                    <div class="td">{{ $info['archArea'] != '' ? $info['archArea'] . '㎡' : '-' }}</div>
                    <div class="td">연면적</div>
                    <div class="td">{{ $info['totArea'] != '' ? $info['totArea'] . '㎡' : '-' }}</div>
                    <div class="td">대지면적</div>
                    <div class="td">{{ $info['platArea'] != '' ? $info['platArea'] . '㎡' : '-' }}</div>
                    <div class="td">주구조</div>
                    <div class="td">{{ $info['strctCdNm'] ?? '-' }}</div>
                    <div class="td">지붕구조</div>
                    <div class="td">{{ $info['etcRoof'] ?? '-' }}</div>
                    <div class="td">엘리베이터</div>
                    <div class="td">{{ $info['rideUseElvtCnt'] ?? '-' }}</div>
                    <div class="td">용적률</div>
                    <div class="td">{{ $info['vlRat'] ?? '-' }}</div>
                    <div class="td">건폐율</div>
                    <div class="td">{{ $info['bcRat'] != '' ? $info['bcRat'] . '%' : '-' }}</div>
                </div>
            </div>
            <div class="btn_more_open">더보기</div>
        </div>
    @endforeach
@endif

@if (count($BrTitleInfo) > 0)
    @foreach ($BrTitleInfo as $info)
        <div class="{{ str_replace(' ', '', $info['dongNm']) }} dongInfo">
            <div class="default_box showstep1">
                <div class="table_container2_sm mt10">
                    <div class="td">규모</div>
                    <div class="td">{{ $info['ugrndFlrCnt'] > 0 ? 'B' . $info['ugrndFlrCnt'] : '1' }}층 /
                        {{ $info['grndFlrCnt'] > 0 ? $info['grndFlrCnt'] : '1' }}층</div>
                    <div class="td">사용승인일</div>
                    <div class="td">{{ $carbon::parse($info['useAprDay'])->format('Y년 m월 d일') }}</div>
                    <div class="td">주용도</div>
                    <div class="td">{{ $info['mainPurpsCdNm'] ?? '-' }}</div>
                    <div class="td">건축면적</div>
                    <div class="td">{{ $info['archArea'] != '' ? $info['archArea'] . '㎡' : '-' }}</div>
                    <div class="td">연면적</div>
                    <div class="td">{{ $info['totArea'] != '' ? $info['totArea'] . '㎡' : '-' }}</div>
                    <div class="td">대지면적</div>
                    <div class="td">{{ $info['platArea'] != '' ? $info['platArea'] . '㎡' : '-' }}</div>
                    <div class="td">주구조</div>
                    <div class="td">{{ $info['strctCdNm'] ?? '-' }}</div>
                    <div class="td">지붕구조</div>
                    <div class="td">{{ $info['etcRoof'] ?? '-' }}</div>
                    <div class="td">엘리베이터</div>
                    <div class="td">{{ $info['rideUseElvtCnt'] > 0 ? '총 ' . $info['rideUseElvtCnt'] . '대' : '-' }}
                    </div>
                    <div class="td">용적률</div>
                    <div class="td">{{ $info['vlRat'] ?? '-' }}</div>
                    <div class="td">건폐율</div>
                    <div class="td">{{ $info['bcRat'] != '' ? $info['bcRat'] . '%' : '-' }}</div>
                </div>
            </div>
            <div class="btn_more_open">더보기</div>
        </div>
    @endforeach
@endif

<div class="open_con_wrap building_item_2">
    <div class="open_trigger">층별 정보 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
    </div>
    <div class="con_panel">
        <div class="default_box showstep1">
            <table class="table_type_1">
                <colgroup>
                    <col width="60">
                    <col width="*">
                    <col width="100">
                </colgroup>
                <thead>
                    <tr>
                        <th>층수</th>
                        <th>용도</th>
                        <th>면적</th>
                    </tr>
                </thead>
                @if (count($BrFlrOulnInfo) > 0)
                    @foreach ($dongName as $name)
                        <tbody class="{{ $name }} dongInfo">
                            @foreach ($BrFlrOulnInfo as $info)
                                @if ($name == $info['dongNm'])
                                    <tr>
                                        <td>{{ $info['flrNoNm'] }}</td>
                                        <td>{{ $info['mainPurpsCdNm'] }}</td>
                                        <td>{{ $info['area'] }}㎡</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>
        <div class="btn_more_open">더보기</div>
    </div>
</div>

<div class="open_con_wrap building_item_3">
    <div class="open_trigger">전유부 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
    </div>
    <div class="con_panel">
        <div class="dropdown_box s_sm w_40">
            <button class="dropdown_label">103동 - 102</button>
            @if (count($BrFlrOulnInfo) > 0)
                @foreach ($dongName as $name)
                    <ul class="optionList {{ $name }}">
                        @foreach ($BrFlrOulnInfo as $info)
                            @if ($name == $info['dongNm'])
                                <li class="optionItem">{{ $name }}동 - 102</li>
                            @endif
                        @endforeach
                    </ul>
                @endif
        </div>
        @foreach ($BrFlrOulnInfo as $info)
            @if ($name == $info['dongNm'])
                <tr>
                    <td>{{ $info['flrNoNm'] }}</td>
                    <td>{{ $info['mainPurpsCdNm'] }}</td>
                    <td>{{ $info['area'] }}㎡</td>
                </tr>
            @endif
        @endforeach
        <div class="default_box showstep1 mt10">
            <table class="table_type_1">
                <colgroup>
                    <col width="50">
                    <col width="50">
                    <col width="60">
                    <col width="*">
                    <col width="100">
                </colgroup>
                <thead>
                    <tr>
                        <th>구분</th>
                        <th>층별</th>
                        <th>건축물</th>
                        <th>용도</th>
                        <th>면적</th>
                    </tr>
                </thead>
                @if (count($BrFlrOulnInfo) > 0)
                    @foreach ($dongName as $name)
                        <tbody class="{{ $name }} dongInfo">
                            @foreach ($BrFlrOulnInfo as $info)
                                @if ($name == $info['dongNm'])
                                    <tr>
                                        <td>{{ $info['flrNoNm'] }}</td>
                                        <td>{{ $info['mainPurpsCdNm'] }}</td>
                                        <td>{{ $info['area'] }}㎡</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>

    </div>
</div>

<div class="open_con_wrap building_item_4">
    <div class="open_trigger">토지정보 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
    </div>
    <div class="con_panel">
        <div class="default_box showstep1">
            <div class="table_container2_sm mt10">
                <div class="td">면적</div>
                <div class="td">569.44㎡</div>
                <div class="td">지목</div>
                <div class="td">대</div>
                <div class="td">용도지역</div>
                <div class="td">제1종일반주거지역</div>
                <div class="td">이용상황</div>
                <div class="td">아파트</div>
                <div class="td">형상</div>
                <div class="td">사다리형</div>
                <div class="td">지형높이</div>
                <div class="td">급경사</div>
                <div class="td">동 개별 공시지가(원/m²)</div>
                <div class="td">415000</div>
                <div class="td">지역지구등<br>지정여부</div>
                <div class="td">
                    과밀억제권역,정비구역(도렴도시환경정비사업),가축사육제한구역,대공방어협조구역(위탁고도:54-236m),도시지역,일반상업지역,4대문안</div>
            </div>
        </div>
        <div class="btn_more_open">더보기</div>
    </div>
</div>

<!-- 건물·토지정보 : e -->


<script>
    $(document).ready(function() {
        ShowDongInfo();
    });

    $('input[name="dong"]').change(function() {
        ShowDongInfo();
    });

    function ShowDongInfo() {
        var dongName = $('input[name="dong"]:checked').val();
        $('.dongInfo').hide();
        $('.' + dongName).show();
    }

    function ShwoFloorInfo() {

    }
</script>
