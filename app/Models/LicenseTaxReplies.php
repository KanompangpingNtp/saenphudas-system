<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseTaxReplies extends Model
{
    use HasFactory;

    protected $fillable = ['license_tax_id', 'users_id', 'reply_text', 'reply_date'];

    public function details()
    {
        return $this->belongsTo(LicenseTaxFormDetails::class, 'license_tax_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
