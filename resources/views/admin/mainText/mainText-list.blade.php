<x-admin-layout>
    {{-- 기본 - 모양 --}}
    <div class="d-flex flex-column flex-column-fluid">
        {{-- 화면 툴바 - 제목, 버튼 --}}
        <div class="app-toolbar py-3 py-lg-6">
            <div class="app-container container-xxl d-flex flex-stack">
                {{-- 페이지 제목 --}}
                <div class="d-inline-block position-relative">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-5ts flex-column justify-content-center ">매거진 카테고리
                        관리
                    </h1>
                    <span
                        class="d-inline-block position-absolute mt-3 h-8px bottom-0 end-0 start-0 bg-success translate rounded" />
                </div>
            </div>
        </div>
        <div class="app-content flex-column-fluid">

            <div class="app-container container-xxl">
                <div class="card card-flush shadow-sm">
                    <form class="form card-body row border-top p-9 align-items-center" method="POST"
                        action="{{ route('admin.main.text.create') }}">
                        {{-- 제목 --}}
                        <div class="col-lg-8 row">
                            <label class="col-lg-3 col-form-label fw-semibold fs-6 required">노출될 텍스트</label>
                            <div class="col-lg-6 fv-row">
                                <input type="text" id="title" name="title"
                                    class="form-control form-control-solid" placeholder="텍스트를 입력해 주세요."
                                    value="{{ Request::get('title') }}" />

                            </div>
                            <button type="submit" class="btn ms-10 col-lg-2 btn-primary">등록</button>
                        </div>
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('title')" />
                    </form>

                </div>

                <form id="titleUpdate" method="POST" action="{{ route('admin.main.text.title.update') }}">
                    <input name="id" type="hidden" id="titleId" value="" />
                    <input name="mainText" type="hidden" id="mainText" value="" />
                </form>

                <form id="deleteMainText" action="{{ route('admin.main.text.delete') }}"
                    method="POST">
                    <input type="hidden" name="deleteId" id="deleteId" value="" />
                </form>

                <div class="card card-flush shadow-sm mt-10">
                    <form method="POST" action="{{ route('admin.main.text.order.update') }}">
                        <button class="btn col-lg-2 btn-primary mt-10 ms-10">순서 저장</button>
                        <div class="col-lg-10 draggable-zone m-10">

                            @foreach ($result as $category)
                                {{-- Drag Item START --}}
                                <div class="draggable mb-5">
                                    <div class="card card-bordered">
                                        <div class="card-body row align-items-center">
                                            <div class="col-lg-1 draggable-handle ">
                                                <i class="fa-solid fa-grip-lines fs-2x"></i>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" name="category[{{ $category->id }}][title]"
                                                    id="category{{ $category->id }}"
                                                    class="form-control form-control-solid" placeholder="카테고리"
                                                    value="{{ $category->title }}" />
                                                <input type="hidden" name="id[]" value="{{ $category->id }}" />
                                            </div>


                                            <a href="javascript:titleUpdate({{ $category->id }}, 0)"
                                                class="btn col-lg-2 me-2 btn-primary">수정</a>
                                            <a href="javascript:deleteAlert({{ $category->id }});"
                                                class="btn col-lg-2 btn-danger">삭제</a>

                                        </div>
                                    </div>
                                </div>
                                {{-- Drag Item END --}}
                            @endforeach
                        </div>
                        <x-input-error class="mt-2 ms-10 text-danger" :messages="$errors->get('mainText')" />
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- * 페이지에서 사용하는 자바스크립트 --}}
    <script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}"></script>
    <script>
        var containers = document.querySelectorAll(".draggable-zone");
        var swappable = new Sortable.default(containers, {
            draggable: ".draggable",
            handle: ".draggable .draggable-handle",
            mirror: {
                appendTo: "body",
                constrainDimensions: true
            }
        });

        // 카테고리 변경
        function titleUpdate(id) {
            $("#titleId").val(id);
            $("#mainText").val($("#category" + id).val())
            $("#titleUpdate").submit();
        }

        // 삭제 물음
        function deleteAlert(id) {
            $("#deleteId").val(id);
            Swal.fire({
                text: "삭제하시겠습니까?\n삭제후에는 되돌릴 수 없습니다!",
                icon: "question",
                dangerMode: true,
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonText: "취소",
                confirmButtonText: "확인",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-secondary"
                }
            }).then(function(result) {
                if (result.value) {
                    $('#deleteMainText').submit();
                }
            });
        }
    </script>

</x-admin-layout>
