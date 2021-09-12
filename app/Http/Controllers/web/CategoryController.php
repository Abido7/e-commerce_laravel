<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

// use App\Http\Controllers
class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->load('products')->products;
        // dd($category);
        return view('web.categories.show', compact('category', 'products'));
    }
}