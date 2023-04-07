<?php

namespace Database\Seeders;

use App\Enums\Common\DataType;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertySeeder extends Seeder
{
    /**
     * @var array|array[]
     */
    private array $properties = [
        [
            'name' => 'Product id',
            'code' => 'product_id',
            'type' => DataType::Integer,
        ],
        [
            'name' => 'Price',
            'code' => 'price',
            'type' => DataType::Float,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            foreach (Event::all() as $event) {
                $event->properties()->createMany($this->properties);
            }
        });
    }
}
