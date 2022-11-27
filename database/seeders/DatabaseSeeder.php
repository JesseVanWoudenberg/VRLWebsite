<?php

namespace Database\Seeders;

use App\Models\Raceformat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            UserSeeder::class,
//            ArticleSeeder::class,
            RaceformatSeeder::class,
//            TierSeeder::class,
            PowerunitSeeder::class,
            TrackSeeder::class,
            TeamSeeder::class,
//            DriverSeeder::class
        ]);
    }
}
