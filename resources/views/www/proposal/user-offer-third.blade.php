<x-layout>


    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 제안서 받기 <span class="gray_basic"><span class="txt_point">3</span>/3</span></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->


    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">매물 제안서 받기 <span class="step_number"><span class="txt_point">3</span>/3</span>
            </h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>추가 요청사항이 있으신가요?</h4>

                    <!-- 상가 일 경우 -->
                    <div>상가 일 경우 희망 상가 층 개발시 삭제</div>
                    <div>
                        <label class="input_label">희망 상가 층</label>
                        <div class="btn_radioType">
                            <input type="radio" name="floor" id="floor_1" value="Y">
                            <label for="floor_1">상관없음</label>

                            <input type="radio" name="floor" id="floor_2" value="Y">
                            <label for="floor_2">1층</label>

                            <input type="radio" name="floor" id="floor_3" value="Y">
                            <label for="floor_3">2층 이상</label>
                        </div>
                    </div>

                    <div>
                        <label class="input_label">인테리어 유무</label>
                        <div class="btn_radioType">
                            <input type="radio" name="interior" id="interior_1" value="Y">
                            <label for="interior_1">선택 안함</label>

                            <input type="radio" name="interior" id="interior_2" value="Y">
                            <label for="interior_2">필요해요</label>

                            <input type="radio" name="interior" id="interior_3" value="Y">
                            <label for="interior_3">필요 없어요</label>
                        </div>
                    </div>

                    <div class="offer_textarea_wrap">
                        <label class="input_label">요청사항</label>
                        <textarea placeholder="요청사항이 있는 경우 입력해주세요."></textarea>
                    </div>
                </div>

                <div class="step_btn_wrap">
                    <button class="btn_full_basic btn_graylight_ghost"
                        onclick="location.href='offer_step_2.html'">이전</button>
                    <button class="btn_full_basic btn_point" onclick="location.href='{{route('www.mypage.proposal.list.view')}}'">제안서
                        받아보기</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->

    </div>


    <script>
        //기본 토글 이벤트
        $(".proposal_toggle_btn").click(function() {
            $(this).toggleClass("toggled");
            if ($(this).hasClass("toggled")) {
                $(this).css("transform", "rotate(180deg)");
            } else {
                $(this).css("transform", "rotate(0deg)");
            }

            $(".proposal_table_wrap").stop().slideToggle(300);
            return false;
        });
    </script>
</x-layout>
