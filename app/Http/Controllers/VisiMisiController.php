<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $misi = [
            ['icon' => 'bi-briefcase', 'title' => 'Menyelenggarakan Tri Dharma Perguruan Tinggi yang bermutu, berkarakter, dan berkesinambungan'],
            ['icon' => 'bi-graph-up-arrow', 'title' => 'Meningkatkan kualitas tata kelola yang baik (good institute governance), menuju tata kelola yang unggul (excellent institute governance).'],
            ['icon' => 'bi-chat-dots', 'title' => 'Menjalin jaringan kerjasama yang produktif dan berkelanjutan dengan kelembagaan pendidikan, pemerintahan dan dunia usaha di tingkat daerah, nasional dan internasional.'],

        ];

        $visi = 'Mewujudkan Universitas Fort De Kock Menjadi Universitas yang Unggul dalam rangka menghasilkan Sumber Daya Manusia yang Profesional serta memiliki daya saing global Tahun 2033.';

        return view('visi_misi', compact('visi', 'misi'));
    }
}
