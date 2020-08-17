<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }


    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follow_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follow_id', 'user_id');
    }


    public function follow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact($user_ids);
        }

        $this->followings()->sync($user_ids, false);
    }


    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact($user_ids);
        }

        $this->followings()->detach($user_ids);
    }


    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }


    public function statuses()
    {
        return $this->hasMany(Status::class);
    }


    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->activation_token = Str::random(30);
        });
    }

    public function feed()
    {
        return $this->statuses()
            ->orderBy('created_at', 'desc');
    }

}
