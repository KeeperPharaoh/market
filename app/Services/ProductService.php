<?php

namespace App\Services;

use App\Domain\Repositories\ProductRepository;
use App\Responses\ApiResponse;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;

class ProductService extends BaseService
{
    /**
    * UserService constructor.
    */
    public function __construct(ProductRepository $productRepository) {
        parent::__construct();
        $this->repository = $productRepository;
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function showProductWithAnalogs($id): array
    {
        $product = $this->repository->show($id);
        $analogs = $this->repository->analogs($product->category_id);
        return ApiResponse::success([
            'product' => $product,
            'analogs' => $analogs
        ], Response::HTTP_OK);
    }

    public function productsByCategory($id): array
    {
        $products = $this->repository->productsByCategory($id);
        return ApiResponse::success($products, Response::HTTP_OK);
    }
}
