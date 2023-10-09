<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerType extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name'];

    /**
     * Get all of the comments for the CustomerType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
