<?php

namespace App\Models;

use App\Models\Bookmark;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function getRouteKeyName() {
        return 'username';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded = ['id'];

    public function stories() {
        return $this->hasMany(Story::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function bookmarks() {
        return $this->hasMany(Bookmark::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function pic() {
        return $this->hasOne(Pic::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
