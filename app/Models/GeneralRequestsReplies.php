<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralRequestsReplies extends Model
{
    use HasFactory;

    protected $fillable = ['gr_form_id', 'users_id', 'reply_text', 'reply_date'];

    public function grForm()
    {
        return $this->belongsTo(GeneralRequestsForm::class, 'gr_form_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
