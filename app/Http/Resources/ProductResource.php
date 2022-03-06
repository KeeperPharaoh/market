<?php

namespace App\Http\Resources;

use App\Domain\Contracts\ProductContract;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
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
