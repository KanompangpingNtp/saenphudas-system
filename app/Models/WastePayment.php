<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WastePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_management_id',
        'amount',
        'payment_status',
        'payment_slip',
        'issued_at',
        'due_date',
        'bill',
        'waste_address_id'
    ];

    public function wasteManagement()
    {
        return $this->belongsTo(WasteManagement::class);
    }

    public function wasteAddress()
    {
        return $this->belongsTo(WasteAddress::class);
    }
}
