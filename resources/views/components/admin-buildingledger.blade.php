@props([
    'class' => '',
    'isUpdate' => 'true',
    'result' => [],
])
@inject('carbon', 'Carbon\Carbon')
{{-- 내용 START --}}
@php
    if (!empty($result->BrTitleInfo)) {
        $BrTitleInfoCreatedAt =
            collect($result->BrTitleInfo)
                ->sortByDesc('created_at')
                ->first()->created_at ?? null;
    }
    if (!empty($result->BrRecapTitleInfo)) {
        $BrRecapTitleInfoCreatedAt =
            collect($result->BrRecapTitleInfo)
                ->sortByDesc('created_at')
                ->first()->created_at ?? null;
    }
    if (!empty($result->BrFlrOulnInfo)) {
        $BrFlrOulnInfoCreatedAt =
            collect($result->BrFlrOulnInfo)
                ->sortByDesc('created_at')
                ->first()->created_at ?? null;
    }
    if (!empty($result->BrExposInfo)) {
        $BrExposInfoCreatedAt =
            collect($result->BrExposInfo)
                ->sortByDesc('created_at')
                ->first()->created_at ?? null;
    }
    if (!empty($result->BrExposPubuseAreaInfo)) {
        $BrExposPubuseAreaInfoCreatedAt =
            collect($result->BrExposPubuseAreaInfo)
                ->sortByDesc('created_at')
                ->first()->created_at ?? null;
    }
@endphp
<div class="card-body border-top p-9">
    <form action="{{ route('admin.buildingledger.brtitleinfo.update') }}" id="BrTitleInfo_submit" method="POST">
        <input type="hidden" name="id" id="id" value="{{ $result->id }}">
        <input type="hidden" name="class" id="class" value="{{ $class }}">
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">표제부</label>
            <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                {{ $BrTitleInfoCreatedAt ?? null ? $carbon::parse($BrTitleInfoCreatedAt)->format('Y.m.d') : '-' }}</label>
            <div class="col-lg-4 fv-row isUpdate">
                @if (old('BrTitleInfo') != null)
                    @foreach (old('BrTitleInfo') as $BrTitleInfo)
                        <input type="hidden" name="BrTitleInfo[]" value="{{ $BrTitleInfo }}" />
                    @endforeach
                @else
                    @foreach ($result->BrTitleInfo as $BrTitleInfo)
                        <input type="hidden" name="BrTitleInfo[]" value="{{ $BrTitleInfo->json_data ?? '' }}" />
                    @endforeach
                @endif
                <a href="javascript:void(0);" onclick="get_buildingledger('{{ $result->pnu }}', 'BrTitleInfo', this)"
                    class="btn btn-secondary">업데이트</a>
            </div>
        </div>
    </form>

    <form action="{{ route('admin.buildingledger.brrecaptitleinfo.update') }}" id="BrRecapTitleInfo_submit"
        method="POST">
        <input type="hidden" name="id" id="id" value="{{ $result->id }}">
        <input type="hidden" name="class" id="class" value="{{ $class }}">
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">총괄표제부</label>
            <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                {{ $BrRecapTitleInfoCreatedAt ?? null ? $carbon::parse($BrRecapTitleInfoCreatedAt)->format('Y.m.d') : '-' }}</label>
            <div class="col-lg-4 fv-row isUpdate">
                @if (old('BrRecapTitleInfo') != null)
                    @foreach (old('BrRecapTitleInfo') as $BrRecapTitleInfo)
                        <input type="hidden" name="BrRecapTitleInfo[]" value="{{ $BrRecapTitleInfo }}" />
                    @endforeach
                @else
                    @foreach ($result->BrRecapTitleInfo as $BrRecapTitleInfo)
                        <input type="hidden" name="BrRecapTitleInfo[]"
                            value="{{ $BrRecapTitleInfo->json_data ?? '' }}" />
                    @endforeach
                @endif
                <a href="javascript:void(0);"
                    onclick="get_buildingledger('{{ $result->pnu }}', 'BrRecapTitleInfo', this)"
                    class="btn btn-secondary">업데이트</a>
            </div>
        </div>
    </form>

    <form action="{{ route('admin.buildingledger.brflroulninfo.update') }}" id="BrFlrOulnInfo_submit" method="POST">
        <input type="hidden" name="id" id="id" value="{{ $result->id }}">
        <input type="hidden" name="class" id="class" value="{{ $class }}">
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">층별개요</label>
            <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                {{ $BrFlrOulnInfoCreatedAt ?? null ? $carbon::parse($BrFlrOulnInfoCreatedAt)->format('Y.m.d') : '-' }}</label>
            <div class="col-lg-4 fv-row isUpdate">
                @if (old('BrFlrOulnInfo') != null)
                    @foreach (old('BrFlrOulnInfo') as $BrFlrOulnInfo)
                        <input type="hidden" name="BrFlrOulnInfo[]" value="{{ $BrFlrOulnInfo }}" />
                    @endforeach
                @else
                    @foreach ($result->BrFlrOulnInfo as $BrFlrOulnInfo)
                        <input type="hidden" name="BrFlrOulnInfo[]" value="{{ $BrFlrOulnInfo->json_data ?? '' }}" />
                    @endforeach
                @endif
                <a href="javascript:void(0);"
                    onclick="get_buildingledger('{{ $result->pnu }}', 'BrFlrOulnInfo', this)"
                    class="btn btn-secondary">업데이트</a>
            </div>
        </div>
    </form>

    <form action="{{ route('admin.buildingledger.brexposinfo.update') }}" id="BrExposInfo_submit" method="POST">
        <input type="hidden" name="id" id="id" value="{{ $result->id }}">
        <input type="hidden" name="class" id="class" value="{{ $class }}">
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">전유부</label>
            <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                {{ $BrExposInfoCreatedAt ?? null ? $carbon::parse($BrExposInfoCreatedAt)->format('Y.m.d') : '-' }}</label>
            <div class="col-lg-4 fv-row isUpdate">
                @if (old('BrExposInfo') != null)
                    @foreach (old('BrExposInfo') as $BrExposInfo)
                        <input type="hidden" name="BrExposInfo[]" value="{{ $BrExposInfo }}" />
                    @endforeach
                @else
                    @foreach ($result->BrExposInfo as $BrExposInfo)
                        <input type="hidden" name="BrExposInfo[]" value="{{ $BrExposInfo->json_data ?? '' }}" />
                    @endforeach
                @endif
                <a href="javascript:void(0);" onclick="get_buildingledger('{{ $result->pnu }}', 'BrExposInfo', this)"
                    class="btn btn-secondary">업데이트</a>
            </div>
        </div>
    </form>

    <form action="{{ route('admin.buildingledger.brexpospubuseareainfo.update') }}" id="BrExposPubuseAreaInfo_submit"
        method="POST">
        <input type="hidden" name="id" id="id" value="{{ $result->id }}">
        <input type="hidden" name="class" id="class" value="{{ $class }}">
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">전유공용면적</label>
            <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                {{ $BrExposPubuseAreaInfoCreatedAt ?? null ? $carbon::parse($BrExposPubuseAreaInfoCreatedAt)->format('Y.m.d') : '-' }}</label>
            <div class="col-lg-4 fv-row isUpdate">
                @if (old('BrExposPubuseAreaInfo') != null)
                    @foreach (old('BrExposPubuseAreaInfo') as $BrExposPubuseAreaInfo)
                        <input type="hidden" name="BrExposPubuseAreaInfo[]" value="{{ $BrExposPubuseAreaInfo }}" />
                    @endforeach
                @else
                    @foreach ($result->BrExposPubuseAreaInfo as $BrExposPubuseAreaInfo)
                        <input type="hidden" name="BrExposPubuseAreaInfo[]"
                            value="{{ $BrExposPubuseAreaInfo->json_data ?? '' }}" />
                    @endforeach
                @endif
                <a href="javascript:void(0);"
                    onclick="get_buildingledger('{{ $result->pnu }}', 'BrExposPubuseAreaInfo', this)"
                    class="btn btn-secondary">업데이트</a>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        if (!{{ $isUpdate ?? true }}) {
            $('.isUpdate').hide();
        }
    });

    // 건축물 대장 가져오는 api
    function get_buildingledger(pnu, get_type, element) {
        loadingStart();
        var sigunguCd = pnu.substring(0, 5);
        var bjdongCd = pnu.substring(5, 10);
        var platGbCd = pnu.substring(10, 11) - 1;
        var bun = pnu.substring(11, 15);
        var ji = pnu.substring(15, 20);

        var xhr = new XMLHttpRequest();
        var url = 'http://apis.data.go.kr/1613000/BldRgstService_v2/get' + get_type; // URL
        var queryParams = '?' + encodeURIComponent('serviceKey') + '=' + '{{ env('API_DATE_KEY') }}';
        queryParams += '&' + encodeURIComponent('sigunguCd') + '=' + encodeURIComponent(sigunguCd);
        queryParams += '&' + encodeURIComponent('bjdongCd') + '=' + encodeURIComponent(bjdongCd);
        queryParams += '&' + encodeURIComponent('platGbCd') + '=' + encodeURIComponent(platGbCd);
        queryParams += '&' + encodeURIComponent('bun') + '=' + encodeURIComponent(bun);
        queryParams += '&' + encodeURIComponent('ji') + '=' + encodeURIComponent(ji);
        queryParams += '&' + encodeURIComponent('startDate') + '=' + encodeURIComponent('');
        queryParams += '&' + encodeURIComponent('endDate') + '=' + encodeURIComponent('');
        queryParams += '&' + encodeURIComponent('numOfRows') + '=' + encodeURIComponent('1000');
        queryParams += '&' + encodeURIComponent('pageNo') + '=' + encodeURIComponent('1');

        xhr.open('GET', url + queryParams);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    // XML 문자열을 파싱하여 <item> 엘리먼트의 모든 자식 엘리먼트를 가져옴
                    var xmlDoc = new DOMParser().parseFromString(this.responseText, "text/xml");
                    var itemElements = xmlDoc.querySelectorAll('item');

                    // 여러 개의 <item> 엘리먼트를 순회하면서 데이터를 처리
                    if (itemElements.length > 0) {
                        $(element).parent().find('input').remove();

                        itemElements.forEach(function(itemElement) {
                            var childElements = itemElement.children;
                            var itemData = {};

                            for (var i = 0; i < childElements.length; i++) {
                                itemData[childElements[i].tagName] = childElements[i].textContent.trim();
                            }

                            var inputTag =
                                `<input type="hidden" name="${get_type}[]" value='${JSON.stringify(itemData)}'>`;

                            $(element).parent().append(inputTag);
                        });


                        setTimeout(function() {
                            loadingEnd();
                            $('#' + get_type + '_submit').submit();
                        }, 3000);
                    } else {
                        alert('가져올 건축물 대장 데이터가 없습니다.');
                        loadingEnd();
                    }
                } else {
                    alert('API 요청에 실패했습니다.');
                    loadingEnd();
                }
            }
        };

        xhr.send('');
    }
</script>
