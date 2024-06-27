 <!-- 지식산업센터 modal : s -->
 <div class="modal_slide modal_slide_filter_1">
     <div class="slide_title_wrap">
         <span id="sale_product_type_title">매물 종류</span>
         <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('filter_1')">
     </div>
     <div class="slide_modal_body">
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
             onclick="modal_close_slide('filter_1'); filter_reset('sale_product_type')"><img
                 src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
         <button type="button" class="btn_point btn_md_full"
             onclick="modal_close_slide('filter_1'); filter_apply('sale_product_type', 0)">적용하기</button>
     </div>
 </div>
 <div class="md_slide_overlay md_slide_overlay_filter_1" onclick="modal_close_slide('filter_1')"></div>
 <!-- 지식산업센터 modal : e -->


 <!-- 준공연차 modal : s -->
 <div class="modal_slide modal_slide_filter_2">
     <div class="slide_title_wrap">
         <span id="useDate_title">준공연차</span>
         <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('filter_2')">
     </div>
     <div class="slide_modal_body">
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
         <button type="button" class="btn_graylight_ghost btn_md_full"
             onclick="modal_close_slide('filter_2'); filter_reset('useDate')"><img
                 src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
         <button type="button" class="btn_point btn_md_full"
             onclick="modal_close_slide('filter_2'); filter_apply('useDate', 0)">적용하기</button>
     </div>
 </div>
 <div class="md_slide_overlay md_slide_overlay_filter_2" onclick="modal_close_slide('filter_2')"></div>
 <!-- 준공연차 modal : e -->
