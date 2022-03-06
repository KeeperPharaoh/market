<?php

namespace App\Domain\Contracts;

interface ProductContract
{

    public const TABLE       = 'products';

    public const CATEGORY_ID = 'category_id';
    public const TITLE       = 'title';
    public const DESCRIPTION = 'description';
    public const PRICE       = 'price';
    public const OLD_PRICE   = 'old_price';
    public const IS_HIT      = 'is_hit';
    public const IS_LATEST   = 'is_latest';

}
