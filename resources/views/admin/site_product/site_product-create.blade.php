<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'분양현장 매물 등록'">
        </x-screen-card>
        {{-- FORM START  --}}
        <form class="form" method="POST" action="{{ route('admin.site.product.create') }}">
            @csrf
            <x-screen-card :title="'기본 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 지역 선택 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">지역 선택</label>
                        <div class="col-lg-9 fv-row">
                            @for ($i = 0; $i < count(Lang::get('commons.site_product_region_type')); $i++)
                                <label class="form-check form-check-custom form-check-inline me-1 p-1 form-check-sm">
                                    <input class="form-check-input" name="region_type" type="radio"
                                        value="{{ $i }}" @if (old('region_type') ?? 0 == $i) checked @endif>
                                    <span
                                        class="fw-semibold ps-2 fs-6">{{ Lang::get('commons.site_product_region_type.' . $i) }}</span>
                                </label>
                            @endfor
                        </div>
                    </div>

                    {{-- 주소 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                        <div class="col-lg-9 fv-row">
                            <a onclick="getAddress()" class="btn btn-outline mb-md-5"
                                style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; margin-bottom: 5px;">
                                주소 검색 </a>
                            <input type="text" name="address" id="address" class="form-control form-control-solid"
                                readonly placeholder="" value="{{ old('address') }}" />
                            <input type="hidden" name="region_code" id="region_code" class="form-control " readonly
                                placeholder="" value="{{ old('region_code') }}" />
                            <input type="hidden" name="region_address" id="region_address" class="form-control "
                                readonly placeholder="" value="{{ old('region_address') }}" />
                            <input type="hidden" name="address_lat" id="address_lat" class="form-control " readonly
                                placeholder="" value="{{ old('address_lat') }}" />
                            <input type="hidden" name="address_lng" id="address_lng" class="form-control " readonly
                                placeholder="" value="{{ old('address_lng') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('address')" />
                        </div>
                    </div>

                    {{-- 건물명 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">건물명</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="product_name" class="form-control" placeholder="건물명 입력"
                                value="{{ old('product_name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('product_name')" />
                        </div>
                    </div>

                    {{-- 대표 이미지 --}}
                    <x-admin-image-picker :title="'대표 이미지'" required="required" cnt='1' id="siteProductMain"
                        label_col='2' div_col='9' />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('siteProductMain_file_ids')" />

                    {{-- 제목 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">제목</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title" class="form-control" placeholder="제목 입력"
                                value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />
                        </div>
                    </div>

                    {{-- 세부 내용 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">세부 내용</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="contents" class="form-control mb-5" rows="5" placeholder="세부내용 입력해주세요.">{{ old('contents') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('contents')" />
                        </div>
                    </div>

                    {{-- 한줄 요약 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">한줄 요약</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="comments" class="form-control" placeholder="한줄 요약을 입력해주세요."
                                value="{{ old('comments') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comments')" />
                        </div>
                    </div>


                    {{-- 규모 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">규모</label>
                        <div class="col-lg-2 fv-row">
                            <div class="input-group mb-5">
                                <input type="number" name="min_floor" class="form-control" placeholder="최저"
                                    value="{{ old('min_floor') }}" />
                                <span class="input-group-text" id="basic-addon2">층</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('min_floor')" />
                        </div>
                        <div class="col-lg-2 fv-row">
                            <div class="input-group mb-5">
                                <input type="number" name="max_floor" class="form-control" placeholder="최고"
                                    value="{{ old('max_floor') }}" />
                                <span class="input-group-text" id="basic-addon2">층</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('max_floor')" />
                        </div>
                        <div class="col-lg-2 fv-row">
                            <div class="input-group mb-5">
                                <input type="number" name="dong_count" class="form-control" placeholder="총 동수"
                                    value="{{ old('dong_count') }}" />
                                <span class="input-group-text" id="basic-addon2">개동</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('dong_count')" />
                        </div>
                    </div>


                    {{-- 주차대수 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">주차대수</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="number" name="parking_count" class="form-control" placeholder=""
                                    value="{{ old('parking_count') }}" />
                                <span class="input-group-text" id="basic-addon2">대</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('parking_count')" />
                        </div>
                    </div>

                    {{-- 총 세대수 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">총 세대수</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="number" name="generation_count" class="form-control" placeholder=""
                                    value="{{ old('generation_count') }}" />
                                <span class="input-group-text" id="basic-addon2">대</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('generation_count')" />
                        </div>
                    </div>

                    {{-- 대지면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">대지면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="area" id="area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요." value="{{ old('area') }}" />
                                <span class="input-group-text" id="basic-addon2">평</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('area')" />
                        </div>
                        <div class="fv-row col-lg-2 d-flex justify-content-center ">
                            <div class="btn-group-vertical">
                                <a onclick="square_change('')" class="btn btn-outline"
                                    style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                    <- 평으로 변환 </a>
                                        <a onclick="area_change('')" class="btn btn-outline"
                                            style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                            ㎡으로 변환-></a>
                            </div>
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="text" name="square" id="square" class="form-control"
                                    onkeyup="imsi(this)" placeholder="변환 버튼을 눌러주세요." value="{{ old('square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('square')" />
                        </div>
                    </div>

                    {{-- 건축면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">건축면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="building_area" id="building_area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요." value="{{ old('building_area') }}" />
                                <span class="input-group-text" id="basic-addon2">평</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('building_area')" />
                        </div>
                        <div class="fv-row col-lg-2 d-flex justify-content-center ">
                            <div class="btn-group-vertical">
                                <a onclick="square_change('building_')" class="btn btn-outline"
                                    style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                    <- 평으로 변환 </a>
                                        <a onclick="area_change('building_')" class="btn btn-outline"
                                            style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                            ㎡으로 변환-></a>
                            </div>
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="text" name="building_square" id="building_square"
                                    onkeyup="imsi(this)" class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('building_square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('building_square')" />
                        </div>
                    </div>

                    {{-- 연면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">연면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="total_floor_area" id="total_floor_area"
                                    class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('total_floor_area') }}" />
                                <span class="input-group-text" id="basic-addon2">평</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_floor_area')" />
                        </div>
                        <div class="fv-row col-lg-2 d-flex justify-content-center ">
                            <div class="btn-group-vertical">
                                <a onclick="square_change('total_floor_')" class="btn btn-outline"
                                    style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                    <- 평으로 변환 </a>
                                        <a onclick="area_change('total_floor_')" class="btn btn-outline"
                                            style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .5rem; width: 120px;">
                                            ㎡으로 변환-></a>
                            </div>
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="text" name="total_floor_square" id="total_floor_square"
                                    onkeyup="imsi(this)" class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('total_floor_square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_floor_square')" />
                        </div>
                    </div>

                    {{-- 용적률/건폐율 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">용적률/건폐율</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="floor_area_ratio" class="form-control"
                                    onkeyup="imsi(this)" placeholder="용적률" value="{{ old('floor_area_ratio') }}" />
                                <span class="input-group-text" id="basic-addon2">만원</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('floor_area_ratio')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="builging_ratio" class="form-control"
                                    onkeyup="imsi(this)" placeholder="건폐율" value="{{ old('builging_ratio') }}" />
                                <span class="input-group-text" id="basic-addon2">만원</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('builging_ratio')" />
                        </div>
                    </div>

                    {{-- 준공일 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">준공일</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="completion_date" class="form-control" maxlength="8"
                                placeholder="예) 20230204" value="{{ old('completion_date') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('completion_date')" />
                        </div>
                    </div>

                    {{-- 입주예정 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">입주예정</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="expected_move_date" class="form-control" maxlength="6"
                                placeholder="예) 202302" value="{{ old('expected_move_date') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('expected_move_date')" />
                        </div>
                    </div>

                    {{-- 시행사 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">시행사</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="developer" class="form-control" placeholder="시행사"
                                value="{{ old('developer') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('developer')" />
                        </div>
                    </div>

                    {{-- 시공사 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">시공사</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="comstruction_company" class="form-control" placeholder="시공사"
                                value="{{ old('comstruction_company') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comstruction_company')" />
                        </div>
                    </div>

                    {{-- 3D 이미지 (1장) --}}
                    <x-admin-file-picker :title="'3D 이미지 (1장)'" required="" cnt='1' id="dimension"
                        label_col='2' div_col='9' />
                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('dimension_file_ids')" />

                </div>

            </x-screen-card>
            <x-screen-card :title="'층별 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 동이름 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">동이름</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="developer" class="form-control" placeholder="동이름"
                                value="{{ old('developer') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('developer')" />
                        </div>
                    </div>

                </div>
            </x-screen-card>
            <x-screen-card :title="'상세 정보'">
                {{-- FORM START  --}}
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">



                    {{-- 총 세대수 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-2 col-form-label fw-semibold fs-6">총 세대수</label>
                        <div class="col-lg-3 d-flex align-items-center">
                            <div class="input-group mb-5">
                                <input type="number" name="generation_count" class="form-control"
                                    placeholder="예) 1234" value="{{ old('generation_count') }}" />
                                <span class="input-group-text" id="basic-addon2">실</span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('generation_count')" />
                        </div>
                    </div>

                    {{-- 시행사 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">시행사</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="developer" class="form-control" placeholder="시행사명 입력"
                                value="{{ old('developer') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('developer')" />
                        </div>
                    </div>

                    {{-- 시공사 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">시공사</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="comstruction_company" class="form-control"
                                placeholder="시공사명 입력" value="{{ old('comstruction_company') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comstruction_company')" />
                        </div>
                    </div>

                    {{-- 교통정보 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">교통정보</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="traffic_info" class="form-control mb-5" rows="5" placeholder="주변 교통관련 정보를 입력해주세요.">{{ old('traffic_info') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('traffic_info')" />
                        </div>
                    </div>

                    {{-- 현장설명 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">현장설명</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="site_contents" class="form-control mb-5" rows="5" placeholder="주변 편의시설, 역세권 등의 정보를 입력해주세요.">{{ old('site_contents') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('site_contents')" />
                        </div>
                    </div>

                    {{-- 한줄 요약 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">한줄 요약</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="comments" class="form-control" placeholder="한줄 요약을 입력해주세요."
                                value="{{ old('comments') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('comments')" />
                        </div>
                    </div>

                    {{-- 버스 정류장 거리 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">버스 정류장 거리</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="bus_stop_contents" class="form-control mb-5" rows="5" placeholder="버스 정류장과의 거리를 입력하세요.">{{ old('bus_stop_contents') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('bus_stop_contents')" />
                        </div>
                    </div>

                    {{-- 편의 시설 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">편의 시설</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="facilities_contents" class="form-control mb-5" rows="5" placeholder="주변 편의 시설을 입력하세요.">{{ old('facilities_contents') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('facilities_contents')" />
                        </div>
                    </div>

                    {{-- 교육 시설 --}}
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">교육 시설</label>
                        <div class="col-lg-9 fv-row">
                            <textarea name="education_contents" class="form-control mb-5" rows="5" placeholder="주변 교 시설을 입력하세요.">{{ old('education_contents') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('education_contents')" />
                        </div>
                    </div>



                    {{-- Footer Bottom START --}}
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary">등록</button>
                    </div>
                    {{-- Footer END --}}
                </div>
            </x-screen-card>

        </form>
        {{-- FORM END --}}

    </div>

    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        var prev = "";
        var regexp = /^\d*(\.\d{0,2})?$/;

        function imsi(obj) {
            if (obj.value.search(regexp) == -1) {
                obj.value = prev;
            } else {
                prev = obj.value;
            }
        }


        function square_change(name) {
            var area_name = name + 'area';
            var square_name = name + 'square';

            var square = $('#' + square_name).val();
            if (square > 0) {
                var convertedArea = Math.round(square / 3.3058); // 평수로 변환하여 정수로 반올림
                $('#' + area_name).val(convertedArea);
            }

        }

        function area_change(name) {
            var area_name = name + 'area';
            var square_name = name + 'square';

            var area = $('#' + area_name).val();
            if (area > 0) {
                var convertedSquare = (area * 3.3058).toString();
                var decimalIndex = convertedSquare.indexOf('.') + 3; // 소수점 이하 세 번째 자리까지
                $('#' + square_name).val(convertedSquare.substr(0, decimalIndex));
            }

        }
        // 생성된 태그 삭제
        function add_delete(element) {
            // 클릭한 <a> 태그의 부모 <li> 요소 가져오기
            var listItem = element.parentNode;

            // 부모 <li> 요소 제거
            listItem.parentNode.removeChild(listItem);
        }
    </script>
</x-admin-layout>

<script language="javascript">
    // opener관련 오류가 발생하는 경우 아래 주석을 해지하고, 사용자의 도메인정보를 입력합니다. ("팝업API 호출 소스"도 동일하게 적용시켜야 합니다.)
    // document.domain = "{{ env('APP_URL') }}";

    function getAddress() {
        //IE에서 opener관련 오류가 발생하는 경우, window에 이름을 명시해줍니다.
        window.name = "jusoPopup";

        //주소검색을 수행할 팝업 페이지를 호출합니다.
        //호출된 페이지(jusoPopup.jsp)에서 실제 주소검색URL(https://business.juso.go.kr/addrlink/addrLinkUrlJsonp.do)를 호출하게 됩니다.
        var pop = window.open("{{ route('api.popupOpen.getAddress') }}", "pop",
            "width=570,height=420, scrollbars=yes, resizable=yes");
    }


    function jusoCallBack(rtRoadFullAddr, rtAddrPart1, rtAddrDetail, rtAddrPart2, rtEngAddr, rtJibunAddr, rtZipNo,
        rtAdmCd, rtRnMgtSn, rtBdMgtSn, rtDetBdNmList, rtBdNm, rtBdKdcd, rtSiNm, rtSggNm, rtEmdNm, rtLiNm, rtRn,
        rtUdrtYn, rtBuldMnnm, rtBuldSlno, rtMtYn, rtLnbrMnnm, rtLnbrSlno, rtEmdNo, relJibun, rtentX, rtentY) {
        // 팝업페이지에서 주소입력한 정보를 받아서, 현 페이지에 정보를 등록합니다.
        $('input[name=address]').val(rtRoadFullAddr);

        console.log('RoadFullAddr:', rtRoadFullAddr);
        console.log('AddrPart1:', rtAddrPart1);
        console.log('AddrDetail:', rtAddrDetail);
        console.log('AddrPart2:', rtAddrPart2);
        console.log('EngAddr:', rtEngAddr);
        console.log('JibunAddr:', rtJibunAddr);
        console.log('ZipNo:', rtZipNo);
        console.log('AdmCd:', rtAdmCd);
        console.log('RnMgtSn:', rtRnMgtSn);
        console.log('BdMgtSn:', rtBdMgtSn);
        console.log('DetBdNmList:', rtDetBdNmList);
        console.log('BdNm:', rtBdNm);
        console.log('BdKdcd:', rtBdKdcd);
        console.log('SiNm:', rtSiNm);
        console.log('SggNm:', rtSggNm);
        console.log('EmdNm:', rtEmdNm);
        console.log('LiNm:', rtLiNm);
        console.log('Rn:', rtRn);
        console.log('UdrtYn:', rtUdrtYn);
        console.log('BuldMnnm:', rtBuldMnnm);
        console.log('BuldSlno:', rtBuldSlno);
        console.log('MtYn:', rtMtYn);
        console.log('LnbrMnnm:', rtLnbrMnnm);
        console.log('LnbrSlno:', rtLnbrSlno);
        console.log('EmdNo:', rtEmdNo);
        console.log('lJibun:', relJibun);
        console.log('entX:', rtentX);
        console.log('entY:', rtentY);

        var wgs84Coords = get_coordinate_conversion(rtentX, rtentY);

        $('#address').val(rtAddrPart1 + ' ' + rtAddrDetail)
        $('input[name=address_lng]').val(wgs84Coords[0]);
        $('input[name=address_lat]').val(wgs84Coords[1]);

        $('#region_code').val(rtAdmCd);
        $('#region_address').val(rtSiNm + ' ' + rtSggNm + ' ' + rtEmdNm + ' ' + rtLiNm);

        console.log('주소 검색 끝!');
    }
</script>
