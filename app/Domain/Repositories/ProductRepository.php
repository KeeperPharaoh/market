<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\ProductContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Japananimetime\Template\BaseRepository;
use App\Models\Product;

class ProductRepository extends BaseRepository
{

    public function model(): Product
    {
        return new Product();
    }

    public function productsBycategory($id): LengthAwarePaginator
    {
        return $this->model()
             ->newQuery()
            ->select([
                'id',
                ProductContract::CATEGORY_ID,
                ProductContract::TITLE,
                ProductContract::DESCRIPTION,
                ProductContract::PRICE,
                ProductContract::OLD_PRICE,
                ProductContract::IS_LATEST,
                ProductContract::IS_HIT
            ])
             ->where([
                 ProductContract::CATEGORY_ID => $id
             ])
            ->paginate(16);
    }
}
