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

    public function getCart($ids)
    {
        return $this->model()
            ->query()
            ->whereIn(ID, $ids)
            ->get();
    }

    public function analogs($id)
    {
        return $this->model()
            ->query()
            ->where(ProductContract::CATEGORY_ID, $id)
            ->take(5)
            ->get();
    }

    public function productsByCategory($id): LengthAwarePaginator
    {
        return $this->model()
            ->query()
            ->select([
                ID,
                ProductContract::CATEGORY_ID,
                ProductContract::TITLE,
                ProductContract::IMAGES,
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

    public function getPrice($id)
    {
        return $this->model()
            ->query()
            ->select(ProductContract::PRICE)
            ->find($id);
    }
}
