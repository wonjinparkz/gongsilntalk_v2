<div class="d-flex justify-content-between align-items-center ms-10 mb-10 me-10">

    <div class=" p-1">
        <select id="pageOptionSelect" class="form-select" data-control="select2" data-hide-search="true"
            onchange="changePageOption()">
            <option value="10" @if ($paginator->perPage() == 10) selected @endif>10개씩 보기</option>
            <option value="20" @if ($paginator->perPage() == 20) selected @endif>20개씩 보기</option>
            <option value="50" @if ($paginator->perPage() == 50) selected @endif>50개씩 보기</option>
            <option value="100" @if ($paginator->perPage() == 100) selected @endif>100개씩 보기</option>
        </select>
    </div>
    @if ($paginator->hasPages())
        <div class="p-2">
            <ul class="pagination pagination-outline">
                @if ($paginator->onFirstPage())
                    <li class="page-item previous disabled"><a href="#" class="page-link"><i
                                class="previous"></i></a>
                    </li>
                @else
                    <li class="page-item previous"><a href="{{ $paginator->previousPageUrl() }}" class="page-link"><i
                                class="previous"></i></a></li>
                @endif
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a href="#" class="page-link">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item"><a href="{{ $url }}"
                                        class="page-link">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li class="page-item next"><a href="{{ $paginator->nextPageUrl() }}" class="page-link"><i
                                class="next"></i></a></li>
                @else
                    <li class="page-item next disabled"><a href="#" class="page-link"><i class="next"></i></a>
                    </li>
                @endif
            </ul>
        </div>
    @endif
</div>

<script>
    var pageOptionSelect = document.getElementById("pageOptionSelect"); //$("#pageOptionSelect");
    var currentUrl = new URL(document.location);
    // 페이지 변경
    function changePageOption() {
        var selectValue = pageOptionSelect.options[pageOptionSelect.selectedIndex].value;
        currentUrl.searchParams.set('page', 1);
        currentUrl.searchParams.set('per_page', selectValue);
        location.href = currentUrl;
    }
</script>
