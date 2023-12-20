<x-guest-layout>
    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-10 p-lg-15">
            <!--begin::Content main-->
            <div class="col-lg-4 fv-row">
                <select id="terms_id" class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                    onchange="changeTerms(this);">
                    @foreach ($result as $terms)
                        <option value="{{ $terms->id }}" @if ($terms->id == $term->id) selected @endif>
                            {{ $terms->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-20 mb-14">
                <div class="mb-15">
                    {!! $term->content !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        function changeTerms(obj) {
            var id = $(obj).val();
            location.href = '{{ route('terms.preview', ['kind' => $term->kind, 'type' => $term->type]) }}' + '/' + id;
        }
    </script>

</x-guest-layout>
