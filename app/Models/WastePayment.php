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
        'bill'
    ];

    public function wasteManagement()
    {
        return $this->belongsTo(WasteManagement::class);
    }
}
