@props(['title' => '화면명'])

{{-- 카드 START --}}
<div class="card mb-5 mb-xl-10 card-flush shadow-sm mt-10">
    {{-- 카드 헤더 START --}}
    <div class="card-header border-0 cursor-pointer">
        <!--begin::Card title-->
        <div class="card-title m-0">
            {{-- 페이지 제목 --}}
            <div class="d-inline-block position-relative gap-2 gap-lg-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">
                    {{ $title }}
                </h1>
            </div>
        </div>
        <!--end::Card title-->
    </div>
    {{-- 카드 해더 END --}}
    {{-- 내용 START --}}
    {{ $slot }}
    {{-- 내용 END --}}
</div>
{{-- 카드 END --}}
