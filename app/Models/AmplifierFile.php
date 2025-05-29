<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmplifierFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'amplifier_id',
        'file_path',
        'file_type',
    ];

    public function amplifier()
    {
        return $this->belongsTo(Amplifier::class);
    }
}
