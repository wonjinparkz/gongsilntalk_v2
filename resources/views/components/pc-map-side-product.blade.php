<div class="side_list_wrap">

    <ul class="side_list_tab tab_toggle_menu">
        <li class="property active" onclick="tabChange(this)"><a href="javascript:void(0);">지도 내 매물 <span
                    id="property_count">0</span>
            </a>
        </li>
        <li class="agent" onclick="tabChange(this)"><a href="javascript:void(0);">중개사무소 <span id="agent_count">0</span>
            </a>
        </li>
    </ul>
    <div class="tab_area_wrap side_list_body">
        <div>
            <ul class="list_sort2 toggle_tab">
                <li class="active sort_new"><a>최신순</a></li>
                <li class="inner_toggle">
                    <a>
                        <span class="sort_direction active price">가격순</span>
                        <button class="inner_button sort_price"><span class="price_txt">낮은가격순</span> <img
                                src="{{ asset('assets/media/sort_arrow.png') }}" class="sort_arrow"></button>
                    </a>
                </li>
                <li class="inner_toggle">
                    <a>
                        <span class="sort_direction active area">면적순</span>
                        <button class="inner_button sort_area"><span class="price_txt">넓은면적순</span> <img
                                src="{{ asset('assets/media/sort_arrow.png') }}" class="sort_arrow"></button>
                    </a>
                </li>
            </ul>
            <div class="side_list_scroll" id="property_list">
            </div>
        </div>
        <div>
            <ul class="list_sort2 toggle_tab">
                <li class="active sort_distance"><a>가까운 거리순</a></li>
                <li class="sort_name"><a>이름순</a></li>
            </ul>
            <div class="side_list_scroll" id="agent_list" style="display:none;">
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="orderby" name="orderby" value="">
<script>
    //정렬
    document.addEventListener("DOMContentLoaded", function() {
        // 최신순
        const newButton = document.querySelector(".sort_new");
        newButton.addEventListener("click", function() {
            $('#orderby').val('sort_new');
            deleteDivItem();
        });

        // 가격순
        const price = document.querySelector(".price");
        const priceButton = document.querySelector(".sort_price");
        const priceTextSpan = priceButton.querySelector(".price_txt");
        const priceArrowImg = priceButton.querySelector(".sort_arrow");

        price.addEventListener("click", function() {
            $('#orderby').val('price_desc');
            deleteDivItem();
        });
        priceButton.addEventListener("click", function() {
            if (priceTextSpan.textContent === "낮은가격순") {
                priceTextSpan.textContent = "높은가격순";
                priceArrowImg.style.transform = "rotate(180deg)";
                $('#orderby').val('price_asc');
            } else {
                priceTextSpan.textContent = "낮은가격순";
                priceArrowImg.style.transform = "rotate(0deg)";
                $('#orderby').val('price_desc');
            }
            deleteDivItem();
        });

        // 면적순
        const area = document.querySelector(".area");
        const areaButton = document.querySelector(".sort_area");
        const areaTextSpan = areaButton.querySelector(".price_txt");
        const areaArrowImg = areaButton.querySelector(".sort_arrow");
        area.addEventListener("click", function() {
            $('#orderby').val('area_desc');
            deleteDivItem();
        });
        areaButton.addEventListener("click", function() {
            if (areaTextSpan.textContent === "넓은면적순") {
                areaTextSpan.textContent = "좁은면적순";
                areaArrowImg.style.transform = "rotate(180deg)";
                $('#orderby').val('area_desc');
            } else {
                areaTextSpan.textContent = "넓은면적순";
                areaArrowImg.style.transform = "rotate(0deg)";
                $('#orderby').val('area_asc');
            }

            deleteDivItem();
        });

        // 가까운 거리순
        const distanceButton = document.querySelector(".sort_distance");
        distanceButton.addEventListener("click", function() {
            $('#orderby').val('sort_distance');
            deleteAItem();
        });

        // 이름순
        const nameButton = document.querySelector(".sort_name");
        nameButton.addEventListener("click", function() {
            $('#orderby').val('sort_name');
            deleteAItem();
        });
    });

    // 페이징
    function loadMoreData() {
        $.ajax({
                url: "{{ route('www.map.property.list') }}",
                data: {
                    page: null,
                    orderby: $('#orderby').val(),
                    productIds: productIdArray,
                    agentIds: agentIdArray,
                },
                type: "get",
                beforeSend: function() {
                    // $('.ajax-load').show();
                }
            })
            .done(function(data) {
                $("#property_list").html(data.property);
                $("#agent_list").html(data.agent);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {});
    }

    // 텝 변경
    function tabChange(e) {
        $(".tab_toggle_menu li").removeClass("active");
        e.classList.add('active');

        $(`#property_list`).css('display', 'none');
        $(`#agent_list`).css('display', 'none');

        let listName = e.className.split(' ');
        if (listName[0] == 'agent') {

            deleteAItem();
        } else if (listName[0] == 'property') {

            deleteDivItem();
        }
        $(`#${listName[0]}_list`).css('display', 'block');
    }

    // 지도내매물 목록 삭제
    function deleteDivItem() {
        const div = document.getElementById('property_list');
        const items = div.getElementsByTagName('div');
        for (var i = items.length - 1; i >= 0; i--) {
            items[i].remove();
        }
        $('.no_data').css('display', 'none');
        loadMoreData();
    }

    // 중개사무소 목록 삭제
    function deleteAItem() {

        const div = document.getElementById('agent_list');
        const items = div.getElementsByTagName('a');

        for (var i = items.length - 1; i >= 0; i--) {
            items[i].remove();
        }
        $('.no_data').css('display', 'none');
        loadMoreData();
    }
</script>
