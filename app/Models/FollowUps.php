<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUps extends Model
{
    protected $table = 'follow-ups';
    protected $fillable = ['follower_id','following_id' ];
    use HasFactory;

    public function followingUsers(){

      return $this->hasMany(User::class,'id','following_id');
    }
    public function followerUsers(){

        return $this->hasMany(User::class,'id','follower_id');
      }
}
