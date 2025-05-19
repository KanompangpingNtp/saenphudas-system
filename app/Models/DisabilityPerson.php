<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'status',
        'admin_name_verifier',
        'written_at',
        'written_date',
        'salutation',
        'first_name',
        'last_name',
        'birth_day',
        'age',
        'nationality',
        'house_number',
        'village',
        'alley',
        'road',
        'subdistrict',
        'district',
        'province',
        'postal_code',
        'phone_number',
        'citizen_id',
        'type_of_disability',
        'marital_status',
        'monthly_income',
        'occupation',
        'references_contacted',
        'references_phone',
        'community'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function disabilityOptions()
    {
        return $this->hasMany(DisabilityOption::class, 'disability_people_id');
    }

    public function disabilityAttachments()
    {
        return $this->hasMany(DisabilityAttachment::class, 'disability_people_id');
    }

    public function disabilityReplies()
    {
        return $this->hasMany(DisabilityReply::class, 'disability_people_id');
    }

    public function disabilityBankAccounts()
    {
        return $this->hasMany(DisabilityBankac::class, 'disability_people_id');
    }
}
