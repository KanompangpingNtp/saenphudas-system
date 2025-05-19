<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisabilityAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['disability_people_id', 'file_path', 'file_type'];

    public function disabilityPerson()
    {
        return $this->belongsTo(DisabilityPerson::class, 'disability_people_id');
    }
}
