<?php

namespace App\Services;

use App\Domain\Repositories\ProductRepository;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
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

    public function getCart($data): array
    {
        $products = $this->repository->getCart($data['products']);
        return ApiResponse::success([
            $products
        ], Response::HTTP_OK);
    }
    /** @noinspection PhpUndefinedFieldInspection */
    public function showProductWithAnalogs($id): array
    {
        $product = $this->repository->show($id);
        $analogs = $this->repository->analogs($product->category_id);
        return ApiResponse::success([
            'product' => new ProductResource($product),
            'analogs' => new ProductCollection($analogs)
        ], Response::HTTP_OK);
    }

    public function productsByCategory($id): array
    {
        $products = $this->repository->productsByCategory($id);
        return ApiResponse::success($products, Response::HTTP_OK);
    }
}
