<x-layout>
    <form class="find_form" method="POST" action="{{ route('www.corp.product.create') }}" name="create_check">
        <input type="hidden" name="type" id="type" value="{{ $result['type'] ?? old('type') }}">
        <input type="hidden" name="payment_type" value="{{ $result['payment_type'] ?? old('payment') }}">
        <input type="hidden" name="price" value="{{ $result['price'] ?? old('price') }}">
        <input type="hidden" name="month_price" value="{{ $result['month_price'] ?? '' }}">
        <input type="hidden" name="is_price_discussion" value="{{ $result['is_price_discussion'] ?? '' }}">
        <input type="hidden" name="is_use" value="{{ $result['is_use'] ?? '' }}">
        <input type="hidden" name="current_price" value="{{ $result['current_price'] ?? '' }}">
        <input type="hidden" name="current_month_price" value="{{ $result['current_month_price'] ?? '' }}">
        <input type="hidden" name="is_premium" value="{{ $result['is_premium'] ?? '' }}">
        <input type="hidden" name="premium_price" value="{{ $result['premium_price'] ?? '' }}">
        <input type="hidden" name="approve_date" value="{{ $result['approve_date'] ?? '' }}">

        <input type="hidden" name="is_map" value="{{ $result['is_map'] ?? '' }}">
        <input type="hidden" name="address_lng" value="{{ $result['address_lng'] ?? '' }}">
        <input type="hidden" name="address_lat" value="{{ $result['address_lat'] ?? '' }}">
        <input type="hidden" name="region_code" value="{{ $result['region_code'] ?? '' }}">
        <input type="hidden" name="region_address" value="{{ $result['region_address'] }}">
        <input type="hidden" name="address" value="{{ $result['address'] }}">
        <input type="hidden" name="address_detail" value="{{ $result['address_detail'] ?? '' }}">
        <input type="hidden" name="address_dong" value="{{ $result['address_dong'] ?? '' }}">
        <input type="hidden" name="address_number" value="{{ $result['address_number'] ?? '' }}">

        <input type="hidden" name="floor_number" value="{{ $result['floor_number'] ?? '' }}">
        <input type="hidden" name="total_floor_number" value="{{ $result['total_floor_number'] ?? '' }}">
        <input type="hidden" name="lowest_floor_number" value="{{ $result['lowest_floor_number'] ?? '' }}">
        <input type="hidden" name="top_floor_number" value="{{ $result['top_floor_number'] ?? '' }}">
        <input type="hidden" name="area" value="{{ $result['area'] ?? '' }}">
        <input type="hidden" name="square" value="{{ $result['square'] ?? '' }}">
        <input type="hidden" name="total_floor_area" value="{{ $result['total_floor_area'] ?? '' }}">
        <input type="hidden" name="total_floor_square" value="{{ $result['total_floor_square'] ?? '' }}">
        <input type="hidden" name="exclusive_area" value="{{ $result['exclusive_area'] ?? '' }}">
        <input type="hidden" name="exclusive_square" value="{{ $result['exclusive_square'] ?? '' }}">
        <input type="hidden" name="approve_date" value="{{ $result['approve_date'] ?? '' }}">
        <input type="hidden" name="building_type" value="{{ $result['building_type'] ?? '' }}">
        <input type="hidden" name="move_type" value="{{ $result['move_type'] ?? '' }}">
        <input type="hidden" name="move_date" value="{{ $result['move_date'] ?? '' }}">
        <input type="hidden" name="is_service" value="{{ $result['is_service'] ?? '' }}">
        <input type="hidden" name="service_price" value="{{ $result['service_price'] ?? '' }}">
        @foreach ($result['service_type'] ?? [] as $serviceType)
            <input type="hidden" name="service_type[]" value="{{ $serviceType }}">
        @endforeach
        <input type="hidden" name="loan_type" value="{{ $result['loan_type'] ?? '' }}">
        <input type="hidden" name="loan_price" value="{{ $result['loan_price'] ?? '' }}">
        <input type="hidden" name="parking_type" value="{{ $result['parking_type'] ?? '' }}">
        <input type="hidden" name="parking_price" value="{{ $result['parking_price'] ?? '' }}">


        <input type="hidden" name="room_count" value="{{ $result['room_count'] ?? '' }}">
        <input type="hidden" name="bathroom_count" value="{{ $result['bathroom_count'] ?? '' }}">
        <input type="hidden" name="current_business_type" value="{{ $result['current_business_type'] ?? '' }}">
        <input type="hidden" name="recommend_business_type" value="{{ $result['recommend_business_type'] ?? '' }}">
        <input type="hidden" name="direction_type" value="{{ $result['direction_type'] ?? '' }}">
        <input type="hidden" name="cooling_type" value="{{ $result['cooling_type'] ?? '' }}">
        <input type="hidden" name="heating_type" value="{{ $result['heating_type'] ?? '' }}">
        <input type="hidden" name="weight" value="{{ $result['weight'] ?? '' }}">
        <input type="hidden" name="is_elevator" value="{{ $result['is_elevator'] ?? '' }}">
        <input type="hidden" name="is_goods_elevator" value="{{ $result['is_goods_elevator'] ?? '' }}">
        <input type="hidden" name="structure_type" value="{{ $result['structure_type'] ?? '' }}">
        <input type="hidden" name="builtin_type" value="{{ $result['builtin_type'] ?? '' }}">
        <input type="hidden" name="interior_type" value="{{ $result['interior_type'] ?? '' }}">
        <input type="hidden" name="declare_type" value="{{ $result['declare_type'] ?? '' }}">
        <input type="hidden" name="is_dock" value="{{ $result['is_dock'] ?? '' }}">
        <input type="hidden" name="is_hoist" value="{{ $result['is_hoist'] ?? '' }}">
        <input type="hidden" name="floor_height_type" value="{{ $result['floor_height_type'] ?? '' }}">
        <input type="hidden" name="wattage_type" value="{{ $result['wattage_type'] ?? '' }}">
        <input type="hidden" name="land_use_type" value="{{ $result['land_use_type'] ?? '' }}">
        <input type="hidden" name="city_plan_type" value="{{ $result['city_plan_type'] ?? '' }}">
        <input type="hidden" name="building_permit_type" value="{{ $result['building_permit_type'] ?? '' }}">
        <input type="hidden" name="land_permit_type" value="{{ $result['land_permit_type'] ?? '' }}">
        <input type="hidden" name="access_load_type" value="{{ $result['access_load_type'] ?? '' }}">
        <input type="hidden" name="is_option" value="{{ $result['is_option'] ?? '' }}">
        @foreach ($result['option_type'] ?? [] as $serviceType)
            <input type="hidden" name="option_type[]" value="{{ $serviceType }}">
        @endforeach

        @php
            $type = $result['type'];
        @endphp
        <!----------------------------- m::header bar : s ----------------------------->
        <div class="m_header">
            <div class="left_area"><a href="javascript:history.go(-1)"><img
                        src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
            <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">5</span>/5</span></div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span
                            class="txt_point">5</span>/5</span></h1>

                <div class="offer_step_wrap">

                    <div class="box_01 box_reg">
                        <div class="flex_between">
                            <h4>사진 및 상세 설명</h4>
                            <p class="gray_basic">최대 8장 업로드 가능 <span class="txt_point imageCount">0</span> / 8</p>
                        </div>
                        <div class="img_add_wrap reg_step_type draggable-zone">
                            <x-pc-image-picker :title="''" id="product" cnt="8" required="required"
                                inputCheck="true" />
                        </div>

                        <div>
                            <div class="offer_textarea_wrap">
                                <label class="input_label">상세 설명 <span class="txt_point">*</span></label>
                                <input type="text" name="comments" id="comments"
                                    placeholder="매물 한줄요약. 예) 역에서 5분거리, 인프라 좋은 매물">
                                <textarea name="contents" id="contents" class="mt10" placeholder="매물에 대해 추가로 어필하고 싶은 내용을 자세히 작성해 주세요."></textarea>
                            </div>
                            <div class="reg_mid_wrap mt10">
                                <div class="reg_item">
                                    <label class="input_label">중개보수(부가세별도) <span class="txt_point">*</span></label>
                                    <input type="text" name="commission" class="form-control" inputmode="numeric"
                                        oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                        placeholder="중개보수를 입력해 주세요.">
                                </div>
                                <div class="reg_item">
                                    <label class="input_label">상한요율 <span class="txt_point">*</span></label>
                                    <input type="text" name="commission_rate" class="form-control"
                                        inputmode="numeric" oninput="imsi1(this);" placeholder="상한요율을 % 단위로 입력해 주세요.">
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="step_btn_wrap">
                        <button type="button" class="btn_full_basic btn_graylight_ghost"
                            onclick="location.href='javascript:history.go(-1)'">이전</button>
                        <button class="btn_full_basic btn_point confirm" onclick="createButton()" disabled>등록</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->

        </div>
    </form>
    <script>
        $(document).ready(function() {
            inputCheck();
        });

        $('input[type="text"]').on('change', function() {
            inputCheck();
        });
        $('textarea').on('change', function() {
            inputCheck();
        });


        function inputCheck() {
            var imageCount = parseInt($('.imageCount').text());
            var comments = $('input[name="comments"]').val();
            var content = $('textarea[name="content"]').val();
            var commission = $('input[name="commission"]').val();
            var commission_rate = $('input[name="commission_rate"]').val();

            if (imageCount > 0 && comments != '' && content != '' && commission != '' && commission_rate != '') {
                $('.confirm').attr("disabled", false);
            } else {
                $('.confirm').attr("disabled", true);
            }
        }
    </script>
</x-layout>
