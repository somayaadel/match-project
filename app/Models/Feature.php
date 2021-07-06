<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service ;

class Feature extends Model
{
    protected $table = 'features';

    protected $fillable = ['id','name' ,'name_ar', 'service_id'];
    use HasFactory;

    public function service(){
        return $this->belongsTo(Service::class) ;
    }
    public function package(){

    }

}
