<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Faq;
use App\Models\Admin;
use App\Models\Notice;
use Database\Factories\AdminFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            NoticeSeeder::class,
            UserSeeder::class,
            FaqSeeder::class,
            CommunitySeeder::class
        ]);

    }
}
