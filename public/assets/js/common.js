// 관심 토글버튼
function btn_wish(element) {
    if ($(element).hasClass("on")) {
        $(element).removeClass("on");
    } else {
        $(element).addClass("on");
    }
}


/* Select Dropdown */
function initializeDropdowns(context = document) {
    const labels = context.querySelectorAll('.dropdown_label');
    labels.forEach(function (lb) {
        // 기존 이벤트 리스너 제거
        lb.removeEventListener('click', handleLabelClick);
        // 새로운 이벤트 리스너 추가
        lb.addEventListener('click', handleLabelClick);
    });
}

function handleLabelClick(event) {
    const lb = event.target;
    if (!lb.classList.contains('disabled')) {
        let optionList = lb.nextElementSibling;
        if (optionList) {
            let optionItems = optionList.querySelectorAll('.optionItem');
            clickLabel(lb, optionItems);
        } else {
            console.log('옵션 리스트를 찾을 수 없음', lb);
        }
    }
}

const clickLabel = (lb, optionItems) => {
    console.log('옵션 선택', lb, optionItems);
    if (lb.parentNode.classList.contains('active')) {
        lb.parentNode.classList.remove('active');
        optionItems.forEach((opt) => {
            opt.removeEventListener('click', handleSelectWrapper(lb, opt));
        });
    } else {
        lb.parentNode.classList.add('active');
        optionItems.forEach((opt) => {
            opt.addEventListener('click', handleSelectWrapper(lb, opt));
        });
    }
}

const handleSelectWrapper = (lb, opt) => {
    return () => handleSelect(lb, opt);
}

const handleSelect = (label, item) => {
    label.innerHTML = item.textContent;
    label.parentNode.classList.remove('active');
}

// 초기 이벤트 리스너 설정

$(function () {
    //정렬
    $(".toggle_tab li").click(function () {
        $(this).siblings('li').removeClass("active");
        $(this).addClass("active");
    });


    //기본 토글
    $(".toggle_menu div").click(function () {
        $(this).siblings('div').removeClass("active");
        $(this).addClass("active");
    });

    // faq list
    $('.faq_list li p').click(function () {
        $(this).children('img').toggleClass('rotate');
        $(this).next('.answer_wrap').toggleClass('display');
    });

    // 탭메뉴 토글기능
    $(".tab_area_wrap > div").hide();
    $(".tab_area_wrap > div").first().show();
    $(".side_list_body > div").first().show(); //side 탭 중복 충돌로 추가함.
    $(".tab_toggle_menu li").click(function () {
        var list = $(this).index();
        $(this).siblings('li').removeClass("active");
        $(this).addClass("active");
        $(this).parents('.tab_toggle_menu').siblings('.tab_area_wrap').find('>div').hide();
        $(this).parents('.tab_toggle_menu').siblings('.tab_area_wrap').find('>div').eq(list).show();
    });



    // swiper 탭메뉴 토글기능
    // $(document).ready(function() {
    //   var swiper = new Swiper('.side_tab', {
    //   });

    //   $(".swiper_detail_wrap > div").hide();
    //   $(".swiper_detail_wrap > div").first().show();
    //   $(".swiper_menu_wrap div").click(function() {
    //     var index = $(this).index();
    //     $(this).siblings().removeClass("active");
    //     $(this).addClass("active");
    //     $(".swiper_detail_wrap > div").hide();
    //     $(".swiper_detail_wrap > div").eq(index).show();
    //   });
    // });


    //더보기 메뉴
    $(".btn_dot_menu").click(function () {
        $(".layer_menu").stop().slideToggle(0);
        return false;
    });

    //기본 토글 이벤트
    $(".simple_toggle_trigger").click(function () {
        $(this).toggleClass("toggled");
        if ($(this).hasClass("toggled")) {
            $(this).css("transform", "rotate(180deg)");
        } else {
            $(this).css("transform", "rotate(0deg)");
        }
        $(".simple_toggle_layer").stop().slideToggle(300);
        return false;
    });

    // 검색창 검색어 삭제 기능
    $(document).ready(function () {
        $("#search_input").on("propertychange change keyup paste input", function () {
            if ($(this).val().length === 0) {
                $('.btn_del').css('display', 'none');
            } else {
                $('.btn_del').css('display', 'inline-block');
            }
        });

        $('#search_input').click(function () {
            $('.search_open').css('display', 'inline-block');
            event.stopPropagation();
        });

        $(document).click(function (event) {
            if (!$(event.target).closest('#search_open_layer, #search_input').length) {
                $('#search_open_layer').css('display', 'none');
            }
        });

        $('#search_open_layer').click(function (event) {
            event.stopPropagation(); // 이벤트 전파 방지
        });


        $('.btn_del').click(function () {
            $('#search_input').val('');
            $('#search_input').focus();
            $('#search_input').trigger('keyup'); // keyup 이벤트 트리거
            $('.btn_del').css('display', 'none');
        });
    });



    // 단일
    const $edit = $("#edit");
    $edit.find('*').each(function () {
        $edit.find('iframe').parent().addClass('iframe_wrap');
    });

    initializeDropdowns();

    // 슬라이드업메뉴 초기화
    let slide_modal = $('.modal_slide');
    let slide_height;
    // window.onload로 인해 주소맵 api 오류 발생
    // window.onload = function () {
    //     for (let i = 0; i < slide_modal.length; i++) {
    //         slide_height = slide_modal.eq(i).outerHeight();
    //         slide_modal.eq(i).css('bottom', -slide_height);
    //     };
    // };
    slide_modal.each(function () {
        slide_height = $(this).outerHeight();
        $(this).css('bottom', -slide_height);
    });

});


// 여러번사용 editName에 class명 지정
function setEdit(editName) {
    $('#' + editName).find('*').each(function () {
        $('#' + editName).find('iframe').parent().addClass('iframe_wrap');
    });
}

//------------------------------------------------------------------------------------------



// 전체동의폼::수정
function checkall_func(checkAll, checkOne) {

    function allCheckFunc(obj) {
        $("." + checkOne).prop("checked", $(obj).prop("checked"));
    }

    /* 체크박스 체크시 전체선택 체크 여부 */
    function oneCheckFunc(obj) {
        var allObj = $("." + checkAll);
        var objName = $(obj).attr("name");

        if ($(obj).prop("checked")) {
            checkBoxLength = $("." + objName).length;
            checkedLength = $("." + objName + ":checked").length;

            if (checkBoxLength == checkedLength) {
                allObj.prop("checked", true);
            } else {
                allObj.prop("checked", false);
            }
        }
        else {
            allObj.prop("checked", false);
        }
    }

    $(function () {
        $("." + checkAll).click(function () {
            allCheckFunc(this);
        });
        $("." + checkOne).each(function () {
            $(this).click(function () {
                oneCheckFunc($(this));
            });
        });
    });
}

// 전체동의폼 ::민지 (단일)
function allCheckFunc(obj) {
    $("[name=checkOne]").prop("checked", $(obj).prop("checked"));
}

/* 체크박스 체크시 전체선택 체크 여부 */
function oneCheckFunc(obj) {
    var allObj = $("[name=checkAll]");
    var objName = $(obj).attr("name");

    if ($(obj).prop("checked")) {
        checkBoxLength = $("[name=" + objName + "]").length;
        checkedLength = $("[name=" + objName + "]:checked").length;

        if (checkBoxLength == checkedLength) {
            allObj.prop("checked", true);
        } else {
            allObj.prop("checked", false);
        }
    }
    else {
        allObj.prop("checked", false);
    }
}

$(function () {
    $("[name=checkAll]").click(function () {
        allCheckFunc(this);
    });
    $("[name=checkOne]").each(function () {
        $(this).click(function () {
            oneCheckFunc($(this));
        });
    });
});

//전체선택(함수는 lable에서 지정해야 합니다.)
function COM_check_box_all_fn(all_clase, select_class) {
    var all_check = $('.' + all_clase); //전체 동의 체크박스
    var checkbox_num = $('.filter_wrap').find('.' + select_class).length; //체크 항목 개수
    var checkbox = $('.filter_wrap').find('.' + select_class); //전체동의를 제외한 체크박스

    //전체 동의 체크 했을 때
    all_check.click(function () {
        if (all_check.prop("checked") == true) {
            checkbox.prop("checked", true);
        } else {
            checkbox.prop("checked", false);
        }
    });

    //전체동의 체크 해제 상태에서 모두 체크 되었을때, 전체동의 체크 상태에서 하나라도 해제 했을 때
    checkbox.click(function () {
        var checked_num = $("." + select_class + ":checked").length; //체크된 박스 개수
        if (checked_num == checkbox_num) { //모두 체크 되었을 때
            all_check.prop("checked", true);
        } else {
            all_check.prop("checked", false);
        }
    });
}
//------------------------------------------------------------------------------------------


//사이드 네비 토글
function sideNavToggle() {
    $(".nav, .nav_dim").toggleClass("open");
    if ($(".nav").hasClass("open")) {
        lockBody();
    } else {
        unlockBody();
    }
}



//------------------------------------------------------------------------------------------


//basic_modal-------------------------------------------------------------------------------------

function modal_open(element) {
    $(".md_overlay_" + element).css("visibility", "visible").animate({ opacity: 1 }, 100);
    $(".modal_" + element).css({ display: "block" });
    lockBody();
}

function modal_close(element) {
    $(".md_overlay_" + element).css("visibility", "hidden").animate({ opacity: 0 }, 100);
    $(".modal_" + element).css({ display: "none" });
    unlockBody();
}

//------------------------------------------------------------------------------------------

// slide_modal
function modal_open_slide(id, fn = undefined) {
    $('.md_slide_overlay_' + id).css("visibility", "visible").animate({ opacity: 1 }, 100);
    $(".modal_slide_" + id).css({ bottom: "0", transition: '0.4s' });
    $("#modal_" + id).css("display", "block");
    lockBody();
    if (fn !== undefined) {
        fn();
    }
}
function modal_close_slide(id, fn = undefined) {
    let slide_height = $('.modal_slide_' + id).outerHeight();
    $(".md_slide_overlay_" + id).css("visibility", "hidden").animate({ opacity: 0 }, 100);
    $(".modal_slide_" + id).css({ bottom: -slide_height });
    unlockBody();
    if (fn !== undefined) {
        fn();
    }
}

//모달 백그라운드 스크롤 막기
var scrollTop;

function lockBody() {
    if (window.pageYOffset) {
        scrollTop = window.pageYOffset;
        $(".wrap").css({
            top: - (scrollTop)
        });
    }

    $('html, body').css({
        // height: "100%",
        overflow: "hidden"
    });
}

function unlockBody() {
    $('html, body').css({
        height: "",
        overflow: ""
    });

    $(".wrap").css({
        top: ''
    });

    window.scrollTo(0, scrollTop);
    window.setTimeout(function () {
        scrollTop = null;
    }, 0);
}

//아코디언::여러개 열림
$(document).ready(function () {
    $('.open_trigger').click(function () {
        $(this).siblings('.con_panel').slideToggle();
        $(this).find('img').toggleClass('rotate');
    });
});

//아코디언
$(document).on("click", ".accordion .trigger", function () {
    var my_trigger = $(this);
    var my_panel = $(this).siblings(".panel");
    var my_list_item = $(this).siblings(".list_item_title");
    var dropdown_arrow = $(this).find(".dropdown_arrow");

    var accordion_group = $(this).parents('.accordion'); //해당 아코디언 그룹

    if (my_trigger.hasClass('active')) {  //열려있을 때
        //해당 슬리아드 비활성화
        my_panel.stop().slideUp();
        my_trigger.removeClass('active');
        dropdown_arrow.removeClass('rotate');
    } else {  //닫혀있을 때
        accordion_group.find('.panel').stop().slideUp();
        accordion_group.find('.trigger').removeClass('active');

        //해당 슬라이드 활성화
        my_panel.stop().slideDown();
        my_trigger.addClass('active');
        my_list_item.addClass('active')
        dropdown_arrow.addClass('rotate')
    }
});


// 이미지 확대/축소
function setModalOpen(img) {
    $("#zoom_img").attr('src', img);
    modalOpen('img_origin');
    imageZoom();
}
function imageZoom() {
    var el = document.querySelector('#box_id');
    var pz = new PinchZoom.default(el, {
        draggableUnzoomed: false,
    });
}

// 위시리스트 토글버튼
function btn_like(element) {
    if ($(element).hasClass("on")) {
        $(element).removeClass("on");
    } else {
        $(element).addClass("on");
    }
}


// 사업자정보확인
function licenseCheck() {
    var url = "http://www.ftc.go.kr/bizCommPop.do?wrkr_no=" + form_license.license_no.value;
    window.open(url, "bizCommPop", "width=750, height=700;");
}

//------------------------------------------------------------------------------------------



// 숫자만 입력-------------------------------------------------------------------------------
// 숫자및 콤마사용(호출 ::onkeyup="return numkey_check(event)")
function numkey_check(evt) {
    var _pattern = /^(\d{1,10}\)?)?$/;
    var _value = event.srcElement.value;
    if (!_pattern.test(_value)) {
        alert("숫자만 허용됩니다.");
        event.srcElement.value = event.srcElement.value.substring(0, event.srcElement.value.length - 1);
        event.srcElement.focus();
    }
}

function numkey_comma_check(evt) {
    var _pattern = /^(\d{1,5}([.]\d{0,2})?)?$/;
    var _value = event.srcElement.value;
    if (!_pattern.test(_value)) {
        alert("숫자만 입력가능하며,\n소수점 둘째자리까지만 허용됩니다.");
        event.srcElement.value = event.srcElement.value.substring(0, event.srcElement.value.length - 1);
        event.srcElement.focus();
    }
}


//------------------------------------------------------------------------------------------

// checkbox 쉼표로 가져오기-----------------------------------------------------------------
//checkbox 쉼표로 가져오기
function get_checkbox_value(name) {

    var selected_idx = "";
    var num = 0;
    $("input[name=" + name + "]:checked").each(function () {
        if (num == 0) {
            selected_idx += $(this).val();
        } else {
            selected_idx += ',' + $(this).val();
        }
        num++;
    });
    return selected_idx;
}
//------------------------------------------------------------------------------------------

// 파일업로드-------------------------------------------------------------------------------

var img_id_val = "img";

//파일업로드요청:서버->앱
function api_request_file_upload(img_id, file_cnt) {

    img_id_val = img_id;

    if (file_cnt) {
        if ($("." + img_id + "_div").length >= file_cnt) {
            alert("최대 " + file_cnt + "장까지만 등록 가능합니다!");
            return;
        }
    }

    if (app_yn != 'Y') {
        file_upload_click(img_id_val, 'image', '1', '150');
        set_member_img_test();
        return;
    }

    if (agent == 'android') {
        window.rocateer.request_file_upload();
    } else if (agent == 'ios') {
        var message = {
            "request_type": "request_file_upload",
        };
        window.webkit.messageHandlers.native.postMessage(message);
    }
}


// 파일적용::앱->서버
function api_reponse_file_upload(file_path) {
    if (img_id_val == 'member_img') {
        set_one_img(file_path);
    } else {
        set_img(file_path);
    }
}

var file_cnt = 0;
// 이미지 업로드 함수 trigger(img_id:id,limit_cnt:파일갯수,file_type:(image:이미지,file:파일)
function file_upload_click(img_id, file_type, limit_cnt) {
    $('body').append('<form id="file_form" method="post"></form>');
    var fileUpload = "<input type='file' name='file' id='ex_file' onchange=\"file_upload('" + img_id + "','" + file_type + "','" + limit_cnt + "');\" style='display:none' >";
    $('#file_form').html(fileUpload);
    $('#ex_file').click();
}


//파일업로드함수
function file_upload(img_id, file_type, limit_cnt) {

    var formdata = new FormData($("#file_form")[0]);

    if (limit_cnt != "") {
        if (file_cnt >= parseInt(limit_cnt)) {
            alert('업로드는 ' + limit_cnt + '개 까지만 등록 가능합니다.');
            return;
        }
    }

    var fileName = $("#ex_file").val();
    fileName = fileName.slice(fileName.indexOf(".") + 1).toLowerCase();

    if (file_type == "image") {
        if (
            fileName != "jpg" &&
            fileName != "png" &&
            fileName != "gif" &&
            fileName != "jpeg" &&
            fileName != "bmp" &&
            fileName != "pdf"
        ) {
            alert("이미지 파일은 (jpg, png, gif) 형식만 등록 가능합니다.");
            return;
        }
    } else {
        if (fileName != "json") {
            alert("파일은 (json) 형식만 등록 가능합니다.");
            return;
        }
    }

    $.ajax({
        url: "/s3/fileupload.php",
        type: 'post',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: formdata,
        success: function (result) {

            img_list = result.img_list;

            var str = "";

            for (var i = 0; i < img_list.length; i++) {
                str = "<li id='id_file_" + i + "_" + file_cnt + "' class='flie_li' style='display:inline-block;width:300px;float:left;'>"
                if (file_type != "file") {
                    str += "<img class='preview_img' src='" + img_list[i].path + "'>";
                } else {
                    str += img_list[i].orig_name;
                }
                str += "<img src='/images/btn_del.gif' style='width:15px;cursor:pointer' onclick=\"file_upload_remove('" + i + "_" + file_cnt + "');\"/>";
                str += "<input type='hidden'  name='" + img_id + "_orig_name[]' id='" + img_id + "_orig_name_" + i + "' value='" + img_list[i].orig_name + "'/>";
                str += "<input type='hidden' name='" + img_id + "_org_path[]' id='" + img_id + "_org_" + i + "' value='" + img_list[i].orig_name + "'/>";
                str += "<input type='hidden' name='" + img_id + "_path[]' id='" + img_id + "_path_" + i + "' value='" + img_list[i].path + "'/>";
                str += "<input type='hidden' name='" + img_id + "_width[]' id='" + img_id + "_width_" + i + "' value='" + img_list[i].image_width + "'/>";
                str += "<input type='hidden' name='" + img_id + "_height[]' id='" + img_id + "_height_" + i + "' value='" + img_list[i].image_height + "'/>";
                str += "</li>";

                //console.log(str);

                if (img_id == 'img') {
                    set_img(img_list[i].path, img_list[i].orig_name);
                    // set_member_img(img_list[i].path);
                } else if (img_id == 'member_img') {
                    set_one_img(img_list[i].path);
                } else {
                    $('#' + img_id).append(str);
                }
            }
            file_cnt++;
        }

    });

}

var file_upload_remove = function (file_no) {
    $("#id_file_" + file_no).remove();
}

function set_one_img(file_path) {
    $('#member_img_src').attr("src", file_path);
    $('#member_img_path').val(file_path);
}


var i = 0;

function set_img(file_path, orig_name) {
    //alert(file_path);
    var str = "";
    str += "<li class='" + img_id_val + "_div' id='id_file_0_" + i + "' >";
    str += "  <img src='/images/i_delete_2.png' alt='X' onclick=\"file_img_remove('id_file_0_" + i + "')\" class='btn_delete'>";
    str += "  <div class='img_box'>";
    str += "    <img src='" + file_path + "' alt=''>";
    str += "  </div>";
    str += "  <input type='checkbox' name='" + img_id_val + "'  value='" + file_path + "' checked style='display:none' />";
    str += "</li>";

    $('#' + img_id_val).append(str);
    $('#' + img_id_val + '_cnt').html($("." + img_id_val + "_div").length + "/10");

    i++;
}

function file_img_remove(file_no) {
    $("#" + file_no).remove();
    $('#' + img_id_val + '_cnt').html($("." + img_id_val + "_div").length + "/10");
}
// -------------------------------------------------------------------------------------


//3자리 단위마다 콤마 생성
function setAddCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//모든 콤마 제거
function removeCommas(x) {
    if (!x || x.length == 0) return "";
    else return x.split(",").join("");
}
//3자리 실행 함수
//실행 방법 _input_check type=>pirce로 설정
//input tag에 onkeyup로 함수 실행
function getNumberComma(id) {
    $("#" + id).val(setAddCommas($("#" + id).val().replace(/[^0-9]/g, "")));
}




/**
 * 확인 취소가 있는 알림창
 * @param {*} message
 * @param {*} confirmText
 * @param {*} cancelText
 * @param {*} onConfrim
 */
function dialog(message, confirmText, cancelText, onConfrim) {
    Swal.fire({
        title: message,
        buttonsStyling: true,
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        confirmButtonColor: '#20BFA9',
        cancelButtonColor: '#999999',
        width: 400,
        padding: 20,
        allowOutsideClick: false
    }).then(function (result) {
        if (result.isConfirmed) {
            onConfrim();
        }
    });
}

//----------------------------------------------------------------------------------------------------

// 공공데이터 좌표값을 x y 위도경도로 변경해주는 함수
function get_coordinate_conversion(rtentX, rtentY) {
    // proj4에서 UTM 좌표계 정의
    proj4.defs("EPSG:5179",
        "+proj=tmerc +lat_0=38 +lon_0=127.5 +k=0.9996 +x_0=1000000 +y_0=2000000 +ellps=GRS80 +units=m +no_defs");

    // proj4에서 WGS84 좌표계 정의
    proj4.defs("EPSG:4326", "+proj=longlat +datum=WGS84 +no_defs");

    // UTM 좌표를 WGS84로 변환
    var wgs84Coords = proj4("EPSG:5179", "EPSG:4326", [parseFloat(rtentX), parseFloat(rtentY)]);

    return wgs84Coords;
}

// 공공데이터 좌표값을 x y 좌표로 변경해주는 함수
function get_coordinate_conversion1(rtentX, rtentY) {
    // proj4에서 UTM 좌표계 정의
    proj4.defs("EPSG:5179",
        "+proj=tmerc +lat_0=38 +lon_0=127.5 +k=0.9996 +x_0=1000000 +y_0=2000000 +ellps=GRS80 +units=m +no_defs");

    // proj4에서 WGS84 좌표계 정의
    proj4.defs("EPSG:4326", "+proj=longlat +datum=WGS84 +no_defs");

    // UTM 좌표를 WGS84로 변환
    var wgs84Coords = proj4("EPSG:4326", "EPSG:5179", [parseFloat(rtentX), parseFloat(rtentY)]);

    return wgs84Coords;
}


function get_priceTrans(number) {

    var unit = ["조", "억", "만", "천"];
    var divisor = [1000000000000, 100000000, 10000, 1000];

    var converted = '';
    for (var i = 0; i < unit.length; i++) {
        var quotient = Math.floor(number / divisor[i]);
        if (quotient > 0) {
            converted += quotient + unit[i] + ' ';
            number %= divisor[i];
        }
    }

    console.log(converted.trim() + '원');
    return converted.trim() + '원';
}

function getSearchContent(searchInput, content) {
    let positions = [];
    let offset = 0;

    // 검색어가 content에 등장하는 모든 인덱스를 찾기
    while ((pos = content.toLowerCase().indexOf(searchInput.toLowerCase(), offset)) !== -1) {
        positions.push(pos);
        offset = pos + searchInput.length;
    }

    // 발생 위치를 기준으로 강조된 HTML 생성
    let highlightedContent = '';
    let lastPos = 0;
    positions.forEach(pos => {
        highlightedContent += content.substring(lastPos, pos) + '<span>' + content.substring(pos, pos + searchInput.length) + '</span>';
        lastPos = pos + searchInput.length;
    });
    highlightedContent += content.substring(lastPos);

    // 결과 반환
    return highlightedContent;
}

var prev = "";
var regexp = /^\d*(\.\d{0,2})?$/;
var regexp1 = /^\d*(\.\d{0,1})?$/;

// 소수점 리미트
function imsi(obj) {
    if (obj.value.search(regexp) == -1) {
        obj.value = prev;
    } else {
        prev = obj.value;
    }
}

function imsi1(obj) {
    if (obj.value.search(regexp1) == -1) {
        obj.value = prev;
    } else {
        prev = obj.value;
    }
}

// 숫자 입력 최대값
function validateInput(element, max) {
    var value = element.value;
    if (value > max) {
        element.value = max;
    }
}

// 숫자만 입력
function onlyNumbers(element) {
    let value = element.value;
    element.value = '';
    element.value = value.replace(/[^0-9]/g, '');
}

// 금액 콤마
function onTextChangeEvent(element) {
    let value = element.value;
    element.value = '';
    value = value.replace(/[^0-9]/g, '');
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    element.value = value == 0 ? '' : value;
}

// 금액 콤마
function onTextChangeEventIndex(name, index) {
    let value = $('#' + name + '_' + index).val();
    $('#' + name + '_' + index).val('');
    value = value.replace(/[^0-9]/g, '');
    $('#' + name).val(value);
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    $('#' + name + '_' + index).val((value == 0 ? '' : value));
}


// 날짜
function onlyDateCharacters(event) {
    const key = event.key;
    if (!/[0-9]/.test(key)) {
        event.preventDefault();
    }
}

// 날짜 포맷
function onDateChangeEvent(name, index) {
    let value = $('#' + name + '_' + index).val();
    value = value.replace(/[^0-9]/g, '');
    $('#' + name).val(value);
    let formattedValue = '';
    if (value.length > 4) {
        formattedValue = value.substring(0, 4) + '.' + value.substring(4, 6);
    } else if (value.length > 2) {
        formattedValue = value.substring(0, 4) + (value.length > 4 ? '.' : '') + value.substring(4);
    } else {
        formattedValue = value;
    }
    if (value.length > 6) {
        formattedValue += '.' + value.substring(6, 8);
    }
    $('#' + name + '_' + index).val(formattedValue);
}

