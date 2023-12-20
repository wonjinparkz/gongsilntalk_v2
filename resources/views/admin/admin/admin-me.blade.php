<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'계정설정'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admins.update.me') }}">
                @csrf
                {{-- 내용 START --}}
                <input type="hidden" name="id" value="{{ $result->id }}" />

                <input type="hidden" name="lasturl" value="{{ URL::previous() }}">


                <div class="card-body border-top p-9">
                    {{-- 아이디 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">아이디</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="아이디"
                                value="{{ old('admin_id') ? old('admin_id') : $result->admin_id }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('admin_id')" />

                        </div>
                    </div>


                    {{-- 이름 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">이름</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="name" class="form-control form-control-solid"
                                placeholder="이름" value="{{ old('name') ? old('name') : $result->name }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />

                        </div>
                    </div>

                    {{-- 전화번호 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">전화번호</label>
                        <div class="col-lg-8 fv-row">
                            <input id="phoneNumber" type="text" name="phone"
                                class="form-control form-control-solid" placeholder="전화번호"
                                value="{{ old('phone') ? old('phone') : $result->phone }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('phone')" />

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

    <x-screen-card :title="'비밀번호 변경'">
        <div class="card-body border-top p-9">
            <form class="form" method="POST" action="{{ route('admins.password.update') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $result->id }}" />
                {{-- 비밀번호 --}}
                <div class="row mb-6">
                    <label class="required col-lg-4 col-form-label fw-semibold fs-6">비밀번호</label>
                    <div class="col-lg-6">
                        <input type="password" name="password" class="form-control form-control-solid"
                            placeholder="비밀번호" value="" />
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('password')" />

                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary">비밀번호 변경</button>
                    </div>
                </div>
            </form>
        </div>

    </x-screen-card>

</x-admin-layout>
