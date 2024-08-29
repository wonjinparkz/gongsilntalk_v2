@props(['usersAddressList' => 'false'])

<!-- modal (구)주소 검색 : s-->
<div class="modal fade" tabindex="-1" id="modal_address_search">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">(구) 주소 검색</h5>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2 modal_address_search_close"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1">X</span><span class="path2"></span></i>
                    <!--end::Close-->
                </div>
            </div>
            <div class="modal-body">
                <ul class="adress_select tab_toggle_menu">
                    <select name="region_code_1" id="region_code_1" class="form-select mb-6 region_code"
                        data-control="select2" data-hide-search="true">
                        <option value="">시/도</option>
                    </select>
                    <select name="region_code_2" id="region_code_2" class="form-select mb-6 region_code"
                        data-control="select2" data-hide-search="true">
                        <option value="">시/군/구</option>
                    </select>
                    <select name="region_code_3" id="region_code_3" class="form-select mb-6 region_code"
                        data-control="select2" data-hide-search="true">
                        <option value="">읍/면/동</option>
                    </select>
                    <select name="region_code_4" id="region_code_4" class="form-select mb-6 region_code"
                        data-control="select2" data-hide-search="true">
                        <option value="">리</option>
                    </select>

                    <div class="row mb-6">
                        <span class="fs-6">지번</span>
                        <div class="col-lg-4 fv-row">
                            <div class="input-group ">
                                <input type="text" name="ji" id="ji" class="form-control" />
                            </div>
                        </div>

                        <div class="col-lg-4 fv-row">
                            <div class="input-group">
                                <input type="text" name="bun" id="bun" class="form-control" />
                            </div>
                        </div>
                    </div>
                </ul>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">닫기</button>
                <button type="button" class="btn btn-primary" id="seach_address" onclick="seach_address()" disabled>
                    검색
                </button>
            </div>
        </div>
    </div>
</div>
<!-- modal (구)주소 검색 : e-->

<script>
    $(document).ready(function() {

        var type = $('#type').val();
        // 매물 타입이 분양권일 경우 활성화
        if (type > 13) {
            $('#is_unregistered').css('display', '');
        };

        // 지역구 가져오기
        get_region('*00000000', '1');

    });

    //(구)주소 클릭 이벤트
    document.getElementById("is_map").addEventListener("change", function() {
        var address_1 = document.querySelector(".detail_address_1");
        var search_1 = document.querySelector(".search_address_1");
        var search_2 = document.querySelector(".search_address_2");
        var is_map_0 = document.querySelector("#mapWrap");

        $('#address').val('');
        $('#roadName').empty();
        $('#jibunName').empty();
        $('#address_detail').val('');
        $('#address_dong').val('');
        $('#address_number').val('');

        if (this.checked) {
            search_1.style.display = "none";
            search_2.style.display = ""
        } else {
            search_1.style.display = "";
            search_2.style.display = "none";
        }
    });

    // 지역 가져오는 api
    function get_region(regcode, region) {
        var gatewayUrl =
            "https://grpc-proxy-server-mkvo6j4wsq-du.a.run.app/v1/regcodes?regcode_pattern=" + regcode +
            "&is_ignore_zero=true";

        $.ajax({
            url: gatewayUrl,
            method: "GET",
            dataType: "json",
            success: function(response) {
                // Check if 'regcodes' property exists and is an array
                if (response.regcodes && Array.isArray(response.regcodes)) {
                    var select = $("#region_code_" + region);
                    select.empty();

                    // Iterate over the 'regcodes' array
                    if (region == 1) {
                        select.append($("<option>").text('시/도').val(''));
                        response.regcodes.forEach(function(regcodeObj, index) {
                            // Assuming 'code' is the property you want to use for the option value
                            var regcode = regcodeObj.code;
                            // Assuming 'name' is the property you want to use for the option text
                            var name = regcodeObj.name;
                            select.append($("<option>").text(name).val(regcode.substring(0, 2)));
                        });
                    } else if (region != 1) {
                        if (region == 2) {
                            $('#region_code_2').append($("<option>").text('시/군/구').val(''));
                        } else if (region == 3) {
                            $('#region_code_3').append($("<option>").text('읍/면/동').val(''));
                        } else if (region == 4) {
                            $('#region_code_4').append($("<option>").text('리').val(''));
                        }
                        var options = [];
                        for (var i = 0; i < response.regcodes.length; i++) {
                            var regcodeObj = response.regcodes[i];
                            var regcode = regcodeObj.code;
                            var nameParts = regcodeObj.name.split(' ');
                            if (region == 2) {
                                regcode = regcode.substring(4, 5) > 0 ? regcode.substring(0, 5) : regcode
                                    .substring(0, 4)
                                var name = nameParts.length > 1 ? nameParts.slice(1).join(' ') : regcodeObj
                                    .name;
                            } else if (region == 3) {
                                regcode = regcode.substring(0, 8)
                                var name = nameParts.length > 2 ? nameParts.slice(2).join(' ') : regcodeObj
                                    .name;
                            } else if (region == 4) {
                                regcode = regcode
                                var name = nameParts.length > 3 ? nameParts.slice(3).join(' ') : regcodeObj
                                    .name;
                            }
                            options.push({
                                name: name,
                                value: regcode
                            });
                        }

                        // Sort options based on the 'name' property
                        options.sort(function(a, b) {
                            return a.name.localeCompare(b.name);
                        });

                        // Append sorted options to the select element
                        for (var i = 0; i < options.length; i++) {
                            select.append($("<option>").text(options[i].name).val(options[i].value));
                        }
                    }

                    $('#seach_address').attr("disabled", true);

                } else {
                    console.error("Invalid response format. 'regcodes' array not found.", region);
                    if (region == 4) {
                        $('#seach_address').attr("disabled", false);
                    }
                }
            },
            error: function(error) {
                console.error("Error fetching regcodes:", error);
            }
        });
    }


    function seach_address() {
        var sidoName = $('#sidoButton').text();
        var sigunguName = $('#sigunguButton').text();
        var dongName = $('#dongButton').text();
        var riName = $('#riButton').text() == '리 선택' ? '' : $('#riButton').text();
        var is_mount = $('#is_mount').is(":checked");
        var ji = $('#ji').val();
        var bun = $('#bun').val();

        var jiBun = (is_mount ? '산' + ji : ji) + (bun != '' ? '-' : '') + bun;

        var address = sidoName + ' ' + sigunguName + ' ' + dongName + (riName != '' ? ' ' : '') + riName;

        modal_close('address_search')

        $('#roadName').html('<span>지번</span>' + address + ' ' + jiBun);
        $('#address').val(address + ' ' + jiBun);
        $('#region_address').val(address);

        naverAdddress();
        confirm_check();

        @if ($usersAddressList)
            $('#old_address').val(address + ' ' + jiBun);
            usersAddressList(address + ' ' + jiBun, 1);
        @endif
    }

    function naverAdddress() {
        address = $('#address').val();
        $.ajax({
            url: '{{ route('api.get.search.address.info') }}', // 라라벨 라우팅 설정에 따라 변경하세요.
            method: 'POST',
            data: {
                address: address // 단일 주소를 서버에 전송합니다.
            },
            success: function(data, status, xhr) {

                let AddressList = data.AddressList;

                if (AddressList) {
                    if (AddressList.longitude != '' && AddressList.latitude != '') {
                        $('input[name=address_lng]').val(AddressList.longitude);
                        $('input[name=address_lat]').val(AddressList.latitude);

                        var wgs84Coords = get_coordinate_conversion1(AddressList.longitude, AddressList
                            .latitude)

                        callJusoroMapApiType1(wgs84Coords[0], wgs84Coords[1]);
                    }
                } else {
                    alert('검색된 주소가 없습니다.');
                }
            },
            error: function(xhr) {
                alert('검색된 주소가 없습니다.');
            }
        });
    }
    var initialTexts = ["시/도", "시/군/구", "읍/면/동", "리"];

    // 모든 라벨에 대한 클릭 이벤트 처리
    $('.region_code').on("change", function(event) {
        var clickedElement = event.target.id; // 클릭된 요소를 가져옴

        // 클릭된 요소가 라벨인 경우
        var index = clickedElement.split("_")[2]; // 인덱스 추출

        // 현재 클릭된 라벨의 인덱스
        var currentIndex = parseInt(index) + 1;

        // 상위 select가 변경될 때마다 현재 select보다 높은 인덱스를 가진 하위 select를 모두 초기화
        for (var i = currentIndex + 1; i <= 4; i++) {
            $('#region_code_' + i).empty(); // 하위 select를 초기화
            $('#region_code_' + i).append($("<option>").text(initialTexts[i - 1]).val('')); // 하위 select를 초기화
        }

        var region_code = '';
        // 주소 가져오기
        if (currentIndex < 5) {
            check_code = $('#' + clickedElement).val();
            if (currentIndex == 2) {
                region_code = check_code + '*00000'
            } else if (currentIndex == 3) {
                region_code = check_code + '*00'
            } else if (currentIndex == 4) {
                region_code = check_code + '*'
            }
            get_region(region_code, currentIndex);
        } else {
            $('#seach_address').attr("disabled", false);
        }

        $('#region_code').val(check_code);

    });
</script>

<script>
    // // 가임시주소 검색
    // function seach_address() {
    //     var sidoName = $('#region_code_1 option:selected').text();
    //     var sigunguName = $('#region_code_2 option:selected').text();
    //     var dongName = $('#region_code_3 option:selected').text();
    //     var riName = $('#region_code_4 option:selected').text();
    //     var region_code = '';
    //     var address = sidoName + ' ' + sigunguName + ' ' + dongName + ' ' + (riName == '리' ? '' : riName);

    //     if (riName == '리') {
    //         region_code = $('#region_code_3 option:selected').val();
    //     } else {
    //         region_code = $('#region_code_3 option:selected').val();
    //     }

    //     $('.modal_address_search_close').click();

    //     $('#address').val(address + ' 999-99');
    //     $('#region_code').val(region_code)
    //     $('#region_address').val(address)
    //     $('#address_detail').val('');
    //     $('#address_dong').val('');
    //     $('#address_number').val('');
    // }
</script>
