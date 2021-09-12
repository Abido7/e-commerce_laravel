<?php

namespace App\Http\Controllers\admin;

use App\Filters\FilterByDate;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderController extends Controller
{
    public function index()
    {

        $pendingOrderNum = Order::where('status', 'pending')->count();
        $enumoptions = ['pending', 'preparing', 'on the way	', 'arrived'];

        $orders = QueryBuilder::for(Order::class)
            ->allowedFilters([
                AllowedFilter::partial('name', 'user.name'),
                AllowedFilter::exact('phone', 'user.phone'),
                AllowedFilter::exact('status', 'status'),
                AllowedFilter::custom('date', new FilterByDate),
            ])->orderBy('id', 'DESC')->with('user')->paginate(5);
        return view('admin.orders.index', compact('orders', 'enumoptions', 'pendingOrderNum'));
    }

    public function show(Order $order)
    {
        $orderDetails = $order->load('user', 'products');
        return view('admin.orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $product = Product::findOrFail($request->product_id);
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'preparing'
        ]);
        $order->products()->attach($product->id, ['quantity' => $request->quantity, 'amount' => $product->price * $request->quantity]);

        return redirect()->route('orders.index')->with('msg', 'order Added Successfully');
    }

    public function update(Order $order, Request $request)
    {
        $order->update([
            'status' => $request->status
        ]);
        return back()->with('msg', 'Order Status Changed Successfully');
    }
}