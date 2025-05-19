<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'assist_people_id',
        'reply_text',
        'reply_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function assistPerson()
    {
        return $this->belongsTo(AssistPerson::class, 'assist_people_id');
    }
}
