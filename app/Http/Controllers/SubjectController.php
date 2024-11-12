<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SubjectController extends Controller
{
    public function __construct(private readonly SubjectService $service)
    {
    }

    public function index(): JsonResponse
    {

        $models = $this->service->get();

        return response()->json(SubjectResource::collection($models), Response::HTTP_OK);
    }

    public function show(int $id): JsonResponse
    {
        $model = $this->service->find($id)->load('teacher', 'students');

        return response()->json([
            "error" => false,
            "subject" => new SubjectResource($model),
            "message" => "Disciplina encontrada",
        ]);
    }

    public function store(SubjectRequest $request): JsonResponse
    {
        $this->service->store($request->toArray());

        return response()->json([
            "error" => false,
            "message" => "Disciplina cadastrada com sucesso",
        ]);
    }

    public function update(int $id, SubjectRequest $request): JsonResponse
    {
        $this->service->update($request->toArray(), $id);

        return response()->json([
            "error" => false,
            "message" => "Disciplina atualizada com sucesso!",
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);

        return response()->json([
            "error" => false,
            "message" => "Disciplina deletada com sucesso!",
        ]);
    }
}
