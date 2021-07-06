<?php

namespace App\Models;

use App\Models\UserData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'name_ar', 'country_id',
    ];
    public function users()
    {
        return $this->hasMany(UserData::class);
    }
}
