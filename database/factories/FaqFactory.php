<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{

    public function definition(): array
    {
        $startDate = Carbon::now();
        $endDate   = Carbon::now()->subDays(7);
        $randomDate = Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp));

        return [
            'author' => 1,
            'title' => fake()->sentence(),
            'content' => fake()->realText(),
            'state' => 0,
            'target' => fake()->randomElement(['0', '1', '0,1']),
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
