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
                UserContract::NAME => [
                    'string' =>
                            'true',
                                'required' =>
                            'true',
                            ],
                UserContract::SURNAME => [
                    'string' =>
                            'true',
                                'required' =>
                            'true',
                            ],
                UserContract::EMAIL => [
                    'string' =>
                            'true',
                                'email' =>
                            'email:rfc,dns',
                                'required' =>
                            'true',
                            ],
                UserContract::EMAIL_VERIFIED_AT => [
                ],
                UserContract::PHONE => [
                    'string' =>
                            'true',
                                'required' =>
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
                                'required' =>
                            'true',
                            ],
        ];
    }
}
