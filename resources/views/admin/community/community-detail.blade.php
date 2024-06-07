<x-admin-layout>
    <div class="app-container container-xxl">
        <x-screen-card :title="'커뮤니티 상세'">
            {{-- FORM START  --}}
            {{-- 내용 START --}}
            <div class="card-body border-top p-9">

                {{-- 제목 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">제목</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {{ $result->title }}
                        </span>
                    </div>
                </div>

                {{-- 작성자 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">작성자</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {{ $result->author_nickname }}
                        </span>
                    </div>
                </div>


                {{-- 업로드 이미지 미리보기 --}}
                {{-- <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">대표 이미지</label>
                    <div class="x_scroll_img_reg col-lg-8">
                        <ul class="img_reg_ul" id="image_reg">
                            @foreach ($result->images as $image)
                                <div class="symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px">
                                    <a class="col symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px"
                                        data-fslightbox="lightbox-basic"
                                        href="{{ Storage::url('image/' . $image->path) }}">
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px w-175px"
                                            style="background-image:url({{ Storage::url('image/' . $image->path) }})">
                                        </div>
                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"><i
                                                class="bi bi-eye-fill text-white fs-3x"></i></div>
                                    </a>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}

                {{-- 업로드 이미지 미리보기 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">상세 이미지</label>
                    <div class="x_scroll_img_reg col-lg-8">
                        <ul class="img_reg_ul" id="image_reg">
                            @foreach ($result->images as $image)
                                <div class="symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px">
                                    <a class="col symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px"
                                        data-fslightbox="lightbox-basic"
                                        href="{{ Storage::url('image/' . $image->path) }}">
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px w-175px"
                                            style="background-image:url({{ Storage::url('image/' . $image->path) }})">
                                        </div>
                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"><i
                                                class="bi bi-eye-fill text-white fs-3x"></i></div>
                                    </a>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- 내용 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">내용</label>
                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {!! nl2br($result->content) !!}
                        </span>
                    </div>
                </div>

                {{-- 작성일 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">작성일</label>

                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            @inject('carbon', 'Carbon\Carbon')
                            {{ $carbon::parse($result->created_at)->format('Y년 m월 d일 H:m') }}
                        </span>
                    </div>
                </div>

                {{-- 조회수 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">조회수</label>

                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {{ $result->view_count }}
                        </span>
                    </div>
                </div>

                {{-- 추천수 --}}
                <div class="row mb-6">
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">추천수</label>

                    <div class="col-lg-8 fv-row">
                        <span class="fw-bold fs-5">
                            {{ $result->like_count }}
                        </span>
                    </div>
                </div>

            </div>
            <!--내용 END-->

        </x-screen-card>

        <x-screen-card :title="'댓글'">
            <x-admin-community-reply :result="$result" :replys="$replys" :route="'admin.community.detail.view'" />
        </x-screen-card>

    </div>

    {{--
           * 페이지에서 사용하는 자바스크립트
        --}}
    <script>
        var hostUrl = "assets/";

    </script>
</x-admin-layout>
