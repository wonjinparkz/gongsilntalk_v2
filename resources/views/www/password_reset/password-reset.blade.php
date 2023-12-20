<x-guest-layout>
    <div class="app-container container w-md-800px">
        <x-screen-card :title="'비밀번호 초기화'">
            {{-- FORM START  --}}
            <form class="form" method="POST" action="{{ route('password.reset') }}">
                @csrf
                <input type='hidden' name='id' value='{{ $result->users_id }}' />
                <input type='hidden' name='token' value='{{ $result->token }}' />
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 비밀번호 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">비밀번호</label>
                        <div class="col-lg-8 fv-row">
                            <input type="password" name="new_password" class="form-control form-control-solid"
                                placeholder="비밀번호" value="{{ old('new_password') }}" />

                            @php
                                Log::info('$errors = ' . json_encode($errors->get('new_password')));
                            @endphp
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('new_password')" />
                        </div>
                    </div>

                    {{-- 비밀번호 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">비밀번호 확인</label>
                        <div class="col-lg-8 fv-row">
                            <input type="password" name="new_password_confirmation"
                                class="form-control form-control-solid" placeholder="비밀번호 확인"
                                value="{{ old('new_password_confirmation') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('new_password_confirmation')" />

                        </div>
                    </div>
                </div>
                <!--내용 END-->
                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">비밀번호 변경</button>
                </div>
                {{-- Footer END --}}
            </form>
            {{-- FORM END --}}

        </x-screen-card>
    </div>

</x-guest-layout>
