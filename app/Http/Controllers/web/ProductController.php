<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Traits\InCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    use InCart;

    public function show(Product $product)
    {
        $inCart = $this->inCart($product);
        // session()->forget('cart');
        return view('web.products.show', compact('product', 'inCart'));
    }
}