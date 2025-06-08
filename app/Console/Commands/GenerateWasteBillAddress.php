<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WasteAddress;
use App\Models\WastePayment;
use Carbon\Carbon;

class GenerateWasteBillAddress extends Command
{
    protected $signature = 'generate:waste-bill-address';

    protected $description = 'Generate waste bill from WasteAddress with end_date based billing';

    public function handle()
    {
        $now = Carbon::now();

        $wasteAddresses = WasteAddress::all();

        foreach ($wasteAddresses as $wa) {
            $latestPayment = WastePayment::where('waste_address_id', $wa->id)
                ->orderByDesc('end_date')
                ->first();

            if ($latestPayment) {
                $latestEndDate = Carbon::parse($latestPayment->end_date);

                // เริ่มจากวันถัดไปหลัง end_date ล่าสุด
                $nextBillDate = $latestEndDate->copy()->addDay();

                // ตั้งวันที่เป็นวันที่ 15 ของเดือนถัดไป (เดือนของ $nextBillDate)
                $nextBillDate->day = 15;

                while ($nextBillDate->lessThanOrEqualTo($now)) {
                    $nextEndDate = $nextBillDate->copy()->addMonthNoOverflow()->day(14);

                    $exists = WastePayment::where('waste_address_id', $wa->id)
                        ->where('due_date', $nextBillDate->toDateString())
                        ->where('end_date', $nextEndDate->toDateString())
                        ->exists();

                    if (!$exists) {
                        WastePayment::create([
                            'waste_address_id' => $wa->id,
                            'amount' => 20,
                            'payment_status' => 1,
                            'due_date' => $nextBillDate->toDateString(),
                            'end_date' => $nextEndDate->toDateString(),
                            'issued_at' => now(),
                        ]);

                        $this->info("Created bill for WasteAddress ID: {$wa->id} with due_date {$nextBillDate->toDateString()}");
                    }

                    // เลื่อนไปเดือนถัดไป
                    $nextBillDate->addMonthNoOverflow();
                }
            } else {
                $this->info("No previous payment found for WasteAddress ID: {$wa->id}");
            }
        }

        return 0;
    }
}
