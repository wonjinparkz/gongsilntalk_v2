<x-layout>

    <div class="body">
        <div class="inner_wrap">
            <!-- default : s -->
            <div class="page_notice_wrap">
                <img src="{{ asset('assets/media/info_img_4.png') }}">
                <h1 class="mt40">회원 가입 완료!</h1>
                <p class="mt30 fs_20 fc_9">회원가입이 완료되었어요.</p>
                <p class="mt5 fs_20 fc_9">로그인 하여 서비스를 이용해 보세요.</p>
                <div class="mt50 w_350 center">
                    <a href="{{ route('www.login.login') }}" class="btn_point btn_full_basic ease">로그인 화면으로</a>
                </div>
            </div>
            <!-- default : e -->
        </div>

    </div>

</x-layout>
