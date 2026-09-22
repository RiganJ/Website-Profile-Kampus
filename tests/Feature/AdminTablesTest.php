<?php

namespace Tests\Feature;

use App\Models\Dosen;
use App\Models\User;
use App\Services\SourceCodeAuditService;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AdminTablesTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Isolated SQLite only. Legacy MySQL-only enum alterations do not apply.
        $this->assertSame(':memory:', config('database.connections.sqlite.database'));
        // The hosting's legacy cooperation table has no create migration.
        Schema::create('kerjasama', function (Blueprint $table): void {
            $table->id();
            $table->string('partner_mou')->nullable();
            $table->string('kriteria_mitra')->nullable();
            $table->timestamps();
        });
        $paths = collect(glob(database_path('migrations/*.php')))
            ->reject(fn ($path) => str_starts_with(basename($path), '._'))
            ->reject(fn ($path) => str_contains(file_get_contents($path), 'DB::statement'))
            ->values()->all();
        foreach ($paths as $path) {
            // SQLite indexes are database-wide; these legacy MySQL indexes
            // have the same name on two different tables.
            if (str_ends_with($path, 'create_prodi_laboran_table.php')) {
                Schema::table('prodi', fn (Blueprint $table) => $table->dropIndex('prodi_laboran_civitas_id_index'));
            }
            if (preg_match('/class\s+(\w+)\s+extends\s+Migration/', file_get_contents($path), $match)) {
                require_once $path;
                $migration = new $match[1];
            } else {
                $migration = require $path;
            }
            $migration->up();
        }
        $this->mock(SourceCodeAuditService::class)->shouldReceive('check')->zeroOrMoreTimes();
        $user = User::factory()->create(['role' => 'super_admin', 'name' => 'Admin Kampus']);
        $this->actingAs($user);
    }

    public function test_all_admin_tables_render_and_search_the_database(): void
    {
        $pages = [
            'dosen' => ['dosen'], 'mahasiswa' => ['mahasiswa'], 'civitas' => ['civitas'],
            'berita' => ['berita'], 'akreditasi' => ['accreditations'], 'fakultas' => ['fakultas'],
            'guru-besar' => ['guru_besars'], 'beasiswa' => ['beasiswas'],
            'panduan-akademik' => ['guides'], 'pimpinan-profile' => ['profiles'],
            'kerjasama' => ['kerjasama'], 'banner' => ['slides'], 'activities' => ['activities'],
            'prodi' => ['prodi'], 'prodi-hero' => ['prodi'],
            'users' => ['users', 'passwordResetRequests', 'loginActivities'],
            'chat' => ['contactHistory', 'recentSessions'],
            '' => ['dosenTerbaru', 'mahasiswaTerbaru', 'aktivitasTerbaru'],
        ];
        foreach ($pages as $path => $names) {
            $query = array_fill_keys(array_map(fn ($name) => $name.'_search', $names), 'TidakAda123');
            $response = $this->get('/admin'.($path ? '/'.$path : '').'?'.http_build_query($query))->assertOk();
            foreach ($names as $name) {
                $response->assertSee('name="'.$name.'_search"', false);
                $response->assertSee('name="'.$name.'_per_page"', false);
                $response->assertViewHas($name, fn ($rows) => $rows->total() === 0);
            }
        }
    }

    public function test_search_finds_rows_beyond_the_first_page_and_preserves_query(): void
    {
        for ($i = 1; $i <= 26; $i++) {
            Dosen::create(['nip' => 'NIP'.$i, 'nama' => 'Dosen Kampus '.str_pad($i, 2, '0', STR_PAD_LEFT), 'jenis_kelamin' => 'L', 'jabatan' => 'Dosen', 'pendidikan_terakhir' => 'S2', 'asal_pendidikan' => 'Universitas Fort De Kock', 'tanggal_masuk_kerja' => '2024-01-01']);
        }
        $response = $this->get('/admin/dosen?dosen_search=Dosen&dosen_per_page=10&dosen_page=2')->assertOk();
        $response->assertViewHas('dosen', fn ($rows) => $rows->total() === 26 && $rows->count() === 10 && $rows->currentPage() === 2);
        $response->assertSee('dosen_search=Dosen', false);
        $this->get('/admin/dosen?dosen_search=Kampus+01')->assertOk()
            ->assertViewHas('dosen', fn ($rows) => $rows->total() === 1 && $rows->first()->nip === 'NIP1');
        $this->get('/admin/dosen?dosen_per_page=9999')->assertOk()
            ->assertViewHas('dosen', fn ($rows) => $rows->perPage() === 10);

        if ($preview = getenv('ADMIN_PREVIEW_PATH')) {
            file_put_contents($preview, $this->get('http://127.0.0.1:18767/admin/dosen')->getContent());
        }
    }

    public function test_tables_on_the_same_page_have_independent_filters(): void
    {
        User::factory()->count(12)->create(['role' => 'admin']);
        $this->get('/admin/users?users_page=2&users_per_page=5&loginActivities_search=TidakAda')
            ->assertOk()
            ->assertViewHas('users', fn ($rows) => $rows->total() === 13 && $rows->currentPage() === 2 && $rows->count() === 5)
            ->assertViewHas('loginActivities', fn ($rows) => $rows->total() === 0 && $rows->currentPage() === 1);
    }
}
