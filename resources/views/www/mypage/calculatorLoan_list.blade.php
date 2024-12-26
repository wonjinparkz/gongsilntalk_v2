<x-layout>

    @php

        function calculate_mortgage_constant($interest_rate, $loan_month)
        {
            // 월 이자율 계산 (연 이자율을 12로 나눔)
            $monthly_rate = $interest_rate / 12;
            // 저당상수 계산
            $mortgage_constant = $monthly_rate / (1 - pow(1 + $monthly_rate, -$loan_month));
            return $mortgage_constant;
        }

    @endphp

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">대출이자 계산기</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">대출이자 계산기</h1>
                    <div class="my_tab_wrap inner_out">
                        <ul class="tab_type_5">
                            <li class=""
                                onclick="location.href='{{ route('www.mypage.calculator.revenue.list.view') }}'">
                                수익률 계산
                            </li>
                            <li class="active"
                                onclick="location.href='{{ route('www.mypage.calculator.loan.list.view') }}'">
                                대출이자 계산
                            </li>
                        </ul>
                    </div>

                    <div class="calculator_btn_wrap">
                        <button type="button" class="btn_point btn_basic" onclick="modal_open('rev_calculator')">대출 이자
                            계산기</button>
                    </div>

                    <div class="calculator_container">
                        @foreach ($loanList as $key => $loan)
                            <!-- 계산서 : s -->
                            <div class="loan_item" id="loanItem{{ $loan->id }}">
                                <div class="item_tit_wrap">
                                    <h4>
                                        <span>
                                            @php
                                                $title = '';
                                                switch ($loan->type) {
                                                    case 0:
                                                        $title = '원금균등분할';
                                                        break;
                                                    case 1:
                                                        $title = '원리금균등분할';
                                                        break;
                                                    case 2:
                                                        $title = '만기일시';
                                                        break;

                                                    default:
                                                        $title = '원금균등분할';
                                                        break;
                                                }
                                            @endphp
                                            {{ $title }}
                                        </span>
                                        계산서 {{ $key + 1 }}
                                    </h4>
                                    <div class="btn_area">
                                        <button class="btn_graylight_ghost btn_sm btn_share only_pc"
                                            data-share="loan_{{ $key }}">공유</button>
                                        <div class="layer layer_share_wrap layer_share_top loan_{{ $key }}">
                                            <div class="layer_title">
                                                <h5>공유하기</h5>
                                                <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                    class="md_btn_close btn_share"
                                                    data-share="loan_{{ $key }}">
                                            </div>
                                            <div class="layer_share_con">
                                                <a class="kakaotalk-sharing-btn" data-id="{{ $loan->id }}">
                                                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                                    <p class="mt8">카카오톡</p>
                                                </a>
                                                <a
                                                    onclick="textCopy('{{ env('APP_URL') }}/share/calculator/loan/detail/{{ $loan->id }}');$('.layer_share_wrap').stop().slideUp(0);">
                                                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                                    <p class="mt8">링크복사</p>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="only_m"><!-- m -->
                                            <button class="btn_graylight_ghost btn_sm btn_share"
                                                onclick="modal_open_slide('share_{{ $loan->id }}')">공유</button>
                                        </div>
                                        <div class="modal_slide modal_slide_share_{{ $loan->id }}">
                                            <div class="slide_title_wrap">
                                                <span>공유하기</span>
                                                <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                    onclick="modal_close_slide('share_{{ $loan->id }}')">
                                            </div>
                                            <div class="slide_modal_body">
                                                <div class="layer_share_con">

                                                    <a class="kakaotalk-sharing-btn" data-id="{{ $loan->id }}"
                                                        onclick="modal_close_slide('share_{{ $loan->id }}');">
                                                        <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                                        <p class="mt8">카카오톡</p>
                                                    </a>
                                                    <a
                                                        onclick="textCopy('{{ env('APP_URL') }}/share/calculator/loan/detail/{{ $loan->id }}');modal_close_slide('share_{{ $loan->id }}');">
                                                        <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                                        <p class="mt8">링크복사</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" onclick="onDataDelete('{{ $loan->id }}');"
                                            class="btn_graylight_ghost btn_sm">삭제</button>
                                    </div>
                                </div>

                                <form method="post" name="deleteForm{{ $loan->id }}"
                                    id="deleteForm{{ $loan->id }}"
                                    action="{{ route('www.calculator.loan.delete') }}">
                                    <input type="hidden" id="id" name="id" value="{{ $loan->id }}">
                                </form>

                                <div class="table_container columns_2">
                                    <div class="td">대출금액</div>
                                    <div class="td">{{ number_format($loan->loan_price) }}원</div>

                                    @if ($loan->type != 2)
                                        <div class="td">대출기간</div>
                                        <div class="td">{{ $loan->loan_month }}개월
                                            @if ($loan->holding_month != '')
                                                <span class="gray_basic">거치기간 {{ $loan->holding_month }}개월</span>
                                            @endif
                                        </div>
                                        @if ($loan->type != 0)
                                            <div class="td">월상환금액</div>
                                            <div class="td" id="repayment_price_{{ $loan->id }}"></div>
                                        @endif
                                    @else
                                        <div class="td">상환기간</div>
                                        <div class="td">{{ $loan->loan_month }}개월</div>
                                    @endif

                                    <div class="td">총 이자액</div>
                                    <div class="td" id="total_loan_price_{{ $loan->id }}">
                                        <span class="txt_point"> (금리{{ $loan->loan_rate }}%)</span>
                                    </div>
                                    <div class="td">총 상환금액</div>
                                    <div class="td" id="total_repayment_price_{{ $loan->id }}">
                                    </div>
                                </div>

                                <div class="flex_between mt20">
                                    <h4>상환 스케줄 </h4>
                                    <div class="fs_13 gray_basic">(단위 : 원)</div>
                                </div>

                                <div class="repayment_schedule_wrap">
                                    @php
                                        $payment_price = 0;
                                        $month_payment_price = 0;
                                        $one_loan_price = 0;

                                        $loan_price = $loan->loan_price; // 잔금
                                        $balance = $loan->loan_price; // 잔금 계산
                                        $loan_month = $loan->loan_month;
                                        $loan_rate = $loan->loan_rate / 100;
                                        $type = $loan->type;

                                        $total_loan_price = 0;
                                    @endphp
                                    @for ($i = 1; $i <= $loan_month; $i++)
                                        @php
                                            if ($type == 0) {
                                                if ($loan->holding_month != '' && $i <= $loan->holding_month) {
                                                    $payment_price = 0;
                                                } else {
                                                    $payment_price = $loan_price / ($loan_month - $loan->holding_month);
                                                }

                                                $loan_month_price =
                                                    (($loan_price - ($i - $loan->holding_month - 1) * $payment_price) *
                                                        $loan_rate) /
                                                    12;

                                                $month_price = $payment_price + $loan_month_price;
                                            } elseif ($type == 1) {
                                                if ($loan->holding_month != '' && $i <= $loan->holding_month) {
                                                    // 거치기간 동안
                                                    $payment_price = 0;
                                                    $loan_month_price = ($loan_price * $loan_rate) / 12;
                                                    $month_price = $loan_month_price;
                                                } else {
                                                    if ($i == $loan->holding_month + 1) {
                                                        // 거치기간 후 첫 달
                                                        $one_loan_price =
                                                            $loan_price *
                                                            calculate_mortgage_constant(
                                                                $loan_rate,
                                                                $loan_month - $loan->holding_month,
                                                            );
                                                        $month_price = $one_loan_price;
                                                    }

                                                    // 거치기간 후 모든 달
                                                    $loan_month_price = ($balance * $loan_rate) / 12;
                                                    $payment_price = $month_price - $loan_month_price;
                                                }
                                            } elseif ($type == 2) {
                                                if ($i == $loan_month) {
                                                    $payment_price = $loan_price;
                                                }
                                                $loan_month_price = ($loan_price * $loan_rate) / 12;

                                                $month_price = $loan_month_price + $payment_price;
                                            }

                                            $balance -= $payment_price;
                                            $total_loan_price += $loan_month_price;
                                        @endphp

                                        <div class="repayment_schedule_item">
                                            <div class="schedule_tit_tiem">
                                                <span>{{ $i }}회차</span>
                                                <span>잔금 : {{ number_format($balance) }}</span>
                                            </div>
                                            <table class="repayment_table">
                                                <tr>
                                                    <th>월상환금</th>
                                                    <th>납입원금</th>
                                                    <th>이자액</th>
                                                </tr>
                                                <tr>
                                                    <td>{{ number_format($month_price) }}</td>
                                                    <td>{{ number_format($payment_price) }}</td>
                                                    <td>{{ number_format($loan_month_price) }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endfor
                                    <script>
                                        $('#repayment_price_{{ $loan->id }}').text('{{ number_format($month_price) }}원')
                                        $('#total_loan_price_{{ $loan->id }}').html(
                                            `{{ number_format($total_loan_price) }}원<span class="txt_point"> (금리{{ $loan->loan_rate }}%)</span>`)
                                        $('#total_repayment_price_{{ $loan->id }}').text(
                                            '{{ number_format($total_loan_price + $loan->loan_price) }}원')
                                    </script>
                                </div>
                            </div>
                            <!-- 계산서 : e -->
                        @endforeach
                    </div>
                </div>
                <!-- my_body : e -->

            </div>

            <!-- modal 대출계산기 : s -->
            <div class="modal modal_mid modal_rev_calculator">
                <div class="modal_title">
                    <h5>대출 계산기</h5>
                    <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                        onclick="modal_close('rev_calculator')">
                </div>
                <div class="modal_container">
                    <div class="gray_basic txt_lh_1">
                        대출 시 납부할 이자를 계산합니다. 상환방법, 대출기간, 이율에 따른 월별 상환 테이블, 총 납부 이자를 확인할 수 있습니다.<br>
                        보다 정확한 계산을 위해서는 전문 계산기를 이용해주세요.
                    </div>
                </div>

                <form method="post" action="{{ route('www.calculator.loan.create') }}">
                    <div class="md_sm_scroll">

                        <ul class="tab_toggle_menu tab_type_4">
                            <li class="active" onclick="onTypeChange(0);"><a href="javascript:(0)">원금균등분할</a></li>
                            <li onclick="onTypeChange(1);"><a href="javascript:(0)">원리금균등분할</a></li>
                            <li onclick="onTypeChange(2);"><a href="javascript:(0)">만기일시</a></li>
                        </ul>

                        <div class="checkbox_wrap mt20">
                            <div id="dateCheckBox">
                                <input type="checkbox" name="check" id="check_1" value="Y">
                                <label for="check_1"><span></span>거치기간</label>
                            </div>
                            <div>
                                {{-- <input type="checkbox" name="check" id="check_2" value="Y">
                                <label for="check_2"><span></span>중도상환/금리변동</label> --}}
                            </div>
                        </div>

                        <ul class="reg_bascic mt18">
                            <li>
                                <div class="btn_half_wrap">
                                    <div>
                                        <label>대출원금</label>
                                        <div class="flex_1">
                                            <input type="text" id="loan_price" name="loan_price"
                                                inputmode="numeric"
                                                oninput="onlyNumbers(this); onTextChangeEvent(this);"> <span>원</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label>이자율</label>
                                        <div class="flex_1">
                                            <input type="text" placeholder="소수점 두자리까지 입력" id="loan_rate"
                                                inputmode="numeric" name="loan_rate" oninput="imsi(this)">
                                            <span>%</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="btn_half_wrap">
                                    <div>
                                        <label>대출기간</label>
                                        <div class="flex_1">
                                            <input type="text" id="loan_month" name="loan_month"
                                                inputmode="numeric" oninput="onlyNumbers(this);">
                                            <span>개월</span>
                                        </div>
                                    </div>
                                    <div id="doneDate" style="display:none;">
                                        <!-- 만기일시는 거치기간을 삭제해 주세요. -->
                                        <label>거치기간</label>
                                        <div class="flex_1">
                                            <input type="text" id="holding_month" name="holding_month"
                                                inputmode="numeric" oninput="onlyNumbers(this)">
                                            <span>개월</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        <div class="btn_half_wrap dataAddButton" style="display:none;">
                            <button type="button" class="btn_additem_1 btn_point_ghost btn_full_thin txt_r"
                                id="additem_1">중도상환
                                추가</button>
                            <button type="button" class="btn_additem_2 btn_point_ghost btn_full_thin txt_r"
                                id="additem_2">금리변동
                                추가</button>
                        </div>

                        <div class="item_wrap_1">
                            <h6 class="mt20">중도상환</h6>
                            <div id="itemContaniner_1"></div>
                            <hr class="mt18">
                        </div>

                        <div class="item_wrap_2">
                            <h6 class="mt20">금리변동</h6>
                            <div id="itemContaniner_2"></div>
                        </div>
                    </div>

                    <input type="hidden" id="type" name="type" value="0">
                    <div class="modal_container">
                        <button type="submit" class="btn_point btn_full_basic" id="nextPageButton" disabled><b>대출이자
                                계산하기</b></button>
                    </div>
                </form>


            </div>
            <div class="md_overlay md_overlay_rev_calculator" onclick="modal_close('rev_calculator')"></div>
            <!-- modal 대출계산기 : e -->


        </div>

    </div>

    <script>
        var onTypeChange = (type) => {
            $('#type').val(type);
            if (type != 2) {
                $('#dateCheckBox').show();
            } else {
                document.getElementById('check_1').checked = false;
                $('#dateCheckBox').hide();
                $('#doneDate').hide();
            }
        }

        // 거치 기간 선택 시
        $('#check_1').click(function() {
            const checkbox = document.getElementById('check_1');
            if (checkbox.checked == true) {
                $('#doneDate').show();
            } else {
                $('#doneDate').hide();
            }
        });

        // 중도 상환 / 금리 변동 선택 시
        $('#check_2').click(function() {
            const checkbox = document.getElementById('check_2');
            if (checkbox.checked == true) {
                $('.dataAddButton').show();
            } else {
                $('.dataAddButton').hide();
            }
        });

        //중도상환 추가
        $('.btn_additem_1').click(function() {
            $('.item_wrap_1').css('display', 'block');
        });

        document.getElementById("additem_1").addEventListener("click", function() {
            var newItem = document.createElement("div");
            newItem.className = "item";
            newItem.innerHTML = `
            <div class="input_time_row">
                <div>
                    <label class="input_label">회차</label>
                    <div class="flex_1">
                        <input type="number" placeholder="1" name="prePayCount[]">
                        <span>/</span>
                    </div>
                </div>
                <div>
                    <label class="input_label">상환 금액</label>
                    <div class="flex_1">
                        <input type="text" name="prePay[]" oninput="onlyNumbers(this)" onfocus="toggleInputType(this)"
                                        onblur="toggleInputType(this);onTextChangeEvent(this);">
                        <span>원</span>
                        <button type="button" class="btn_graylight_ghost btn_input txt_r deleteBtn_1">삭제</button>
                    </div>
                </div>
            </div>
            `;
            document.getElementById("itemContaniner_1").appendChild(newItem);

            var deleteBtn = newItem.querySelector(".deleteBtn_1");
            deleteBtn.addEventListener("click", function() {
                newItem.remove();
                if (document.querySelectorAll('.item').length === 0) {
                    document.querySelector('.item_wrap_1').style.display = 'none';
                }
            });
        });

        //금리변동 추가
        $('.btn_additem_2').click(function() {
            $('.item_wrap_2').css('display', 'block');
        });

        document.getElementById("additem_2").addEventListener("click", function() {
            var newItem = document.createElement("div");
            newItem.className = "item2";
            newItem.innerHTML = `
            <div class="input_time_row">
                <div>
                    <label class="input_label">회차</label>
                    <div class="flex_1">
                        <input type="number" placeholder="1" name="rateCount[]">
                        <span>/</span>
                    </div>
                </div>
                <div>
                    <label class="input_label">변동 금리</label>
                    <div class="flex_1">
                        <input type="number" name="interestRate[]" onfocus="toggleInputTypeImsi(this)" onblur="toggleInputTypeImsi(this);" onkeyup="imsi1(this)" >
                        <span>%</span>
                        <button type="button" class="btn_graylight_ghost btn_input txt_r deleteBtn_2">삭제</button>
                    </div>
                </div>
            </div>
            `;
            document.getElementById("itemContaniner_2").appendChild(newItem);

            var deleteBtn = newItem.querySelector(".deleteBtn_2");
            deleteBtn.addEventListener("click", function() {
                newItem.remove(); // 요소 삭제
                if (document.querySelectorAll('.item2').length === 0) {
                    document.querySelector('.item_wrap_2').style.display = 'none';
                }
            });
        });

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
            if ($('#loan_price').val() != '' && $('#loan_rate').val() != '' && $('#loan_month').val() != '') {
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

        function onDataDelete(id) {
            $("#deleteForm" + id).submit();
        }

        // 주소 복사
        var textCopy = (url) => {
            window.navigator.clipboard.writeText(url).then(() => {
                alert("링크가 복사 되었습니다.");
            });
        };

        //공유하기 레이어
        $(".btn_share").click(function() {
            var shareLayerClass = $(this).data("share");
            $("." + shareLayerClass).stop().slideToggle(0);
            return;
        });

        document.querySelectorAll('.kakaotalk-sharing-btn').forEach(function(button) {
            var loan_id = button.getAttribute('data-id');

            button.addEventListener('click', function() {
                $(".layer_share_wrap").stop().slideUp(0);

                Kakao.Share.sendDefault({
                    objectType: "feed",
                    content: {
                        title: '공실앤톡 대출이자 계산기를 공유드립니다.',
                        description: '',
                        link: {
                            mobileWebUrl: '{{ env('APP_URL') }}/share/calculator/loan/detail/' +
                                loan_id,
                            webUrl: '{{ env('APP_URL') }}/share/calculator/loan/detail/' +
                                loan_id,
                        },
                    }
                });
            });
        });
    </script>

</x-layout>
