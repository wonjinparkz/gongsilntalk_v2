<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'admin_id' => "webcat",
            'password' => Hash::make('qwer1234!'),
            'name' => '관리자',
            'phone' => '01012341234',
            'state' => '0',
        ]);
    }
}
