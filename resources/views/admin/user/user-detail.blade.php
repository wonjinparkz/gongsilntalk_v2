<x-admin-layout>
    @inject('carbon', 'Carbon\Carbon')
    <div class="app-container container-xxl">
        <x-screen-card :title="'회원 상세'">

            {{-- 내용 START --}}
            <div class="card-body border-top p-9">
                <div class="row">

                    <div class="row-lg-12 mb-10">
                        <div class="symbol symbol-150px symbol-circle mb-5">
                            @if ($result->images != null)
                                @foreach ($result->images as $image)
                                    <img src="{{ Storage::url('image/' . $image->path) }}" />
                                @endforeach
                            @else
                                <img src="{{ asset('assets/media/default_user.png') }}" />
                            @endif

                        </div>
                        <div class="col-lg-2 justify-content-center">
                            @if ($result->state == 0)
                                <div class="badge badge-light-success">
                                    사용가능
                                </div>
                            @elseif ($result->state == 1)
                                <div class="badge badge-light-warning">
                                    사용불가능
                                </div>
                            @else
                                <div class="badge badge-light-danger">
                                    탈퇴
                                </div>
                            @endif

                            @php
                                $lastUsedAt = Carbon::parse($result->last_used_at);
                                $now = Carbon::now();
                            @endphp
                            {{-- 상태 뱃지 --}}
                            @if ($now->diffInMinutes($lastUsedAt) < 5)
                                <div class="badge badge-light-success">
                                    온라인
                                </div>
                            @else
                                <div class="badge badge-light-danger">
                                    오프라인
                                </div>
                            @endif
                        </div>

                    </div>

                    {{-- 아이디 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">사용자 아이디</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="아이디"
                                value="{{ $result->email }}" />
                        </div>
                    </div>

                    {{-- 이름 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">사용자 이름</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="이름"
                                value="{{ $result->name }}" />
                        </div>
                    </div>

                    {{-- 가입유형 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">사용자 가입유형</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="가입유형"
                                value="{{ Lang::get('commons.provider.' . $result->provider) }}" />
                        </div>
                    </div>

                    {{-- 전화번호 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">전화번호</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="전화번호"
                                value="{{ $result->phone }}" />
                        </div>
                    </div>

                    {{-- 성별 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">성별</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="성별"
                                value="{{ $result->gender == 0 ? '남성' : '여성' }}" />
                        </div>
                    </div>

                    {{-- 생년월일 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">생년월일</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="생년월일"
                                value="{{ $result->birth }}" />
                        </div>
                    </div>

                    {{-- 회원 상태 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">회원 상태</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="회원 상태"
                                value="@if ($result->state == 0) 이용중 @elseif($result->state == 1) @else 회원탈퇴 @endif" />
                        </div>
                    </div>

                    {{-- 가입일 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">가입일</label>
                        <div class="row-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="가입일"
                                value="{{ $carbon::parse($result->created_at)->format('Y.m.d') }}" />
                        </div>
                    </div>

                    {{-- 탈퇴일 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">탈퇴일</label>
                        <div class="row-lg-8 fv-row">
                            <span class="fw-bold fs-5 form-control form-control-solid">
                                @if ($result->leaved_at != null)
                                    {{ $carbon::parse($result->leaved_at)->format('Y-m-d H:i') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- 탈퇴 사유 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">탈퇴 사유</label>
                        <div class="row-lg-8 fv-row">
                            <span class="fw-bold fs-5 form-control form-control-solid">
                                {{ $result->leave_reason ?? '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- 마케팅 수신일 --}}
                    <div class="col-lg-6 mb-6">
                        <label class="row-lg-4 col-form-label fw-semibold fs-6">마케팅 수신일</label>
                        <div class="row-lg-8 fv-row">
                            <span class="fw-bold fs-5 form-control form-control-solid">
                                @if ($result->marketing_at != null)
                                    {{ $carbon::parse($result->marketing_at)->format('Y-m-d H:i') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-6">
                        <form action="{{ route('admin.user.memo.update') }}" id="memoUpdate" method="POST">
                            <input type="hidden" name="id" value="{{ $result->id }}" />
                            <label class="col-lg-12 col-form-label fw-semibold fs-6">메모</label>
                            <div class="col-lg-6 fv-row">
                                <textarea name="memo" class="form-control mb-5" rows="5" placeholder="">{{ $result->memo }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mb-5">저장</button>
                        </form>
                    </div>

                </div>

            </div>
            <!--내용 END-->

        </x-screen-card>
    </div>

    {{--
           * 페이지에서 사용하는 자바스크립트
        --}}
    <script>
        var hostUrl = "assets/";
    </script>
</x-admin-layout>
