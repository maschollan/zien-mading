<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MadingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create('id_ID');
        return [
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'judul' => $this->faker->sentence,
            'konten' => $this->faker->paragraph,
        ];
    }
}
