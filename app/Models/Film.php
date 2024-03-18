<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'release_year',
        'length',
        'description',
        'rating',
        'language_id',
        'special_features',
        'image',
    ];
    public function languages(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function critics(): HasMany
    {
        return $this->hasMany(Critic::class);
    }

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class);
    }
}
