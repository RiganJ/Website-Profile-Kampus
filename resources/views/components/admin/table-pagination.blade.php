@props(['paginator'])
<div class="admin-table-footer">
    <p class="admin-table-summary" role="status">
        @if($paginator->total())
            Menampilkan <strong>{{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }}</strong> dari <strong>{{ number_format($paginator->total(), 0, ',', '.') }}</strong> data
        @else
            Tidak ada data yang ditemukan. Coba kata kunci lain atau reset pencarian.
        @endif
    </p>
    {{ $paginator->onEachSide(1)->fragment(str_replace('_page', '', $paginator->getPageName()).'-table')->links('admin.components.pagination') }}
</div>
