<?php

namespace App\Services;

use App\Domain\Contracts\FavoriteContract;
use App\Domain\Repositories\FavoriteRepository;
use App\Responses\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;

class FavoriteService extends BaseService
{
    private FavoriteRepository $favoriteRepository;

    /**
     * UserService constructor.
     */
    public function __construct(FavoriteRepository $favoriteRepository)
    {
        parent::__construct();
        $this->favoriteRepository = $favoriteRepository;
    }

    public function showFavorite(): array
    {
        $product = $this->favoriteRepository->showFavorite(Auth::id());
        return ApiResponse::success(
            $product,
            Response::HTTP_OK
        );
    }

    public function add($id): array
    {
        try {
            DB::beginTransaction();

            $data = [
                FavoriteContract::USER_ID    => Auth::id(),
                FavoriteContract::PRODUCT_ID => $id
            ];
            $this->favoriteRepository->create($data);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return ApiResponse::failureMessage(
                $exception->getMessage(),
                Response::HTTP_CONFLICT
            );
        }

        return ApiResponse::successMessage(
            OPERATION_SUCCESSFUL,
            Response::HTTP_OK
        );
    }

    public function deleteFavorite($id): array
    {
        try {
            DB::beginTransaction();

            $data = [
                FavoriteContract::USER_ID    => Auth::id(),
                FavoriteContract::PRODUCT_ID => $id
            ];
            $this->favoriteRepository->deleteWhere($data);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            return ApiResponse::failureMessage(
                $exception->getMessage(),
                Response::HTTP_CONFLICT
            );
        }

        return ApiResponse::successMessage(
            OPERATION_SUCCESSFUL,
            Response::HTTP_OK
        );
    }
}
