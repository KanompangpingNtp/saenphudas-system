<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'disability_people_id',
        'welfare_type',
        'welfare_other_types',
        'request_for_money_type',
        'document_type'
    ];

    public function disabilityPerson()
    {
        return $this->belongsTo(DisabilityPerson::class, 'disability_people_id');
    }
}
