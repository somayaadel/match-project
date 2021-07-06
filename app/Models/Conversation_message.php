<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation_message extends Model
{
    protected $table = 'conversations_messages';

    protected $fillable = ['id','message_body','sender_id','conversation_id'];

    use HasFactory;
}
