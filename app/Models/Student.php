<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    
}
