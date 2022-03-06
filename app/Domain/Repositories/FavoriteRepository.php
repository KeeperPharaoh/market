<?php

namespace App\Domain\Repositories;


use App\Domain\Contracts\FavoriteContract;
use App\Domain\Contracts\ProductContract;
use App\Models\Favorite;
use Illuminate\Database\Query\JoinClause;
use Japananimetime\Template\BaseRepository;

class FavoriteRepository extends BaseRepository
{
    public function model(): Favorite
    {
        return new Favorite();
    }

    public function showFavorite($id)
    {
        $model = $this->model()
            ->query()
            ->where(FavoriteContract::USER_ID, $id);
        $model->join(ProductContract::TABLE, function (JoinClause $join) {
            $join->on( 'products.id','=',  'favorites.product_id');
        });

        return $model->get();
    }

    public function deleteWhere($data)
    {
        return $this
            ->model()
            ->query()
            ->where($data)
            ->delete();
    }
}
