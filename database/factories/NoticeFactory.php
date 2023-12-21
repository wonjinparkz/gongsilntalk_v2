<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $startDate = Carbon::now();
        $endDate   = Carbon::now()->subDays(7);
        $randomDate = Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp));

        return [
            'admins_id' => 1,
            'title' => fake()->sentence(),
            'content' => fake()->realText(),
            'type' => 0,
            'is_blind' => 0,
            'view_count' => fake()->numerify(),
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
