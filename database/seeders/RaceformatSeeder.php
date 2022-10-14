<?php

namespace Database\Seeders;

use App\Models\Raceformat;
use Illuminate\Database\Seeder;

class RaceformatSeeder extends Seeder
{
    public function run()
    {
        Raceformat::factory()
            ->count(2)->sequence(['format' => 'sprint'] , ['format' => 'full'])
            ->create();
    }
}
