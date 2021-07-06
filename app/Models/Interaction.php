<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Interaction extends Model
{
    protected $table = 'interactions';
    protected $fillable = ['id', 'company_id', 'user_id', 'like', 'comment', 'seen'];
    public function company()
    {
        return $this->belongsTo(User::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
