<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company = $this->faker->unique->company;
        $users = \DB::table('users')->pluck('id')->toArray();

        return [
            'owner_id' => $this->faker->randomElement($users),
            'name' => $company,
            'legal_name' => $company,
            'slug' => $this->faker->slug,
            'email' => $this->faker->email,
            'description' => $this->faker->text(500),
            'external_url' => $this->faker->url,
            'active' => $this->faker->boolean,
        ];
    }
}
