<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityBankac extends Model
{
    use HasFactory;

    protected $fillable = ['disability_people_id', 'bank_name', 'bank_option', 'account_number', 'account_name'];

    public function disabilityPerson()
    {
        return $this->belongsTo(DisabilityPerson::class, 'disability_people_id');
    }
}
