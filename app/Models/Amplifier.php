<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amplifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'form_status',
        'status',
        'admin_name_verifier',
        'written_at',
        'full_name',
        'age',
        'ethnicity',
        'nationality',
        'house_number',
        'road',
        'village',
        'sub_district',
        'district',
        'province',
        'registration_number1',
        'registration_number2',
        'registration_number3',
        'have_intention',
        'location_at',
        'location_number',
        'location_road',
        'location_village',
        'location_sub_district',
        'location_district',
        'location_province',
        'location_set',
        'location_start',
        'location_end',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function files()
    {
        return $this->hasMany(AmplifierFile::class);
    }

    public function replies()
    {
        return $this->hasMany(AmplifierReply::class);
    }
}
