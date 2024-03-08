<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Critic extends Model
{
    use HasFactory;
    protected $fillable = [
        'login',
        'password',
        'email',
        'last_name',
        'first_name',
    ];
    public function critics()
    {
        return $this->belongsTo('App\Models\Film');
        return $this->belongsTo('App\Models\User');
    }
}
