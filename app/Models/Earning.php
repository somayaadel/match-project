<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{

    protected $table = 'earnings';
    protected $fillable = ['id','user_id','application_id','package_id','payment_method_id'];

    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class) ;
    }
    public function package(){
        return $this->belongsTo(Package::class) ;
    }
    public function payment_method(){
        return $this->belongsTo(Payment_method::class) ;
    }
}
