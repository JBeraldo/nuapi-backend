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

        $fileContent = base64_encode(file_get_contents($file->getRealPath()));

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

    public function download($id)
    {
        $file = File::find($id);

        if (!$file) {
            abort(404, 'Arquivo não encontrado');
        }

        $fileName = $file->file_name;

        $fileContent = base64_decode((string)$file->file_content);

        if ($fileContent === false) {
            abort(500, 'Erro ao decodificar o arquivo');
        }

        return response()->stream(function() use ($fileContent) {
            echo $fileContent;
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Content-Length' => strlen((string)$fileContent),
        ]);
    }

}
