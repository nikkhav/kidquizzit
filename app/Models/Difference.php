<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Difference extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'image1', 'image2', 'difference'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
