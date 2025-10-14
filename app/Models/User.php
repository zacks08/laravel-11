<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use App\Models\Comment;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable , SoftDeletes;

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

protected static function booted()
{
    static::deleting(function ($user) {
        $user->posts()->delete();     // deleta posts do usuário
        $user->comments()->delete();  // deleta comentários do usuário
    });
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

    public function isAdm():bool
    
{
  return in_array($this->email,config ('custom.admins'));

    }
    public function posts() {
        return $this->hasMany(Post::class);
        //esse usuário é dono de vários posts
    }

    public function comments() {
        return $this->has_Many(Comment::class);
        //busca os comentários da tabela comments
        //os que possuem a coluna user_id === id user
    }
}
