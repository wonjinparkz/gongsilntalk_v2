<x-layout>
    @php
        function format_phone($phone)
        {
            $phone = preg_replace('/[^0-9]/', '', $phone);
            $length = strlen($phone);
            switch ($length) {
                case 11:
                    return preg_replace('/([0-9]{3})([0-9]{4})([0-9]{4})/', "$1-$2-$3", $phone);
                    break;
                case 10:
                    return preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', "$1-$2-$3", $phone);
                    break;
                default:
                    return $phone;
                    break;
            }
        }

        $address_detail = isset($result->address_dong) ? $result->address_dong . '동 ' : '';
        $address_detail .= $result->address_detail . '호';

    @endphp
    @inject('carbon', 'Carbon\Carbon')
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">{{ $result->is_temporary == 0 ? $address_detail : $result->address_detail }}</div>
        <div class="right_area"><span class="btn_dot_menu"><img
                    src="{{ asset('assets/media/header_btn_dot.png') }}"></span></div>
        <div class="layer_menu">
            <a href="community_modify.html">수정</a>
            <a href="#">삭제</a>
        </div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">

        <div class="gray_body">
            <div class="inner_mid_wrap asset_detail_top_wrap">

                <div class="asset_detail_tit only_pc">

                    <h1>{{ $result->is_temporary == 0 ? $address_detail : $result->address_detail }}</h1>
                    <div class="gap_8">
                        <button class="btn_point btn_sm" type="button"
                            onclick="location.href='{{ route('www.mypage.service.update.first.view', [$result->id]) }}'">수정</button>
                        <button class="btn_graylight_ghost btn_sm">삭제</button>
                    </div>
                </div>

                <div class="box_01 only_pc">
                    <div class="detail_asser_total">
                        <div>
                            <label>부동산 자산</label>
                            <h1>{{ number_format($result->price) }}원</h1>
                        </div>
                        <ul class="asser_detail_item">
                            <li>
                                @php
                                    $acquisition_tax_price = $result->price * ($result->acquisition_tax_rate / 100);
                                    $etc_price = $result->etc_price + $result->tax_price + $result->estate_price;
                                    $realPrice =
                                        $result->price +
                                        $acquisition_tax_price +
                                        $etc_price -
                                        $result->loan_price -
                                        $result->check_price;

                                    $myPrice =
                                        $result->month_price - ($result->loan_price * ($result->loan_rate / 100)) / 12;
                                @endphp
                                <p>실투자금</p>
                                <p class="item_price">{{ number_format($realPrice) }}원</p>
                            </li>
                            <li>
                                <p>월순수익</p>
                                <p class="item_price">
                                    {{ number_format($myPrice) }}원
                                </p>
                            </li>
                            <li>
                                <p>수익률</p>
                                <p class="item_price">{{ round(($myPrice / $realPrice) * 100, 2) }}%</p>
                            </li>
                        </ul>
                    </div>

                    <div class="table_container container_sm">
                        <div class="item_sm">임대 보증금</div>
                        <div class="item_sm">{{ number_format($result->check_price) }}원</div>
                        <div class="item_sm">월임대료</div>
                        <div class="item_sm">{{ number_format($result->month_price) }}원</div>
                        <div class="item_sm">대출금액</div>
                        <div class="item_sm">{{ number_format($result->loan_price) }}원</div>
                        <div class="item_sm">대출이자</div>
                        <div class="item_sm">
                            <span class="txt_point">
                                {{ number_format(($result->loan_price * ($result->loan_rate / 100)) / 12) }}원
                            </span>
                            <span class="gray_basic">금리
                                {{ $result->loan_rate }}%</span>
                        </div>
                        <div class="item_sm">취득세</div>
                        <div class="item_sm">
                            {{ number_format($acquisition_tax_price) }}원
                            <span class="gray_basic">({{ $result->acquisition_tax_rate }}%)</span>
                        </div>
                        <div class="item_sm">기타비용</div>
                        <div class="item_sm">
                            {{ number_format($etc_price) }}원</div>
                    </div>
                </div>

                <!---------------------- m:: 총 자산 현황 s ---------------------->
                <div class="m_inner_wrap only_m">
                    <div class="asset_dashboard_wrap">
                        <div class="ds_item_1">
                            <div class="detail_open_wrap">
                                <label>총 자산 현황</label>
                                <button class="simple_toggle_trigger only_m"><img
                                        src="{{ asset('assets/media/dropdown_arrow.png') }}" class="w_100"></button>
                            </div>

                            <h1>{{ number_format($result->price) }}원</h1>
                            <ul class="main_price_wrap">
                                <li>실투자금<p>{{ number_format($realPrice) }}원</p>
                                </li>
                                <li>월순수익<p>{{ number_format($myPrice) }}원
                                        <span>({{ round(($myPrice / $realPrice) * 100, 2) }}%)</span>
                                    </p>
                                </li>
                            </ul>
                            <div class="detail_price_wrap simple_toggle_layer">
                                <ul class="detail_price">
                                    <li>임대 보증금<p>{{ number_format($result->check_price) }}원</p>
                                    </li>
                                    <li>월임대료<p>{{ number_format($result->month_price) }}원</p>
                                    </li>
                                </ul>
                                <hr>
                                <ul class="detail_price">
                                    <li>대출금액<p>{{ number_format($result->loan_price) }}원</p>
                                    </li>
                                    <li>대출이자<p class="txt_point">
                                            {{ number_format(($result->loan_price * ($result->loan_rate / 100)) / 12) }}원
                                            <span class="gray_basic">금리 {{ $result->loan_rate }}%</span>
                                        </p>
                                    </li>
                                </ul>
                                <hr>
                                <ul class="detail_price">
                                    <li>취득세<p>{{ number_format($acquisition_tax_price) }}원 <span
                                                class="gray_basic">({{ $result->acquisition_tax_rate }}%)</span></p>
                                    </li>
                                    <li>기타비용<p>{{ number_format($etc_price) }}원</p>
                                    </li>
                                </ul>

                                @if ($result->type_detail == 0)
                                    <div class="price_status_box">
                                        <div class="status_item">
                                            <p>평당</p>
                                            <div><span class="status_item_blue">548만원 (10.7%)</span></div>
                                        </div>
                                        <div class="status_item">
                                            <p>시세차익</p>
                                            <div><span class="status_item_red">15,248만원</span></div>
                                        </div>
                                        <div class="status_item">
                                            <p>양도세 납부 후 시세차익</p>
                                            <div><span class="status_item_red">6,935만원</span></div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <!---------------------- m:: 총 자산 현황 s ---------------------->

                @if ($result->type_detail == 0)
                    <div class="price_status_box only_pc">
                        <div class="status_item">
                            <p>평당</p>
                            <div><span class="status_item_blue">548만원 (10.7%)</span></div>
                        </div>
                        <div class="status_item">
                            <p>시세차익</p>
                            <div><span class="status_item_red">15,248만원</span></div>
                        </div>
                        <div class="status_item">
                            <p>양도세 납부 후 시세차익</p>
                            <div><span class="status_item_red">6,935만원</span></div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

        <!-- my_body : s -->
        <div class="inner_mid_wrap">
            <div class="box_01 m_hr_type">
                <h4>기본정보</h4>
                <div class="table_container2 info_table_wrap">
                    <div class="tr_row">
                        <div>주소</div>
                        <div>{{ $result->asset_address->address }}</div>
                        <div>부동산 유형</div>
                        <div>{{ Lang::get('commons.product_type.' . $result->type_detail) }}</div>
                    </div>
                    <div class="tr_row">
                        <div>명의구분</div>
                        <div>{{ Lang::get('commons.asset_name_type.' . $result->name_type) }}</div>
                        <div>사업자구분</div>
                        <div>{{ Lang::get('commons.asset_business_type.' . $result->business_type) }}</div>
                    </div>
                    <div class="tr_row">
                        <div>공급면적</div>
                        <div>{{ $result->square }}㎡<span class="gray_basic">({{ $result->area }}평)</span></div>
                        <div>전용면적</div>
                        <div>{{ $result->exclusive_square }}㎡<span
                                class="gray_basic">({{ $result->exclusive_area }}평)</span></div>
                    </div>
                    <div class="tr_row border_none">
                        <div>계약일자</div>
                        <div>{{ $carbon::parse($result->contracted_at)->format('Y.m.d') }}</div>
                        @if ($result->tran_type == 1)
                            <div>등기일</div>
                            <div>
                                {{ isset($result->registered_at) ? $carbon::parse($result->registered_at)->format('Y.m.d') : '-' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="box_01 m_hr_type">
                <h4>대출정보</h4>
                <div class="table_container2 info_table_wrap">
                    <div class="tr_row">
                        <div>대출금액</div>
                        <div>{{ isset($result->loan_price) ? number_format($result->loan_price) . '원' : '-' }}</div>
                        <div>대출기간</div>
                        <div>{{ isset($result->loan_period) ? $result->loan_period . '개월' : '-' }}</div>
                    </div>
                    <div class="tr_row">
                        <div>대출일자</div>
                        <div>
                            {{ isset($result->loaned_at) ? $carbon::parse($result->loaned_at)->format('Y.m.d') : '-' }}
                        </div>
                        <div>대출방식</div>
                        <div>
                            {{ isset($result->loan_type) ? Lang::get('commons.asset_loan_type.' . $result->loan_type) : '-' }}
                        </div>
                    </div>
                    <div class="tr_row">
                        <div>대출금리</div>
                        <div><span
                                class="txt_point">{{ isset($result->loan_rate) ? $result->loan_rate . '%' : '-' }}</span>
                        </div>
                        <div>월 이자</div>
                        @php
                            if (isset($result->loan_price)) {
                                $loanP = ($result->loan_price * ($result->loan_rate / 100)) / 12;
                            } else {
                                $loanP = 0;
                            }
                        @endphp
                        <div><span
                                class="txt_point">{{ isset($result->loan_price) ? number_format($loanP) . '원' : '-' }}</span>
                        </div>
                    </div>
                    <div class="tr_row border_none">
                        <div>계약일자</div>
                        <div>
                            {{ isset($result->contracted_at) ? $carbon::parse($result->contracted_at)->format('Y.m.d') : '-' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="box_01 m_hr_type">
                <h4>임대차 계약정보</h4>
                <div class="table_container2 info_table_wrap">
                    <div class="tr_row">
                        <div>공실여부</div>
                        <div>{{ Lang::get('commons.asset_vacancy_type.' . $result->is_vacancy) }}</div>
                        <div>계약기간</div>
                        <div>
                            {{ isset($result->tenant_name) ? $carbon::parse($result->started_at)->format('Y.m.d') . '~' . $carbon::parse($result->ended_at)->format('Y.m.d') : '-' }}
                        </div>
                    </div>
                    <div class="tr_row">
                        <div>임차인명</div>
                        <div>{{ isset($result->tenant_name) ? $result->tenant_name : '-' }}</div>
                        <div>임차인 연락처</div>
                        <div>{{ isset($result->tenant_phone) ? format_phone($result->tenant_phone) : '-' }}</div>
                    </div>
                    <div class="tr_row">
                        <div>임대 보증금</div>
                        <div>{{ isset($result->check_price) ? number_format($result->check_price) . '원' : '-' }}</div>
                        <div>월임대료</div>
                        <div>
                            <span class="txt_point">
                                {{ isset($result->month_price) ? number_format($result->month_price) . '원' : '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="tr_row border_none">
                        <div>임대료 납부방법</div>
                        <div>
                            {{ isset($result->tenant_name) ? Lang::get('commons.asset_pay_type.' . $result->pay_type) : '-' }}
                        </div>
                        <div>월세 입금일</div>
                        <div>{{ isset($result->deposit_day) ? '매월 ' . $result->deposit_day : '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="box_01 m_hr_type">
                <h4>등록 서류</h4>
                <div class="download_wrap">
                    <div class="download_item">
                        <div class="flex_between">
                            <span class="fs_16 gray_deep">매매계약서</span>
                            @if (isset($result->sale_images->path))
                                <button class="btn_graylight_ghost btn_sm" type="button"
                                    onclick="location.href='{{ route('api.imagedownload', $result->sale_images->path) }}'">다운</button>
                            @endif
                        </div>
                        <div class="download_img_box">
                            @if (isset($result->sale_images->path))
                                <img src="{{ Storage::url('image/' . $result->sale_images->path) }}"
                                    onclick="imageChange('{{ Storage::url('image/' . $result->sale_images->path) }}');"
                                    style="max-width:200px;">
                            @endif
                        </div>
                    </div>

                    <div class="download_item">
                        <div class="flex_between">
                            <span class="fs_16 gray_deep">사업자등록증</span>
                            @if (isset($result->entre_images->path))
                                <button class="btn_graylight_ghost btn_sm" type="button"
                                    onclick="location.href='{{ route('api.imagedownload', $result->entre_images->path) }}'">다운</button>
                            @endif
                        </div>
                        <div class="download_img_box">
                            @if (isset($result->entre_images->path))
                                <img src="{{ Storage::url('image/' . $result->entre_images->path) }}"
                                    onclick="imageChange('{{ Storage::url('image/' . $result->entre_images->path) }}');"
                                    style="max-width:200px;">
                            @endif
                        </div>
                    </div>

                    <div class="download_item">
                        <div class="flex_between">
                            <span class="fs_16 gray_deep">임대차 계약서</span>
                            @if (isset($result->rental_images->path))
                                <button class="btn_graylight_ghost btn_sm" type="button"
                                    onclick="location.href='{{ route('api.imagedownload', $result->rental_images->path) }}'">다운</button>
                            @endif
                        </div>
                        <div class="download_img_box">
                            @if (isset($result->rental_images->path))
                                <img src="{{ Storage::url('image/' . $result->rental_images->path) }}"
                                    onclick="imageChange('{{ Storage::url('image/' . $result->rental_images->path) }}');"
                                    style="max-width:200px;">
                            @endif
                        </div>
                    </div>

                    <div class="download_item">
                        <div class="flex_between">
                            <span class="fs_16 gray_deep">기타서류</span>
                            @if (isset($result->etc_images->path))
                                <button class="btn_graylight_ghost btn_sm" type="button"
                                    onclick="location.href='{{ route('api.imagedownload', $result->etc_images->path) }}'">다운</button>
                            @endif
                        </div>
                        <div class="download_img_box">
                            @if (isset($result->etc_images->path))
                                <img src="{{ Storage::url('image/' . $result->etc_images->path) }}"
                                    onclick="imageChange('{{ Storage::url('image/' . $result->etc_images->path) }}');"
                                    style="max-width:200px;">
                            @endif
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <!-- my_body : e -->

    </div>

    <!-- 이미지 확대 : s-->
    <div class="modal modal_mid modal_big_document">
        <img src="{{ asset('assets/media/header_btn_close_w.png') }}" class="big_img_close"
            onclick="modal_close('big_document')">
        <img src="{{ asset('assets/media/download_sample_1.png') }}" id="imagePreview" class="big_download">
    </div>
    <div class="md_overlay md_overlay_big_document" onclick="modal_close('big_document')"></div>
    <!-- 이미지 확대 : e-->

    <script>
        function imageChange(src) {
            document.getElementById("imagePreview").src = src;
            modal_open('big_document');
        }

        //기본 토글 이벤트
        $(".proposal_toggle_btn").click(function() {
            $(this).toggleClass("toggled");
            if ($(this).hasClass("toggled")) {
                $(this).css("transform", "rotate(180deg)");
            } else {
                $(this).css("transform", "rotate(0deg)");
            }

            $(".proposal_table_wrap").stop().slideToggle(300);
            return false;
        });
    </script>


</x-layout>
