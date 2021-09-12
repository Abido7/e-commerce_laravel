<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

trait InCart
{

    public function inCart(Model $model)
    {
        // $cart = session()->get('cart');
        // // dd();
        // return in_array($cart[$model->id], $cart);
    }
}