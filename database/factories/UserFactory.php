<?php

namespace Database\Factories;

use App\Helper\RandomHelper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('qwer1234!'), // password
            'phone' => fake()->phoneNumber(),
            'gender' => RandomHelper::rand(),
            'birth' => '19900101',
            'name' => fake()->name(),
            'state' => 0,
            'provider' => 'email'
        ];
    }

}
