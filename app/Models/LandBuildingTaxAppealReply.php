<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandBuildingTaxAppealReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'lbt_appeal_id',
        'users_id',
        'reply_text',
        'reply_date',
    ];

    public function form()
    {
        return $this->belongsTo(LandBuildingTaxAppeal::class, 'lbt_appeal_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
