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
    $userId = auth('api')->user()->id;
    $file = $data['file_content'];

    if (!$file instanceof UploadedFile) {
        throw new \InvalidArgumentException('O arquivo enviado não é válido.');
    }

    // Verificar se o arquivo é um PDF
    if ($file->getClientMimeType() !== 'application/pdf') {
        throw new \InvalidArgumentException('O arquivo deve ser um PDF.');
    }

    // Armazenar o arquivo em disco, usando o Storage do Laravel
    $filePath = $file->storeAs('pdfs', uniqid() . '.' . $file->getClientOriginalExtension(), 'public');

    if (!$filePath) {
        throw new \Exception('Erro ao salvar o arquivo no servidor.');
    }

    $fileName = $file->getClientOriginalName();
    if (empty($fileName)) {
        throw new \Exception('O nome do arquivo está vazio.');
    }

    // Armazenar o caminho do arquivo no banco
    $fileRecord = File::create([
        'file_name' => $fileName,
        'file_path' => $filePath,  // Agora você armazena o caminho, não o conteúdo em base64
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

    $filePath = storage_path('app/public/' . $file->file_path);  // Caminho do arquivo no storage
    $fileName = $file->file_name;

    // Verificar se o arquivo realmente existe
    if (!file_exists($filePath)) {
        abort(500, 'Arquivo não encontrado no servidor');
    }

    // Gerar a resposta com os cabeçalhos apropriados para forçar o download
    return response()->download($filePath, $fileName, [
        'Content-Type' => 'application/pdf',
    ]);
}


    


}
