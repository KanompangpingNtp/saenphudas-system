<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseTaxFormDetails extends Model
{
    use HasFactory;

        protected $fillable = [
        'license_tax_id',
        'salutation',
        'full_name',
        'build_name',
        'address',
        'alley',
        'village',
        'road',
        'subdistrict',
        'district',
        'province',
        'telephone',
        'emp_fullname',
        'build_wide_1',
        'build_long_1',
        'build_meter_1',
        'build_amount_1',
        'build_text_1',
        'build_place_1',
        'build_date_1',
        'build_remark_1',
        'build_wide_2',
        'build_long_2',
        'build_meter_2',
        'build_amount_2',
        'build_text_2',
        'build_place_2',
        'build_date_2',
        'build_remark_2',
        'build_wide_3',
        'build_long_3',
        'build_meter_3',
        'build_amount_3',
        'build_text_3',
        'build_place_3',
        'build_date_3',
        'build_remark_3',
    ];

    public function details()
    {
        return $this->belongsTo(LicenseTaxInformations::class, 'license_tax_id');
    }
}
