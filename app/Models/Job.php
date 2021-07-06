<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User ;

class Job extends Model
{ protected $table = 'jobs';
    protected $fillable = ['id', 'name' ,'name_ar'];
    use HasFactory;
    public function users(){
        return $this->hasMany(User::class) ;
    }
}
