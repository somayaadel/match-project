<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{

    protected $table = 'payment_method';
    protected $fillable = ['id','name'];
    use HasFactory;
    public function earnings(){
        return $this->hasMany(Earning::class) ;


    }
}
