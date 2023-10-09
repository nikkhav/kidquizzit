<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Checklist extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['user_id','task_id','content','done'];

    protected $append = ['prograce'];

    public function toggleIsDone(){
        $this->done = !$this->done;
        return $this;
    }

    public function getPrograceAttribute()
    {
        $total = $this->where('task_id',$this->task_id)->whereIn('done',[1,0])->count() ?? 0;
        $done =  $this->where('task_id',$this->task_id)->where('done',1)->count() ?? 0;
        return round( $done / $total * 100) ?? 0;
    }
}
