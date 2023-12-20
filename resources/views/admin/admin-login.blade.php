<x-guest-layout>
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="card rounded-3 w-md-550px">
                <div class="card-body d-flex flex-column p-10 p-lg-20 pb-lg-10">
                    <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                        <form class="form w-100" novalidate="novalidate" method="POST"
                            action="{{ route('admin.login.login') }}">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">관리자</h1>
                            </div>
                            <div class="separator separator-content my-14">
                                <span class="text-gray-500 fw-semibold fs-7">아이디가 없는 경우 관리자에 문의해주세요.</span>
                            </div>
                            {{-- 아이디 --}}
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="아이디" name="admin_id" autocomplete="off"
                                    class="form-control bg-transparent" value="{{ old('admin_id') }}" />
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('admin_id')" />
                            </div>
                            {{-- 비밀번호 --}}
                            <div class="fv-row mb-8">
                                <input type="password" placeholder="비밀번호" name="password" autocomplete="off"
                                    class="form-control bg-transparent" />
                                <x-input-error class="mt-2 text-danger" :messages="$errors->get('password')" />
                            </div>
                            {{-- 로그인 버튼 --}}
                            <div class="d-grid mb-3 gap-3">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                    로그인
                                </button>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('admin_login')" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-guest-layout>
