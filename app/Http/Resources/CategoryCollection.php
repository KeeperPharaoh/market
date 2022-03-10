<?php

namespace App\Http\Resources;

use App\Domain\Contracts\CategoryContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return Collection
     */
    public function toArray($request): Collection
    {
        return $this->collection->map(function ($item) {
            return [
                ID    => $item->id,
                CategoryContract::TITLE => $item->title,
                CategoryContract::IMAGE => env('APP_URL') . '/storage/' . $item->image
            ];
        });
    }
}
