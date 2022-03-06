<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\UserContract;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
                UserContract::NAME => [
                    'string' =>
                            'true',
                            ],
                UserContract::SURNAME => [
                    'string' =>
                            'true',
                            ],
                UserContract::EMAIL => [
                    'string' =>
                            'true',
                                'email' =>
                            'email:rfc,dns',
                            ],
                UserContract::EMAIL_VERIFIED_AT => [
                ],
                UserContract::PHONE => [
                    'string' =>
                            'true',
                            ],
                UserContract::PASSWORD => [
                    'string' =>
                            'true',
                                'password' =>
             [
                            'required',
                            'confirmed',
                            'Illuminate\Validation\Rules\Password::min(6)',
                        ],
                            ],
        ];
    }
}
