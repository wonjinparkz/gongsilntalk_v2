@props([
    'BrTitleInfo' => [],
    'BrRecapTitleInfo' => [],
    'BrFlrOulnInfo' => [],
    'BrExposInfo' => [],
    'BrExposPubuseAreaInfo' => [],
    'characteristics_json' => '',
    'useWFS_json' => '',
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
                        $index = 0;
                    @endphp
                    @if (count($BrRecapTitleInfo) > 0)
                        @foreach ($BrRecapTitleInfo as $info)
                            <tr>
                                <td class="txt_sm">
                                    <input type="radio" name="dong" id="dong_{{ $index }}" value="총괄표제부"
                                        @if ($index == 0) checked @endif>
                                    <label for="dong_{{ $index++ }}"><span></span></label>
                                </td>
                                <td class="txt_sm">
                                    {{ $info['regstrKindCdNm'] }}
                                    {{ $info['regstrGbCdNm'] != '' ? '(' . $info['regstrGbCdNm'] . ')' : '' }}
                                </td>
                                <td class="txt_sm">-</td>
                                <td class="txt_sm">-</td>
                                <td class="txt_sm">
                                    {{ $info['archArea'] != '' ? number_format($info['archArea'], 2) . '㎡' : '-' }}</td>
                            </tr>
                        @endforeach
                    @endif
                    @php
                        $dongName = [];
                    @endphp
                    @if (count($BrTitleInfo) > 0)
                        @foreach ($BrTitleInfo as $info)
                            @php
                                if (is_array($info['dongNm']) && empty($info['dongNm'])) {
                                    $info['dongNm'] = '';
                                }
                                $dongName[] = str_replace(' ', '', $info['dongNm']);
                            @endphp
                            <tr>
                                <td class="txt_sm">
                                    <input type="radio" name="dong" id="dong_{{ $index }}"
                                        value="{{ str_replace(' ', '', $info['dongNm']) }}"
                                        @if ($index == 0 && count($BrRecapTitleInfo) == 0) checked @endif>
                                    <label for="dong_{{ $index++ }}"><span></span></label>
                                </td>
                                <td class="txt_sm">
                                    {{ $info['regstrKindCdNm'] }}
                                    {{ $info['regstrGbCdNm'] != '' ? '(' . $info['regstrGbCdNm'] . ')' : '' }}
                                </td>
                                <td class="txt_sm">{{ $info['dongNm'] ?? '-' }}</td>
                                <td class="txt_sm">{{ Commons::formatValue($info['mainPurpsCdNm'] ?? '') }}</td>
                                <td class="txt_sm">
                                    {{ $info['archArea'] != '' ? number_format($info['archArea'], 2) . '㎡' : '-' }}
                                </td>
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
                    <div class="td">{{ $info['archArea'] != '' ? number_format($info['archArea'], 2) . '㎡' : '-' }}
                    </div>
                    <div class="td">연면적</div>
                    <div class="td">{{ $info['totArea'] != '' ? number_format($info['totArea'], 2) . '㎡' : '-' }}
                    </div>
                    <div class="td">대지면적</div>
                    <div class="td">{{ $info['platArea'] != '' ? number_format($info['platArea'], 2) . '㎡' : '-' }}
                    </div>
                    <div class="td">주구조</div>
                    <div class="td">{{ $info['strctCdNm'] ?? '-' }}</div>
                    <div class="td">지붕구조</div>
                    <div class="td">{{ Commons::formatValue($info['etcRoof'] ?? '') }}</div>
                    <div class="td">엘리베이터</div>
                    <div class="td">{{ $info['rideUseElvtCnt'] ?? '-' }}</div>
                    <div class="td">용적률</div>
                    <div class="td">{{ $info['vlRat'] != '' ? $info['vlRat'] . '%' : '-' }}</div>
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
        @php
            if (is_array($info['dongNm']) && empty($info['dongNm'])) {
                $info['dongNm'] = '';
            }
        @endphp
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
                    <div class="td">{{ $info['archArea'] != '' ? number_format($info['archArea'], 2) . '㎡' : '-' }}
                    </div>
                    <div class="td">연면적</div>
                    <div class="td">{{ $info['totArea'] != '' ? number_format($info['totArea'], 2) . '㎡' : '-' }}
                    </div>
                    <div class="td">대지면적</div>
                    <div class="td">{{ $info['platArea'] != '' ? number_format($info['platArea'], 2) . '㎡' : '-' }}
                    </div>
                    <div class="td">주구조</div>
                    <div class="td">{{ $info['strctCdNm'] ?? '-' }}</div>
                    <div class="td">지붕구조</div>
                    <div class="td">{{ Commons::formatValue($info['etcRoof'] ?? '') }}</div>
                    <div class="td">엘리베이터</div>
                    <div class="td">{{ $info['rideUseElvtCnt'] > 0 ? '총 ' . $info['rideUseElvtCnt'] . '대' : '-' }}
                    </div>
                    <div class="td">용적률</div>
                    <div class="td">{{ $info['vlRat'] != '' ? $info['vlRat'] . '%' : '-' }}</div>
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
                                        <td>{{ is_array($info['mainPurpsCdNm']) ? implode(', ', $info['mainPurpsCdNm']) : $info['mainPurpsCdNm'] ?? '-' }}
                                        </td>
                                        <td>{{ number_format($info['area'], 2) }}㎡</td>
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

@if (count($BrExposPubuseAreaInfo) > 0)
    <div class="open_con_wrap building_item_3">
        <div class="open_trigger">전유부 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
        </div>
        <div class="con_panel">
            <div class="dropdown_box s_sm w_40">
                <button class="dropdown_label"></button>
                <ul class="optionList">
                    @php
                        $uniqueList = [];
                        foreach ($BrExposPubuseAreaInfo ?? [] as $info) {
                            $key =
                                (isset($info['dongNm']) && $info['dongNm'] !== '' ? '단일' : $info['dongNm']) .
                                ' ' .
                                $info['hoNm'];
                            if (!isset($uniqueList[$key])) {
                                $uniqueList[$key] = $info;
                            }
                        }
                        $BrExposPubuseAreaInfoArray = array_values($uniqueList);
                    @endphp
                    @if (count($BrExposPubuseAreaInfoArray) > 0)
                        @foreach ($BrExposPubuseAreaInfoArray as $info)
                            <li
                                class="optionItem {{ isset($info['dongNm']) && $info['dongNm'] !== '' ? '단일' : $info['dongNm'] }} ">
                                {{-- <li class="optionItem {{ $info['dongNm'] }} dongInfo"> --}}
                                {{ isset($info['dongNm']) && $info['dongNm'] !== '' ? '' : $info['dongNm'] . ' - ' }}
                                {{ $info['hoNm'] }}
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
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
                    <tbody class="">
                        @if (count($BrExposPubuseAreaInfo) > 0)
                            @foreach ($BrExposPubuseAreaInfo as $info)
                                {{ Log::info($info) }}
                                <tr
                                    class="{{ isset($info['dongNm']) && $info['dongNm'] !== '' ? '단일' : $info['dongNm'] }}">
                                    {{-- <tr class="{{ $info['dongNm'] }} dongInfo"> --}}
                                    <td>{{ $info['exposPubuseGbCdNm'] }}</td>
                                    <td>{{ isset($info['dongNm']) && $info['dongNm'] !== '' ? '' : $info['dongNm'] }}
                                    </td>
                                    <td>{{ Commons::formatValue($info['mainPurpsCdNm'] ?? '') }}</td>
                                    <td>{{ $info['mainAtchGbCdNm'] }}</td>
                                    <td>{{ number_format($info['area']) }}㎡</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="btn_more_open">더보기</div>
        </div>
    </div>
@endif

@if ($characteristics_json != '')
    @php
        // 주어진 문자열
        $encodedString = $characteristics_json;
        // HTML 엔티티를 디코드
        $decodedString = html_entity_decode($encodedString);

        // JSON 문자열을 PHP 배열로 변환
        $jsonArray = json_decode($decodedString, true);

        // 특정 키의 값 추출

        // JSON 문자열을 PHP 배열로 변환
        if ($useWFS_json != '') {
            $WFSencodedString = $useWFS_json;
            $WFSdecodedString = html_entity_decode($WFSencodedString);
            $useWFSArray = json_decode($WFSdecodedString, true);
            $prpos = $useWFSArray['prpos_area_dstrc_nm_list'] ?? '-';
        }
    @endphp
    <div class="open_con_wrap building_item_4">
        <div class="open_trigger">토지정보 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
        </div>
        <div class="con_panel">
            <div class="default_box showstep1">
                <div class="table_container2_sm mt10">
                    <div class="td">면적</div>
                    <div class="td">{{ number_format($jsonArray['lndpclAr']) }}㎡</div>
                    <div class="td">지목</div>
                    <div class="td">{{ $jsonArray['lndcgrCodeNm'] }}</div>
                    <div class="td">용도지역</div>
                    <div class="td">{{ $jsonArray['prposArea1Nm'] }}</div>
                    <div class="td">이용상황</div>
                    <div class="td">{{ $jsonArray['ladUseSittnNm'] }}</div>
                    <div class="td">형상</div>
                    <div class="td">{{ $jsonArray['tpgrphFrmCodeNm'] }}</div>
                    <div class="td">지형높이</div>
                    <div class="td">{{ $jsonArray['tpgrphHgCodeNm'] }}</div>
                    <div class="td">동 개별 공시지가(원/m²)</div>
                    <div class="td">{{ number_format($jsonArray['pblntfPclnd']) }}</div>
                    <div class="td">지역지구등<br>지정여부</div>
                    <div class="td">{{ $prpos ?? '-' }}</div>
                </div>
            </div>
            <div class="btn_more_open">더보기</div>
        </div>
    </div>
@endif

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
        if (!dongName || dongName.trim() === '') {
            dongName = $('input[name="dong"]').first().val();
        }
        if (dongName) {
            $('.dongInfo').css('display', 'none');
            $('.' + dongName).css('display', '');
        }
    }
</script>
