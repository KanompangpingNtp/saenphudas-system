<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'salutation',
        'name',
        'address',
        'village',
        'sub_district',
        'district',
        'province',
        'phone',
        'optione',
        'optione_detail',
        'lat',
        'lng',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(WasteManagementFile::class);
    }

    public function replys()
    {
        return $this->hasMany(WasteManagementReply::class);
    }
}
