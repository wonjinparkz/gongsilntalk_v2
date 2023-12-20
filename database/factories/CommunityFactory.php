<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
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
            'category_id' => 1,
            'author' => 1,
            'title' => fake()->sentence(),
            'content' => fake()->realText(),
            'state' => 0,
            'delete' => 0,
            'view_count' => fake()->numerify(),
            'block_count' => 0,
            'like_count' => 0,
            'report_count' => 0,
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
