<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\UserContract;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
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
                UserContract::NAME => ['string'],
                UserContract::SURNAME => ['string'],
                UserContract::EMAIL => ['string','email'],
                UserContract::EMAIL_VERIFIED_AT => [],
                UserContract::PHONE => ['string'],
                UserContract::PASSWORD => ['string'],
        ];
    }
}
