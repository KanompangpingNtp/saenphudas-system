<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseTaxFormFiles extends Model
{
    use HasFactory;

    protected $fillable = ['license_tax_id', 'file_path', 'file_type', 'document_type'];

    public function information()
    {
        return $this->belongsTo(LicenseTaxInformations::class, 'license_tax_id');
    }
}
