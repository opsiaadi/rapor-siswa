<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_profile(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get(route('admin.profile.index'));

        $response->assertStatus(200);
    }

    public function test_admin_can_update_profile(): void
    {
        $admin = User::factory()->admin()->create([
            'email' => 'admin@example.com',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.profile.update'), [
            'nama' => 'Nama Baru',
            'email' => 'admin@example.com',
        ]);

        $response->assertRedirect(route('admin.profile.index'));
        $response->assertSessionHas('success');
        $this->assertSame('Nama Baru', $admin->fresh()->nama);
    }

    public function test_profile_update_requires_valid_email(): void
    {
        $admin = User::factory()->admin()->create();
        $other = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->put(route('admin.profile.update'), [
            'nama' => 'Nama Baru',
            'email' => $other->email,
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertNotSame('Nama Baru', $admin->fresh()->nama);
    }

    public function test_non_admin_cannot_access_admin_profile(): void
    {
        $guru = User::factory()->guru()->create();

        $response = $this->actingAs($guru)->get(route('admin.profile.index'));

        $response->assertStatus(403);
    }
}
