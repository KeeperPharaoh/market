<?php

namespace App\Domain\Contracts;

interface CartContract
{

    public const TABLE     = 'carts';

    public const PRODUCT_ID = 'product_id';
    public const QUANTITY     = 'quantity';
    public const ORDER_ID     = 'order_id';

}
