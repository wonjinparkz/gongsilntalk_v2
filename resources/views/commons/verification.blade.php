<x-none>

    <div class="app-container container-xxl">

        {{-- 제목 --}}
        <div class="row mb-6 mt-6">
            <label class="required col-lg-4 col-form-label fw-semibold fs-6">이름</label>
            <div class="col-lg-8 fv-row">
                <input type="text" id="name" class="form-control form-control-solid" placeholder="이름을 입력해주세요."
                    value="" />
            </div>
        </div>

        {{-- 전화번호 --}}
        <div class="row mb-6 mt-6">
            <label class="required col-lg-4 col-form-label fw-semibold fs-6">전화번호</label>
            <div class="col-lg-8 fv-row">
                <input type="tel" id="phone" class="form-control form-control-solid"
                    placeholder="'-'를 제외한 전화번호를 입력해주세요." value="" />

            </div>
        </div>

        {{-- 생년월일 --}}
        <div class="row mb-6 mt-6">
            <label class="required col-lg-4 col-form-label fw-semibold fs-6">생년월일</label>
            <div class="col-lg-8 fv-row">
                <input type="tel" id="birth" class="form-control form-control-solid" placeholder="ex) 19900101"
                    value="" />
            </div>
        </div>

        {{-- 성별 --}}
        <div class="row mb-6">
            <label class="required col-lg-4 col-form-label fw-semibold fs-6">성별</label>
            <div class="col-lg-2 d-flex align-items-center">
                <select id="gender" class="form-select form-select-solid" data-control="select2"
                    data-hide-search="true">
                    <option value="0">남성</option>
                    <option value="1">여성</option>
                </select>
            </div>
        </div>

        <button id="confirm" class="btn btn-primary">본인인증 완료</button>
    </div>


    <script>
        // 본인인증 완료 클릭
        $('#confirm').click(function() {
            var name = $('#name').val();
            var phone = $('#phone').val();
            var birth = $('#birth').val();
            var gender = $('#gender').val();

            if (isMobile.any()) {
                if (isMobile.Android()) {
                    window.rocateer.resultVerification(name, phone, birth, gender);
                } else if (isMobile.iOS()) {
                    var data = new Object();
                    data.name = name;
                    data.phone = phone;
                    data.birth = birth;
                    data.gender = gender;
                    webkit.messageHandlers.resultVerification.postMessage(data);
                }
            }
        })
    </script>


</x-none>
