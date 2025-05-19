<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityReply extends Model
{
    use HasFactory;

    protected $fillable = ['disability_people_id', 'users_id', 'reply_text', 'reply_date'];

    public function disabilityPerson()
    {
        return $this->belongsTo(DisabilityPerson::class, 'disability_people_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
