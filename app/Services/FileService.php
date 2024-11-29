<?php

namespace App\Services;

use App\Models\File;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class FileService
{

    public function __construct(private readonly File $model)
    {

    }

    /**
     * @throws Exception
     */
    public function store(array $data)
    {
        $studentId = $data['student_id'];
        $userId = auth('api')->user()->id;
        $file = $data['file_content'];

        try {
            Db::beginTransaction();
            $filePath = $file->storeAs('pdfs', uniqid() . '.' . $file->getClientOriginalExtension(), 'public');

            if (!$filePath) {
                throw new Exception('Erro ao salvar o arquivo no servidor.');
            }

            $fileName = $file->getClientOriginalName();

            if (empty($fileName)) {
                throw new Exception('O nome do arquivo está vazio.');
            }

            // Armazenar o caminho do arquivo no banco
            $this->model->create([
                'file_name' => $fileName,
                'file_path' => $filePath,  // Agora você armazena o caminho, não o conteúdo em base64
                'user_id' => $userId,
                'student_id' => $studentId,
            ]);

            Db::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }


    public function download($id)
    {
        $file = $this->model->find($id);

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
