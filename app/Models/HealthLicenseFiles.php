<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthLicenseFiles extends Model
{
    use HasFactory;

    protected $fillable = ['health_license_id', 'file_path', 'file_type', 'document_type'];

    public function information()
    {
        return $this->belongsTo(HealthLicenseApp::class, 'health_license_id');
    }
}
