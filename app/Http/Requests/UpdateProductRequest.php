<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\ProductContract;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize(): bool
    {
        return  Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules(): array
    {
        return [
            ProductContract::CATEGORY_ID => ['integer'],
            ProductContract::TITLE       => ['string'],
            ProductContract::DESCRIPTION => ['string'],
            ProductContract::PRICE       => ['string', 'integer'],
            ProductContract::OLD_PRICE   => ['string', 'integer'],
            ProductContract::IS_HIT      => ['boolean'],
            ProductContract::IS_LATEST   => ['boolean']
        ];
    }
}
