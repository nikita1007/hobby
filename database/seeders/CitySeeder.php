<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    protected $table = 'cities';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'name' => 'Оренбург',
                'slug' => 'orenburg'
            ],
            [
                'name' => 'Москва',
                'slug' => 'moscow'
            ]
        ];

        City::insert($cities);
    }
}
