<x-layout>

    <form class="find_form" method="POST" action="{{ route('www.corp.product.create.type.check') }}" name="create_check">
        <input type="hidden" name="type" id="type" value="{{ old('type') ?? '0' }}">
        <input type="hidden" name="payment_type" id="payment_type" value="{{ old('payment_type') ?? '0' }}">
        <input type="hidden" name="price" id="price" value="{{ old('price') ?? '' }}">
        <input type="hidden" name="month_price" id="month_price" value="{{ old('month_price') ?? '' }}">
        <input type="hidden" name="is_price_discussion" id="is_price_discussion"
            value="{{ old('is_price_discussion') ?? '' }}">
        <input type="hidden" name="is_use" id="is_use" value="{{ old('is_use') ?? '' }}">
        <input type="hidden" name="current_price" id="current_price" value="{{ old('current_price') ?? '' }}">
        <input type="hidden" name="current_month_price" id="current_month_price"
            value="{{ old('current_month_price') ?? '' }}">
        <input type="hidden" name="is_premium" id="is_premium" value="{{ old('is_premium') ?? '' }}">
        <input type="hidden" name="premium_price" id="premium_price" value="{{ old('premium_price') ?? '' }}">
    </form>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">1</span>/5</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span class="txt_point">1</span>/5</span>
            </h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>매물 유형 <span class="txt_point">*</span></h4>
                    <ul class="tab_type_3 tab_toggle_menu">
                        <li class="active" onclick="showDiv('category', 0)">상업용</li>
                        <li onclick="showDiv('category', 1)">주거용</li>
                        <li onclick="showDiv('category', 2)">분양권</li>
                    </ul>
                    <div class="tab_area_wrap">
                        <div>
                            <div class="btn_radioType">
                                @for ($i = 0; $i < 8; $i++)
                                    <input type="radio" name="input_type" id="type_{{ $i }}"
                                        value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                                    <label onclick="showDiv('store', {{ $i }} == 3 ? 1:0)"
                                        for="type_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <div class="btn_radioType">
                                @for ($i = 8; $i < 14; $i++)
                                    <input type="radio" name="input_type" id="type_{{ $i }}"
                                        value="{{ $i }}">
                                    <label
                                        for="type_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                                @endfor
                            </div>
                        </div>

                        <div>
                            <div class="btn_radioType">
                                @for ($i = 14; $i < 18; $i++)
                                    <input type="radio" name="input_type" id="type_{{ $i }}"
                                        value="{{ $i }}">
                                    <label
                                        for="type_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                                @endfor
                            </div>
                        </div>

                    </div>

                </div>

                <div class="box_01 box_reg">
                    <div class="category_wrap">

                        <!-- 상업용 : s -->
                        <div class="category_item open_key active">
                            <div class="input_item_grid">
                                <h4>상업용 거래 정보 <span class="txt_point">*</span></h4>
                                <div class="btn_radioType">
                                    <input type="radio" name="sales_type" id="sales_type_1" value="0" checked>
                                    <label for="sales_type_1" onclick="showDiv('type', 0)">매매</label>

                                    <input type="radio" name="sales_type" id="sales_type_2" value="1">
                                    <label for="sales_type_2" onclick="showDiv('type', 1)">임대</label>

                                    <input type="radio" name="sales_type" id="sales_type_3" value="2">
                                    <label for="sales_type_3" onclick="showDiv('type', 1)">단기임대</label>
                                </div>

                                <div class="type_wrap">
                                    <!-- 매매 -->
                                    <div class="type_item open_key active">
                                        <div class="input_item_grid">
                                            <div>
                                                <label class="input_label">매매가</label>
                                                <div class="input_area_1">
                                                    <input type="text" name="input_price" id="price_1"
                                                        inputmode="numeric"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                    <span class="gray_deep">원</span>
                                                    <input type="checkbox" name="input_is_price_discussion"
                                                        id="is_price_discussion_1" value="Y">
                                                    <label for="is_price_discussion_1" class="gray_deep"><span></span>
                                                        협의가능</label>
                                                </div>
                                                <div class="txt_item_2 mt20">
                                                    {{-- <span name="price_conversion" class="price"></span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 임대, 단기임대 -->
                                    <div class="type_item open_key">
                                        <div class="input_item_grid">
                                            <div class="input_area_2">
                                                <div class="flex_between">
                                                    <div class="item">
                                                        <label class="input_label">보증금</label>
                                                        <div class="flex_1">
                                                            <input type="text" class="w_input_150"
                                                                inputmode="numeric"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                                name="input_price" id="price_2"><span>/</span>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <label class="input_label">월임대료</label>
                                                        <div class="flex_1">
                                                            <input type="text" class="w_input_150"
                                                                inputmode="numeric"
                                                                oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                                name="input_month_price"
                                                                id="month_price_1"><span>원</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item_check_add">
                                                    <input type="checkbox" name="input_is_price_discussion"
                                                        id="is_price_discussion_2" value="Y">
                                                    <label for="is_price_discussion_2"
                                                        class="gray_deep mt18"><span></span>
                                                        협의가능</label>
                                                </div>

                                            </div>
                                            <div class="txt_item_2 ">
                                                {{-- <span name="price_conversion" class="price"></span> --}}
                                                {{-- <span name="month_price_conversion" class="price"></span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="input_label">기존 임대차 내용</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="lease" id="lease_1_1" value="1">
                                        <label for="lease_1_1" onclick="showDiv('lease', 0)">있음</label>

                                        <input type="radio" name="lease" id="lease_1_2" value="0" checked>
                                        <label for="lease_1_2" onclick="showDiv('lease', 1)">없음</label>
                                    </div>

                                </div>

                                <div class="lease_wrap">
                                    <div class="lease_item open_key">
                                        <div class="flex_between w_30">
                                            <div class="item">
                                                <label class="input_label">현 보증금</label>
                                                <div class="flex_1">
                                                    <input type="text" class="w_input_150" inputmode="numeric"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                        name="input_current_price" id="current_price_1"><span>/</span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <label class="input_label">현 월임대료</label>
                                                <div class="flex_1">
                                                    <input type="text" class="w_input_150"
                                                        name="input_current_month_price" inputmode="numeric"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                        id="current_month_price_1"><span>원</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt_item_2 mt20">
                                            {{-- <span name="current_price_conversion" class="price"></span>
                                            <span name="current_month_price_conversion" class="price"></span> --}}
                                        </div>
                                    </div>
                                    <div class="lease_item open_key"></div>
                                </div>

                                <div id="store" style="display:none">
                                    <label class="input_label">권리금</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="keymoney" id="keymoney_1" value="1">
                                        <label for="keymoney_1" onclick="showDiv('keymoney', 0)">있음</label>

                                        <input type="radio" name="keymoney" id="keymoney_2" value="0"
                                            checked>
                                        <label for="keymoney_2" onclick="showDiv('keymoney', 1)">없음</label>
                                    </div>
                                </div>

                                <div class="keymoney_wrap w_30">
                                    <div class="keymoney_item open_key">
                                        <div class="flex_1 flex_between">
                                            <input type="text" name="input_premium_price" inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEvent(this);"
                                                id="input_premium_price">
                                            <span>원</span>
                                        </div>
                                        <div class="txt_item_2 mt20">
                                            {{-- <span name="premium_price_conversion" class="price"></span> --}}
                                        </div>
                                    </div>
                                    <div class="keymoney_item open_key"></div>
                                </div>


                            </div>
                        </div>
                        <!-- 상업용 : e -->

                        <!-- 주거용 : s -->
                        <div class="category_item open_key">
                            <div class="input_item_grid">
                                <h4>주거용 거래 정보 <span class="txt_point">*</span></h4>
                                <div class="btn_radioType">
                                    <input type="radio" name="sales_type" id="sales_type_4" value="0">
                                    <label for="sales_type_4" onclick="showDiv('type_2', 0)">매매</label>

                                    <input type="radio" name="sales_type" id="sales_type_5" value="3">
                                    <label for="sales_type_5" onclick="showDiv('type_2', 1)">전세</label>

                                    <input type="radio" name="sales_type" id="sales_type_6" value="4">
                                    <label for="sales_type_6" onclick="showDiv('type_2', 2)">월세</label>

                                    <input type="radio" name="sales_type" id="sales_type_7" value="2">
                                    <label for="sales_type_7" onclick="showDiv('type_2', 2)">단기임대</label>
                                </div>

                                <div class="type_2_wrap">
                                    <!-- 매매 -->
                                    <div class="type_2_item open_key active">
                                        <div>
                                            <label class="input_label">매매가</label>
                                            <div class="input_area_1">
                                                <input type="text" name="input_price" id="price_3"
                                                    inputmode="numeric"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                <span class="gray_deep">원</span>
                                                <input type="checkbox" name="input_is_price_discussion"
                                                    id="is_price_discussion_3" value="Y">
                                                <label for="is_price_discussion_3" class="gray_deep"><span></span>
                                                    협의가능</label>
                                            </div>
                                            <div class="txt_item_2 mt20">
                                                {{-- <span name="price_conversion" class="price"></span> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 전세 -->
                                    <div class="type_2_item open_key">
                                        <div>
                                            <label class="input_label">전세가</label>
                                            <div class="input_area_1">
                                                <input type="text" name="input_price" id="price_4"
                                                    inputmode="numeric"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);"> <span
                                                    class="gray_deep">원</span>
                                                <input type="checkbox" name="input_is_price_discussion"
                                                    id="is_price_discussion_4" value="Y">
                                                <label for="is_price_discussion_4" class="gray_deep"><span></span>
                                                    협의가능</label>
                                            </div>
                                            <div class="txt_item_2 mt20">
                                                {{-- <span name="price_conversion" class="price"></span> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 월세, 단기임대 -->
                                    <div class="type_2_item open_key">
                                        <div class="input_area_2">
                                            <div class="flex_between">
                                                <div class="item">
                                                    <label class="input_label">보증금</label>
                                                    <div class="flex_1">
                                                        <input type="text" name="input_price" id="price_5"
                                                            class="w_input_150" inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="text" name="input_month_price"
                                                            id="month_price_2" class="w_input_150"
                                                            inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item_check_add">
                                                <input type="checkbox" name="input_is_price_discussion"
                                                    id="is_price_discussion_5" value="Y">
                                                <label for="is_price_discussion_5"
                                                    class="gray_deep mt18"><span></span>
                                                    협의가능</label>
                                            </div>
                                        </div>
                                        <div class="txt_item_2 mt20">
                                            {{-- <span name="price_conversion" class="price"></span> --}}
                                            {{-- <span name="month_price_conversion" class="price"></span> --}}
                                        </div>
                                    </div>
                                </div>

                                {{-- 기존 임대차 내용 STRAT --}}
                                <div>
                                    <label class="input_label">기존 임대차 내용</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="lease" id="lease_2_1" value="1">
                                        <label for="lease_2_1" onclick="showDiv('lease_1', 0)">있음</label>

                                        <input type="radio" name="lease" id="lease_2_2" value="0">
                                        <label for="lease_2_2" onclick="showDiv('lease_1', 1)">없음</label>
                                    </div>
                                </div>


                                <div class="lease_1_wrap">
                                    <div class="lease_1_item open_key">
                                        <div class="flex_between w_30">
                                            <div class="item">
                                                <label class="input_label">현 보증금</label>
                                                <div class="flex_1">
                                                    <input type="text" class="w_input_150"
                                                        name="input_current_price" id="current_price_1"
                                                        inputmode="numeric"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>/</span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <label class="input_label">현 월임대료</label>
                                                <div class="flex_1 ">
                                                    <input type="text" class="w_input_150"
                                                        name="input_current_month_price" id="current_month_price_1"
                                                        inputmode="numeric"
                                                        oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>원</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="txt_item_2 mt20">
                                            {{-- <span name="current_price_conversion" class="price"></span>
                                            <span name="current_month_price_conversion" class="price"></span> --}}
                                        </div>
                                    </div>
                                    <div class="lease_1_item open_key"></div>
                                </div>
                                {{-- 기존 임대차 내용 END --}}

                            </div>
                        </div>
                        <!-- 주거용 : e -->

                        <!-- 분양권 : s -->
                        <div class="category_item open_key">
                            <div class="input_item_grid">
                                <h4>분양권 거래 정보 <span class="txt_point">*</span></h4>
                                <div class="btn_radioType">
                                    <input type="radio" name="sales_type" id="sales_type_8" value="5">
                                    <label for="sales_type_8" onclick="showDiv('type_3', 0)">전매</label>

                                    <input type="radio" name="sales_type" id="sales_type_9" value="3">
                                    <label for="sales_type_9" onclick="showDiv('type_3', 1)">전세</label>

                                    <input type="radio" name="sales_type" id="sales_type_10" value="4">
                                    <label for="sales_type_10"onclick="showDiv('type_3', 2)">월세</label>
                                </div>

                                <div class="type_3_wrap">
                                    <!-- 전매 -->
                                    <div class="type_3_item open_key active">
                                        <div>
                                            <label class="input_label">전매가</label>
                                            <div class="input_area_1">
                                                <input type="text" name="input_price" id="price_6"
                                                    inputmode="numeric"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);"> <span
                                                    class="gray_deep">원</span>
                                                <input type="checkbox" name="input_is_price_discussion"
                                                    id="is_price_discussion_6" value="Y">
                                                <label for="is_price_discussion_6" class="gray_deep"><span></span>
                                                    협의가능</label>
                                            </div>
                                            <div class="txt_item_2 mt20">
                                                {{-- <span name="price_conversion" class="price"></span> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 전세 -->
                                    <div class="type_3_item open_key">
                                        <div>
                                            <label class="input_label">전세가</label>
                                            <div class="input_area_1">
                                                <input type="text" name="input_price" id="price_7"
                                                    inputmode="numeric"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);"> <span
                                                    class="gray_deep">원</span>
                                                <input type="checkbox" name="input_is_price_discussion"
                                                    id="is_price_discussion_7" value="Y">
                                                <label for="is_price_discussion_7" class="gray_deep"><span></span>
                                                    협의가능</label>
                                            </div>
                                            <div class="txt_item_2 mt20">
                                                {{-- <span name="price_conversion" class="price"></span> --}}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 월세 -->
                                    <div class="type_3_item open_key">
                                        <div class="input_area_2">
                                            <div class="flex_between">
                                                <div class="item">
                                                    <label class="input_label">보증금</label>
                                                    <div class="flex_1">
                                                        <input type="text" class="w_input_150" name="input_price"
                                                            id="price_8" inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="text" name="input_month_price"
                                                            id="month_price_3" class="w_input_150"
                                                            inputmode="numeric"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item_check_add">
                                                <input type="checkbox" name="input_is_price_discussion"
                                                    id="is_price_discussion_8" value="Y">
                                                <label for="is_price_discussion_8"
                                                    class="gray_deep mt18"><span></span>
                                                    협의가능</label>
                                            </div>
                                        </div>
                                        <div class="txt_item_2 mt20">
                                            {{-- <span name="price_conversion" class="price"></span> --}}
                                            {{-- <span name="month_price_conversion" class="price"></span> --}}
                                        </div>
                                    </div>

                                </div>




                            </div>
                        </div>
                        <!-- 분양권 : e -->

                    </div>
                </div>

                <div class="step_btn_wrap">
                    <span></span>
                    <button class="btn_full_basic btn_point confirm" disabled onclick="formSetting();">다음</button>
                </div>
            </div>
        </div>
        <!-- my_body : e -->

    </div>

    <script>
        function formSetting() {
            var is_use = $('#is_use').val();
            var is_premium = $('#is_premium').val();
            var is_price_discussion = $('#is_price_discussion').val();

            if (is_use != 1) {
                $('#is_use').val('0');
                $('#current_price').val('');
                $('#current_month_price').val('');
            }
            if (is_premium != 1) {
                $('#is_premium').val('0');
                $('#premium_price').val('');
            }
            if (is_price_discussion != 1) {
                $('#is_price_discussion').val('0')
            }

            var type = $('#type').val();
            var payment_type = $('#payment_type').val();
            var price = $('#price').val();
            var month_price = $('#month_price').val();
            var is_price_discussion = $('#is_price_discussion').val();
            var is_use = $('#is_use').val();
            var current_price = $('#current_price').val();
            var current_month_price = $('#current_month_price').val();
            var is_premium = $('#is_premium').val();
            var premium_price = $('#premium_price').val();

            sessionStorage.setItem("typeSession", type);
            sessionStorage.setItem("payment_typeSession", payment_type);
            sessionStorage.setItem("priceSession", price);
            sessionStorage.setItem("month_priceSession", month_price);
            sessionStorage.setItem("is_price_discussionSession", is_price_discussion);
            sessionStorage.setItem("is_useSession", is_use);
            sessionStorage.setItem("current_priceSession", current_price);
            sessionStorage.setItem("current_month_priceSession", current_month_price);
            sessionStorage.setItem("is_premiumSession", is_premium);
            sessionStorage.setItem("premium_priceSession", premium_price);

            $('.find_form').submit();
        }

        //컨트롤러에 보낼 정보 저장

        //공통
        // 매물 유형
        $('input[name="input_type"]').click(function() {
            $('#type').val($(this).val());
        });


        // 매매가 & 보증금
        $('input[name="input_price"]').keyup(function() {
            $('#price').val($(this).val().replace(/[^0-9]/g, ''));
        });

        // 월임대료
        $('input[name="input_month_price"]').keyup(function() {
            $('#month_price').val($(this).val().replace(/[^0-9]/g, ''));
        });

        // 가격 협의가능 여부
        $('input[name="input_is_price_discussion"]').keyup(function() {
            $('#is_price_discussion').val($(this).is(':checked') ? 1 : 0);
        });

        // 거래 타입
        $('input[name="sales_type"]').click(function() {
            $('#payment_type').val($(this).val());
        });

        // 기존 임대차 선택
        $('input[name="lease"]').click(function() {
            $('#is_use').val($(this).val());
        });

        // 기존 임대차 선택시 보증금
        $('input[name="input_current_price"]').keyup(function() {
            $('#current_price').val($(this).val().replace(/[^0-9]/g, ''));
        });

        // 기존 임대차 선택시 월 임대료
        $('input[name="input_current_month_price"]').keyup(function() {
            $('#current_month_price').val($(this).val().replace(/[^0-9]/g, ''));
        });

        // 상가 - 권리금 선택
        $('input[name="keymoney"]').click(function() {
            $('#is_premium').val($(this).val());
        });

        // 상가 - 권리금 금액
        $('input[name="input_premium_price"]').keyup(function() {
            $('#premium_price').val($(this).val().replace(/[^0-9]/g, ''));
        });


        function confirm_check() {
            var confirm = 0;
            var type = $('#type').val();
            var payment_type = $('#payment_type').val();
            var price = $('#price').val();
            var month_price = $('#month_price').val();
            var is_price_discussion = $('#is_price_discussion').val();
            var is_use = $('#is_use').val();
            var current_price = $('#current_price').val();
            var current_month_price = $('#current_month_price').val();
            var is_premium = $('#is_premium').val();
            var premium_price = $('#premium_price').val();

            if (type != '' && payment_type != '' && price != '') {
                if ($.inArray(payment_type, ['1', '2', '4']) !== -1) {
                    if (month_price != '') {
                        confirm = 1;
                    } else {
                        return $('.confirm').attr("disabled", true);
                    }
                }
                if (type < 14) {
                    if (type == 3) {
                        if (is_premium == 1) {
                            if (premium_price != '') {
                                confirm = 1;
                            } else {
                                return $('.confirm').attr("disabled", true);
                            }
                        } else {
                            confirm = 1;
                        }
                    }
                    if (is_use == 1) {
                        if (current_price != '' && current_month_price != '') {
                            confirm = 1;
                        } else {
                            return $('.confirm').attr("disabled", true);
                        }
                    } else {
                        confirm = 1;
                    }
                } else {
                    confirm = 1;
                }
            } else {
                return $('.confirm').attr("disabled", true);
            }

            if (confirm == 1) {
                $('.confirm').attr("disabled", false);
            } else {
                $('.confirm').attr("disabled", true);
            }
        }

        $('input').on("change click keydown", function() {
            confirm_check();
        });


        //입력란 열고 닫기
        function showDiv(className, index) {

            if (className == 'lease' || className == 'lease_1' || className == 'keymoney') {
                console.log('초기화 제외');
            } else {
                $('span[class="price"]').empty();
                $('.find_form input').val('');

                // 협의가능 여부는 변화가 감지 안될 수 있으므로 초기화 작업
                $('#is_price_discussion').val(0);
                $('input[type="checkbox"]').prop('checked', false);

                $('input[type="text"]').val('');
            }

            var input_type = $('input[name="input_type"]:checked').val();
            var sales_type = $('input[name="sales_type"]:checked').val();
            var lease = $('input[name="lease"]:checked').val();

            $('#type').val(input_type);
            $('#payment_type').val(sales_type);
            $('#is_use').val(lease);


            // 매물 유형 상위 선택시에
            if (className == 'category') {
                if (index == 0) {
                    commercial_reset();
                } else if (index == 1) {
                    residential_reset();
                } else if (index == 2) {
                    parcel_reset();
                }
            }

            // 매물 유형 하위 카테고리 선택시에 상가 권리금 입력칸 활성화
            if (className == 'store') {
                if (index == 1) {
                    $('#store').css('display', 'block');
                } else {
                    $('#store').css('display', 'none');
                }
                return;
            }



            var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });

            tabContents[index].classList.add('active');
            confirm_check();
        }

        function commercial_reset() {
            $('#type_0').prop('checked', true);
            $('#sales_type_1').prop('checked', true);
            showDiv('type', 0)
            $('#type').val(0);
            $('#payment_type').val(0);
            $('#lease_1_2').prop('checked', true);
            showDiv('lease', 1)
        }

        function residential_reset() {
            $('#type_8').prop('checked', true);
            $('#sales_type_4').prop('checked', true);
            showDiv('type_2', 0)
            $('#type').val(7);
            $('#payment_type').val(0);
            $('#lease_2_2').prop('checked', true);
            showDiv('lease_1', 1)
        }

        function parcel_reset() {
            $('#type_14').prop('checked', true);
            $('#sales_type_8').prop('checked', true);
            showDiv('type_3', 0)
            $('#type').val(14);
            $('#payment_type').val(5);
        }
    </script>

</x-layout>
