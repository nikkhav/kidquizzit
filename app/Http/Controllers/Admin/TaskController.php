<?php

namespace App\Http\Controllers\Admin;

use App\Events\NewNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStore;
use App\Http\Requests\TaskUpdate;
use App\Models\Checklist;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Department;
use App\Models\File;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Services\TaskServices;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use App\Helpers\Helpers;
use App\Models\Actions;
use App\Models\Priority;

use function GuzzleHttp\Promise\task;

class TaskController extends Controller
{
    public $taskActivity;
    protected $notification;
    public function __construct()
    {
        $this->taskActivity = new TaskServices();
        $this->notification = new NotificationService();
        $firstDepartment = Department::first()->id ?? 0;
        $users = User::all();
        $statuses = Status::all();
        $prioritetes = Priority::all();
        $departments = Department::select(['id', 'name'])->get();
        $customers = Customer::all();
        $customers = Customer::all();

        view()->share('departments', $departments);
        view()->share('users', $users);
        view()->share('statuses', $statuses);
        view()->share('prioritetes', $prioritetes);
        view()->share('customers', $customers);
        view()->share('customers', $customers);
    }
    public function index(Request $request)
    {
        $all = Helpers::task_count_by_status();

        $davam = Helpers::task_count_by_status(2);

        $gozle = Helpers::task_count_by_status(3);

        $tamam = Helpers::task_count_by_status(4);

        return view('admin.pages.task.list', compact(['all',  'davam', 'gozle', 'tamam']));
    }

    public function store(TaskStore $request)
    {

        $data = $request->toArray();

        $data['status_id'] = 1;
        $data['user_id'] = Auth::user()->id;

        $task = new Task($data);
        $task->save();

        $param['action_id'] = 1;


        $this->taskActivity->addActvity($task->id, $param);
        $task->users()->attach($request->user_id);

        $users = User::whereIn('id', $request->user_id)->get();
        foreach ($users as $user) {
            $this->taskActivity->addActvity($task->id, [
                'data_id' => $user->id,
                'data_type' => get_class($user),
                'action_id' => 4
            ]);
        }




        $data  = [];
        if ($request->file) {
            $files = [];
            for ($i = 0; $i < count($request->file('file')); $i++) {

                $dPath = 'file/';
                $img   = $request->file('file')[$i];
                $fName = $img->getClientOriginalName();
                $exten = $img->getClientOriginalExtension();;
                $request->file('file')[$i]->storeAs($dPath, $fName);
                $path  =  $dPath . '' . rand(1000, 9999) . '-' . $fName;
                Storage::disk('public')->put($path, file_get_contents($request->file('file')[$i]));

                $data['path'] = $path;
                $data['name'] =  $fName;
                $data['type'] =  $exten;
                $data['task_id'] = $task->id;

                $file = File::create($data);

                $files[$i] = [
                    'name' => $fName,
                    'path' => $path,
                ];
                $this->taskActivity->addActvity($task->id, [
                    'action_id' => 2,
                    'data_id' => $file->id,
                    'data_type' => get_class($file)
                ]);
            }
        }


        return  response()->json([
            'code' => 200,
            'data' => $request->all()
        ]);
    }

    public function edit($id)
    {
        $permission = $this->UserPermission($id);
        if ($permission) {
            return response()->json([
                'code' => 410,
                'message' => $permission
            ]);
        }
        $data = Task::with('user')->find($id);

        return  response()->json([
            'code' => 200,
            'data' => $data,
        ]);
    }

    public function update(TaskUpdate $request, $id)
    {
        $this->priority($request);
        $this->title($request);
        $this->description($request);
        $this->start($request);
        $this->deadline($request);
        $this->customer($request);
        $this->department($request);
        $this->user($request);

        try {
            Task::where('id', $id)->update(Arr::except($request->validated(), 'users_id'));

            $task = Task::find($id);
            $task->users()->sync($request->users_id);

            $data = [];

            if ($request->file) {
                $files = [];
                for ($i = 0; $i < count($request->file); $i++) {

                    $dPath = 'file/';
                    $img   = $request->file('file')[$i];
                    $fName = $img->getClientOriginalName();
                    $exten = $img->getClientOriginalExtension();;
                    $request->file('file')[$i]->storeAs($dPath, $fName);
                    $path  = $dPath . '' . rand(1000, 9999) . '-' . $fName;
                    Storage::disk('public')->put($path, file_get_contents($request->file('file')[$i]));

                    $data['path'] = $path;
                    $data['name'] =  $fName;
                    $data['type'] =  $exten;
                    $data['task_id'] = $task->id;

                    File::create($data);

                    $files[$i] = [
                        'name' => $fName,
                        'path' => $path,
                    ];
                }

                $param['other_data'] = $files;
                $param['action'] = 'Yeni qoşma ';
                $param['message'] = 'Tapsiriqa deyikilik etdi';
            }

            return response()->json([
                'code' => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function details(Request $request)
    {
        $item = Task::with(['users.position', 'user', 'status', 'priority', 'files', 'commnets', 'activities.user', 'checklist', 'customer', 'activities.data'])->with(['activities' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->where('id', $request->id)->first();
        $users = User::all();

        $view = view('admin.pages.task.inc.render', compact('item', 'users'))->render();
        return response()->json([
            'code' => 200,
            'data' =>  $view,
            'item' => $item
        ]);
    }


    public function detail_page($id)
    {
        $item = Task::with(['users.position', 'user', 'status', 'priority', 'files', 'commnets', 'activities.user', 'checklist', 'customer'])->with(['activities' => function ($query) {
            $query->orderBy('id', 'desc');
        }])->where('id', $id)->first();


        $users = User::all();

        return view('admin.pages.task.detail', compact('item', 'users'));
    }

    public function comment(Request $request)
    {
        $this->UserPermission($request->id);
        $data = [
            'user_id' => auth()->user()->id,
            'task_id' => $request->id,
            'content' => $request->content
        ];
        $last =  Comment::create($data);

        $this->taskActivity->addActvity($request->id, [
            'action_id' => 8,
            'data_id' => $last->id,
            'data_type' => get_class($last)
        ]);

        $comment = Comment::where('id', $last->id)->with('user')->first();


        $view = view('admin.pages.task.inc.comment_render', compact('comment'))->render();

        return response()->json([
            'code' =>   200,
            'view' => $view
        ]);
    }

    public function destroy($id)
    {
        $permission = $this->UserPermission($id);
        if ($permission) {
            return response()->json([
                'code' => 410,
                'message' => $permission
            ]);
        }
        Task::where('id', $id)->delete();
        return response()->json([
            'code' => 200,
        ]);
    }

    public function file_delete(Request $request)
    {
        $permission = $this->UserPermission($request->task);
        if ($permission) {
            return response()->json([
                'code' => 410,
                'message' => $permission
            ]);
        }
        $file = File::where('id', $request->id)->first();

        $this->taskActivity->addActvity($request->task, [
            'action_id' => 3,
            'data_id' => $file->id,
            'data_type' => get_class($file)
        ]);
        $file->delete();
        return response()->json([
            'code' => 200,
        ]);
    }

    public function atendent_delete(Request $request)
    {
        $permission = $this->UserPermission($request->task);
        if ($permission) {
            return response()->json([
                'code' => 410,
                'message' => $permission
            ]);
        }
        $task = Task::where('id', $request->task)->first();
        $task->users()->sync($request->id);
        $user = User::find($request->id);
        $this->taskActivity->addActvity($request->task, [
            'action_id' => 5,
            'data_id' => $user->id,
            'data_type' => get_class($user)
        ]);

        return response()->json([
            'code' => 200,
        ]);
    }

    public function comment_delete(Request $request)
    {
        $comment = Comment::where('id', $request->id)->first();
        if ($comment->user_id != auth()->user()->id) {
            return response()->json([
                'code' => 410,
                'message' => "Bu şərhi silə bilməzsiniz."
            ]);
        }
        $comment->destroy();
        return response()->json([
            'code' => 200,

        ]);
    }

    public function file_upload()
    {
        return  response()->json([
            'code' => 200,
            'data' => 'test'
        ]);
    }

    public function asssine_user(Request $request)
    {
        $permission = $this->UserPermission($request->task_id);
        if ($permission) {
            return response()->json([
                'code' => 410,
                'message' => $permission
            ]);
        }
        $auth = Auth::user()->id;
        $task = Task::find($request->task);
        $task->users()->attach($request->user);

        $task = $request->task;

        $item = Task::whereHas('users', function ($query) use ($task) {
            return  $query->where('user_assign_tasks.task_id', $task);
        })->with('users')->first();


        $view = view('admin.pages.task.inc.task_users_render', compact('item'))->render();

        return response()->json([
            'code' => 200,
            'view' => $view
        ]);
    }

    public function filess_upload(Request $request)
    {
        if ($request->file) {


            for ($i = 0; $i < count($request->file); $i++) {
                $dPath = 'file/';
                $img   = $request->file('file')[$i];
                $fName = $img->getClientOriginalName();
                $exten = $img->getClientOriginalExtension();;
                $request->file('file')[$i]->storeAs($dPath, $fName);
                $path  =  $dPath . '' . rand(1000, 9999) . '-' . $fName;
                Storage::disk('public')->put($path, file_get_contents($request->file('file')[$i]));

                $data['path'] = $path;
                $data['name'] =  $fName;
                $data['type'] =  $exten;
                $data['task_id'] = $request->task;

                $files[$i] = [
                    'name' => $fName,
                    'path' => $path,
                ];
                File::create($data);
            }
            $param['other_data'] = $files;
            $this->taskActivity->addActvity($request->task, $param);

            $files = File::where('task_id', $request->task)->get();
            $item = $request->task;
            $render = view('admin.pages.task.inc.files_render', compact('files', 'item'))->render();
            return response()->json([
                'code' => 200,
                'view' => $render
            ]);
        }
    }

    public function status(Request $request)
    {

        Task::where('id', $request->task)->update([
            'status_id' => $request->status_id
        ]);
        $status = Status::find($request->status_id);
        $this->taskActivity->addActvity($request->task, [
            'action_id' => 6,
            'data_id' => $status->id,
            'data_type' => get_class($status)
        ]);
        return response()->json([
            'code' => 200,
            'data' => $request->all()
        ]);
    }

    public function priority(Request $request)
    {

        $task = Task::where('id', $request->task)->first();
        if ($task->priority_id != $request->priority_id) {

            $priority = Priority::find($request->priority_id);
            $this->taskActivity->addActvity($request->task, [
                'action_id' => 7,
                'data_id' => $priority->id,
                'data_type' => get_class($priority)
            ]);
        }
    }
    public function title(Request $request)
    {

        $task = Task::where('id', $request->task)->first();
        if ($task->title != $request->title) {
            $this->taskActivity->addActvity($request->task, [
                'action_id' => 11
            ]);
        }
    }

    public function customer(Request $request)
    {

        $task = Task::where('id', $request->task)->first();
        if ($task->customer_id != $request->cusromer_id) {

            $customer = Customer::find($request->customer_id);
            $this->taskActivity->addActvity($request->task, [
                'action_id' => 9,
                'data_id' => $customer->id,
                'data_type' => get_class($customer)
            ]);
        }
    }

    public function description(Request $request)
    {

        $task = Task::where('id', $request->task)->first();
        if ($task->description != $request->description) {
            $this->taskActivity->addActvity($request->task, [
                'action_id' => 12
            ]);
        }
    }

    public function department(Request $request)
    {

        $task = Task::where('id', $request->task)->first();
        if ($task->department_id != $request->department_id) {

            $department = Department::find($request->department_id);
            $this->taskActivity->addActvity($request->task, [
                'action_id' => 10,
                'data_id' => $department->id,
                'data_type' => get_class($department)
            ]);
        }
    }

    public function user(Request $request)
    {
        $users = User::whereIn('id', $request->users_id)->whereHas('task', function ($query) use ($request) {
            $query->where('user_assign_tasks.task_id', $request->id);
        })->Pluck('id')->toArray();
        foreach ($request->users_id as $user) {
            if (!in_array($user, $users)) {

                $item = User::find($user);
                $this->taskActivity->addActvity($request->task, [
                    'data_id' => $item->id,
                    'data_type' => get_class($item),
                    'action_id' => 4
                ]);
            } elseif (in_array($user, $users)) {
                $item = User::find($user);
                $this->taskActivity->addActvity($request->task, [
                    'data_id' => $item->id,
                    'data_type' => get_class($item),
                    'action_id' => 5
                ]);
            }
        }
    }

    public function start(Request $request)
    {

        $task = Task::where('id', $request->task)->first();
        if ($task->start != $request->start) {
            $this->taskActivity->addActvity($request->task, [
                'action_id' => 13
            ]);
        }
    }
    public function deadline(Request $request)
    {
        $task = Task::where('id', $request->task)->first();
        if ($task->deadline != $request->deadline) {
            $this->taskActivity->addActvity($request->task, [
                'action_id' => 14
            ]);
        }
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

    public function selectedDepartmentCustomers(Request $request)
    {
        $viewUser = $departmentId = request()->post('department_id');

        $users = User::where('department_id', $departmentId)->get();

        return response()->json([
            'code' => 200,
            'data' => $users
        ]);
    }
}
