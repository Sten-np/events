<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EventsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
//        De rollen en permissies aanmaken voor de tests.
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_Public_Can_see_Events(): void
    {
        $events = Event::factory()->create();
        $response = $this->get('events');

        $response->assertStatus(200);
        $response->assertSee([
            $events->name,
            $events->price
        ]);
    }

    public function test_Public_Can_Show_Single_Event(): void
    {
        $event = Event::factory()->create();
        $response = $this->get('events/' . $event->id);

        $response->assertStatus(200);
        $response->assertSee([
            $event->name,
            $event->description,
            $event->price,
            $event->date,
            $event->time,
            $event->location,
        ]);
    }

    public function test_admin_can_see_index_page_events()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $response = $this->get('admin/events');
        $response->assertStatus(200);

    }

    public function test_admin_can_see_create_page_events()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $response = $this->get('admin/events/create');
        $response->assertStatus(200);
    }

    public function test_admin_can_see_edit_page_events()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $event = Event::factory()->create();
        $response = $this->get('admin/events/' . $event->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_admin_can_see_show_page_events()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $event = Event::factory()->create();
        $response = $this->get('admin/events/' . $event->id);
        $response->assertStatus(200);
    }

    public function test_admin_can_see_delete_page_events()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $event = Event::factory()->create();
        $response = $this->delete('admin/events/' . $event->id);
        $response->assertStatus(302);
    }

    public function test_organizer_can_see_index_page_events()
    {
        $organizer = User::factory()->create();
        $organizer->assignRole('organizer');
        $this->actingAs($organizer);

        $response = $this->get('admin/events');
        $response->assertStatus(200);
    }

    public function test_organizer_can_see_create_page_events()
    {
        $organizer = User::factory()->create();
        $organizer->assignRole('organizer');
        $this->actingAs($organizer);

        $response = $this->get('admin/events/create');
        $response->assertStatus(200);
    }

    public function test_organizer_can_see_edit_page_events()
    {
        $organizer = User::factory()->create();
        $organizer->assignRole('organizer');
        $this->actingAs($organizer);

        $event = Event::factory()->create();
        $response = $this->get('admin/events/' . $event->id . '/edit');
        $response->assertStatus(200);
    }

    public function test_organizer_can_see_show_page_events()
    {
        $organizer = User::factory()->create();
        $organizer->assignRole('organizer');
        $this->actingAs($organizer);

        $event = Event::factory()->create();
        $response = $this->get('admin/events/' . $event->id);
        $response->assertStatus(200);
    }

    public function test_organizer_can_see_delete_page_events()
    {
        $organizer = User::factory()->create();
        $organizer->assignRole('organizer');
        $this->actingAs($organizer);

        $event = Event::factory()->create();
        $response = $this->delete('admin/events/' . $event->id);
        $response->assertStatus(302);
    }

    public function test_user_cannot_access_admin_resources()
    {
        // Create a user without the 'admin' role
        $user = User::factory()->create();
        $this->actingAs($user);

        // Attempt to access an admin resource
        $response = $this->get('/admin/events');

        // Assert that the response status is 403 (Forbidden)
        $response->assertStatus(403);
    }

}
