<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteManagementReply extends Model
{
    use HasFactory;

       protected $fillable = [
        'waste_management_id',
        'users_id',
        'reply_text',
        'reply_date',
    ];

    public function wasteManagement()
    {
        return $this->belongsTo(WasteManagement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
