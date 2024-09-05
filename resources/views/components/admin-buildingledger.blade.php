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

    function get_buildingledger(pnu, get_type, element, pageNo = 1, allData = []) {
        loadingStart();
        var sigunguCd = pnu.substring(0, 5);
        var bjdongCd = pnu.substring(5, 10);
        var platGbCd = pnu.substring(10, 11) - 1;
        var bun = pnu.substring(11, 15);
        var ji = pnu.substring(15, 20);

        var xhr = new XMLHttpRequest();
        var url = 'https://apis.data.go.kr/1613000/BldRgstService_v2/get' + get_type;
        var queryParams = '?' + encodeURIComponent('serviceKey') + '=' + '{{ env('API_DATE_KEY') }}';
        queryParams += '&' + encodeURIComponent('sigunguCd') + '=' + encodeURIComponent(sigunguCd);
        queryParams += '&' + encodeURIComponent('bjdongCd') + '=' + encodeURIComponent(bjdongCd);
        queryParams += '&' + encodeURIComponent('platGbCd') + '=' + encodeURIComponent(platGbCd);
        queryParams += '&' + encodeURIComponent('bun') + '=' + encodeURIComponent(bun);
        queryParams += '&' + encodeURIComponent('ji') + '=' + encodeURIComponent(ji);
        queryParams += '&' + encodeURIComponent('numOfRows') + '=' + encodeURIComponent('100');
        queryParams += '&' + encodeURIComponent('pageNo') + '=' + encodeURIComponent(pageNo);

        xhr.open('GET', url + queryParams);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    var xmlDoc = new DOMParser().parseFromString(this.responseText, "text/xml");
                    var itemElements = xmlDoc.querySelectorAll('item');

                    if (itemElements.length > 0) {
                        itemElements.forEach(function(itemElement) {
                            var childElements = itemElement.children;
                            var itemData = {};

                            for (var i = 0; i < childElements.length; i++) {
                                itemData[childElements[i].tagName] = childElements[i].textContent.trim();
                            }

                            allData.push(itemData);
                        });

                        var totalCount = parseInt(xmlDoc.querySelector('totalCount').textContent.trim());
                        var currentCount = pageNo * 100;

                        if (currentCount < totalCount) {
                            // 다음 페이지 데이터 요청
                            get_buildingledger(pnu, get_type, element, pageNo + 1, allData);
                        } else {
                            var formId = get_type + '_submit';
                            var formAction = $('#' + formId).attr('action');
                            var id = $('#' + formId + ' input[name="id"]').val();
                            var classValue = $('#' + formId + ' input[name="class"]').val();

                            // AJAX로 데이터 전송
                            $.ajax({
                                url: formAction,
                                method: 'POST',
                                data: {
                                    data: JSON.stringify(allData),
                                    id: id, // id 값 추가
                                    class: classValue, // class 값 추가
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log('데이터 저장 성공', response);
                                    // 데이터 저장 후 페이지 새로고침
                                    setTimeout(function() {
                                        loadingEnd();
                                        window.location.reload(); // 페이지 새로고침
                                    }, 2000); // 성공 메시지를 본 후 약간의 지연 후 새로고침
                                },
                                error: function(error) {
                                    console.error('데이터 저장 실패', error);
                                    loadingEnd();
                                    alert('데이터 저장 실패');
                                }
                            });
                        }
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
