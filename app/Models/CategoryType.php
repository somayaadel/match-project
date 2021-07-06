<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Application ;

class CategoryType extends Model
{
    protected $table = 'category_types';

    protected $fillable = ['id','name' ,'application_id'];
    use HasFactory;
    public function application(){
        return $this->belongsTo(Application::class) ;
    }
    public function Categories(){
        return $this->hasMany(Category::class) ;
    }
}
