<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'지식산업센터 등록'">
        </x-screen-card>
        {{-- FORM START  --}}
        <form class="form" method="POST" action="{{ route('admin.popup.create') }}">
            @csrf
            <x-screen-card :title="'기본 정보'">
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">
                    {{-- 건물명 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">건물명</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="title" class="form-control form-control-solid"
                                placeholder="건물명 입력" value="{{ old('title') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />
                        </div>
                    </div>

                    {{-- 지하철 정보 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">지하철 정보</label>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="subway_name" class="form-control form-control-solid"
                                placeholder="역명" value="{{ old('subway_name') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('subway_name')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="subway_distance" class="form-control form-control-solid"
                                placeholder="거리" value="{{ old('subway_distance') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('subway_distance')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <input type="text" name="subway_time" class="form-control form-control-solid"
                                placeholder="시간 (분)" value="{{ old('subway_time') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('subway_time')" />
                        </div>
                    </div>

                    {{-- 준공일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-3 col-form-label fw-semibold fs-6">준공일</label>
                        <div class="col-lg-9 fv-row">
                            <input type="text" name="completion_date" class="form-control form-control-solid"
                                placeholder="예) 20230204" value="{{ old('completion_date') }}" />
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('completion_date')" />
                        </div>
                    </div>

                    {{-- 매매호가 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">매매호가</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="sale_min_price" class="form-control" placeholder="최저가"
                                    value="{{ old('sale_min_price') }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('sale_min_price')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="sale_mid_price" class="form-control" placeholder="최저가"
                                    value="{{ old('sale_mid_price') }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('sale_mid_price')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="sale_max_price" class="form-control" placeholder="최저가"
                                    value="{{ old('sale_max_price') }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('sale_max_price')" />
                        </div>
                    </div>

                    {{-- 임대호가 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">임대호가</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="lease_min_price" class="form-control" placeholder="최저가"
                                    value="{{ old('lease_min_price') }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('lease_min_price')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="lease_mid_price" class="form-control" placeholder="최저가"
                                    value="{{ old('lease_mid_price') }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('lease_mid_price')" />
                        </div>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group mb-5">
                                <input type="text" name="lease_max_price" class="form-control" placeholder="최저가"
                                    value="{{ old('lease_max_price') }}" />
                                <span class="input-group-text" id="basic-addon2">만원<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('lease_max_price')" />
                        </div>
                    </div>

                    {{-- 조감도 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label  fw-semibold fs-6">조감도</label>
                        <div class="col-lg-2 fv-row">
                            <a id="pc_file_drop" class="btn btn-secondary f_left">파일업로드</a>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
                    </div>

                    {{-- 특장점 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">특장점</label>
                        <div class="col-lg-2 fv-row">
                            <a id="pc_file_drop" class="btn btn-secondary f_left">파일업로드</a>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
                    </div>

                    {{-- 층별도면 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-3 col-form-label fw-semibold fs-6">층별도면</label>
                        <div class="col-lg-2 fv-row">
                            <a id="pc_file_drop" class="btn btn-secondary f_left">파일업로드</a>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
                    </div>

                    {{-- FORM END --}}
                </div>

            </x-screen-card>
            <x-screen-card :title="'상세 정보'">
                {{-- FORM START  --}}
                @csrf
                {{-- 내용 START --}}
                <div class="card-body border-top p-9">

                    {{-- 대지면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">대지면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="area" id="area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요." value="{{ old('area') }}" />
                                <span class="input-group-text" id="basic-addon2">평<span>
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
                                <input type="number" name="square" id="square" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요." value="{{ old('square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('square')" />
                        </div>
                    </div>

                    {{-- 건축면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">건축면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="building_area" id="building_area" class="form-control"
                                    placeholder="변환 버튼을 눌러주세요." value="{{ old('building_area') }}" />
                                <span class="input-group-text" id="basic-addon2">평<span>
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
                                <input type="number" name="building_square" id="building_square"
                                    class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('building_square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('building_square')" />
                        </div>
                    </div>
                    {{-- 연면적 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">연면적</label>
                        <div class="col-lg-3 fv-row">
                            <div class="input-group">
                                <input type="number" name="total_floor_area" id="total_floor_area"
                                    class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('total_floor_area') }}" />
                                <span class="input-group-text" id="basic-addon2">평<span>
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
                                <input type="number" name="total_floor_square" id="total_floor_square"
                                    class="form-control" placeholder="변환 버튼을 눌러주세요."
                                    value="{{ old('total_floor_square') }}" />
                                <span class="input-group-text" id="basic-addon2">㎡<span>
                            </div>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('total_floor_square')" />
                        </div>
                    </div>

                    {{-- 내용 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">팝업 내용</label>
                        <div class="col-lg-8 fv-row">
                            <textarea name="content" class="form-control form-control-solid mb-5" rows="5" placeholder="내용">{{ old('content') }}</textarea>
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('content')" />
                        </div>
                    </div>

                    {{-- 작성일 --}}
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label fw-semibold fs-6">게시기간</label>
                        <div class="col-lg-8 fv-row">
                            <x-admin-date-picker :title="'게시 시작일 검색'" :from_name="'started_at'" :to_name="'ended_at'" />
                        </div>
                    </div>


                    {{-- 이미지  --}}
                    <x-admin-image-picker :title="'팝업 이미지'" id="popup" />


                    {{-- 게시 타입 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label  fw-semibold fs-6">게시 타겟</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $type = old('type') ?? 0;
                            @endphp
                            <select name="type" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($type == 0) selected @endif>사용자</option>
                                <option value="1" @if ($type == 1) selected @endif>파트너</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('type')" />
                    </div>

                    {{-- 게시 여부 --}}
                    <div class="row mb-6">
                        <label class="required col-lg-4 col-form-label fw-semibold fs-6">게시 상태</label>
                        <div class="col-lg-2 d-flex align-items-center">
                            @php
                                $isBlind = old('is_blind') ?? 0;
                            @endphp
                            <select name="is_blind" class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true">
                                <option value="0" @if ($isBlind == 0) selected @endif>공개</option>
                                <option value="1" @if ($isBlind == 1) selected @endif>비공개</option>
                            </select>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('is_blind')" />
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
        <x-screen-card :title="'건축물 대장'">
            {{-- FORM START  --}}
            @csrf
            {{-- 내용 START --}}
            <div class="card-body border-top p-9">
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">표지부</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">총괄표제부</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">층별개요</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">전유부</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
                <div class="row mb-6">
                    <label class="required col-lg-2 col-form-label fw-semibold fs-6">전유공용면적</label>
                    <label class="required col-lg-3 col-form-label fw-semibold fs-6">마지막 업데이트 : 2024.01.01</label>
                    <div class="col-lg-4 fv-row">
                        <button type="submit" class="btn btn-secondary">업데이트</button>
                    </div>
                </div>
            </div>

        </x-screen-card>
    </div>

    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script>
        function square_change(name) {
            alert('t');
            var area_name = name + 'area';
            var square_name = name + 'square';

            var square = $('#' + square_name).val();
            var convertedArea = Math.round(square * 3.30578); // 평수로 변환하여 정수로 반올림
            $('#' + area_name).val(convertedArea);

        }

        function area_change(name) {
            alert('s');
            var area_name = name + 'area';
            var square_name = name + 'square';

            var area = $('#' + area_name).val();
            var convertedSquare = (area / 3.30578).toFixed(2); // 제곱미터로 변환하여 소수점 2자리까지 표현
            $('#' + square_name).val(convertedSquare);

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
