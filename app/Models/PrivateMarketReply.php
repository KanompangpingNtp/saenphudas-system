<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMarketReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'market_id',
        'users_id',
        'reply_text',
        'reply_date',
    ];

    public function market()
    {
        return $this->belongsTo(PrivateMarket::class, 'market_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
