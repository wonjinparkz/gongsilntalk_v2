<!-- paging : s -->
<div class="paging only_m">
    <ul class="btn_wrap">
        @if ($paginator->onFirstPage())
            <li class="btn_prev">
                <a class="no_next" disabled>
                    <img src="{{ asset('assets/media/btn_prev.png') }}" alt="">
                </a>
            </li>
        @else
            <li class="btn_prev">
                {{-- <a class="no_next" href="{{ $paginator->previousPageUrl() }}"> --}}
                <a class="no_next" onclick="loadMoreData(1, 1);">
                    <img src="{{ asset('assets/media/btn_prev.png') }}" alt="">
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active">{{ $page }}
                        </li>
                    @else
                        <li onclick="loadMoreData('{{ $page }}', 1);">{{ $page }}
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="btn_next">
                <a class="no_next" onclick="loadMoreData('{{ $paginator->currentPage() + 1 }}', 1);">
                    <img src="{{ asset('assets/media/btn_next.png') }}" alt="">
                </a>
            </li>
        @else
            <li class="btn_next">
                <a class="no_next" disabled>
                    <img src="{{ asset('assets/media/btn_next.png') }}" alt="">
                </a>
            </li>
        @endif
    </ul>
</div>
<!-- paging : e -->
