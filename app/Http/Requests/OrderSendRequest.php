<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderSendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $courier = (bool) $this->input('courier');

        return [
            'user'               => ['required'],
            'user.name'          => ['required', 'string'],
            'user.surname'       => ['required', 'string'],
            'user.email'         => ['required', 'email'],
            'user.phone'         => ['required', 'string'],
            'comment'            => ['required', 'string'],
            "courier"            => ['required', 'boolean'],
            'address'            => [Rule::requiredIf($courier)],
            'address.street'     => [Rule::requiredIf($courier), 'string'],
            'address.home'       => [Rule::requiredIf($courier), 'string'],
            'address.apartment'  => [Rule::requiredIf($courier), 'string'],
            'address.entrance'   => [Rule::requiredIf($courier), 'string'],
            'address.floor'      => [Rule::requiredIf($courier), 'string'],
            'office'             => [Rule::requiredIf(!$courier), 'integer'],
            'online_payment'     => ['required', 'boolean'],
            'products'           => ['required'],
            'products.*id'       => ['required', 'integer', Rule::exists('products','id')],
            'products.*quantity' => ['required', 'integer']
        ];
    }
}
