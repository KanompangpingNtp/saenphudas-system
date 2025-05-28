<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodStorageFormDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'informations_id',
        'confirm_option',
        'confirm_volume',
        'confirm_number',
        'confirm_year',
        'confirm_expiration_date',
        'place_name',
        'shop_type',
        'location',
        'details_village',
        'details_alley',
        'details_road',
        'details_subdistrict',
        'details_district',
        'details_province',
        'details_telephone',
        'details_fax',
        'business_area',
        'number_of_cooks',
        'number_of_food',
        'including_food_handlers',
        'number_of_trainees',
        'opening_hours',
        'opening_for_business_until',
        'total_hours',
        'document_option',
        'document_option_detail',
        'status'
    ];

    // กำหนดความสัมพันธ์กับ food_storage_informations
    public function information()
    {
        return $this->belongsTo(FoodStorageInformations::class, 'informations_id');
    }

    public function type()
    {
        return $this->belongsTo(FoodStorageType::class, 'id');
    }
}
