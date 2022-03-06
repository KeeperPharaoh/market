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
    public function authorize()
    {
        return  Auth::check();     }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
                ProductContract::CATEGORY_ID => [
                    'integer' =>
                            'true',
                            ],
                ProductContract::TITLE => [
                    'string' =>
                            'true',
                            ],
                ProductContract::DESCRIPTION => [
                    'string' =>
                            'true',
                            ],
                ProductContract::PRICE => [
                    'string' =>
                            'true',
                            ],
                ProductContract::OLD_PRICE => [
                    'string' =>
                            'true',
                            ],
                ProductContract::IS_HIT => [
                    'bool' =>
                            'true',
                            ],
                ProductContract::IS_LATEST => [
                    'bool' =>
                            'true',
                            ],
        ];
    }
}
