<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $fillable = [
        'login',
        'release_year',
        'length',
        'description',
        'rating',
        'language_id',
        'special_features',
        'image',
    ];
    public function languages(): BelongsToMany
    {
        return $this->belongsTo('App\Models\Language');
        return $this->hasMany('App\Models\Crtitc');
        return $this->belongsToMany(Actor::class);
    }
    
}
