<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\UserResource;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
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
            "message" => "Student criado com sucesso"
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
            "student" => new UserResource($model),
            "message" => "Student encontrado"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateStudentRequest $request): JsonResponse
    {
        $this->service->update($request->toArray(), $id);
        return response()->json([
            "error" => false,
            "message" => "Student atualizado com sucesso!"
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
            "message" => "Student deletado com sucesso!"
        ]);
    }
}
