<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'관리자 상세'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('admins.update') }}">
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

                    @if (Auth::guard('admin')->user()->id != $result->id)
                        {{-- 사용 여부 --}}
                        <div class="row mb-6">
                            <label class="required col-lg-4 col-form-label fw-semibold fs-6">관리자 사용 상태</label>
                            <div class="col-lg-2 d-flex align-items-center">
                                @php
                                    $state = old('state') ?? $result->state;
                                @endphp
                                <select id="stateOption" name="state" class="form-select form-select-solid"
                                    data-control="select2" data-hide-search="true">
                                    <option value="0" @if ($state == 0) selected @endif>사용가능
                                    </option>
                                    <option value="1" @if ($state == 1) selected @endif>사용불가능
                                    </option>
                                </select>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('state')" />
                        </div>
                    @else
                        <input type="hidden" name="state" value="0" />
                    @endif

                    {{-- 공지사항 등록 타입 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label  fw-semibold fs-6">관리자 권한</label>
                        <div class="col-lg-8 fv-row">
                            <select name="permissions[]"class="form-select form-select-solid" data-control="select2"
                                data-close-on-select="false" data-placeholder="직종을 선택해주세요." data-allow-clear="true"
                                multiple="multiple">

                                @php
                                    $permission = [];

                                    foreach (explode(',', $result->permissions) as $index => $value) {
                                        $permission[$index] = (int) $value;
                                    }
                                @endphp

                                @for ($i = 0; $i < count(Lang::get('commons.permissions')); $i++)
                                    <option value="{{ $i }}"
                                        @if (in_array($i, $permission)) selected @endif>
                                        {{ Lang::get('commons.permissions.' . $i) }}</option>
                                @endfor
                            </select>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('permissions')" />
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
