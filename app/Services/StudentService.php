<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Student;
use App\Traits\Crudable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentService
{
    use Crudable;

    public function __construct(
        private readonly Student $model,
        private readonly FileService $fileService,
        private readonly NotificationService $notificationService
    )
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

    /**
     * @throws \Exception
     */
    public function uploadPEI($data): void
    {
        try {
            DB::beginTransaction();

            $model = $this->model->with('subjects')->find($data['student_id']);
            $notifications = [];
            foreach ($model->subjects as $subject) {
                $notifications[] = [
                    "title" => "Novo envio de PEI para o aluno {$model->name}",
                    "comment" => "Comentário",
                    "user_id" => $subject->teacher_id,
                    "read_at" => null,
                    "created_at" =>  Carbon::now(),
                    "updated_at" =>  Carbon::now()
                ];

            }
            $this->notificationService->notifyAll($notifications);

            $this->fileService->store($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

}
