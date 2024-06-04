<x-admin-layout>
    {{-- FORM START  --}}
    <form class="form" method="POST" action="{{ route('admin.apt.name.create') }}">
        @csrf

        <div class="app-container container-xxl">
            <x-screen-card :title="'아파트 단지명 등록'">

                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 아파트 단지 선택 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">아파트 단지 선택</label>
                        <div class="col-lg-5 fv-row">
                            <select class="form-select form-select-solid" name="apt_id" data-control="select2"
                                data-placeholder="단지명으로 검색">
                                <option></option>
                                @foreach ($aptList as $apt)
                                    <option value="{{ $apt->id }}">{{ $apt->kaptName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- 유사 단지명 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">유사 단지명</label>
                        <div class="col-lg-5 fv-row">
                            <div class="form-group">
                                <div>
                                    <div class="form-group row mb-5">
                                        <div class="col-md-8">
                                            <input name="complex_name_input" type="text"
                                                class="form-control mb-2 mb-md-0" placeholder="유사 단지명을 입력해주세요." />
                                        </div>
                                        <div class="col-md-4">
                                            <a onclick="complexNameCreate();" class="btn btn-light-primary">
                                                추가
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-5 complex_preview">

                            </div>
                        </div>
                    </div>

                </div>
                <!--내용 END-->

                {{-- Footer Bottom START --}}
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" class="btn btn-primary">저장</button>
                </div>
                {{-- Footer END --}}

            </x-screen-card>


            {{-- FORM END --}}

        </div>
    </form>

    {{--
        * 페이지에서 사용하는 자바스크립트
    --}}

    <script>
        var hostUrl = "assets/";

        // 유사 단지명 추가
        function complexNameCreate() {
            var complexNameInput = $('input[name="complex_name_input"]').val();
            var complexName =
                `<div class="row">
                    <div class="col-md-8">
                        <input name="complex_name[]" type="text" class="form-control mb-2 mb-md-0" placeholder="유사 단지명을 입력해주세요." value="${complexNameInput}"/>
                    </div>
                    <div class="col-md-4">
                        <a onclick="complexNameDelete(this)" class="btn btn-light-danger">삭제</a>
                    </div>
                </div>`

            $('.complex_preview').append(complexName);
            $('input[name="complex_name_input"]').val('');
        }

        // 유사 단지명 삭제
        function complexNameDelete(elem) {
            $(elem).closest('.row').remove();
        }
    </script>
</x-admin-layout>
