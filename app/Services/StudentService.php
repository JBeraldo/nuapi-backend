<?php

namespace App\Services;

use App\Models\Student;
use App\Traits\Crudable;

class StudentService
{
    use Crudable;

    public function __construct(private Student $model)
    {

    }

    

}
