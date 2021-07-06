<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    /**
     * user notification records.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('id', 'seen', 'data', 'created_at')->orderBy('pivot_created_at', 'desc')->withTimestamps();
    }
}
