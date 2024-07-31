@props(['title' => '이미지', 'id' => 'image', 'images' => [], 'result' => []])


{{-- 업로드 이미지 미리보기 --}}

@if (isset($result->id))
    <li>
        <div class="document_area" id="{{ $id }}ImageName">
            <div class="document_img_reg">
                <img src="{{ Storage::url('image/') . $result->path }}" style="max-width:120px;">
            </div>
            <input type="hidden" name="{{ $id }}_image_ids[]" value="{{ $result->id }}" />
            <input type="hidden" name="{{ $id }}_image_paths[]"
                value="{{ Storage::url('image/') . $result->path }}" />
            <div class="document_name_wrap">
                <p>{{ $title }}</p>
                <p class="document_name"><span>{{ $result->path }}</span></p>
            </div>
        </div>
        <div class="gap_8">
            <button class="btn_graylight_ghost btn_sm" type="button" id="{{ $id }}_drop">업로드</button>
            <button class="btn_graylight_ghost btn_sm" type="button"
                onclick="onImageDeleteUpdate('{{ $id }}', '{{ $title }}');">삭제</button>
        </div>
    </li>
@else
    <li>
        <div class="document_area" id="{{ $id }}ImageName">
            <div class="document_img_reg">
                <div class="document_img_reg"></div>
            </div>
            <div class="document_name_wrap">
                <p>{{ $title }}</p>
                <p class="mt8 gray_basic fs_13">png 또는 jpg 업로드</p>
            </div>
        </div>
        <div class="gap_8">
            <button class="btn_graylight_ghost btn_sm" type="button" id="{{ $id }}_drop">업로드</button>
            <button class="btn_graylight_ghost btn_sm" type="button"
                onclick="onImageDeleteUpdate('{{ $id }}', '{{ $title }}');">삭제</button>
        </div>
    </li>
@endif


<script>
    var {{ $id }}imageDropzone = new Dropzone("#{{ $id }}_drop", {
        url: "{{ route('api.imageupload') }}", // URL
        method: 'post', // method
        paramName: "image", // 파라미터 이름
        maxFiles: 1, // 파일 갯수
        maxFilesize: 1000, // MB
        timeout: 300000, // 타임아웃 30초 기본 설정
        acceptedFiles: '.jpeg,.jpg,.png,.JPEG,.JPG,.PNG', // 이미지 파일 포맷만 허
        accept: function(file, done) {
            done();
        },
        success: function(file, responseText) {

            var imagePath = '{{ Storage::url('image/') }}' + responseText.result.path;

            var image =

                `<input type="hidden" name="{{ $id }}_image_ids[]" value="${responseText.result.id}" />
                <input type="hidden" name="{{ $id }}_image_paths[]" value="${imagePath}" />

                <div class="document_img_reg">
                    <img src="${imagePath}" style="max-width:120px;">
                </div>
                <div class="document_name_wrap">
                    <p>{{ $title }}</p>
                    <p class="document_name"><span>${responseText.result.path}</span></p>
                </div>`

            $("#{{ $id }}ImageName").html(image);

            {{ $id }}imageDropzone.removeFile(file);
        },
        error: function(file, errorMessage) {
            // 업로드 실패 시 알림창 띄우기
            alert('이미지 업로드에 실패했습니다. 다시 시도해 주세요.');
            // 실패한 파일 제거
            onImageDeleteUpdate('{{ $id }}', '{{ $title }}')
        }
    });

    // 이미지 삭제
    var onImageDeleteUpdate = (id, title) => {

        var image =

            `<div class="document_img_reg">
                    <div class="document_img_reg"></div>
                </div>
                <div class="document_name_wrap">
                    <p>` + title + `</p>
                    <p class="mt8 gray_basic fs_13">png 또는 jpg 업로드</p>
                </div>`

        $("#" + id + "ImageName").html(image);
    }

    // 이미지 제거
    function {{ $id }}removeImage() {
        $('.{{ $id }}_drop_zone').html('');
        $("#{{ $id }}_drop").show()
    }
</script>
