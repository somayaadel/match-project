<?php

namespace App\Models;

use App\Models\Application;
use App\Models\Role;
use App\Models\Upload;
use App\Models\UserData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_ar',
        'email',
        'password',
        'role_id',
        'application_id', 'user_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function userData()
    {
        return $this->hasOne(UserData::class);
    }
    public function earnings()
    {
        return $this->hasMany(Earning::class);
    }

    public function freeUserData()
    {
        return $this->hasOne(UserData::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function fields($fieldId = null)
    {
        if ($fieldId) {
            return $this->belongsToMany(Field::class)->where('field_id', $fieldId)->withPivot('value');
        } else {
            return $this->belongsToMany(Field::class)->withPivot('value');
        }

    }
    public function allPackages()
    {
        return $this->belongsToMany(Package::class)->withPivot(['start_date', 'end_date']);
    }

    public function featureUsage($featureId, $packageId)
    {
        return $this->belongsToMany(Feature::class, 'user_package_usage')->wherePivot('feature_id', $featureId)->wherePivot('package_id', $packageId)->withPivot(['id', 'feature_id', 'package_id', 'feature_usage']);
    }

    public function categories($type_id = null)
    {
        if (!$type_id) {
            return $this->belongsToMany(Category::class);
        }

        return $this->belongsToMany(Category::class)->where('category_type_id', $type_id);
    }
    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }
    public function uploads()
    {
        return $this->hasMany(Upload::class);
    }
    public function notifications()
    {
        return $this->belongsToMany(Notification::class)->withPivot('id', 'seen', 'data', 'created_at')->orderBy('pivot_created_at', 'desc')->withTimestamps();
    }
    // public function followUps()
    // {

    //     //   return  $this->belongsToMany(FollowUps::class,'follow-ups','follower_id','following_id') ;
    // }
    public function uploadsType($type = null)
    {
        if (!$type) {
            return $this->hasMany(Upload::class);
        }

        return $this->hasMany(Upload::class)->where('type', $type);
    }

    public function followUps()
    {

        //   return  $this->belongsToMany(FollowUps::class,'follow-ups','follower_id','following_id') ;
    }
}
