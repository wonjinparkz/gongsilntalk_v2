@props([
    'title' => '검색',
    'from_name' => 'from_created_at',
    'to_name' => 'to_created_at',
    'from_date' => '',
    'to_date' => '',
])


<input class="form-control form-control-solid" placeholder="{{ $title }}"
    id="daterangepicker_{{ $from_name }}" />
{{-- 시작일 --}}
<input type="hidden" id="{{ $from_name }}" name="{{ $from_name }}" value="{{ Request::get($from_name) ?? $from_date}}">
{{-- 종료일 --}}
<input type="hidden" id="{{ $to_name }}" name="{{ $to_name }}" value="{{ Request::get($to_name) ?? $to_date }}">

<script>
    @if (Request::get($from_name) != null && Request::get($to_name) !=null)
        var start = moment('{{ Request::get($from_name) }}', 'YYYY-MM-DD');
        var end = moment('{{ Request::get($to_name) }}', 'YYYY-MM-DD');
        var autoUpdateInput = true;

    @else
        @if ($from_date != null && $to_date != null)
            var start = moment('{{ $from_date }}', 'YYYY-MM-DD');
            var end = moment('{{ $to_date }}', 'YYYY-MM-DD');
            var autoUpdateInput = true;
        @else
            var start = moment().subtract(29, "days");
            var end = moment();
            var autoUpdateInput = false;
        @endif
    @endif


    var dateInput = $("#daterangepicker_{{ $from_name }}");

    dateInput.daterangepicker({
        startDate: start,
        endDate: end,
        autoUpdateInput: autoUpdateInput, // 날짜 자동 -> 처음 접근 시에는 빈값으로 나오도록 한다.
        ranges: {
            // '없음': [null, null],
            "오늘": [moment(), moment()],
            "어제": [moment().subtract(1, "days"), moment().subtract(1, "days")],
            "지난 7 일": [moment().subtract(6, "days"), moment()],
            "지난 30 일": [moment().subtract(29, "days"), moment()],
            "이번달": [moment().startOf("month"), moment().endOf("month")],
            "지난달": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                "month")],
        },
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

    dateInput.on('apply.daterangepicker', function(ev, picker) {
        $('#daterangepicker_{{ $from_name }}').val(picker.startDate.format("YYYY-MM-DD") + ' ~ ' + picker
            .endDate.format(
                "YYYY-MM-DD"));
        $('#{{ $from_name }}').val(picker.startDate.format("YYYY-MM-DD"));
        $('#{{ $to_name }}').val(picker.endDate.format("YYYY-MM-DD"));
    });

    dateInput.on('cancel.daterangepicker', function(ev, picker) {
        $('#daterangepicker_{{ $from_name }}').val('');
        $('#{{ $from_name }}').val('');
        $('#{{ $to_name }}').val('');
    });
</script>
