<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User ;

class Religion extends Model
{
    protected $table = 'religions';
    protected $fillable = ['id','name','name_ar'];
    use HasFactory;
    public function users(){
        return $this->hasMany(User::class) ;
    }
}
