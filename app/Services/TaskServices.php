<?php

namespace App\Services;

use App\Models\Task;
use App\Models\TaskActivity;
use Illuminate\Support\Facades\Auth;

class TaskServices
{
    public function addActvity($taskId, $param)
    {
        $active               =  new TaskActivity();
        $user               =  Auth()->user() ?? collect([]);
        $active->user_id      =  $user->id;
        $active->task_id      =  $taskId;
        $active->action_id       =  $param['action_id'];
        $active->data_id   = $param['data_id'] ?? null;
        $active->data_type   = $param['data_type'] ?? null;
        $active->save();
        return $active;
    }
}
