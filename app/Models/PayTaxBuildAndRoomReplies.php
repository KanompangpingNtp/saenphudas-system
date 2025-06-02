<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayTaxBuildAndRoomReplies extends Model
{
    use HasFactory;

    protected $fillable = ['pay_tax_id', 'users_id', 'reply_text', 'reply_date'];

    public function details()
    {
        return $this->belongsTo(PayTaxBuildAndRoomFormDetails::class, 'pay_tax_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
