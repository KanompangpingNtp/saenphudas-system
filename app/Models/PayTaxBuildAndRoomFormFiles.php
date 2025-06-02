<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayTaxBuildAndRoomFormFiles extends Model
{
    use HasFactory;

    protected $fillable = ['pay_tax_id', 'file_path', 'file_type', 'document_type'];

    public function information()
    {
        return $this->belongsTo(PayTaxBuildAndRoomInformations::class, 'pay_tax_id');
    }
}
