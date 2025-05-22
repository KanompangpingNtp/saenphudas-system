<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxRefundRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'status',
        'admin_name_verifier',
        'salutation',
        'full_name',
        'age',
        'house_number',
        'village',
        'subdistrict',
        'district',
        'province',
        'phone',
        'tax_year',
        'amount',
        'receipt_number',
        'dated',
        'tax_money',
        'due_to_options',
        'other_documents',
        'road',
        'alley'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function files()
    {
        return $this->hasMany(TaxRefundRequestFiles::class, 'tax_refund_id');
    }

    public function replies()
    {
        return $this->hasMany(TaxRefundRequestReply::class, 'tax_refund_id');
    }
}
