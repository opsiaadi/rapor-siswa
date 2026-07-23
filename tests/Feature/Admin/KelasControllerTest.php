<?php

namespace Tests\Feature\Admin;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KelasControllerTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->admin()->create();
    }

    private function makeKelas(int $waliKelasId): Kelas
    {
        return Kelas::create([
            'nama_kelas' => 'Kelas Test',
            'tingkat' => 'X',
            'wali_kelas_id' => $waliKelasId,
        ]);
    }

    public function test_store_menolak_wali_yang_sudah_punya_kelas_lain(): void
    {
        $admin = $this->admin();
        $wali = User::factory()->walikelas()->create();
        $this->makeKelas($wali->id);

        $response = $this->actingAs($admin)
            ->withHeader('Referer', route('admin.kelas.create'))
            ->followingRedirects()
            ->post(route('admin.kelas.store'), [
                'nama_kelas' => 'Kelas Baru',
                'tingkat' => 'XI',
                'wali_kelas_id' => $wali->id,
            ]);

        $response->assertSee('Terdapat kesalahan');
        $response->assertSee('Guru tersebut sudah menjadi wali kelas pada kelas lain.');
        $this->assertDatabaseMissing('kelas', ['nama_kelas' => 'Kelas Baru']);
    }

    public function test_update_kelas_lain_dengan_wali_yang_sudah_terpakai_gagal(): void
    {
        $admin = $this->admin();
        $wali = User::factory()->walikelas()->create();
        $kelasPunyaWali = $this->makeKelas($wali->id);
        $kelasLain = $this->makeKelas(User::factory()->walikelas()->create()->id);

        $response = $this->actingAs($admin)
            ->withHeader('Referer', route('admin.kelas.edit', $kelasLain->id))
            ->followingRedirects()
            ->put(route('admin.kelas.update', $kelasLain->id), [
                'nama_kelas' => 'Kelas Lain',
                'tingkat' => 'XI',
                'wali_kelas_id' => $wali->id,
            ]);

        $response->assertSee('Terdapat kesalahan');
        $response->assertSee('Guru tersebut sudah menjadi wali kelas pada kelas lain.');
    }

    public function test_update_kelas_sendiri_dengan_wali_yang_sama_lolos(): void
    {
        $admin = $this->admin();
        $wali = User::factory()->walikelas()->create();
        $kelas = $this->makeKelas($wali->id);

        $response = $this->actingAs($admin)->put(route('admin.kelas.update', $kelas->id), [
            'nama_kelas' => 'Kelas Diubah',
            'tingkat' => 'X',
            'wali_kelas_id' => $wali->id,
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('kelas', [
            'id' => $kelas->id,
            'nama_kelas' => 'Kelas Diubah',
            'wali_kelas_id' => $wali->id,
        ]);
    }

    public function test_create_menandai_guru_yang_sudah_jadi_walikelas(): void
    {
        $admin = $this->admin();
        $wali = User::factory()->walikelas()->create();
        $this->makeKelas($wali->id);

        $response = $this->actingAs($admin)->get(route('admin.kelas.create'));

        $response->assertSee('(Walikelas)');
        $response->assertSee($wali->nama);
    }

    public function test_edit_kelas_lain_menandai_wali_kelas_lain(): void
    {
        $admin = $this->admin();
        $wali = User::factory()->walikelas()->create();
        $kelasWali = $this->makeKelas($wali->id);
        $kelasLain = $this->makeKelas(User::factory()->walikelas()->create()->id);

        $response = $this->actingAs($admin)->get(route('admin.kelas.edit', $kelasLain->id));

        $response->assertSee('(Walikelas)');
        $response->assertSee($wali->nama);
    }

    public function test_edit_kelas_sendiri_tidak_menandai_walinya(): void
    {
        $admin = $this->admin();
        $wali = User::factory()->walikelas()->create();
        $kelas = $this->makeKelas($wali->id);

        $response = $this->actingAs($admin)->get(route('admin.kelas.edit', $kelas->id));

        $response->assertDontSee($wali->nama.' (Walikelas)');
    }

    public function test_update_gagal_validasi_mempertahankan_pilihan_mapel(): void
    {
        $admin = $this->admin();
        $waliLain = User::factory()->walikelas()->create();
        $this->makeKelas($waliLain->id);
        $kelas = $this->makeKelas(User::factory()->walikelas()->create()->id);

        $mapel = \App\Models\Mapel::create([
            'kode_mapel' => 'TST',
            'nama_mapel' => 'Mapel Test',
        ]);
        $guruMapel = User::factory()->guru()->create();
        $guruMapel->mapels()->attach($mapel->id);

        $response = $this->actingAs($admin)
            ->withHeader('Referer', route('admin.kelas.edit', $kelas->id))
            ->followingRedirects()
            ->put(route('admin.kelas.update', $kelas->id), [
                'nama_kelas' => 'Kelas Diubah',
                'tingkat' => 'X',
                'wali_kelas_id' => $waliLain->id,
                'mapel_ids' => [$mapel->id],
                'mapel_guru' => [$mapel->id => $guruMapel->id],
            ]);

        $response->assertSee('Terdapat kesalahan');

        $content = $response->getContent();
        $this->assertMatchesRegularExpression(
            '/<input[^>]*id="mapel_'.preg_quote((string) $mapel->id).'"[^>]*checked/',
            $content
        );
        $this->assertMatchesRegularExpression(
            '/<select name="mapel_guru\['.preg_quote((string) $mapel->id).'\]"[^>]*>.*?<option value="'.preg_quote((string) $guruMapel->id).'" selected>/s',
            $content
        );
    }

    public function test_store_wali_null_tetap_boleh(): void
    {
        $admin = $this->admin();

        $response = $this->actingAs($admin)->post(route('admin.kelas.store'), [
            'nama_kelas' => 'Kelas Tanpa Wali',
            'tingkat' => 'X',
            'wali_kelas_id' => null,
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('kelas', ['nama_kelas' => 'Kelas Tanpa Wali']);
    }
}
