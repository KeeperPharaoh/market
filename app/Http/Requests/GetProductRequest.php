<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\ProductContract;

class GetProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize(): bool
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules(): array
    {
        return [
                ProductContract::CATEGORY_ID => [
                ],
                ProductContract::TITLE => [
                ],
                ProductContract::DESCRIPTION => [
                ],
                ProductContract::PRICE => [
                ],
                ProductContract::OLD_PRICE => [
                ],
                ProductContract::IS_HIT => [
                ],
                ProductContract::IS_LATEST => [
                ],
        ];
    }
}
