<?php

namespace App\Services;

use App\Domain\Contracts\CategoryContract;
use App\Domain\Repositories\CategoryRepository;
use App\Http\Resources\CategoryCollection;
use App\Responses\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;

class CategoryService extends BaseService
{
    private CategoryRepository $categoryRepository;

    /**
     * UserService constructor.
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function categories(): array
    {
        $categories = $this->categoryRepository->categories();

        return ApiResponse::success(
            new CategoryCollection($categories),
            Response::HTTP_OK
        );
    }

    public function subcategories($id): array
    {
        $categories = $this->categoryRepository->subcategories($id);
        return ApiResponse::success(
            new CategoryCollection($categories),
            Response::HTTP_OK
        );
    }
}
