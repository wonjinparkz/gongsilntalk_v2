<x-layout>

    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back_deep.png') }}"></a></div>
        <div class="m_title"></div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body map_side">
        <div class="side_list_wrap">
            <ul class="side_list_tab tab_toggle_menu">
                <li class="property active" onclick="tabChange(this)"><a href="javascript:void(0);">지도 내 매물
                        {{ $property->count() }}</a></li>
                <li class="agent" onclick="tabChange(this)"><a href="javascript:void(0);">중개사무소
                        {{ $agent->count() }}</a></li>
            </ul>
            <div class="tab_area_wrap side_list_body">
                <div>
                    <ul class="list_sort2 toggle_tab">
                        <li class="active sort_new"><a>최신순</a></li>
                        <li class="inner_toggle">
                            <a>
                                <span class="sort_direction active">가격순</span>
                                <button class="inner_button sort_price"><span class="price_txt">낮은가격순</span> <img
                                        src="{{ asset('assets/media/sort_arrow.png') }}" class="sort_arrow"></button>
                            </a>
                        </li>
                        <li class="inner_toggle">
                            <a>
                                <span class="sort_direction active">면적순</span>
                                <button class="inner_button sort_area"><span class="price_txt">넓은면적순</span> <img
                                        src="{{ asset('assets/media/sort_arrow.png') }}" class="sort_arrow"></button>
                            </a>
                        </li>
                    </ul>
                    <div class="empty_wrap" style="display:none;">
                        <p><img src="{{ asset('assets/media/img_empty_1.png') }}" class="empty_img"></p>
                        <span>조건에 맞는 매물이 없습니다.<br>지도를 이동하거나, 검색 필터를 조정해보세요.</span>
                    </div>
                    <div class="side_list_scroll" id="property_list">
                    </div>
                </div>
                <div>
                    <!-- <div class="empty_wrap">
                  <p><img src="{{ asset('assets/media/img_empty_1.png') }}" class="empty_img"></p>
                  <span>조건에 맞는  중개사무소가 없습니다.<br>지도를 이동하거나, 검색 필터를 조정해보세요.</span>
                </div> -->
                    <ul class="list_sort2 toggle_tab">
                        <li class="active"><a>가까운 거리순</a></li>
                        <li class=""><a>이름순</a></li>
                    </ul>
                    <div class="side_list_scroll" id="agent_list" style="display:none;">
                    </div>
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
            newButton.addEventListener("click", async function() { // Mark the function as async
                $('#orderby').val('sort_new');
                await loadMoreData(1);
            });

            // 가격순
            const priceButton = document.querySelector(".sort_price");
            const priceTextSpan = priceButton.querySelector(".price_txt");
            const priceArrowImg = priceButton.querySelector(".sort_arrow");
            priceButton.addEventListener("click", async function() {
                if (priceTextSpan.textContent === "낮은가격순") {
                    priceTextSpan.textContent = "높은가격순";
                    priceArrowImg.style.transform = "rotate(180deg)";
                    $('#orderby').val('price_asc');
                } else {
                    priceTextSpan.textContent = "낮은가격순";
                    priceArrowImg.style.transform = "rotate(0deg)";
                    $('#orderby').val('price_desc');
                }

                const div = document.getElementById('property_list');
                const items = div.getElementsByTagName('div');
                for (var i = items.length - 1; i >= 0; i--) {
                    items[i].remove();
                }
                $('.no_data').css('display', 'none');
                await loadMoreData(1);
            });

            // 면적순
            const areaButton = document.querySelector(".sort_area");
            const areaTextSpan = areaButton.querySelector(".price_txt");
            const areaArrowImg = areaButton.querySelector(".sort_arrow");
            areaButton.addEventListener("click", async function() {
                if (areaTextSpan.textContent === "넓은면적순") {
                    areaTextSpan.textContent = "좁은면적순";
                    areaArrowImg.style.transform = "rotate(180deg)";
                    $('#orderby').val('area_desc');
                } else {
                    areaTextSpan.textContent = "넓은면적순";
                    areaArrowImg.style.transform = "rotate(0deg)";
                    $('#orderby').val('area_asc');
                }

                const div = document.getElementById('property_list');
                const items = div.getElementsByTagName('div');
                for (var i = items.length - 1; i >= 0; i--) {
                    items[i].remove();
                }
                $('.no_data').css('display', 'none');
                await loadMoreData(1);
            });
        });

        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                loadMoreData(page);
            }
        });

        loadMoreData(page);

        // 페이징
        function loadMoreData(page) {
            $.ajax({
                    url: '{{ Request::url() }}',
                    data: {
                        page: page,
                        orderby: $('#orderby').val()
                    },
                    type: "get",
                    beforeSend: function() {
                        // $('.ajax-load').show();
                    }
                })
                .done(function(data) {
                    $("#property_list").append(data.property);
                    $("#agent_list").append(data.agent);
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
            console.log(`#${listName[0]}_list`);
            $(`#${listName[0]}_list`).css('display', 'block');
        }
    </script>
</x-layout>
