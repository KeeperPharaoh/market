<?php

namespace App\Domain\Contracts;

interface CategoryContract
{

    public const TABLE   = 'categories';

    public const PARENT_ID = 'parent_id';
    public const TITLE = 'title';
    public const IMAGE = 'image';

}
