<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EventsTest extends TestCase
{
    use RefreshDatabase;

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

}
