<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use App\Models\Civitas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use ZipArchive;

class CivitasController extends Controller
{
    public function index()
    {
        $civitas = AdminTable::paginate(Civitas::latest(), ['nama', 'nip', 'jabatan', 'unit'], 'civitas', 10);

        return view('admin.civitas.index', compact('civitas'));
    }

    public function create()
    {
        File::ensureDirectoryExists(public_path('images'));

        return view('admin.civitas.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCivitas($request);
        $validated['foto'] = $this->storeFoto($request);

        Civitas::create($validated);

        return redirect('/admin/civitas')
            ->with('success', 'Data civitas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $civitas = Civitas::findOrFail($id);
        File::ensureDirectoryExists(public_path('images'));

        return view('admin.civitas.edit', compact('civitas'));
    }

    public function update(Request $request, $id)
    {
        $civitas = Civitas::findOrFail($id);
        $validated = $this->validateCivitas($request, $civitas->id);
        $validated['foto'] = $civitas->foto;

        if ($request->hasFile('foto')) {
            $this->deleteFotoFile($civitas->foto);
            $validated['foto'] = $this->storeFoto($request);
        }

        $civitas->update($validated);

        return redirect('/admin/civitas')
            ->with('success', 'Data civitas berhasil diupdate');
    }

    public function show($id)
    {
        return redirect("/admin/civitas/{$id}/edit");
    }

    public function destroy($id)
    {
        $civitas = Civitas::findOrFail($id);
        $this->deleteFotoFile($civitas->foto);
        $civitas->delete();

        return back()->with('success', 'Data civitas berhasil dihapus');
    }

    public function exportCsv()
    {
        $filename = 'data-civitas-' . now()->format('Y-m-d') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $this->importExportHeaders());

            Civitas::orderBy('nama')->chunk(200, function ($civitasRows) use ($handle) {
                foreach ($civitasRows as $civitas) {
                    fputcsv($handle, $this->civitasExportRow($civitas));
                }
            });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function exportExcel()
    {
        $filename = 'data-civitas-' . now()->format('Y-m-d') . '.xls';
        $headers = $this->importExportHeaders();
        $civitasRows = Civitas::orderBy('nama')->get();

        $html = view('admin.civitas.export-excel', compact('headers', 'civitasRows'))->render();

        return response($html, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt,xlsx|max:5120',
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $rows = $extension === 'xlsx'
            ? $this->readXlsxRows($file->getRealPath())
            : $this->readCsvRows($file->getRealPath());

        if (count($rows) < 2) {
            return back()->withErrors(['file' => 'File import tidak memiliki data civitas.']);
        }

        $headerMap = $this->headerMap($rows[0]);
        $requiredHeaders = [
            'nip',
            'nama',
            'jenis_kelamin',
            'pendidikan_terakhir',
            'asal_pendidikan',
            'tanggal_masuk_kerja',
            'jabatan',
        ];

        foreach ($requiredHeaders as $header) {
            if (! array_key_exists($header, $headerMap)) {
                return back()->withErrors(['file' => 'Kolom wajib "' . $header . '" belum ada di file import.']);
            }
        }

        $imported = 0;
        $updated = 0;
        $errors = [];
        $preparedRows = [];
        $seenNips = [];

        foreach (array_slice($rows, 1) as $index => $row) {
            if ($this->isEmptyRow($row)) {
                continue;
            }

            $rowNumber = $index + 2;
            $data = $this->rowToCivitasData($row, $headerMap);

            if (($data['nip'] ?? '') !== '' && in_array($data['nip'], $seenNips, true)) {
                $errors[] = 'Baris ' . $rowNumber . ': NIP duplikat di file import.';
                continue;
            }

            $seenNips[] = $data['nip'] ?? '';

            $existing = Civitas::where('nip', $data['nip'] ?? '')->first();

            $validator = Validator::make($data, [
                'nip' => [
                    'required',
                    Rule::unique('civitas', 'nip')->ignore($existing?->id),
                ],
                'nama' => 'required',
                'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
                'pendidikan_terakhir' => 'required',
                'asal_pendidikan' => 'required',
                'tanggal_masuk_kerja' => 'required|date',
                'jabatan' => 'required',
                'keterangan' => 'nullable',
            ]);

            if ($validator->fails()) {
                $errors[] = 'Baris ' . $rowNumber . ': ' . $validator->errors()->first();
                continue;
            }

            $preparedRows[] = [
                'existing' => $existing,
                'data' => $validator->validated(),
            ];
        }

        if (! empty($errors)) {
            return back()->withErrors(['file' => implode(' ', array_slice($errors, 0, 5))]);
        }

        DB::transaction(function () use ($preparedRows, &$imported, &$updated) {
            foreach ($preparedRows as $preparedRow) {
                if ($preparedRow['existing']) {
                    $preparedRow['existing']->update($preparedRow['data']);
                    $updated++;
                } else {
                    Civitas::create($preparedRow['data']);
                    $imported++;
                }
            }
        });

        return back()->with('success', "Import selesai. {$imported} data baru ditambahkan, {$updated} data diperbarui.");
    }

    private function validateCivitas(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'nip' => [
                'required',
                Rule::unique('civitas', 'nip')->ignore($id),
            ],
            'nama' => 'required',
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'pendidikan_terakhir' => 'required',
            'asal_pendidikan' => 'required',
            'tanggal_masuk_kerja' => 'required|date',
            'jabatan' => 'required',
            'keterangan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }

    private function storeFoto(Request $request): ?string
    {
        if (! $request->hasFile('foto')) {
            return null;
        }

        File::ensureDirectoryExists(public_path('images'));

        $file = $request->file('foto');
        $foto = 'civitas-' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $foto);

        return $foto;
    }

    private function deleteFotoFile(?string $foto): void
    {
        if (! $foto) {
            return;
        }

        $path = public_path('images/' . basename($foto));

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    private function importExportHeaders(): array
    {
        return [
            'nip',
            'nama',
            'jenis_kelamin',
            'pendidikan_terakhir',
            'asal_pendidikan',
            'tanggal_masuk_kerja',
            'jabatan',
            'keterangan',
        ];
    }

    private function civitasExportRow(Civitas $civitas): array
    {
        return [
            $civitas->nip,
            $civitas->nama,
            $civitas->jenis_kelamin,
            $civitas->pendidikan_terakhir,
            $civitas->asal_pendidikan,
            $civitas->tanggal_masuk_kerja,
            $civitas->jabatan,
            $civitas->keterangan,
        ];
    }

    private function readCsvRows(string $path): array
    {
        $rows = [];
        $handle = fopen($path, 'r');

        while (($row = fgetcsv($handle)) !== false) {
            $rows[] = $row;
        }

        fclose($handle);

        return $rows;
    }

    private function readXlsxRows(string $path): array
    {
        if (! class_exists(ZipArchive::class)) {
            return [];
        }

        $zip = new ZipArchive();

        if ($zip->open($path) !== true) {
            return [];
        }

        $sharedStrings = [];
        $sharedXml = $zip->getFromName('xl/sharedStrings.xml');

        if ($sharedXml !== false) {
            $xml = simplexml_load_string($sharedXml);

            foreach ($xml->si as $item) {
                $sharedStrings[] = isset($item->t)
                    ? (string) $item->t
                    : collect($item->r)->map(fn($run) => (string) $run->t)->implode('');
            }
        }

        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        $zip->close();

        if ($sheetXml === false) {
            return [];
        }

        $sheet = simplexml_load_string($sheetXml);
        $rows = [];

        foreach ($sheet->sheetData->row as $row) {
            $cells = [];

            foreach ($row->c as $cell) {
                $cellRef = (string) $cell['r'];
                $columnIndex = $this->excelColumnIndex(preg_replace('/\d+/', '', $cellRef));
                $value = isset($cell->v) ? (string) $cell->v : '';

                if ((string) $cell['t'] === 's') {
                    $value = $sharedStrings[(int) $value] ?? '';
                }

                $cells[$columnIndex] = $value;
            }

            if (! empty($cells)) {
                $rows[] = array_values(array_replace(array_fill(0, max(array_keys($cells)) + 1, ''), $cells));
            }
        }

        return $rows;
    }

    private function excelColumnIndex(string $column): int
    {
        $index = 0;

        foreach (str_split($column) as $char) {
            $index = $index * 26 + (ord(strtoupper($char)) - 64);
        }

        return $index - 1;
    }

    private function headerMap(array $headers): array
    {
        $map = [];

        foreach ($headers as $index => $header) {
            $key = Str::of($header)
                ->replace("\xEF\xBB\xBF", '')
                ->lower()
                ->replace([' ', '-', '.', '/', '(', ')'], '_')
                ->replace('__', '_')
                ->trim('_')
                ->toString();

            $map[$key] = $index;
        }

        return $map;
    }

    private function rowToCivitasData(array $row, array $headerMap): array
    {
        return [
            'nip' => $this->cellValue($row, $headerMap, 'nip'),
            'nama' => $this->cellValue($row, $headerMap, 'nama'),
            'jenis_kelamin' => $this->normalizeGender($this->cellValue($row, $headerMap, 'jenis_kelamin')),
            'pendidikan_terakhir' => $this->cellValue($row, $headerMap, 'pendidikan_terakhir'),
            'asal_pendidikan' => $this->cellValue($row, $headerMap, 'asal_pendidikan'),
            'tanggal_masuk_kerja' => $this->normalizeDate($this->cellValue($row, $headerMap, 'tanggal_masuk_kerja')),
            'jabatan' => $this->cellValue($row, $headerMap, 'jabatan'),
            'keterangan' => $this->cellValue($row, $headerMap, 'keterangan') ?: null,
        ];
    }

    private function cellValue(array $row, array $headerMap, string $key): string
    {
        $index = $headerMap[$key] ?? null;

        if ($index === null) {
            return '';
        }

        return trim((string) ($row[$index] ?? ''));
    }

    private function normalizeGender(string $value): string
    {
        $value = Str::lower(trim($value));

        return match ($value) {
            'l', 'laki-laki', 'laki laki', 'pria' => 'L',
            'p', 'perempuan', 'wanita' => 'P',
            default => strtoupper($value),
        };
    }

    private function normalizeDate(string $value): string
    {
        $value = trim($value);

        if ($value === '') {
            return '';
        }

        if (is_numeric($value)) {
            return Carbon::create(1899, 12, 30)->addDays((int) $value)->format('Y-m-d');
        }

        foreach (['Y-m-d', 'd/m/Y', 'd-m-Y', 'm/d/Y'] as $format) {
            try {
                return Carbon::createFromFormat($format, $value)->format('Y-m-d');
            } catch (\Throwable) {
            }
        }

        try {
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Throwable) {
            return $value;
        }
    }

    private function isEmptyRow(array $row): bool
    {
        return collect($row)->filter(fn($value) => trim((string) $value) !== '')->isEmpty();
    }
}
