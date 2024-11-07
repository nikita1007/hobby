<?php

namespace Database\Seeders;

use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hotels = [
            [
                'city_id' => '1',
                'name' => 'Hilton Garden Inn',
                'description' => 'Hilton Garden Inn',
                'stars' => '5',
            ],
            [
                'city_id' => '1',
                'name' => 'METROPOL Orenburg',
                'description' => 'METROPOL Orenburg',
                'stars' => '5',
            ],
            [
                'city_id' => '2',
                'name' => 'METROPOL Moscow',
                'description' => 'METROPOL Moscow',
                'stars' => '5',
            ],
            [
                'city_id' => '2',
                'name' => 'METROPOL Arbat Moscow',
                'description' => 'METROPOL Arbat Moscow',
                'stars' => '5',
            ],
            [
                'city_id' => '1',
                'name' => 'Orenburg Test 1',
                'description' => 'Orenburg Test 1',
                'stars' => '3',
            ],
        ];

        Hotel::insert($hotels);
    }
}
