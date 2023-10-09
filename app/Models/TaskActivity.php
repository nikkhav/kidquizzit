<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskActivity extends Model
{
    use HasFactory;

    protected $casts = [
        'other_data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function action()
    {
        return $this->belongsTo(Actions::class);
    }
    public function data()
    {
        return $this->morphTo();
    }
}
