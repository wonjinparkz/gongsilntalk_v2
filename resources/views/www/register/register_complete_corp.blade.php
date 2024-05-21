<x-layout>

        <div class="body">
            <div class="inner_wrap">
                <div class="col-md-6 box_member">
                    <div class="success_wrap">
                        <h2>회원가입이 완료되었습니다!</h2>
                        <p>
                            중개사회원은 가입 승인 이후 서비스 이용이 가능하며,<br>
                            <span class="txt_point">승인 이전에는 로그인이 불가능합니다.</span><br>
                            공실앤톡 관리자가 가입 승인시, 알림으로 알려드립니다.
                        </p>
                        <div class="mt8"><button class="btn_point btn_basic"
                                onclick="location.href='{{ route('www.main.main') }}'">메인으로</button></div>
                    </div>
                </div>
            </div>

        </div>

</x-layout>
