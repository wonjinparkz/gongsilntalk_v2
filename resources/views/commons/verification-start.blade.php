    <script src="https://cdn.iamport.kr/v1/iamport.js"></script>

    <script>
        IMP.init("{{ env('IMP_CODE') }}");
        IMP.certification({ // param
            // 주문 번호
            // pg: 'PG사코드.{CPID}', //본인인증 설정이 2개이상 되어 있는 경우 필
            merchant_uid: "MIIiasTest",
            m_redirect_url: "{{ route('commons.verification.result') }}",
            popup: true
        }, function(rsp) { // callback
            if (rsp.success) { // 인증 성공

                jQuery.ajax({
                        url: "{{ route('commons.verification.result') }}",
                        method: "get",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        data: {
                            imp_uid: rsp.imp_uid,
                            success: rsp.success
                        }
                    }).done(function(data) {
                        $("#verificat").html(data);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert('다시 시도해주세요.');
                    });

            } else { // 인증 실패

            }
        });
    </script>
