<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';
    protected $fillable = ['category_id', 'title'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
}
