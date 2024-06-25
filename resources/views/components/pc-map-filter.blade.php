<!-- filter 매물 종류 : s -->
<div class="filter_btn_wrap">
    <button type="button" class="filter_btn_trigger" id="filter_text_sale_product_type">지식산업센터</button>
    <div class="filter_panel panel_item_1">
        <div class="filter_panel_body">
            <h6 id="sale_product_type_title">매물 종류</h6>
            <div class="btn_radioType">
                <input type="radio" name="sale_product_type" id="sale_product_type_0" value="0" checked>
                <label for="sale_product_type_0">지식산업센터</label>
                <input type="radio" name="sale_product_type" id="sale_product_type_1" value="1">
                <label for="sale_product_type_1">상가</label>
                <input type="radio" name="sale_product_type" id="sale_product_type_2" value="2">
                <label for="sale_product_type_2">건물</label>
                <input type="radio" name="sale_product_type" id="sale_product_type_3" value="3">
                <label for="sale_product_type_3">아파트</label>
                <input type="hidden" id="sale_product_type" value="0">
            </div>
        </div>
        <div class="filter_panel_bottom">
            <button type="button" class="btn_graylight_ghost btn_md_full"
                onclick="filter_reset('sale_product_type')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full"
                onclick="filter_apply('sale_product_type', 0)">적용하기</button>
        </div>
    </div>
</div>
<!-- filter 매물 종류 : e -->

<!-- filter 준공연차 : s -->
<div class="filter_btn_wrap">
    <button type="button" class="filter_btn_trigger" id="filter_text_useDate">준공연차</button>
    <div class="filter_panel panel_item_3">
        <div class="filter_panel_body">
            <h6 id="useDate_title">준공연차</h6>
            <div class="btn_radioType">
                <input type="radio" name="useDate" id="useDate_1" value="0" checked>
                <label for="useDate_1">전체</label>
                <input type="radio" name="useDate" id="useDate_2" value="1">
                <label for="useDate_2">1년 이내</label>
                <input type="radio" name="useDate" id="useDate_3" value="2">
                <label for="useDate_3">2년 이내</label>
                <input type="radio" name="useDate" id="useDate_4" value="3">
                <label for="useDate_4">5년 이내</label>
                <input type="radio" name="useDate" id="useDate_5" value="4">
                <label for="useDate_5">10년 이내</label>
                <input type="radio" name="useDate" id="useDate_6" value="5">
                <label for="useDate_6">15년 이내</label>
                <input type="radio" name="useDate" id="useDate_7" value="6">
                <label for="useDate_7">15년 이상</label>
                <input type="hidden" id="useDate" value="">
            </div>
        </div>
        <div class="filter_panel_bottom">
            <button type="button" class="btn_graylight_ghost btn_md_full" onclick="filter_reset('useDate')"><img
                    src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
            <button type="button" class="btn_point btn_md_full" onclick="filter_apply('useDate', 0)">적용하기</button>
        </div>
    </div>
</div>
<!-- filter 준공연차 : e -->
