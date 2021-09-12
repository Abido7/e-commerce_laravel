<?php

namespace App\Filters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class FilterByprice implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {

        if ($value['min'] && $value['max'])
            return $query->whereBetween('price', [$value['min'], $value['max']]);

        if ($value['max'])
            return $query->where('price', "<=", $value['max']);

        if ($value['min'])
            return $query->where('price', ">=", $value['min']);
    }
}