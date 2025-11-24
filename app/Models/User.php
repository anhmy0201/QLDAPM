<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;
    protected $table = 'users';
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
    'name',
    'email',
    'password',
    ];
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
    public function News(): HasMany // mỗi người dùng có thể đăng nhiều bản tin
    {return $this->hasMany(News::class, 'user_id', 'id');
    }
    public function Comments(): HasMany 
    {return $this->HasMany(Comment::class, 'user_id', 'id');
    }
    public function savedNews()
{
    return $this->belongsToMany(News::class, 'saved_news');
}

}
