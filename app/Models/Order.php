<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\OrderContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory , SoftDeletes ;

    protected $fillable = [
            OrderContract::USER_ID,
            OrderContract::NAME,
            OrderContract::SURNAME,
            OrderContract::EMAIL,
            OrderContract::PHONE,
            OrderContract::COMMENT,
            OrderContract::STREET,
            OrderContract::HOME,
            OrderContract::APARTMENT,
            OrderContract::ENTRANCE,
            OrderContract::FLOOR,
            OrderContract::OFFICE,
            OrderContract::STATUS,
            OrderContract::PAYMENT_ID,
            OrderContract::PAYMENT_STATUS,
            OrderContract::SUM,
    ];

    protected $perPage = 16;

    protected $table = OrderContract::TABLE;

}
