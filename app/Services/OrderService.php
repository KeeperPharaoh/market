<?php

namespace App\Services;

use App\Domain\Contracts\CartContract;
use App\Domain\Repositories\CartRepository;
use App\Domain\Repositories\OrderRepository;
use App\Domain\Repositories\PickupOfficeRepository;
use App\Domain\Repositories\ProductRepository;
use App\Responses\ApiResponse;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Japananimetime\Template\BaseService;

class OrderService extends BaseService
{
    private PickupOfficeRepository $pickupOfficeRepository;
    private OrderRepository        $orderRepository;
    private CartRepository         $cartRepository;
    private ProductRepository      $productRepository;
    /**
    * UserService constructor.
    */
    public function __construct(
        OrderRepository        $orderRepository,
        PickupOfficeRepository $pickupOfficeRepository,
        CartRepository         $cartRepository,
        ProductRepository      $productRepository
    )
    {
        parent::__construct();
        $this->repository             = $orderRepository;
        $this->orderRepository        = $orderRepository;
        $this->pickupOfficeRepository = $pickupOfficeRepository;
        $this->cartRepository         = $cartRepository;
        $this->productRepository      = $productRepository;
    }

    public function pickupOffices(): array
    {
        $offices = $this->pickupOfficeRepository->all([]);
        return ApiResponse::success($offices, Response::HTTP_OK);
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function orderCreate($data): array
    {
        $user     = $data['user'];
        $products = $data['products'];
        $address  = ($data['courier']) ? $data['address'] : $data['office'];
        $paymentStatus = ($data['online_payment']) ? PAYMENT_IN_PROGRESS : CASH_PAYMENT;
        $comment       = $data['comment'];
        $sum           = 0;

        foreach ($products as $product) {
            $price = $this->productRepository->getPrice($product['id'])->price;
            $sum += $price * $product['quantity'];
        }
        try {
            DB::beginTransaction();

            $order = $this->orderRepository->orderCreate($user, $address, $comment, $sum, $paymentStatus);
            foreach ($products as $product) {
                $this->cartRepository->create([
                    CartContract::PRODUCT_ID    => $product['id'],
                    CartContract::QUANTITY    => $product['quantity'],
                    CartContract::ORDER_ID    => $order->id
                ]);
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return ApiResponse::failureMessage(
                $exception->getMessage(),
                Response::HTTP_CONFLICT
            );
        }
        return ApiResponse::successMessage(
            OPERATION_SUCCESSFUL,
            Response::HTTP_OK
        );
    }

    /** @noinspection PhpUndefinedFieldInspection */
    public function history(): array
    {
        $orders    = $this->orderRepository->getOrders();
        $products = [];

        foreach ($orders as $order) {
            $carts = $this->cartRepository->getCarts($order->id);
            foreach ($carts as $cart) {
                $product = $this->productRepository->show($cart->product_id);
                $product->quantity = $cart->quantity;

                $products[] = $product;
            }
            $order->order = $products;
            $products     = [];
        }
        return ApiResponse::success(
            $orders,
            Response::HTTP_OK
        );
    }
}
