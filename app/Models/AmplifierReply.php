<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmplifierReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'amplifier_id',
        'users_id',
        'reply_text',
        'reply_date',
    ];

    public function amplifier()
    {
        return $this->belongsTo(Amplifier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
