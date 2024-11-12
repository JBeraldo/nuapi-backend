<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\UserResource;
use App\Http\Resources\FileCollection;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Symfony\Component\HttpFoundation\Response;

class FileController extends Controller
{

    public function __construct(private readonly FileService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {

        $models = $this->service->get();

        return response()->json(new FileCollection($models), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $this->service->store($request->toArray());
        return response()->json([
            "error" => false,
            "message" => "File criado com sucesso"
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
            "file" => new UserResource($model),
            "message" => "File encontrado"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, UpdateFileRequest $request): JsonResponse
    {
        $this->service->update($request->toArray(), $id);
        return response()->json([
            "error" => false,
            "message" => "File atualizado com sucesso!"
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
            "message" => "File deletado com sucesso!"
        ]);
    }
}
