<x-admin-layout>
    @inject('carbon', 'Carbon\Carbon')

    <div class="app-container container-xxl">
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">기업 매물
                        제안서
                        상세
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />

                </div>
            </div>
        </div>
        {{-- FORM START  --}}

        <x-screen-card :title="'요청자 정보'">
            <div class="card-body border-top p-9">
                <div class="row">

                    <div class="row-lg-12 mb-10">
                        <div class="symbol symbol-150px symbol-circle mb-5">
                            @if (count($result->users->images) > 0)
                                @foreach ($result->users->images as $image)
                                    <img src="{{ Storage::url('image/' . $images->path) }}" />
                                @endforeach
                            @else
                                <img src="{{ asset('assets/media/default_user.png') }}" />
                            @endif
                        </div>
                    </div>

                    @if ($result->users->type == 0)
                        {{-- 이름 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">이름</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid" placeholder="이름"
                                    value="{{ $result->users->name }}" />
                            </div>
                        </div>

                        {{-- 아이디 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">ID</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid" placeholder="아이디"
                                    value="{{ $result->users->email }}" />
                            </div>
                        </div>

                        {{-- 연락처 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">연락처</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid" placeholder="연락처"
                                    value="{{ $result->users->phone }}" />
                            </div>
                        </div>

                        {{-- 받은 제안서 개수 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">받은 제안서 개수</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="받은 제안서 개수" value="{{ count($result->products) }}개" />
                            </div>
                        </div>

                        {{-- 등록일 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">등록일</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid" placeholder="등록일"
                                    value=" {{ $carbon::parse($result->users->created_at)->format('Y.m.d') }}" />
                            </div>
                        </div>
                    @else
                        {{-- 담당자 이름 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">담당자 이름</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="담당자 이름" value="{{ $result->users->name }}" />
                            </div>
                        </div>

                        {{-- 아이디 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">ID</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid" placeholder="아이디"
                                    value="{{ $result->users->email }}" />
                            </div>
                        </div>

                        {{-- 담당자 연락처 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">담당자 연락처</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="담당자 연락처" value="{{ $result->users->phone }}" />
                            </div>
                        </div>

                        {{-- 중개사무소명 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">중개사무소명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="중개사무소명" value="{{ $result->users->company_name }}" />
                            </div>
                        </div>

                        {{-- 대표자명 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">대표자명</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="대표자명" value="{{ $result->users->company_ceo }}" />
                            </div>
                        </div>

                        {{-- 주소 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">주소</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid" placeholder="주소"
                                    value="{{ $result->users->company_address . $result->users->company_address_detail }}" />
                            </div>
                        </div>

                        {{-- 대표 전화번호 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">대표 전화번호</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="대표 전화번호" value="{{ $result->users->company_phone }}" />
                            </div>
                        </div>

                        {{-- 중개등록번호 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">중개등록번호</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="중개등록번호" value="{{ $result->users->brokerage_number }}" />
                            </div>
                        </div>

                        {{-- 사업자 등록번호 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">사업자 등록번호</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="사업자 등록번호" value="{{ $result->users->company_number }}" />
                            </div>
                        </div>

                        {{-- 등록매물 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">등록매물</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="등록매물" value="{{ $productCount ?? 0 }}개" />
                            </div>
                        </div>

                        {{-- 작성 제안서 개수 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">작성 제안서 개수</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="작성 제안서 개수" value="{{ $CorpProposalCount ?? 0 }}개" />
                            </div>
                        </div>

                        {{-- 등록일 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">등록일</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="등록일"
                                    value=" {{ $carbon::parse($result->users->created_at)->format('Y.m.d') }}" />
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </x-screen-card>

        <x-screen-card :title="'받은 제안서 목록'">
            <div class="card-body border-top p-9">
                <div class="row">
                    {{-- 기업명 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">기업명</label>
                        <div class="col-lg-10 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="기업명"
                                value="{{ $result->corp_name }}" />
                        </div>
                    </div>

                    {{-- 생성일 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">생성일</label>
                        <div class="col-lg-10 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="생성일"
                                value="{{ $carbon::parse($result->created_at)->format('Y.m.d') }}" />
                        </div>
                    </div>

                    {{-- 제안서 상세보기 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">제안서 상세보기</label>
                        <div class="col-lg-10 fv-row">
                            <button class="btn btn-sm btn-secondary btn-active-light-primary"
                                {{ count($proposal) > 0 ? '' : 'disabled' }}
                                onclick="window.open('{{ route('www.mypage.corp.proposal.type.detail.view', [$result->id]) }}', '_blank')">
                                제안서 상세보기
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            @foreach ($proposal as $address)
                <div class="card-header align-items-center gap-2 gap-md-5">
                    <span class="fw-bold fs-5">{{ $address->city }}</span>
                    {{-- <span class="fw-bold fs-5">갯수 : {{ $paginator-> total() }} 개</span> --}}
                </div>
                {{-- 데이터 내용 --}}
                <div class="card-body pt-0 table-responsive">

                    {{-- 테이블 --}}
                    <table id="proposal_table" class="table align-middle table-row-dashed fs-6 gy-4">
                        {{-- 테이블 헤더 --}}
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fl-7 text-uppercase gs-0">
                                <th class="text-center w-60px">번호</th>
                                <th class="text-center">건물명</th>
                                <th class="text-center w-350px">주소</th>
                                <th class="text-center">전용면적</th>
                                <th class="text-center">거래정보</th>
                                <th class="text-center">층정보</th>
                            </tr>
                        </thead>

                        {{-- 테이블 내용 --}}
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($address->products as $index => $product)
                                <tr>
                                    {{-- 매물 제안서 건물 번호 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5">{{ $index + 1 }}</span>
                                    </td>

                                    {{-- 거래정보 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            {{ $product->product_name }}
                                        </span>
                                    </td>

                                    {{-- 주소 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            {{ $product->address }} {{ $product->address_detail }}
                                        </span>
                                    </td>

                                    {{-- 면적 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            {{ $product->exclusive_square }}㎡/{{ $product->exclusive_area }}평
                                        </span>
                                    </td>

                                    {{-- 거래정보 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            {{ Lang::get('commons.payment_type.' . $product->price->payment_type) }}
                                            @if ($product->price->payment_type == 4)
                                                {{ Commons::get_priceTrans($product->price->price) }} /
                                                {{ Commons::get_priceTrans($product->price->month_price) }}
                                            @else
                                                {{ Commons::get_priceTrans($product->price->price) }}
                                            @endif
                                        </span>
                                    </td>

                                    {{-- 층 정보 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            {{ $product->floor_number }}층/{{ $product->total_floor_number }}층
                                        </span>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </x-screen-card>

        </form>

    </div>


    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script></script>
</x-admin-layout>
