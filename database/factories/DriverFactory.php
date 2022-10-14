<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Team;
use App\Models\Tier;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    protected $model = Driver::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'nationality' => $this->faker->name,
            'drivernumber' => $this->faker->numberBetween(1, 99),
            'team_id' => Team::all()->random()->id,
            'tier_id' => Tier::all()->random()->id,
        ];
    }
}
