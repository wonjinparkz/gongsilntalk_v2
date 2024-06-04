<x-layout>

        <!----------------------------- m::header bar : s ----------------------------->
        <div class="m_header">
            <div class="left_area"><a href="javascript:history.go(-1)"><img
                        src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
            <div class="m_title">신규 건물 <span class="gray_basic"><span class="txt_point">2</span>/3</span></div>
            <div class="right_area"></div>
        </div>
        <!----------------------------- m::header bar : s ----------------------------->

        <div class="body">
            <div class="my_inner_wrap">
                <div class="my_wrap">
                    <!-- my_side : s -->
                    <div class="my_side only_pc">
                        <x-mypage-side :result="$user" />
                    </div>
                    <!-- my_side : e -->
                    <!-- my_body : s -->
                    <div class="my_body">
                        <div class="inner_wrap m_inner_wrap">
                            <h1 class="t_center only_pc">제안서 미리보기</h1>
                        </div>

                        <div class="proposal_type_wrap">
                            <!-- tab : s -->
                            <div class="swiper proposal_type_tab">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide btn_radioType active">
                                        <input type="radio" name="proposal_type" id="proposal_type_1" value="Y"
                                            checked>
                                        <label for="proposal_type_1" onclick="showType(0)">스타일1</label>
                                    </div>
                                    <div class="swiper-slide btn_radioType">
                                        <input type="radio" name="proposal_type" id="proposal_type_2" value="Y">
                                        <label for="proposal_type_2" onclick="showType(1)">스타일2</label>
                                    </div>
                                    <div class="swiper-slide btn_radioType">
                                        <input type="radio" name="proposal_type" id="proposal_type_3" value="Y">
                                        <label for="proposal_type_3" onclick="showType(2)">스타일3</label>
                                    </div>
                                    <div class="swiper-slide btn_radioType">
                                        <input type="radio" name="proposal_type" id="proposal_type_4" value="Y">
                                        <label for="proposal_type_4" onclick="showType(3)">스타일4</label>
                                    </div>
                                    <div class="swiper-slide btn_radioType">
                                        <input type="radio" name="proposal_type" id="proposal_type_5" value="Y">
                                        <label for="proposal_type_5" onclick="showType(4)">스타일5</label>
                                    </div>
                                </div>
                            </div>
                            <!-- tab : e -->

                            <div id="type_preview" class="type_view_wrap">
                                <!-- type_1 : s -->
                                <div class="proposal_type_item proposal_type_1 active">
                                    <section class="type_1_1">
                                        <h1>주식회사 에스앤디<br>기업이전제안서</h1>
                                        <p class="txt_item_1">COMPANY RELOCATION PROPOSAL</p>

                                        <div class="type_1_index">
                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">영등포</div>
                                                    <div class="index_number">01</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">신사동</div>
                                                    <div class="index_number">02</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">신사B1-2타워</div>
                                                    <div class="index_item_row">신사SK V1센터</div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_1_page type_1_2">
                                        <h2>01 건물소개</h2>
                                        <h3>영등포 양평자이타워</h3>
                                        <div class="item_wrap">
                                            <div>
                                                <h5>외관</h5>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <h5>위치 : 서울특별시 영등포구 양평동1가 104-1</h5>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_1_page type_1_3">
                                        <h2>01 건물소개</h2>
                                        <h3>영등포 양평자이타워</h3>
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
                                                    <td>100㎡ <span class="gray_basic">(330.579평)</span></td>
                                                </tr>
                                                <tr>
                                                    <th>해당층</th>
                                                    <td>5층/22층</td>
                                                </tr>
                                                <tr>
                                                    <th>입주가능일</th>
                                                    <td>즉시 입주 가능</td>
                                                </tr>
                                                <tr>
                                                    <th>주차 가능 대수</th>
                                                    <td>56대</td>
                                                </tr>
                                                <tr>
                                                    <th>시설정보</th>
                                                    <td>화물용 승강기, 중앙 냉난방,
                                                        업무용, 화물용 승강기, 테라스,
                                                        베란다, 인테리어</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>특장점</th>
                                                    <td>- 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳<br><br>
                                                        - 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳</td>
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
                                                    <td>170,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>프리미엄</th>
                                                    <td>30,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>지원금액(인테리어 등)</th>
                                                    <td>0원</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>요청사항</th>
                                                    <td>요청사항을 작성해주세요. 요청사항이 없을 시에는 ‘-’로
                                                        표시됩니다.</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </section>

                                    <section class="type_1_page type_1_3">
                                        <h2>02 도면 및 사진</h2>
                                        <div class="item_3_wrap">
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_1_page type_1_4">
                                        <h2>03 견적서</h2>
                                        <div class="item_4_wrap">
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 1</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="45%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 2</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="45%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_1_page type_1_5">
                                        <div class="txt_item_end">Thank You</div>
                                        <div class="end_company_wrap">
                                            <div>
                                                <p class="txt_item_1">철인오산센터부동산중개</p>
                                                <p class="txt_item_2">대표 국승현</p>
                                            </div>
                                            <div>
                                                <p class="txt_item_1">01012341234</p>
                                                <p class="txt_item_1">ksh92@naver.com</p>
                                            </div>
                                            <p class="txt_item_3">경기 화성시 동탄첨단산업1로 20 105호</p>
                                        </div>
                                    </section>
                                </div>
                                <!-- type_1 : e -->

                                <!-- type_2 : s -->
                                <div class="proposal_type_item proposal_type_2">
                                    <section class="type_1_page type_2_1">
                                        <h1>주식회사 에스앤디<br>기업이전제안서</h1>
                                        <p class="txt_item_1">COMPANY RELOCATION PROPOSAL</p>
                                    </section>

                                    <section class="type_2_page type_2_1">
                                        <h2>목차</h2>
                                        <div class="type_2_index">
                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">영등포</div>
                                                    <div class="index_number">01</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">대치동</div>
                                                    <div class="index_number">02</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">가산동</div>
                                                    <div class="index_number">03</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">신사동</div>
                                                    <div class="index_number">04</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">영등포</div>
                                                    <div class="index_number">05</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_3_page type_2_1">
                                        <h2>01 건물소개</h2>
                                        <h3>영등포 양평자이타워</h3>
                                        <div class="item_wrap">
                                            <div class="item_wrap_box">
                                                <div class="item_info">
                                                    <h5>외관</h5>
                                                </div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                            </div>
                                            <div class="item_wrap_box">
                                                <div class="item_info">
                                                    <h5>위치</h5>
                                                    <p>서울특별시 영등포구 양평동1가 104-1</p>
                                                </div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_3_page type_2_1">
                                        <h2>01 건물소개</h2>
                                        <h3>영등포 양평자이타워</h3>
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
                                                    <td>100㎡ <span class="gray_basic">(330.579평)</span></td>
                                                </tr>
                                                <tr>
                                                    <th>해당층</th>
                                                    <td>5층/22층</td>
                                                </tr>
                                                <tr>
                                                    <th>입주가능일</th>
                                                    <td>즉시 입주 가능</td>
                                                </tr>
                                                <tr>
                                                    <th>주차 가능 대수</th>
                                                    <td>56대</td>
                                                </tr>
                                                <tr>
                                                    <th>시설정보</th>
                                                    <td>화물용 승강기, 중앙 냉난방,
                                                        업무용, 화물용 승강기, 테라스,
                                                        베란다, 인테리어</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>특장점</th>
                                                    <td>- 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳<br><br>
                                                        - 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳</td>
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
                                                    <td>170,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>프리미엄</th>
                                                    <td>30,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>지원금액(인테리어 등)</th>
                                                    <td>0원</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>요청사항</th>
                                                    <td>요청사항을 작성해주세요. 요청사항이 없을 시에는 ‘-’로
                                                        표시됩니다.</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </section>

                                    <section class="type_3_page type_2_1">
                                        <h2>02 도면 및 사진</h2>
                                        <div class="item_3_wrap">
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_3_page type_2_1">
                                        <h2>03 견적서</h2>
                                        <div class="item_4_wrap">
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 1</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="50%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 2</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="50%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_3_page type_2_5">
                                        <div class="txt_item_end">
                                            감사합니다
                                            <p>Thank you</p>
                                        </div>
                                        <div class="end_company_wrap">
                                            <div>
                                                <p class="txt_item_1">철인오산센터부동산중개</p>
                                                <p class="txt_item_2">대표 국승현</p>
                                            </div>
                                            <div>
                                                <p class="txt_item_1">01012341234</p>
                                                <p class="txt_item_1">ksh92@naver.com</p>
                                            </div>
                                            <p class="txt_item_3">경기 화성시 동탄첨단산업1로 20 105호</p>
                                        </div>
                                    </section>

                                </div>
                                <!-- type_2 : e -->

                                <!-- type_3 : s -->
                                <div class="proposal_type_item proposal_type_3">
                                    <section class="type_3_1">
                                        <div class="ghost_box">
                                            <div>
                                                <h1>주식회사 에스앤디<br>기업이전제안서</h1>
                                                <p class="txt_item_1">COMPANY RELOCATION PROPOSAL</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_3_2">
                                        <h2>목차</h2>
                                        <div class="type_3_index">
                                            <div class="index_item">
                                                <div class="index_number">01</div>
                                                <div class="index_list">
                                                    <div class="index_name">영등포</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_number">02</div>
                                                <div class="index_list">
                                                    <div class="index_name">가산동</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_number">03</div>
                                                <div class="index_list">
                                                    <div class="index_name">대치동</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_number">04</div>
                                                <div class="index_list">
                                                    <div class="index_name">대치동</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_number">05</div>
                                                <div class="index_list">
                                                    <div class="index_name">개포동</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page type_3_3">
                                        <h2>01 건물소개</h2>
                                        <h3>영등포 양평자이타워</h3>
                                        <div class="item_wrap">
                                            <div class="item_wrap_box">
                                                <div class="item_info">
                                                    <h5>외관</h5>
                                                </div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                            </div>
                                            <div class="item_wrap_box">
                                                <div class="item_info">
                                                    <h5>위치</h5>
                                                    <p>서울특별시 영등포구 양평동1가 104-1</p>
                                                </div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page type_3_4">
                                        <h2>01 건물소개</h2>
                                        <h3>영등포 양평자이타워</h3>
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
                                                    <td>100㎡ <span class="gray_basic">(330.579평)</span></td>
                                                </tr>
                                                <tr>
                                                    <th>해당층</th>
                                                    <td>5층/22층</td>
                                                </tr>
                                                <tr>
                                                    <th>입주가능일</th>
                                                    <td>즉시 입주 가능</td>
                                                </tr>
                                                <tr>
                                                    <th>주차 가능 대수</th>
                                                    <td>56대</td>
                                                </tr>
                                                <tr>
                                                    <th>시설정보</th>
                                                    <td>화물용 승강기, 중앙 냉난방,
                                                        업무용, 화물용 승강기, 테라스,
                                                        베란다, 인테리어</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>특장점</th>
                                                    <td>- 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳<br><br>
                                                        - 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳</td>
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
                                                    <td>170,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>프리미엄</th>
                                                    <td>30,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>지원금액(인테리어 등)</th>
                                                    <td>0원</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>요청사항</th>
                                                    <td>요청사항을 작성해주세요. 요청사항이 없을 시에는 ‘-’로
                                                        표시됩니다.</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </section>

                                    <section class="type_page type_3_5">
                                        <h2>02 도면 및 사진</h2>
                                        <div class="item_3_wrap">
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page type_3_5">
                                        <h2>03 견적서</h2>
                                        <div class="item_4_wrap">
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 1</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="45%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 2</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="45%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_3_1">
                                        <div class="ghost_end_box">
                                            <div class="end_company_wrap">
                                                <div>
                                                    <p class="txt_item_1">철인오산센터부동산중개</p>
                                                    <p class="txt_item_2">대표 국승현</p>
                                                </div>
                                                <div>
                                                    <p class="txt_item_1">01012341234</p>
                                                    <p class="txt_item_1">ksh92@naver.com</p>
                                                </div>
                                                <p class="txt_item_3">경기 화성시 동탄첨단산업1로 20 105호</p>
                                            </div>
                                            <div class="txt_item_end">Thank you</div>
                                        </div>
                                    </section>
                                </div>
                                <!-- type_3 : e -->

                                <!-- type_4 : s -->
                                <div class="proposal_type_item proposal_type_4">
                                    <section class="type_4_1">
                                        <div class="ghost_box">
                                            <h1>주식회사 에스앤디<br>기업이전제안서</h1>
                                            <p class="txt_item_1">COMPANY RELOCATION PROPOSAL</p>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>목차</h2>
                                            <p>COMPANY RELOCATION PROPOSAL</p>
                                        </div>

                                        <div class="type_4_index">
                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">영등포</div>
                                                    <div class="index_number">01</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">대치동</div>
                                                    <div class="index_number">02</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">가산동</div>
                                                    <div class="index_number">03</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">신사동</div>
                                                    <div class="index_number">04</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_tit">
                                                    <div class="index_name">영등포</div>
                                                    <div class="index_number">05</div>
                                                </div>
                                                <div class="index_item_list">
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                    <div class="index_item_row">영등포 양평자이타워</div>
                                                    <div class="index_item_row">금강펜테리움IT타워</div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>01 건물소개</h2>
                                            <p>COMPANY RELOCATION PROPOSAL</p>
                                        </div>
                                        <h3>영등포 양평자이타워</h3>
                                        <div class="item_wrap">
                                            <div class="item_wrap_box">
                                                <h5>외관</h5>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                                <p class="txt_info">양평자이타워 외관</p>
                                            </div>
                                            <div class="item_wrap_box">
                                                <h5>위치</h5>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                                <p class="txt_info">서울특별시 영등포구 양평동1가 104-1</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>01 건물소개</h2>
                                            <p>COMPANY RELOCATION PROPOSAL</p>
                                        </div>
                                        <h3>영등포 양평자이타워</h3>
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
                                                    <td>100㎡ <span class="gray_basic">(330.579평)</span></td>
                                                </tr>
                                                <tr>
                                                    <th>해당층</th>
                                                    <td>5층/22층</td>
                                                </tr>
                                                <tr>
                                                    <th>입주가능일</th>
                                                    <td>즉시 입주 가능</td>
                                                </tr>
                                                <tr>
                                                    <th>주차 가능 대수</th>
                                                    <td>56대</td>
                                                </tr>
                                                <tr>
                                                    <th>시설정보</th>
                                                    <td>화물용 승강기, 중앙 냉난방,
                                                        업무용, 화물용 승강기, 테라스,
                                                        베란다, 인테리어</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>특장점</th>
                                                    <td>- 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳<br><br>
                                                        - 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳</td>
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
                                                    <td>170,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>프리미엄</th>
                                                    <td>30,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>지원금액(인테리어 등)</th>
                                                    <td>0원</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>요청사항</th>
                                                    <td>요청사항을 작성해주세요. 요청사항이 없을 시에는 ‘-’로
                                                        표시됩니다.</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>02 도면 및 사진</h2>
                                            <p>COMPANY RELOCATION PROPOSAL</p>
                                        </div>
                                        <div class="item_3_wrap">
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>03 견적서</h2>
                                            <p>COMPANY RELOCATION PROPOSAL</p>
                                        </div>
                                        <div class="item_4_wrap">
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 1</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="45%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 2</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="45%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_4_1">
                                        <div class="ghost_box">
                                            <div class="txt_item_end">
                                                Thank you
                                            </div>
                                            <div class="end_company_wrap">
                                                <div>
                                                    <p class="txt_item_1">철인오산센터부동산중개</p>
                                                    <p class="txt_item_2">대표 국승현</p>
                                                </div>
                                                <div>
                                                    <p class="txt_item_1">01012341234</p>
                                                    <p class="txt_item_1">ksh92@naver.com</p>
                                                </div>
                                                <p class="txt_item_3">경기 화성시 동탄첨단산업1로 20 105호</p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <!-- type_4 : e -->

                                <!-- type_5 : s -->
                                <div class="proposal_type_item proposal_type_5 ">
                                    <section class="type_5_1">
                                        <div class="ghost_box">
                                            <p class="txt_item_1">COMPANY RELOCATION PROPOSAL</p>
                                            <h1>주식회사 에스앤디<br>기업이전제안서</h1>
                                            <div>
                                                <p class="txt_item_2">대표 국승현</p>
                                                <p class="txt_item_3">철인오산센터부동산중개</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>목차</h2>
                                        </div>
                                        <div class="type_5_index">
                                            <div class="index_item">
                                                <div class="index_number">01</div>
                                                <div class="index_list">
                                                    <div class="index_name">영등포</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_number">02</div>
                                                <div class="index_list">
                                                    <div class="index_name">가산동</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_number">03</div>
                                                <div class="index_list">
                                                    <div class="index_name">대치동</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_number">04</div>
                                                <div class="index_list">
                                                    <div class="index_name">대치동</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="index_item">
                                                <div class="index_number">05</div>
                                                <div class="index_list">
                                                    <div class="index_name">개포동</div>
                                                    <div class="index_item_list">
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                        <div class="index_item_row">영등포 양평자이타워</div>
                                                        <div class="index_item_row">금강펜테리움IT타워</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page type_5_3">
                                        <div class="header">
                                            <h2>01 건물소개</h2>
                                        </div>
                                        <h3>영등포 양평자이타워</h3>
                                        <div class="item_wrap">
                                            <div class="item_wrap_box">
                                                <h5>외관</h5>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                                <p class="txt_info">양평자이타워 외관</p>
                                            </div>
                                            <div class="item_wrap_box">
                                                <h5>위치</h5>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                                <p class="txt_info">서울특별시 영등포구 양평동1가 104-1</p>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>01 건물소개</h2>
                                        </div>
                                        <h3>영등포 양평자이타워</h3>
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
                                                    <td>100㎡ <span class="gray_basic">(330.579평)</span></td>
                                                </tr>
                                                <tr>
                                                    <th>해당층</th>
                                                    <td>5층/22층</td>
                                                </tr>
                                                <tr>
                                                    <th>입주가능일</th>
                                                    <td>즉시 입주 가능</td>
                                                </tr>
                                                <tr>
                                                    <th>주차 가능 대수</th>
                                                    <td>56대</td>
                                                </tr>
                                                <tr>
                                                    <th>시설정보</th>
                                                    <td>화물용 승강기, 중앙 냉난방,
                                                        업무용, 화물용 승강기, 테라스,
                                                        베란다, 인테리어</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>특장점</th>
                                                    <td>- 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳<br><br>
                                                        - 양평역과 영등포구청역 사이에 있는 건물로, 대로변에서
                                                        바로 진입이 가능한 곳</td>
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
                                                    <td>170,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>프리미엄</th>
                                                    <td>30,000,000원</td>
                                                </tr>
                                                <tr>
                                                    <th>지원금액(인테리어 등)</th>
                                                    <td>0원</td>
                                                </tr>
                                            </table>

                                            <table class="proposal_section_table">
                                                <colgroup>
                                                    <col width="20%">
                                                    <col width="*">
                                                </colgroup>
                                                <tr>
                                                    <th>요청사항</th>
                                                    <td>요청사항을 작성해주세요. 요청사항이 없을 시에는 ‘-’로
                                                        표시됩니다.</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>02 도면 및 사진</h2>
                                        </div>
                                        <div class="item_3_wrap">
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_3.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="item_img">
                                                    <div class="img_box"><img src="images/s_7.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_page">
                                        <div class="header">
                                            <h2>03 견적서</h2>
                                        </div>
                                        <div class="item_4_wrap">
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 1</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="45%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="item_div">
                                                <h4>영등포 양평자이타워 견적서 2</h4>
                                                <table class="proposal_section_table_2">
                                                    <colgroup>
                                                        <col width="7%">
                                                        <col width="45%">
                                                        <col width="*">
                                                    </colgroup>
                                                    <tr>
                                                        <th>1</th>
                                                        <th>매매가</th>
                                                        <td>1,700,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>2</th>
                                                        <th>매매가</th>
                                                        <td>1,360,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>3</th>
                                                        <th>대출금리</th>
                                                        <td>5.7%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>4</th>
                                                        <th>월 이자 상환액 <p class="txt_item_1">대출금×대출금리/12</p>
                                                        </th>
                                                        <td>6,460,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>5</th>
                                                        <th>취득세 <p class="txt_item_1">매매가(분양가)×취득세율</p>
                                                        </th>
                                                        <td>39,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>6</th>
                                                        <th>기타비용</th>
                                                        <td>305,100,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>7</th>
                                                        <th>보증금</th>
                                                        <td>50,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>8</th>
                                                        <th>월임대료</th>
                                                        <td>3,000,000원</td>
                                                    </tr>
                                                    <tr>
                                                        <th>9</th>
                                                        <th>실투자금 <p class="txt_item_1">매매가+취득세+기타비용-대출금-보증금</p>
                                                        </th>
                                                        <td><span class="txt_item_2">634,200,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>10</th>
                                                        <th>월순수익 <p class="txt_item_1">월임대료-대출 월이자</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-3,460,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>11</th>
                                                        <th>연수익률 <p class="txt_item_1">월수익×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-41,520,000원</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>12</th>
                                                        <th>연수익률 <p class="txt_item_1">연수익/투자금×12</p>
                                                        </th>
                                                        <td><span class="txt_item_2">-6.55%</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>13</th>
                                                        <th>실투자금 회수 기간<p class="txt_item_1">실투자금/월순수익</p>
                                                        </th>
                                                        <td>0년</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="type_5_1 type_5_end">
                                        <div class="ghost_end_box">
                                            <div class="txt_item_end">
                                                Thank you
                                            </div>
                                            <div class="end_company_wrap">
                                                <div>
                                                    <p class="txt_item_1">철인오산센터부동산중개</p>
                                                    <p class="txt_item_2">대표 국승현</p>
                                                </div>
                                                <div>
                                                    <p class="txt_item_1">01012341234</p>
                                                    <p class="txt_item_1">ksh92@naver.com</p>
                                                </div>
                                                <p class="txt_item_3">경기 화성시 동탄첨단산업1로 20 105호</p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <!-- type_5 : e -->
                            </div>

                        </div>


                    </div>
                    <!-- my_body : e -->

                </div>


            </div>
        </div>

        <script>
            //탭 보기
            function showType(index) {
                var type_preview = document.querySelectorAll('.type_view_wrap .proposal_type_item');
                type_preview.forEach(function(content) {
                    content.classList.remove('active');
                });
                type_preview[index].classList.add('active');
            }

            //탭 스와이프
            var proposal_type_tab = new Swiper(".proposal_type_tab", {
                slidesPerView: 'auto',
                spaceBetween: 8,
                freeMode: true,
                breakpointsInverse: true,
                breakpoints: {
                    1023: {
                        allowTouchMove: false
                    }
                }
            });
        </script>

</x-layout>
