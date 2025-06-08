<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WasteAddress;
use App\Models\WastePayment;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Import extends Controller
{
    public function address()
    {
        $path = storage_path('app/ex.xlsx');
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path('app/ex.xlsx'));
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $item = [];
        foreach (array_slice($rows, 3) as $row) {
            $clean = preg_replace('/[^0-9\/]/', '', $row[1] ?? '');
            if (empty($clean)) {
                continue;
            }
            if (version_compare($clean, '106/1066', '>')) {
                break;
            }
            $item[$clean] = [];
            $startYear = 2558;
            $endYear = 2568;
            $startCol = 2;
            for ($year = $startYear; $year <= $endYear; $year++) {
                $colIndex = $startCol + ($year - $startYear);
                $item[$clean]["$year"] = $row[$colIndex] ?? null;
            }
        }
        foreach ($item as $key => $value) {
            $waste_addresses = new WasteAddress();
            $waste_addresses->name = $key;
            if ($waste_addresses->save()) {
                foreach ($value as $value_key => $rs) {
                    $waste_payment = new WastePayment();
                    $waste_payment->waste_address_id = $waste_addresses->id;
                    $waste_payment->amount = 240;
                    $waste_payment->payment_status = ($rs) ? 1 : 3;
                    $waste_payment->created_at = date('Y-m-d H:i:s');
                    $waste_payment->updated_at = date('Y-m-d H:i:s');
                    $waste_payment->due_date = ($value_key - 543) . '-01-01';
                    $waste_payment->end_date = ($value_key - 543) . '-12-31';
                    $waste_payment->save();
                }
            }
        }
    }
}
