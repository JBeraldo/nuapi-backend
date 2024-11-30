<?php

namespace App\Services;

use App\Models\Notification;
use App\Traits\Crudable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationService
{
    use Crudable;

    public function __construct(private readonly Notification $model)
    {

    }

    public function get($read)
    {
        $user_id =  app('auth')->id();
       return match ($read) {
            'read' => $this->model->where('read_at','!=',null)->where('user_id',$user_id)->get(),
            'unread' =>  $this->model->where('read_at',null)->where('user_id',$user_id)->get(),
            default => $this->model->where('user_id',$user_id)->get()
        };
    }

    public function notifyAll($notifications): void
    {
        try {
            DB::beginTransaction();

            DB::table('notifications')->insert($notifications);

            DB::commit();
        }catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * @throws \Exception
     */
    public function read($notifications): void
    {
        try {
            DB::beginTransaction();

            $this->model->whereIn('id',$notifications)->update(['read_at'=>now()]);

            DB::commit();
        }
        catch (\Exception $e){
            DB::rollBack();
            throw $e;
        }
    }
}
