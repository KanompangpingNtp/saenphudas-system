<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WastePayment;
use App\Models\WasteManagement;
use Carbon\Carbon;


class GenerateWasteBill extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-waste-bill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    // public function handle()
    // {
    //     $now = Carbon::now();

    //     $wasteManagements = WasteManagement::all();

    //     foreach ($wasteManagements as $wm) {
    //         $latestPayment = WastePayment::where('waste_management_id', $wm->id)
    //             ->orderByDesc('due_date')
    //             ->first();

    //         if ($latestPayment) {
    //             $dueDate = Carbon::parse($latestPayment->due_date);
    //             $nextDueDate = $dueDate->copy()->addMonth()->day($dueDate->day);
    //             $createBillDate = $nextDueDate->copy()->subDays(10);

    //             $hasNextBill = WastePayment::where('waste_management_id', $wm->id)
    //                 ->whereYear('due_date', $nextDueDate->year)
    //                 ->whereMonth('due_date', $nextDueDate->month)
    //                 ->exists();

    //             if ($now->greaterThanOrEqualTo($createBillDate) && !$hasNextBill) {
    //                 WastePayment::create([
    //                     'waste_management_id' => $wm->id,
    //                     'amount' => $latestPayment->amount,
    //                     'payment_status' => 1,
    //                     'due_date' => $nextDueDate,
    //                 ]);
    //                 $this->info("Created bill for WasteManagement ID: {$wm->id}");
    //             }
    //         }
    //     }

    //     return 0;
    // }

    public function handle()
    {
        $now = Carbon::now();
        $wasteManagements = WasteManagement::all();

        foreach ($wasteManagements as $wm) {
            $latestPayment = WastePayment::where('waste_management_id', $wm->id)
                ->orderByDesc('due_date')  // เปลี่ยนมาเรียงตาม due_date ล่าสุด
                ->first();

            if ($latestPayment) {
                $dueDate = Carbon::parse($latestPayment->due_date); // ใช้ due_date แทน created_at

                if ($dueDate->day >= 20) {
                    $nextDueDate = $dueDate->copy()->addMonthsNoOverflow(2)->startOfMonth();
                } else {
                    $nextDueDate = $dueDate->copy()->addMonthNoOverflow()->startOfMonth();
                }

                if ($now->greaterThanOrEqualTo($nextDueDate)) {
                    $hasNextBill = WastePayment::where('waste_management_id', $wm->id)
                        ->whereYear('due_date', $nextDueDate->year)
                        ->whereMonth('due_date', $nextDueDate->month)
                        ->exists();

                    if (!$hasNextBill) {
                        WastePayment::create([
                            'waste_management_id' => $wm->id,
                            'amount' => $latestPayment->amount,
                            'payment_status' => 1,
                            'due_date' => $nextDueDate,
                            'issued_at' => now(),
                        ]);
                        $this->info("Created bill for WasteManagement ID: {$wm->id}");
                    }
                }
            }
        }

        return 0;
    }
}
