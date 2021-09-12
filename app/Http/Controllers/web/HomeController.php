<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('price', 'DESC')->limit(3)->get();
        $features = Product::orderBy('price', 'DESC')->limit(6)->get();
        return view('web.home.index', compact('products', 'features'));
    }
}