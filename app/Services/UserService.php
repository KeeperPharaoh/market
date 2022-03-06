<?php

namespace App\Services;

use App\Domain\Contracts\UserContract;
use App\Domain\Repositories\UserRepository;
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
}
