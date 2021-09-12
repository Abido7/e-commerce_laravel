<?php

namespace App\Traits;


use Illuminate\Support\Facades\DB;


trait Monthly
{

    private $monthesNum = 12;
    public $allMonthes = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    public function Monthly($model)
    {
        $data = array_fill(0, $this->monthesNum, 0);
        $model::select(DB::raw('count(id) as count'), DB::raw('MONTH(created_at) month'))
            ->groupBy('month')
            ->get(['month', 'count'])
            ->keyBy('month')
            ->each(function ($item, $key) use (&$data) {
                $data[$key - 1] = $item->count;
            })->toArray();
        return $data;
    }
}