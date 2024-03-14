@props([
    'class' => '',
    'result' => [],
])
@inject('carbon', 'Carbon\Carbon')
{{-- 내용 START --}}
<div class="card-body border-top p-9">
    <form action="{{ route('admin.buildingledger.brtitleinfo.update') }}" id="BrTitleInfo_submit" method="POST">
        <input type="hidden" name="id" id="id" value="{{ $result->id }}">
        <input type="hidden" name="class" id="class" value="{{ $class }}">
        <div class="row mb-6">
            <label class="col-lg-2 col-form-label fw-semibold fs-6">표지부</label>
            <label class="col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 :
                {{ $result->BrTitleInfo ? $carbon::parse($result->BrTitleInfo->created_at)->format('Y.m.d') : '-' }}</label>
            <input type="hidden" name="BrTitleInfo" id="BrTitleInfo" class="form-control form-control-solid " readonly
                placeholder=""
                value="{{ old('BrTitleInfo') ? old('BrTitleInfo') : $result->BrTitleInfo->json_data ?? '' }}" />
            <div class="col-lg-4 fv-row">
                <a onclick="get_buildingledger('{{ $result->pnu }}', 'BrTitleInfo')" class="btn btn-secondary">업데이트</a>
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
                {{ $result->BrRecapTitleInfo ? $carbon::parse($result->BrRecapTitleInfo->created_at)->format('Y.m.d') : '-' }}</label>
            <input type="hidden" name="BrRecapTitleInfo" id="BrRecapTitleInfo" class="form-control form-control-solid "
                readonly placeholder=""
                value="{{ old('BrRecapTitleInfo') ? old('BrRecapTitleInfo') : $result->BrRecapTitleInfo->json_data ?? '' }}" />
            <div class="col-lg-4 fv-row">
                <a onclick="get_buildingledger('{{ $result->pnu }}', 'BrRecapTitleInfo')"
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
                {{ $result->BrFlrOulnInfo ? $carbon::parse($result->BrFlrOulnInfo->created_at)->format('Y.m.d') : '-' }}</label>
            <input type="hidden" name="BrFlrOulnInfo" id="BrFlrOulnInfo" class="form-control form-control-solid "
                readonly placeholder=""
                value="{{ old('BrFlrOulnInfo') ? old('BrFlrOulnInfo') : $result->BrFlrOulnInfo->json_data ?? '' }}" />
            <div class="col-lg-4 fv-row">
                <a onclick="get_buildingledger('{{ $result->pnu }}', 'BrFlrOulnInfo')"
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
                {{ $result->BrExposInfo ? $carbon::parse($result->BrExposInfo->created_at)->format('Y.m.d') : '-' }}</label>
            <input type="hidden" name="BrExposInfo" id="BrExposInfo" class="form-control form-control-solid " readonly
                placeholder=""
                value="{{ old('BrExposInfo') ? old('BrExposInfo') : $result->BrExposInfo->json_data ?? '' }}" />
            <div class="col-lg-4 fv-row">
                <a onclick="get_buildingledger('{{ $result->pnu }}', 'BrExposInfo')"
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
                {{ $result->BrExposPubuseAreaInfo ? $carbon::parse($result->BrExposPubuseAreaInfo->created_at)->format('Y.m.d') : '-' }}</label>
            <input type="hidden" name="BrExposPubuseAreaInfo" id="BrExposPubuseAreaInfo"
                class="form-control form-control-solid " readonly placeholder=""
                value="{{ old('BrExposPubuseAreaInfo') ? old('BrExposPubuseAreaInfo') : $result->BrExposPubuseAreaInfo->json_data ?? '' }}" />
            <div class="col-lg-4 fv-row">
                <a onclick="get_buildingledger('{{ $result->pnu }}', 'BrExposPubuseAreaInfo')"
                    class="btn btn-secondary">업데이트</a>
            </div>
        </div>
    </form>
</div>

<script>
    // 건축물 대장 가져오는 api
    function get_buildingledger(pnu, get_type) {
        loadingStart();
        var sigunguCd = pnu.substring(0, 5);
        var bjdongCd = pnu.substring(5, 10);
        var platGbCd = pnu.substring(10, 11) - 1;
        var bun = pnu.substring(11, 15);
        var ji = pnu.substring(15, 20);

        var xhr = new XMLHttpRequest();
        var url = 'http://apis.data.go.kr/1613000/BldRgstService_v2/' + 'get' + get_type; /*URL*/
        var queryParams = '?' + encodeURIComponent('serviceKey') + '=' +
            '{{ env('API_DATE_KEY') }}'; /*Service Key*/
        queryParams += '&' + encodeURIComponent('sigunguCd') + '=' + encodeURIComponent(sigunguCd); /**/
        queryParams += '&' + encodeURIComponent('bjdongCd') + '=' + encodeURIComponent(bjdongCd); /**/
        queryParams += '&' + encodeURIComponent('platGbCd') + '=' + encodeURIComponent(platGbCd); /**/
        queryParams += '&' + encodeURIComponent('bun') + '=' + encodeURIComponent(bun); /**/
        queryParams += '&' + encodeURIComponent('ji') + '=' + encodeURIComponent(ji); /**/
        queryParams += '&' + encodeURIComponent('startDate') + '=' + encodeURIComponent(''); /**/
        queryParams += '&' + encodeURIComponent('endDate') + '=' + encodeURIComponent(''); /**/
        queryParams += '&' + encodeURIComponent('numOfRows') + '=' + encodeURIComponent('10'); /**/
        queryParams += '&' + encodeURIComponent('pageNo') + '=' + encodeURIComponent('1'); /**/
        xhr.open('GET', url + queryParams);
        xhr.onreadystatechange = function() {
            if (this.readyState == 4) {
                // XML 문자열을 파싱하여 <item> 엘리먼트의 모든 자식 엘리먼트를 가져옴
                var xmlDoc = new DOMParser().parseFromString(this.responseText, "text/xml");
                var itemElement = xmlDoc.querySelector('item');

                // <item> 엘리먼트의 모든 자식 엘리먼트를 순회하면서 콘솔에 출력
                if (itemElement) {
                    var childElements = itemElement.children;

                    var itemData = {};
                    for (var i = 0; i < childElements.length; i++) {
                        itemData[childElements[i].tagName] = childElements[i].textContent
                    }
                    $('#' + get_type).val(JSON.stringify(itemData));
                    console.log(itemData);
                    setTimeout(function() {
                        loadingEnd();
                        $('#' + get_type + '_submit').submit();
                    }, 3000);
                } else {
                    alert('가져올 건출물 대장 데이터가 없습니다.');
                    loadingEnd();
                }
            }
        };

        xhr.send('');
    }
</script>
