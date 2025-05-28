<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodStorageFormReplies extends Model
{
    use HasFactory;

    protected $fillable = ['informations_id', 'users_id', 'reply_text', 'reply_date'];

    public function details()
    {
        return $this->belongsTo(FoodStorageInformations::class, 'informations_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
