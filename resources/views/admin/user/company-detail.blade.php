<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'회원 상세'">
            {{-- FORM START  --}}
            {{-- <form class="form" method="POST" action="{{ route('admin.notice.update') }}"> --}}
            <form action="{{ route('admin.company.update.state') }}" id="approve" method="POST">
                @csrf
                {{-- FORM START  --}}
                <input type="hidden" name="lasturl" value="{{ URL::previous() }}">
                {{-- 아이디 --}}
                <input type="hidden" name="id" value="{{ $result->id ?? null }}" />
                {{-- 승인 상태 --}}
                <input type="hidden" id="state" name="state" value="0" />
                {{-- 거절사유  --}}
                <input type="hidden" id="refuse_coment" name="refuse_coment" value="" />
            </form>

            <form class="form" method="POST" action="#">
                @csrf
                <input type="hidden" name="lasturl" value="{{ URL::previous() }}">
                {{-- 사용자 아이디 --}}
                <input type="hidden" name="id" value="{{ $result->id }}" />
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    <div class="row">

                        {{-- ID --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">ID</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid" placeholder="아이디"
                                    value="{{ $result->email }}" />
                            </div>
                        </div>

                        {{-- 담당자 이름 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">담당자 이름</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="담당자 이름" value="{{ $result->name }}" />
                            </div>
                        </div>

                        {{-- 담당자 전화번호 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">담당자 전화번호</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="담당자 전화번호" value="{{ $result->phone }}" />
                            </div>
                        </div>

                        {{-- 중개사무소명 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">중개사무소명</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="중개사무소명" value="{{ $result->company_name }}" />
                            </div>
                        </div>

                        {{-- 대표 전화번호 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">대표 전화번호</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="대표 전화번호" value="{{ $result->company_phone }}" />
                            </div>
                        </div>


                        {{-- 중개사무소 주소지 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">중개사무소 주소지</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="중개사무소 주소지"
                                    value="{{ $result->company_address . $result->company_address_detail }}" />
                            </div>
                        </div>

                        {{-- 사업자 등록 번호 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">사업자 등록 번호</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="사업자 등록 번호" value="{{ $result->company_number }}" />
                            </div>
                        </div>

                        {{-- 사업자 등록증 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">사업자 등록증</label>
                            <div class="row-lg-8 fv-row">
                                <button type="button">
                                    다운로드
                                </button>
                            </div>
                        </div>

                        {{-- 증개 등록 번호 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">증개 등록 번호</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="증개 등록 번호" value="{{ $result->brokerage_number }}" />
                            </div>
                        </div>

                        {{-- 중개 등록증 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">중개 등록증</label>
                            <div class="row-lg-8 fv-row">
                                <button type="button">
                                    다운로드
                                </button>
                            </div>
                        </div>


                        {{-- 개업일 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">개업일</label>
                            <div class="row-lg-8 fv-row">
                                @inject('carbon', 'Carbon\Carbon')
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="개업일"
                                    value="{{ $carbon::parse($result->opening_date)->format('Y.m.d') }}" />
                            </div>
                        </div>


                        {{-- 가입일 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">가입일</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="가입일"
                                    value="{{ $carbon::parse($result->created_at)->format('Y.m.d') }}" />
                            </div>
                        </div>

                        {{-- 마케팅 수신 동의 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">마케팅 수신 동의</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="마케팅 수신 동의"
                                    value="{{ $result->is_marketing ? $carbon::parse($result->marketing_at)->format('Y.m.d') : '-' }}" />
                            </div>
                        </div>

                        {{-- 승인 상태 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">승인 상태</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="승인 상태"
                                    value="{{ Lang::get('commons.company_state.' . $result->company_state) }}" />
                            </div>
                        </div>

                        {{-- 반려 처리 일시 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">반려 처리 일시</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="반려 처리 일시"
                                    value="{{ $result->refuse_at ? $carbon::parse($result->refuse_at)->format('Y.m.d') : '-' }}" />
                            </div>
                        </div>

                        {{-- 반려 처리 사유 --}}
                        <div class="col-lg-12 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">반려 처리 사유</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="반려 처리 사유" value="{{ $result->refuse_coment ?? '-' }}" />
                            </div>
                        </div>


                    </div>

                </div>
                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <a href="javascript:rejectAlert();" class="btn btn-danger me-5">반려</a>
                    <a href="javascript:approveAlert();" class="btn btn-primary me-5">검수 완료</a>
                </div>
                {{-- Footer END --}}
            </form>
            {{-- FORM END --}}

        </x-screen-card>
    </div>

    {{--
           * 페이지에서 사용하는 자바스크립트
        --}}
    <script>
        var hostUrl = "assets/";

        // 승인 물음
        function approveAlert() {
            Swal.fire({
                html: "회원 가입을 승인 하시겠습니까?",
                dangerMode: false,
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonText: "취소",
                confirmButtonText: "승인",
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-secondary"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    $('#state').val('1');
                    $('#approve').submit();
                }
            });
        }

        // 거절 물음
        function rejectAlert() {
            Swal.fire({
                html: "반려 하시겠습니까?<br>반려 사유를 입력해주세요.",
                dangerMode: false,
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonText: "취소",
                confirmButtonText: "반려처리",
                input: 'textarea',
                inputPlaceholder: '반려 사유를 입력해주세요.',
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    $('#refuse_coment').val(result.value);
                    $('#state').val('2');
                    $('#approve').submit();

                }
            });
        }
    </script>
</x-admin-layout>
