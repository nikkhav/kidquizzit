<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Difference extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'image', 'description', 'title'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
