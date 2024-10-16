<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function getMe(): Response
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Não foi possível autenticar o usuário.',
            ], 401);
        }
        return response()->json([
            'error' => false,
            'user' => new UserResource($user),
            'message' => 'Usuário recuperado com sucesso.',
        ]);
    }
}
