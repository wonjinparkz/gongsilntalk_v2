<x-layout>
    <!----------------------------- m::header bar : s ----------------------------->
    <div class="m_header">
        <div class="left_area"><a href="javascript:history.go(-1)"><img
                    src="{{ asset('assets/media/header_btn_back.png') }}"></a></div>
        <div class="m_title">마이메뉴</div>
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
                <div class="my_body inner_wrap m_inner_wrap">
                    <h1 class="t_center only_pc">기업 이전 제안서</h1>

                    <div class="flex_between my_body_top">
                        <div class="gray_deep fs_16_v">총 {{ count($proposalList) }}개의 제안서</div>
                        <button class="btn_point btn_sm" type="button" onclick="modal_open('add')">신규 기업 추가</button>
                    </div>


                    <div class="proposal_list_2_wrap mt20">
                        @inject('carbon', 'Carbon\Carbon')

                        @if (count($proposalList) > 0)
                            @foreach ($proposalList as $proposal)
                                <div class="proposal_list_row">
                                    <div class="cursor_pointer"
                                        onclick="location.href='{{ route('www.mypage.corp.proposalproduct.list.view', $proposal->id) }}'">
                                        <h5>{{ $proposal->corp_name }}</h5>
                                        <p class="list_item_1">제안한 매물 <span>{{ count($proposal->products) }}개</span></p>
                                    </div>
                                    <div class="list_item_2">
                                        <span
                                            class="txt_date">{{ $carbon::parse($proposal->created_at)->format('Y.m.d') }}</span>
                                        <div class="gap_8">
                                            <button class="btn_gray_ghost btn_sm" type="button"
                                                onclick="location.href='{{ route('www.mypage.corp.proposal.type.detail.view', [$proposal->id]) }}'"
                                                {{ count($proposal->products) > 0 ? '' : 'disabled' }}>제안서 미리보기</button>
                                            <button class="btn_gray_ghost btn_sm" type="button"
                                                onclick="modal_open('delete_{{ $proposal->id }}')">삭제</button>
                                        </div>
                                        <button class="btn_arrow" type="button"
                                            onclick="location.href='{{ route('www.mypage.corp.proposalproduct.list.view', $proposal->id) }}'"></button>
                                    </div>
                                </div>

                                <form id="deleteForm_{{ $proposal->id }}" method="post"
                                    action="{{ route('www.mypage.proposal.delete') }}">
                                    <input type="hidden" id="id" name="id" value="{{ $proposal->id }}">
                                </form>

                                <!-- modal 삭제 : s -->
                                <div class="modal modal_delete_{{ $proposal->id }}">

                                    <div class="modal_container">
                                        <div class="modal_mss_wrap">
                                            <p class="txt_item_1 txt_point">{{ $proposal->corp_name }}</p>
                                            <p class="txt_item_1">기업을 삭제하시겠습니까?</p>
                                            <p class="mt8 txt_item_2">삭제 후에는 되돌릴 수 없습니다.</p>
                                        </div>

                                        <div class="modal_btn_wrap">
                                            <button class="btn_gray btn_full_thin" type="button"
                                                onclick="modal_close('delete_{{ $proposal->id }}')">취소</button>
                                            <button class="btn_point btn_full_thin" type="button"
                                                onclick="onDeleteFormSubmit('{{ $proposal->id }}');">삭제</button>
                                        </div>
                                    </div>

                                </div>
                                <div class="md_overlay md_overlay_delete_{{ $proposal->id }}"
                                    onclick="modal_close('delete_{{ $proposal->id }}')"></div>
                                <!-- modal 삭제 : e -->
                            @endforeach
                        @else
                            <!-- 데이터가 없을 경우 : s -->
                            <div class="empty_wrap">
                                <p>작성한 기업 이전 제안서가 없습니다.</p>
                                <span>기업 이전 제안서를 작성하고, 쉽게 관리해보세요.</span>
                            </div>
                            <!-- 데이터가 없을 경우 : e -->
                        @endif
                    </div>

                </div>
                <!-- my_body : e -->
            </div>

            <!-- modal 추가 : s -->
            <div class="modal modal_add">
                <form class="form" name="proposal_add" id="proposal_add" method="POST"
                    action="{{ route('www.corp.proposal.create') }}">
                    @csrf
                    <div class="modal_title">
                        <h5>신규 기업 추가</h5>
                        <img src="{{ asset('assets/media/btn_md_close.png') }}" class="md_btn_close"
                            onclick="modal_close('add')">
                    </div>
                    <div class="modal_container">
                        <ul class="reg_bascic">
                            <li>
                                <label>기업명<span>*</span></label>
                                <input type="text" name="corp_name" id="corp_name" placeholder="기업명을 입력해주세요.">
                            </li>
                            <li>
                                <label>중개사 직책 <span>*</span></label>
                                <input type="text" name="position" id="position"
                                    placeholder="제안서에 노출될 중개사의 직책 입력. 예) 대표">
                            </li>
                        </ul>
                        <div class="mt40">
                            <button class="btn_point btn_full_thin proposal_confirm" disabled
                                onclick="modal_close('add')">추가</button>
                        </div>
                    </div>
            </div>
            <div class="md_overlay md_overlay_add" onclick="modal_close('add')"></div>
            <!-- modal 추가 : e -->


        </div>
    </div>
    <script>
        $('#corp_name').on('keyup', function() {
            proposalInputCheck();
        });

        $('#position').on('keyup', function() {
            proposalInputCheck();
        });

        function proposalInputCheck() {
            var corp_name = $('#corp_name').val();
            var position = $('#position').val();
            if (corp_name != '' && position != '') {

                $('.proposal_confirm').attr('disabled', false);
            } else {
                $('.proposal_confirm').attr('disabled', true);
            }
        }

        function onDeleteFormSubmit(id) {
            $('#deleteForm_' + id).submit();
        }
    </script>
</x-layout>
