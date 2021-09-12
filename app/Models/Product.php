<?php

namespace App\Models;

use App\Traits\DeactiveAndPromote;
use App\Traits\ProdLocalization;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use tidy;

class Product extends Model
{
    use HasFactory, ProdLocalization, DeactiveAndPromote;


    protected $fillable = [
        'name',
        'description',
        'img',
        'price',
        'pices_no',
        'is_active',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot(['quantity', 'amount'])->withTimestamps();
    }
}