<html lang="kor">

<head>
    <title>{{ Lang::get('lang.app.name') }}</title>
    <link rel="shortcut icon" href="images/favicon.png">

    <!--메타 : 메타 태그만 사용-->
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">

<body>
    <div
        style="width:700px; padding:40px; border-radius: 30px; margin: 0 auto; line-height: 1.6; background:#f9f9f9 url('') no-repeat; background-size: 100% auto;">

        <div style="margin-top:40px; margin-bottom: 50px;">
            <img src="" style="width:150px;">
        </div>
        <div style="background: #fff; border-radius: 30px; padding: 30px; box-sizing: border-box;">
            <p style="font-size: 20px; font-weight: bold; color:#000">비밀번호를 잊으셨나요?
            </p>
            <br />
            <p style="font-size: 16px; color:#000">회원님, 안녕하세요!
            </p>
            <br />
            <strong style="color:#000;">
                회원님의 새 비밀번호 설정을 안내해드립니다.<br />
                아래 링크를 누르신 다음 새 비밀번호를 설정해주시기 바랍니다.<br />
            </strong>
            <br />
            감사합니다.
            <br />
            <br />
            <a href="{{ $reset_link }}" rel="noopener"
                style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#009ef7;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle"
                target="_blank">비밀번호 변경</a>

        </div>

        <div style="margin-top: 50px;">

            <p style="font-size: 12px; margin: 0; padding: 0; font-weight: bold;">{{ Lang::get('lang.footer.company') }}
            </p>
            <p style="font-size: 12px; margin: 0; padding: 0;">대표이사 : {{ Lang::get('lang.footer.ceo') }}<span
                    style="margin: 0 10px; font-size: 10px; color:#b4b4b4">|</span>주소 :
                {{ Lang::get('lang.footer.address') }}</p>
            <p style="font-size: 12px; margin: 0; padding: 0;">사업자등록번호 : {{ Lang::get('lang.footer.number') }}</p>
            <br/>
            본 메일은 발신전용 메일로, 회신되지 않습니다.
        </div>

    </div>
</body>

</html>
