@props(['title' => '이미지', 'required' => '', 'id' => 'file', 'files' => []])

<div class="row mb-6">
    <label class="col-lg-4 col-form-label fw-semibold fs-6 {{ $required }}">{{ $title }}</label>
    <div class="col-lg-8">
        <div class="dropzone " id="{{ $id }}_file_drop">
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
    <label class="col-lg-4 col-form-label fw-semibold fs-6"></label>
    <div class="col-lg-8 mb-10 overflow-auto" id="{{ $id }}_file_preview">
        @php
            $oldIds = old($id . '_file_ids');
            $oldName = old($id . '_file_name');
        @endphp
        @if ($oldIds != null)
            @for ($i = 0; $i < count($oldIds); $i++)
                <div class="symbol symbol-150px mb-5 me-5 overlay min-h-50px">
                    <input type="hidden" name="{{ $id }}_file_ids[]" value="{{ $oldIds[$i] }}" />
                    <input type="hidden" name="{{ $id }}_file_name[]" value="{{ $oldName[$i] }}" />
                    <p>{{ $oldName[$i] }}</p>
                    <a onClick="removeImage(this)" class="btn btn-light-danger w-100px">삭제</a>
                </div>
            @endfor
        @else
            @foreach ($files as $file)
                <div class="symbol symbol-150px mb-5 me-5 overlay min-h-50px">
                    <input type="hidden" name="{{ $id }}_file_ids[]" value="{{ $file->id }}" />
                    <input type="hidden" name="{{ $id }}_file_name[]" value="{{ $file->name }}" />
                    <p>
                        <a href="{{ route('api.filedownload', [$file->path]) }}" class="point_link">
                            {{ $file->name }}
                        </a>
                    </p>
                    <a onClick="removeImage(this)" class="btn btn-light-danger w-100px">삭제</a>
                </div>
            @endforeach
        @endif
    </div>

</div>


<script>
    var {{ $id }}fileDropzone = new Dropzone("#{{ $id }}_file_drop", {
        url: "{{ route('api.fileupload') }}", // URL
        method: 'post', // method
        paramName: "file", // 파라미터 이름
        maxFiles: 10, // 파일 갯수
        timeout: 300000, // 타임아웃 30초 기본 설정
        addRemoveLinks: true, // 업로드 후 파일 삭제버튼 표시 여부
        acceptedFiles: '.jpg,.jpeg,.bmp,.png,.doc,.docx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip',
        accept: function(file, done) {
            done();
        },
        success: function(file1, responseText) {

            var filePath = '{{ Storage::url('file/') }}' + responseText.result.path;

            var file =
                `<div class="symbol symbol-150px mb-5 me-5 overlay min-h-50px">
                            <input type="hidden" name="{{ $id }}_file_ids[]" value="${responseText.result.id}" />
                            <input type="hidden" name="{{ $id }}_file_name[]" value="${responseText.result.name}" />
                            <p>${responseText.result.name}</p>
                            <a onClick="removeImage(this)" class="btn btn-light-danger w-100px" >삭제</a>
                        </div>`

            $("#{{ $id }}_file_preview").append(file);
            {{ $id }}fileDropzone.removeFile(file1);
            refreshFsLightbox();
        }
    });


    // 이미지 제거
    function removeFilee(elem) {
        $(elem).parent().remove();
    }
</script>
