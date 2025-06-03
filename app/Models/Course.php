<?php

namespace App\Models;

use App\Casts\AsTimeHiCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    protected $fillable = [
        'name',
        'description',
        'start_time',
        'end_time',
        'instructor_id',
    ];

    protected $casts = [
        'start_time' => AsTimeHiCast::class,
        'end_time' => AsTimeHiCast::class,
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }
}
