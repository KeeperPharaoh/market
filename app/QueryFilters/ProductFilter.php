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
        if(request()->has('new')) {
            $query->where(ProductContract::IS_LATEST, true);
        }

        if(request()->has('hit')) {
            $query->where(ProductContract::IS_HIT, true);
        }

        if (request()->has('category')) {
            $categories = request()->input('category');
            $ids = explode(',', $categories);
            $query->whereIn(ProductContract::CATEGORY_ID, $ids);
        }
        return $next($query);
    }
}
