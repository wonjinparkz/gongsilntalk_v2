<x-layout>

    <form class="find_form" method="POST" action="{{ route('www.corp.proposal.name.create') }}" name="create_check">
        <input type="hidden" name="move_date" id="move_date" value="">
        @php
            $data = $request->all();

            foreach ($data as $key => $value) {
                echo '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
            }
        @endphp

        <!----------------------------- m::header bar : s ----------------------------->
        <div class="m_header">
            <div class="left_area"><a href="javascript:history.go(-1)"><img
                        src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
            <div class="m_title">신규 건물 등록 <span class="gray_basic"><span class="txt_point">3</span>/3</span></div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">신규 건물 등록 <span class="step_number"><span
                            class="txt_point">3</span>/3</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>건물 기본정보 <span class="txt_point">*</span></h4>
                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">전용면적 <span>*</span></label>
                                <div class="input_pyeong_area">
                                    <div><input type="text" name="exclusive_area" id="exclusive_area"
                                            placeholder="전용면적" nputmode="numeric"
                                            oninput="onlyNumbers(this); area_change('exclusive_');">
                                        <span class="gray_deep">평</span>
                                    </div>
                                    <span class="gray_deep">/</span>
                                    <div><input type="text" name="exclusive_square" id="exclusive_square"
                                            placeholder="평 입력시 자동" nputmode="numeric"
                                            oninput="imsi(this); square_change('exclusive_');">
                                        <span class="gray_deep">㎡</span>
                                    </div>
                                </div>
                            </div>
                            <div class="reg_item">
                                <div>
                                    <label class="input_label">해당층/전체층 <span>*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="text" name="floor_number" id="floor_number"
                                                placeholder="해당층">
                                            <span class="gray_deep">층</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" name="total_floor_number" id="total_floor_number"
                                                placeholder="전체층">
                                            <span class="gray_deep">층</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">월 관리비 <span class="txt_point">*</span></label>
                                <div class="input_area_1">
                                    <input type="text" name="service_price" inputmode="numeric"
                                        oninput="onlyNumbers(this); onTextChangeEvent(this);"> <span
                                        class="gray_deep">원</span>
                                    <input type="checkbox" name="is_service" id="is_service_1" value="1">
                                    <label for="is_service_1" class="gray_deep"><span></span> 관리비 없음</label>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
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
                                        <input type="text" id="move_date_0" name="move_date_0"
                                            placeholder="예) 20230101" inputmode="numeric"
                                            oninput="onlyNumbers(this); onDateChangeEvent('move_date', 0);">
                                    </div>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">주차 가능 대수 <span class="txt_point">*</span></label>
                                <div class="flex_1 mt10">
                                    <input type="text" name="parking_count" placeholder="예) 10"
                                        class="w_input_150" inputmode="numeric"
                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                    <span>대</span>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <input type="hidden" name="cooling_type" id="cooling_type" value="">
                                <label class="input_label">냉방 종류</label>
                                <div class="dropdown_box">
                                    <button type="button" class="dropdown_label">냉방 종류 선택</button>
                                    <ul class="optionList">
                                        <li class="optionItem" onclick="selectType('cooling_type','')">
                                            냉방 종류 선택
                                        </li>
                                        @foreach (Lang::get('commons.cooling_type') as $index => $coolingType)
                                            <li class="optionItem"
                                                onclick="selectType('cooling_type','{{ $index }}')">
                                                {{ $coolingType }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="reg_item">
                                <input type="hidden" name="heating_type" id="heating_type" value="">
                                <label class="input_label">난방 종류</label>
                                <div class="dropdown_box">
                                    <button type="button" class="dropdown_label">난방 종류 선택</button>
                                    <ul class="optionList">
                                        <li class="optionItem" onclick="selectType('heating_type','')">
                                            난방 종류 선택
                                        </li>
                                        @foreach (Lang::get('commons.heating_type') as $index => $heatingType)
                                            <li class="optionItem"
                                                onclick="selectType('heating_type','{{ $index }}')">
                                                {{ $heatingType }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">시설 정보</label>
                                <div class="checkbox_btn">
                                    @foreach (Lang::get('commons.corp_product_option_type') as $index => $optionType)
                                        <input type="checkbox" name="option[]" id="option_{{ $index }}"
                                            value="{{ $index }}">
                                        <label for="option_{{ $index }}">{{ $optionType }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="box_01 box_reg">
                        <div class="flex_between">
                            <h4>사진 및 상세 설명</h4>
                        </div>

                        <div class="offer_textarea_wrap" style="margin-bottom:-35px;">
                            <label class="input_label">건물 외관 사진 <span class="gray_basic">(1장)</span> <span
                                    class="txt_point">*</span></label>
                        </div>

                        <div class="img_add_wrap reg_step_type draggable-zone product_img_add_wrap">
                            <x-pc-proposal-image-picker :title="'건물 외관 사진(1장)'" id="product" cnt="1"
                                required="required" />
                        </div>

                        <div class="offer_textarea_wrap" style="margin-bottom:-35px;">
                            <label class="input_label">건물 내부 사진 <span class="gray_basic">(최대 4장)</span> <span
                                    class="txt_point">*</span></label>
                        </div>

                        <div class="img_add_wrap reg_step_type draggable-zone product_detail_img_add_wrap">
                            <x-pc-proposal-image-picker :title="'건물 내부 사진(최대 4장)'" id="product_detail" cnt="4"
                                required="required" />
                        </div>

                        <div class="offer_textarea_wrap">
                            <label class="input_label">상세 설명 <span class="txt_point">*</span></label>
                            <textarea name="product_content" id="product_content" placeholder="건물의 특징이나 장점을 설명해주세요."></textarea>
                        </div>


                        <script>
                            const textarea = document.getElementById('product_content');
                            const maxLines = 15;
                            const maxCharsPerLine = 40;

                            textarea.addEventListener('input', () => {
                                const startPos = textarea.selectionStart; // 현재 커서 위치 저장
                                const endPos = textarea.selectionEnd; // 선택된 텍스트 범위의 끝 위치 저장
                                const originalValue = textarea.value;
                                const lines = originalValue.split('\n');
                                let result = '';

                                // 각 줄에서 40글자 초과하면 자르기 (공백 포함)
                                for (let i = 0; i < lines.length; i++) {
                                    if (i < maxLines) {
                                        if (lines[i].length > maxCharsPerLine) {
                                            // 40글자까지만 자르기
                                            result += lines[i].slice(0, maxCharsPerLine) + '\n';
                                        } else {
                                            result += lines[i] + '\n';
                                        }
                                    }
                                }

                                // 15줄 초과 시 잘라내기
                                const limitedText = result.split('\n').slice(0, maxLines).join('\n');

                                // 기존 값과 다르면 텍스트 재설정 및 커서 위치 유지
                                if (textarea.value !== limitedText) {
                                    const cursorOffset = textarea.value.length - originalValue.length;
                                    textarea.value = limitedText;
                                    textarea.setSelectionRange(startPos - cursorOffset, endPos - cursorOffset); // 커서 위치 복구
                                }
                            });
                        </script>

                        {{-- <div class="offer_textarea_wrap">
                            <label class="input_label">요청사항 </label>
                            <textarea name="content" id="content" placeholder="별도의 요청사항이 있다면 작성해주세요."></textarea>
                        </div> --}}

                    </div>

                    <div class="step_btn_wrap">
                        <button type="button" class="btn_full_basic btn_graylight_ghost"
                            onclick="javascript:history.go(-1)">이전</button>
                        <!-- <button class="btn_full_basic btn_point" disabled>등록</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button type="button" class="btn_full_basic btn_point confirm" onclick="formSetting()"
                            disabled>등록</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->

        </div>

    </form>


    <script>
        $(document).ready(function() {
            confirm_check();
        });

        $('input[type="checkbox"]').on('click chage keyup', function() {
            confirm_check();
        });

        $('input[type="radio"]').on('click chage keyup', function() {
            confirm_check();
        });

        $('input[type="number"]').on('chage keyup', function() {
            confirm_check();
        });

        $('input[type="text"]').on('chage keyup', function() {
            confirm_check();
        });

        $('textarea').on('change keyup', function() {
            confirm_check();
        });

        // 평수 제곱 변환
        function square_change(name) {
            var area_name = name + 'area';
            var square_name = name + 'square';

            var square = $('#' + square_name).val();

            if (square > 0) {
                var convertedArea = Math.round(square / 3.3058); // 평수로 변환하여 정수로 반올림
                $('#' + area_name).val(convertedArea);
            } else {
                $('#' + square_name).val('');
                $('#' + area_name).val('');
            }
        }

        // 평수 제곱 변환
        function area_change(name) {

            var area_name = name + 'area';
            var square_name = name + 'square';

            var area = $('#' + area_name).val();

            if (area > 0) {
                var convertedSquare = (area * 3.3058).toString();
                var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
                $('#' + square_name).val(convertedSquare.substr(0, decimalIndex));
            } else {
                $('#' + area_name).val('');
                $('#' + square_name).val('');
            }
        }


        function confirm_check() {
            var exclusive_area = $('input[name="exclusive_area"]').val();
            var exclusive_square = $('input[name="exclusive_square"]').val();
            var floor_number = $('input[name="floor_number"]').val();
            var total_floor_number = $('input[name="total_floor_number"]').val();
            var is_service = $('input[name="is_service"]').is(":checked");
            var service_price = $('input[name="service_price"]').val();
            var move_type = $('input[name="move_type"]:checked').val();
            var move_date = $('input[name="move_date"]').val().length;
            var parking_count = $('input[name="parking_count"]').val();
            var imageCount0 = document.querySelectorAll('input[name="product_image_paths[]"]').length
            var imageCount1 = document.querySelectorAll('input[name="product_detail_image_paths[]"]').length
            var product_content = $('#product_content').val();

            var confirm = false;


            if (exclusive_area > 0 && exclusive_square > 0 && floor_number != '' && total_floor_number != '' && (
                    is_service || is_service == false && service_price != '') && (move_type != 2 || (
                    move_type == 2 && move_date == 8)) && parking_count != '' && imageCount0 > 0 && imageCount1 > 0 &&
                product_content != '') {
                confirm = true;
            }

            if (confirm) {
                return $('.confirm').attr("disabled", false);
            } else {
                return $('.confirm').attr("disabled", true);
            }
        }

        function formSetting() {
            var corp_proposal_id = $('#corp_proposal_id').val();
            var product_type = $('#product_type').val();
            var type = $('#type').val();
            var address_lng = $('#address_lng').val();
            var address_lat = $('#address_lat').val();
            var region_code = $('#region_code').val();
            var region_address = $('#region_address').val();
            var address = $('#address').val();
            var product_name = $('#product_name').val();

            $('.find_form').submit();
        }

        function selectType(name, index) {
            $('#' + name).val(index);
            confirm_check();
        }

        //입력란 열고 닫기
        function showDiv(className, index) {
            var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }

        $('input[name="is_service"]').change(function() {
            isService($(this).is(':checked'));
        });

        function isService(element) {
            $('input[name="service_price"]').val('');
            if (element) {
                $('input[name="service_price"]').attr('disabled', true);
            } else {
                $('input[name="service_price"]').attr('disabled', false);
            }
        }
    </script>

</x-layout>
