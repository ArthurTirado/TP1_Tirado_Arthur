<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critic extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'film_id',
        'score',
        'comment',
    ];
    public function films()
    {
        return $this->belongsTo(Film::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
