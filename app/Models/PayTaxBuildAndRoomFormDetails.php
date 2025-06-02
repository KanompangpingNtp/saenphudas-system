<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayTaxBuildAndRoomFormDetails extends Model
{
    use HasFactory;

     protected $fillable = [
        'pay_tax_id',
        'personal_salutation',
        'personal_full_name',
        'personal_age',
        'personal_id_card_number',
        'personal_id_card_by',
        'personal_id_card_date',
        'personal_address',
        'personal_village',
        'personal_alley',
        'personal_road',
        'personal_subdistrict',
        'personal_district',
        'personal_province',
        'personal_telephone',
        'personal_line',
        'personal_email',
        'org_salutation',
        'org_full_name',
        'org_address',
        'org_village',
        'org_alley',
        'org_road',
        'org_subdistrict',
        'org_district',
        'org_province',
        'org_telephone',
        'org_salutation_2',
        'org_full_name_2',
        'org_age_2',
        'org_id_card_2',
        'org_id_card_by_2',
        'org_id_card_date_2',
        'org_certificate',
        'org_certificate_date',
        'org_line',
        'org_email',
        'year',
        'date',
        'total',
        'round_date_1',
        'round_total_1',
        'round_date_2',
        'round_total_2',
        'round_date_3',
        'round_total_3',
        'confirm',
    ];

    public function details()
    {
        return $this->belongsTo(PayTaxBuildAndRoomInformations::class, 'pay_tax_id');
    }
}
