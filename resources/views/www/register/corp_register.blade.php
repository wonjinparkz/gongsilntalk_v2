<x-layout>
    <div class="body">
        <div class="inner_wrap">
            <div class="col-md-6 box_member">
                <h2 class="only_pc">중개사무소 정보 입력</h2>
                <ul class="login_wrap reg_bascic">
                    <li>
                        <p class="txt_sub">‘중개사무소 조회하기’로 중개사무소를 검색하시면 관련 정보가 자동입력됩니다.</p>
                        <div class="mt10">
                            <button class="btn_black_ghost btn_full_basic" onclick="modal_open('realtor_search')">중개사무소
                                조회하기</button>
                        </div>
                        <div class="realtor_result">
                            <div>사업자 상호</div>
                            <div>사철인부동산 공인중개사사무소</div>
                            <div>대표자명</div>
                            <div>홍길동</div>
                            <div>중개등록번호</div>
                            <div>12345-2023-67890</div>
                        </div>
                    </li>
                    <li>
                        <label>사업자 등록 번호</label>
                        <input type="number" placeholder="123-45-67590">
                    </li>
                    <li>
                        <label>대표 번호</label>
                        <input type="number" placeholder="“-” 숫자만 입력해  주세요.">
                    </li>
                    <li>
                        <label>주소지</label>
                        <div class="flex_1">
                            <input type="text">
                            <button class="btn_point">검색</button>
                        </div>
                        <div class="mt8"><input type="text" placeholder="상세주소를 입력해 주세요."></div>
                    </li>
                    <li>
                        <label>개업일</label>
                        <input type="text" placeholder="2024.01.01">
                    </li>
                    <li>
                        <div class="file_reg_wrap">
                            <div class="file_item">
                                <label>사업자등록증</label>
                                <div class="file_area">
                                    <button class="btn_graylight_ghost btn_sm">업로드</button>
                                </div>
                            </div>

                            <div class="file_item">
                                <label>중개등록증</label>
                                <div class="file_area">
                                    <button class="btn_graylight_ghost btn_sm">업로드</button>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="mt40">
                    <button class="btn_point btn_full_basic" disabled>다음</button>
                    <button class="btn_point btn_full_basic"
                        onclick="location.href='{{ route('www.register.corp.register2') }}'">다음</button>
                </div>



            </div>
        </div>

    </div>

    <!-- modal 중개사무소 조회 : s-->
    <div class="modal modal_mid modal_realtor_search">
        <div class="modal_title">
            <h5>중개사무소 조회</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('realtor_search')">
        </div>
        <div class="modal_container">
            <div class="flex_1">
                <input type="text" placeholder="중개사무소명 또는 주소로 검색">
                <button class="btn_point">검색</button>
            </div>
            <div class="search_result_wrap">
                <div class="empty_wrap sm_type"><span>중개사무소 개설 등록 당시<br>신고한 내용을 기준으로 검색해주세요.</span></div>
                <div class="result_row">
                    <span>철인</span>부동산 공인중개사사무소
                    <p>홍길동, 서울특별시 금천구</p>
                </div>
                <div class="result_row">
                    <span>철인</span>부동산 공인중개사사무소
                    <p>홍길동, 서울특별시 금천구</p>
                </div>
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_realtor_search" onclick="modal_close('realtor_search')"></div>
    <!-- modal 중개사무소 조회 : e-->


</x-layout>
