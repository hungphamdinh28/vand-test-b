<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategorySubGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cat_grps = \DB::table('category_groups')->pluck('id')->toArray();

        return [
            'category_group_id' => $this->faker->randomElement($cat_grps),
            'name' => $this->faker->unique(true)->company,
            'slug' => $this->faker->unique(true)->slug,
            'description' => $this->faker->text(500),
            'active' => 1
        ];
    }
}
