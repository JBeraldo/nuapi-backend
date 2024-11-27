<?php

namespace App\Services;

use App\Models\Notification;
use App\Traits\Crudable;

class NotificationService
{
    use Crudable;

    public function __construct(private readonly Notification $model)
    {

    }

    public function get($read)
    {
       return match ($read) {
            'read' => $this->model->where('read_at',null)->get(),
            'unread' =>  $this->model->where('read_at','!=',null)->get(),
            default => $this->model->get()
        };
    }
}
