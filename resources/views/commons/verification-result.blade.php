<script>
    var name = "{{ $result['name'] }}";
    var phone = "{{ $result['phone'] }}";
    var birth = "{{ $result['birth'] }}";
    var gender = "{{ $result['gender'] }}";
    var unique_key = "{{ $result['unique_key'] }}";
    var unique_in_site = "{{ $result['unique_in_site'] }}";

    $('#verification').val('Y');
    $('#name').val(name);
    $('#phone').val(phone);
    $('#gender').val(gender);
    $('#birth').val(birth);
    $('#unique_key').val(unique_key);

    // // 팝업 창에서 부모 페이지로 값을 전달
    // window.opener.document.getElementById('verification').value = 'Y';
    // window.opener.document.getElementById('name').value = name;
    // window.opener.document.getElementById('phone').value = phone;
    // window.opener.document.getElementByIds('gender').value = gender;
    // window.opener.document.getElementById('birth').value = birth;
    // window.opener.document.getElementById('unique_key').value = unique_key;

    // 팝업 닫기
    // window.close();
</script>
