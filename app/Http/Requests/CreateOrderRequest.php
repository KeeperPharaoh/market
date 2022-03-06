<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Contracts\OrderContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules(): array
    {
        return [
            OrderContract::USER_ID => [''],
            OrderContract::NAME => [''],
            OrderContract::SURNAME => [''],
            OrderContract::EMAIL => [''],
            OrderContract::PHONE => [''],
            OrderContract::COMMENT => [''],
            OrderContract::STREET => [''],
            OrderContract::HOME => [''],
            OrderContract::APARTMENT => [''],
            OrderContract::ENTRANCE => [''],
            OrderContract::FLOOR => [''],
            OrderContract::OFFICE => [''],
            OrderContract::STATUS => [''],
            OrderContract::PAYMENT_ID => [''],
            OrderContract::PAYMENT_STATUS => [''],
            OrderContract::SUM => [''],
        ];
    }
}
