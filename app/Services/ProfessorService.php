<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Crudable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfessorService
{
    use Crudable;
    public function __construct(private User $model)
    {

    }


    public function get(): Collection
    {
        return $this->model->with(['roles'])->whereHas('roles', fn($q) => $q->where('name','Professor'))->get();
    }

    public function store(Array $data): User
    {
        try {
            DB::beginTransaction();

            $data['password'] = Hash::make(env('DEFAULT_PROFESSOR_PASSWORD','senha123'));

            $data['specialization'] = strtolower($data['specialization']);

            $model = $this->model->create($data);

            $model->assignRole('Professor');

            DB::commit();
        }
        catch (\Throwable $e){
            DB::rollBack();
            Throw $e;
        }

        return $model;
    }

}
