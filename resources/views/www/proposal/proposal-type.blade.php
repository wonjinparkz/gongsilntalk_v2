<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">신규 건물 <span class="gray_basic"><span class="txt_point">2</span>/3</span></div>
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
                <div class="my_body">
                    <div class="inner_wrap m_inner_wrap">
                        <h1 class="t_center only_pc">제안서 미리보기</h1>
                    </div>

                    <div class="proposal_type_wrap">
                        <!-- tab : s -->
                        <div class="swiper proposal_type_tab">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide btn_radioType active">
                                    <input type="radio" name="proposal_type" id="proposal_type_1" value="Y"
                                        checked>
                                    <label for="proposal_type_1" onclick="showType(0)">스타일1</label>
                                </div>
                                <div class="swiper-slide btn_radioType">
                                    <input type="radio" name="proposal_type" id="proposal_type_2" value="Y">
                                    <label for="proposal_type_2" onclick="showType(1)">스타일2</label>
                                </div>
                                <div class="swiper-slide btn_radioType">
                                    <input type="radio" name="proposal_type" id="proposal_type_3" value="Y">
                                    <label for="proposal_type_3" onclick="showType(2)">스타일3</label>
                                </div>
                                <div class="swiper-slide btn_radioType">
                                    <input type="radio" name="proposal_type" id="proposal_type_4" value="Y">
                                    <label for="proposal_type_4" onclick="showType(3)">스타일4</label>
                                </div>
                                <div class="swiper-slide btn_radioType">
                                    <input type="radio" name="proposal_type" id="proposal_type_5" value="Y">
                                    <label for="proposal_type_5" onclick="showType(4)">스타일5</label>
                                </div>
                            </div>
                        </div>
                        <!-- tab : e -->

                        <div id="type_preview" class="type_view_wrap">
                            <!-- type_1 : s -->
                            <x-user-proposal-type-1 :corpInfo="$corpInfo" :address="$address" :products="$products"/>
                            <!-- type_1 : e -->

                            <!-- type_2 : s -->
                            <x-user-proposal-type-2 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_2 : e -->

                            <!-- type_3 : s -->
                            <x-user-proposal-type-3 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_3 : e -->

                            <!-- type_4 : s -->
                            <x-user-proposal-type-4 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_4 : e -->

                            <!-- type_5 : s -->
                            <x-user-proposal-type-5 :corpInfo="$corpInfo" :address="$address" :products="$products" />
                            <!-- type_5 : e -->
                        </div>

                    </div>


                </div>
                <!-- my_body : e -->

            </div>


        </div>
    </div>

    <script>
        //탭 보기
        function showType(index) {
            var type_preview = document.querySelectorAll('.type_view_wrap .proposal_type_item');
            type_preview.forEach(function(content) {
                content.classList.remove('active');
            });
            type_preview[index].classList.add('active');
        }

        //탭 스와이프
        var proposal_type_tab = new Swiper(".proposal_type_tab", {
            slidesPerView: 'auto',
            spaceBetween: 8,
            freeMode: true,
            breakpointsInverse: true,
            breakpoints: {
                1023: {
                    allowTouchMove: false
                }
            }
        });
    </script>

</x-layout>
