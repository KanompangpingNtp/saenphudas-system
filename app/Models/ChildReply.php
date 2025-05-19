<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_information_id',
        'surrender_the_child_id',
        'child_registration_id',
        'reply_text',
        'reply_date',
        'users_id'
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

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
