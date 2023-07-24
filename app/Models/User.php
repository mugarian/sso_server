<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\News;
use App\Traits\Uuids;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

    public function temaportal()
    {
        return $this->hasMany(TemaPortal::class);
    }

    public function temadashboard()
    {
        return $this->hasMany(TemaDashboard::class);
    }

    public function agenda()
    {
        return $this->hasMany(Agenda::class);
    }

    public function celebrate()
    {
        return $this->hasMany(Celebrate::class);
    }
}
