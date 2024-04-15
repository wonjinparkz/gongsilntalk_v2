<x-admin-layout>
    <div class="app-container container-xxl">
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">매물 제안서
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
                            @if ($result->users->images != null)
                                @foreach ($result->users->images as $image)
                                    <img src="{{ Storage::url('image/' . $image->path) }}" />
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
                                @inject('carbon', 'Carbon\Carbon')
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
                                    placeholder="등록매물" value="{{ count($result->products) }}개" />
                            </div>
                        </div>

                        {{-- 작성 제안서 개수 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">작성 제안서 개수</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="작성 제안서 개수" value="123개" />
                            </div>
                        </div>

                        {{-- 등록일 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">등록일</label>
                            <div class="col-lg-8 fv-row">
                                @inject('carbon', 'Carbon\Carbon')
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="등록일"
                                    value=" {{ $carbon::parse($result->users->created_at)->format('Y.m.d') }}" />
                            </div>
                        </div>
                    @endif

                </div>

            </div>
        </x-screen-card>

        <x-screen-card :title="'제안서 요청 정보'">
            <div class="card-body border-top p-9">
                <div class="row">

                    {{-- 희망 지역 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">희망 지역</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="희망 지역" value="서울특별시 서초구, 서웉특별시 동대문구, 서울특별시 영등포구" />
                        </div>
                    </div>

                    {{-- 회사명 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">회사명</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="회사명"
                                value="{{ $result->client_name }}" />
                        </div>
                    </div>

                    {{-- 업종 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">업종</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="업종"
                                value="{{ Lang::get('commons.business_type.' . $result->business_type) }}" />
                        </div>
                    </div>

                    {{-- 사용인원 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">사용인원</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="사용인원"
                                value="{{ $result->users_count }}명" />
                        </div>
                    </div>

                    {{-- 희망 면적 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">희망 면적</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="희망 면적" value="{{ $result->area }}평" />
                        </div>
                    </div>

                    {{-- 예산 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">예산</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid" placeholder="예산"
                                value="{{ $result->payment_type == 0 ? '매매 ' . Commons::get_priceTrans($result->price) : '임대 ' . Commons::get_priceTrans($result->price) . ' / ' . Commons::get_priceTrans($result->month_price) }}" />
                        </div>
                    </div>

                    {{-- 입주가능일 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">입주가능일</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="입주가능일"
                                value="{{ Commons::get_moveType($result->move_type, $result->start_move_date, $result->ended_move_date) }}" />
                        </div>
                    </div>

                    @if ($result->type == 2)
                        {{-- 희망 상가 층 --}}
                        <div class="col-lg-12 row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">희망 상가 층</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" disabled class="form-control form-control-solid"
                                    placeholder="희망 상가 층"
                                    value="{{ Commons::get_floorType($result->floor_type) }}" />
                            </div>
                        </div>
                    @endif

                    {{-- 인테리어 유무 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">인테리어 유무</label>
                        <div class="col-lg-8 fv-row">
                            <input type="text" disabled class="form-control form-control-solid"
                                placeholder="인테리어 유무"
                                value="{{ Commons::get_interiorType($result->interior_type) }}" />
                        </div>
                    </div>

                    {{-- 요청사항 --}}
                    <div class="col-lg-12 row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">요청사항</label>
                        <div class="col-lg-8 fv-row">
                            <textarea disabled name="content" class="form-control form-control-solid mb-5" rows="5">{{ $result->content }}</textarea>
                        </div>
                    </div>

                </div>

            </div>
        </x-screen-card>

        <x-screen-card :title="'받은 제안서 목록'">
            <div class="card-header align-items-center gap-2 gap-md-5">
                <span class="fw-bold fs-5">제안된 매물 <span
                        class="text-danger">{{ count($result->products) }}개</span></span><span
                    class="fw-light fs-6">단위 : 원</span>
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
                            <th class="text-center">사진</th>
                            <th class="text-center">거래정보</th>
                            <th class="text-center">주소</th>
                            <th class="text-center">면적</th>
                            <th class="text-center">층정보</th>
                            <th class="text-center">관리비</th>
                        </tr>
                    </thead>

                    {{-- 테이블 내용 --}}
                    <tbody class="fw-semibold text-gray-600">
                        @if ($result->products)
                            @foreach ($result->products as $product)
                                <tr>
                                    {{-- 매물 제안서 건물 번호 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5">1</span>
                                    </td>

                                    {{-- 사진 --}}
                                    <td class="text-center">
                                        <div class="symbol symbol-70px">
                                            <div class="symbol-label"
                                                style="background-image:url({{ asset('assets/media/default_user.png') }})">
                                            </div>
                                        </div>
                                    </td>

                                    {{-- 거래정보 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            임대 3억 2,220만/4,500만
                                        </span>
                                        <p class="fs-6">(800만/㎡)</p>
                                    </td>

                                    {{-- 주소 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            강남구 역삼동 123-12
                                        </span>
                                    </td>

                                    {{-- 면적 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            전용 112.05㎡/100평
                                        </span>
                                    </td>

                                    {{-- 층 정보 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            3층/12층
                                        </span>
                                    </td>

                                    {{-- 관리비 --}}
                                    <td class="text-center">
                                        <span class="fw-bold fs-5 text-dark">
                                            {{ 100000 / 10000 }}만원
                                        </span>
                                    </td>

                                </tr>
                            @endforeach

                        @endif
                    </tbody>
                </table>
            </div>

        </x-screen-card>

        </form>

    </div>


    {{--
       * 페이지에서 사용하는 자바스크립트
    --}}
    <script></script>
</x-admin-layout>
