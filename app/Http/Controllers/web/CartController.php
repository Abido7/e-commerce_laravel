<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function index()
    {
        // $cart = session()->get('cart');
        // dd($cart);
        return view('web.cart.index');
    }
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product);
        $cart = session()->get('cart');
        $id = $product->id;

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    'amount' => $product->price,
                    "img" => $product->img
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $cart[$id]['amount'] = $cart[$id]['quantity'] * $cart[$id]['price'];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "amount" => $product->price,
            "img" => $product->img
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }


    public function update(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            $cart[$request->id]["amount"] = $request->quantity * $cart[$request->id]["price"];
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }
    public function destroy(Request $request)
    {

        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
        // return response()->json(["data", $cart], 200);
    }
}