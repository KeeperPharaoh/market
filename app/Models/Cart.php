<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\CartContract;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        CartContract::ORDER_ID,
        CartContract::QUANTITY,
        CartContract::PRODUCT_ID
    ];
}
