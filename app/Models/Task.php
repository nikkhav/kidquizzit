<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\DeadlineTrait;

class Task extends Model
{
    use HasFactory, SoftDeletes, DeadlineTrait;
    protected $fillable = ['title', 'project', 'description', 'department_id', 'deadline', 'start', 'priority_id', 'status_id', 'user_id', 'customer_id'];

    protected $appends = ['user_ids', 'son'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_assign_tasks',   'task_id', 'user_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStartDateAttribute()
    {
        return $this->start;
    }


    public function checklist()
    {
        return $this->hasMany(Checklist::class);
    }

    public function getPrograceAttribute()
    {
        return $this->checklist()->count();
    }


    public function getSonAttribute()
    {
        return  $this->isCloseToDeadline() ? '<pan style="color:red">Bitib</pan>' : date('d/m/Y H:m', strtotime($this->deadline));
    }
    // public function getStartAttribute($key)
    // {
    //     return date('d/m/Y H:m', strtotime($key));
    // }

    public function getUserIdsAttribute($key)
    {
        return array_column($this->users->toArray(), 'id');
    }
    public function getTitleAttribute($key)
    {
        if (is_null($key) || empty($key)) {
            return  "<span class='show-deatil text-primary'  title='Bax' data-id='" . $this->id . "' > <i class='fas fa-eye'></i></span>";
        }
        return  "<span class='show-deatil text-primary ' title='Nəzərdən keçir' data-id='" . $this->id . "'>" . $key . "</span>";
    }


    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function commnets(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(TaskActivity::class);
    }

    /**
     * Get the user that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
