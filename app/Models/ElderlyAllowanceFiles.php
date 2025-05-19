<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElderlyAllowanceFiles extends Model
{
    use HasFactory;

    protected $fillable = ['ea_people_id', 'file_path', 'file_type'];

    public function People()
    {
        return $this->belongsTo(ElderlyAllowancePeople::class, 'ea_people_id');
    }
}
