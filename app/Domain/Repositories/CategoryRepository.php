<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\CategoryContract;
use Japananimetime\Template\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{

    public function model(): Category
    {
        return new Category();
    }

    public function categories()
    {
        return $this->model()
            ->query()
            ->where(
                CategoryContract::PARENT_ID, null
            )
            ->get();
    }

    public function subcategories($id)
    {
        return $this->model()
            ->query()
            ->where(
                CategoryContract::PARENT_ID, $id
            )
            ->get();
    }
}
