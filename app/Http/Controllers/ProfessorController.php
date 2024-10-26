<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfessorRequest;
use App\Http\Requests\UpdateProfessorRequest;
use App\Http\Resources\ProfessorCollection;
use App\Http\Resources\UserResource;
use App\Services\ProfessorService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProfessorController extends Controller
{

    public function __construct(private readonly ProfessorService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $models = $this->service->get();

        return response()->json(new ProfessorCollection($models), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfessorRequest $request): JsonResponse
    {
        $this->service->store($request->toArray());
        return response()->json([
            "error" => false,
            "message" => "Professor criado com sucesso"
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
            "professor" => new UserResource($model),
            "message" => "Professor encontrado"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateProfessorRequest $request): JsonResponse
    {
        $this->service->update($request->toArray(), $id);
        return response()->json([
            "error" => false,
            "message" => "Professor atualizado com sucesso!"
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
            "message" => "Professor deletado com sucesso!"
        ]);
    }
}
