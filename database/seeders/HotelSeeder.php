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
                'name' => 'METROPOL',
                'description' => 'METROPOL',
                'stars' => '5',
            ],
            [
                'city_id' => '1',
                'name' => 'Test 1',
                'description' => 'Test 1',
                'stars' => '3',
            ],
        ];

        Hotel::insert($hotels);
    }
}
