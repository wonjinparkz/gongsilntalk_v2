<x-layout>

    <form class="find_form" method="POST" action="{{ route('www.corp.proposal.name.create') }}" name="create_check">

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
            <div class="m_title">신규 건물 <span class="gray_basic"><span class="txt_point">3</span>/3</span></div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">신규 건물 하기 <span class="step_number"><span
                            class="txt_point">3</span>/3</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>건물 기본정보 <span class="txt_point">*</span></h4>
                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">전용면적 <span>*</span></label>
                                <div class="input_pyeong_area">
                                    <div><input type="number" name="exclusive_area" id="exclusive_area"
                                            placeholder="전용면적">
                                        <span class="gray_deep">평</span>
                                    </div>
                                    <span class="gray_deep">/</span>
                                    <div><input type="text" name="exclusive_square" id="exclusive_square"
                                            placeholder="평 입력시 자동">
                                        <span class="gray_deep">㎡</span>
                                    </div>
                                </div>
                            </div>
                            <div class="reg_item">
                                <div>
                                    <label class="input_label">해당층/전체층 <span>*</span></label>
                                    <div class="input_pyeong_area">
                                        <div><input type="number" name="floor_number" id="floor_number"
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
                                    <input type="number" name="service_price"> <span class="gray_deep">원</span>
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
                                        <input type="text" name="move_date" placeholder="예) 20230101" class="">
                                    </div>
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
                                <label class="input_label">난방 종류</label>
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
                            <label class="input_label">건물 외관 사진 <span class="gray_basic">(1장)</span> <span class="txt_point">*</span></label>
                        </div>

                        <div class="img_add_wrap reg_step_type draggable-zone product_img_add_wrap">
                            <x-pc-proposal-image-picker :title="'건물 외관 사진(1장)'" id="product" cnt="1" required="required" />
                        </div>

                        <div class="offer_textarea_wrap" style="margin-bottom:-35px;">
                            <label class="input_label">건물 내부 사진 <span class="gray_basic">(최대 4장)</span> <span class="txt_point">*</span></label>
                        </div>

                        <div class="img_add_wrap reg_step_type draggable-zone product_detail_img_add_wrap">
                            <x-pc-proposal-image-picker :title="'건물 내부 사진(최대 4장)'" id="product_detail" cnt="4" required="required" />
                        </div>

                        <div class="offer_textarea_wrap">
                            <label class="input_label">상세 설명 <span class="txt_point">*</span></label>
                            <textarea name="product_content" id="product_content" placeholder="건물의 특징이나 장점을 설명해주세요."></textarea>
                        </div>

                        <div class="offer_textarea_wrap">
                            <label class="input_label">요청사항 </label>
                            <textarea name="content" id="content" placeholder="별도의 요청사항이 있다면 작성해주세요."></textarea>
                        </div>

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
            confrim_check();
        });

        $('input[type="checkbox"]').change(function() {
            confrim_check();
        });

        $('input[type="radio"]').change(function() {
            confrim_check();
        });

        $('input[type="number"]').change(function() {
            confrim_check();
        });

        $('#exclusive_area').keyup(function() {
            var area = $(this).val();
            if (area > 0) {
                var convertedSquare = (area * 3.3058).toString();
                var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
                $('#exclusive_square').val(convertedSquare.substr(0, decimalIndex));
            }
            confrim_check();
        });

        function confrim_check() {
            var payment_type = $('input[name="payment_type"]').val();
            var price = $('input[name="price_' + payment_type + '"]').val();
            var month_price = $('input[name="month_price_4"]').val();
            var acquisition_tax = $('input[name="acquisition_tax"]').val();
            var loan_rate_one = $('input[name="loan_rate_one"]').val();
            var loan_rate_two = $('input[name="loan_rate_two"]').val();
            var invest_price = $('input[name="invest_price"]').val();
            var invest_month_price = $('input[name="invest_month_price"]').val();
            var is_invest = $('input[name="is_invest"]:checked').val();

            var confirm = false;

            console.log('is_invest : ', is_invest);
            // console.log(payment_type,
            //     price,
            //     month_price,
            //     acquisition_tax,
            //     loan_rate_one,
            //     loan_rate_two,
            //     invest_price,
            //     invest_month_price,
            //     is_invest,
            //     confirm);

            if (is_invest == 1 && invest_price != '') {
                console.log('gd');
            }

            if (payment_type == 0) {
                if (price != '' && acquisition_tax != '' && loan_rate_one != '' && loan_rate_two != '') {
                    confirm = true;
                }
            } else if (payment_type == 3) {
                if (price != '') {
                    confirm = true;
                }
            } else if (payment_type == 4) {
                if (price != '' && month_price != '') {
                    confirm = true;
                }
            } else {
                confirm = false;
            }

            if (confirm) {
                return $('.confirm').attr("disabled", false);
            } else {
                return $('.confirm').attr("disabled", true);
            }
            console.log('is_invest : ', is_invest);
        }

        function formSetting() {
            var is_map = $('#is_map').is(":checked");

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
        }
    </script>

</x-layout>
