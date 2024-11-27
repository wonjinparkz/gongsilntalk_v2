<x-layout>

    <style>
        .dropdown_search .optionList {
            position: sticky;
            z-index: 101;
            margin-top: 5px;
            top: 45px;
            left: 0;
            width: 100%;
            color: #63605F;
            background: #fff;
            border: 1px solid #D2D1D0;
            border-radius: 5px;
            box-sizing: border-box;
            padding: 0;
            overflow: hidden;
            max-height: 0;
            display: none;
        }

        .dropdown_search.active {
            z-index: 101;
            position: sticky;
        }

        .dropdown_search.active .optionList {
            max-height: 222px;
            overflow-y: auto;
            display: block;
        }

        .dropdown_search .optionItem {
            padding: 10px 15px 10px;
            transition: .1s;
        }
    </style>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 제안서 받기 <span class="gray_basic"><span class="txt_point">1</span>/3</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->


    <div class="body">
        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 제안서 받기 <span class="step_number"><span class="txt_point">1</span>/3</span>
            </h1>

            <form method="get" action="{{ route('www.mypage.user.offer.second.create.view') }}" id="create_form"
                name="create_form">
                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>어디에 매물을 얻고 싶으신가요?</h4>
                        <div class="w_30">
                            {{-- <div class="search_wrap" onclick="onShowRegionList();">
                            </div> --}}
                            <div class="dropdown_box" id="regionList">
                                <input type="text" class="dropdown_label" id="regionSearch" name="regionSearch"
                                    placeholder="시·군·구로 검색해주세요" autocomplete='off'>
                                <ul class="optionList" id="regionOptionList">
                                    @foreach ($zcodeList as $zcode)
                                        <li class="optionItem" data-region-code="{{ $zcode->region_code }}"
                                            onclick="onAddRegion('{{ $zcode->zone }}', '{{ $zcode->region_code }}');">
                                            {{ $zcode->zone }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div>
                            <p class="txt_max_count">중복선택가능 <span id="regionBoxCount">0</span> / 3</p>
                            <div class="keyword_wrap" id="regionCreateBox">
                            </div>
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <h4>원하시는 매물 조건을 알려주세요.</h4>
                        <div class="btn_radioType">
                            <input type="radio" name="type" id="type_1" value="Y" checked>
                            <label for="type_1" onclick="showContent(0, 0)">상가</label>

                            <input type="radio" name="type" id="type_2" value="Y">
                            <label for="type_2" onclick="showContent(1, 1)">지산/사무실/창고</label>

                            <input type="radio" name="type" id="type_3" value="Y">
                            <label for="type_3" onclick="showContent(1, 2)">단독공장</label>
                        </div>

                        <div>
                            <label class="input_label">희망 면적 <span>*</span></label>
                            <div class="input_pyeong_area w_30">
                                <input type="text" id="area" name="area" placeholder="희망 면적"
                                    inputmode="numeric" oninput="onlyNumbers(this);area_change('');">
                                <span class="gray_deep">평&nbsp;/</span>
                                <input type="text" id="square" name="square" inputmode="numeric"
                                    oninput="imsi(this); square_change('');" placeholder="평 입력시 자동">
                                <span class="gray_deep">㎡</span>
                            </div>
                        </div>

                        <div class="type_item_wrap">
                            <div class="type_item active">
                                <div>
                                    <label class="input_label">희망 업종</label>
                                    <div class="dropdown_box only_pc mt8 w_30">
                                        <button class="dropdown_label" type="button">희망 업종 선택 </button>
                                        <ul class="optionList">
                                            @foreach (Lang::get('commons.product_business_type') as $key => $business_type)
                                                <li class="optionItem"
                                                    onclick="onBusinessChange('{{ $key }}', '');">
                                                    {{ $business_type }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!----------------------- M::희망 업종 : s ----------------------->
                                    <div class="dropdown_box m_full only_m mt8">
                                        <button type="button" class="dropdown_label" id="business_text"
                                            onclick="modal_open_slide('biz_type')">희망 업종
                                            선택</button>
                                    </div>
                                    <div class="modal_slide modal_slide_biz_type">
                                        <div class="slide_title_wrap">
                                            <span>희망 업종 선택</span>
                                            <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                onclick="modal_close_slide('biz_type')">
                                        </div>
                                        <ul class="slide_modal_menu">
                                            @foreach (Lang::get('commons.product_business_type') as $key => $business_type)
                                                <li class="optionItem"><a
                                                        onclick="onBusinessChange('{{ $key }}', this);">{{ $business_type }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="md_slide_overlay md_slide_overlay_biz_type"
                                        onclick="modal_close_slide('biz_type')"></div>
                                    <!----------------------- M::희망 업종 : e ----------------------->

                                </div>
                            </div>

                            <div class="type_item">
                                <div class="reg_item w_30">
                                    <label class="input_label">사용 인원<span>*</span></label>
                                    <div class="flex_1 flex_between">
                                        <input type="text" id="users_count" name="users_count"
                                            inputmode="numeric" oninput="onlyNumbers(this); onTextChangeEvent(this)">
                                        <span>명</span>
                                    </div>
                                    <p class="fs_13 gray_basic mt8">인원 당 2.5평을 추천해드립니다.</p>
                                </div>
                            </div>

                        </div>

                        <div>
                            <label class="input_label">입주 가능일 <span>*</span></label>
                            <div class="btn_radioType self_day_check mt8">
                                <input type="radio" name="day" id="day_1" value="0" checked>
                                <label for="day_1" onclick="toggleCalendar(0)">즉시 입주</label>

                                <input type="radio" name="day" id="day_2" value="1">
                                <label for="day_2" onclick="toggleCalendar(0)">날짜 협의</label>

                                <input type="radio" name="day" id="day_3" value="2">
                                <label for="day_3" onclick="toggleCalendar(1)">직접 입력</label>
                            </div>
                            <div class="self_day_wrap">
                                <div class="self_day_item"></div>
                                <div class="self_day_item w_30">
                                    <div class="input_calendar_term">
                                        <div>
                                            <label class="input_label">입주 가능 기간</label>
                                            <input type="text" id="start_move_date_0" name="start_move_date_0"
                                                placeholder="예) 20230101" inputmode="numeric"
                                                oninput="onlyNumbers(this); onDateChangeEvent('start_move_date', 0);">
                                        </div>
                                        <span>~</span>
                                        <div>
                                            <label class="input_label">&nbsp;</label>
                                            <input type="text" id="ended_move_date_0" name="ended_move_date_0"
                                                placeholder="예) 20230101" inputmode="numeric"
                                                oninput="onlyNumbers(this); onDateChangeEvent('ended_move_date', 0);">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <input type="hidden" id="type" name="type" value="0">
                    <input type="hidden" id="business_type" name="business_type" value="">
                    <input hidden name="start_move_date" id="start_move_date">
                    <input hidden name="ended_move_date" id="ended_move_date">

                    <div class="step_btn_wrap">
                        <span></span>
                        <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point" id="nextPageButton" type="button" disabled
                            onclick="onFormSubmit();">다음</button>
                    </div>

                </div>
            </form>
        </div>
        <!-- my_body : e -->
    </div>

    <script>
        function onFormSubmit() {
            let value = $('#users_count').val();
            value = value.replace(/,/g, '');
            $('#users_count').val(value);

            $('#create_form').submit();
        }

        function onBusinessChange(index, e) {
            if (e) {
                modal_close_slide('biz_type')
                $('#business_text').text(e.text);
            }
            $('#business_type').val(index);
            onFieldInputCheck();
        }

        function toggleCalendar(index) {
            var tabContents = document.querySelectorAll('.self_day_wrap .self_day_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }

        //직접입력
        $('#regionSearch').keyup(function(e) {
            var searchValue = $('#regionSearch').val().toLowerCase(); // 검색어를 소문자로 변환
            $('#regionOptionList li').each(function() {
                var zoneText = $(this).text().toLowerCase(); // li의 텍스트를 소문자로 변환
                if (zoneText.includes(searchValue)) {
                    $(this).show(); // 검색어가 포함된 항목은 보이기
                } else {
                    $(this).hide(); // 검색어가 포함되지 않은 항목은 숨기기
                }
            });
            regionListCheck();
        });


        //매물조건 구분
        function showContent(index, type) {
            $('#type').val(type);

            var tabContents = document.querySelectorAll('.type_item_wrap .type_item');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });
            tabContents[index].classList.add('active');
        }

        // 매물지역 삭제
        function keyword_item(button) {
            var div = button.parentNode;
            div.parentNode.removeChild(div);
            $('#regionBoxCount').text(parseInt($('#regionBoxCount').text()) - 1);
            onFieldInputCheck();

            // 모든 항목을 먼저 보여주기
            $('#regionOptionList li').show();
            regionListCheck();
        }

        function onAddRegion(region, regionCode) {
            var count = $('#regionBoxCount').text();

            if (parseInt(count) < 3) {

                var regionDiv = ` <div class="keyword_item">${region} <button type="button" onclick="keyword_item(this)">
                                <img src="{{ asset('assets/media/btn_solid_delete.png') }}">
                            </button>
                            <input type="hidden" id="region_zone[]" name="region_zone[]" value="${region}">
                            <input type="hidden" id="region_code[]" name="region_code[]" value="${regionCode}">
                        </div>`;
                $('#regionBoxCount').text(parseInt(count) + 1);
                $('#regionCreateBox').append(regionDiv);
            }

            onFieldInputCheck();
            regionListCheck();
        }

        function regionListCheck() {
            var regionArr = []; // 빈 배열 생성

            // 모든 input[name="region_code[]"] 값을 배열에 담기
            $('input[name="region_code[]"]').each(function() {
                regionArr.push($(this).val()); // 각 값을 배열에 추가
            });


            // 배열을 순회하여 선택된 region_code와 일치하는 항목만 숨기기
            regionArr.forEach(function(code) {
                // 해당 region_code에 해당하는 li 항목을 직접 선택해서 숨기기
                var $liToHide = $('#regionOptionList li[data-region-code="' + code + '"]');
                if ($liToHide.length > 0) {
                    $liToHide.hide(); // 선택된 region_code와 일치하는 항목 숨기기
                }
            });
        }

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

            var areaCheck = ($('#area').val() != '') ? true : false;
            var businessCheck = false;
            var countCheck = false;
            var startDayCheck = false;
            var endDayCheck = false;
            var regionLength = ($('#regionCreateBox').children().length > 0) ? true : false;

            if ($('#type').val() == '0') {
                countCheck = true;
                businessCheck = ($('#business_type').val() != '') ? true : false;
            } else {
                countCheck = ($('#users_count').val() != '') ? true : false;
                businessCheck = true;
            }

            if ($("input[name='day']:checked").val() == '2') {
                startDayCheck = ($('#start_move_date').val() != '') ? true : false;
                endDayCheck = ($('#ended_move_date').val() != '') ? true : false;
            } else {
                startDayCheck = true;
                endDayCheck = true;
            }

            if (areaCheck && countCheck && businessCheck && regionLength && startDayCheck && endDayCheck) {
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
