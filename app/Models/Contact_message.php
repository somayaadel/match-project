<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_message extends Model
{
    protected $table = 'contact_messages';

    protected $fillable = ['id','message_body','subject','email'];

    use HasFactory;
}
