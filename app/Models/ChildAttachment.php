<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_information_id',
        'surrender_the_child_id',
        'child_registration_id',
        'file_path',
        'file_type'
    ];

    public function childInformation()
    {
        return $this->belongsTo(ChildInformation::class, 'child_information_id');
    }

    public function surrenderTheChild()
    {
        return $this->belongsTo(SurrenderTheChild::class, 'surrender_the_child_id');
    }

    public function childRegistration()
    {
        return $this->belongsTo(ChildRegistration::class, 'child_registration_id');
    }
}
