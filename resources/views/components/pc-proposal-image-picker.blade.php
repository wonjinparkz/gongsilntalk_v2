@props([
    'title' => '이미지',
    'required' => '',
    'cnt' => '5',
    'id' => 'image',
    'images' => [],
    'inputCheck' => 'false',
])


<div class="cell">
    <button type="button">
        <div class="img_box {{ $required }}"><img id="{{ $id }}_drop"
                src="{{ asset('assets/media/btn_img_add.png') }}"></div>
    </button>
</div>


{{-- 업로드 이미지 미리보기 --}}

@php
    $oldIds = old($id . '_image_ids');
    $oldPaths = old($id . '_image_paths');
@endphp
@if ($oldIds != null)
    @for ($i = 0; $i < count($oldIds); $i++)
        <div class="cell draggable">
            <input type="hidden" name="{{ $id }}_image_ids[]" value="{{ $oldIds[$i] }}" />
            <input type="hidden" name="{{ $id }}_image_paths[]" value="{{ $oldPaths[$i] }}" />
            <!-- <img src="{{ asset('assets/media/mark_rep.png') }}" class="add_img_mark"> -->
            <img onClick="removeImage(this)" src="{{ asset('assets/media/btn_img_delete.png') }}"
                class="btn_img_delete">
            <div class="img_box draggable-handle"><img src="{{ $oldPaths[$i] }}"></div>
        </div>
    @endfor
@else
    @foreach ($images as $image)
        <div class="cell draggable">
            <input type="hidden" name="{{ $id }}_image_ids[]" value="{{ $image->id }}" />
            <input type="hidden" name="{{ $id }}_image_paths[]"
                value="{{ Storage::url('image/' . $image->path) }}" />
            <!-- <img src="{{ asset('assets/media/mark_rep.png') }}" class="add_img_mark"> -->
            <img onClick="removeImage(this)" src="{{ asset('assets/media/btn_img_delete.png') }}"
                class="btn_img_delete">
            <div class="img_box draggable-handle"><img src="{{ Storage::url('image/' . $image->path) }}"></div>
        </div>
    @endforeach
@endif
<x-input-error class="mt-2 text-danger" :messages="$errors->get($id . '_image_ids')" />



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
            var imageCount = document.querySelectorAll('input[name="{{ $id }}_image_paths[]"]')
                .length;
            if (imageCount >= {{ $cnt }}) {
                alert('최대 ' + {{ $cnt }} + '장 업로드 가능합니다.', '확인');
                {{ $id }}imageDropzone.removeFile(file);
                return;
            }

            $('.imageCount').html(imageCount + 1);

            var imagePath = '{{ Storage::url('image/') }}' + responseText.result.path;

            var image =
                '<div class="cell draggable">' +
                '<input type="hidden" name="{{ $id }}_image_ids[]" value="' + responseText.result
                .id + '" />' +
                '<input type="hidden" name="{{ $id }}_image_paths[]" value="' + imagePath +
                '" />' +
                // '<img src="{{ asset('assets/media/mark_rep.png') }}" class="add_img_mark"> ' +
                '<img onClick="removeImage(this)" src="{{ asset('assets/media/btn_img_delete.png') }}"' +
                'class="btn_img_delete">' +
                '<div class="img_box draggable-handle"><img src="' + imagePath + '"></div>' +
                '</div>'

            $(".{{ $id }}_img_add_wrap").append(image);
            {{ $id }}imageDropzone.removeFile(file);
            refreshFsLightbox();

            if ({{ $inputCheck }} == true) {
                inputCheck();
            }
        }
    });



    // 이미지 제거
    function removeImage(elem) {

        $(elem).parent().remove();
        $(".imageCount").html(document.querySelectorAll('input[name="{{ $id }}_image_paths[]"]').length)
    }

    var containers = document.querySelectorAll(".draggable-zone");

    var swappable = new Sortable.default(containers, {
        draggable: ".draggable",
        handle: ".draggable .draggable-handle",
        mirror: {
            appendTo: "body",
            constrainDimensions: true
        },

    });
</script>
