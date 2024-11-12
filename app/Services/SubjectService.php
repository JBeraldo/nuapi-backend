<?php

namespace App\Services;

use App\Models\Subject;
use App\Traits\Crudable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SubjectService
{
    use Crudable;
    public function __construct(private Subject $model)
    {

    }

    public function get(): Collection
    {
        return $this->model->with(['students', 'teacher'])->where('is_active', true)->get();
    }

    public function store(array $data): Subject
    {
        try {
            DB::beginTransaction();

            $data['department'] = strtoupper($data['department']);

            $model = $this->model->create($data);

            if (isset($data['students']) && count($data['students']) > 0) {
                $ids = array_map(function ($student) {
                    return $student['id'];
                }, $data['students']);

                $model->students()->sync($ids);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $model;
    }

    public function update(array $data, $id): Subject
    {
        try {
            DB::beginTransaction();

            $model = $this->model->findOrFail($id);

            $data['department'] = strtoupper($data['department']);

            $model->update($data);

            if (isset($data['students']) && count($data['students']) > 0) {
                $ids = array_map(function ($student) {
                    return $student['id'];
                }, $data['students']);

                $model->students()->sync($ids);
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $model;
    }
}
