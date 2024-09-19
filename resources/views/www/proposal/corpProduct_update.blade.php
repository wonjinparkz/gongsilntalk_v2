<x-layout>
    @inject('carbon', 'Carbon\Carbon')

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">건물 정보 수정</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="body">
        <form method="post" id="updateForm" action="{{ route('www.corp.proposal.product.update') }}">

            <input type="hidden" id="id" name="id" value="{{ $product->id }}">
            <input type="hidden" id="corp_proposal_id" name="corp_proposal_id"
                value="{{ $product->corp_proposal_id }}">
            <input type="hidden" id="type" name="type" value="{{ $product->type }}">

            <input type="hidden" name="product_type" id="product_type" value="{{ $product->product_type }}">
            <input type="hidden" name="payment_type" id="payment_type" value="{{ $product->price->payment_type }}">
            <input type="hidden" name="move_date" id="move_date" value="{{ $product->move_date }}">

            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">건물 정보 수정</h1>

                <div class="offer_step_wrap">
                    <div class="box_01 box_reg">
                        <h4>부동산 유형 <span class="txt_point">*</span></h4>
                        <div class="estate_type_txt">
                            {{ $product->product_type == 0 ? '상업용' : '주거용' }} >
                            {{ Lang::get('commons.corp_product_type.' . $product->type) }}
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <h4>위치 및 주소 <span class="txt_point">*</span></h4>

                        <input type="hidden" name="address_lng" id="address_lng" value="{{ $product->address_lng }}">
                        <input type="hidden" name="address_lat" id="address_lat" value="{{ $product->address_lat }}">
                        <input type="hidden" name="region_code" id="region_code" value="{{ $product->region_code }}">
                        <input type="hidden" name="region_address" id="region_address"
                            value="{{ $product->region_address }}">
                        <input type="hidden" name="address" id="address" value="{{ $product->address }}">
                        <input type="hidden" name="old_address" id="old_address" value="{{ $product->old_address }}">

                        <div class="address_reg_wrap">
                            <div class="inner_item">
                                <div class="search_address_1 active">
                                    <button type="button" class="btn_graylight_ghost btn_full_thin txt_r"
                                        onclick="getAddress()">주소
                                        검색</button>
                                </div>
                                <div class="search_address_2">
                                    <button type="button" class="btn_graylight_ghost btn_full_thin txt_r"
                                        onclick="modal_open('address_search')">(구)주소 검색</button>
                                </div>
                                <div class="mt8 gap_14">
                                    <input type="checkbox" name="is_map" id="is_map" value="1"
                                        {{ $product->is_map == 1 ? 'checked' : '' }}>
                                    <label for="is_map" class="gray_deep"><span></span> (구)주소</label>
                                </div>
                                <!----------------- M:: map : s ----------------->
                                <div class="inner_item inner_map only_m mapOnlyMobile">
                                    <div id="mapWrap" class="mapWrap"
                                        style="width: 100%; height: 100%; border-left: 1px solid #ddd;"></div>
                                </div>
                                {{-- 주소 검색 시,<br>해당 위치가 지도에 표시됩니다. --}}
                                <!----------------- M:: map : e ----------------->
                                <div class="inner_address">
                                    <div class="address_row" id="roadName">
                                        <span>도로명</span>{{ $product->address }}
                                    </div>
                                    <div class="address_row" id="jibunName">
                                        @if ($product->old_address != '')
                                            <span>
                                                지번
                                            </span>
                                            {{ $product->old_address }}
                                        @endif
                                    </div>
                                </div>

                                <div class="detail_address_1 mt18 active">
                                    <div class="flex_2">
                                        <div class="col-lg-5 fv-row">
                                            <label class="gray_deep">상세주소 <span class="txt_point">*</span></label>
                                            <input type="text" id="address_detail" name="address_detail"
                                                value="{{ $product->address_detail }}"
                                                {{ $product->address_detail == '' ? 'disabled' : '' }}
                                                placeholder="상세주소 입력 예) 1동 101호">
                                        </div>
                                        <div class="col-lg-5 fv-row">
                                            <label class="gray_deep">건물명 <span class="txt_point">*</span></label>
                                            <input type="text" id="product_name" name="product_name"
                                                value="{{ $product->product_name }}"
                                                {{ $product->product_name == '' ? 'disabled' : '' }}
                                                placeholder="건물명을 입력해주세요">
                                        </div>
                                    </div>
                                    <div class="mt8">
                                        <input type="checkbox" name="is_address_detail" id="is_address_detail"
                                            value="1" {{ $product->address_detail == '' ? 'checked' : '' }}>
                                        <label for="is_address_detail" class="gray_deep"><span></span> 상세주소
                                            없음</label>
                                    </div>
                                </div>
                            </div>
                            <div class="inner_item inner_map only_pc mapOnlyPc">
                                <div id="is_temporary_1" style="display: none">
                                    (구)주소 선택시,<br>지도 노출이 불가능합니다.
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript"
                        src="https://business.juso.go.kr/juso_support_center/js/addrlink/map/jusoro_map_api.min.js?confmKey={{ env('CONFM_MAP_KEY') }}&skinType=1">
                    </script>

                    <div class="box_01 box_reg">
                        <h4>거래정보 <span class="txt_point">*</span></h4>
                        <ul class="tab_type_3 tab_toggle_menu">
                            <li class="{{ $product->price->payment_type == 0 ? 'active' : '' }}"
                                onclick="paymentCheck(0)">매매</li>
                            <li class="{{ $product->price->payment_type == 3 ? 'active' : '' }}"
                                onclick="paymentCheck(3)">전세</li>
                            <li class="{{ $product->price->payment_type == 4 ? 'active' : '' }}"
                                onclick="paymentCheck(4)">월세</li>
                        </ul>
                        <div class="tab_area_wrap">
                            <div>
                                <div class="btn_radioType">
                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">매매(전매)가 <span class="txt_point">*</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="text" name="price_0" placeholder="매매(전매)가"
                                                    class="w_input_150" inputmode="numeric"
                                                    value="{{ number_format($product->price->price) }}"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                <span>원</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                            <label class="input_label">프리미엄</label>
                                            <div class="flex_1 mt10">
                                                <input type="text" name="premium_price" placeholder="프리미엄"
                                                    class="w_input_150" inputmode="numeric"
                                                    value="{{ $product->price->premium_price != '' ? number_format($product->price->premium_price) : '' }}"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                <span>원</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">취득세율 <span class="txt_point">*</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="text" name="acquisition_tax"
                                                    placeholder="소수점 두자리까지만 입력" class="w_input_150"
                                                    value="{{ $product->price->acquisition_tax }}"
                                                    inputmode="numeric" oninput="imsi(this);">
                                                <span>%</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                            <label class="input_label">
                                                지원금액<span class="gray_basic">(인테리어 등)</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="text" name="support_price" placeholder="지원금액"
                                                    class="w_input_150" inputmode="numeric"
                                                    value="{{ $product->price->support_price != '' ? number_format($product->price->support_price) : '' }}"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);">
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
                                                <input type="text" name="etc_price" placeholder="기타비용"
                                                    class="w_input_150" inputmode="numeric"
                                                    value="{{ $product->price->etc_price != '' ? number_format($product->price->etc_price) : '' }}"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);">
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
                                                <input type="text" name="loan_rate_one" placeholder="예) 80"
                                                    class="w_input_150" inputmode="numeric"
                                                    value="{{ $product->price->loan_rate_one }}"
                                                    oninput="validateInput(this, 100); onlyNumbers(this)">
                                                <span>%</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                            <label class="input_label">
                                                대출 가능률2 <span class="txt_point">*</span>
                                            </label>
                                            <div class="flex_1 mt10">
                                                <input type="number" name="loan_rate_two" placeholder="예) 80"
                                                    class="w_input_150" inputmode="numeric"
                                                    value="{{ $product->price->loan_rate_two }}"
                                                    oninput="validateInput(this, 100); onlyNumbers(this)">
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
                                                <input type="text" name="loan_interest"
                                                    placeholder="소수점 두자리까지만 입력" class="w_input_150"
                                                    value="{{ $product->price->loan_interest }}" oninput="imsi(this)"
                                                    inputmode="numeric">
                                                <span>%</span>
                                            </div>
                                        </div>
                                        <div class="reg_item">
                                        </div>
                                    </div>

                                    <div class="reg_mid_wrap">
                                        <div class="reg_item">
                                            <label class="input_label">
                                                실입주/투자여부
                                            </label>
                                            <div class="btn_radioType">
                                                <input type="radio" name="is_invest" id="is_invest_2"
                                                    value="1"
                                                    {{ $product->price->is_invest == 1 ? 'checked' : '' }}>
                                                <label for="is_invest_2" onclick="showDiv('invest', 1)">투자</label>
                                                <input type="radio" name="is_invest" id="is_invest_1"
                                                    value="0"
                                                    {{ $product->price->is_invest == 0 ? 'checked' : '' }}>
                                                <label for="is_invest_1" onclick="showDiv('invest', 0)">실입주</label>
                                            </div>

                                            <div class="reg_item">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="invest_wrap mt8">
                                        <div
                                            class="invest_item open_key {{ $product->price->is_invest == 0 ? '' : 'active' }}">
                                        </div>
                                        <div
                                            class="invest_item open_key {{ $product->price->is_invest == 1 ? 'active' : '' }}">
                                            <div class="reg_item">
                                                <div class="input_pyeong_area">
                                                    <div>
                                                        <label class="input_label">
                                                            보증금
                                                        </label><input type="text" name="invest_price"
                                                            placeholder="보증금" inputmode="numeric"
                                                            value="{{ $product->price->invest_price != '' ? number_format($product->price->invest_price) : '' }}"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                        <span class="gray_deep">/</span>
                                                    </div>
                                                    <div>
                                                        <label class="input_label">
                                                            월임대료
                                                        </label><input type="text" name="invest_month_price"
                                                            placeholder="월임대료" inputmode="numeric"
                                                            value="{{ $product->price->invest_month_price != '' ? number_format($product->price->invest_month_price) : '' }}"
                                                            oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                        <span class="gray_deep">원</span>
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
                                                <input type="text" name="price_3" placeholder="전세보증금"
                                                    class="w_input_150" inputmode="numeric"
                                                    value="{{ $product->price->price != '' ? number_format($product->price->price) : '' }}"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);">
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
                                                </label><input type="text" placeholder="보증금" name="price_4"
                                                    inputmode="numeric"
                                                    value="{{ $product->price->price != '' ? number_format($product->price->price) : '' }}"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                <span class="gray_deep">/</span>
                                            </div>
                                            <div>
                                                <label class="input_label">
                                                    월임대료 <span class="txt_point">*</span>
                                                </label><input type="text" placeholder="월임대료" name="month_price_4"
                                                    inputmode="numeric"
                                                    value="{{ $product->price->month_price != '' ? number_format($product->price->month_price) : '' }}"
                                                    oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                                <span class="gray_deep">원</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box_01 box_reg">
                        <h4>건물 기본정보 <span class="txt_point">*</span></h4>
                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">전용면적 <span>*</span></label>
                                <div class="input_pyeong_area">
                                    <div><input type="text" name="exclusive_area" id="exclusive_area"
                                            placeholder="전용면적" nputmode="numeric"
                                            value="{{ $product->exclusive_area }}"
                                            oninput="onlyNumbers(this); area_change('exclusive_');">
                                        <span class="gray_deep">평</span>
                                    </div>
                                    <span class="gray_deep">/</span>
                                    <div><input type="text" name="exclusive_square" id="exclusive_square"
                                            placeholder="평 입력시 자동" nputmode="numeric"
                                            value="{{ $product->exclusive_square }}"
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
                                                value="{{ $product->floor_number }}" placeholder="해당층">
                                            <span class="gray_deep">층</span>
                                        </div>
                                        <span class="gray_deep">/</span>
                                        <div><input type="text" name="total_floor_number" id="total_floor_number"
                                                value="{{ $product->total_floor_number }}" placeholder="전체층">
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
                                        {{ $product->is_service == 1 ? 'disabled' : '' }}
                                        value="{{ $product->service_price != '' ? number_format($product->service_price) : '' }}"
                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                    <span class="gray_deep">원</span>
                                    <input type="checkbox" name="is_service" id="is_service_1" value="1"
                                        {{ $product->is_service == 1 ? 'checked' : '' }}>
                                    <label for="is_service_1" class="gray_deep"><span></span> 관리비 없음</label>
                                </div>
                            </div>
                        </div>

                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <label class="input_label">입주가능일 <span class="txt_point">*</span></label>
                                <div class="btn_radioType">
                                    <input type="radio" name="move_type" id="move_type_1" value="0"
                                        {{ $product->move_type == 0 ? 'checked' : '' }}>
                                    <label for="move_type_1" onclick="showDiv('move_type', 0)">즉시 입주</label>

                                    <input type="radio" name="move_type" id="move_type_2" value="1"
                                        {{ $product->move_type == 1 ? 'checked' : '' }}>
                                    <label for="move_type_2" onclick="showDiv('move_type', 0)">날짜 협의</label>

                                    <input type="radio" name="move_type" id="move_type_3" value="2"
                                        {{ $product->move_type == 2 ? 'checked' : '' }}>
                                    <label for="move_type_3" onclick="showDiv('move_type', 1)">직접 입력</label>
                                </div>
                                <div class="move_type_wrap mt8">
                                    <div
                                        class="move_type_item open_key {{ $product->move_type != 2 ? 'active' : '' }}">
                                    </div>
                                    <div
                                        class="move_type_item open_key {{ $product->move_type == 2 ? 'active' : '' }}">
                                        <input type="text" id="move_date_0" name="move_date_0"
                                            placeholder="예) 20230101" inputmode="numeric"
                                            value="{{ $product->move_date != '' ? $carbon::parse($product->move_date)->format('Y.m.d') : '' }}"
                                            oninput="onlyNumbers(this); onDateChangeEvent('move_date', 0);">
                                    </div>
                                </div>
                            </div>
                            <div class="reg_item">
                                <label class="input_label">주차 가능 대수 <span class="txt_point">*</span></label>
                                <div class="flex_1 mt10">
                                    <input type="text" name="parking_count" placeholder="예) 10"
                                        class="w_input_150" inputmode="numeric"
                                        value="{{ $product->parking_count }}"
                                        oninput="onlyNumbers(this); onTextChangeEvent(this);">
                                    <span>대</span>
                                </div>
                            </div>
                        </div>
                        <div class="reg_mid_wrap">
                            <div class="reg_item">
                                <input type="hidden" name="cooling_type" id="cooling_type"
                                    value="{{ $product->cooling_type }}">
                                <label class="input_label">냉방 종류</label>
                                <div class="dropdown_box">
                                    <button type="button"
                                        class="dropdown_label">{{ $product->cooling_type != '' ? Lang::get('commons.cooling_type.' . $product->cooling_type) : '냉방 종류 선택' }}</button>
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
                                <input type="hidden" name="heating_type" id="heating_type"
                                    value="{{ $product->heating_type }}">
                                <label class="input_label">난방 종류</label>
                                <div class="dropdown_box">
                                    <button type="button"
                                        class="dropdown_label">{{ $product->heating_type != '' ? Lang::get('commons.heating_type.' . $product->heating_type) : '난방 종류 선택' }}</button>
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
                                    @php
                                        $optionArray = [];
                                        foreach ($product->facility as $key => $option) {
                                            array_push($optionArray, $option->type);
                                        }
                                    @endphp
                                    @foreach (Lang::get('commons.corp_product_option_type') as $index => $optionType)
                                        <input type="checkbox" name="option[]" id="option_{{ $index }}"
                                            value="{{ $index }}"
                                            {{ in_array($index, $optionArray) ? 'checked' : '' }}>
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
                                required="required" :images="[$product->main_images]" />
                        </div>

                        <div class="offer_textarea_wrap" style="margin-bottom:-35px;">
                            <label class="input_label">건물 내부 사진 <span class="gray_basic">(최대 4장)</span> <span
                                    class="txt_point">*</span></label>
                        </div>

                        <div class="img_add_wrap reg_step_type draggable-zone product_detail_img_add_wrap">
                            <x-pc-proposal-image-picker :title="'건물 내부 사진(최대 4장)'" id="product_detail" cnt="4"
                                required="required" :images="$product->detail_images" />
                        </div>

                        <div class="offer_textarea_wrap">
                            <label class="input_label">상세 설명 <span class="txt_point">*</span></label>
                            <textarea name="product_content" id="product_content" placeholder="건물의 특징이나 장점을 설명해주세요.">{{ $product->product_content }}</textarea>
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

                    </div>

                    <div class="step_btn_wrap">
                        <span></span>
                        <!-- <button class="btn_full_basic btn_point" disabled>다음</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point confirm" type="button" id="nextPageButton" disabled
                            onclick="onFormSubmit();">저장</button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <x-user-temporary-address />

</x-layout>
<style>
    .zoomIcon {
        padding: 0px !important;
    }
</style>

<script>
    $(document).ready(function() {
        confirm_check();

        // 지도 사이즈 별로 나오게
        // 모바일 / PC 각 div 에 mapOnlyMobile / mapOnlyPc 클래스 명 추가해주세요!
        if (document.body.offsetWidth > 767) {
            var mobileDiv = document.querySelector(".mapOnlyMobile").children[0];
            var pcDiv = document.querySelector(".mapOnlyPc");
            pcDiv.appendChild(mobileDiv);
        }

        var type = sessionStorage.getItem("typeSession");

        $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/common.css"]').remove();
        $('link[href="https://business.juso.go.kr/juso_support_center/css/addrlink/map/addrlinkMap.css"]')
            .remove();

        var address_lng = $('input[name=address_lng]').val();
        var address_lat = $('input[name=address_lat]').val();

        if (address_lng != '' && address_lat != '') {
            var wgs84Coords = get_coordinate_conversion1(address_lng, address_lat)
            setTimeout(function() {
                callJusoroMapApiType1(wgs84Coords[0], wgs84Coords[1]);
            }, 2000);
        } else {
            setTimeout(function() {}, 2000);
        }
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


    function onFormSubmit() {
        $('#updateForm').submit();
    }

    //입력란 열고 닫기
    function paymentCheck(index) {
        $('#payment_type').val(index);
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

    $('#is_address_detail').click(function() {
        if ($(this).is(':checked')) {
            $('#address_detail').val('');
            $('#address_detail').attr('disabled', true);
        } else {
            $('#address_detail').attr('disabled', false);
        }
    });
</script>


<script language="javascript">
    // opener관련 오류가 발생하는 경우 아래 주석을 해지하고, 사용자의 도메인정보를 입력합니다. ("팝업API 호출 소스"도 동일하게 적용시켜야 합니다.)
    // document.domain = "{{ env('APP_URL') }}";

    function getAddress() {
        //IE에서 opener관련 오류가 발생하는 경우, window에 이름을 명시해줍니다.
        window.name = "jusoPopup";

        //주소검색을 수행할 팝업 페이지를 호출합니다.
        //호출된 페이지(jusoPopup.jsp)에서 실제 주소검색URL(https://business.juso.go.kr/addrlink/addrLinkUrlJsonp.do)를 호출하게 됩니다.
        var pop = window.open("{{ route('api.popupOpen.getAddress') }}", "pop",
            "width=450,height=420, scrollbars=yes, resizable=yes");
    }




    function jusoCallBack(rtRoadFullAddr, rtAddrPart1, rtAddrDetail, rtAddrPart2, rtEngAddr, rtJibunAddr, rtZipNo,
        rtAdmCd, rtRnMgtSn, rtBdMgtSn, rtDetBdNmList, rtBdNm, rtBdKdcd, rtSiNm, rtSggNm, rtEmdNm, rtLiNm, rtRn,
        rtUdrtYn, rtBuldMnnm, rtBuldSlno, rtMtYn, rtLnbrMnnm, rtLnbrSlno, rtEmdNo, relJibun, rtentX, rtentY) {

        $('#roadName').html('<span>도로명</span>' + rtAddrPart1);
        $('#jibunName').html('<span>지번</span>' + rtJibunAddr);

        $('#address').val(rtAddrPart1);
        $('#old_address').val(rtJibunAddr);

        if (!$("#address_detail").prop('disabled')) {
            $('#address_detail').val(rtAddrDetail);
        }

        $('#region_code').val(rtAdmCd);
        $('#region_address').val(rtSiNm + ' ' + rtSggNm + ' ' + rtEmdNm + ' ' + rtLiNm);

        var wgs84Coords = get_coordinate_conversion(rtentX, rtentY)

        $('input[name=address_lng]').val(wgs84Coords[0]);
        $('input[name=address_lat]').val(wgs84Coords[1]);

        callJusoroMapApiType1(rtentX, rtentY);

        confirm_check();
    }

    // type1.좌표정보(GRS80, EPSG:5179)
    function callJusoroMapApiType1(rtentX, rtentY) {
        window.postMessage({
            functionName: 'callJusoroMapApi',
            params: [rtentX, rtentY]
        }, '*');
    }

    function confirm_check() {

        var type = $('input[name="input_type"]:checked').val();
        var address = $('#address').val();
        var address_detail = $('#address_detail').val();
        var is_address_detail = $('#is_address_detail').is(':checked');
        var product_name = $('#product_name').val();

        var payment_type = $('input[name="payment_type"]').val();
        var price = $('input[name="price_' + payment_type + '"]').val();
        var month_price = $('input[name="month_price_4"]').val();
        var acquisition_tax = $('input[name="acquisition_tax"]').val();
        var loan_rate_one = $('input[name="loan_rate_one"]').val();
        var loan_rate_two = $('input[name="loan_rate_two"]').val();
        var invest_price = $('input[name="invest_price"]').val();
        var invest_month_price = $('input[name="invest_month_price"]').val();
        var is_invest = $('input[name="is_invest"]:checked').val();

        var exclusive_area = $('input[name="exclusive_area"]').val();
        var exclusive_square = $('input[name="exclusive_square"]').val();
        var floor_number = $('input[name="floor_number"]').val();
        var total_floor_number = $('input[name="total_floor_number"]').val();
        var is_service = $('input[name="is_service"]').is(":checked");
        var service_price = $('input[name="service_price"]').val();
        var move_type = $('input[name="move_type"]:checked').val();
        var move_date = $('input[name="move_date"]').val().length;
        var parking_count = $('input[name="parking_count"]').val();
        // var imageCount0 = document.querySelectorAll('input[name="product_image_paths[]"]').length
        // var imageCount1 = document.querySelectorAll('input[name="product_detail_image_paths[]"]').length
        var imageCount0 = 1
        var imageCount1 = 2
        var product_content = $('#product_content').val();

        var confirm_1 = false;
        var confirm_2 = false;

        if (exclusive_area > 0 && exclusive_square > 0 && floor_number != '' && total_floor_number != '' && (
                is_service || is_service == false && service_price != '') && (move_type != 2 || (
                move_type == 2 && move_date == 8)) && parking_count != '' && imageCount0 > 0 && imageCount1 > 0 &&
            product_content != '') {
            confirm_1 = true;
        }

        if (payment_type == 0) {
            if (price != '' && acquisition_tax != '' && loan_rate_one != '' && loan_rate_two != '') {
                confirm_2 = true;
            }
        } else if (payment_type == 3) {
            if (price != '') {
                confirm_2 = true;
            }
        } else if (payment_type == 4) {
            if (price != '' && month_price != '') {
                confirm_2 = true;
            }
        } else {
            confirm_2 = false;
        }

        if (type != '' && address != '' && product_name != '' && confirm_1 && confirm_2 && (is_address_detail || (!
                is_address_detail && address_detail != ''))) {
            return $('.confirm').attr("disabled", false);
        } else {
            return $('.confirm').attr("disabled", true);
        }
    }

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
    }

    function selectType(name, index) {
        $('input[name="' + name + '"]').val(index);
    }
</script>
