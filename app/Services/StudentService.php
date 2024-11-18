<?php

namespace App\Services;

use App\Models\Student;
use App\Traits\Crudable;
use Illuminate\Support\Facades\DB;

class StudentService
{
    use Crudable;

    public function __construct(private Student $model)
    {

    }

    public function update(array $data, $id)
    {
        try {
            DB::beginTransaction();

            $model = $this->model->findOrFail($id);

            $model->update($data);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $model;
    }

}
