<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\UserContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticateContract;

class User extends Model implements AuthenticateContract
{
    use HasFactory , SoftDeletes, HasApiTokens, Notifiable;
    use Authenticatable;

    protected $fillable = [
            UserContract::NAME,
            UserContract::SURNAME,
            UserContract::EMAIL,
            UserContract::EMAIL_VERIFIED_AT,
            UserContract::PHONE,
            UserContract::PASSWORD,
    ];

    protected $perPage = 16;

    protected $table = UserContract::TABLE;

}
