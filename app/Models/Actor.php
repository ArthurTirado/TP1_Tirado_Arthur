<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'last_name',
        'first_name',
        'birthdate',
    ];
    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Film::class);

    }
}
