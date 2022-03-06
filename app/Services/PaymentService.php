<?php

namespace App\Services;

use App\Domain\Repositories\OrderRepository;
use Japananimetime\Template\BaseService;

class PaymentService extends BaseService
{
    private OrderRepository $orderRepository;

    public function __construct(
        OrderRepository        $orderRepository
    )
    {
        parent::__construct();
        $this->orderRepository        = $orderRepository;
    }

}
