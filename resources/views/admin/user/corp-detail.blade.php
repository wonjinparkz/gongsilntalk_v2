<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'중개사 상세'">
            {{-- FORM START  --}}
            {{-- <form class="form" method="POST" action="{{ route('admin.notice.update') }}"> --}}
            <form class="form" method="POST" action="#">
                @csrf
                <input type="hidden" name="lasturl" value="{{ URL::previous() }}">
                {{-- 사용자 아이디 --}}
                <input type="hidden" name="id" value="{{ $result->id }}" />
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
                                    <img src="{{ asset('assets/media/avatars/blank.png') }}" />
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

                        {{-- 전화번호 --}}
                        <div class="col-lg-6 mb-6">
                            <label class="row-lg-4 col-form-label fw-semibold fs-6">전화번호</label>
                            <div class="row-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="전화번호" value="{{ $result->phone }}" />
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

                    </div>

                </div>
                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">수정</button>
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
    </script>
</x-admin-layout>
