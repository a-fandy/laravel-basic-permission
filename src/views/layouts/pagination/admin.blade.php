@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination">
        @if (!$paginator->onFirstPage())
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a></li>
        @endif

        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item" aria-disabled="true"><a class="page-link" href="#">{{ $element }}</a></li>
            @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a></li>
        @endif
    </ul>
</nav>
@endif