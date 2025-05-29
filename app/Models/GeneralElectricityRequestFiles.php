<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralElectricityRequestFiles extends Model
{
    use HasFactory;

    protected $fillable = ['ger_form_id', 'file_path', 'file_type'];

    public function gerForm()
    {
        return $this->belongsTo(GeneralElectricityRequestForm::class, 'ger_form_id');
    }
}
