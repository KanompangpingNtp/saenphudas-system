<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMarket extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'form_status',
        'status',
        'written_at',
        'salutation',
        'full_name',
        'age',
        'force',
        'house_number',
        'road',
        'village',
        'sub_district',
        'district',
        'province',
        'submit_request',
        'submit_road',
        'submit_number',
        'submit_sub_district',
        'submit_district',
        'submit_province',
        'annual_market',
    ];

    public function files()
    {
        return $this->hasMany(PrivateMarketFile::class, 'market_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function replies()
    {
        return $this->hasMany(PrivateMarketReply::class, 'market_id');
    }
}
