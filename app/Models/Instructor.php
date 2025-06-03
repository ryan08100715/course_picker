<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instructor extends Model
{
    protected $fillable = [
        'account',
        'password',
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }
}
