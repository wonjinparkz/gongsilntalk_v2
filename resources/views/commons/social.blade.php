<x-guest-layout>
    <script>
        var provider = '{{ $provider }}';
        var token = '{{ $social->id }}';
        var email = '{{ $social->email }}';
        var nickname = '{{ $social->nickname }}';


        if (isMobile.any()) {
            if (isMobile.Android()) {
                window.rocateer.resultSocial(provider, token, email, nickname);
            } else if (isMobile.iOS()) {
                var data = new Object();
                data.provider = provider;
                data.token = token;
                data.email = email;
                data.nickname = nickname;
                webkit.messageHandlers.resultSocial.postMessage(data);
            }
        }
    </script>
</x-guest-layout>
