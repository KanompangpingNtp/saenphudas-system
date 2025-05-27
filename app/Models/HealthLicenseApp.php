<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthLicenseApp extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'form_status',
        'admin_name_verifier',
        'title_name',
        'salutation',
        'full_name',
        'age',
        'nationality',
        'id_card_number',
        'address',
        'village',
        'alley',
        'road',
        'subdistrict',
        'district',
        'province',
        'telephone',
        'fax'
    ];

    public function details()
    {
        return $this->hasOne(HealthLicenseDetail::class, 'health_license_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function files()
    {
        return $this->hasMany(HealthLicenseFiles::class, 'health_license_id');
    }

    public function replies()
    {
        return $this->hasMany(HealthLicenseReplies::class, 'health_license_id');
    }
}
