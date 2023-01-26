<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'slug' => $this->faker->slug,
            'active' => 1,
            'description' => $this->faker->text(500),
            'created_at' => Carbon::Now(),
            'updated_at' => Carbon::Now(),
        ];
    }
}
