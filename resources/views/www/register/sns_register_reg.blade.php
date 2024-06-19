<x-layout>


    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">약관 동의</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->


    <div class="body">
        <div class="inner_wrap">
            <form class="form" method="POST" action="{{ route('www.register.create') }}">
                @csrf
                <input type="hidden" name="token" value="{{ Request::get('token') }}" />
                <input type="hidden" id="verification" name="verification" value='{{ old('verification') ?? 'N' }}'>
                <input type="hidden" id="is_marketing" name="is_marketing" value='{{ old('is_marketing') ?? '' }}'>
                <input type="hidden" name="provider" value="{{ request()->get('provider') }}" />

                <div class="col-md-6 box_member">
                    <h2 class="only_pc">약관 동의</h2>
                    <div>
                        <div class="mt28">
                            <input type="checkbox" name="checkAll" id="checkAll">
                            <label for="checkAll"><span></span>모두 동의합니다.</label>
                        </div>
                        <ul class="terms_list">
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
                                <label for="checkOne_1"><span></span></label>
                                [필수] 만 14세 이상입니다.
                            </li>
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_2" value="1">
                                <label for="checkOne_2"><span></span></label>
                                <a href="javascript:void(0)" onclick="modal_open('terms_0')">[필수] 공실앤톡 서비스 이용약관 동의</a>
                            </li>
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_3" value="1">
                                <label for="checkOne_3"><span></span></label>
                                <a href="javascript:void(0)" onclick="modal_open('terms_1')">[필수] 개인정보 수집 및 이용동의</a>
                            </li>
                            <li>
                                <input type="checkbox" name="checkOne" id="checkOne_4" value="1">
                                <label for="checkOne_4"><span></span></label>
                                <a href="javascript:void(0)" onclick="modal_open('terms_2')">[선택] 마케팅 정보 수신에 대한 동의</a>
                            </li>
                        </ul>
                        <div class="mt40">
                            <button id="button_disabled" class="btn_full_basic" disabled>가입 완료</button>
                            <button id="button_active" type="submit" class="btn_point btn_full_basic"
                                style="display:none">가입 완료</button>
                        </div>
                    </div>
                </div>
                </from>
        </div>

    </div>
</x-layout>
@foreach ($termsList as $terms)
    <!-- modal 약관 : s-->
    <div class="modal modal_mid modal_terms_{{ $terms->kind }}">
        <div class="modal_title">
            <h5>{{ $terms->title }}</h5>
            <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                onclick="modal_close('terms_{{ $terms->kind }}')">
        </div>
        <div class="modal_container">
            <div class="terms_wrap">
                {!! $terms->content !!}
            </div>
        </div>
    </div>
    <div class="md_overlay md_overlay_terms_{{ $terms->kind }}" onclick="modal_close('terms_{{ $terms->kind }}')">
    </div>
    <!-- modal 약관 : e-->
@endforeach

<script>
    $(document).ready(function() {
        $('input').change(function() {
            button_active();
        });
    });

    function button_active() {
        var checkOne_1 = $('#checkOne_1').is(':checked');
        var checkOne_2 = $('#checkOne_2').is(':checked');
        var checkOne_3 = $('#checkOne_3').is(':checked');
        var checkOne_4 = $('#checkOne_4').is(':checked');

        if (checkOne_4) {
            $('#is_marketing').val('1');
        } else {
            $('#is_marketing').val('0');
        }

        if (checkOne_1 !== false && checkOne_2 !== false && checkOne_3 !== false) {
            $('#button_active').css('display', '');
            $('#button_disabled').css('display', 'none');
        } else {
            $('#button_disabled').css('display', '');
            $('#button_active').css('display', 'none');
        }
    }
</script>
