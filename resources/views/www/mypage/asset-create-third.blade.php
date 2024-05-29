<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">내 자산 관리</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        <form method="get" action="{{ route('www.mypage.service.create.fourth.view') }}">
            @php
                $data = $request->all();

                foreach ($data as $key => $value) {
                    echo '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                }
            @endphp
            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">자산 등록하기 <span class="step_number"><span class="txt_point">3</span>/4</span>
                </h1>

                <div class="offer_step_wrap">

                    <div class="box_01 box_reg">
                        <h4>임대차 계약 정보</h4>

                        <div>
                            <label class="input_label">공실여부 <span class="txt_point">*</span></label>
                            <div class="btn_radioType mt8">
                                <input type="radio" name="vacancy" id="vacancy_1" value="0" checked>
                                <label for="vacancy_1">공실</label>

                                <input type="radio" name="vacancy" id="vacancy_2" value="1">
                                <label for="vacancy_2">계약중</label>

                                <input type="radio" name="vacancy" id="vacancy_3" value="2">
                                <label for="vacancy_3">미임대</label>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">임차인명</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" id="tenant_name" name="tenant_name" class="tenantClass"
                                        disabled>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">임차인 연락처</label>
                                <div class="flex_1 flex_between">
                                    <input type="number" placeholder="예) 01012345678" class="tenantClass"
                                        id="tenant_phone" name="tenant_phone" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">임대료 납부 방법</label>
                                <div class="btn_radioType mt8">
                                    <input type="radio" class="tenantClass" name="pay_type" id="pay_type_1"
                                        value="0" checked>
                                    <label for="pay_type_1">선택 안함</label>

                                    <input type="radio" class="tenantClass" name="pay_type" id="pay_type_2"
                                        value="1">
                                    <label for="pay_type_2">후불</label>

                                    <input type="radio" class="tenantClass"name="pay_type" id="pay_type_3"
                                        value="2">
                                    <label for="pay_type_3">선불</label>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <div class="flex_between">
                                    <div class="item">
                                        <label class="input_label">보증금</label>
                                        <div class="flex_1">
                                            <input type="text" class="tenantClass" id="check_price_temp"
                                                name="check_price_temp" disabled
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('check_price');"><span>/</span>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <label class="input_label">월임대료</label>
                                        <div class="flex_1">
                                            <input type="text" class="tenantClass" id="month_price_temp"
                                                name="month_price_temp" disabled
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('month_price');"><span>원</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">월세 입금일</label>
                                <div class="dropdown_box w_full ">
                                    <button class="dropdown_label disabled" id="deposit_day_button"
                                        name="deposit_day_button" type="button" class="tenantClass">월세 입금일 선택
                                    </button>
                                    <ul class="optionList">
                                        @for ($i = 1; $i < 31; $i++)
                                            <li class="optionItem" onclick="depositDayChange('{{$i}}일');">{{ $i }}일</li>
                                        @endfor
                                        <li class="optionItem" onclick="depositDayChange('말일');">말일</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap w_30">
                            <div class="input_calendar_term">
                                <div>
                                    <label class="input_label">계약시작일</label>
                                    <input type="text" id="started_at_temp" name="started_at_temp"
                                        class="tenantClass" placeholder="예) 20230101" disabled
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        onkeyup="onDateChangeEvent('started_at');">
                                </div>
                                <span>~</span>
                                <div>
                                    <label class="input_label">계약종료일</label>
                                    <input type="text" class="tenantClass" id="ended_at_temp"
                                        name="ended_at_temp" placeholder="예) 20230101" disabled
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        onkeyup="onDateChangeEvent('ended_at');">
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="step_btn_wrap">
                        <button class="btn_full_basic btn_graylight_ghost" type="button"
                            onclick="javascript:history.back();">이전</button>
                        <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point" type="submit">다음</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->

            <input type="hidden" id="is_vacancy" name="is_vacancy">
            <input type="hidden" id="month_price" name="month_price">
            <input type="hidden" id="check_price" name="check_price">
            <input type="hidden" id="started_at" name="started_at">
            <input type="hidden" id="ended_at" name="ended_at">
            <input type="hidden" id="deposit_day" name="deposit_day">
        </form>
    </div>

    <script>
        // 계약중 선택 아닐시 disabled
        $('input[type=radio][name=vacancy]').change(function() {
            let checkedValue = document.querySelector('input[name="vacancy"]:checked').value;
            $('#is_vacancy').val(checkedValue);

            const tenantList = document.querySelectorAll('.tenantClass');
            if (checkedValue == 1) {
                document.getElementById('deposit_day_button').className = 'dropdown_label';
                tenantList.forEach(element => {
                    element.disabled = false;
                });
            } else {
                document.getElementById('deposit_day_button').className = 'dropdown_label disabled';
                tenantList.forEach(element => {
                    element.disabled = true;
                });
            }
        });

        function depositDayChange(string) {
            $('#deposit_day').val(string);
        }

        // 금액 한글 변환
        function onTextChangeEvent(name) {
            $('#' + name).val($('#' + name + '_temp').val());
            setTimeout(function() {
                $('#' + name + '_temp').val(numberToKorean(parseInt($('#' + name).val())));
            }, 3000);
        }

        // 숫자 날짜 포맷
        function onDateChangeEvent(name) {
            $('#' + name).val($('#' + name + '_temp').val());
            setTimeout(function() {
                $('#' + name + '_temp').val(numberToDate(parseInt($('#' + name).val())));
            }, 3000);
        }

        //기본 토글 이벤트
        $(".proposal_toggle_btn").click(function() {
            $(this).toggleClass("toggled");
            if ($(this).hasClass("toggled")) {
                $(this).css("transform", "rotate(180deg)");
            } else {
                $(this).css("transform", "rotate(0deg)");
            }

            $(".proposal_table_wrap").stop().slideToggle(300);
            return false;
        });

        // 숫자 => 한글로 변경
        function numberToKorean(number) {
            var inputNumber = number < 0 ? false : number;
            var unitWords = ['', '만', '억', '조', '경'];
            var splitUnit = 10000;
            var splitCount = unitWords.length;
            var resultArray = [];
            var resultString = '';

            for (var i = 0; i < splitCount; i++) {
                var unitResult = (inputNumber % Math.pow(splitUnit, i + 1)) / Math.pow(splitUnit, i);
                unitResult = Math.floor(unitResult);
                if (unitResult > 0) {
                    resultArray[i] = unitResult;
                }
            }

            for (var i = 0; i < resultArray.length; i++) {
                if (!resultArray[i]) continue;
                resultString = String(resultArray[i]) + unitWords[i] + resultString;
            }

            return resultString;
        }

        // 숫자 => 날짜로 변경
        function numberToDate(number) {
            var inputNumber = (number < 0) ? false : number;
            var resultString = '';

            inputNumber = inputNumber + '';

            var year = inputNumber.substr(0, 4);
            var month = inputNumber.substr(4, 2);
            var day = inputNumber.substr(6, 2);

            resultString = year + "." + month + "." + day;

            let date = new Date(year + "-" + month + "-" + day);

            return resultString;
        }
    </script>
</x-layout>
