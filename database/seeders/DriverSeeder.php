<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    public function run()
    {
        Driver::factory()
            ->times(50)
            ->create();
    }
}
