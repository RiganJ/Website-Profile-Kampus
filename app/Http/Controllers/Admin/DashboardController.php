<?php

namespace App\Http\Controllers\Admin;

use App\Support\AdminTable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Mitra;
use App\Models\Beasiswa;
use App\Models\Civitas;
use App\Models\GuruBesar;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\AdminActivity;
use App\Services\SourceCodeAuditService;
use DB;

class DashboardController extends Controller
{
    public function index(SourceCodeAuditService $sourceCodeAuditService)
    {
        $sourceCodeAuditService->check();

        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        $jumlahMitra = Mitra::count();
        $jumlahBeasiswa = Beasiswa::count();
        $jumlahCivitas = Civitas::count();
        $jumlahGuruBesar = GuruBesar::count();
        $jumlahProdi = Prodi::count();
        $jumlahFakultas = Fakultas::count();

        $dosenTerbaru = AdminTable::paginate(Dosen::with('prodi')->latest(), ['nama', 'nip', 'jabatan'], 'dosenTerbaru', 5);
        $mahasiswaTerbaru = AdminTable::paginate(Mahasiswa::latest(), ['nama', 'nim', 'angkatan', 'prodi.nama_prodi'], 'mahasiswaTerbaru', 5);

        $mahasiswaPerTahun = Mahasiswa::select(
            DB::raw('angkatan as tahun'),
            DB::raw('count(*) as total')
        )
        ->whereNotNull('angkatan')
        ->groupBy('tahun')
        ->orderBy('tahun', 'asc')
        ->get();

        $activityQuery = AdminActivity::latest('performed_at');

        if (! auth()->user()->isSuperAdmin()) {
            $activityQuery->where('user_id', auth()->id());
        }

        $aktivitasTerbaru = AdminTable::paginate($activityQuery, ['name', 'module', 'action', 'description'], 'aktivitasTerbaru', 5);



        return view('admin.dashboard', compact(
            'jumlahMahasiswa',
            'jumlahDosen',
            'jumlahMitra',
            'jumlahBeasiswa',
            'jumlahCivitas',
            'jumlahGuruBesar',
            'jumlahProdi',
            'jumlahFakultas',
            'dosenTerbaru',
            'mahasiswaPerTahun',
            'mahasiswaTerbaru',
            'aktivitasTerbaru'
        ));
    }
}
