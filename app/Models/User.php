<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
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
     * The email that should be valid to access panel
     */

    public function canAccessPanel(Panel $panel) : bool {
        $email = $this->email;
        $domain = substr($email, strpos($email, '@') + 1);
        $validDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'live.com'];
        return in_array($domain, $validDomains);
    }

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
