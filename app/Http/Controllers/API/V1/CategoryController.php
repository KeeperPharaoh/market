<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\GetCategoryRequest;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \App\Http\Requests\GetCategoryRequest $request
    *
    * @return  Response
    */
    public function index(GetCategoryRequest $request): Response
    {
        $result = $this->categoryService->all();
        return response($result[0], $result[1]);
    }

    /**
    * Display paginated listing of the resource.
    *
    * @param  \App\Http\Requests\GetCategoryRequest $request
    *
    * @return    Response
    */
    public function paginate(GetCategoryRequest $request): Response
    {
        $result = $this->categoryService->paginate();
        return response($result[0], $result[1]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \App\Http\Requests\CreateCategoryRequest $request
    *
    * @return    Response
    */
    public function store(CreateCategoryRequest $request): Response
    {
        $result = $this->categoryService->create();
        return response($result[0], $result[1]);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Http\Requests\GetCategoryRequest $request
    * @param  int                               $id
    *
    * @return    Response
    */
    public function show(GetCategoryRequest $request, int $id): Response
    {
        $result = $this->categoryService->show($id);
        return response($result[0], $result[1]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \App\Http\Requests\UpdateCategoryRequest $request
    * @param  int                                  $id
    *
    * @return    Response
    */
    public function update(UpdateCategoryRequest $request, int $id): Response
    {
        $result = $this->categoryService->update($id);
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
        $result = $this->categoryService->delete($id);
        return response($result[0], $result[1]);
    }

    public function categories(): JsonResponse
    {
        $result = $this->categoryService->categories();
        return response()->json($result['message'], $result['code']);
    }

    public function subcategories(int $id): JsonResponse
    {
        $result = $this->categoryService->subcategories($id);
        return response()->json($result['message'], $result['code']);
    }
}
