<?php

namespace App\Http\Resources;

use App\Domain\Contracts\ProductContract;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) {
            $images= json_decode($item->images);
            return [
                'id'                         => $item->id,
                ProductContract::CATEGORY_ID => $item->category_id,
                ProductContract::TITLE       => $item->title,
                ProductContract::IMAGES      => env('APP_URL') . '/storage/' . $images[0],
                ProductContract::DESCRIPTION => $item->description,
                ProductContract::PRICE       => $item->price,
                ProductContract::OLD_PRICE   => $item->old_price,
                ProductContract::IS_HIT      => $item->is_hit,
                ProductContract::IS_LATEST   => $item->is_latest
            ];
        });
    }
}
