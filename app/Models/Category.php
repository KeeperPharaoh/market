<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Contracts\CategoryContract;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static inRandomOrder()
 */
class Category extends Model
{
    use HasFactory , SoftDeletes ;

    protected $fillable = [
            CategoryContract::PARENT_ID,
            CategoryContract::TITLE,
            CategoryContract::IMAGE,
    ];

    protected $hidden = [
            DELETED_AT,
            CREATED_AT,
            UPDATED_AT
    ];

    protected $perPage = 16;

    protected $table = CategoryContract::TABLE;

}
