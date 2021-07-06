<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Feature ;
use App\Models\Field ;
use App\Models\User ;

class Package extends Model
{
    protected $table = 'packages';
    protected $fillable = ['id','name', 'name_ar' ,'price','application_id' , 'duration' , 'role_id'];
    use HasFactory;


    public function features(){
        return $this->belongsToMany(Feature::class)->withPivot('limitation') ;
    }
    public function earnings(){
        return $this->hasMany(Earning::class) ;
    }
    public function fields(){
        return $this->belongsToMany(Field::class) ;
    }
    public function users(){
        return $this->hasMany(User::class) ;
    }

    public function feature($feature_id){
        return $this->belongsToMany(Feature::class)->wherePivot('feature_id',$feature_id)->withPivot(['limitation' , 'id']) ;
    }

}
