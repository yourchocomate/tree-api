<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the profile of the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function profile() : HasOne
    {
       return $this->hasOne(Profile::class);
    }

    /**
     * Get the portfolios for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function portfolios() : HasMany
    {
        return $this->hasMany(Portfolio::class);
    }

    /**
     * Get the socials for the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function socials() : HasMany
    {
        return $this->hasMany(Social::class);
    }

    /**
     * Get the skills for the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function skills() : HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
