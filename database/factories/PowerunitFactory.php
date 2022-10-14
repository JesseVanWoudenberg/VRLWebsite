<?php

namespace Database\Factories;

use App\Models\Powerunit;
use Illuminate\Database\Eloquent\Factories\Factory;

class PowerunitFactory extends Factory
{
    protected $model = Powerunit::class;

    public function definition(): array
    {
        return [
            'name' => 'Honda'
        ];
    }
}
