<x-layout>

    <form class="find_form" method="POST" action="{{ route('www.product.create.type.check') }}" name="create_check">
        <input type="hidden" name="form_type" id="form_type" value="{{ old('form_type') ?? 0 }}">
        <input type="hidden" name="form_payment_type" id="form_payment_type" value="{{ old('form_payment_type') ?? 0 }}">
        <input type="hidden" name="form_price" id="form_price" value="{{ old('form_price') ?? '' }}">
        <input type="hidden" name="form_month_price" id="form_month_price" value="{{ old('form_month_price') ?? '' }}">
        <input type="hidden" name="form_is_price_discussion" id="form_is_price_discussion"
            value="{{ old('form_is_price_discussion') ?? '0' }}">
        <input type="hidden" name="form_is_use" id="form_is_use" value="{{ old('form_is_use') ?? '0' }}">
        <input type="hidden" name="form_current_price" id="form_current_price"
            value="{{ old('form_current_price') ?? '' }}">
        <input type="hidden" name="form_current_month_price" id="form_current_month_price"
            value="{{ old('form_current_month_price') ?? '' }}">
        <input type="hidden" name="form_is_premium" id="form_is_premium" value="{{ old('form_is_premium') ?? '0' }}">
        <input type="hidden" name="form_premium_price" id="form_premium_price"
            value="{{ old('form_premium_price') ?? '' }}">
    </form>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">1</span>/3</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span class="txt_point">1</span>/3</span>
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
                                @for ($i = 0; $i < 7; $i++)
                                    <input type="radio" name="type" id="type_{{ $i }}"
                                        value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                                    <label onclick="showDiv('store', {{ $i }} == 3 ? 1:0)"
                                        for="type_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <div class="btn_radioType">
                                @for ($i = 7; $i < 14; $i++)
                                    <input type="radio" name="type" id="type_{{ $i }}"
                                        value="{{ $i }}">
                                    <label
                                        for="type_{{ $i }}">{{ Lang::get('commons.product_type.' . $i) }}</label>
                                @endfor
                            </div>
                        </div>

                        <div>
                            <div class="btn_radioType">
                                @for ($i = 14; $i < 18; $i++)
                                    <input type="radio" name="type" id="type_{{ $i }}"
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
                                    <input type="radio" name="sales_type_1" id="sales_type_1_1" value="0"
                                        checked>
                                    <label for="sales_type_1_1" onclick="showDiv('type', 0)">매매</label>

                                    <input type="radio" name="sales_type_1" id="sales_type_1_2" value="1">
                                    <label for="sales_type_1_2" onclick="showDiv('type', 1)">임대</label>

                                    <input type="radio" name="sales_type_1" id="sales_type_1_3" value="2">
                                    <label for="sales_type_1_3" onclick="showDiv('type', 1)">단기임대</label>
                                </div>

                                <div class="type_wrap">
                                    <!-- 매매 -->
                                    <div class="type_item open_key active">
                                        <div class="input_item_grid">
                                            <div>
                                                <label class="input_label">매매가</label>
                                                <div class="input_area_1">
                                                    <input type="number" name="price" id="price_1"> <span
                                                        class="gray_deep">원</span>
                                                    <input type="checkbox" name="checkOne" id="checkOne_4"
                                                        value="Y">
                                                    <label for="checkOne_4" class="gray_deep"><span></span>
                                                        협의가능</label>
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
                                                            <input type="number" class="w_input_150" name="price"
                                                                id="price_2"><span>/</span>
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <label class="input_label">월임대료</label>
                                                        <div class="flex_1">
                                                            <input type="number" class="w_input_150"
                                                                name="month_price" id="month_price_1"><span>원</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item_check_add">
                                                    <input type="checkbox" name="checkOne" id="checkOne_4"
                                                        value="Y">
                                                    <label for="checkOne_4" class="gray_deep mt18"><span></span>
                                                        협의가능</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="input_label">기존 임대차 내용</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="lease_1" id="lease_1_1" value="1">
                                        <label for="lease_1_1" onclick="showDiv('lease_1', 0)">있음</label>

                                        <input type="radio" name="lease_1" id="lease_1_2" value="0">
                                        <label for="lease_1_2" onclick="showDiv('lease_1', 1)">없음</label>
                                    </div>
                                </div>
                                <div class="lease_1_wrap">
                                    <div class="lease_1_item open_key">
                                        <div class="flex_between w_30">
                                            <div class="item">
                                                <label class="input_label">현 보증금</label>
                                                <div class="flex_1">
                                                    <input type="number" class="w_input_150" name="current_price"
                                                        id="current_price_1"><span>/</span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <label class="input_label">현 월임대료</label>
                                                <div class="flex_between mt20">
                                                    <input type="number" class="w_input_150"
                                                        name="current_month_price" id="current_month_price_1" ><span>원</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lease_1_item open_key"></div>
                                </div>

                                <div id="store" style="display:none">
                                    <label class="input_label">권리금</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="keymoney" id="keymoney_1" value="Y">
                                        <label for="keymoney_1" onclick="showDiv('keymoney', 0)">있음</label>

                                        <input type="radio" name="keymoney" id="keymoney_2" value="Y">
                                        <label for="keymoney_2" onclick="showDiv('keymoney', 1)">없음</label>
                                    </div>
                                </div>

                                <div class="keymoney_wrap w_30">
                                    <div class="keymoney_item open_key">
                                        <div class="flex_1 flex_between">
                                            <input type="text" name="premium_price" id="premium_price"> <span>원</span>
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
                                    <input type="radio" name="sales_type_2" id="sales_type_2_1" value="Y"
                                        checked>
                                    <label for="sales_type_2_1" onclick="showDiv('type_2', 0)">매매</label>

                                    <input type="radio" name="sales_type_2" id="sales_type_2_2" value="Y">
                                    <label for="sales_type_2_2" onclick="showDiv('type_2', 1)">전세</label>

                                    <input type="radio" name="sales_type_2" id="sales_type_2_3" value="Y">
                                    <label for="sales_type_2_3" onclick="showDiv('type_2', 2)">월세</label>

                                    <input type="radio" name="sales_type_2" id="sales_type_2_4" value="Y">
                                    <label for="sales_type_2_4" onclick="showDiv('type_2', 2)">단기임대</label>
                                </div>

                                <div class="type_2_wrap">
                                    <!-- 매매 -->
                                    <div class="type_2_item open_key active">
                                        <div>
                                            <label class="input_label">매매가</label>
                                            <div class="input_area_1">
                                                <input type="number" class=""> <span
                                                    class="gray_deep">원</span>
                                                <input type="checkbox" name="checkOne" id="checkOne_4"
                                                    value="Y">
                                                <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 전세 -->
                                    <div class="type_2_item open_key">
                                        <div>
                                            <label class="input_label">전세가</label>
                                            <div class="input_area_1">
                                                <input type="number" class=""> <span
                                                    class="gray_deep">원</span>
                                                <input type="checkbox" name="checkOne" id="checkOne_4"
                                                    value="Y">
                                                <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
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
                                                        <input type="number" class="w_input_150"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="number" class="w_input_150"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item_check_add">
                                                <input type="checkbox" name="checkOne" id="checkOne_4"
                                                    value="Y">
                                                <label for="checkOne_4" class="gray_deep mt18"><span></span>
                                                    협의가능</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- 기존 임대차 내용 STRAT --}}
                                <div>
                                    <label class="input_label">기존 임대차 내용</label>
                                    <div class="btn_radioType">
                                        <input type="radio" name="lease_2" id="lease_2_1" value="Y">
                                        <label for="lease_2_1" onclick="showDiv('lease_2', 0)">있음</label>

                                        <input type="radio" name="lease_2" id="lease_2_2" value="Y">
                                        <label for="lease_2_2" onclick="showDiv('lease_2', 1)">없음</label>
                                    </div>
                                </div>
                                <div class="lease_2_wrap w_30">
                                    <div class="lease_2_item open_key">
                                        <div class="flex_between">
                                            <div class="item">
                                                <label class="input_label">현 보증금</label>
                                                <div class="flex_1">
                                                    <input type="number"><span>/</span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <label class="input_label">현 월임대료</label>
                                                <div class="flex_1">
                                                    <input type="number"><span>원</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="lease_2_item open_key"></div>
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
                                    <input type="radio" name="sales_type_3" id="sales_type_3_1" value="Y"
                                        checked>
                                    <label for="sales_type_3_1" onclick="showDiv('type_3', 0)">전매</label>

                                    <input type="radio" name="sales_type_3" id="sales_type_3_2" value="Y">
                                    <label for="sales_type_3_2" onclick="showDiv('type_3', 1)">전세</label>

                                    <input type="radio" name="sales_type_3" id="sales_type_3_3" value="Y">
                                    <label for="sales_type_3_3"onclick="showDiv('type_3', 2)">월세</label>
                                </div>

                                <div class="type_3_wrap">
                                    <!-- 전매 -->
                                    <div class="type_3_item open_key active">
                                        <div>
                                            <label class="input_label">전매가</label>
                                            <div class="input_area_1">
                                                <input type="number" class=""> <span
                                                    class="gray_deep">원</span>
                                                <input type="checkbox" name="checkOne" id="checkOne_4"
                                                    value="Y">
                                                <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- 전세 -->
                                    <div class="type_3_item open_key">
                                        <div>
                                            <label class="input_label">전세가</label>
                                            <div class="input_area_1">
                                                <input type="number" class=""> <span
                                                    class="gray_deep">원</span>
                                                <input type="checkbox" name="checkOne" id="checkOne_4"
                                                    value="Y">
                                                <label for="checkOne_4" class="gray_deep"><span></span> 협의가능</label>
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
                                                        <input type="number" class="w_input_150"><span>/</span>
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <label class="input_label">월임대료</label>
                                                    <div class="flex_1">
                                                        <input type="number" class="w_input_150"><span>원</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item_check_add">
                                                <input type="checkbox" name="checkOne" id="checkOne_5"
                                                    value="Y">
                                                <label for="checkOne_5" class="gray_deep mt18"><span></span>
                                                    협의가능</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div>
                                    <label class="input_label">준공예정일</label>
                                    <div class="w_30">
                                        <input type="number" placeholder="예) 20230101">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- 분양권 : e -->

                    </div>
                </div>

                <div class="step_btn_wrap">
                    <span></span>
                    <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point" disabled
                        onclick="location.href='estate_reg_2.html'">다음</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->

    </div>

    <script>
        //컨트롤러에 보낼 정보 저장

        //공통
        // 매물 유형
        $('input[name="type"]').click(function() {
            $('#form_type').val($(this).val());
        });


        // 매매가 & 보증금
        $('input[name="price"]').change(function() {
            $('#form_price').val($(this).val());
            console.log($('#form_price').val());
        });

        // 월임대료
        $('input[name="month_price"]').change(function() {
            $('#form_month_price').val($(this).val());
            console.log($('#form_month_price').val());
        });

        // 월임대료
        $('input[name="lease_1"]').change(function() {
            $('#form_is_use').val($(this).val());
            console.log($('#form_is_use').val());
        });

        // 산업용

        // 상업용 거래 타입
        $('input[name="sales_type_1"]').click(function() {
            $('#form_payment_type').val($(this).val());
        });



        //입력란 열고 닫기
        function showDiv(className, index) {

            // 매물 유형 상위 선택시에
            if (className == 'category') {
                if (index == 0) {
                    $('#type_0').prop('checked', true);
                } else if (index == 1) {
                    $('#type_7').prop('checked', true);
                } else if (index == 2) {
                    $('#type_14').prop('checked', true);
                }
            }

            // 매물 유형 하위 카테고리 선택시에 상가 아닐 경우
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
        }
    </script>

</x-layout>
