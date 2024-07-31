@props([
    'title' => '이미지',
    'required' => '',
    'cnt' => '5',
    'id' => 'image',
    'label_col' => '4',
    'div_col' => '8',
    'images' => [],
])
<style>
    .top_tit{display:flex; justify-content: space-between; align-items: center;}
</style>
<div class="row mb-6">
    <label
        class="col-lg-{{ $label_col }} col-form-label fw-semibold fs-6 {{ $required }}">{{ $title }}</label>
    <div class="col-lg-{{ $div_col }}">
        <div class="top_tit">
            <p class="fw-light">최대 {{ $cnt }}장 업로드 가능
                <span style="color: #F16341"
                    id="{{ $id }}_image_count">{{ count(old($id . '_image_ids', $images)) }}</span>/{{ $cnt }}
            </p>
            <p>1080 x 800</p>
        </div>
        <div class="dropzone " id="{{ $id }}_drop">
            <div class="dz-message needsclick">
                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                <div class="ms-4">
                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">파일을 업로드 하세요.</h3>
                    <span class="fs-7 fw-semibold text-gray-400">이미지는 "png, jpg, jpeg" 만 가능합니다.
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 업로드 이미지 미리보기 --}}

<div class="row">
    <label class="col-lg-{{ $label_col }} col-form-label fw-semibold fs-6"></label>
    <div class="col-lg-{{ $div_col }} mb-10 overflow-auto" id="{{ $id }}_preview">
        @php
            $oldIds = old($id . '_image_ids');
            $oldPaths = old($id . '_image_paths');
        @endphp
        @if ($oldIds != null)
            @for ($i = 0; $i < count($oldIds); $i++)
                <div class="symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px">
                    <input type="hidden" name="{{ $id }}_image_ids[]" value="{{ $oldIds[$i] }}" />
                    <input type="hidden" name="{{ $id }}_image_paths[]" value="{{ $oldPaths[$i] }}" />
                    <a class="col symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px"
                        data-fslightbox="lightbox-basic" href="{{ $oldPaths[$i] }}">
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px w-175px"
                            style="background-image:url({{ $oldPaths[$i] }})"></div>
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"><i
                                class="bi bi-eye-fill text-white fs-3x"></i></div>
                    </a><a onClick="removeImage(this)" class="col-lg-12 btn btn-light-danger">삭제</a>
                </div>
            @endfor
        @else
            @foreach ($images as $image)
                <div class="symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px">
                    <input type="hidden" name="{{ $id }}_image_ids[]" value="{{ $image->id }}" />
                    <input type="hidden" name="{{ $id }}_image_paths[]"
                        value="{{ Storage::url('image/' . $image->path) }}" />
                    <a class="col symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px"
                        data-fslightbox="lightbox-basic" href="{{ Storage::url('image/' . $image->path) }}">
                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px w-175px"
                            style="background-image:url({{ Storage::url('image/' . $image->path) }})"></div>
                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"><i
                                class="bi bi-eye-fill text-white fs-3x"></i></div>
                    </a><a onClick="removeImage(this)" class="col-lg-12 btn btn-light-danger">삭제</a>
                </div>
            @endforeach
        @endif
        <x-input-error class="mt-2 text-danger" :messages="$errors->get($id . '_image_ids')" />
    </div>
</div>

<script>
    var {{ $id }}imageDropzone = new Dropzone("#{{ $id }}_drop", {
        url: "{{ route('api.imageupload') }}", // URL
        method: 'post', // method
        paramName: "image", // 파라미터 이름
        maxFiles: 10, // 파일 갯수
        maxFilesize: 10, // MB
        timeout: 300000, // 타임아웃 30초 기본 설정
        addRemoveLinks: true, // 업로드 후 파일 삭제버튼 표시 여부
        acceptedFiles: '.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF', // 이미지 파일 포맷만 허
        accept: function(file, done) {
            done();
        },
        success: function(file, responseText) {
            var image_count = document.querySelectorAll('input[name="{{ $id }}_image_paths[]"]')
                .length;
            if (image_count >= {{ $cnt }}) {
                alert('최대 ' + {{ $cnt }} + '장 업로드 가능합니다.', '확인');
                {{ $id }}imageDropzone.removeFile(file);
                return;
            }

            var imagePath = '{{ Storage::url('image/') }}' + responseText.result.path;

            var image =
                '<div class="symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px">' +
                '<input type="hidden" name="{{ $id }}_image_ids[]" value="' + responseText.result
                .id +
                '" />' +
                '<input type="hidden" name="{{ $id }}_image_paths[]" value="' + imagePath +
                '" />' +
                '<a class="col symbol symbol-150px mb-5 me-5 overlay min-h-175px w-175px" data-fslightbox="lightbox-basic" href="' +
                imagePath + '">' +
                '<div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px w-175px" style="background-image:url(' +
                imagePath + ')"></div>' +
                '<div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"><i class="bi bi-eye-fill text-white fs-3x"></i></div></a><a onClick="removeImage(this)" class="col-lg-12 btn btn-light-danger">삭제</a></div>'


            $("#{{ $id }}_preview").append(image);
            {{ $id }}imageDropzone.removeFile(file);
            $("#{{ $id }}_image_count").html(image_count + 1);
            refreshFsLightbox();
        }
    });



    // 이미지 제거
    function removeImage(elem) {
        $(elem).parent().remove();
        var image_count = document.querySelectorAll('input[name="{{ $id }}_image_paths[]"]')
            .length;
        $("#{{ $id }}_image_count").html(image_count);
    }
</script>
