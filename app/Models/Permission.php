<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = ['id','name','router'];
    use HasFactory;
    public function users(){
        return $this->belongsToMany(User::class) ;
    }
}
