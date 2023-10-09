<?php 
namespace App\Services;

use App\Models\Notification;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

Class NotificationService {

    public function add($receiver_id = null,  $id, string $action){
        Notification::create([
            'user_id'    => Auth()->user()->id,
            'receiver_id' => $receiver_id,
            'task_id'    => $id,
            'action'     => $action
        ]); 
    }

    public  function getAlert(){
      return  Notification::where('receiver_id',1)->whereNull('read_at')->with(['user','task'])->get();
    }

    
}