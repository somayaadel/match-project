<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $table = 'faqs';

    protected $fillable = ['id','question' ,'answer','application_id'];
    use HasFactory;
    public function application(){
        return $this->belongsTo(Application::class) ;
    }

}
