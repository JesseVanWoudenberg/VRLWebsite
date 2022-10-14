<?php

namespace Database\Seeders;

use App\Models\Tier;
use Illuminate\Database\Seeder;

class TierSeeder extends Seeder
{
    public function run()
    {
        Tier::factory()
            ->count(3)->sequence(['tiernumber' => 1], ['tiernumber' => 2], ['tiernumber' => 3])
            ->create();
    }
}
