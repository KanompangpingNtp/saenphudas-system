<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'status',
        'admin_name_verifier',
        'full_name',
        'ethnicity',
        'nationality',
        'birthday',
        'age',
        'age_months',
        'citizen_id',
        'age_since_date',
        'regis_house_number',
        'regis_village',
        'regis_road',
        'regis_subdistrict',
        'regis_district',
        'regis_province',
        'current_house_number',
        'current_village',
        'current_road',
        'current_subdistrict',
        'current_district',
        'current_province',
        'current_phone_number',
        'number_of_siblings',
        'congenital_disease',
        'blood_group',
        'the_child_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function caregiverInformation()
    {
        return $this->hasMany(CaregiverInformation::class, 'child_information_id');
    }

    public function attachments()
    {
        return $this->hasMany(ChildAttachment::class, 'child_information_id');
    }

    public function replies()
    {
        return $this->hasMany(ChildReply::class, 'child_information_id');
    }

    public function surrenderTheChild()
    {
        return $this->hasMany(SurrenderTheChild::class, 'child_information_id');
    }

    public function childRegistration()
    {
        return $this->hasMany(ChildRegistration::class, 'child_information_id');
    }
}
