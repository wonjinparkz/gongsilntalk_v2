@props(['images' => []])




{{-- 업로드 이미지 미리보기 --}}
@if (count($images) > 0)
    @foreach ($images as $image)
        <div class="cell">
            <input type="hidden" id="image_ids[]" name="image_ids[]" value="{{ $image->id }}">
            <img src="{{ asset('assets/media/btn_img_delete.png') }}" class="btn_img_delete">
            <div class="img_box"><img src="{{ Storage::url('image/' . $image->path) }}">
            </div>
        </div>
    @endforeach
@endif
<div class="cell">
    <button type="button">
        <div class="img_box"><img src="{{ asset('assets/media/btn_img_add.png') }}">
        </div>
    </button>
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
            var imageCount = document.querySelectorAll('input[name="{{ $id }}_image_paths[]"]')
                .length;

            var imagePath = '{{ Storage::url('image/') }}' + responseText.result.path;

            var image =

                '<input type="hidden" name="{{ $id }}_image_ids[]" value="' + responseText.result
                .id + '" />' +
                '<input type="hidden" name="{{ $id }}_image_paths[]" value="' + imagePath +
                '" />' +
                '<div class="img_box draggable-handle"><img src="' + imagePath +
                '"><span onClick="{{ $id }}removeImage(this)">삭제</span></div>'

            $(".{{ $id }}_drop_zone").html(image);
            {{ $id }}imageDropzone.removeFile(file);
            refreshFsLightbox();
        }
    });



    // 이미지 제거
    function {{ $id }}removeImage() {
        $('.{{ $id }}_drop_zone').html('');
        $("#{{ $id }}_drop").show()
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
