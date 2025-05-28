<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodStorageType;

class FoodStorageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'จัดตั้งสถานที่จำหน่ายอาหาร',
            'จัดตั้งสถานที่สะสมอาหาร',
        ];

        foreach ($types as $type) {
            FoodStorageType::firstOrCreate([
                'type_name' => $type,
            ]);
        }
    }
}
