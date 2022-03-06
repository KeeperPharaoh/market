<?php

namespace App\Http\Resources;

use App\Domain\Contracts\CategoryContract;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
            return [
                'id'    => $item->id,
                CategoryContract::TITLE => $item->title,
                CategoryContract::IMAGE => env('APP_URL') . '/storage/' . $item->image

            ];
        });
    }
}
