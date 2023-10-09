<?php

namespace App\Models;

use App\Scopes\HasActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ['full_name', 'role', 'role_id'];

    protected $fillable = [
        'name', 'surname',
        'email', 'image',
        'password',
        'department_id',
        'position_id', 'user_id',
        'gender', 'address', 'birthday',
        'whatsapp', 'phone', 'info',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'type'
    ];


    public function getRoleAttribute()
    {
        return $this->getRoleNames();
    }
    public function getRoleIdAttribute()
    {
        return $this->roles->first()?->id;
    }
    public function getBirthdayAttribute($key)
    {
        return Carbon::parse($key)->format('m/d/Y');
    }



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRoleTitleAttribute()
    {
        return $this->roles->first()->name;
    }


    public function getFuLLNameAttribute()
    {
        return $this->name . ' ' . $this->surname;
    }


    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function task(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'user_assign_tasks',  'task_id', 'user_id');
    }


    public function getImageAttribute($key)
    {
        if (!isset($key)) {
            if ($this->gender) {
                $key = 'images/male.jpg';
            } else {
                $key = 'images/female.jpg';
            }
            return asset($key);
        }

        return asset(Storage::url($key));
    }
}
