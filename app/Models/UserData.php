<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Religion ;
use App\Models\City ;
use App\Models\Job ;

class UserData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id' ,
        'summary' ,
        'address',
        'phone',
        'weight',
        'hight' ,
        'birth_date' ,
        'gender' ,
        'city_id' ,
        'package_id' ,
        'profile_image'
    ];

    public function package(){
        return $this->belongsTo(Package::class) ;
    }

    public function religion(){
        return $this->belongsTo(Religion::class) ;
    }
    public function city(){
        return $this->belongsTo(City::class) ;
    }
    public function job(){
        return $this->belongsTo(Job::class) ;
    }

    public function freePackage(){
        return $this->belongsTo(Package::class)->where('price' , 0);
    }

    public function user(){
        return $this->belongsTo(User::class) ;
    }

}
