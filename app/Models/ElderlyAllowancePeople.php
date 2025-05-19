<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElderlyAllowancePeople extends Model
{
    use HasFactory;

     protected $fillable =
    [
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
        'marital_status',
        'monthly_income',
        'occupation',
        'community'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function personsOption()
    {
        return $this->hasMany(ElderlyAllowancePersonsOptions::class, 'ea_people_id');
    }

    public function files()
    {
        return $this->hasMany(ElderlyAllowanceFiles::class, 'ea_people_id');
    }

    public function replies()
    {
        return $this->hasMany(ElderlyAllowanceReplies::class, 'ea_people_id');
    }

    public function bank()
    {
        return $this->hasMany(ElderlyAllowanceBank::class, 'ea_people_id');
    }
}
