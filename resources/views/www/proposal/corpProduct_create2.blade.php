<x-layout>

    <form class="find_form" method="POST" action="{{ route('www.corp.proposal.product.create.price.check') }}"
        name="create_check">
        <input type="hidden" name="payment_type" id="payment_type" value="0">
        <input type="hidden" name="price" id="price" value="">
        <input type="hidden" name="month_price" id="month_price" value="">

        <!----------------------------- m::header bar : s ----------------------------->
        <div class="m_header">
            <div class="left_area"><a href="javascript:history.go(-1)"><img
                        src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
            <div class="m_title">신규 건물 <span class="gray_basic"><span class="txt_point">2</span>/3</span></div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">신규 건물 하기 <span class="step_number"><span
                            class="txt_point">2</span>/3</span>
                </h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>거래정보 <span class="txt_point">*</span></h4>
                        <ul class="tab_type_3 tab_toggle_menu">
                            <li class="active" onclick="paymentCheck(0)">매매</li>
                            <li onclick="paymentCheck(3)">전세</li>
                            <li onclick="paymentCheck(4)">월세</li>
                        </ul>
                        <div class="tab_area_wrap">
                            <div>
                                <div class="btn_radioType">

                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">매매(전매)가 <span class="txt_point">*</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="price_0" placeholder="매매(전매)가"
                                                    class="w_input_150">
                                                <span>원</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                            <label class="input_label">프리미엄</label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="premium_price" placeholder="프리미엄"
                                                    class="w_input_150">
                                                <span>원</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">취득세율 <span class="txt_point">*</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="acquisition_tax" placeholder="소수점 두자리까지만 입력"
                                                    class="w_input_150" onkeyup="imsi(this)">
                                                <span>%</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                            <label class="input_label">
                                                지원금액<span class="gray_basic">(인테리어 등)</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="support_price" placeholder="지원금액"
                                                    class="w_input_150">
                                                <span>원</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">
                                                기타비용<span class="gray_basic">(세무비용,부동산수수료,기타비용)</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="etc_price" placeholder="기타비용"
                                                    class="w_input_150">
                                                <span>원</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                        </div>
                                    </div>

                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">
                                                대출 가능률1 <span class="txt_point">*</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="loan_rate_one" placeholder="예) 80"
                                                    class="w_input_150">
                                                <span>%</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                            <label class="input_label">
                                                대출 가능률2 <span class="txt_point">*</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="loan_rate_two" placeholder="예) 80"
                                                    class="w_input_150">
                                                <span>%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">
                                                대출금리
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="loan_interest"
                                                    placeholder="소수점 두자리까지만 입력" class="w_input_150"
                                                    onkeyup="imsi(this)">
                                                <span>%</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                        </div>
                                    </div>

                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">
                                                대출금리
                                            </label>
                                            <div class="btn_radioType">
                                                <input type="radio" name="is_invest" id="is_invest_2"
                                                    value="1" checked>
                                                <label for="is_invest_2" onclick="showDiv('invest', 1)">투자</label>
                                                <input type="radio" name="is_invest" id="is_invest_1"
                                                    value="0">
                                                <label for="is_invest_1" onclick="showDiv('invest', 0)">실입주</label>
                                            </div>

                                            <div class="reg_item">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="invest_wrap mt8">
                                        <div class="invest_item open_key"></div>
                                        <div class="invest_item open_key active">
                                            <div class="reg_item">
                                                <div class="input_pyeong_area">
                                                    <div>
                                                        <label class="input_label">
                                                            보증금
                                                        </label><input type="number" name="invest_price"
                                                            placeholder="보증금"> <span class="gray_deep"></span>
                                                        <span class="gray_deep">/</span>
                                                    </div>
                                                    <div>
                                                        <label class="input_label">
                                                            월임대료
                                                        </label><input type="number" name="invest_month_price"
                                                            placeholder="월임대료"> <span class="gray_deep">원</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <div>
                                <div class="btn_radioType">
                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">전세보증금 <span class="txt_point">*</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="price_3" placeholder="전세보증금"
                                                    class="w_input_150">
                                                <span>원</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="btn_radioType">
                                    <div class="reg_item">
                                        <div class="input_pyeong_area">
                                            <div>
                                                <label class="input_label">
                                                    보증금 <span class="txt_point">*</span>
                                                </label><input type="number" placeholder="보증금" name="price_4">
                                                <span class="gray_deep">/</span>
                                            </div>
                                            <div>
                                                <label class="input_label">
                                                    월임대료 <span class="txt_point">*</span>
                                                </label><input type="number" placeholder="월임대료"
                                                    name="month_price_4">
                                                <span class="gray_deep">원</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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

    </form>


    <script>
        $(document).ready(function() {
            confrim_check();
        });

        var prev = "";
        var regexp = /^\d*(\.\d{0,2})?$/;

        function imsi(obj) {
            if (obj.value.search(regexp) == -1) {
                obj.value = prev;
            } else {
                prev = obj.value;
            }
        }

        $('input[type="checkbox"]').change(function() {
            confrim_check();
        });

        $('input[type="radio"]').change(function() {
            confrim_check();
        });

        $('input[type="number"]').change(function() {
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

            sessionStorage.setItem("is_mapSession", is_map ? '0' : '1');
            sessionStorage.setItem("corp_proposal_idSession", corp_proposal_id);
            sessionStorage.setItem("product_typeSession", product_type);
            sessionStorage.setItem("typeSession", type);
            sessionStorage.setItem("address_lngSession", address_lng);
            sessionStorage.setItem("address_latSession", address_lat);
            sessionStorage.setItem("region_codeSession", region_code);
            sessionStorage.setItem("region_addressSession", region_address);
            sessionStorage.setItem("addressSession", address);
            sessionStorage.setItem("product_nameSession", address_detail);

            $('.find_form').submit();
        }


        //입력란 열고 닫기
        function paymentCheck(index) {
            $('#payment_type').val(index);
            confrim_check();
        }

        //입력란 열고 닫기
        function showDiv(className, index) {
            var tabContents = document.querySelectorAll('.' + className + '_wrap .' + className + '_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }
    </script>

</x-layout>
