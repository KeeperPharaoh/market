<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\FavoriteService;
use Illuminate\Http\JsonResponse;

class FavoriteController extends Controller
{
    public FavoriteService $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function show(): JsonResponse
    {
        $result = $this->favoriteService->showFavorite();
        return response()->json($result['message'], $result['code']);
    }

    public function add(int $id): JsonResponse
    {
        $result = $this->favoriteService->add($id);
        return response()->json($result['message'], $result['code']);
    }

    public function delete(int $id): JsonResponse
    {
        $result = $this->favoriteService->deleteFavorite($id);
        return response()->json($result['message'], $result['code']);
    }
}
