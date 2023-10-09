<?php

namespace App\Datatable;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class TaskDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Task::class, [
            // 'id' => 'ID',
            'title' => 'Başlıq',
            'start' => 'Start (gün/ay/il)',
            'son' => 'Möhlət (gün/ay/il)',
            'user.fullname' => 'Təhkimçi'
        ], [
            'users' => [
                'title' => 'Təhkimli(lər)',
                'view' => 'admin.pages.task.partials.users'
            ],

            'status' => [
                'title' => 'Status',
                'view' => 'admin.pages.task.partials.status'
            ],
            'priority' => [
                'title' => 'Prioritet',
                'view' => 'admin.pages.task.partials.priority'
            ],

        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope();
        $query->with('users');

        $query->where('status_id', 1);
        $query->orderByDesc('created_at');

        if (request()->has('status')) {
            $status = request()->get('status');
            $query->where('status_id', $status);
        }

        if (request()->has('priority')) {
            $priority = request()->get('priority');
            $query->where('priority_id', $priority);
        }
        // if(request()->has('dedline')){
        //     $query->whereDate('deadline' ,'<=',  date('d-m-Y'));
        // }

        if (Auth::user()->type == 'worker') {
            $query->where(function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->where('user_assign_tasks.user_id', '=', auth()->user()->id);
                })
                    ->orWhere('user_id', '=', auth()->user()->id);
            });
        }


        if ($this->getSearchInput()) {
            $query->orWhere('title', 'LIKE', '%' . $this->getSearchInput() . '%');
            $query->orWhereHas('users', function ($query) {
                $query->where('name', 'LIKE', '%' . $this->getSearchInput() . '%');
            });
        }

        return $query;
    }
}
