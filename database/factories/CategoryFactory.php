<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cat_sub_grps = \DB::table('category_sub_groups')->pluck('id')->toArray();
        return [
            'category_sub_group_id' => $this->faker->randomElement($cat_sub_grps),
            'name' => $this->faker->unique(true)->company,
            'slug' => $this->faker->unique(true)->slug,
            'description' => $this->faker->text(80),
            'active' => 1,
        ];
    }
}
