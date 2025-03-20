<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="{{ route('www.mypage.alarm.list.view') }}"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">매물 제안서 목록</div>
        <div class="right_area"></div>
    </div>
    <!----------------------------- m::header bar : s ----------------------------->

    <div class="body">
        @inject('carbon', 'Carbon\Carbon')
        <div class="my_inner_wrap">
            <div class="my_wrap">
                <!-- my_side : s -->
                <div class="my_side only_pc">
                    <x-mypage-side :result="$user" />
                </div>
                <!-- my_side : e -->

                <!-- my_body : s -->
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">매물 제안서 목록</h1>

                    <div class="flex_between my_body_top">
                        <div class="gray_deep fs_16_v">총 {{ count($proposalList) }}개의 제안서</div>
                        <button class="btn_point btn_sm"
                            onclick="location.href='{{ route('www.mypage.user.offer.first.create.view') }}'">신규 매물 제안서
                            받기</button>
                    </div>
                    <p class="gray_basic fs_14_v mt18">*최대 7일까지만 보관됩니다.</p>

                    @if (count($proposalList) < 1)
                        <!-- 데이터가 없을 경우 : s -->
                        <div class="empty_wrap">
                            <p>받은 매물 제안서가 없습니다.</p>
                            <span>매물 제안서를 작성하고, 원하는 조건의 매물을 찾아보세요.</span>
                        </div>
                        <!-- 데이터가 없을 경우 : e -->
                    @else
                        @foreach ($proposalList as $proposal)
                            <div class="proposal_list">
                                <div class="box_01">
                                    <div class="proposal_row">
                                        <div class="proposal_item_1 cursor_pointer"
                                            onclick="location.href='{{ route('www.mypage.proposal.offer.detail.view', [$proposal->id]) }}'">
                                            <h4>{{ $proposal->title }}</h4>
                                            <p class="txt_item_1">제안된 매물 <span
                                                    class="txt_point">{{ count($proposal->products) }}개</span></p>
                                        </div>
                                        <div class="proposal_item_2">
                                            <span
                                                class="txt_date">{{ $carbon::parse($proposal->created_at)->format('Y.m.d') }}</span>
                                            <button class="btn_gray_ghost btn_sm"
                                                onclick="modal_open('delete_{{ $proposal->id }}')">삭제</button>
                                        </div>
                                    </div>
                                    {{-- m 공유버튼 --}}
                                    <div class="proposal_m_btn only_m"><!-- m -->
                                        <button class="btn_gray_ghost btn_sm_full"
                                            onclick="modal_open_slide('share_{{ $proposal->id }}')">공유하기</button>
                                        <button class="btn_gray_ghost btn_sm_full"
                                            onclick="modal_open('delete_{{ $proposal->id }}')">삭제</button>
                                    </div>

                                    <div class="modal_slide modal_slide_share_{{ $proposal->id }}">
                                        <div class="slide_title_wrap">
                                            <span>공유하기</span>
                                            <img src="{{ asset('assets/media/btn_md_close.png') }}"
                                                onclick="modal_close_slide('share_{{ $proposal->id }}')">
                                        </div>
                                        <div class="slide_modal_body">
                                            <div class="layer_share_con">
                                                @php
                                                    $cleaned_content = strip_tags(
                                                        html_entity_decode($proposal->content),
                                                    );
                                                    $cleaned_content = preg_replace("/\r|\n/", ' ', $cleaned_content);

                                                    $shortened_content =
                                                        mb_strlen($cleaned_content) > 50
                                                            ? mb_substr($cleaned_content, 0, 50) . '...'
                                                            : $cleaned_content;
                                                @endphp
                                                <a class="kakaotalk-sharing-btn"
                                                    onclick="modal_close_slide('share_{{ $proposal->id }}');"
                                                    data-title="{{ $proposal->title }}"
                                                    data-description="{{ $shortened_content }}"
                                                    data-m_link="{{ env('APP_URL') }}/share/proposal/detail?id={{ $proposal->id }}"
                                                    data-pc_link="{{ env('APP_URL') }}/share/proposal/detail?id={{ $proposal->id }}">
                                                    <img src="{{ asset('assets/media/share_ic_01.png') }}">
                                                    <p class="mt8">카카오톡</p>
                                                </a>
                                                <a
                                                    onclick="textCopy('{{ env('APP_URL') }}/share/proposal/detail?id={{ $proposal->id }}');modal_close_slide('share_{{ $proposal->id }}');">
                                                    <img src="{{ asset('assets/media/share_ic_02.png') }}">
                                                    <p class="mt8">링크복사</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md_slide_overlay md_slide_overlay_share_{{ $proposal->id }}"
                                        onclick="modal_close_slide('share_{{ $proposal->id }}')"></div>
                                    {{-- m 공유 버튼 --}}
                                    <div class="table_container mt18 only_pc">
                                        <div>희망 지역</div>
                                        <div>
                                            @foreach ($proposal->regions as $key => $region)
                                                @if ($key != 0)
                                                    ,
                                                @endif
                                                {{ $region->city_name }} {{ $region->region_name }}
                                            @endforeach
                                        </div>

                                        @if ($proposal->type == 0)
                                            <div>희망 업종</div>
                                            <div>
                                                {{ Lang::get('commons.product_business_type.' . $proposal->business_type) }}
                                            </div>
                                        @else
                                            <div>사용인원</div>
                                            <div>{{ number_format($proposal->users_count) }}명</div>
                                        @endif
                                        <div>희망 면적</div>
                                        <div>{{ $proposal->square }}㎡<span
                                                class="gray_basic">({{ $proposal->area }}평)</span></div>
                                        <div>예산</div>
                                        <div>
                                            {{ $proposal->payment_type == 0 ? '매매 ' . Commons::get_priceTrans($proposal->price) : '월세 ' . Commons::get_priceTrans($proposal->price) . ' / ' . Commons::get_priceTrans($proposal->month_price) }}
                                        </div>
                                        @if ($proposal->type == 0)
                                            <div>희망 상가 층</div>
                                            <div>{{ Lang::get('commons.floor_type.' . $proposal->floor_type) }}</div>
                                        @endif
                                        <div>입주가능일</div>
                                        <div>
                                            {{ $proposal->move_type != 2 ? Lang::get('commons.move_type.' . $proposal->move_type) : $carbon::parse($proposal->start_move_date)->format('Y.m.d') . ' ~ ' . $carbon::parse($proposal->ended_move_date)->format('Y.m.d') }}
                                        </div>
                                        <div>인테리어 유무</div>
                                        <div>{{ Lang::get('commons.interior_type.' . $proposal->interior_type) }}</div>
                                        <div>요청사항</div>
                                        <div {{ $proposal->type != 0 ? 'class=item_col_3' : '' }}>
                                            {{ $proposal->content ?? '-' }}</div>
                                    </div>
                                </div>
                            </div>

                            <!-- modal 삭제 : s -->
                            <div class="modal modal_delete_{{ $proposal->id }}">

                                <div class="modal_container">
                                    <div class="modal_mss_wrap">
                                        <p class="txt_item_1 txt_point">{{ $proposal->title }}</p>
                                        <p class="txt_item_1">제안서를 삭제하시겠습니까?</p>
                                        <p class="mt8 txt_item_2">삭제 후에는 되돌릴 수 없습니다.</p>
                                    </div>

                                    <div class="modal_btn_wrap">
                                        <button class="btn_gray btn_full_thin" type="button"
                                            onclick="modal_close('delete_{{ $proposal->id }}')">취소</button>
                                        <button class="btn_point btn_full_thin" type="button"
                                            onclick="onProposalDelete('{{ $proposal->id }}')">삭제</button>

                                        <form id="deleteForm_{{ $proposal->id }}" method="POST"
                                            action="{{ route('www.mypage.user.offer.delete') }}">
                                            <input type="hidden" id="deleteId" name="deleteId"
                                                value="{{ $proposal->id }}">
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="md_overlay md_overlay_delete_{{ $proposal->id }}"
                                onclick="modal_close('delete_{{ $proposal->id }}')"></div>
                            <!-- modal 삭제 : e -->
                        @endforeach
                    @endif
                </div>
                <!-- my_body : e -->
            </div>
        </div>
    </div>


</x-layout>

<script>
    function onProposalDelete(id) {
        $('#deleteForm_' + id).submit();
    }

    // 주소 복사
    var textCopy = (url) => {
        window.navigator.clipboard.writeText(url).then(() => {
            alert("링크가 복사 되었습니다.");
        });
    };

    // 카카오톡 공유하기 버튼

    // 리스트에서 처리한 방식
    // 이벤트 바인딩 (중복 방지 처리)
    $(document).off('click', '.kakaotalk-sharing-btn').on('click', '.kakaotalk-sharing-btn', function(event) {
        event.preventDefault();

        // 클릭한 버튼의 데이터 읽기
        var $button = $(this);
        var title = $button.data('title');
        var description = $button.data('description').toString();
        var m_link = $button.data('m_link');
        var pc_link = $button.data('pc_link');

        // Kakao 공유 호출
        Kakao.Share.sendDefault({
            objectType: "feed",
            content: {
                title: title,
                description: description,
                imageUrl: "",
                link: {
                    mobileWebUrl: m_link,
                    webUrl: pc_link
                }
            }
        });
    });
</script>
