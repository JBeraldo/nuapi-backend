<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadNotificationsRequest;
use App\Http\Resources\NotificationResource;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function __construct(private readonly NotificationService $service)
    {

    }

    public function index(?string $read = 'mixed'): JsonResponse
    {
        $models = $this->service->get($read);
        return response()->json(NotificationResource::collection($models), Response::HTTP_OK);
    }

    public function read(ReadNotificationsRequest $request) : JsonResponse{
        $this->service->read($request->get('notifications'));
        return response()->json([
            "error" => false,
            "message" => "Notificaticações lidas com sucesso!."
        ]);
    }
}
