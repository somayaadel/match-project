<?php

namespace App\Models;

use App\Models\CategoryType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    protected $fillable = ['id', 'name', 'name_ar', 'image', 'category_type_id', 'application_id'];
    use HasFactory;

    public function categoryType()
    {
        return $this->belongsTo(CategoryType::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
