@if ($paginator->hasPages())
<nav aria-label="Navigasi halaman {{ str_replace('_page', '', $paginator->getPageName()) }}">
    <ul class="admin-pagination">
        <li>
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" class="disabled">Sebelumnya</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a>
            @endif
        </li>
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><span class="disabled">{{ $element }}</span></li>
            @else
                @foreach ($element as $page => $url)
                    <li>
                        @if ($page == $paginator->currentPage())
                            <span class="current" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" aria-label="Halaman {{ $page }}">{{ $page }}</a>
                        @endif
                    </li>
                @endforeach
            @endif
        @endforeach
        <li>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next">Berikutnya</a>
            @else
                <span aria-disabled="true" class="disabled">Berikutnya</span>
            @endif
        </li>
    </ul>
</nav>
@endif
