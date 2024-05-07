<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InformationSection extends Model
{
    use HasFactory;

    protected $table = 'information_sections';

    protected $fillable = [
        'title',
        'image_path',
        'content',
        'university_id',
    ];

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }
}
