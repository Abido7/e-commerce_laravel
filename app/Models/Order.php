<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use tidy;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->where('is_active', 1);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity', 'amount'])->withTimestamps();
    }
}