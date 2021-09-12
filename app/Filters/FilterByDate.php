<?php

namespace App\Filters;

use Carbon\Carbon;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterByDate implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        // dd($query);
        if ($value['from'] && $value['to'])
            return $query->whereDateBetween('created_at', [$value['from'], $value['to']]);

        if ($value['from'])
            return $query->whereDate('created_at', '>=', $value['from']);

        if ($value['to'])
            return $query->whereDate('created_at', '<=', $value['to']);
    }
}