<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthLicenseReplies extends Model
{
    use HasFactory;

    protected $fillable = ['health_license_id', 'users_id', 'reply_text', 'reply_date'];

    public function information()
    {
        return $this->belongsTo(HealthLicenseApp::class, 'health_license_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
