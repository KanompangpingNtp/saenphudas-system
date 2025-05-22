<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRefundRequestFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'tax_refund_id',
        'file_path',
        'file_type',
    ];

    public function taxRefundRequest()
    {
        return $this->belongsTo(TaxRefundRequest::class, 'tax_refund_id');
    }
}
