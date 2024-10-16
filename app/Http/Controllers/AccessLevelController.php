<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\GrantRoleRequest;
use App\Services\AccessLevelService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AccessLevelController extends Controller
{
    public function __construct(private AccessLevelService $service)
    {

    }

    public function storeRole(CreateRoleRequest $request): Response {
        $this->service->storeRole($request->get('name'));
        return response(null,201);
    }

    public function storePermission(CreatePermissionRequest $request): Response {
        $this->service->storePermission($request->get('name'), $request->get('role'));
        return response(null,201);
    }

    public function grateRoleToUser(GrantRoleRequest $request): JsonResponse{
        $this->service->grantRole($request->get('role'), $request->get('user_id'));
        return response()->json([
            'error' => false,
            'message' => 'Cargo concedido com sucesso!',
        ]);
    }



}
