<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Filters\FilterByPrice;
use App\Http\Requests\ValidateProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ProductController extends Controller
{
    public function index()
    {
        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                AllowedFilter::custom('price', new FilterByPrice),
                AllowedFilter::exact('category_id', 'category_id'),
                AllowedFilter::partial('product_name', 'name'),
            ])
            ->with('orders')->orderBy('id', 'desc')->paginate(10);
        $categories = Category::get();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(ValidateProduct $requset)
    {
        $requset->validate([
            'img' => 'required|image|mimes:jpg,jpeg,png|dimensions:min_width=1024,min_height=800|max:2048'
        ]);
        $imgPath = Storage::disk('uploads')->put('products', $requset->img);
        // dd($requset->img);
        Product::create([
            'category_id' => $requset->category_id,
            'name' => json_encode([
                'en' => $requset->name_en,
                'ar' => $requset->name_ar,
            ]),
            'description' => json_encode([
                'en' => $requset->desc_en,
                'ar' => $requset->desc_ar,
            ]),
            'price' =>  $requset->price,
            'pices_no' => $requset->pices_no,
            'img' => $imgPath
        ]);
        return back();
    }

    public function show(Product $product)
    {
        $product = $product->load('orders');
        return view('admin.products.show', compact('product'));
    }


    public function update(ValidateProduct $requset)
    {
        $requset->validate([
            'id' => 'required|exists:products,id',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|dimensions:min_width=1024,min_height=800|max:2048'
        ]);
        $product = Product::findOrFail($requset->id);
        $imgPath = $product->img;
        if ($requset->hasFile('img')) {
            Storage::disk('uploads')->delete($imgPath);
            $imgPath = Storage::disk('uploads')->put('products', $requset->img);
        }
        $product->update([
            'category_id' => $requset->category_id,
            'name' => json_encode([
                'en' => $requset->name_en,
                'ar' => $requset->name_ar,
            ]),
            'description' => json_encode([
                'en' => $requset->desc_en,
                'ar' => $requset->desc_ar,
            ]),
            'pices_no' => $requset->pices_no,
            'price' => $requset->price,
            'img' => $imgPath
        ]);
        return back()->with('msg', 'product updated successfully');
    }


    public function active(Product $product)
    {
        $product->activate();
        return back();
    }

    public function deactive(Product $product)
    {
        $product->deactivate();
        return back();
    }

    public function destroy(Product $product)
    {
        Storage::disk('uploads')->delete($product->img);
        $product->delete();
        return back()->with('msg', 'Product Deleted Successfully');
    }
}