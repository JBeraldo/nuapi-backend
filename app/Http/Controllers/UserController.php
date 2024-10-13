<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function getMe()
    {
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'message' => 'Não foi possível autenticar o usuário.',
            ], 401);
        }

        return [
            'error' => false,
            'user' => new UserResource($user),
            'message' => 'Usuário recuperado com sucesso.',
        ];
    }
}
