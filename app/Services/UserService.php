<?php

namespace App\Services;

use App\Domain\Repositories\UserRepository;
use App\Responses\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;

class UserService extends BaseService
{
    /**
    * UserService constructor.
    */
    public function __construct(UserRepository $UserRepository) {
        parent::__construct();
        $this->repository = $UserRepository;
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function changePassword($data): array
    {
        $user = $this->repository->show(Auth::id());

        if ($data['new_password'] != $data['conf_password']) {
            return ApiResponse::failureMessage(
                PASSWORD_INCORRECT,
                Response::HTTP_I_AM_A_TEAPOT
            );
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return ApiResponse::successMessage(
            OPERATION_SUCCESSFUL,
            Response::HTTP_OK
        );
    }
}
