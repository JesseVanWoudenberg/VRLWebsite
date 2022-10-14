<?php

namespace Database\Seeders;

use App\Models\Powerunit;
use Illuminate\Database\Seeder;

class PowerunitSeeder extends Seeder
{
    public function run()
    {
        Powerunit::factory()
            ->count(4)->sequence(['name' => 'Red Bull Powertrains'], ['name' => 'Mercedes'], ['name' => 'Ferrari'], ['name' => 'Renault'] )
            ->create();
    }
}
