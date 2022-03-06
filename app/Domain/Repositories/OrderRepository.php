<?php

namespace App\Domain\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Japananimetime\Template\BaseRepository;
use App\Models\Order;
use App\Domain\Contracts\OrderContract;

class OrderRepository extends BaseRepository
{
    public function model(): Order
    {
        return new Order();
    }

    public function orderCreate($user, $address, $comment, $sum, $paymentStatus)
    {
        return $this->model()
            ->query()
            ->create([
                OrderContract::USER_ID        => Auth::guard('sanctum')->id(),
                OrderContract::NAME           => $user['name'],
                OrderContract::SURNAME        => $user['surname'],
                OrderContract::EMAIL          => $user['email'],
                OrderContract::PHONE          => $user['phone'],

                OrderContract::COMMENT        => $comment,

                OrderContract::STREET         => (isset($address['street']))    ? $address['street'] : '',
                OrderContract::HOME           => (isset($address['home']))      ? $address['home'] : '',
                OrderContract::APARTMENT      => (isset($address['apartment'])) ? $address['apartment'] : '',
                OrderContract::ENTRANCE       => (isset($address['entrance']))  ? $address['entrance'] : '',
                OrderContract::FLOOR          => (isset($address['floor']))     ? $address['floor'] : '',
                OrderContract::OFFICE         => (!isset($address['street']))   ? $address : null,

                OrderContract::SUM            => $sum,
                OrderContract::PAYMENT_STATUS => $paymentStatus
            ]);
    }

    public function getOrders(): LengthAwarePaginator
    {
        return $this->model()
            ->query()
            ->select(
                ID,
                CREATED_AT,
                OrderContract::STATUS
            )
            ->where(
                OrderContract::USER_ID,Auth::id()
            )
            ->paginate(16)
            ;
    }
}
