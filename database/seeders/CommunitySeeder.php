<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\CommunityCategory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $startDate = Carbon::now();
        $endDate   = Carbon::now()->subDays(7);
        $randomDate = Carbon::createFromTimestamp(rand($endDate->timestamp, $startDate->timestamp));

        CommunityCategory::create([
            'title' => fake()->word(),
            'content' => fake()->realText(),
            'state' => 0,
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ]);
        Community::factory(10000)->create();
    }
}
