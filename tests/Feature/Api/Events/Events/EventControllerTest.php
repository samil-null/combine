<?php

namespace Tests\Feature\Api\Events\Events;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_event()
    {
        $this->actingAs(User::factory()->create());

        $response = $this->postJson(route('api.events.store'), [
            'name' => 'test event',
            'code' => 'test_event'
        ]);

        $response->assertCreated();
    }

    public function test_it_can_update_event()
    {
        $this->actingAs(User::factory()->create());

        /** @var Event $event */
        $event = Event::factory()->create();

        $response = $this->putJson(route('api.events.update', $event->id), [
            'name' => 'update event',
            'code' => 'update_event'
        ]);

        $response->assertOk();

        $event->refresh();

        $this->assertEquals('update event', $event->name);
        $this->assertEquals('update_event', $event->code);
    }

    public function test_it_can_delete_event()
    {
        $this->actingAs(User::factory()->create());

        /** @var Event $event */
        $event = Event::factory()->create();

        $response = $this->deleteJson(route('api.events.destroy', $event->id));

        $response->assertOk();

        $responseAfterDelete = $this->getJson(route('api.events.show', $event->id));

        $responseAfterDelete->assertNotFound();
    }

    public function test_it_can_get_event()
    {
        $this->actingAs(User::factory()->create());

        /** @var Event $event */
        $event = Event::factory()->create();

        $response = $this->getJson(route('api.events.show', $event->id));

        $response->assertJson([
            'data' => [
                'id' => $event->id,
                'name' => $event->name,
                'code' => $event->code
            ]
        ]);
    }

    public function test_it_can_get_events()
    {
        $this->actingAs(User::factory()->create());
        Event::factory(5)->create();

        $response = $this->getJson(route('api.events.index'));

        $response->assertJsonCount(5, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'code'
                    ]
                ]
            ]);
    }
}
