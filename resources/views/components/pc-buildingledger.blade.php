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
                    <col width="100">
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
                    <div class="td">{{ Commons::formatValue($info['mainPurpsCdNm'] ?? '') }}</div>
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
                    <div class="td">{{ Commons::formatValue($info['strctCdNm'] ?? '') }}</div>
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
                    <div class="td">{{ Commons::formatValue($info['mainPurpsCdNm'] ?? '') }}</div>
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
                    <div class="td">{{ Commons::formatValue($info['strctCdNm']) }}</div>
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
                        <tbody class="dongInfo_{{ str_replace(' ', '', $name) }} dongInfo">
                            @foreach ($BrFlrOulnInfo as $info)
                                @if ($name == str_replace(' ', '', $info['dongNm']))
                                    <tr>
                                        <td>{{ $info['flrNoNm'] }}</td>
                                        <td>{{ Commons::formatValue($info['mainPurpsCdNm'] ?? '') }}
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

<!-- HTML 구조 -->
@if (count($BrExposInfo) > 0)
    @foreach ($dongName as $name)
        <div class="open_con_wrap building_item_3 dongInfo_{{ str_replace(' ', '', $name) }} dongInfo">
            <div class="open_trigger">전유부 <span><img src="{{ asset('assets/media/dropdown_arrow.png') }}"></span>
            </div>
            <div class="con_panel">
                <div class="dropdown_box s_sm w_40">
                    <button class="dropdown_label">전유부 선택</button>
                    <ul class="optionList">
                        @php
                            // hoNm 기준으로 정렬
                            $sortedBrExposInfo = $BrExposInfo;
                            usort($sortedBrExposInfo, function ($a, $b) {
                                return intval($a['hoNm']) - intval($b['hoNm']);
                            });
                        @endphp
                        @foreach ($sortedBrExposInfo as $info)
                            @if ($name == str_replace(' ', '', $info['dongNm']))
                                {{-- 전유부 동 이름과 매칭되도록 필터링 --}}
                                <li class="optionItem unit-specific {{ str_replace(' ', '', $info['dongNm']) }}"
                                    data-dong="{{ str_replace(' ', '', $info['dongNm']) }}" data-ho="{{ $info['hoNm'] }}">
                                    {{ $info['dongNm'] != '' ? $info['dongNm'] . '-' : '' }}{{ $info['hoNm'] }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="default_box showstep1 mt10">
                    <table class="table_type_1">
                        <colgroup>
                            <col width="50">
                            <col width="80">
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
                        <tbody class="BrExposPubuseAreaInfoContainer">
                            {{-- 선택한 항목에 맞는 데이터가 들어갈 자리 --}}
                        </tbody>
                    </table>
                </div>

                <div class="btn_more_open">더보기</div>
            </div>
        </div>
    @endforeach
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
    var exposPubuseAreaInfos = @json($BrExposPubuseAreaInfo);

    $(document).ready(function() {
        ShowDongInfo();

        // 드롭다운 박스를 클릭할 때 이벤트 처리
        $('.dropdown_box').on('click', function() {
            var $optionList = $(this).find('.optionList');

            // 현재 드롭다운이 닫혀 있으면 열고, 열려 있으면 닫음
            if ($optionList.css('display') === 'none') {
                $optionList.css('display', 'block'); // 드롭다운 열기
            } else {
                $optionList.css('display', 'none'); // 드롭다운 닫기
            }
        });

        // 동 정보 변경 시 다시 필터링
        $('input[name="dong"]').change(function() {
            ShowDongInfo();
        });

        // 페이지 로드 시 모든 동에 대해 첫 번째 전유부 항목 자동 선택 및 전유공용면적 정보 표시
        $('.dongInfo').each(function() {
            var firstOption = $(this).find('.optionItem').first();
            if (firstOption.length > 0) {
                firstOption.addClass('selected'); // 선택된 항목 표시
                updateExposPubuseAreaInfo(firstOption); // 전유공용면적 정보 업데이트
                updateDropdownLabel(firstOption);
            }
        });

        // 드롭다운 항목이 클릭될 때 전유부 정보 업데이트
        $('.optionItem').on('click', function() {
            var $parentDropdown = $(this).closest('.dropdown_box');
            var $optionList = $parentDropdown.find('.optionList');

            // 클릭된 항목 강조 표시 (선택된 항목 스타일 변경)
            $parentDropdown.find('.optionItem').removeClass('selected');
            $(this).addClass('selected');

            // 전유공용면적 정보 업데이트
            updateExposPubuseAreaInfo($(this));
            updateDropdownLabel($(this));

            // 클릭 후 드롭다운을 닫음
            $optionList.css('display', 'none');
        });
    });

    // 동 정보 필터링 함수
    function ShowDongInfo() {
        var dongName = $('input[name="dong"]:checked').val();
        if (!dongName || dongName.trim() === '') {
            dongName = $('input[name="dong"]').first().val();
        }

        if (dongName) {
            // 모든 dongInfo를 숨김
            $('.dongInfo').css('display', 'none');
            // 선택된 dongName의 dongInfo만 보이도록 설정
            $('.dongInfo_' + dongName).css('display', '');
        }
    }

    // 전유공용면적 정보 업데이트 함수
    function updateExposPubuseAreaInfo($selectedOption) {
        var selectedDong = $selectedOption.data('dong');
        var selectedHo = $selectedOption.data('ho');

        // 선택한 dongNm 및 hoNm에 맞는 데이터 필터링
        var filteredData = exposPubuseAreaInfos.filter(function(info) {
            return info.dongNm === selectedDong && info.hoNm === selectedHo;
        });

        // 해당 데이터를 표시할 tbody 요소 찾기
        var $tbody = $selectedOption.closest('.con_panel').find('.BrExposPubuseAreaInfoContainer');

        // tbody 요소의 내용을 비우고 새로 필터링된 데이터를 추가
        $tbody.empty();

        if (filteredData.length > 0) {
            $.each(filteredData, function(index, info) {
                var row = `<tr>
                            <td>${info.exposPubuseGbCdNm}</td>
                            <td>${info.flrNoNm}</td>
                            <td>${info.mainAtchGb == 0 ? '주' : '부속'}</td>
                            <td>${info.mainPurpsCdNm ?? ''}</td>
                            <td>${parseFloat(info.area).toLocaleString()}㎡</td>
                        </tr>`;
                $tbody.append(row);
            });
        } else {
            $tbody.append('<tr><td colspan="5">해당 데이터가 없습니다.</td></tr>');
        }
    }

    // 드롭다운 레이블 업데이트 함수
    function updateDropdownLabel($selectedOption) {
        var dong = $selectedOption.data('dong');
        var ho = $selectedOption.data('ho');

        // 동이 단일인지 확인 (하나의 동만 있는 경우)
        var totalDongCount = $('input[name="dong"]').length;
        var label;

        if (totalDongCount === 1 && dong) {
            // 동이 단일일 경우 호실만 표시
            label = ho; // ex) "B102"
        } else {
            // 여러 동이 있을 경우 동-호 표시
            label = dong + '-' + ho; // ex) "107동-B102"
        }

        // 해당 드롭다운 레이블을 찾아 텍스트 업데이트
        $selectedOption.closest('.con_panel').find('.dropdown_label').text(label);
    }
</script>
