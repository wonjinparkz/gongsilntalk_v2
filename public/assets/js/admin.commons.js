
// var V_WORD_KEY = "E2C5234B-AE55-3D0D-91C0-6A61FFE0A48B";
// var APP_URL = "https://localhost";


//토지이용계획WFS조회 api
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
        url: "https://api.vworld.kr/ned/wfs/getLandUseWFS",
        data: data,
        async: true,
        success: function (data) {
            $('#useWFS_json').val(JSON.stringify(data.features[0].properties));
        },
        error: function (xhr, stat, err) {
            alert('주소API 오류 WFS 발생 주소를 다시 입력해주세요.');
            $('#address').val('');
        }
    });

}

// 폴리곤 좌표 가져오기 API 함수
function get_coordinates(pnu) {
    var data = {
        key: V_WORD_KEY, // API 키
        domain: APP_URL, // 도메인
        typename: "dt_d002", // 질의 대상 피처 유형 이름
        bbox: "", // 좌표로 이루어진 사각형 영역 (여기서는 사용 안 함)
        pnu: pnu, // 필지 고유번호
        maxFeatures: "10", // 반환할 피처의 최대 개수
        resultType: "results", // 결과 타입 (전체 결과 반환)
        srsName: "EPSG:4326", // 좌표체계
        output: "text/javascript" // 출력 형식
    };

    $.ajax({
        type: "get",
        dataType: "jsonp",
        jsonpCallback: "parseResponse",
        url: "https://api.vworld.kr/ned/wfs/getCtnlgsSpceWFS",
        data: data,
        async: true,
        success: function (response) {
            var features = response.features;
            if (features && features.length > 0) {
                var coordinates = features[0].geometry.coordinates;

                var multiPolygonCoords = coordinates[0][0]; // MultiPolygon의 첫 번째 폴리곤 좌표 추출
                var convertedCoords = multiPolygonCoords.map(function (coord) {
                    return [parseFloat(coord[0]), parseFloat(coord[1])];
                });

                // 변환된 좌표 배열을 문자열로 변환하여 input에 저장
                var coordsString = convertedCoords.map(function (coord) {
                    return '[' + coord[0] + ', ' + coord[1] + ']';
                }).join(',');

                $('#polygon_coordinates').val(coordsString);
            } else {
                alert('POLYGON 데이터를 가져오지 못하였습니다.');
            }
        },
        error: function (xhr, stat, err) {
            alert('POLYGON 오류 발생 주소를 다시 입력해주세요.');
            $('#address').val('');
        }
    });
}

// 토지특성 속성 api
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
        url: "https://api.vworld.kr/ned/data/getLandCharacteristics",
        data: data,
        async: true,
        success: function (data) {
            var field = data.landCharacteristicss.field;

            // 최신 lastUpdtDt를 가진 객체 찾기
            var latest_field = latestField(field);

            $('#characteristics_json').val(JSON.stringify(latest_field));
        },
        error: function (xhr, stat, err) {
            alert('주소API Land 오류 발생 주소를 다시 입력해주세요.');
            $('#address').val('');
        }
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


// 공공데이터 좌표값을 x y 위도경도로 변경해주는 함수
function get_coordinate_conversion(rtentX, rtentY) {
    // proj4에서 UTM 좌표계 정의
    proj4.defs("EPSG:5179",
        "+proj=tmerc +lat_0=38 +lon_0=127.5 +k=0.9996 +x_0=1000000 +y_0=2000000 +ellps=GRS80 +units=m +no_defs");

    // proj4에서 WGS84 좌표계 정의
    proj4.defs("EPSG:4326", "+proj=longlat +datum=WGS84 +no_defs");

    // UTM 좌표를 WGS84로 변환
    var wgs84Coords = proj4("EPSG:5179", "EPSG:4326", [parseFloat(rtentX), parseFloat(rtentY)]);

    return wgs84Coords;
}

// 공공데이터 좌표값을 x y 좌표로 변경해주는 함수
function get_coordinate_conversion1(rtentX, rtentY) {
    // proj4에서 UTM 좌표계 정의
    proj4.defs("EPSG:5179",
        "+proj=tmerc +lat_0=38 +lon_0=127.5 +k=0.9996 +x_0=1000000 +y_0=2000000 +ellps=GRS80 +units=m +no_defs");

    // proj4에서 WGS84 좌표계 정의
    proj4.defs("EPSG:4326", "+proj=longlat +datum=WGS84 +no_defs");

    // UTM 좌표를 WGS84로 변환
    var wgs84Coords = proj4("EPSG:4326", "EPSG:5179", [parseFloat(rtentX), parseFloat(rtentY)]);

    return wgs84Coords;
}



/**
 * 확인만 있는 알림창
 * @param {*} message
 * @param {*} confirmText
 */
function alert(message, confirmText) {
    var confirmText = confirmText ?? "확인"
    Swal.fire({
        title: message,
        buttonsStyling: true,
        showCancelButton: false,
        confirmButtonText: confirmText,
        confirmButtonColor: '#2D2E83',
        padding: 20,
        width: 400,
        allowOutsideClick: false
    }).then(function (result) {
        if (result.value) {
        }
    });
}

// 탭메뉴 토글기능
$(".tab_area_wrap > div").hide();
$(".tab_area_wrap > div").first().show();
$(".side_list_body > div").first().show(); //side 탭 중복 충돌로 추가함.
$(".tab_toggle_menu li").click(function () {
    var list = $(this).index();
    $(this).siblings('li').removeClass("active");
    $(this).addClass("active");
    $(this).parents('.tab_toggle_menu').siblings('.tab_area_wrap').find('>div').hide();
    $(this).parents('.tab_toggle_menu').siblings('.tab_area_wrap').find('>div').eq(list).show();
});


var prev = "";
var regexp = /^\d*(\.\d{0,2})?$/;
var regexp1 = /^\d*(\.\d{0,1})?$/;

// 소수점 리미트 함수
function imsi(obj) {

    // 숫자와 소수점 이외 문자 제거
    obj.value = obj.value.replace(/[^0-9.]/g, "");

    // 유효성 검사
    if (!regexp.test(obj.value)) {
        // 입력 값 자르기 시도
        var match = obj.value.match(/^\d*(\.\d{0,2})?/);

        if (match && match[0] !== "") {
            obj.value = match[0];  // 유효한 부분만 남기기
        } else {
            obj.value = prev;  // 완전히 잘못된 값 복원
        }
    } else {
        prev = obj.value;  // 유효하면 이전 값 업데이트
    }
}

function imsi1(obj) {
   // 숫자와 소수점 이외 문자 제거
   obj.value = obj.value.replace(/[^0-9.]/g, "");

   // 유효성 검사
   if (!regexp1.test(obj.value)) {
       // 입력 값 자르기 시도
       var match = obj.value.match(/^\d*(\.\d{0,1})?/);

       if (match && match[0] !== "") {
           obj.value = match[0];  // 유효한 부분만 남기기
       } else {
           obj.value = prev;  // 완전히 잘못된 값 복원
       }
   } else {
       prev = obj.value;  // 유효하면 이전 값 업데이트
   }
}

// 숫자 입력 최대값
function validateInput(element, max) {
    var value = element.value;
    if (value > max) {
        element.value = max;
    }
}

// 숫자만 입력
function onlyNumbers(element) {
    let value = element.value;
    element.value = '';
    element.value = value.replace(/[^0-9]/g, '');
}

// 금액 콤마
function onTextChangeEvent(element) {
    let value = element.value;
    element.value = '';
    value = value.replace(/[^0-9]/g, '');
    // 만약 입력값이 0으로 시작하고 그 다음에 숫자가 입력되면 0을 제거
    if (value.length > 1 && value[0] === '0') {
        value = value.substring(1);
    }
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    element.value = value;
}

// 금액 콤마
function onTextChangeEventIndex(name, index) {
    let value = $('#' + name + '_' + index).val();
    $('#' + name + '_' + index).val('');
    value = value.replace(/[^0-9]/g, '');
    // 만약 값이 0으로 시작하고 그 다음에 숫자가 입력되면 0을 제거
    if (value.length > 1 && value[0] === '0') {
        value = value.substring(1);
    }
    $('#' + name).val(value);
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#' + name + '_' + index).val((value));
}

// 날짜 입력
function onDateChangeEvent(inputElement) {
    let value = inputElement.value;

    // 숫자만 남기고 나머지는 제거
    value = value.replace(/[^0-9]/g, '');

    // 년, 월, 일 파싱
    let year = value.substring(0, 4);
    let month = value.substring(4, 6);
    let day = value.substring(6, 8);

    // 년도 최소값 체크
    if (year.length === 4) {
        year = Math.max(1700, parseInt(year, 10)).toString();
    }

    // 월 최대/최소값 체크
    if (month.length === 2) {
        month = Math.max(1, Math.min(12, parseInt(month, 10))).toString().padStart(2, '0');
    }

    // 일 최대/최소값 체크
    if (day.length === 2) {
        day = Math.max(1, Math.min(31, parseInt(day, 10))).toString().padStart(2, '0');
    }

    // 날짜를 포맷팅하여 재조립
    let formattedValue = year;
    if (month) {
        formattedValue += '.' + month;
    }
    if (day) {
        formattedValue += '.' + day;
    }

    // 입력값 업데이트
    inputElement.value = formattedValue;
}



