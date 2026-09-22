@php
    $links = old('academic_links', $profile->academic_links ?: []);
    $content = old('content', $profile->content_data ?: []);
    $rows = function (string $key, array $blank) use ($content) {
        $items = $content[$key] ?? [];
        return count($items) ? $items : [$blank];
    };
@endphp

@section('css')
@parent
<style>
    .profile-form-section {
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 18px;
        margin-bottom: 18px;
        background: #fff;
    }
    .profile-form-section h5 {
        font-weight: 800;
        color: #111827;
        margin-bottom: 14px;
    }
    .repeat-row {
        border: 1px solid #eef2f7;
        border-radius: 10px;
        padding: 14px;
        margin-bottom: 10px;
        background: #f8fafc;
    }
    .repeat-remove {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        border: 0;
        background: #e11d48;
        color: #fff;
    }
</style>
@endsection

<div class="profile-form-section">
    <h5>Data Utama</h5>

    <label class="mb-1">Nama Lengkap</label>
    <input type="text" name="name" class="form-control mb-3" value="{{ old('name', $profile->name) }}" required>

    <label class="mb-1">Slug URL</label>
    <input type="text" name="slug" class="form-control mb-3" value="{{ old('slug', $profile->slug) }}" placeholder="Contoh: rektor">

    <label class="mb-1">Jabatan</label>
    <input type="text" name="position" class="form-control mb-3" value="{{ old('position', $profile->position) }}" placeholder="Contoh: Rektor" required>

    <label class="mb-1">Path Foto</label>
    <input type="text" name="photo_path" class="form-control mb-3" value="{{ old('photo_path', $profile->photo_path) }}" placeholder="images/rektor.jpg atau https://domain.com/foto.jpg">

    <div class="row">
        <div class="col-md-6">
            <label class="mb-1">Email</label>
            <input type="email" name="email" class="form-control mb-3" value="{{ old('email', $profile->email) }}">
        </div>
        <div class="col-md-6">
            <label class="mb-1">No. Telepon</label>
            <input type="text" name="phone" class="form-control mb-3" value="{{ old('phone', $profile->phone) }}">
        </div>
    </div>

    <label class="mb-1">Ringkasan</label>
    <textarea name="summary" class="form-control mb-3" rows="3">{{ old('summary', $profile->summary) }}</textarea>

    <label class="mb-1">Prioritas Tampil</label>
    <input type="number" name="sort_order" min="0" max="9999" class="form-control mb-3" value="{{ old('sort_order', $profile->sort_order ?? 0) }}">

    <div class="form-check">
        <input type="hidden" name="is_active" value="0">
        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $profile->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Tampilkan di halaman publik</label>
    </div>
</div>

<div class="profile-form-section">
    <h5>Tautan Profil Akademik</h5>
    <div class="row">
        <div class="col-md-6">
            <label class="mb-1">Scopus URL</label>
            <input type="url" name="academic_links[scopus]" class="form-control mb-3" value="{{ $links['scopus'] ?? '' }}">
        </div>
        <div class="col-md-6">
            <label class="mb-1">SINTA URL</label>
            <input type="url" name="academic_links[sinta]" class="form-control mb-3" value="{{ $links['sinta'] ?? '' }}">
        </div>
        <div class="col-md-6">
            <label class="mb-1">Google Scholar URL</label>
            <input type="url" name="academic_links[google_scholar]" class="form-control mb-3" value="{{ $links['google_scholar'] ?? '' }}">
        </div>
        <div class="col-md-6">
            <label class="mb-1">ORCID URL</label>
            <input type="url" name="academic_links[orcid]" class="form-control mb-3" value="{{ $links['orcid'] ?? '' }}">
        </div>
    </div>
</div>

<div class="profile-form-section">
    <h5>Konten Pembuka</h5>

    <label class="mb-1">Tentang</label>
    <textarea name="content[about]" class="form-control mb-3" rows="4" placeholder="Profil singkat pimpinan">{{ $content['about'] ?? '' }}</textarea>

    <div class="row">
        <div class="col-md-4">
            <label class="mb-1">Judul Section Jabatan</label>
            <input type="text" name="content[jobs_title]" class="form-control mb-3" value="{{ $content['jobs_title'] ?? '' }}" placeholder="Contoh: Riwayat Pekerjaan & Jabatan">
        </div>
        <div class="col-md-4">
            <label class="mb-1">Judul Section Publikasi</label>
            <input type="text" name="content[publications_title]" class="form-control mb-3" value="{{ $content['publications_title'] ?? '' }}" placeholder="Contoh: Publikasi Ilmiah Terkini">
        </div>
        <div class="col-md-4">
            <label class="mb-1">Judul Section HKI / Buku</label>
            <input type="text" name="content[hki_title]" class="form-control mb-3" value="{{ $content['hki_title'] ?? '' }}" placeholder="Contoh: Buku & Bahan Ajar">
        </div>
    </div>
</div>

<div class="profile-form-section" data-repeat-group="identity">
    <h5>Identitas Diri</h5>
    <div class="repeat-list">
        @foreach($rows('identity', ['label' => '', 'value' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-5">
                        <label class="mb-1">Label</label>
                        <input type="text" name="content[identity][{{ $i }}][label]" class="form-control" value="{{ $row['label'] ?? '' }}" placeholder="Contoh: Bidang Kepakaran">
                    </div>
                    <div class="col-md-6">
                        <label class="mb-1">Isi</label>
                        <input type="text" name="content[identity][{{ $i }}][value]" class="form-control" value="{{ $row['value'] ?? '' }}" placeholder="Contoh: Kesehatan Ibu & Anak">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

<div class="profile-form-section" data-repeat-group="education">
    <h5>Riwayat Pendidikan</h5>
    <div class="repeat-list">
        @foreach($rows('education', ['year' => '', 'program' => '', 'institution' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-2"><label class="mb-1">Tahun</label><input type="text" name="content[education][{{ $i }}][year]" class="form-control" value="{{ $row['year'] ?? '' }}"></div>
                    <div class="col-md-5"><label class="mb-1">Jenjang / Program Studi</label><input type="text" name="content[education][{{ $i }}][program]" class="form-control" value="{{ $row['program'] ?? '' }}"></div>
                    <div class="col-md-4"><label class="mb-1">Institusi</label><input type="text" name="content[education][{{ $i }}][institution]" class="form-control" value="{{ $row['institution'] ?? '' }}"></div>
                    <div class="col-md-1"><button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

<div class="profile-form-section" data-repeat-group="jobs">
    <h5>Riwayat Pekerjaan & Jabatan</h5>
    <div class="repeat-list">
        @foreach($rows('jobs', ['period' => '', 'position' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-3"><label class="mb-1">Periode</label><input type="text" name="content[jobs][{{ $i }}][period]" class="form-control" value="{{ $row['period'] ?? '' }}"></div>
                    <div class="col-md-8"><label class="mb-1">Jabatan</label><input type="text" name="content[jobs][{{ $i }}][position]" class="form-control" value="{{ $row['position'] ?? '' }}"></div>
                    <div class="col-md-1"><button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

<div class="profile-form-section" data-repeat-group="research">
    <h5>Penelitian</h5>
    <div class="repeat-list">
        @foreach($rows('research', ['year' => '', 'title' => '', 'funding' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-2"><label class="mb-1">Tahun</label><input type="text" name="content[research][{{ $i }}][year]" class="form-control" value="{{ $row['year'] ?? '' }}"></div>
                    <div class="col-md-7"><label class="mb-1">Judul Penelitian</label><input type="text" name="content[research][{{ $i }}][title]" class="form-control" value="{{ $row['title'] ?? '' }}"></div>
                    <div class="col-md-2"><label class="mb-1">Pendanaan</label><input type="text" name="content[research][{{ $i }}][funding]" class="form-control" value="{{ $row['funding'] ?? '' }}"></div>
                    <div class="col-md-1"><button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

<div class="profile-form-section" data-repeat-group="achievements">
    <h5>Prestasi & Pencapaian</h5>
    <div class="repeat-list">
        @foreach($rows('achievements', ['year' => '', 'description' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-2"><label class="mb-1">Tahun</label><input type="text" name="content[achievements][{{ $i }}][year]" class="form-control" value="{{ $row['year'] ?? '' }}"></div>
                    <div class="col-md-9"><label class="mb-1">Pencapaian</label><input type="text" name="content[achievements][{{ $i }}][description]" class="form-control" value="{{ $row['description'] ?? '' }}"></div>
                    <div class="col-md-1"><button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

<div class="profile-form-section" data-repeat-group="publications">
    <h5>Publikasi Ilmiah</h5>
    <div class="repeat-list">
        @foreach($rows('publications', ['year' => '', 'title' => '', 'note' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-2"><label class="mb-1">Tahun</label><input type="text" name="content[publications][{{ $i }}][year]" class="form-control" value="{{ $row['year'] ?? '' }}"></div>
                    <div class="col-md-6"><label class="mb-1">Judul Publikasi</label><input type="text" name="content[publications][{{ $i }}][title]" class="form-control" value="{{ $row['title'] ?? '' }}"></div>
                    <div class="col-md-3"><label class="mb-1">Keterangan</label><input type="text" name="content[publications][{{ $i }}][note]" class="form-control" value="{{ $row['note'] ?? '' }}"></div>
                    <div class="col-md-1"><button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

<div class="profile-form-section" data-repeat-group="hki">
    <h5>Perolehan HKI</h5>
    <div class="repeat-list">
        @foreach($rows('hki', ['year' => '', 'title' => '', 'type' => '', 'number' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-2"><label class="mb-1">Tahun</label><input type="text" name="content[hki][{{ $i }}][year]" class="form-control" value="{{ $row['year'] ?? '' }}"></div>
                    <div class="col-md-5"><label class="mb-1">Judul</label><input type="text" name="content[hki][{{ $i }}][title]" class="form-control" value="{{ $row['title'] ?? '' }}"></div>
                    <div class="col-md-2"><label class="mb-1">Jenis</label><input type="text" name="content[hki][{{ $i }}][type]" class="form-control" value="{{ $row['type'] ?? '' }}"></div>
                    <div class="col-md-2"><label class="mb-1">No. Pendaftaran</label><input type="text" name="content[hki][{{ $i }}][number]" class="form-control" value="{{ $row['number'] ?? '' }}"></div>
                    <div class="col-md-1"><button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

<div class="profile-form-section" data-repeat-group="community">
    <h5>Pengabdian Masyarakat</h5>
    <div class="repeat-list">
        @foreach($rows('community', ['year' => '', 'title' => '', 'role' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-2"><label class="mb-1">Tahun</label><input type="text" name="content[community][{{ $i }}][year]" class="form-control" value="{{ $row['year'] ?? '' }}"></div>
                    <div class="col-md-7"><label class="mb-1">Judul Kegiatan</label><input type="text" name="content[community][{{ $i }}][title]" class="form-control" value="{{ $row['title'] ?? '' }}"></div>
                    <div class="col-md-2"><label class="mb-1">Peran</label><input type="text" name="content[community][{{ $i }}][role]" class="form-control" value="{{ $row['role'] ?? '' }}"></div>
                    <div class="col-md-1"><button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

<div class="profile-form-section" data-repeat-group="additional_sections">
    <h5>Section Tambahan</h5>
    <div class="repeat-list">
        @foreach($rows('additional_sections', ['title' => '', 'body' => '']) as $i => $row)
            <div class="repeat-row">
                <div class="row align-items-end">
                    <div class="col-md-4"><label class="mb-1">Judul Section</label><input type="text" name="content[additional_sections][{{ $i }}][title]" class="form-control" value="{{ $row['title'] ?? '' }}"></div>
                    <div class="col-md-7"><label class="mb-1">Isi Section</label><textarea name="content[additional_sections][{{ $i }}][body]" class="form-control" rows="2">{{ $row['body'] ?? '' }}</textarea></div>
                    <div class="col-md-1"><button type="button" class="repeat-remove"><i class="fas fa-trash"></i></button></div>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary repeat-add"><i class="fas fa-plus"></i> Tambah Baris</button>
</div>

@section('js')
@parent
<script>
document.addEventListener('click', function (event) {
    const addButton = event.target.closest('.repeat-add');
    const removeButton = event.target.closest('.repeat-remove');

    if (addButton) {
        const section = addButton.closest('[data-repeat-group]');
        const list = section.querySelector('.repeat-list');
        const rows = list.querySelectorAll('.repeat-row');
        const clone = rows[rows.length - 1].cloneNode(true);
        const nextIndex = rows.length;

        clone.querySelectorAll('input, textarea').forEach(function (field) {
            field.name = field.name.replace(/\[\d+\]/, '[' + nextIndex + ']');
            field.value = '';
        });

        list.appendChild(clone);
    }

    if (removeButton) {
        const list = removeButton.closest('.repeat-list');
        const rows = list.querySelectorAll('.repeat-row');

        if (rows.length > 1) {
            removeButton.closest('.repeat-row').remove();
        } else {
            removeButton.closest('.repeat-row').querySelectorAll('input, textarea').forEach(function (field) {
                field.value = '';
            });
        }
    }
});
</script>
@endsection
