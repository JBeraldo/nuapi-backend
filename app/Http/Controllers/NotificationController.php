<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    public function __construct(private readonly NotificationService $service)
    {

    }

    public function index(?string $read = 'read'){
        $models = $this->service->get($read);
        return response()->json(NotificationResource::collection($models), Response::HTTP_OK);
    }

    public function read(Request $request){

    }

    public function readAll(Request $request){

    }
}
