<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ids = User::pluck('id')->toArray();
        return [
            //
            'user_id' => $this->faker->randomElement($ids),
            'balance' => $this->faker->randomNumber(3),
        ];
    }
}
