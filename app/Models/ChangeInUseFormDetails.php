<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeInUseFormDetails extends Model
{
    use HasFactory;

        protected $fillable = [
        'change_in_use_id',
        'land_total',
        'land_on',
        'land_village',
        'land_road',
        'land_subdistrict',
        'land_district',
        'land_province',
        'land_deed',
        'land_rai',
        'land_unit',
        'land_wa',
        'land_default_use',
        'land_current_use',
        'build_total',
        'build_on',
        'build_village',
        'build_road',
        'build_subdistrict',
        'build_district',
        'build_province',
        'build_deed',
        'build_meter',
        'build_default_use',
        'build_current_use',
        'build_current_date',
        'room_total',
        'room_name',
        'room_on',
        'room_village',
        'room_road',
        'room_subdistrict',
        'room_district',
        'room_province',
        'room_deed',
        'room_meter',
        'room_default_use',
        'room_current_use',
        'room_current_date'
    ];

    public function details()
    {
        return $this->belongsTo(ChangeInUseInformations::class, 'change_in_use_id');
    }
}
