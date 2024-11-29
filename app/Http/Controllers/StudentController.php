<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentCollection;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{

    public function __construct(private readonly StudentService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $models = $this->service->get();

        return response()->json(new StudentCollection($models), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $this->service->store($request->toArray());
        return response()->json([
            "error" => false,
            "message" => "Aluno criado com sucesso"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $model = $this->service->find($id);
        return response()->json([
            "error" => false,
            "student" => new StudentResource($model),
            "message" => "Aluno encontrado"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateStudentRequest $request): JsonResponse
    {
        $model = $this->service->update($request->toArray(), $id);
        return response()->json([
            "error" => false,
            "student" => $model,
            "message" => "Aluno atualizado com sucesso!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);
        return response()->json([
            "error" => false,
            "message" => "Aluno deletado com sucesso!"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function uploadPEI(Request $request): JsonResponse
    {
        $file = $request->file('file_content');

        if (!$file instanceof UploadedFile) {
            throw new \InvalidArgumentException('O arquivo enviado não é válido.');
        }

        // Verificar se o arquivo é um PDF
        if ($file->getClientMimeType() !== 'application/pdf') {
            throw new \InvalidArgumentException('O arquivo deve ser um PDF.');
        }

        // Armazenar o arquivo em disco, usando o Storage do Laravel
        $this->service->uploadPEI($request->toArray());

        return response()->json([
            "error" => false,
            "message" => "Arquivo criado com sucesso"
        ]);
    }
}
