<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'article_name' => $this->faker->name,
            'author' => $this->faker->name,
            'description' => $this->faker->text
        ];
    }
}
