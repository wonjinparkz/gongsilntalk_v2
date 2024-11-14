<x-admin-layout>

    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">중개사 매물
                        관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
            </div>
        </div>

        <div class="app-content flex-column-fluid">
            <div class="app-container container-xxl">
                {{-- 검색 영역 --}}
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="GET"
                        action="{{ route('admin.corp.product.list.view') }}">
                        @csrf

                        <input type="hidden" name="user_type" value="0">

                        {{-- 중개사무소명 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">중개사무소 명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="company_name" name="company_name"
                                    class="form-control form-control-solid" placeholder="중개사무소 명을 입력해 주세요."
                                    value="{{ Request::get('company_name') }}" />
                            </div>
                        </div>

                        {{-- 등록일 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">등록일</label>
                            <div class="col-lg-8 fv-row">
                                <x-admin-date-picker :title="'등록일을 선택해주세요.'" :from_name="'from_created_at'" :to_name="'to_created_at'" />
                            </div>
                        </div>

                        {{-- 매물 상태 --}}
                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">매물 상태</label>
                            @php
                                $state = Request::get('state') ?? -1;
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="state" class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true">
                                    <option value="" @if ($state < 0) selected @endif>전체
                                    </option>
                                    <option value="1" @if ($state == 1) selected @endif>거래중
                                    </option>
                                    <option value="2" @if ($state == 2) selected @endif>거래완료
                                    </option>
                                    <option value="3" @if ($state == 3) selected @endif>비공개
                                    </option>
                                    <option value="4" @if ($state == 4) selected @endif>등록만료
                                    </option>
                                    <option value="5" @if ($state == 5) selected @endif>등록대기
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6 row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">거래 유형</label>
                            @php
                                $payment_type = Request::get('payment_type') ?? [];
                            @endphp
                            <div class="col-lg-8 fv-row">
                                <select name="payment_type[]"class="form-select form-select-solid"
                                    data-control="select2" data-close-on-select="false" data-placeholder="거래유형를 선택해주세요."
                                    data-allow-clear="true" multiple="multiple">
                                    @foreach (Lang::get('commons.payment_type') as $index => $paymentType)
                                        <option value="{{ $index }}"
                                            @if (in_array($index, $payment_type)) selected @endif>
                                            {{ $paymentType }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- 매물 종류 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">매물 종류</label>
                            @php
                                $type = Request::get('type') ?? [];
                            @endphp
                            <div class="col-lg-10 fv-row">
                                <select name="type[]"class="form-select form-select-solid" data-control="select2"
                                    data-close-on-select="false" data-placeholder="매물 종류를 선택해주세요."
                                    data-allow-clear="true" multiple="multiple">
                                    @for ($i = 0; $i < count(Lang::get('commons.product_type')); $i++)
                                        <option value="{{ $i }}"
                                            @if (in_array($i, $type)) selected @endif>
                                            {{ Lang::get('commons.product_type.' . $i) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mt-10">
                            <button type="submit" class="btn col-lg-1 btn-primary">검색</button>
                        </div>

                        <div class="d-flex justify-content-end mt-10">
                            <a class="btn me-10 btn-lm fw-bold btn-success btn-group-vertical"
                                href="{{ route('admin.corp.product.export', Request::all()) }}" target="_blank">
                                엑셀 다운로드</a>
                        </div>
                    </form>

                </div>
                {{-- 테이블 영역 --}}
                <div class="card card-flush shadow-sm mt-10">
                    {{ $result->links('components.pagination-info') }}
                    {{-- 데이터 내용 --}}
                    <div class="card-body pt-0 table-responsive">
                        {{-- 테이블 --}}
                        <table id="notice_table"
                            class="table align-middle table-bordered table-row-dashed table-hover fs-6 gy-5">
                            {{-- 테이블 헤더 --}}
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fl-7 text-uppercase gs-0">
                                    <th class="text-center w-20px">No.</th>
                                    <th class="text-center">매물번호</th>
                                    <th class="text-center">매물상태</th>
                                    <th class="text-center min-w-250px">주소</th>
                                    <th class="text-center">중개사무소명</th>
                                    <th class="text-center">매물종류</th>
                                    <th class="text-center">거래 유형</th>
                                    <th class="text-center">등록일</th>
                                </tr>
                            </thead>

                            {{-- 테이블 내용 --}}
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($result as $product)
                                    <tr>
                                        {{-- 매물관리 번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">{{ $product->id }}</span>
                                        </td>

                                        {{-- 매물번호 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $product->product_number }}
                                            </span>
                                        </td>

                                        {{-- 매물상태 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ Lang::get('commons.product_state.' . $product->state) }}
                                            </span>
                                        </td>


                                        {{-- 주소 --}}
                                        <td class="text-center">
                                            <a href="{{ route('admin.corp.product.detail.view', [$product->id]) }}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $product->address . ' ' . ($product->is_map == 1 ? $product->address_detail : $product->address_dong . ' ' . $product->address_number) }}</a>
                                        </td>

                                        {{-- 중개사 명 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ $product->users->company_name }}
                                            </span>
                                        </td>

                                        {{-- 매물종류 --}}
                                        <td class="text-center">

                                            <span class="fw-bold fs-5">
                                                {{ Lang::get('commons.product_type.' . $product->type) }}
                                            </span>
                                        </td>

                                        {{-- 거래 유형 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                {{ Lang::get('commons.payment_type.' . $product->priceInfo->payment_type) }}
                                            </span>
                                        </td>

                                        {{-- 등록일 --}}
                                        <td class="text-center">
                                            <span class="fw-bold fs-5">
                                                @inject('carbon', 'Carbon\Carbon')
                                                {{ $carbon::parse($product->created_at)->format('Y.m.d') }}
                                            </span>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    {{ $result->onEachSide(1)->links('components.pagination') }}
                </div>
            </div>
        </div>


        {{--
    * 페이지에서 사용하는 자바스크립트
    --}}
        <script>
            var hostUrl = "assets/";

            // 날짜 검색이 있을 경우 추가
            initDaterangepicker();
            initDaterangepicker2();
        </script>
</x-admin-layout>
