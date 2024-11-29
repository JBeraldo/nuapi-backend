<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{

    protected $fillable = [
        'name',
        'ra',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_students', 'student_id', 'subject_id');
    }
}
