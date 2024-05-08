<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class University extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'email',
        'phone_number',
        'web_site',
        'google_maps_location'
    ];

    public function informationSections(): HasMany
    {
        return $this->hasMany(InformationSection::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
    
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
