<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_admin_can_login_with_email(): void
    {
        $user = User::factory()->admin()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'role' => 'admin',
            'nik' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard', [
            'id' => $user->id,
            'nama' => $user->nama,
        ]));
        $this->assertAuthenticatedAs($user);
    }

    public function test_guru_can_login_with_nik(): void
    {
        $user = User::factory()->guru()->create([
            'nik' => '1234567890',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'role' => 'guru',
            'nik' => '1234567890',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('guru.dashboard', [
            'id' => $user->id,
            'namaGuru' => $user->nama,
        ]));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_login_with_wrong_password(): void
    {
        User::factory()->admin()->create([
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'role' => 'admin',
            'nik' => 'admin@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertGuest();
    }

    public function test_login_requires_role_and_credentials(): void
    {
        $response = $this->post('/login', []);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['role', 'nik', 'password']);
        $this->assertGuest();
    }
}
