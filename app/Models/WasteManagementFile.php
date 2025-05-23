<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteManagementFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'waste_management_id',
        'file_path',
        'file_type',
    ];

    public function wasteManagement()
    {
        return $this->belongsTo(WasteManagement::class);
    }
}
