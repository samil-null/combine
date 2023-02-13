<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * @var array|\string[][]
     */
    private array $events = [
        [
            'name' => 'Add product to card',
            'code' => 'add_product_to_card'
        ],
        [
            'name' => 'Add product to wish list',
            'code' => 'add_product_to_wish_list'
        ],
        [
            'name' => 'Visit product page',
            'code' => 'visit_product_page'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->events as $event) {
            Event::create($event);
        }
    }
}
