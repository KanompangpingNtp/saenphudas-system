<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRefundRequestReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_refund_id',
        'users_id',
        'reply_text',
        'reply_date',
    ];

    public function taxRefundRequest()
    {
        return $this->belongsTo(TaxRefundRequest::class, 'tax_refund_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
