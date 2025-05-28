<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodStorageType extends Model
{
    use HasFactory;

    protected $fillable = ['type_name'];

    public function details()
    {
        return $this->hasMany(FoodStorageFormDetails::class, 'confirm_option');
    }
}
