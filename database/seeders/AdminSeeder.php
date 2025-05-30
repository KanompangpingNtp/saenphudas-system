<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDetail;

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
            ['email' => 'admin02@example.com'],
            [
                'name' => 'แอดมิน',
                'password' => Hash::make('123456789'),
                'level' => '3',
            ]
        );

        $user = User::updateOrCreate(
            ['email' => 'users01@example.com'],
            [
                'name' => 'เก้า อดิศร',
                'password' => Hash::make('123456789'),
                'level' => '2',
            ]
        );

        UserDetail::updateOrCreate(
            ['users_id' => $user->id],
            [
                'salutation' => 'นาย',
                'age' => 25,
                'phone' => '0812345678',
                'house_number' => '123',
                'village' => 'หมู่ 5',
                'subdistrict' => 'ตำบลสวย',
                'district' => 'อำเภองาม',
                'province' => 'จังหวัดดี',
            ]
        );
    }
}
