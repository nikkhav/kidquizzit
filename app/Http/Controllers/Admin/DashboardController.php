<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public  function index()
    {
       // $this->canOrAbort('test');
       $data = DB::select("SELECT (SELECT COUNT(*) FROM tasks ) as task_count, (SELECT COUNT(*) FROM customers) as customer_count, (SELECT COUNT(*) FROM users ) as user_count , (SELECT COUNT(*) FROM departments ) as departemet_count");
       $counts = $data[0];
        return view('admin.index',compact('counts'));
    }


    public function getNotifications(){
        $notifications = (new NotificationService)->getAlert();
        $view =  view('admin.inc.render.notification',compact('notifications'))->render();

        return response()->json([
            'view' => $view
        ],200);
    }
}
