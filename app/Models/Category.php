<?php

namespace App\Models;

use App\Traits\CatLocalization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, CatLocalization;

    protected $fillable = [
        'name',
        'is_active',
    ];

    public function products()
    {
        return $this->hasMany(Product::class)->where('is_active', 1);
    }
}