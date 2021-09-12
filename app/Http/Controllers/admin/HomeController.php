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
            ->selectRaw('count(order_id) as orders, product_id, SUM(quantity) as quantity,SUM(amount) as amount')
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy('product_id')
            ->orderBy('amount', 'DESC')
            ->limit(5)
            ->get();

        // dd($maxproduct);
        $income = DB::table('order_product')
            ->selectRaw('count(order_id) as orders, product_id, SUM(quantity) as quantity,SUM(amount) as amount')
            ->groupBy('product_id')
            ->get()
            ->sum('amount');

        $orderChart = LarapexChart::areaChart()
            ->setTitle('orders per Month')
            ->addData('Orders', $this->Monthly(Order::class))
            ->setXAxis($this->allMonthes);

        return view('admin.home.index', compact('orderChart', 'maxproduct', 'income', 'products', 'users'));
    }
}