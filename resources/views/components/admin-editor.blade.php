@props(['name' => '', 'content' => ''])

<textarea name="{{ $name }}" id="{{ $name }}">{{ old($name) ?? $content }}</textarea>
<x-input-error class="mt-2 text-danger" :messages="$errors->get($name)" />

<script src="{{ asset('assets/js/ckeditor.js') }}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#{{ $name }}'), {
            simpleUpload: {
                uploadUrl: "{{ route('ckeditor.upload') }}",
                withCredentials: false,
                headers: {
                    'X-CSRF-TOKEN': 'CSRF-Token',
                }
            }
        })
        .catch(error => {
            console.error(error);
        });
</script>
