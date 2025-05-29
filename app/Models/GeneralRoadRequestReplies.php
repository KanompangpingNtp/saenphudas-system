<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralRoadRequestReplies extends Model
{
    use HasFactory;

    protected $fillable = ['grr_form_id', 'users_id', 'reply_text', 'reply_date'];

    public function grrForm()
    {
        return $this->belongsTo(GeneralRoadRequestForm::class, 'grr_form_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
