<?php

namespace App\Http\Controllers;

use App\Models\Accreditation;
use Illuminate\Support\Facades\File;

class AccreditationController extends Controller
{
    public function index()
    {
        $accreditations = Accreditation::query()
            ->latest('tahun')
            ->latest('tanggal_sk')
            ->get();

        return view('akreditasi.index', compact('accreditations'));
    }

    public function file(Accreditation $accreditation)
    {
        abort_unless($accreditation->file, 404);

        $path = base_path(
            str_replace(
                ['/', '\\'],
                DIRECTORY_SEPARATOR,
                $accreditation->file
            )
        );

        abort_unless(File::exists($path), 404);

        return response()->file($path);
    }
}