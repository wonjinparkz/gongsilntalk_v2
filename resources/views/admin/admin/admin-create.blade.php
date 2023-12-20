<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'관리자 등록'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admins.create') }}">
                @csrf
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 아이디 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">아이디</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="admin_id" class="form-control form-control-solid"
                                placeholder="아이디" value="{{ old('admin_id') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('admin_id')" />

                        </div>
                    </div>

                    {{-- 비밀번호 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">비밀번호</label>
                        <div class="col-lg-8 fv-row">
                            <input type="password" name="password" class="form-control form-control-solid"
                                placeholder="비밀번호" value="{{ old('password') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('password')" />

                        </div>
                    </div>

                    {{-- 이름 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">이름</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" name="name" class="form-control form-control-solid"
                                placeholder="이름" value="{{ old('name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />

                        </div>
                    </div>

                    {{-- 전화번호 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">전화번호</label>
                        <div class="col-lg-8 fv-row">
                            <input id="phoneNumber" type="text" name="phone"
                                class="form-control form-control-solid" placeholder="전화번호"
                                value="{{ old('phone') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('phone')" />

                        </div>
                    </div>

                    {{-- 사용 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">관리자 사용 상태</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $state = old('state') ?? 0;
                            @endphp
                            <select id="stateOption" name="state" class="form-select form-select-solid"
                                data-control="select2" data-hide-search="true">
                                <option value="0" @if ($state == 0) selected @endif>사용가능</option>
                                <option value="1" @if ($state == 1) selected @endif>사용불가능</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('state')" />

                    </div>
                    <!--내용 END-->
                    {{-- Footer Bottom START --}}
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary">등록</button>
                    </div>
                    {{-- Footer END --}}
            </form>
            {{-- FORM END --}}

        </x-screen-card>
    </div>

</x-admin-layout>
