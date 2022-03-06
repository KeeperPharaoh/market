<?php

namespace App\Services;

use App\Domain\Contracts\UserContract;
use App\Domain\Repositories\UserRepository;
use App\Responses\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Japananimetime\Template\BaseService;
use Symfony\Component\HttpFoundation\Response;

class AuthService extends BaseService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    /** @noinspection PhpUndefinedMethodInspection
     * @noinspection PhpUndefinedFieldInspection
     */
    public function register($attributes): array
    {
        $attributes['password'] = bcrypt($attributes['password']);

        try {
        DB::beginTransaction();

        $user             = $this->userRepository->create($attributes);
        $success['token'] = $user->createToken('market')->plainTextToken;

        $success['user']  = [
                UserContract::NAME  => $user->name,
                UserContract::EMAIL => $user->email,
            ];
        DB::commit();

        return ApiResponse::success(
            $success,
            Response::HTTP_OK
        );

        } catch (Exception $exception) {
            DB::rollBack();
            return ApiResponse::failureMessage(
                    $exception->getMessage(),
                    Response::HTTP_CONFLICT
            );
        }
    }

    public function login($attributes): array
    {
        $email    = $attributes['email'];
        $password = $attributes['password'];
        if (Auth::attempt([UserContract::EMAIL => $email, UserContract::PASSWORD => $password])) {
            $user    = Auth::user();
            $success = array('token' => $user->createToken('market')->plainTextToken);
            $success['user'] = [
                UserContract::NAME  => $user->name,
                UserContract::EMAIL => $user->email
            ];
            return ApiResponse::success(
                $success,
                Response::HTTP_OK
            );
        }

        return ApiResponse::failureMessage(
            INVALID_LOGIN,
            Response::HTTP_CONFLICT
        );
    }

    public function logout(): array
    {
        try {
            Auth::user()->tokens->each(function ($token, $key) {
                $token->delete();
            });

            return ApiResponse::successMessage(
                OPERATION_SUCCESSFUL,
                Response::HTTP_OK
            );
        } catch (Exception $exception) {
            return ApiResponse::failureMessage(
                INVALID_LOGIN,
                Response::HTTP_CONFLICT
            );
        }
    }
}
