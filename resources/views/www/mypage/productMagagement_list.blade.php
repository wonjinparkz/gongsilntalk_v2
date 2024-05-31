<x-layout>

    <!-- m::header bar : s -->
    <div class="m_header">
        <div class="left_area"></div>
        <div class="m_title">마이페이지</div>
        <div class="right_area"><a href="javascript:history.go(-1)"><img src="{{ asset('assets/media/header_btn_alarm.png') }}"></a></div>
    </div>
    <!-- m::header bar : s -->

    <div class="body">

        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body my_main_body inner_wrap">
                    <h1 class="t_center">내 매물관리</h1>
                    <div class="my_tab_wrap">
                        <ul class="tab_type_5 toggle_tab">
                            <li class="active">등록요청<span>62</span></li>
                            <li>등록완료<span>12</span></li>
                        </ul>
                    </div>

                    <div class="my_search_wrap">
                        <div class="sort_wrap">
                            <div class="dropdown_box">
                                <button class="dropdown_label">거래 유형</button>
                                <ul class="optionList">
                                    <li class="optionItem">전체</li>
                                    <li class="optionItem">매매</li>
                                    <li class="optionItem">임대</li>
                                    <li class="optionItem">단기임대</li>
                                    <li class="optionItem">전세</li>
                                    <li class="optionItem">월세</li>
                                    <li class="optionItem">전매</li>
                                </ul>
                            </div>
                            <div class="dropdown_box">
                                <button class="dropdown_label">매물 종류</button>
                                <ul class="optionList">
                                    <li class="optionItem">지산/사무실/창고</li>
                                    <li class="optionItem">상가</li>
                                    <li class="optionItem">건물</li>
                                    <li class="optionItem">토지/임야</li>
                                    <li class="optionItem">단독공장</li>
                                    <li class="optionItem">아파트</li>
                                    <li class="optionItem">오피스텔</li>
                                    <li class="optionItem">단독/다가구</li>
                                    <li class="optionItem">다세대/빌라/연립</li>
                                    <li class="optionItem">상가주택</li>
                                    <li class="optionItem">주택</li>
                                    <li class="optionItem">지식산업센터 분양권</li>
                                    <li class="optionItem">상가 분양권</li>
                                    <li class="optionItem">아파트 분양권</li>
                                    <li class="optionItem">오피스텔 분양권</li>
                                </ul>
                            </div>
                        </div>

                        <div class="search_wrap">
                            <input type="text" placeholder="매물번호/주소로 검색">
                            <button><img src="{{ asset('assets/media/btn_search.png') }}" alt="검색"></button>
                        </div>
                    </div>

                    <div class="border_top">
                        <div>
                            <!-- <input type="checkbox" name="checkAll" id="checkAll">
                          <label for="checkAll"><span></span></label> -->
                        </div>
                        <div class="right_spacing">
                            <button class="btn_gray_ghost btn_sm">선택 삭제</button>
                            <button class="btn_point btn_sm"
                                onclick="location.href='{{ route('www.product.create.view') }}'">신규 매물
                                등록</button>
                        </div>
                    </div>

                    <!-- 데이터가 없을 경우 : s -->
                    <!-- <div class="empty_wrap">
                        <p>등록한 매물이 없습니다.</p>
                        <span>매물을 등록하고 간편하게 관리해보세요.</span>
                      </div> -->
                    <!-- 데이터가 없을 경우 : e -->

                    <table class="table_basic mt20">
                        <colgroup>
                            <col width="50">
                            <col width="100">
                            <col width="80">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkAll" id="checkAll">
                                    <label for="checkAll"><span></span></label>
                                </th>
                                <th>매물번호</th>
                                <th>사진</th>
                                <th>매물 종류</th>
                                <th>주소</th>
                                <th>면적 <button class="inner_change_button"><img
                                            src="{{ asset('assets/media/ic_change.png') }}"> 평</button>
                                </th>
                                <th>거래정보</th>
                                <th>관리</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result_product as $product)
                                <tr>
                                    <td class="td_center">
                                        <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
                                        <label for="checkOne_1"><span></span></label>
                                    </td>
                                    <td><span class="gray_deep">{{ $product->product_number }}</span></td>
                                    <td>
                                        <div class="list_thumb_1">
                                            <div class="img_box"><img src="{{ asset('assets/media/s_1.png') }}"></div>
                                        </div>
                                    </td>
                                    <td>{{ Lang::get('commons.product_type.' . $product->type) }}</td>
                                    <td>
                                        {{ $product->address . ' ' . ($product->is_map == 1 ? $product->address_dong . '동 ' . $product->address_number . '호' : $product->address_detail) }}
                                    </td>
                                    <td class="square">
                                        {{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                                        {{ $product->square }}㎡<br>{{ $product->type != 7 ? '전용 ' . $product->exclusive_square : '' }}㎡
                                    </td>
                                    <td class="area" style="display: none">
                                        {{ in_array($product->type, [6, 7]) ? '대지' : '공급' }}
                                        {{ $product->area }}평<br>{{ $product->type != 7 ? '전용' . $product->exclusive_area : '' }}평
                                    </td>
                                    <td>{{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}<br>
                                        {{ mb_substr(Commons::get_priceTrans($product->priceInfo->price), 0, -1) }}
                                        {{ in_array($product->priceInfo->payment_type, [1, 2, 4]) ? ' / ' . mb_substr(Commons::get_priceTrans($product->priceInfo->month_price), 0, -1) : '' }}
                                    </td>
                                    <td><button class="btn_gray_ghost btn_sm">삭제</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- paging : s -->
                    <div class="paging only_pc">
                        <ul class="btn_wrap">
                            <li class="btn_prev">
                                <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_prev.png') }}"
                                        alt=""></a>
                            </li>
                            <li class="active">1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li class="btn_next">
                                <a class="no_next" href="#1"><img src="{{ asset('assets/media/btn_next.png') }}"
                                        alt=""></a>
                            </li>
                        </ul>
                    </div>
                    <!-- paging : e -->
                </div>
                <!-- my_body : e -->

            </div>

            <!-- nav : s -->
            <nav>
                <ul>
                    <li>
                        <a href="main.html"><span><img src="{{ asset('assets/media/mcnu_ic_1.png') }}"
                                    alt=""></span>홈</a>
                    </li>
                    <li>
                        <a href="sales_list.html"><span><img src="{{ asset('assets/media/mcnu_ic_2.png') }}"
                                    alt=""></span>분양현장</a>
                    </li>
                    <li>
                        <a href="m_map.html"><span><img src="{{ asset('assets/media/mcnu_ic_3.png') }}"
                                    alt=""></span>지도</a>
                    </li>
                    <li>
                        <a href="community_contents_list.html"><span><img
                                    src="{{ asset('assets/media/mcnu_ic_5.png') }}" alt=""></span>커뮤니티</a>
                    </li>
                    <li class="active">
                        <a href="javascript:history.go(-1)"><span><img src="{{ asset('assets/media/mcnu_ic_4.png') }}"
                                    alt=""></span>마이페이지</a>
                    </li>
                </ul>
            </nav>
            <!-- nav : e -->


        </div>

    </div>

</x-layout>
