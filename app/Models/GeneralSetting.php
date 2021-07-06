<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{

    protected $table = 'general_settings';
    protected $fillable = ['id','name','application_id','email','phone','time_zone','member_email_verification','member_profile_picture_admin_approve','terms','privacy_policy'];

    use HasFactory;
}
