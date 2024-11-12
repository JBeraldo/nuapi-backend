<?php

namespace App\Services;

use App\Models\File;
use App\Traits\Crudable;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class FileService
{
    use Crudable;

    public function store(array $data)
    {
        $studentId = $data['student_id'];
        $userId = $data['user_id'];
        $file = $data['pdf'];

        if (!$file instanceof UploadedFile) {
            throw new \Exception('O arquivo enviado não é válido.');
        }

        $fileContent = file_get_contents($file->getRealPath());

        $fileName = $file->getClientOriginalName();
        if (empty($fileName)) {
            throw new \Exception('O nome do arquivo está vazio.');
        }

        $fileRecord = File::create([
            'file_name' => $fileName,
            'file_content' => $fileContent,
            'user_id' => $userId,
            'student_id' => $studentId,
        ]);

        return $fileRecord;
    }

}
