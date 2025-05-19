<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseTaxOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_tax_id',
        'type',
        'wide',
        'long',
        'meter',
        'amount',
        'text',
        'place',
        'date',
        'remark',
    ];
}
