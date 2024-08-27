<x-layout>


    <form id="create" method="post" action="{{ route('www.consulting.create') }}">
        <!----------------------------- m::header bar : s ----------------------------->
        <div class="m_header">
            <div class="left_area"><a href="javascript:history.go(-1)"><img
                        src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
            <div class="m_title">상담문의</div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body cst_bg">
            <div class="cst_top">
                <h1>상담문의</h1>
                <div class="sub_txt">무료상담, 방문상담<br>부동산 전속계약 및 제휴 문의</div>
            </div>

            <div class="inner_wrap">
                <div class="col-md-6 box_member cst_wrap">
                    <ul class="reg_bascic">
                        <li>
                            <label>이름 <span class="txt_point">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />
                        </li>
                        <li>
                            <label>휴대전화 번호 <span class="txt_point">*</span></label>
                            <input type="number" name="phone" id="phone" value="{{ old('phone') }}"
                                placeholder="01012345678">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('phone')" />
                        </li>
                        <li>
                            <label>이메일 <span class="txt_point">*</span></label>
                            <input type="text" name="email" id="email" value="{{ old('email') }}"
                                placeholder="example@email.com">
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('email')" />
                        </li>
                        <li>
                            <label>상담 목적 <span class="txt_point">*</span></label>
                            <textarea name="content" id="content">{{ old('content') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                        </li>
                    </ul>

                    <div>
                        <div class="mt28">
                            <input type="checkbox" name="checkAll" id="checkAll">
                            <label for="checkAll"><span></span>모두 동의합니다.</label>
                        </div>
                        <ul class="terms_list">
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_2" value="Y">
                                <label for="checkOne_2"><span></span></label>
                                <a href="javascript:void(0)" onclick="modal_open('terms')">[필수] 공실앤톡 서비스 이용약관 동의</a>
                            </li>
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_3" value="Y">
                                <label for="checkOne_3"><span></span></label>
                                <a href="javascript:void(0)" onclick="modal_open('terms')">[필수] 개인정보 수집 및 이용동의</a>
                            </li>
                        </ul>
                        <div class="mt40">
                            <button type="button" class="btn_point btn_full_basic" id="create_btn"
                                onclick="$('#create').submit()" disabled>무료 상담
                                받기</button>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </form>

</x-layout>

<script>
    confirm_check();
    $('input, textarea').on('input change click', function() {
        confirm_check();
    });

    function confirm_check() {
        var name = $('#name').val();
        var phone = $('#phone').val();
        var email = $('#email').val();
        var content = $('#content').val();
        var terms = $('input[name="checkOne"]:checked').length

        if (name != '' && phone != '' && email != '' && content != '' && terms > 1) {
            $('#create_btn').attr('disabled', false);
        } else {
            $('#create_btn').attr('disabled', true);
        }
    }
</script>
