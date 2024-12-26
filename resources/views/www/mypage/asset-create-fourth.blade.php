<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">내 자산 관리</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        <form method="post" action="{{ route('www.mypage.service.create') }}">
            @php
                $data = $request->all();

                foreach ($data as $key => $value) {
                    echo '<input type="hidden" id="' . $key . '" name="' . $key . '" value="' . $value . '">';
                }
            @endphp
            <!-- my_body : s -->
            <div class="inner_mid_wrap m_inner_wrap mid_body">
                <h1 class="t_center only_pc">자산 등록하기 <span class="step_number"><span class="txt_point">4</span>/4</span>
                </h1>
                <div class="offer_step_wrap">

                    <div class="box_01 box_reg">
                        <h4>서류 등록</h4>
                        <span class="gray_basic">* 파일 용량 5M이하 권장, 초과시 업로드가 지연됩니다.</span>
                        <ul class="document_reg_list">
                            <x-service-create-image-picker :title="'매매계약서'" id="sale" cnt="1" />

                            <x-service-create-image-picker :title="'사업자등록증'" id="entre" cnt="1" />

                            <x-service-create-image-picker :title="'임대차계약서'" id="rental" cnt="1" />

                            <x-service-create-image-picker :title="'기타서류'" id="etc" cnt="1" />


                            {{-- <li>
                                <div class="document_area">
                                    <div class="document_img_reg">
                                        <img src="{{ asset('assets/media/download_sample_1.png') }}">
                                    </div>
                                    <div class="document_name_wrap">
                                        <p>매매계약서</p>
                                        <p class="document_name"><span>KakaoTalk_20230323_0907263812542</span>.png</p>
                                    </div>
                                </div>
                                <div class="gap_8">
                                    <button class="btn_graylight_ghost btn_sm" type="button">업로드</button>
                                    <button class="btn_graylight_ghost btn_sm">삭제</button>
                                </div>
                            </li>
                            <li>
                                <div class="document_area">
                                    <div class="document_img_reg"></div>
                                    <div>
                                        <p>사업자등록증</p>
                                        <p class="mt8 gray_basic fs_13">png 또는 jpg 업로드</p>
                                    </div>
                                </div>
                                <div class="gap_8">
                                    <button class="btn_graylight_ghost btn_sm">업로드</button>
                                    <button class="btn_graylight_ghost btn_sm">삭제</button>
                                </div>
                            </li>
                            <li>
                                <div class="document_area">
                                    <div class="document_img_reg"></div>
                                    <div>
                                        <p>임대차계약서</p>
                                        <p class="mt8 gray_basic fs_13">png 또는 jpg 업로드</p>
                                    </div>
                                </div>
                                <div class="gap_8">
                                    <button class="btn_graylight_ghost btn_sm">업로드</button>
                                    <button class="btn_graylight_ghost btn_sm">삭제</button>
                                </div>
                            </li>
                            <li>
                                <div class="document_area">
                                    <div class="document_img_reg"></div>
                                    <div>
                                        <p>기타 서류</p>
                                        <p class="mt8 gray_basic fs_13">png 또는 jpg 업로드</p>
                                    </div>
                                </div>
                                <div class="gap_8">
                                    <button class="btn_graylight_ghost btn_sm">업로드</button>
                                    <button class="btn_graylight_ghost btn_sm">삭제</button>
                                </div>
                            </li> --}}
                        </ul>


                    </div>


                    <div class="step_btn_wrap">
                        <button class="btn_full_basic btn_graylight_ghost" type="button"
                            onclick="javascript:history.back();">이전</button>
                        <!-- <button class="btn_full_basic btn_point" disabled>완료</button> 정보 입력하지 않았을때 disabled 처리 필요. -->
                        <button class="btn_full_basic btn_point"
                            onclick="location.href='{{ route('www.mypage.service.list.view') }}'">완료</button>
                    </div>

                </div>
            </div>
            <!-- my_body : e -->
        </form>
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
