<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\LeadershipProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeadershipProfileController extends Controller
{
    public function index()
    {
        $profiles = AdminTable::paginate(LeadershipProfile::query()
            ->orderByDesc('sort_order')
            ->latest(), ['name', 'position', 'email'], 'profiles', 10);

        return view('admin.pimpinan-profile.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.pimpinan-profile.create', [
            'profile' => new LeadershipProfile([
                'is_active' => true,
                'sort_order' => 0,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name']);
        $data['academic_links'] = $this->academicLinks($request);
        $data['content_data'] = $this->contentData($request);
        $data['content_html'] = $this->renderContentHtml($data['content_data']);

        LeadershipProfile::create($data);

        return redirect('/admin/pimpinan-profile')
            ->with('success', 'Profil pimpinan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pimpinanProfile = LeadershipProfile::findOrFail($id);

        return view('admin.pimpinan-profile.edit', [
            'profile' => $pimpinanProfile,
        ]);
    }

    public function update(Request $request, $id)
    {
        $pimpinanProfile = LeadershipProfile::findOrFail($id);
        $data = $this->validatedData($request, $pimpinanProfile->id);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name'], $pimpinanProfile->id);
        $data['academic_links'] = $this->academicLinks($request);
        $data['content_data'] = $this->contentData($request);

        if ($this->hasContentData($data['content_data'])) {
            $data['content_html'] = $this->renderContentHtml($data['content_data']);
        } else {
            unset($data['content_data']);
        }

        $pimpinanProfile->update($data);

        return redirect('/admin/pimpinan-profile')
            ->with('success', 'Profil pimpinan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pimpinanProfile = LeadershipProfile::findOrFail($id);

        $pimpinanProfile->delete();

        return back()->with('success', 'Profil pimpinan berhasil dihapus');
    }

    private function validatedData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'position' => 'required|string|max:255',
            'photo_path' => 'nullable|string|max:2048',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'summary' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0|max:9999',
            'is_active' => 'nullable|boolean',
            'content' => 'nullable|array',
            'content.about' => 'nullable|string|max:3000',
            'content.jobs_title' => 'nullable|string|max:255',
            'content.publications_title' => 'nullable|string|max:255',
            'content.hki_title' => 'nullable|string|max:255',
            'content.identity' => 'nullable|array',
            'content.identity.*.label' => 'nullable|string|max:255',
            'content.identity.*.value' => 'nullable|string|max:1000',
            'content.education' => 'nullable|array',
            'content.education.*.year' => 'nullable|string|max:50',
            'content.education.*.program' => 'nullable|string|max:1000',
            'content.education.*.institution' => 'nullable|string|max:1000',
            'content.jobs' => 'nullable|array',
            'content.jobs.*.period' => 'nullable|string|max:100',
            'content.jobs.*.position' => 'nullable|string|max:1200',
            'content.research' => 'nullable|array',
            'content.research.*.year' => 'nullable|string|max:50',
            'content.research.*.title' => 'nullable|string|max:1500',
            'content.research.*.funding' => 'nullable|string|max:255',
            'content.achievements' => 'nullable|array',
            'content.achievements.*.year' => 'nullable|string|max:50',
            'content.achievements.*.description' => 'nullable|string|max:1500',
            'content.publications' => 'nullable|array',
            'content.publications.*.year' => 'nullable|string|max:50',
            'content.publications.*.title' => 'nullable|string|max:1500',
            'content.publications.*.note' => 'nullable|string|max:1000',
            'content.hki' => 'nullable|array',
            'content.hki.*.year' => 'nullable|string|max:50',
            'content.hki.*.title' => 'nullable|string|max:1500',
            'content.hki.*.type' => 'nullable|string|max:255',
            'content.hki.*.number' => 'nullable|string|max:255',
            'content.community' => 'nullable|array',
            'content.community.*.year' => 'nullable|string|max:50',
            'content.community.*.title' => 'nullable|string|max:1500',
            'content.community.*.role' => 'nullable|string|max:255',
            'content.additional_sections' => 'nullable|array',
            'content.additional_sections.*.title' => 'nullable|string|max:255',
            'content.additional_sections.*.body' => 'nullable|string',
        ]) + [
            'sort_order' => 0,
            'is_active' => false,
        ];
    }

    private function academicLinks(Request $request): array
    {
        return collect([
            'scopus' => $request->input('academic_links.scopus'),
            'sinta' => $request->input('academic_links.sinta'),
            'google_scholar' => $request->input('academic_links.google_scholar'),
            'orcid' => $request->input('academic_links.orcid'),
        ])
            ->filter(fn (?string $url) => filled($url))
            ->all();
    }

    private function contentData(Request $request): array
    {
        $content = $request->input('content', []);

        return [
            'about' => trim((string) ($content['about'] ?? '')),
            'jobs_title' => trim((string) ($content['jobs_title'] ?? '')),
            'publications_title' => trim((string) ($content['publications_title'] ?? '')),
            'hki_title' => trim((string) ($content['hki_title'] ?? '')),
            'identity' => $this->filterRows($content['identity'] ?? [], ['label', 'value']),
            'education' => $this->filterRows($content['education'] ?? [], ['year', 'program', 'institution']),
            'jobs' => $this->filterRows($content['jobs'] ?? [], ['period', 'position']),
            'research' => $this->filterRows($content['research'] ?? [], ['year', 'title', 'funding']),
            'achievements' => $this->filterRows($content['achievements'] ?? [], ['year', 'description']),
            'publications' => $this->filterRows($content['publications'] ?? [], ['year', 'title', 'note']),
            'hki' => $this->filterRows($content['hki'] ?? [], ['year', 'title', 'type', 'number']),
            'community' => $this->filterRows($content['community'] ?? [], ['year', 'title', 'role']),
            'additional_sections' => $this->filterRows($content['additional_sections'] ?? [], ['title', 'body']),
        ];
    }

    private function filterRows(array $rows, array $keys): array
    {
        return collect($rows)
            ->map(function (array $row) use ($keys) {
                return collect($keys)
                    ->mapWithKeys(fn (string $key) => [$key => trim((string) ($row[$key] ?? ''))])
                    ->all();
            })
            ->filter(fn (array $row) => collect($row)->contains(fn (string $value) => filled($value)))
            ->values()
            ->all();
    }

    private function hasContentData(array $contentData): bool
    {
        return collect($contentData)->contains(function ($value) {
            if (is_array($value)) {
                return count($value) > 0;
            }

            return filled($value);
        });
    }

    private function renderContentHtml(array $contentData): string
    {
        $html = [];

        if (filled($contentData['about'] ?? null)) {
            $about = nl2br($this->e($contentData['about']));

            $html[] = <<<HTML
<section class="profile-block">
    <h2>Tentang</h2>
    <p>{$about}</p>
</section>
HTML;
        }

        if ($contentData['identity']) {
            $items = collect($contentData['identity'])
                ->map(fn (array $row) => '<div><span>'.$this->e($row['label']).'</span><strong>'.$this->e($row['value']).'</strong></div>')
                ->implode("\n        ");

            $html[] = <<<HTML
<section class="profile-block">
    <h2>Identitas Diri</h2>
    <div class="identity-grid">
        {$items}
    </div>
</section>
HTML;
        }

        $this->appendTable($html, 'Riwayat Pendidikan', ['Tahun', 'Jenjang / Program Studi', 'Institusi'], $contentData['education'], ['year', 'program', 'institution']);
        $this->appendTable($html, $contentData['jobs_title'] ?: 'Riwayat Pekerjaan & Jabatan', ['Periode', 'Jabatan'], $contentData['jobs'], ['period', 'position']);
        $this->appendTable($html, 'Penelitian', ['Tahun', 'Judul Penelitian', 'Pendanaan'], $contentData['research'], ['year', 'title', 'funding']);
        $this->appendList($html, 'Prestasi & Pencapaian', $contentData['achievements'], 'description', 'year');
        $this->appendPublicationList($html, $contentData['publications_title'] ?: 'Publikasi Ilmiah Terkini', $contentData['publications']);
        $this->appendTable($html, $contentData['hki_title'] ?: 'Perolehan HKI', ['Tahun', 'Judul', 'Jenis', 'No. Pendaftaran'], $contentData['hki'], ['year', 'title', 'type', 'number']);
        $this->appendTable($html, 'Pengabdian Masyarakat', ['Tahun', 'Judul Kegiatan', 'Peran'], $contentData['community'], ['year', 'title', 'role']);

        foreach ($contentData['additional_sections'] as $section) {
            if (! filled($section['title']) && ! filled($section['body'])) {
                continue;
            }

            $title = $this->e($section['title'] ?: 'Informasi Tambahan');
            $body = nl2br($this->e($section['body']));

            $html[] = <<<HTML
<section class="profile-block">
    <h2>{$title}</h2>
    <p>{$body}</p>
</section>
HTML;
        }

        return implode("\n\n", $html);
    }

    private function appendTable(array &$html, string $title, array $headers, array $rows, array $keys): void
    {
        if (! $rows) {
            return;
        }

        $headerHtml = collect($headers)
            ->map(fn (string $header) => '<th>'.$this->e($header).'</th>')
            ->implode('');

        $rowHtml = collect($rows)
            ->map(function (array $row) use ($keys) {
                $cells = collect($keys)
                    ->map(fn (string $key) => '<td>'.$this->e($row[$key] ?? '').'</td>')
                    ->implode('');

                return '<tr>'.$cells.'</tr>';
            })
            ->implode("\n            ");

        $title = $this->e($title);

        $html[] = <<<HTML
<section class="profile-block">
    <h2>{$title}</h2>
    <table>
        <thead><tr>{$headerHtml}</tr></thead>
        <tbody>
            {$rowHtml}
        </tbody>
    </table>
</section>
HTML;
    }

    private function appendList(array &$html, string $title, array $rows, string $mainKey, ?string $prefixKey = null, ?string $suffixKey = null): void
    {
        if (! $rows) {
            return;
        }

        $items = collect($rows)
            ->map(function (array $row) use ($mainKey, $prefixKey, $suffixKey) {
                $prefix = $prefixKey && filled($row[$prefixKey] ?? null)
                    ? '<strong>'.$this->e($row[$prefixKey]).'</strong> - '
                    : '';
                $suffix = $suffixKey && filled($row[$suffixKey] ?? null)
                    ? ' <em>('.$this->e($row[$suffixKey]).')</em>'
                    : '';

                return '<li>'.$prefix.$this->e($row[$mainKey] ?? '').$suffix.'</li>';
            })
            ->implode("\n        ");

        $title = $this->e($title);

        $html[] = <<<HTML
<section class="profile-block">
    <h2>{$title}</h2>
    <ul>
        {$items}
    </ul>
</section>
HTML;
    }

    private function appendPublicationList(array &$html, string $title, array $rows): void
    {
        if (! $rows) {
            return;
        }

        $items = collect($rows)
            ->map(function (array $row) {
                $year = filled($row['year'] ?? null)
                    ? '<span class="publication-meta">'.$this->e($row['year']).'</span>'
                    : '';
                $note = filled($row['note'] ?? null)
                    ? '<span class="publication-note">'.$this->e($row['note']).'</span>'
                    : '';

                return '<li><div class="publication-title"><strong><em>'.$this->e($row['title'] ?? '').'</em></strong></div><div class="publication-badges">'.$year.$note.'</div></li>';
            })
            ->implode("\n        ");

        $title = $this->e($title);

        $html[] = <<<HTML
<section class="profile-block publication-block">
    <h2>{$title}</h2>
    <ul class="publication-list">
        {$items}
    </ul>
</section>
HTML;
    }

    private function e(?string $value): string
    {
        return e((string) $value);
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $slug = Str::slug($value) ?: 'profil-pimpinan';
        $baseSlug = $slug;
        $counter = 2;

        while (
            LeadershipProfile::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
