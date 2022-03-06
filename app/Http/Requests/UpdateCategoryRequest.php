<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\CategoryContract;
use Illuminate\Support\Facades\Auth;

class UpdateCategoryRequest extends FormRequest
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
                CategoryContract::PARENT_ID => [
                    'integer' =>
                            'true',
                            ],
                CategoryContract::TITLE => [
                    'string' =>
                            'true',
                            ],
                CategoryContract::IMAGE => [
                    'string' =>
                            'true',
                            ],
        ];
    }
}
