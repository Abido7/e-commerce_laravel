<?php

namespace App\Traits;


use App\Models\Order;
use Illuminate\Support\Facades\DB;


trait Monthly
{

    private $monthesNum = 12;
    public $allMonthes = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    public function Monthly($model)
    {
        $data = array_fill(0, $this->monthesNum, 0);
        $model::where('status', '!=', 'pending')
            ->join('order_product', 'order_id', '=', 'orders.id')
            ->selectRaw('SUM(amount) as total, MONTH(orders.created_at) month')
            ->groupBy('month')
            ->get()
            ->keyBy('month')
            ->each(function ($item, $key) use (&$data) {
                $data[$key - 1] = $item->total;
            })->toArray();

        // dd($sum);
        // $data = array_fill(0, $this->monthesNum, 0);
        // $query->select(DB::raw('count(id) as count'), DB::raw('MONTH(created_at) month'))
        //     ->groupBy('month')
        //     ->get(['month', 'count'])
        //     ->keyBy('month')
        //     ->each(function ($item, $key) use (&$data) {
        //         $data[$key - 1] = $item->count;
        //     });
        return $data;
    }
}