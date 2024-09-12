<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">공간 컨설팅 신청하기</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    @csrf
    <div class="body">

        <!-- my_body : s -->
        <div class="inner_mid_wrap m_inner_wrap mid_body">
            <h1 class="t_center only_pc">공간 컨설팅 신청하기
                <!-- <span class="step_number"><span class="txt_point">1</span>/4</span> -->
            </h1>

            <div class="offer_step_wrap">
                <div class="box_01 box_reg">
                    <h4>1. 사무실 인테리어 상담 희망 내용을 선택해주세요. <span class="txt_point">*</span></h4>
                    <div class="tab_area_wrap1">
                        <div>
                            <div class="btn_checktype">
                                <input type="checkbox" name="type[]" id="type_0" value="0">
                                <label for="type_0">전체 인테리어</label>

                                <input type="checkbox" name="type[]" id="type_1" value="1">
                                <label for="type_1">부분 인테리어</label>

                                <input type="checkbox" name="type[]" id="type_2" value="2">
                                <label for="type_2">상담 후 결정</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box_01 box_reg">
                    <h4>2. 사무실 규모와 사용 인원을 말씀해주세요. <span class="txt_point">*</span></h4>
                    <p class="txt_point">여러 층인 경우, 각 층의 면적을 합쳐주세요.</p>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">공급 면적 기준 평</label>
                            <div class="flex_1 flex_between">
                                <input type="number" name="area" id="area" placeholder="ex) 330">
                                <span>평</span>
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">사용 인원</label>
                            <div class="flex_1 flex_between">
                                <input type="number" name="users_count" id="users_count" placeholder="ex) 30">
                                <span>명</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box_01 box_reg">
                    <h4>3. 서비스가 필요한 위치와 입주 예정일을 말씀해주세요.</h4>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">입주 예정 지역</label>
                            <div class="flex_1 flex_between">
                                <input type="text" name="place" id="place" placeholder="ex) 강남구 테헤란로">
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">입주 예정일</label>
                            <div class="flex_1 flex_between">
                                <input type="text" name="move_date" id="move_date" placeholder="ex) 24년 10월">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box_01 box_reg">
                    <h4>4. 제안 받으실 기업의 정보를 말씀 해주세요.</h4>

                    <div class="reg_mid_wrap">
                        <div class="reg_item">
                            <label class="input_label">회사명</label>
                            <div class="flex_1 flex_between">
                                <input type="text" name="company_name" id="company_name" placeholder="ex) 공톡디자인">
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">연락처</label>
                            <div class="flex_1 flex_between">
                                <input type="text" max="11" name="company_phone" id="company_phone"
                                    oninput="onlyNumbers(this)" placeholder="ex) 01012345678">
                            </div>
                        </div>
                        <div class="reg_item">
                            <label class="input_label">담당자 성함</label>
                            <div class="flex_1 flex_between">
                                <input type="text" name="user_name" id="user_name" placeholder="ex) 홍길동">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="step_btn_wrap">
                    <span></span>
                    <button type="button" disabled class="btn_full_basic btn_point confirm"
                        onclick="createButton();">인테리어 제안서
                        받기</button>
                </div>

            </div>
        </div>
        <!-- my_body : e -->
    </div>

    <script>
        function createButton() {
            var types = [];
            $('input[name="type[]"]:checked').each(function() {
                types.push($(this).val());
            });

            var area = $('#area').val();
            var users_count = $('#users_count').val();
            var place = $('#place').val();
            var move_date = $('#move_date').val();
            var company_name = $('#company_name').val();
            var company_phone = $('#company_phone').val();
            var user_name = $('#user_name').val();

            var formData = {
                'type': types,
                'area': area,
                'users_count': users_count,
                'place': place,
                'move_date': move_date,
                'company_name': company_name,
                'company_phone': company_phone,
                'user_name': user_name
            }

            $.ajax({
                url: '{{ route('www.interior.estimate.create') }}',
                type: 'post',
                data: formData,
                // 성공적으로 처리된 경우
                success: function(response) {
                    if (confirm(response.message + '\n팝업을 띄우시겠습니까?')) {
                        // 사용자가 확인을 클릭한 경우
                        window.open(response.redirect_url, 'popup', 'width=500,height=450');
                    }
                    // 3초 후 메인 페이지로 리다이렉트
                    setTimeout(function() {
                        window.location.href = '/';
                    }, 3000);
                },
                error: function(xhr) {
                    // 오류가 발생한 경우
                    alert('제안서를 제출하는 중 오류가 발생했습니다.');
                    // 오류 메시지 등을 처리
                }
            });
        }

        $('input[type="checkbox"]').on('click', function() {
            confirm_check();
        });
        $('input[type="number"]').on('keyup', function() {
            confirm_check();
        });
        $('input[type="text"]').on('keyup', function() {
            confirm_check();
        });

        function confirm_check() {
            var type = $('input[name="type[]"]:checked').length;
            var area = $('#area').val();
            var users_count = $('#users_count').val();
            var place = $('#place').val();
            var move_date = $('#move_date').val();
            var company_name = $('#company_name').val();
            var company_phone = $('#company_phone').val();
            var user_name = $('#user_name').val();

            if (type > 0 && area != '' && users_count != '' & place != '' && move_date != '' && company_name != '' &&
                company_phone != '' && user_name != '') {
                $('.confirm').attr('disabled', false);
            } else {
                $('.confirm').attr('disabled', true);
            }
        }
    </script>


</x-layout>
