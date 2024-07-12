<x-layout>


    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 제안서 받기 <span class="gray_basic"><span class="txt_point">2</span>/3</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->


    <div class="body">
        <form method="get" action="{{ route('www.mypage.user.offer.third.create.view') }}" id="create_form"
            name="create_form">

            @php
                $data = $request->all();

                foreach ($data as $key => $value) {
                    if (gettype($value) != 'array') {
                        echo '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                    } else {
                        foreach ($value as $array_key => $arrayVal) {
                            echo '<input type="hidden" id="' .
                                $key .
                                '[]" name="' .
                                $key .
                                '[]" value="' .
                                $arrayVal .
                                '">';
                        }
                    }
                }
            @endphp


            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">매물 제안서 받기 <span class="step_number"><span
                            class="txt_point">2</span>/3</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>예산을 알려주세요.</h4>
                        <div class="btn_radioType">
                            <input type="radio" name="budget_type" id="budget_type_1" value="0" checked>
                            <label for="budget_type_1" onclick="showDiv('type', 0)">매매</label>

                            <input type="radio" name="budget_type" id="budget_type_2" value="1">
                            <label for="budget_type_2" onclick="showDiv('type', 1)">월세</label>
                        </div>
                        <div class="type_wrap">
                            <div class="type_item open_key active">
                                <div class="w_30">
                                    <label class="input_label">매매가 <span>*</span></label>
                                    <div class="flex_1 flex_between">
                                        <input type="text" id="price_0" name="price_0"
                                            onkeypress="onlyNumbers(event)" oninput="onTextChangeEvent('price_0');">
                                        <span>원</span>
                                    </div>
                                </div>
                            </div>
                            <div class="type_item open_key">
                                <div class="w_30">
                                    <label class="input_label">보증금 <span>*</span></label>
                                    <div class="flex_1 flex_between">
                                        <input type="text" id="price_1" name="price_1"
                                            onkeypress="onlyNumbers(event)" oninput="onTextChangeEvent('price_1');">
                                        <span>원</span>
                                    </div>
                                </div>
                                <div class="w_30 mt28">
                                    <label class="input_label">월 임대료 <span>*</span></label>
                                    <div class="flex_1 flex_between">
                                        <input type="text" id="month_price" name="month_price"
                                            onkeypress="onlyNumbers(event)" oninput="onTextChangeEvent('month_price');">
                                        <span>원</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="box_01 box_reg">
                        <h4>제안 받을 의뢰인의 정보를 입력해주세요.</h4>

                        @if ($request->type == 0)
                            <div class="w_30">
                                <label class="input_label">의뢰인명 <span>*</span></label>
                                <input type="text" id="client_name_0" name="client_name_0" placeholder="예) 홍길동">
                            </div>
                        @else
                            <!-- 지산/사무실/창고, 단독공장 일 경우 -->
                            <div class="w_30">
                                <label class="input_label">회사명 <span>*</span></label>
                                <input type="text" id="client_name_1" name="client_name_1" placeholder="예) 홍길동">
                            </div>

                            <div class="w_30">
                                <label class="input_label">업종</label>
                                <div class="dropdown_box only_pc mt8">
                                    <button class="dropdown_label" type="button">업종 선택</button>
                                    <ul class="optionList">
                                        @foreach (Lang::get('commons.client_type') as $key => $client_type)
                                            <li class="optionItem" onclick="onClientTypeChange('{{ $key }}');">
                                                {{ $client_type }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!----------------------- M::희망 업종 : s ----------------------->
                                <div class="dropdown_box m_full only_m mt8">
                                    <button class="dropdown_label" type="button"
                                        onclick="modal_open_slide('biz_type')">희망
                                        업종 선택</button>
                                </div>
                                <div class="modal_slide modal_slide_biz_type">
                                    <div class="slide_title_wrap">
                                        <span>희망 업종 선택</span>
                                        <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                            onclick="modal_close_slide('biz_type')">
                                    </div>
                                    <ul class="slide_modal_menu">
                                        @foreach (Lang::get('commons.client_type') as $key => $client_type)
                                            <li>
                                                <a href="#" onclick="onClientTypeChange('{{ $key }}');">
                                                    {{ $client_type }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="md_slide_overlay md_slide_overlay_biz_type"
                                    onclick="modal_close_slide('biz_type')"></div>
                                <!----------------------- M::희망 업종 : e ----------------------->
                            </div>
                        @endif


                    </div>

                    <div class="step_btn_wrap">
                        <button class="btn_full_basic btn_graylight_ghost" type="button"
                            onclick="javascript:history.back();">이전</button>
                        <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point" type="button" id="nextPageButton"
                            onclick="onFormSubmit();" disabled>다음</button>
                    </div>

                </div>
            </div>

            <input type="hidden" id="client_type" name="client_type" value="">
        </form>
        <!-- my_body : e -->

    </div>

    <script>
        function onlyNumbers(event) {
            // 숫자 이외의 문자가 입력되면 이벤트를 취소합니다.
            if (!/\d/.test(event.key) && event.key !== 'Backspace') {
                event.preventDefault();
            }
        }

        // 금액 콤마 변환
        function onTextChangeEvent(name) {
            let value = $('#' + name).val();
            value = value.replace(/,/g, '');
            value = Number(value).toLocaleString('en');
            $('#' + name).val((value == 0 ? '' : value));
        }

        function removeCommas(name) {
            let value = $('#' + name).val();
            value = value.replace(/,/g, '');
            $('#' + name).val(value);
        }

        function onFormSubmit() {
            removeCommas('price_0');
            removeCommas('price_1');
            removeCommas('month_price');

            $('#create_form').submit();
        }

        function onClientTypeChange(index) {
            $('#client_type').val(index);
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

        //입력란 열고 닫기
        function showDiv(className, index) {
            var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
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

        function onFieldInputCheck() {

            var monthPriceCheck = false;
            var priceCheck = false;
            var clientNameCheck = false;
            var clientTypeCheck = false;

            if ($("input[name='budget_type']:checked").val() == '0') {
                priceCheck = ($('#price_0').val() != '') ? true : false;
                monthPriceCheck = true;
            } else {
                priceCheck = ($('#price_1').val() != '') ? true : false;
                monthPriceCheck = ($('#month_price').val() != '') ? true : false;
            }

            if ($('#type').val() == '0') {
                clientNameCheck = ($('#client_name_0').val() != '') ? true : false;
                clientTypeCheck = true;
            } else {
                clientNameCheck = ($('#client_name_1').val() != '') ? true : false;
                clientTypeCheck = ($('#client_type').val() != '') ? true : false;
            }
            console.log(monthPriceCheck + ' | ' + priceCheck + ' | ' + clientNameCheck + ' | ' + clientTypeCheck);
            if (monthPriceCheck && priceCheck && clientNameCheck) {
                document.getElementById('nextPageButton').disabled = false;
            } else {
                document.getElementById('nextPageButton').disabled = true;
            }

        }

        const processChange = debounce(() => onFieldInputCheck());

        addEventListener("input", (event) => {
            processChange();
        });

        addEventListener("checkbox", (event) => {
            processChange();
        });
    </script>

</x-layout>


{{-- 금액란 콤마 찍기  --}}
