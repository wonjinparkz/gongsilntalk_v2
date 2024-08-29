<x-layout>
    @inject('carbon', 'Carbon\Carbon')
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">내 자산 관리</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="body">
        <form method="get" action="{{ route('www.mypage.service.update.third.view') }}">
            @php
                $data = $request->all();

                foreach ($data as $key => $value) {
                    echo '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                }
            @endphp

            @php
                // Calculate ownership share as a fraction
                $ownership_share = $result->name_type == 1 ? $result->ownership_share / 100 : 0;

                // Helper function to calculate adjusted price
                function calculateAdjustedPrice($price, $ownership_share)
                {
                    return $ownership_share > 0 ? $price / $ownership_share : $price;
                }

                // Calculate prices based on ownership share
                $price = calculateAdjustedPrice($result->price, $ownership_share);
                $etc_price = calculateAdjustedPrice($result->etc_price, $ownership_share);
                $tax_price = calculateAdjustedPrice($result->tax_price, $ownership_share);
                $estate_price = calculateAdjustedPrice($result->estate_price, $ownership_share);
                $loan_price = calculateAdjustedPrice($result->loan_price, $ownership_share);
            @endphp

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">자산 수정하기 <span class="step_number"><span class="txt_point">2</span>/4</span>
                </h1>

                <div class="offer_step_wrap">

                    <div class="box_01 box_reg">
                        <h4>거래정보</h4>

                        <ul class="tab_type_3 tab_toggle_menu">
                            <li id="tran_type_0_btn" class="{{ $result->tran_type == 0 ? 'active' : '' }}"
                                onclick="onTabChange(0);">매매</li>
                            <li id="tran_type_1_btn" class="{{ $result->tran_type == 1 ? 'active' : '' }}"
                                onclick="onTabChange(1);">분양권</li>
                        </ul>

                        <div class="tab_area_wrap">
                            <div class="input_item_grid">
                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">매매가 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="price_0" name="price_0" inputmode="numeric"
                                                value="{{ $result->tran_type == 0 ? number_format($price) : '' }}"
                                                oninput="onlyNumbers(this); onTextChangeEventIndex('price', 0);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">계약일자 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="contracted_at_0" name="contracted_at_0"
                                                inputmode="numeric" placeholder="예) 20230101"
                                                value="{{ $result->tran_type == 0 ? $carbon::parse($result->contracted_at)->format('Y.m.d') : '' }}"
                                                oninput="onlyNumbers(this); onDateChangeEvent('contracted_at', 0);">
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">취득세율 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="acquisition_tax_rate_0"
                                                value="{{ $result->tran_type == 0 ? $result->acquisition_tax_rate : '' }}"
                                                name="acquisition_tax_rate_0" inputmode="numeric" oninput="imsi(this)"
                                                placeholder="소수점 두자리까지 입력"> <span>%</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">기타비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="etc_price_0" name="etc_price_0"
                                                value="{{ $result->tran_type == 0 ? number_format($etc_price) : '' }}"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEventIndex('etc_price', 0);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">세무비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="tax_price_0" name="tax_price_0"
                                                value="{{ $result->tran_type == 0 ? number_format($tax_price) : '' }}"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEventIndex('tax_price', 0);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">중개보수</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="estate_price_0" name="estate_price_0"
                                                value="{{ $result->tran_type == 0 ? number_format($estate_price) : '' }}"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEventIndex('estate_price', 0);">
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
                                                value="{{ $result->tran_type == 1 ? number_format($price) : '' }}"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEventIndex('price', 1);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">계약일자 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="contracted_at_1" name="contracted_at_1"
                                                value="{{ $result->tran_type == 1 ? $carbon::parse($result->contracted_at)->format('Y.m.d') : '' }}"
                                                inputmode="numeric" placeholder="예) 20230101"
                                                oninput="onlyNumbers(this); onDateChangeEvent('contracted_at', 1);">
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
                                                value="{{ $result->tran_type == 1 ? ($result->registered_at != '' ? $carbon::parse($result->registered_at)->format('Y.m.d') : '') : '' }}"
                                                inputmode="numeric" placeholder="예) 20230101"
                                                oninput="onlyNumbers(this); onDateChangeEvent('registered_at', 1);">
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">취득세율 <span class="txt_point">*</span></label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="acquisition_tax_rate_1"
                                                name="acquisition_tax_rate_1"
                                                value="{{ $result->tran_type == 1 ? $result->acquisition_tax_rate : '' }}"
                                                inputmode="numeric" oninput="imsi(this)" placeholder="소수점 두자리까지 입력">
                                            <span>%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">기타비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="etc_price_1" name="etc_price_1"
                                                value="{{ $result->tran_type == 1 ? number_format($etc_price) : '' }}"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEventIndex('etc_price', 1);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                    <div class="reg_item">
                                        <label class="input_label">세무비용</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="tax_price_1" name="tax_price_1"
                                                value="{{ $result->tran_type == 1 ? number_format($tax_price) : '' }}"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEventIndex('tax_price', 1);">
                                            <span>원</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="reg_mid_wrap">
                                    <div class="reg_item">
                                        <label class="input_label">중개보수</label>
                                        <div class="flex_1 flex_between">
                                            <input type="text" id="estate_price_1" name="estate_price_1"
                                                value="{{ $result->tran_type == 1 ? number_format($estate_price) : '' }}"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEventIndex('estate_price', 1);">
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
                                        value="{{ $result->loan_price > 0 ? number_format($loan_price) : '' }}"
                                        inputmode="numeric"
                                        oninput="onlyNumbers(this); onTextChangeEventIndex('loan_price', 0);">
                                    <span>원</span>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">대출금리</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" id="loan_rate" name="loan_rate"
                                        value="{{ $result->loan_rate > 0 ? $result->loan_rate : '' }}"
                                        inputmode="numeric" oninput="imsi(this)" placeholder="소수점 두자리까지 입력">
                                    <span>%</span>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">대출기간 </label>
                                <div class="flex_1 flex_between">
                                    <input type="text" id="loan_period" name="loan_period"
                                        value="{{ $result->loan_period > 0 ? $result->loan_period : '' }}"
                                        inputmode="numeric" oninput="onlyNumbers(this)">
                                    <span>개월</span>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">대출일자</label>
                                <div class="flex_1 flex_between">
                                    <input type="text" id="loaned_at_0" name="loaned_at_0"
                                        value="{{ $result->loaned_at != '' ? $carbon::parse($result->loaned_at)->format('Y.m.d') : '' }}"
                                        inputmode="numeric" placeholder="예) 20230101"
                                        oninput="onlyNumbers(this); onDateChangeEvent('loaned_at', 0);">
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="">
                                <label class="input_label">대출방식 </label>
                                <div class="btn_radioType mt8">
                                    <input type="radio" name="loan_type" id="loan_type_1" value="0"
                                        {{ $result->loan_type == 0 ? 'checked' : '' }}>
                                    <label for="loan_type_1">해당없음</label>

                                    <input type="radio" name="loan_type" id="loan_type_2" value="1"
                                        {{ $result->loan_type == 1 ? 'checked' : '' }}>
                                    <label for="loan_type_2">원리금균등분할</label>

                                    <input type="radio" name="loan_type" id="loan_type_3" value="2"
                                        {{ $result->loan_type == 2 ? 'checked' : '' }}>
                                    <label for="loan_type_3">원금균등상환</label>

                                    <input type="radio" name="loan_type" id="loan_type_4" value="3"
                                        {{ $result->loan_type == 3 ? 'checked' : '' }}>
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

            @php
                $contracted_at =
                    $result->contracted_at != '' ? $carbon::parse($result->contracted_at)->format('Ymd') : '';

                $registered_at =
                    $result->registered_at != '' ? $carbon::parse($result->registered_at)->format('Ymd') : '';

                $loaned_at = $result->loaned_at != '' ? $carbon::parse($result->loaned_at)->format('Ymd') : '';
            @endphp

            <input type="hidden" id="price" name="price" value="{{ $price }}">
            <input type="hidden" id="etc_price" name="etc_price" value="{{ $etc_price }}">
            <input type="hidden" id="tax_price" name="tax_price" value="{{ $tax_price }}">
            <input type="hidden" id="estate_price" name="estate_price" value="{{ $estate_price }}">
            <input type="hidden" id="contracted_at" name="contracted_at" value="{{ $contracted_at }}">
            <input type="hidden" id="registered_at" name="registered_at" value="{{ $registered_at }}">

            <input type="hidden" id="loan_price" name="loan_price" value="{{ $loan_price }}">
            <input type="hidden" id="loaned_at" name="loaned_at" value="{{ $loaned_at }}">

            <input type="hidden" id="secoundType" name="secoundType" value="{{ $result->tran_type }}">
        </form>
    </div>

    <script>
        window.onload = () => {
            onFieldInputCheck();
        }

        let tabIndex = $('#secoundType').val();

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
            $('#registered_at_' + idx).val('');

            $('#price').val('');
            $('#etc_price').val('');
            $('#tax_price').val('');
            $('#estate_price').val('');
            $('#contracted_at').val('');
            $('#registered_at').val('');
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
                if ($('#price_0').val() != '' && $('#contracted_at_0').val().length == 10 && $('#acquisition_tax_rate_0')
                    .val() !=
                    '') {
                    document.getElementById('nextPageButton').disabled = false;
                } else {
                    document.getElementById('nextPageButton').disabled = false;
                }
            } else {
                if ($('#price_1').val() != '' && $('#contracted_at_1').val().length == 10 && $('#acquisition_tax_rate_1')
                    .val() !=
                    '') {
                    console.log('price_1 : ', $('#price_1').val());
                    console.log('contracted_at_1 : ', $('#contracted_at_1').val());
                    console.log('acquisition_tax_rate_1 : ', $('#acquisition_tax_rate_1').val());
                    document.getElementById('nextPageButton').disabled = false;
                } else {
                    document.getElementById('nextPageButton').disabled = true;
                }
            }
        }

        const processChange = debounce(() => onFieldInputCheck());

        addEventListener("input", (event) => {
            processChange();
        });

        $('input[type="text"]').on('change', function() {
            processChange();
        });
    </script>
</x-layout>
