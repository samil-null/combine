<?php

namespace Tests\Feature\Api\Events\Events\Properties;

use App\Enums\Common\DataType;
use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_it_can_create_property()
    {
        $event = Event::factory()->create();

        $response = $this->postJson(route('api.events.properties.store', $event->id), [
            'name' => 'Awesome code',
            'code' => 'awesome_code',
            'type' => DataType::Integer->value
        ]);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'code',
                'type',
            ]
        ]);

        $response->assertCreated();
    }

    public function test_it_can_update_property()
    {
        $event = Event::factory()->create();

        $property = $event->properties()->create([
            'name' => 'Awesome code',
            'code' => 'awesome_code',
            'type' => DataType::String
        ]);

        $response = $this->putJson(route('api.events.properties.update', [$event->id, $property->id]), [
            'name' => 'Some name',
            'code' => 'some_code',
            'type' => DataType::Float->value
        ]);

        $response->assertOk();
        $property->refresh();

        $this->assertEquals('some_code', $property->code);
        $this->assertEquals('Some name', $property->name);
        $this->assertEquals(DataType::Float, $property->type);
    }

    public function test_it_can_delete_property()
    {
        $event = Event::factory()->create();

        $property = $event->properties()->create([
            'name' => 'Awesome code',
            'code' => 'awesome_code',
            'type' => DataType::String
        ]);

        $response = $this->deleteJson(route('api.events.properties.destroy', [$event->id, $property->id]));

        $response->assertOk();

        $this->assertModelMissing($property);
    }

    public function test_it_can_get_properties()
    {
        $properties = [
            [
                'name' => 'Awesome code',
                'code' => 'awesome_code',
                'type' => DataType::String
            ],
            [
                'name' => 'Product ID',
                'code' => 'product_id',
                'type' => DataType::Integer
            ]
        ];

        $event = Event::factory()->create();
        $event->properties()->createMany($properties);

        $response = $this->getJson(route('api.events.properties.index', $event->id));

        $response
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'code',
                    ]
                ]
            ]);
    }
}
