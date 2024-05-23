// 날짜 선택 초기화
var initDatepicker = (input, dateAt) => {
    var start = moment();
    var autoUpdateInput = false;

    if (dateAt != "") {
        start(dateAt, 'YYYYMMDD');
        autoUpdateInput = true;
    }


    input.daterangepicker({
        // startDate: start,
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: autoUpdateInput, // 날짜 자동 -> 처음 접근 시에는 빈값으로 나오도록 한다.
        minYear: 1901,
        minDate: moment().format("YYYY-MM-DD"),
        maxYear: parseInt(moment().format('YYYY'), 12),
        locale: {
            "format": "YYYY-MM-DD",
            "separator": " ~ ",
            "applyLabel": "확인",
            "cancelLabel": "취소",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "범위지정",
            "weekLabel": "W",
            "daysOfWeek": ["일", "월", "화", "수", "목", "금", "토"],
            "monthNames": ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        },

    }, function (start, end, label) {
        input.val(start.format("YYYYMMDD"));
    });
}

// 날짜 선택 초기화
function initDatepickerCustom(input) {

    var autoUpdateInput = false;

    input.daterangepicker({
        // startDate: start,
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: autoUpdateInput, // 날짜 자동 -> 처음 접근 시에는 빈값으로 나오도록 한다.
        minYear: 1901,
        minDate: false,
        maxYear: parseInt(moment().format('YYYY'), 12),
        locale: {
            "format": "YYYY-MM-DD",
            "separator": " ~ ",
            "applyLabel": "확인",
            "cancelLabel": "취소",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "범위지정",
            "weekLabel": "W",
            "daysOfWeek": ["일", "월", "화", "수", "목", "금", "토"],
            "monthNames": ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        },

    }, function (start, end, label) {
        input.val(start.format("YYYYMMDD"));
    });
}

// 날짜 선택 초기화
var rangeOptionToSearch = {
    "오늘": [moment(), moment()],
    "어제": [moment().subtract(1, "days"), moment().subtract(1, "days")],
    "지난 7 일": [moment().subtract(6, "days"), moment()],
    "지난 30 일": [moment().subtract(29, "days"), moment()],
    "이번달": [moment().startOf("month"), moment().endOf("month")],
    "지난달": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
        "month")],
};

var rangeOptionToCreate = {
    "오늘": [moment(), moment()],
    "내일": [moment(), moment().add(1, "days")],
    "7 일": [moment(), moment().add(6, "days")],
    "30 일": [moment(), moment().add(29, "days")],
    "이번달": [moment().startOf("month"), moment().endOf("month")],
    "다음달": [moment().add(1, "month").startOf("month"), moment().add(1, "month").endOf(
        "month")],
};

// 날짜 범위 선택 초기화
// input : 날짜 선택 표기되는 input
// fromInput : 시작 날짜
// toInput : 종료 날짜
// startAt : 기존 입력 시작 날짜
// endAt : 기존 입력 종료 날짜
// rangeOption :  범위 지정 옵션
var initDaterangepicker = (input, fromInput, toInput, startAt, endAt, rangeOption) => {
    //
    var start = moment().subtract(29, "days");
    var end = moment();
    var autoUpdateInput = false;

    // 기존 입력 날짜가 있을 경우
    if (startAt != "" && endAt != "") {
        start = moment(startAt, 'YYYY-MM-DD');
        end = moment(endAt, 'YYYY-MM-DD');
        autoUpdateInput = true;
    }


    input.daterangepicker({
        startDate: start,
        endDate: end,
        autoUpdateInput: autoUpdateInput, // 날짜 자동 -> 처음 접근 시에는 빈값으로 나오도록 한다.
        ranges: rangeOption,
        "locale": {
            "format": "YYYY-MM-DD",
            "separator": " ~ ",
            "applyLabel": "확인",
            "cancelLabel": "취소",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "범위지정",
            "weekLabel": "W",
            "daysOfWeek": ["일", "월", "화", "수", "목", "금", "토"],
            "monthNames": ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        },
    });

    input.on('apply.daterangepicker', function (ev, picker) {
        input.val(picker.startDate.format("YYYY-MM-DD") + ' ~ ' + picker.endDate.format(
            "YYYY-MM-DD"));
        fromInput.val(picker.startDate.format("YYYY-MM-DD"));
        toInput.val(picker.endDate.format("YYYY-MM-DD"));
    });

    input.on('cancel.daterangepicker', function (ev, picker) {
        input.val('');
        fromInput.val('');
        toInput.val('');
    });
}
