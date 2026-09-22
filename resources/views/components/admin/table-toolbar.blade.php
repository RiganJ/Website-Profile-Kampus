@props(['name', 'label' => 'Cari data', 'paginator'])
@php
    $searchKey = $name.'_search';
    $sizeKey = $name.'_per_page';
    $pageKey = $name.'_page';
    $search = request()->query($searchKey, '');
    $search = is_string($search) ? mb_substr($search, 0, 150) : '';
@endphp
<form method="GET" action="{{ url()->current() }}#{{ $name }}-table" class="admin-table-toolbar" role="search" aria-label="{{ $label }}" id="{{ $name }}-table">
    @foreach(request()->query() as $key => $value)
        @if(!in_array($key, [$searchKey, $sizeKey, $pageKey]) && is_scalar($value))
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach
    <div class="admin-table-search">
        <label for="{{ $searchKey }}">{{ $label }}</label>
        <div class="admin-search-field">
            <i class="fas fa-search" aria-hidden="true"></i>
            <input type="search" id="{{ $searchKey }}" name="{{ $searchKey }}" value="{{ $search }}" placeholder="Ketik kata kunci…" maxlength="150" autocomplete="off">
        </div>
    </div>
    <div class="admin-table-size">
        <label for="{{ $sizeKey }}">Baris per halaman</label>
        <select id="{{ $sizeKey }}" name="{{ $sizeKey }}">
            @foreach([5, 10, 25, 50] as $size)
                <option value="{{ $size }}" @selected($paginator->perPage() === $size)>{{ $size }} baris</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary"><i class="fas fa-search" aria-hidden="true"></i> Cari</button>
    @if($search !== '')
        <a class="btn btn-light" href="{{ request()->fullUrlWithoutQuery([$searchKey, $pageKey]) }}#{{ $name }}-table">Reset</a>
    @endif
</form>
