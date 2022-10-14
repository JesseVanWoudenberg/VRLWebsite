<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        Team::factory()
            ->count(11)->sequence(['name' => 'Red Bull', 'powerunit_id' => 1] , ['name' => 'Ferrari', 'powerunit_id' => 1] , ['name' => 'Mercedes', 'powerunit_id' => 1],
                                        ['name' => 'Mclaren', 'powerunit_id' => 1] , ['name' => 'Alpine', 'powerunit_id' => 1] , ['name' => 'Alfa Romeo', 'powerunit_id' => 1],
                                        ['name' => 'Alpha Tauri', 'powerunit_id' => 1], ['name' => 'Aston Martin', 'powerunit_id' => 1] , ['name' => 'Williams Racing', 'powerunit_id' => 1],
                                        ['name' => 'Haas', 'powerunit_id' => 1] , ['name' => 'Reserves', 'powerunit_id' => 1])
            ->create();
    }
}
