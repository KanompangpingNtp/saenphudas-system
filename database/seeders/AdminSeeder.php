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
            ['email' => 'admin01@example.com'],
            [
                'name' => 'แอดมิน',
                'password' => Hash::make('123456789'),
                'level' => '1',
            ]
        );

        User::updateOrCreate(
            ['email' => 'users01@example.com'],
            [
                'name' => 'test',
                'password' => Hash::make('123456789'),
                'level' => '2',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin02@example.com'],
            [
                'name' => 'แอดมิน',
                'password' => Hash::make('123456789'),
                'level' => '3',
            ]
        );

        User::updateOrCreate(
            ['email' => 'users02@example.com'],
            [
                'name' => 'test',
                'password' => Hash::make('123456789'),
                'level' => '4',
            ]
        );
    }
}
