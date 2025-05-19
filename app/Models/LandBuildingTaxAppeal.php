<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandBuildingTaxAppeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'status',
        'admin_name_verifier',
        'delivered_to',
        'year',
        'number',
        'dated',
        'received_date',
        'salutation',
        'full_name',
        'due_to',
        'documents',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function files()
    {
        return $this->hasMany(LandBuildingTaxAppealFiles::class, 'lbt_appeal_id');
    }

    public function replies()
    {
        return $this->hasMany(LandBuildingTaxAppealReply::class, 'lbt_appeal_id');
    }
}
