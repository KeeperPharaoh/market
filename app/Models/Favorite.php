<?php

namespace App\Models;

use App\Domain\Contracts\FavoriteContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        FavoriteContract::PRODUCT_ID,
        FavoriteContract::USER_ID
    ];
}
