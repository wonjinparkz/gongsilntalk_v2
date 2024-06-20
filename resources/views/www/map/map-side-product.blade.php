<div class="side_list_wrap">

    <ul class="side_list_tab tab_toggle_menu">
        <li class="active">지도 내 매물 {{ count($productList) }}</li>
        <li>중개사무소 17</li>
    </ul>
    <div class="tab_area_wrap side_list_body">
        <div>
            <ul class="list_sort2 toggle_tab">
                <li class="active"><a href="#">최신순</a></li>
                <li class="inner_toggle">
                    <a href="#">
                        <span class="sort_direction active">가격순</span>
                        <button class="inner_button sort_price"><span class="price_txt">낮은가격순</span> <img
                                src="{{ asset('assets/media/sort_arrow.png') }}" class="sort_arrow"></button>
                    </a>
                </li>
                <li class="inner_toggle">
                    <a href="#">
                        <span class="sort_direction active">면적순</span>
                        <button class="inner_button sort_area"><span class="price_txt">넓은면적순</span> <img
                                src="{{ asset('assets/media/sort_arrow.png') }}" class="sort_arrow"></button>
                    </a>
                </li>
            </ul>
            <!-- <div class="empty_wrap">
            <p><img src="{{ asset('assets/media/img_empty_1.png') }}" class="empty_img"></p>
            <span>조건에 맞는 매물이 없습니다.<br>지도를 이동하거나, 검색 필터를 조정해보세요.</span>
          </div> -->
            <div class="side_list_scroll">
                <!-- list : s -->
                @if (count($productList) > 0)
                    @foreach ($productList as $product)
                        <div class="property_sm_list">
                            <div class="frame_img_mid">
                                <span class="btn_wish_sm" onclick="btn_wish(this)"></span>
                                <div class="img_box"><img
                                        src="{{ Storage::url('image/' . $product->images[0]->path) }}"></div>
                            </div>
                            <a href="{{ route('www.map.room.detail', [$product->id]) }}">
                                <div class="property_sm_info">
                                    <p class="property_sm_item_1">
                                        {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                                        {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                                        {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                                    </p>
                                    <p class="txt_lh_1">{{ Lang::get('commons.product_type.' . $product->type) }}
                                        {{ substr($product->region_address, strpos($product->region_address, ' ') + 1) }}
                                    </p>
                                    <p class="txt_lh_1">{{ $product->square }}㎡
                                        {{ $product->type != 7 ? ' / ' . $product->exclusive_square : '' }}㎡·{{ $product->floor_number }}층
                                    </p>
                                    <p class="property_sm_item_2">
                                        {{ $product->comments }}&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
                <!-- list : e -->
                <div style="height:1000px; color:#fff">개발시 삭제 스크롤 때문에 넣어봄.</div>
            </div>
        </div>
        <div>
            <!-- <div class="empty_wrap">
            <p><img src="{{ asset('assets/media/img_empty_1.png') }}" class="empty_img"></p>
            <span>조건에 맞는  중개사무소가 없습니다.<br>지도를 이동하거나, 검색 필터를 조정해보세요.</span>
          </div> -->
            <ul class="list_sort2 toggle_tab">
                <li class="active"><a href="#">가까운 거리순</a></li>
                <li class=""><a href="#">이름순</a></li>
            </ul>
            <div class="side_list_scroll">
                <!-- list : s -->
                <a href="agent_detail.html">
                    <div class="agent_sm_list">
                        <div class="agent_sm_info">
                            <p class="agent_txt_item_1">주식회사더블유파트너즈부동산중개</p>
                            <p class="agent_txt_item_2">서울특별시 중구 세종대로 136 3층 S3002호</p>
                        </div>
                        <div class="frame_img_sm">
                            <div class="img_box"><img src="{{ asset('assets/media/default_img.png') }}"></div>
                        </div>
                    </div>
                </a>
                <!-- list : e -->

                <div style="height:1000px; color:#fff">개발시 삭제</div>
            </div>
        </div>
    </div>
</div>



<script>
    //정렬
    $(document).ready(function() {

        const priceButton = document.querySelector(".sort_price");
        const priceTextSpan = priceButton.querySelector(".price_txt");
        const priceArrowImg = priceButton.querySelector(".sort_arrow");

        priceButton.addEventListener("click", function() {
            if (priceTextSpan.textContent === "낮은가격순") {
                priceTextSpan.textContent = "높은가격순";
                priceArrowImg.style.transform = "rotate(180deg)";
            } else {
                priceTextSpan.textContent = "낮은가격순";
                priceArrowImg.style.transform = "rotate(0deg)";
            }
        });

        const areaButton = document.querySelector(".sort_area");
        const areaTextSpan = areaButton.querySelector(".price_txt");
        const areaArrowImg = areaButton.querySelector(".sort_arrow");

        areaButton.addEventListener("click", function() {
            if (areaTextSpan.textContent === "넓은면적순") {
                areaTextSpan.textContent = "좁은면적순";
                areaArrowImg.style.transform = "rotate(180deg)";
            } else {
                areaTextSpan.textContent = "넓은면적순";
                areaArrowImg.style.transform = "rotate(0deg)";
            }
        });
    })
</script>
