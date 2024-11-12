<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;

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

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'subject_students', 'subject_id', 'student_id');
    }
}
