<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package ; 
class Field extends Model
{
    protected $table = 'fields';
    protected $fillable = ['id','name' , 'name_ar' ,'type','application_id' , 'required' , 'role_id' , 'items' , 'mandatory'];
    use HasFactory;

    protected $casts = [
        'items' => 'array',
    ];

    public function packages(){
        $this->belongsToMany(Package::class ) ; 
    }
    public function users(){
        $this->belongsToMany(User::class) ; 
    }
}
