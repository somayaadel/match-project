<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $table = 'blocks';
    protected $fillable = ['user_id','blocked_id','report_id' ];
    use HasFactory;


    public function blockedUsers(){

        return $this->hasMany(User::class,'id','blocked_id');
      }
}
