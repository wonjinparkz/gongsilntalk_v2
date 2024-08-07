<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">3</span>/3</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->
    <form class="find_form" method="POST" action="{{ route('www.product.create') }}" name="create">

        <input type="hidden" name="user_type" id="user_type" value="0">
        <input type="hidden" name="state" id="state" value="0">
        <input type="hidden" name="type" id="type" value="">
        <input type="hidden" name="payment_type" id="payment_type" value="">
        <input type="hidden" name="price" id="price" value="">
        <input type="hidden" name="month_price" id="month_price" value="">
        <input type="hidden" name="is_price_discussion" id="is_price_discussion" value="">
        <input type="hidden" name="is_use" id="is_use" value="">
        <input type="hidden" name="current_price" id="current_price" value="">
        <input type="hidden" name="current_month_price" id="current_month_price" value="">
        <input type="hidden" name="is_premium" id="is_premium" value="">
        <input type="hidden" name="premium_price" id="premium_price" value="">
        <input type="hidden" name="approve_date" id="approve_date" value="">

        <input type="hidden" name="is_map" id="is_map" value="">
        <input type="hidden" name="address_lng" id="address_lng" value="">
        <input type="hidden" name="address_lat" id="address_lat" value="">
        <input type="hidden" name="region_code" id="region_code" value="">
        <input type="hidden" name="region_address" id="region_address" value="">
        <input type="hidden" name="address" id="address" value="">
        <input type="hidden" name="address_detail" id="address_detail" value="">
        <input type="hidden" name="address_dong" id="address_dong" value="">
        <input type="hidden" name="address_number" id="address_number" value="">

        <div class="body">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span
                            class="txt_point">3</span>/3</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>매물 유형 <span class="txt_point">*</span></h4>
                        <div>
                            <label class="input_label">전용면적 <span>*</span></label>
                            <div class="input_pyeong_area">
                                <div>
                                    <input type="text" name="exclusive_area" id="exclusive_area"
                                        placeholder="전용면적" inputmode="numeric"
                                        oninput="onlyNumbers(this);area_change('');">
                                    <span class="gray_deep">평</span>
                                </div>
                                <span class="gray_deep">/</span>
                                <div>
                                    <input type="text" name="exclusive_square" id="exclusive_square"
                                        inputmode="numeric" oninput="imsi(this); square_change('');"
                                        placeholder="평 입력시 자동">
                                    <span class="gray_deep">㎡</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <div class="flex_between">
                            <h4>사진 및 상세 설명</h4>
                            <p class="gray_basic">최대 8장 업로드 가능 <span class="txt_point imageCount">0</span> / 8</p>
                        </div>
                        <div class="img_add_wrap reg_step_type draggable-zone">
                            <x-pc-image-picker :title="''" id="product" cnt="8" required="required" />
                        </div>

                        <div class="offer_textarea_wrap">
                            <label class="input_label">상세 설명 <span class="txt_point">*</span></label>
                            <textarea name="content" id="content" placeholder="매물에 대해 추가로 어필하고 싶은 내용을 자세히 작성해 주세요."></textarea>
                        </div>

                    </div>

                    <div class="step_btn_wrap">
                        <button type="button" class="btn_full_basic btn_graylight_ghost"
                            onclick="javascript:history.go(-1)">이전</button>
                        <!-- <button class="btn_full_basic btn_point" disabled>등록</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button type="button" class="btn_full_basic btn_point confirm" onclick="createButton()"
                            disabled>등록</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->
        </div>
    </form>


    <script>
        $(document).ready(function() {
            $('#type').val(sessionStorage.getItem("typeSession"));
            $('#payment_type').val(sessionStorage.getItem("payment_typeSession"));
            $('#price').val(sessionStorage.getItem("priceSession"));
            $('#month_price').val(sessionStorage.getItem("month_priceSession"));
            $('#is_price_discussion').val(sessionStorage.getItem("is_price_discussionSession"));
            $('#is_use').val(sessionStorage.getItem("is_useSession"));
            $('#current_price').val(sessionStorage.getItem("current_priceSession"));
            $('#current_month_price').val(sessionStorage.getItem("current_month_priceSession"));
            $('#is_premium').val(sessionStorage.getItem("is_premiumSession"));
            $('#premium_price').val(sessionStorage.getItem("premium_priceSession"));
            $('#approve_date').val(sessionStorage.getItem("approve_dateSession"));

            $('#is_map').val(sessionStorage.getItem("is_mapSession"));
            $('#address_lng').val(sessionStorage.getItem("address_lngSession"));
            $('#address_lat').val(sessionStorage.getItem("address_latSession"));
            $('#region_code').val(sessionStorage.getItem("region_codeSession"));
            $('#region_address').val(sessionStorage.getItem("region_addressSession"));
            $('#address').val(sessionStorage.getItem("addressSession"));
            $('#address_detail').val(sessionStorage.getItem("address_detailSession"));
            $('#address_dong').val(sessionStorage.getItem("address_dongSession"));
            $('#address_number').val(sessionStorage.getItem("address_numberSession"));

        });


        function createButton() {

            $('.find_form').submit();

            sessionStorage.clear();
        }

        function confirm_check() {
            var square = $('#exclusive_square').val();
            var area = $('#exclusive_area').val();
            var content = $('#content').val();

            if (square != '' && area != '' && content != '') {
                $('.confirm').attr("disabled", false);
            } else {
                $('.confirm').attr("disabled", true);
            }
        }

        $('#content').keyup(function() {
            confirm_check();
        });

        $('#exclusive_square').keyup(function() {
            var square = $(this).val();
            if (square > 0) {
                var convertedArea = Math.round(square / 3.3058); // 평수로 변환하여 정수로 반올림
                $('#exclusive_area').val(convertedArea);
            }
            confirm_check();
        });
        $('#exclusive_area').keyup(function() {
            var area = $(this).val();
            if (area > 0) {
                var convertedSquare = (area * 3.3058).toString();
                var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
                $('#exclusive_square').val(convertedSquare.substr(0, decimalIndex));
            }
            confirm_check();
        });

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
    </script>



</x-layout>
