@props([
    'corpInfo' => [],
    'address' => [],
    'products' => [],
])

<script type="text/javascript"
    src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId={{ env('VITE_NAVER_MAP_CLIENT_ID') }}&submodules=panorama">
</script>

@inject('carbon', 'Carbon\Carbon')

<div class="proposal_type_item proposal_type_3">
    <section class="type_3_1">
        <div class="ghost_box">
            <div>
                <h1>{{ $corpInfo->corp_name }}<br>기업이전제안서</h1>
                <p class="txt_item_1">COMPANY RELOCATION PROPOSAL</p>
            </div>
        </div>
    </section>
    <div class="page-break"></div> <!-- 새로운 페이지 시작 -->

    <section class="type_3_2">
        <h2>목차</h2>
        <div class="type_3_index">
            @foreach ($address as $key => $address)
                <div class="index_item">
                    <div class="index_number">{{ $key + 1 < 10 ? '0' . $key + 1 : $key }}</div>
                    <div class="index_list">
                        <div class="index_name">{{ $address->city }}</div>
                        <div class="index_item_list">
                            @foreach ($address->products as $product)
                                <div class="index_item_row">{{ $product->product_name }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <div class="page-break"></div> <!-- 새로운 페이지 시작 -->
    @foreach ($products as $key => $product)
        <section class="type_page type_3_3">
            <h2>01 건물소개</h2>
            <h3>{{ $product->product_name }}</h3>
            <div class="item_wrap">
                <div class="item_wrap_box">
                    <div class="item_info">
                        <h5>외관</h5>
                    </div>
                    <div class="item_img">
                        <div class="img_box"><img src="{{ Storage::url('image/' . $product->main_images->path) }}">
                        </div>
                    </div>
                </div>
                <div class="item_wrap_box">
                    <div class="item_info">
                        <h5>위치</h5>
                        <p>{{ $product->address }}</p>
                    </div>
                    <div class="item_img">
                        <div id="minimap_3_{{ $key }}" style="width:428px; height:293px;"></div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            var miniMap_3_{{ $key }} = new naver.maps.Map('minimap_3_{{ $key }}', {
                center: new naver.maps.LatLng({{ $product->address_lat }}, {{ $product->address_lng }}),
                // center: new naver.maps.LatLng(37.48860419800877, 126.8880090781063),
                zoom: 15,
                minZoom: 13,
                maxZoom: 20,
                mapTypeId: naver.maps.MapTypeId.NORMAL,
                mapDataControl: false,
                scaleControl: false,
                mapTypeControl: false
            });

            marker = new naver.maps.Marker({
                position: new naver.maps.LatLng('{{ $product->address_lat }}', '{{ $product->address_lng }}'),
                map: miniMap_3_{{ $key }},
                icon: {
                    url: "{{ asset('assets/media/map_marker_default.png') }}",
                    size: new naver.maps.Size(100, 100), //아이콘 크기
                    scaledSize: new naver.maps.Size(30, 43), //아이콘 크기
                    origin: new naver.maps.Point(0, 0),
                    anchor: new naver.maps.Point(11, 35)
                }
            });
        </script>
        <div class="page-break"></div> <!-- 새로운 페이지 시작 -->

        <section class="type_page type_3_4">
            <h2>02 매물세부내용</h2>
            <h3>{{ $product->product_name }}</h3>
            <div class="item_2_wrap">
                <table class="proposal_section_table">
                    <colgroup>
                        <col width="20%">
                        <col width="30%">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <th rowspan="6">기본정보</th>
                        <th>상세주소</th>
                        <td>{{ $product->address_detail ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>매물유형</th>
                        <td>{{ Lang::get('commons.corp_product_type.' . $product->product_type) }}</td>
                    </tr>
                    <tr>
                        <th>관리비</th>
                        <td>
                            {{ $product->service_price > 0 ? number_format($product->service_price / 10000) . '만원' : '관리비 없음' }}
                        </td>
                    </tr>
                    <tr>
                        <th>입주가능일</th>
                        <td>{{ $product->move_type != 2 ? Lang::get('commons.mova_date_type.' . $product->move_type) : $carbon::parse($product->move_date)->format('Y년 m월 d일') }}
                        </td>
                    </tr>
                    <tr>
                        <th>냉난방 종류</th>
                        <td>
                            {{ $product->cooling_type != '' ? Lang::get('commons.cooling_type.' . $product->cooling_type) : '냉방 선택안함' }}
                            -
                            {{ $product->heating_type != '' ? Lang::get('commons.heating_type.' . $product->heating_type) : '난방 선택안함' }}
                        </td>
                    </tr>
                    <tr>
                        <th>주차 가능 대수</th>
                        <td>{{ number_format($product->parking_count) }}대</td>
                    </tr>
                </table>

                <table class="proposal_section_table">
                    <colgroup>
                        <col width="20%">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <th>특장점</th>
                        <td>
                        <div class="td_wrap_1">
                            @php
                                echo nl2br($product->product_content);
                            @endphp
                            </div>
                        </td>
                    </tr>
                </table>

                <table class="proposal_section_table">
                    <colgroup>
                        <col width="20%">
                        <col width="30%">
                        <col width="*">
                    </colgroup>
                    @if ($product->price->payment_type == 0)
                        <tr>
                            <th rowspan="3">가격정보</th>
                            <th>매매가</th>
                            <td>{{ number_format($product->price->price) }}원</td>
                        </tr>
                        <tr>
                            <th>프리미엄</th>
                            <td>{{ number_format($product->price->premium_price) }}원</td>
                        </tr>
                        <tr>
                            <th>지원금액(인테리어 등)</th>
                            <td>{{ number_format($product->price->support_price) }}원</td>
                        </tr>
                    @else
                        <tr>
                            <th rowspan="2">가격정보</th>
                            <th>{{ $product->price->payment_type == 3 ? '전세가' : '보증금' }}</th>
                            <td>{{ number_format($product->price->price) }}원</td>
                        </tr>
                        @if ($product->price->payment_type == 1)
                            <tr>
                                <th>월세</th>
                                <td>{{ number_format($product->price->month_price) }}원</td>
                            </tr>
                        @endif
                    @endif
                </table>

                <table class="proposal_section_table">
                    <colgroup>
                        <col width="20%">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <th>시설정보</th>
                        <td>
                            @php
                                $optionArray = [];
                                foreach ($product->facility as $key => $option) {
                                    array_push($optionArray, $option->type);
                                }

                                // $optionArray의 값에 해당하는 옵션 타입만 가져옴
                                $selectedOptions = array_map(function ($index) {
                                    return Lang::get('commons.corp_product_option_type')[$index];
                                }, $optionArray);

                                echo implode(', ', $selectedOptions);
                            @endphp
                        </td>
                    </tr>
                </table>
            </div>
        </section>
        <div class="page-break"></div> <!-- 새로운 페이지 시작 -->

        <section class="type_page type_3_5">
            <h2>03 도면 및 사진</h2>
            <div class="item_3_wrap">
                @foreach ($product->detail_images as $images)
                    <div>
                        <div class="item_img">
                            <div class="img_box"><img src="{{ Storage::url('image/' . $images->path) }}">
                            </div>
                        </div>
                    </div>
                    
                @endforeach

            </div>
        </section>
        <div class="page-break"></div> <!-- 새로운 페이지 시작 -->
        
        @if ($product->price->payment_type == 0)
        
            <section class="type_page type_3_5">
                <h2>04 견적서</h2>
                <div class="item_4_wrap">
                    <div class="item_div">
                        <h4>{{ $product->product_name }} 견적서 1</h4>
                        <table class="proposal_section_table_2">
                            <colgroup>
                                <col width="7%">
                                <col width="45%">
                                <col width="*">
                            </colgroup>
                            @php
                                $acquisitionPrice = $product->price->price * ($product->price->acquisition_tax / 100); // 취득세
                                $loanPrice = $product->price->price * ($product->price->loan_rate_one / 100); // 대출금
                                $payPrice = ($loanPrice * ($product->price->loan_interest / 100)) / 12;
                                $realInvestPrice =
                                    $product->price->price +
                                    $acquisitionPrice +
                                    $product->price->etc_price -
                                    $loanPrice -
                                    $product->price->invest_price; // 실투자금
                                $monthMyPrice = $product->price->invest_month_price - $payPrice;
                                $yearMyPriceRate = (($monthMyPrice * 12) / $realInvestPrice) * 12;
                            @endphp
                            <tr>
                                <th>1</th>
                                <th>매매가</th>
                                <td>{{ number_format($product->price->price) }}원</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>대출금({{ $product->price->loan_rate_one }}%)</th>
                                <td>{{ number_format($loanPrice) }}원
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>대출금리</th>
                                <td>{{ $product->price->loan_interest }}%</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                </th>
                                <td>{{ number_format($payPrice) }}원</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                </th>
                                <td>{{ number_format($acquisitionPrice) }}원
                                </td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <th>기타비용</th>
                                <td>{{ number_format($product->price->etc_price) }}원</td>
                            </tr>
                            @if ($product->price->is_invest == 1)
                                <tr>
                                    <th>7</th>
                                    <th>보증금</th>
                                    <td>{{ number_format($product->price->invest_price) }}원</td>
                                </tr>
                                <tr>
                                    <th>8</th>
                                    <th>월임대료</th>
                                    <td>{{ number_format($product->price->invest_month_price) }}원</td>
                                </tr>
                            @endif
                            <tr>
                                <th>9</th>
                                <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                </th>
                                <td><span class="txt_item_2">{{ number_format($realInvestPrice) }}원</span>
                                </td>
                            </tr>
                            @if ($product->price->is_invest == 1)
                                <tr>
                                    <th>10</th>
                                    <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                    </th>
                                    <td><span class="txt_item_2">{{ number_format($monthMyPrice) }}원</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>11</th>
                                    <th>연수익 <p class="txt_item_1">월수익×12</p>
                                    </th>
                                    <td><span class="txt_item_2">{{ number_format($monthMyPrice * 12) }}원</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>12</th>
                                    <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                    </th>
                                    <td><span class="txt_item_2">{{ round($yearMyPriceRate, 2) }}%</span></td>
                                </tr>
                                <tr>
                                    <th>13</th>
                                    <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                    </th>
                                    <td>
                                        {{ $monthMyPrice > 0 ? round($realInvestPrice / $monthMyPrice, 2) : '-' }}년
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="item_div">
                        <h4>{{ $product->product_name }} 견적서 2</h4>
                        <table class="proposal_section_table_2">
                            <colgroup>
                                <col width="7%">
                                <col width="45%">
                                <col width="*">
                            </colgroup>
                            @php
                                $acquisitionPrice = $product->price->price * ($product->price->acquisition_tax / 100); // 취득세
                                $loanPrice = $product->price->price * ($product->price->loan_rate_two / 100); // 대출금
                                $payPrice = ($loanPrice * ($product->price->loan_interest / 100)) / 12;
                                $realInvestPrice =
                                    $product->price->price +
                                    $acquisitionPrice +
                                    $product->price->etc_price -
                                    $loanPrice -
                                    $product->price->invest_price; // 실투자금
                                $monthMyPrice = $product->price->invest_month_price - $payPrice;
                                $yearMyPriceRate = (($monthMyPrice * 12) / $realInvestPrice) * 12;
                            @endphp
                            <tr>
                                <th>1</th>
                                <th>매매가</th>
                                <td>{{ number_format($product->price->price) }}원</td>
                            </tr>
                            <tr>
                                <th>2</th>
                                <th>대출금({{ $product->price->loan_rate_two }}%)</th>
                                <td>{{ number_format($loanPrice) }}원
                                </td>
                            </tr>
                            <tr>
                                <th>3</th>
                                <th>대출금리</th>
                                <td>{{ $product->price->loan_interest }}%</td>
                            </tr>
                            <tr>
                                <th>4</th>
                                <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                </th>
                                <td>{{ number_format($payPrice) }}원</td>
                            </tr>
                            <tr>
                                <th>5</th>
                                <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                </th>
                                <td>{{ number_format($acquisitionPrice) }}원
                                </td>
                            </tr>
                            <tr>
                                <th>6</th>
                                <th>기타비용</th>
                                <td>{{ number_format($product->price->etc_price) }}원</td>
                            </tr>
                            @if ($product->price->is_invest == 1)
                                <tr>
                                    <th>7</th>
                                    <th>보증금</th>
                                    <td>{{ number_format($product->price->invest_price) }}원</td>
                                </tr>
                                <tr>
                                    <th>8</th>
                                    <th>월임대료</th>
                                    <td>{{ number_format($product->price->invest_month_price) }}원</td>
                                </tr>
                            @endif
                            <tr>
                                <th>9</th>
                                <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                </th>
                                <td><span class="txt_item_2">{{ number_format($realInvestPrice) }}원</span></td>
                            </tr>
                            @if ($product->price->is_invest == 1)
                                <tr>
                                    <th>10</th>
                                    <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                    </th>
                                    <td><span class="txt_item_2">{{ number_format($monthMyPrice) }}원</span></td>
                                </tr>
                                <tr>
                                    <th>11</th>
                                    <th>연수익 <p class="txt_item_1">월수익×12</p>
                                    </th>
                                    <td><span class="txt_item_2">{{ number_format($monthMyPrice * 12) }}원</span></td>
                                </tr>
                                <tr>
                                    <th>12</th>
                                    <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                    </th>
                                    <td><span class="txt_item_2">{{ round($yearMyPriceRate, 2) }}%</span></td>
                                </tr>
                                <tr>
                                    <th>13</th>
                                    <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                    </th>
                                    <td>
                                        {{ $monthMyPrice > 0 ? round($realInvestPrice / $monthMyPrice, 2) : '-' }}년
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </section>
            <div class="page-break"></div> <!-- 새로운 페이지 시작 -->
        @endif
    @endforeach
    
    <section class="type_3_1">
        <div class="ghost_end_box">
            <div class="end_company_wrap">
                <div>
                    <p class="txt_item_1">{{ $corpInfo->users->company_name }}</p>
                    <p class="txt_item_2">{{ $corpInfo->position }}
                        {{ $corpInfo->users->name }}</p>
                </div>
                <div>
                    <p class="txt_item_1">{{ $corpInfo->users->phone }}</p>
                    <p class="txt_item_1">{{ $corpInfo->users->email }}</p>
                </div>
                <p class="txt_item_3">{{ $corpInfo->users->company_address }}
                    {{ $corpInfo->users->company_address_detail }}</p>
            </div>
            <div class="txt_item_end">Thank you</div>
        </div>
    </section>
</div>
