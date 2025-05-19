<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElderlyAllowanceBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'ea_people_id',
        'bank_option',
        'bank_name',
        'account_number',
        'account_name'
    ];

    public function People()
    {
        return $this->belongsTo(ElderlyAllowancePeople::class, 'ea_people_id');
    }
}
