<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
//        De rollen en permissies aanmaken voor de tests.
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_admin_can_see_price_on_index_page()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $response = $this->get('admin/users');
        $response->assertStatus(200);

    }

    public function test_admin_can_see_create_page_users()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $response = $this->get('admin/users/create');
        $response->assertStatus(200);
    }

    public function test_admin_can_see_edit_page_users()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $user = User::factory()->create();
        $response = $this->get('admin/users/' . $user->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_admin_can_see_show_page_users()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $user = User::factory()->create();
        $response = $this->get('admin/users/' . $user->id);
        $response->assertStatus(200);
    }

    public function test_admin_can_see_delete_page_users()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $user = User::factory()->create();
        $response = $this->delete('admin/users/' . $user->id);
        $response->assertStatus(302);
    }

    public function test_organizer_cannot_access_admin_users_page()
    {
        // Create a user without the 'admin' role
        $user = User::factory()->create();
        $this->actingAs($user);

        // Attempt to access an admin resource
        $response = $this->get('/admin/users');

        // Assert that the response status is 403 (Forbidden)
        $response->assertStatus(403);
    }
}
