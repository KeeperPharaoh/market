<?php

namespace App\QueryFilters;

use App\Domain\Contracts\ProductContract;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter
{
    /**
     * @param Builder $query
     * @param $next
     * @return mixed
     */
    public function handle(Builder $query, $next)
    {
        if(request()->has('new')){
            $query->where(ProductContract::IS_LATEST, true);
        }

        if(request()->has('hit')){
            $query->where(ProductContract::IS_HIT, true);
        }

        return $next($query);
    }
}
