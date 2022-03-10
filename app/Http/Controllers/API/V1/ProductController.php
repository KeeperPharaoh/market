<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\QueryFilters\ProductFilter;
use Illuminate\Http\JsonResponse;
use App\Services\ProductService;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return  Response
     */
    public function index(): Response
    {
        $result = $this->productService->all();
        return response(new ProductCollection($result[0]), $result[1]);
    }

    /**
     * Display paginated listing of the resource.
     *
     * @return    Response
     */
    public function paginate(): Response
    {
        $result = $this->productService->paginate();
        return response(new ProductCollection($result[0]), $result[1]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param CreateProductRequest $request
    *
    * @return    Response
    */
    public function store(CreateProductRequest $request): Response
    {
        $request = $request->validated();
        $images  = $request['images'];
        $names   = [];
        foreach ($images as $image) {
            $names[] = imageBase64Upload($image, PRODUCTS);
        }
        $request['images']  = json_encode($names);
        $result = $this->productService->create($request);
        return response($result[0], $result[1]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return    Response
     */
    public function show(int $id): Response
    {
        $result = $this->productService->show($id);
        return response(new ProductResource($result[0]), $result[1]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param UpdateProductRequest $request
    * @param  int                                  $id
    *
    * @return    Response
    */
    public function update(UpdateProductRequest $request, int $id): Response
    {
        $result = $this->productService->update($request->validated(),$id);
        return response($result[0], $result[1]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    *
    * @return    Response
    */
    public function destroy(int $id): Response
    {
        $result = $this->productService->delete($id);
        return response($result[0], $result[1]);
    }

    public function getCart(CartRequest $request): JsonResponse
    {
        $result = $this->productService->getCart($request->validated());
        return response()->json($result['message'], $result['code']);
    }
    public function showProductWithAnalogs(int $id): JsonResponse
    {
        $result = $this->productService->showProductWithAnalogs($id);
        return response()->json($result['message'], $result['code']);
    }
    public function products()
    {
        $result = $this->productService->paginate(
            ProductFilter::class
        );
        return response(new ProductCollection($result[0]), $result[1]);
    }

    public function productsByCategory(int $id): JsonResponse
    {
        $result = $this->productService->productsByCategory($id);
        return response()->json($result['message'], $result['code']);
    }
}
