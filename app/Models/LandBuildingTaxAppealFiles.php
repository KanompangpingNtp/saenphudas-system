<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandBuildingTaxAppealFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'lbt_appeal_id',
        'file_path',
        'file_type',
    ];

    public function form()
    {
        return $this->belongsTo(LandBuildingTaxAppeal::class, 'lbt_appeal_id');
    }
}
