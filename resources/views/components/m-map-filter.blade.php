 <!-- 지식산업센터 modal : s -->
 <div class="modal_slide modal_slide_filter_1">
     <div class="slide_title_wrap">
         <span>매물 종류</span>
         <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('filter_1')">
     </div>
     <div class="slide_modal_body">
         <div class="btn_radioType">
             <input type="radio" name="estate_type" id="estate_type_1" value="Y">
             <label for="estate_type_1">지식산업센터</label>
             <input type="radio" name="estate_type" id="estate_type_2" value="Y">
             <label for="estate_type_2">상가</label>
             <input type="radio" name="estate_type" id="estate_type_3" value="Y">
             <label for="estate_type_3">건물</label>
             <input type="radio" name="estate_type" id="estate_type_4" value="Y">
             <label for="estate_type_4">아파트</label>
         </div>
     </div>
     <div class="filter_panel_bottom">
         <button class="btn_graylight_ghost btn_md_full"><img
                 src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
         <button class="btn_point btn_md_full">적용하기</button>
     </div>
 </div>
 <div class="md_slide_overlay md_slide_overlay_filter_1" onclick="modal_close_slide('filter_1')"></div>
 <!-- 지식산업센터 modal : e -->


 <!-- 융자금 modal : s -->
 <div class="modal_slide modal_slide_filter_2">
     <div class="slide_title_wrap">
         <span>융자금</span>
         <img src="{{ asset('assets/media/btn_md_close.png') }}" onclick="modal_close_slide('filter_2')">
     </div>
     <div class="slide_modal_body">
         <div class="btn_radioType">
             <input type="radio" name="year" id="year_1" value="Y">
             <label for="year_1">전체</label>

             <input type="radio" name="year" id="year_2" value="Y">
             <label for="year_2">1년 이내</label>

             <input type="radio" name="year" id="year_3" value="Y">
             <label for="year_3">2년 이내</label>

             <input type="radio" name="year" id="year_4" value="Y">
             <label for="year_4">5년 이내</label>

             <input type="radio" name="year" id="year_5" value="Y">
             <label for="year_5">10년 이내</label>

             <input type="radio" name="year" id="year_6" value="Y">
             <label for="year_6">15년 이내</label>

             <input type="radio" name="year" id="year_7" value="Y">
             <label for="year_7">15년 이상</label>
         </div>
     </div>
     <div class="filter_panel_bottom">
         <button class="btn_graylight_ghost btn_md_full"><img
                 src="{{ asset('assets/media/ic_refresh.png') }}">초기화</button>
         <button class="btn_point btn_md_full">적용하기</button>
     </div>
 </div>
 <div class="md_slide_overlay md_slide_overlay_filter_2" onclick="modal_close_slide('filter_2')"></div>
 <!-- 융자금 modal : e -->
