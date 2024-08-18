@props([
    'corpInfo' => [],
    'address' => [],
    'products' => [],
])

<div class="proposal_type_item proposal_type_5 ">
    <section class="type_5_1">
        <div class="ghost_box">
            <p class="txt_item_1">COMPANY RELOCATION PROPOSAL</p>
            <h1>{{ $corpInfo->corp_name }}<br>기업이전제안서</h1>
            <div>
                <p class="txt_item_2">{{ $corpInfo->position }}
                    {{ Auth::guard('web')->user()->name }}</p>
                <p class="txt_item_3">{{ Auth::guard('web')->user()->company_name }}</p>
            </div>
        </div>
    </section>

    <section class="type_page">
        <div class="header">
            <h2>목차</h2>
        </div>
        <div class="type_5_index">
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
    @foreach ($products as $key => $product)
        <section class="type_page type_5_3">
            <div class="header">
                <h2>01 건물소개</h2>
            </div>
            <h3>{{ $product->product_name }}</h3>
            <div class="item_wrap">
                <div class="item_wrap_box">
                    <h5>외관</h5>
                    <div class="item_img">
                        <div class="img_box"><img src="{{ Storage::url('image/' . $product->main_images->path) }}">
                        </div>
                    </div>
                    <p class="txt_info">{{ $product->product_name }} 외관</p>
                </div>
                <div class="item_wrap_box">
                    <h5>위치</h5>
                    <div class="item_img">
                        <div class="img_box"><iframe
                                src="https://www.google.com/maps?q={{ $product->address }}&output=embed" width="428"
                                height="250" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <p class="txt_info">{{ $product->address }}</p>
                </div>
            </div>
        </section>

        <section class="type_page">
            <div class="header">
                <h2>01 건물소개</h2>
            </div>
            <h3>{{ $product->product_name }}</h3>
            <div class="item_2_wrap">
                <table class="proposal_section_table">
                    <colgroup>
                        <col width="20%">
                        <col width="30%">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <th rowspan="5">기본정보</th>
                        <th>전용면적</th>
                        <td>{{ $product->exclusive_square }}㎡ <span
                                class="gray_basic">({{ $product->exclusive_area }}평)</span></td>
                    </tr>
                    <tr>
                        <th>해당층</th>
                        <td>{{ $product->floor_number }}층/{{ $product->total_floor_number }}층</td>
                    </tr>
                    <tr>
                        <th>입주가능일</th>
                        <td>{{ $product->move_type != 3 ? Lang::get('commons.mova_date_type.' . $product->move_type) : $product->move_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>주차 가능 대수</th>
                        <td>{{ number_format($product->parking_count) }}대</td>
                    </tr>
                    <tr>
                        <th>시설정보</th>
                        <td>
                            @foreach ($product->facility as $key => $facility)
                                {{ $key != 0 ? ', ' . Lang::get('commons.corp_product_option_type.' . $facility->type) : Lang::get('commons.corp_product_option_type.' . $facility->type) }}
                            @endforeach
                        </td>
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
                            @php
                                echo nl2br($product->product_content);
                            @endphp
                        </td>
                    </tr>
                </table>

                <table class="proposal_section_table">
                    <colgroup>
                        <col width="20%">
                        <col width="30%">
                        <col width="*">
                    </colgroup>
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
                </table>

                <table class="proposal_section_table">
                    <colgroup>
                        <col width="20%">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <th>요청사항</th>
                        <td>
                            @php
                                echo nl2br($product->content);
                            @endphp
                        </td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="type_page">
            <div class="header">
                <h2>02 도면 및 사진</h2>
            </div>
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
        @if ($product->price->payment_type == 0)
            <section class="type_page">
                <div class="header">
                    <h2>03 견적서</h2>
                </div>
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
        @endif
    @endforeach

    <section class="type_5_1 type_5_end">
        <div class="ghost_end_box">
            <div class="txt_item_end">
                Thank you
            </div>
            <div class="end_company_wrap">
                <div>
                    <p class="txt_item_1">{{ Auth::guard('web')->user()->company_name }}</p>
                    <p class="txt_item_2">{{ $corpInfo->position }}
                        {{ Auth::guard('web')->user()->name }}</p>
                </div>
                <div>
                    <p class="txt_item_1">{{ Auth::guard('web')->user()->phone }}</p>
                    <p class="txt_item_1">{{ Auth::guard('web')->user()->email }}</p>
                </div>
                <p class="txt_item_3">{{ Auth::guard('web')->user()->company_address }}
                    {{ Auth::guard('web')->user()->company_address_detail }}</p>
            </div>
        </div>
    </section>
</div>
