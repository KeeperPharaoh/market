<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\UserContract;

class GetUserRequest extends FormRequest
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
                UserContract::NAME => [
                ],
                UserContract::SURNAME => [
                ],
                UserContract::EMAIL => [
                ],
                UserContract::EMAIL_VERIFIED_AT => [
                ],
                UserContract::PHONE => [
                ],
                UserContract::PASSWORD => [
                ],
        ];
    }
}
