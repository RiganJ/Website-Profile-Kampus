<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Civitas;
use App\Models\Fakultas;
use App\Models\LeadershipProfile;

class StrukturController extends Controller
{
    public function index()
    {
        $faculties = Fakultas::query()
            ->with(['prodi.dosen', 'prodi.kaprodiDosen'])
            ->get()
            ->each(function (Fakultas $faculty) {
                $deanName = trim((string) $faculty->dekan);
                $deanDosen = filled($deanName)
                    ? Dosen::query()
                        ->where(fn ($query) => $query
                            ->where('nama', $deanName)
                            ->orWhere('nama', 'like', '%' . $deanName . '%'))
                        ->first()
                    : null;
                $deanCivitas = filled($deanName)
                    ? Civitas::query()
                        ->where(fn ($query) => $query
                            ->where('nama', $deanName)
                            ->orWhere('nama', 'like', '%' . $deanName . '%'))
                        ->first()
                    : null;
                $deanProfile = LeadershipProfile::query()
                    ->where(function ($query) use ($deanName, $faculty) {
                        if (filled($deanName)) {
                            $query->where('name', $deanName);
                        }

                        $query->orWhere(function ($positionQuery) use ($faculty) {
                            $positionQuery
                                ->where('position', 'like', '%Dekan%')
                                ->where('position', 'like', '%' . str($faculty->nama_fakultas)->after('Fakultas ')->value() . '%');
                        });
                    })
                    ->first();

                $faculty->setAttribute('dean_photo_url',
                    $deanDosen?->foto_url ?: ($deanCivitas?->foto_url ?: $deanProfile?->photo_url)
                );
                $faculty->setAttribute('dean_position', 'Dekan ' . $faculty->nama_fakultas);
            });

        $leaders = Dosen::query()
            ->where(function ($query) {
                $query->where('jabatan', 'like', '%Rektor%')
                    ->orWhere('jabatan', 'like', '%Wakil Rektor%')
                    ->orWhere('jabatan', 'like', '%Warek%');
            })
            ->orderByRaw("
                CASE
                    WHEN LOWER(jabatan) = 'rektor' THEN 1
                    WHEN LOWER(jabatan) LIKE '%wakil rektor i%' THEN 2
                    WHEN LOWER(jabatan) LIKE '%warek i%' THEN 2
                    WHEN LOWER(jabatan) LIKE '%wakil rektor ii%' THEN 3
                    WHEN LOWER(jabatan) LIKE '%warek ii%' THEN 3
                    WHEN LOWER(jabatan) LIKE '%wakil rektor iii%' THEN 4
                    WHEN LOWER(jabatan) LIKE '%warek iii%' THEN 4
                    WHEN LOWER(jabatan) LIKE '%wakil rektor%' THEN 5
                    WHEN LOWER(jabatan) LIKE '%warek%' THEN 5
                    ELSE 6
                END
            ")
            ->orderBy('nama')
            ->get();

        return view('struktur.index', compact('faculties', 'leaders'));
    }
}
