<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => bcrypt('123456'),
            'dob' => $this->faker->date,
            'sex' => $this->faker->randomElement(['male', 'female']),
            'active' => $this->faker->boolean,
            'remember_token' => \Str::random(10),
        ];
    }
}
