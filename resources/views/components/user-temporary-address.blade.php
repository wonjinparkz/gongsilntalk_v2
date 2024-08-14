<!-- modal 가(임시)주소 검색 : s-->
<div class="modal modal_mid modal_address_search">
    <div class="modal_title">
        <h5>가(임시) 주소 검색</h5>
        <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
            onclick="modal_close('address_search')">
    </div>
    <div class="modal_container">
        <div class="tab_area_wrap1">
            <div class="mt20">
                <input type="hidden" name="sido" value="">
                <label class="input_label">시/도</label>
                <div class="dropdown_box">
                    <button type="button" class="dropdown_label" id="sidoButton">시/도 선택</button>
                    <ul class="optionList" id="region_code_1">
                        <li class="optionItem" onclick="selectRegion('sido','')">
                            시/도 선택
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt20">
                <input type="hidden" name="sigungu" value="">
                <label class="input_label">시/군/구</label>
                <div class="dropdown_box">
                    <button type="button" class="dropdown_label" id="sigunguButton">시/군/구 선택</button>
                    <ul class="optionList" id="region_code_2">
                        <li class="optionItem" onclick="selectRegion('sigungu','')">
                            시/군/구 선택
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt20">
                <input type="hidden" name="dong" value="">
                <label class="input_label">읍/면/동</label>
                <div class="dropdown_box">
                    <button type="button" class="dropdown_label" id="dongButton">읍/면/동 선택</button>
                    <ul class="optionList" id="region_code_3">
                        <li class="optionItem" onclick="selectRegion('dong','')">
                            읍/면/동 선택
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt20">
                <input type="hidden" name="ri" value="">
                <label class="input_label">리</label>
                <div class="dropdown_box">
                    <button type="button" class="dropdown_label" id="riButton">리 선택</button>
                    <ul class="optionList" id="region_code_4">
                        <li class="optionItem" onclick="selectRegion('ri','')">
                            리 선택
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mt20">
                <label class="input_label">지번</label>
                <div class="flex_2">
                    <div class="flex_1">
                        <input type="text" name="ji" id="ji">
                        <span>-</span>
                    </div>
                    <div class="flex_1">
                        <input type="text" name="bun" id="bun">
                    </div>
                </div>
            </div>
        </div>
        <div>
            <button class="btn_full_basic btn_point mt20" id="seach_address" onclick="seach_address()"
                disabled>검색</button>
        </div>
    </div>
</div>
<div class="md_overlay md_overlay_address_search" onclick="modal_close('address_search')"></div>
<!-- modal 가(임시)주소 검색 : e-->

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

    //가(임시)주소 클릭 이벤트
    document.getElementById("is_map").addEventListener("change", function() {
        var address_1 = document.querySelector(".detail_address_1");
        var search_1 = document.querySelector(".search_address_1");
        var search_2 = document.querySelector(".search_address_2");
        var is_map_0 = document.querySelector("#mapWrap");
        var is_map_1 = document.querySelector(".is_map_1");

        $('#address').val('');
        $('#roadName').empty();
        $('#jibunName').empty();
        $('#address_detail').val('');
        $('#address_dong').val('');
        $('#address_number').val('');

        if (this.checked) {
            search_1.style.display = "none";
            search_2.classList.add("active");
        } else {
            search_1.style.display = "block";
            search_2.classList.remove("active");
        }
    });

    // 지역 가져오는 api
    function get_region(regcode, region) {
        console.log('지역 가져오기');
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
                    var ul = $("#region_code_" + region);
                    ul.empty();

                    // Iterate over the 'regcodes' array
                    if (region == 1) {
                        response.regcodes.forEach(function(regcodeObj, index) {
                            // Assuming 'code' is the property you want to use for the option value
                            var regcode = regcodeObj.code;
                            // Assuming 'name' is the property you want to use for the option text
                            var name = regcodeObj.name;
                            ul.append(
                                `<li class="optionItem"  onclick="selectRegion('sido','` +
                                regcode.substring(0, 2) + `')" value="` + regcode.substring(0,
                                    2) + `">` + name + `</li>`);
                        });
                    } else if (region != 1) {
                        var options = [];
                        for (var i = 0; i < response.regcodes.length; i++) {
                            var regcodeObj = response.regcodes[i];
                            var regcode = regcodeObj.code;
                            console.log('regionObj', regcodeObj);
                            var nameParts = regcodeObj.name.split(' ');
                            if (region == 2) {
                                regcode = regcode.substring(4, 5) > 0 ? regcode.substring(0, 5) :
                                    regcode
                                    .substring(0, 4)
                                var name = nameParts.length > 1 ? nameParts.slice(1).join(' ') :
                                    regcodeObj
                                    .name;
                            } else if (region == 3) {
                                regcode = regcode.substring(0, 8)
                                var name = nameParts.length > 2 ? nameParts.slice(2).join(' ') :
                                    regcodeObj
                                    .name;
                            } else if (region == 4) {
                                regcode = regcode
                                var name = nameParts.length > 3 ? nameParts.slice(3).join(' ') :
                                    regcodeObj
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
                            ul.append(
                                `<li class="optionItem" onclick="selectRegion('` + (region == 2 ?
                                    'sigungu' : region == 3 ? 'dong' : 'ri') + `','` + options[i]
                                .value + `')">` + options[i].name + `</li>`
                            );
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
        var ji = $('#ji').val();
        var bun = $('#bun').val();

        var jiBun = ji + (bun != '' ? '-' : '') + bun;

        var address = sidoName + ' ' + sigunguName + ' ' + dongName + ' ' + riName;

        $('#region_code').val();

        modal_close('address_search')

        $('#roadName').html('<span>지번</span>' + address + ' ' + jiBun);
        $('#address').val(address + ' ' + jiBun);
        $('#region_address').val(address);

        naverAdddress();
        confirm_check();
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
                console.log('응답 데이터:', data); // 응답 객체의 전체 구조를 확인

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
                console.log(xhr);
            }
        });
    }

    function selectRegion(name, index) {
        if (index > 0) {
            $('#' + name).val(index);

            console.log('name : ', name + ' index : ', index);

            var currentIndex = 0;
            var region_code = '';

            if (index.length == 2) {
                region_code = index + '*00000';
                currentIndex = 2;
            } else if (index.length > 2 && index.length < 8) {
                region_code = index + '*00';
                currentIndex = 3;
            } else if (index.length >= 8 && index.length < 10) {
                region_code = index + '*';
                currentIndex = 4;
            } else {
                currentIndex = 5;
            }

            // 시/도 이외의 상위 지역을 초기화
            resetUpperRegions(currentIndex);

            // 하위 지역 데이터를 불러오는 함수 호출
            if (currentIndex <= 4) {
                get_region(region_code, currentIndex);
            } else {
                $('#seach_address').attr("disabled", false);
            }

            $('#region_code').val(index);
            console.log('region : ', region_code + '\n index : ', index.length);
        }
    }

    function resetUpperRegions(currentIndex) {
        for (var i = currentIndex; i <= 4; i++) {
            var regionButtonId = getButtonIdByIndex(i);
            var inputName = getInputNameByIndex(i);

            // 버튼 텍스트 초기화
            var button = document.getElementById(regionButtonId);
            if (button) {
                button.textContent = getDefaultTextByIndex(i);
            }

            // 숨겨진 input 필드 초기화
            var inputField = document.querySelector('input[name="' + inputName + '"]');
            if (inputField) {
                inputField.value = '';
            }

            // 옵션 리스트 초기화
            var optionListId = "region_code_" + i;
            var optionList = document.getElementById(optionListId);
            if (optionList) {
                optionList.innerHTML = '<li class="optionItem" onclick="selectRegion(\'' + inputName + '\',\'\')">' +
                    getDefaultTextByIndex(i) + '</li>';
            }
        }
    }

    function getButtonIdByIndex(index) {
        switch (index) {
            case 2:
                return 'sigunguButton';
            case 3:
                return 'dongButton';
            case 4:
                return 'riButton';
            default:
                return '';
        }
    }

    function getInputNameByIndex(index) {
        switch (index) {
            case 2:
                return 'sigungu';
            case 3:
                return 'dong';
            case 4:
                return 'ri';
            default:
                return '';
        }
    }

    function getDefaultTextByIndex(index) {
        switch (index) {
            case 2:
                return '시/군/구 선택';
            case 3:
                return '읍/면/동 선택';
            case 4:
                return '리 선택';
            default:
                return '';
        }
    }
</script>
