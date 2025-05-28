<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMarketFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'market_id',
        'file_path',
        'file_type',
    ];

    public function market()
    {
        return $this->belongsTo(PrivateMarket::class, 'market_id');
    }
}
