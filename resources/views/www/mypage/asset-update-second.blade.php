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
        <form method="get" action="{{ route('www.mypage.service.create.third.view') }}">
            @php
                $data = $request->all();

                foreach ($data as $key => $value) {
                    echo '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                }
            @endphp

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">자산 등록하기 <span class="step_number"><span class="txt_point">2</span>/4</span>
                </h1>

                <div class="offer_step_wrap">

                    <div class="box_01 box_reg">
                        <h4>거래정보</h4>

                        <ul class="tab_type_3 tab_toggle_menu">
                            <li class="active" onclick="onTabChange(0);">매매</li>
                            <li onclick="onTabChange(1);">분양권</li>
                        </ul>

                        <div class="tab_area_wrap">
                            <div class="input_item_grid">
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">매매가 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="price_0" name="price_0"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('price', 0);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">계약일자 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="contracted_at_0" name="contracted_at_0"
                                                placeholder="예) 20230101"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onDateChangeEvent('contracted_at', 0);">
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">취득세율 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="number" id="acquisition_tax_rate_0" step=0.01
                                                name="acquisition_tax_rate_0" placeholder="소수점 두자리까지 입력"> <span>%</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">기타비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="etc_price_0" name="etc_price_0"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('etc_price', 0);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">세무비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="tax_price_0" name="tax_price_0"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('tax_price', 0);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">부동산수수료</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="estate_price_0" name="estate_price_0"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('estate_price', 0);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="input_item_grid">
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">분양가 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="price_1" name="price_1"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('price', 1);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">계약일자 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="contracted_at_1" name="contracted_at_1"
                                                placeholder="예) 20230101"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onDateChangeEvent('contracted_at', 1);">
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <div class="flex_between">
                                            <label class="input_label">등기일</label>
                                            <span class="gray_basic">* 건물 준공 후 기입</span>
                                        </div>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="registered_at_1" name="registered_at_1"
                                                disabled placeholder="예) 20240101"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">취득세율 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="number" id="acquisition_tax_rate_1"  step=0.01
                                                name="acquisition_tax_rate_1" placeholder="소수점 두자리까지 입력">
                                            <span>%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">기타비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="etc_price_1" name="etc_price_1"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('etc_price', 1);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">세무비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="tax_price_1" name="tax_price_1"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('tax_price', 1);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">부동산수수료</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="estate_price_1" name="estate_price_1"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                onkeyup="onTextChangeEvent('estate_price', 1);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box_01 box_reg">
                        <h4>대출정보</h4>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">대출금액</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" id="loan_price_0" name="loan_price_0"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        onkeyup="onTextChangeEvent('loan_price', 0);"> <span>원</span>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">대출금리</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" id="loan_rate" name="loan_rate"
                                        placeholder="소수점 두자리까지 입력"> <span>%</span>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">대출기간 </label>
                                <div class="flex_1 flex_between">
                                    <input type="number" max="12" min="0" id="loan_period"
                                        name="loan_period"> <span>개월</span>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">대출일자</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" id="loaned_at_0" name="loaned_at_0"
                                        placeholder="예) 20230101"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                        onkeyup="onDateChangeEvent('loaned_at', 0);">
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="">
                                <label class="input_label">대출방식 </label>
                                <div class="btn_radioType mt8">
                                    <input type="radio" name="loan_type" id="loan_type_1" value="0">
                                    <label for="loan_type_1">해당없음</label>

                                    <input type="radio" name="loan_type" id="loan_type_2" value="1" checked>
                                    <label for="loan_type_2">원리금균등분할</label>

                                    <input type="radio" name="loan_type" id="loan_type_3" value="2">
                                    <label for="loan_type_3">원금균등상환</label>

                                    <input type="radio" name="loan_type" id="loan_type_4" value="3">
                                    <label for="loan_type_4">만기상환</label>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="step_btn_wrap">
                        <button class="btn_full_basic btn_graylight_ghost" type="button"
                            onclick="javascript:history.back();">이전</button>
                        <button class="btn_full_basic btn_point" id="nextPageButton" type="submit"
                            disabled>다음</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->

            <input type="hidden" id="price" name="price" value="">
            <input type="hidden" id="etc_price" name="etc_price" value="">
            <input type="hidden" id="tax_price" name="tax_price" value="">
            <input type="hidden" id="estate_price" name="estate_price" value="">
            <input type="hidden" id="contracted_at" name="contracted_at" value="">

            <input type="hidden" id="loan_price" name="loan_price" value="">
            <input type="hidden" id="loaned_at" name="loaned_at" value="">

            <input type="hidden" id="secoundType" name="secoundType" value="">
        </form>
    </div>

    <script>
        let tabIndex = 0;

        // 매매 / 분양권 인덱스 변경
        function onTabChange(idx) {
            tabIndex = idx;

            $('#secoundType').val(tabIndex);

            $('#price_' + idx).val('');
            $('#etc_price_' + idx).val('');
            $('#tax_price_' + idx).val('');
            $('#estate_price_' + idx).val('');
            $('#contracted_at_' + idx).val('');
            $('#acquisition_tax_rate_' + idx).val('');

            $('#price').val('');
            $('#etc_price').val('');
            $('#tax_price').val('');
            $('#estate_price').val('');
            $('#contracted_at').val('');
        }

        function debounce(func, timeout = 300) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        // 다음 버튼 활성화
        function onFieldInputCheck() {

            if (tabIndex == 0) {
                if ($('#price_0').val() != '' && $('#contracted_at_0').val() != '' && $('#acquisition_tax_rate_0').val() !=
                    '') {
                    document.getElementById('nextPageButton').disabled = false;
                }
            } else {
                if ($('#price_1').val() != '' && $('#contracted_at_1').val() != '' && $('#acquisition_tax_rate_1').val() !=
                    '') {
                    document.getElementById('nextPageButton').disabled = false;
                }
            }
        }

        const processChange = debounce(() => onFieldInputCheck());

        addEventListener("input", (event) => {
            processChange();
        });


        // 금액 한글 변환
        function onTextChangeEvent(name, index) {
            $('#' + name).val($('#' + name + '_' + index).val());
            setTimeout(function() {
                $('#' + name + '_' + index).val(numberToKorean(parseInt($('#' + name).val())));
            }, 3000);
        }

        // 숫자 날짜 포맷
        function onDateChangeEvent(name, index) {
            $('#' + name).val($('#' + name + '_' + index).val());
            setTimeout(function() {
                if ($('#' + name + '_' + index).val() != '') {
                    $('#' + name + '_' + index).val(numberToDate(parseInt($('#' + name).val())));
                }
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
