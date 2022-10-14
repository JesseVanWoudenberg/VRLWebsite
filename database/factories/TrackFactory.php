<?php

namespace Database\Factories;

use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackFactory extends Factory
{
    protected $model = Track::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->text(100),
            'country' => $this->faker->text(100),
            'length' => $this->faker->numberBetween(0, 4),
            'turns' => $this->faker->numberBetween(0, 4)
        ];
    }
}
