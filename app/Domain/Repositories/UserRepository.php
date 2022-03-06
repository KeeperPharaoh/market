<?php

namespace App\Domain\Repositories;


use Japananimetime\Template\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{

    public function model(): User
    {
        return new User();
    }
}
