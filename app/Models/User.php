<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // public static $default_image_path = 'https://th.bing.com/th/id/R.6c9a6bf63a5c948917413fa19246f529?rik=pgOANRSRi3hdug&pid=ImgRaw&r=0';
    public static $default_image_path = 'images/default-profile-image.jpg';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'email',
        'password',
        'last_name',
        'sex',
        'birth_date',
        'image_path'
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

    function calcAge(): int
    {
        return date_diff(date_create(), date_create($this->birth_date))->y;
    }

    function calcSex(): string
    {
        $age = $this->calcAge();
        if ($this->sex == 'M') {
            if ($age > 18) {
                return 'Homme';
            } else {
                return 'Garçon';
            }
        } else {
            if ($age > 18) {
                return 'Femme';
            } else {
                return 'Fille';
            }
        }
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
