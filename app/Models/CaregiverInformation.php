<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaregiverInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_information_id',
        'father_name',
        'edu_qual_father',
        'mother_name',
        'edu_qual_mother',
        'care_option',
        'care_option_other',
        'caretaker_income',
        'applicants_name',
        'applicants_relevant',
        'child_carrier_name',
        'child_carrier_relevant',
        'child_carrier_phone',
        'father_occupation',
        'mother_occupation',
        'care_option_relative_text'
    ];

    public function childInformation()
    {
        return $this->belongsTo(ChildInformation::class, 'child_information_id');
    }
}
