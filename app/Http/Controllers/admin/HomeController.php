<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Traits\Monthly;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use Monthly;

    public function index()
    {
        $users = User::all()->count();
        $products = Product::get()->count();

        $maxproduct = DB::table('order_product')
            ->whereMonth('order_product.created_at', Carbon::now()->month)
            ->where('status', '!=', 'pending')
            ->join('orders', 'order_product.order_id', '=', 'orders.id')
            ->join('products', 'order_product.product_id', '=', 'products.id')
            ->selectRaw('count(order_id) as orders, product_id, name, SUM(quantity) as quantity,price,SUM(amount) as amount')
            ->groupBy('product_id')
            ->orderBy('amount', 'DESC')
            ->limit(5)
            ->get();


        $income =
            DB::table('order_product')
            ->where('status', '!=', 'pending')
            ->join('orders', 'order_product.order_id', '=', 'orders.id')
            ->selectRaw('count(order_id) as orders, product_id,  SUM(quantity) as quantity, SUM(amount) as amount')
            ->groupBy('product_id')
            ->orderBy('amount', 'DESC')
            ->get()
            ->sum('amount');



        // dd($income);
        // $income = DB::table('order_product')
        //     ->selectRaw('count(order_id) as orders, product_id, SUM(quantity) as quantity,SUM(amount) as amount')
        //     ->groupBy('product_id')
        //     ->get()
        //     ->sum('amount');

        $orderChart = LarapexChart::areaChart()
            ->setTitle('income per Month')
            ->addData('$money', $this->Monthly(Order::class))
            ->setXAxis($this->allMonthes);

        return view('admin.home.index', compact('orderChart', 'maxproduct', 'income', 'products', 'users'));
    }
}