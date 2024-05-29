<x-layout>
    <form class="find_form" method="POST" action="{{ route('www.corp.product.create.info.check') }}" name="create_check">
        <input type="hidden" name="type" id="type" value="{{ $result['type'] }}">
        <input type="hidden" name="payment_type" id="payment_type" value="{{ $result['payment_type'] }}">
        <input type="hidden" name="price" id="price" value="{{ $result['price'] }}">
        <input type="hidden" name="month_price" id="month_price" value="{{ $result['month_price'] ?? '' }}">
        <input type="hidden" name="is_price_discussion" id="is_price_discussion"
            value="{{ $result['is_price_discussion'] ?? '' }}">
        <input type="hidden" name="is_use" id="is_use" value="{{ $result['is_use'] ?? '' }}">
        <input type="hidden" name="current_price" id="current_price" value="{{ $result['current_price'] ?? '' }}">
        <input type="hidden" name="current_month_price" id="current_month_price"
            value="{{ $result['current_month_price'] ?? '' }}">
        <input type="hidden" name="is_premium" id="is_premium" value="{{ $result['is_premium'] ?? '' }}">
        <input type="hidden" name="premium_price" id="premium_price" value="{{ $result['premium_price'] ?? '' }}">
        <input type="hidden" name="approve_date" id="approve_date" value="{{ $result['approve_date'] ?? '' }}">

        <input type="hidden" name="address_lng" id="address_lng" value="{{ $result['address_lng'] ?? '' }}">
        <input type="hidden" name="address_lat" id="address_lat" value="{{ $result['address_lat'] ?? '' }}">
        <input type="hidden" name="region_code" id="region_code" value="{{ $result['region_code'] ?? '' }}">
        <input type="hidden" name="region_address" id="region_address" value="{{ $result['region_address'] }}">
        <input type="hidden" name="address" id="address" value="{{ $result['address'] }}">
        <input type="hidden" name="address_detail" id="address_detail" value="{{ $result['address_detail'] ?? '' }}">
        <input type="hidden" name="address_dong" id="address_dong" value="{{ $result['address_dong'] ?? '' }}">
        <input type="hidden" name="address_number" id="address_number" value="{{ $result['address_number'] ?? '' }}">

        <!----------------------------- m::header bar : s ----------------------------->
        <div class="m_header">
            <div class="left_area"><a href="javascript:history.go(-1)"><img
                        src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
            <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">3</span>/5</span></div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->


        <div class="body">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span class="txt_point">3</span>/5</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>기본 정보</h4>

                        @if (!in_array($result['type'], [6, 7]))
                            <div class="reg_mid_wrap no_forest">
                                <div class="reg_item">
                                    <label class="input_label">해당층/전체층 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="text" name="floor_number" placeholder="해당층"> <span
                                                class="gray_deep">층</span> </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" name="total_floor_number" placeholder="전체층"> <span
                                                class="gray_deep">층</span></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <!-- 단독공장 해당 : s -->
                        <div class="reg_mid_wrap">
                            @if ($result['type'] == 7)
                                <div class="reg_item no_forest">
                                    <label class="input_label">최저/최고층 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="text" name="lowest_floor_number" placeholder="최저"> <span
                                                class="gray_deep">층</span> </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" name="top_floor_number" placeholder="최고"> <span
                                                class="gray_deep">층</span></div>
                                    </div>
                                </div>
                            @endif
                            @if (in_array($result['type'], [6, 7]))
                                <div class="reg_item">
                                    <label class="input_label">대지면적 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="text" name="area" id="area" placeholder="대지면적"
                                                onkeyup="area_change('')">
                                            <span class="gray_deep">평</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" name="square" id="square"
                                                placeholder="평 입력시 자동" onkeyup="square_change('')">
                                            <span class="gray_deep">㎡</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- 단독공장 해당 : e -->

                        <div class="reg_mid_wrap">
                            @if (!in_array($result['type'], [6, 7]))
                                <div class="reg_item no_forest">
                                    <label class="input_label">공급 면적 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div>
                                            <input type="text" name="area" id="area" placeholder="전용면적"
                                                onkeyup="area_change('')">
                                            <span class="gray_deep">평</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div>
                                            <input type="text" name="square" id="square"
                                                placeholder="평 입력시 자동" onkeyup="square_change('')">
                                            <span class="gray_deep">㎡</span>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- 단독공장 해당 : s -->
                            @if ($result['type'] == 7)
                                <div class="reg_item no_forest">
                                    <label class="input_label">연면적 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div>
                                            <input type="text" name="total_floor_area" id="total_floor_area"
                                                placeholder="연면적" onkeyup="area_change('total_floor_')">
                                            <span class="gray_deep">평</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div>
                                            <input type="text" name="total_floor_square" id="total_floor_square"
                                                placeholder="평 입력시 자동" onkeyup="square_change('total_floor_')">
                                            <span class="gray_deep">㎡</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- 단독공장 해당 : e -->

                            @if ($result['type'] != 7)
                                <div class="reg_item no_forest">
                                    <label class="input_label">전용 면적 <span class="txt_point">*</span></label>
                                    <div class="input_pyeong_area">
                                        <div>
                                            <input type="text" name="exclusive_area" id="exclusive_area"
                                                placeholder="전용면적" onkeyup="area_change('exclusive_')">
                                            <span class="gray_deep">평</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div>
                                            <input type="text" name="exclusive_square" id="exclusive_square"
                                                placeholder="평 입력시 자동" onkeyup="square_change('exclusive_')">
                                            <span class="gray_deep">㎡</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="reg_mid_wrap">
                            @if ($result['type'] < 14)
                                <div class="reg_item no_forest">
                                    <label class="input_label">사용승인일 <span class="txt_point">*</span></label>
                                    <input type="text" name="approve_date" placeholder="예) 20230101">
                                </div>
                            @else
                                <div class="reg_item no_forest">
                                    <label class="input_label">준공예정일 <span class="txt_point">*</span></label>
                                    <input type="text" name="approve_date" placeholder="예) 20230101">
                                </div>
                            @endif

                            <input type="hidden" name="building_type" id="building_type" value="">
                            @if ($result['type'] != 6)
                                <div class="reg_item no_forest">
                                    <label class="input_label">주용도 <span class="txt_point">*</span></label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">주용도 선택</button>
                                        <ul class="optionList">
                                            @for ($i = 0; $i < 15; $i++)
                                                <li class="optionItem"
                                                    onclick="buildingTypeSelect('{{ $i }}')">
                                                    {{ Lang::get('commons.building_type.' . $i) }}
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="reg_item">
                                    <label class="input_label">현재 용도 <span class="txt_point">*</span></label>
                                    <div class="dropdown_box">
                                        <button type="button" class="dropdown_label">현재 용도 선택</button>
                                        <ul class="optionList">
                                            @for ($i = 15; $i < Count(Lang::get('commons.building_type')); $i++)
                                                <li class="optionItem"
                                                    onclick="buildingTypeSelect('{{ $i }}')">
                                                    {{ Lang::get('commons.building_type.' . $i) }}
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($result['type'] != 6)
                            <div class="reg_mid_wrap no_forest">
                                <div class="reg_item">
                                    <label class="input_label">입주가능일 <span class="txt_point">*</span></label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="move_type" id="move_type_1" value="0"
                                            checked="">
                                        <label for="move_type_1" onclick="showDiv('move_type', 0)">즉시 입주</label>

                                        <input type="radio" name="move_type" id="move_type_2" value="1">
                                        <label for="move_type_2" onclick="showDiv('move_type', 0)">날짜 협의</label>

                                        <input type="radio" name="move_type" id="move_type_3" value="2">
                                        <label for="move_type_3" onclick="showDiv('move_type', 1)">직접 입력</label>
                                    </div>
                                    <div class="move_type_wrap mt8">
                                        <div class="move_type_item open_key"></div>
                                        <div class="move_type_item open_key">
                                            <input type="text" name="move_date" placeholder="예) 20230101"
                                                class="">
                                        </div>
                                    </div>
                                </div>
                                <div class="reg_item only_pc"></div>
                            </div>
                        @endif

                        @if ($result['type'] != 6)
                            <div class="reg_mid_wrap no_forest">
                                <div class="reg_item">
                                    <label class="input_label">월 관리비 <span class="txt_point">*</span></label>
                                    <div class="input_area_1">
                                        <input type="number" name="service_price"> <span class="gray_deep">원</span>
                                        <input type="checkbox" name="is_service" id="is_service_1" value="1">
                                        <label for="is_service_1" class="gray_deep"><span></span> 관리비 없음</label>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if ($result['type'] != 6)
                            <div class="no_forest">
                                <label class="input_label">관리비 항목</label>
                                <div class="checkbox_btn">
                                    @foreach (Lang::get('commons.service_type') as $index => $service_type)
                                        <input type="checkbox" name="service_type[]"
                                            id="service_type_{{ $index }}" value="{{ $index }}">
                                        <label for="service_type_{{ $index }}">
                                            {{ Lang::get('commons.service_type.' . $index) }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">융자금 <span class="txt_point">*</span></label>
                                <div class="btn_radioType">
                                    <input type="radio" name="loan_type" id="loan_type_0" value="0"
                                        checked="">
                                    <label for="loan_type_0">없음</label>

                                    <input type="radio" name="loan_type" id="loan_type_1" value="1">
                                    <label for="loan_type_1">30%미만</label>

                                    <input type="radio" name="loan_type" id="loan_type_2" value="2">
                                    <label for="loan_type_2">30%이상</label>
                                </div>
                                <div class="flex_1 mt10">
                                    <input type="number" name="loan_price" id="loan_price" class="w_input_150"
                                        disabled><span>원</span>
                                </div>
                            </div>
                            <div class="reg_item only_pc"></div>
                        </div>

                        @if ($result['type'] != 6)
                            <div class="reg_mid_wrap no_forest">
                                <div class="reg_item">
                                    <label class="input_label">주차 가능 여부</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="parking_type"id="parking_type_0" value="0"
                                            checked="">
                                        <label for="parking_type_0">선택 안함</label>

                                        <input type="radio" name="parking_type"id="parking_type_1" value="1">
                                        <label for="parking_type_1">가능</label>

                                        <input type="radio" name="parking_type"id="parking_type_2" value="2">
                                        <label for="parking_type_2">불가능</label>
                                    </div>
                                    <div class="flex_1 mt10">
                                        <input type="number" name="parking_price" class="w_input_150"
                                            disabled><span>원</span>
                                    </div>
                                </div>
                                <div class="reg_item only_pc"></div>
                            </div>
                        @endif

                    </div>



                    <div class="step_btn_wrap">
                        <button type="button" class="btn_full_basic btn_graylight_ghost"
                            onclick="location.href='javascript:history.go(-1)'">이전</button>
                        <button type="submit" class="btn_full_basic btn_point confirm" disabled>다음</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->

        </div>
    </form>

    <script>
        $(document).ready(function() {
            if ($('#type').val() == 6) {
                $('.no_forest').css('display', 'none');
            }
        });

        $('input[type="text"]').on('keyup', function() {
            inputCheck();
        });
        $('input[type="number"]').on('keyup', function() {
            inputCheck();
        });
        $('input[type="checkbox"]').change(function() {
            inputCheck();
        });
        $('input[type="radio"]').change(function() {
            inputCheck();
        });

        // function inputCheck() {
        //     var type = $('#type').val();

        //     console.log('type : ', type);

        //     if ([0, 1, 2].indexOf(type) !== -1) {
        //         console.log('지식, 사무실, 창고');
        //     }else if(type == 3) {
        //         console.log('상가');
        //     }else if(type == )
        // }

        function inputCheck() {
            var type = $('#type').val();

            var floor_number = $('input[name="floor_number"]').val();
            var total_floor_number = $('input[name="total_floor_number"]').val();
            var lowest_floor_number = $('input[name="lowest_floor_number"]').val();
            var top_floor_number = $('input[name="top_floor_number"]').val();
            var area = $('#area').val();
            var square = $('#square').val();
            var total_floor_area = $('input[name="total_floor_area"]').val();
            var total_floor_square = $('input[name="total_floor_square"]').val();
            var exclusive_area = $('input[name="exclusive_area"]').val();
            var exclusive_square = $('input[name="exclusive_square"]').val();
            var building_type = $('input[name="building_type"]').val();
            var move_type = $('input[name="move_type"]:checked').val();
            var move_date = $('input[name="move_date"]').val();
            var is_service = $('input[name="is_service"]').is(":checked");
            var service_price = $('input[name="service_price"]').val();
            var service_type = $('input[name="service_type[]"]:checked').length;
            var loan_type = $('input[name="loan_type"]:checked').val();
            var loan_price = $('input[name="loan_price"]').val();
            var parking_type = $('input[name="parking_type"]:checked').val();
            var parking_price = $('input[name="parking_price"]').val();


            var checkConfirm = false;

            if (type == 6) {
                if (area != '' && square != '' && building_type != '' && (loan_type == 0 || (loan_type != 0 && loan_price !=
                        ''))) {
                    checkConfirm = true;
                } else {
                    checkConfirm = false;
                }
            } else {
                if (area != '' && square != '' && approve_date != '' && building_type != '' &&
                    (move_type != 2 || (move_type == 2 && move_date != '')) &&
                    (is_service || is_service == false && service_price != '' && service_type > 0) &&
                    (loan_type == 0 || (loan_type != 0 && loan_price != '')) &&
                    (parking_type != 1 || (parking_type != 1 && parking_price != ''))) {

                    checkConfirm = true;
                    if (type == 7) {
                        if (total_floor_area != '' && total_floor_square != '') {
                            checkConfirm = true;
                        } else {
                            checkConfirm = false
                        }
                    }

                } else {
                    checkConfirm = false;
                }
            }

            if (checkConfirm) {
                $('.confirm').attr("disabled", false);
            } else {
                $('.confirm').attr("disabled", true);
            }
        }

        // 평수 제곱 변환
        function square_change(name) {
            var area_name = name + 'area';
            var square_name = name + 'square';

            var square = $('#' + square_name).val();

            var convertedArea = Math.round(square / 3.3058); // 평수로 변환하여 정수로 반올림
            $('#' + area_name).val(convertedArea);
        }

        // 평수 제곱 변환
        function area_change(name) {

            var area_name = name + 'area';
            var square_name = name + 'square';

            var area = $('#' + area_name).val();
            var convertedSquare = (area * 3.3058).toString();
            var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
            $('#' + square_name).val(convertedSquare.substr(0, decimalIndex));
        }

        // 용도 선택
        function buildingTypeSelect(buildingType) {

            $('#building_type').val(buildingType);

            inputCheck();
        }

        //입력란 열고 닫기
        function showDiv(className, index) {
            var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');

            inputCheck();
        }

        //관리비 없음 체크여부
        $('input[name="is_service"]').change(function() {
            isService($(this).is(':checked'));
        });

        function isService(element) {
            $('input[name="service_price"]').val('');
            $('input[name="service_type[]"]').prop("checked", false)
            if (element) {
                $('input[name="service_type[]"]').attr('disabled', true);
                $('input[name="service_price"]').attr('disabled', true);
            } else {
                $('input[name="service_price"]').attr('disabled', false);
                $('input[name="service_type[]"]').attr('disabled', false);
            }
        }


        // 융자금 타입 선택시
        $('input[name="loan_type"]').change(function() {
            loanType($(this).val());
        });

        function loanType(element) {
            $('#loan_price').val('');
            if (element == 0) {
                $('input[name="loan_price"]').attr('disabled', true);
            } else {
                $('input[name="loan_price"]').attr('disabled', false);
            }
            inputCheck();
        }

        // 주차 가능 여부
        $('input[name="parking_type"]').change(function() {
            parkingType($(this).val());
        });

        function parkingType(element) {
            if (element != 1) {
                $('input[name="parking_price"]').attr('disabled', true);
            } else {
                $('input[name="parking_price"]').attr('disabled', false);
            }
        }
    </script>

</x-layout>
