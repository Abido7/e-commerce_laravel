<?php

namespace App\Http\Controllers\web;

use App\Events\orderAdded;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders =  Order::where('user_id', Auth::user()->id)->with('products')->get();
        return view('web.orders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        $products = $order->products()->paginate(1);
        $total = 0;
        // dd($products);
        return view('web.orders.show', compact('order', 'products', 'total'));
    }

    public function store()
    {
        $cart = session()->get('cart');
        $order = Order::create([
            'user_id' => Auth::user()->id
        ]);
        foreach ($cart as $product_id => $details) {
            $product = Product::findOrFail($product_id);
            if ($details['quantity'] > $product->pices_no) {
                return back()->with('success', "quantity not available just $product->pices_no is available");
            }
            $order->products()->attach($product_id, ['quantity' => $details['quantity'], 'amount' => $details['amount']]);
            $product->update([
                'pices_no' => $product->pices_no - $details['quantity']
            ]);
            session()->forget('cart');
            unset($cart);
        }
        event(new orderAdded);
        return redirect(url('/order'))->with('success', 'Order Add SuccessFully');
    }

    public function destroy(Order $order)
    {
        // when cancel order return pices_no for product to old value 
        foreach ($order->products as $product) {
            $product->update([
                'pices_no' =>
                $product->pices_no
                    + $product->pivot->quantity
            ]);
        }
        $order->delete();
        return redirect(url('/order'));
    }
}