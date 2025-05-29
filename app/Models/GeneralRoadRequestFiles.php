<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralRoadRequestFiles extends Model
{
    use HasFactory;

    protected $fillable = ['grr_form_id', 'file_path', 'file_type'];

    public function grrForm()
    {
        return $this->belongsTo(GeneralRoadRequestForm::class, 'grr_form_id');
    }
}
