<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\CategoryContract;
use Illuminate\Support\Facades\Auth;

class CreateCategoryRequest extends FormRequest
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
                CategoryContract::PARENT_ID => ['integer', 'nullable'],
                CategoryContract::TITLE     => ['string', 'required'],
                CategoryContract::IMAGE     => ['required'],
        ];
    }
}
