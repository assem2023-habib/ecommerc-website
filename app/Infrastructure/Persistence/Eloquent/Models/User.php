<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasApiTokens;
    use HasRoles;
    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_name',
        'birthday',
        'gender',
        'phone',
        'city_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'birthday' => 'date',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function images()
    {
        return  $this->morphMany(Image::class, 'imageable');
    }
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->hasRole('admin');
    }
}
