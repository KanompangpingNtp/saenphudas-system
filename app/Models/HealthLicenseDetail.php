<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthLicenseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_license_id',
        'type_request',
        'petition',
        'name_establishment',
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
        'machine_power',
        'number_male_workers',
        'number_female_workers',
        'opening_hours',
        'opening_for_business_until',
        'document_option',
        'document_option_detail',
        'status'
    ];

    public function license()
    {
        return $this->belongsTo(HealthLicenseApp::class, 'health_license_id');
    }
}
