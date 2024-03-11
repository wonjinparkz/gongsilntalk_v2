
var V_WORD_KEY = "E2C5234B-AE55-3D0D-91C0-6A61FFE0A48B";
var APP_URL = "http://localhost";

// 폴리곤 좌표 가져오기
function get_coordinates(pnu) {

    var data = {};
    data.key = V_WORD_KEY; /* key */
    data.domain = APP_URL; /* domain */
    data.typename = "dt_d002"; /* 질의 대상인 하나 이상의 피처 유형 이름의 리스트, 값은 쉼표로 구분화면 하단의 [레이어 목록] 참고 */
    data.bbox = ""; /* 필지고유번호 19자리중 최소 8자리(시도[2]+시군구[3]+읍면동[3])(입력시 bbox값은 무시) */
    data.pnu = pnu;
    data.maxFeatures = "10"; /* 요청에 대한 응답으로 WFS가 반환해야하는 피처의 최대 값(최대 허용값 : 1000) */
    data.resultType = "results"; /* 요청에 대하여 WFS가 어떻게 응답할 것인지 정의.results 값은 요청된 모든 피처를 포함하는 완전한 응답이 생성되어야 함을 나타내며, hits 값은 피처의 개수만이 반환되어야 함을 의미 */
    data.srsName = "EPSG:4326"; /* 반환되어야 할 피처의 기하에 사용되어야 할 WFS가 지원하는 좌표체계 */

    data.output = "text/javascript"; /* output */

    $.ajax({
        type: "get",
        dataType: "jsonp",
        jsonpCallback: "parseResponse",
        url: "http://api.vworld.kr/ned/wfs/getCtnlgsSpceWFS",
        data: data,
        async: false,
        success: function (data) {
            $('#coordinates').val(data.bbox);
        },
        error: function (xhr, stat, err) { }
    });

}

// 토지특성 속성
function get_characteristics(pnu) {

    var data = {};
    data.key = V_WORD_KEY; /* key */
    data.domain = APP_URL; /* domain */
    data.pnu = pnu; /* 고유번호(8자리 이상) */
    data.stdrYear = ""; /* 기준연도(YYYY: 4자리) */
    data.format = "json"; /* 응답결과 형식(json) */
    data.numOfRows = "10"; /* 검색건수 (최대 1000) */
    data.pageNo = "1"; /* 페이지 번호 */


    $.ajax({
        type: "get",
        dataType: "jsonp",
        url: "http://api.vworld.kr/ned/data/getLandCharacteristics",
        data: data,
        async: false,
        success: function (data) {
            var field = data.landCharacteristicss.field;

            // 최신 lastUpdtDt를 가진 객체 찾기
            var latest_field = latestField(field);

            $('#characteristics').val(JSON.stringify(latest_field));
        },
        error: function (xhr, stat, err) { }
    });
}


// 최신 lastUpdtDt를 가진 객체 찾는 함수
function latestField(fieldArray) {
    if (fieldArray.length === 0) {
        return null;
    }

    var field = fieldArray[0];
    var latestDate = new Date(field.lastUpdtDt);

    for (var i = 1; i < fieldArray.length; i++) {
        var currentDate = new Date(fieldArray[i].lastUpdtDt);

        if (currentDate > latestDate) {
            field = fieldArray[i];
            latestDate = currentDate;
        }
    }

    return field;
}

//토지이용계획WFS조회
function gte_useWFS(pnu) {
    var data = {};
    data.key = V_WORD_KEY; /* key */
    data.domain = APP_URL; /* domain */
    data.typename = "dt_d154"; /* 질의 대상인 하나 이상의 피처 유형 이름의 리스트, 값은 쉼표로 구분화면 하단의 [레이어 목록] 참고 */
    data.bbox = ""; /* 좌표로 이루어진 사각형 안에 담겨 있는 (또는 부분적으로 걸쳐 있는) 피처를 검색. 좌표 순서는 사용되는 좌표 시스템을 따름.일반적 표현은 하단좌표, 상단좌표, 좌표체계 순서입니다.(xmin,ymin,xmax,ymax,좌표체계)<span class="red">예외) EPSG:4326</span> 경우 (ymin,xmin,ymax,xmax) */
    data.pnu = pnu; /* 필지고유번호 19자리중 최소 8자리(시도[2]+시군구[3]+읍면동[3])(입력시 bbox값은 무시) */
    data.maxFeatures = "10"; /* 요청에 대한 응답으로 WFS가 반환해야하는 피처의 최대 값(최대 허용값 : 1000) */
    data.resultType = "results"; /* 요청에 대하여 WFS가 어떻게 응답할 것인지 정의.results 값은 요청된 모든 피처를 포함하는 완전한 응답이 생성되어야 함을 나타내며, hits 값은 피처의 개수만이 반환되어야 함을 의미 */
    data.srsName = "EPSG:4326"; /* 반환되어야 할 피처의 기하에 사용되어야 할 WFS가 지원하는 좌표체계 */

    data.output = "text/javascript"; /* output */

    $.ajax({
        type: "get",
        dataType: "jsonp",
        jsonpCallback: "parseResponse",
        url: "http://api.vworld.kr/ned/wfs/getLandUseWFS",
        data: data,
        async: false,
        success: function (data) {
            console.log(data);
        },
        error: function (xhr, stat, err) { }
    });

}


//토지이용계획WFS조회
function gte_useWFS(pnu) {
    var data = {};
    data.key = V_WORD_KEY; /* key */
    data.domain = APP_URL; /* domain */
    data.typename = "dt_d154"; /* 질의 대상인 하나 이상의 피처 유형 이름의 리스트, 값은 쉼표로 구분화면 하단의 [레이어 목록] 참고 */
    data.bbox = ""; /* 좌표로 이루어진 사각형 안에 담겨 있는 (또는 부분적으로 걸쳐 있는) 피처를 검색. 좌표 순서는 사용되는 좌표 시스템을 따름.일반적 표현은 하단좌표, 상단좌표, 좌표체계 순서입니다.(xmin,ymin,xmax,ymax,좌표체계)<span class="red">예외) EPSG:4326</span> 경우 (ymin,xmin,ymax,xmax) */
    data.pnu = pnu; /* 필지고유번호 19자리중 최소 8자리(시도[2]+시군구[3]+읍면동[3])(입력시 bbox값은 무시) */
    data.maxFeatures = "10"; /* 요청에 대한 응답으로 WFS가 반환해야하는 피처의 최대 값(최대 허용값 : 1000) */
    data.resultType = "results"; /* 요청에 대하여 WFS가 어떻게 응답할 것인지 정의.results 값은 요청된 모든 피처를 포함하는 완전한 응답이 생성되어야 함을 나타내며, hits 값은 피처의 개수만이 반환되어야 함을 의미 */
    data.srsName = "EPSG:4326"; /* 반환되어야 할 피처의 기하에 사용되어야 할 WFS가 지원하는 좌표체계 */

    data.output = "text/javascript"; /* output */

    $.ajax({
        type: "get",
        dataType: "jsonp",
        jsonpCallback: "parseResponse",
        url: "http://api.vworld.kr/ned/wfs/getLandUseWFS",
        data: data,
        async: false,
        success: function (data) {
            console.log(data.features[0].properties);
        },
        error: function (xhr, stat, err) { }
    });

}
function parseResponse(response) {
    console.log(response);
    // 응답 데이터에 대한 추가 처리를 이곳에서 수행할 수 있습니다.
}

function get_buildingledger(sigunguCd,bjdongCd,platGbCd,bun,ji,get_type) {

    var xhr = new XMLHttpRequest();
    var url = 'http://apis.data.go.kr/1613000/BldRgstService_v2/'+'get_'+get_type; /*URL*/
    var queryParams = '?' + encodeURIComponent('serviceKey') + '=' + '3LBdPPEIVGX5U%2BG3UhqXWsNiJlSJOcPDuob1CwFAV7B%2Fkonwgko9ju7crwm4q155pwrHnO%2Bj57fDrO4xIvdbrg%3D%3D'; /*Service Key*/
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
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
           // XML 문자열을 파싱하여 <item> 엘리먼트의 모든 자식 엘리먼트를 가져옴
           var xmlDoc = new DOMParser().parseFromString(this.responseText, "text/xml");
           var itemElement = xmlDoc.querySelector('item');

           // <item> 엘리먼트의 모든 자식 엘리먼트를 순회하면서 콘솔에 출력
           var childElements = itemElement.children;
           var itemData = {};
           for (var i = 0; i < childElements.length; i++) {
                itemData[childElements[i].tagName] = childElements[i].textContent
           }
           console.log(itemData);
           $('#'+get_type).val(itemData);
        }
    };

    xhr.send('');

}


