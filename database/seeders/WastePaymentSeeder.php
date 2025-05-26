<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WastePayment;
use Carbon\Carbon;

class WastePaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wasteManagementId = 1;

        for ($i = 5; $i >= 1; $i--) {
            $dueDate = Carbon::now()->subMonths($i)->endOfMonth();

            WastePayment::create([
                'waste_management_id' => $wasteManagementId,
                'amount' => 100,
                'payment_status' => 1, // ค้างชำระ
                'payment_slip' => null,
                'paid_at' => null,
                'due_date' => $dueDate,
            ]);
        }
    }
}
