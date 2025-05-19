<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'แอดมิน',
                'password' => Hash::make('123456789'),
                'level' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'users@example.com'],
            [
                'name' => 'test',
                'password' => Hash::make('123456789'),
                'level' => 'user',
            ]
        );
    }
}
