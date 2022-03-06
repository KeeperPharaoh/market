<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\CartContract;
use App\Models\Cart;
use Japananimetime\Template\BaseRepository;

class CartRepository extends BaseRepository
{

    public function model(): Cart
    {
        return new Cart();
    }

    public function getCarts($id)
    {
        return $this->model()
            ->query()
            ->where(
                CartContract::ORDER_ID, $id
            )
            ->get();
    }
}
