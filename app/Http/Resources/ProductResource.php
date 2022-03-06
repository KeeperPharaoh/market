<?php

namespace App\Http\Resources;

use App\Domain\Contracts\ProductContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property mixed $category_id
 * @property mixed $title
 * @property mixed $description
 * @property mixed $price
 * @property mixed $old_price
 * @property mixed $is_hit
 * @property mixed $is_latest
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                         => $this->id,
            ProductContract::CATEGORY_ID => $this->category_id,
            ProductContract::TITLE       => $this->title,
            ProductContract::DESCRIPTION => $this->description,
            ProductContract::PRICE       => $this->price,
            ProductContract::OLD_PRICE   => $this->old_price,
            ProductContract::IS_HIT      => $this->is_hit,
            ProductContract::IS_LATEST   => $this->is_latest
        ];
    }
}
