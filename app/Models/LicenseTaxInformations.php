<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseTaxInformations extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'form_status',
        'admin_name_verifier',
        'salutation',
        'full_name',
        'address',
        'village',
        'road',
        'subdistrict',
        'district',
        'province',
    ];

    public function details()
    {
        return $this->hasOne(LicenseTaxFormDetails::class, 'license_tax_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function replies()
    {
        return $this->hasMany(LicenseTaxReplies::class, 'license_tax_id');
    }

    public function files()
    {
        return $this->hasMany(LicenseTaxFormFiles::class, 'license_tax_id');
    }

    public function options()
    {
        return $this->hasMany(LicenseTaxOption::class, 'license_tax_id');
    }
}
