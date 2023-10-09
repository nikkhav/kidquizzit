<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KanbanController extends Controller
{
    public function index()
    {
        $statuses =  Status::with(['tasks.priority'])->withCount('tasks')->orderBy('id', 'desc')->get();

        return view('admin.pages.kanban.index',compact('statuses'));
    }

    public  function update(Request $request)
    {
        foreach($request->status as $status => $tasks){
            if($status != null){
                Task::whereIn('id',$tasks)->update(['status_id' => $status]);
            }
        }
         return response()->json([
            'code' => 200,
            'data' => $request->all()
         ]);
    }
}
