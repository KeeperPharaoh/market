<?php

namespace App\Services;

use App\Domain\Contracts\ProductContract;
use App\Domain\Repositories\ProductRepository;
use App\Responses\ApiResponse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;

class ProductService extends BaseService
{
    private ProductRepository $productRepository;
    /**
    * UserService constructor.
    */
    public function __construct(ProductRepository $productRepository) {
        parent::__construct();
        $this->repository = $productRepository;
    }

    public function productsByCategory($id): array
    {
        $products = $this->repository->productsByCategory($id);
        return ApiResponse::success($products, Response::HTTP_OK);
    }
}
