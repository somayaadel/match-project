<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    // protected $table = 'applications';

    protected $fillable = ['id','name', 'name_ar' ,'app_key' ];

    use HasFactory;

    public function users(){
        return $this->hasMany(User::class) ; 
    }
}
