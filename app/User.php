<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, File;

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';
    const SUPER_ADMIN = 1;

    protected $imageField = 'users';

    protected $fillable = [
        'fullname', 'email', 'birthday', 'city', 'password', 'position', 'type', 'super_admin', 'score_exe', 'score_test'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function identities() {
        return $this->hasMany('App\SocialIdentity');
    }

    public function videoCommits()
    {
        return $this->hasMany(VideoCommits::class, 'user_id');
    }

    public function isAdmin()    {
        return $this->type === self::ADMIN_TYPE;
    }

    public function isSuperAdmin()    {
        return $this->super_admin === self::SUPER_ADMIN;
    }

    public function scopeOrder($query)
    {
        return $query->where('type', 'admin')->priority();
    }

    public function scopePriority($query)
    {
        return $query->orderBy('priority', 'desc');
    }
}
