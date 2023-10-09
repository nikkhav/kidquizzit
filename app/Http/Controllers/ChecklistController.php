<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checklist;
use App\Services\TaskServices;
use Illuminate\Support\Facades\Auth;

use App\Models\Task;




class ChecklistController extends Controller
{
    public $taskActivity;

    public function __construct()
    {
        $this->taskActivity = new TaskServices();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = $this->UserPermission($request->task_id);
        if ($permission) {
            return response()->json([
                'code' => 410,
                'message' => $permission
            ]);
        }

        $checklist  = Checklist::create([
            'user_id' => Auth::user()->id,
            'task_id' => $request->task_id,
            'content' => $request->content
        ]);

        $view = $this->render_checklis($request->task_id);
        $this->taskActivity->addActvity($request->task_id, [
            'action_id' => 16
        ]);

        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }
    public function UserPermission($id)
    {

        if (!auth()->user()->can('Super Admin')) {

            $taskperm = Task::where('id', $id)->where('user_id', Auth::user()->id)->first();
            if (!$taskperm) {
                return  'Sizin bu emelliyati elemeye icazeviz yoxdur';
            }
        }
    }
    public function render_checklis($id)
    {
        $item = Task::where('id', $id)->first();
        return  view('admin.pages.task.inc.render_checklist', compact('item'))->render();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $permission = $this->UserPermission($request->task_id);
        if ($permission) {
            return response()->json([
                'code' => 410,
                'message' => $permission
            ]);
        }
        Checklist::where('id', $request->id)->update([
            'content' => $request->content
        ]);
        $view = $this->render_checklis($request->task_id);

        $this->taskActivity->addActvity($request->task_id, [
            'action_id' => 15
        ]);

        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }
    public function checklist_status(Request $request)
    {
        $checklist_element = Checklist::where('id', $request->checbox)->first();
        $checklist_element->toggleIsDone()->save();
        $this->taskActivity->addActvity($request->task, [
            'action_id' => 18
        ]);

        return response()->json([
            'code' => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $permission = $this->UserPermission($request->task_id);
        if ($permission) {
            return response()->json([
                'code' => 410,
                'message' => $permission
            ]);
        }
        Checklist::where('id', $request->id)->delete();

        $view = $this->render_checklis($request->task_id);
        $this->taskActivity->addActvity($request->task_id, [
            'action_id' => 17
        ]);

        return response()->json([
            'code' => 200,
            'view' => $view,
            'data' => $request->all()
        ]);
    }
}
