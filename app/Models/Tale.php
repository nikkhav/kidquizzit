<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tale extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'image', 'title', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
