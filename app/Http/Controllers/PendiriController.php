<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendiriController extends Controller
{
    public function index()
    {
        // Data pendiri — ganti nama/jabatan/filename sesuai file di public/images/pendiri/
        $pendiri = [
            ['img' => 'pakabdul.png', 'nama' => 'Dr. H. Abdul Rival, M.Kes', 'jabatan' => 'Pendiri Universitas'],
            ['img' => 'pakzainal.png', 'nama' => 'Drs. H. Zainal Abidin, M.Kes', 'jabatan' => 'Pendiri Universitas'],
            ['img' => 'pakwin.png', 'nama' => 'H. Windasnofil, SKM, MM', 'jabatan' => 'Pendiri Universitas'],
            ['img' => 'paknazarudin.png', 'nama' => 'H. Nazaruddin, SKM, M.Kes', 'jabatan' => 'Pendiri Universitas'],
            ['img' => 'almpakyasril.png', 'nama' => '(Alm) Yasril, SKM, M.Kes', 'jabatan' => 'Pendiri Universitas'],
            ['img' => 'paksyafrian.png', 'nama' => 'Drs. H. Syafrian Naili, M.Kes', 'jabatan' => 'Pendiri Universitas'],
            ['img' => 'bukema.png', 'nama' => 'Ema Yohana, BA', 'jabatan' => 'Pendiri Universitas'],
            ['img' => 'bukneila.png', 'nama' => 'Prof. Dr. Hj. Neila Sulung, S.Pd, Ns, M.Kes', 'jabatan' => 'Pendiri Universitas'],
        ];

       return view('pendiri', compact('pendiri'));
    }
}
