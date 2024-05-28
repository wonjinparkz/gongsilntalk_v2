<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="images/header_btn_back.png"></a></div>
        <div class="m_title">매물 등록 <span class="gray_basic"><span class="txt_point">5</span>/5</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 등록하기 <span class="step_number"><span class="txt_point">5</span>/5</span></h1>

            <div class="offer_step_wrap">

                <div class="box_01 box_reg">
                    <div class="flex_between">
                        <h4>사진 및 상세 설명</h4>
                        <p class="gray_basic">최대 8장 업로드 가능 <span class="txt_point">7</span> / 8</p>
                    </div>
                    <div class="img_add_wrap reg_step_type">
                        <div class="cell">
                            <img src="images/btn_img_delete.png" class="btn_img_delete">
                            <div class="img_box"><img src="images/s_2.png"></div>
                        </div>
                        <div class="cell">
                            <img src="images/btn_img_delete.png" class="btn_img_delete">
                            <div class="img_box"><img src="images/s_2.png"></div>
                        </div>
                        <div class="cell">
                            <img src="images/btn_img_delete.png" class="btn_img_delete">
                            <div class="img_box"><img src="images/s_2.png"></div>
                        </div>
                        <div class="cell">
                            <img src="images/btn_img_delete.png" class="btn_img_delete">
                            <div class="img_box"><img src="images/s_2.png"></div>
                        </div>
                        <div class="cell">
                            <img src="images/btn_img_delete.png" class="btn_img_delete">
                            <div class="img_box"><img src="images/s_2.png"></div>
                        </div>
                        <div class="cell">
                            <img src="images/btn_img_delete.png" class="btn_img_delete">
                            <div class="img_box"><img src="images/s_2.png"></div>
                        </div>
                        <div class="cell">
                            <button>
                                <div class="img_box"><img src="images/btn_img_add.png"></div>
                            </button>
                        </div>
                    </div>

                    <div>
                        <div class="offer_textarea_wrap">
                            <label class="input_label">상세 설명 <span class="txt_point">*</span></label>
                            <input type="text" placeholder="매물 한줄요약. 예) 역에서 5분거리, 인프라 좋은 매물">
                            <textarea class="mt10" placeholder="매물에 대해 추가로 어필하고 싶은 내용을 자세히 작성해 주세요."></textarea>
                        </div>
                        <div class="reg_mid_wrap mt10">
                            <div class="reg_item">
                                <label class="input_label">중개보수(부가세별도) <span class="txt_point">*</span></label>
                                <input type="number" placeholder="중개보수를 입력해 주세요.">
                            </div>
                            <div class="reg_item">
                                <label class="input_label">상한요율 <span class="txt_point">*</span></label>
                                <input type="number" placeholder="상한요율을 % 단위로 입력해 주세요.">
                            </div>
                        </div>
                    </div>


                </div>

                <div class="step_btn_wrap">
                    <button class="btn_full_basic btn_graylight_ghost" onclick="location.href='estate_reg_2.html'">이전</button>
                    <!-- <button class="btn_full_basic btn_point" disabled>등록</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                    <button class="btn_full_basic btn_point" onclick="location.href='#'">등록</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->

    </div>

</x-layout>
