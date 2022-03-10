<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderSendRequest;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use App\Services\OrderService;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public OrderService   $orderService;
    public PaymentService $paymentService;

    public function __construct(
        OrderService   $orderService,
        PaymentService $paymentService
    )
    {
        $this->orderService   = $orderService;
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return  Response
     */
    public function index(): Response
    {
        $result = $this->orderService->all();
        return response($result[0], $result[1]);
    }

    /**
     * Display paginated listing of the resource.
     *
     * @return    Response
     */
    public function paginate(): Response
    {
        $result = $this->orderService->paginate();
        return response($result[0], $result[1]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param CreateOrderRequest $request
    *
    * @return    Response
    */
    public function store(CreateOrderRequest $request): Response
    {
        $result = $this->orderService->create($request->validated());
        return response($result[0], $result[1]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return    Response
     */
    public function show(int $id): Response
    {
        $result = $this->orderService->show($id);
        return response($result[0], $result[1]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param UpdateOrderRequest $request
    * @param  int                                  $id
    *
    * @return    Response
    */
    public function update(UpdateOrderRequest $request, int $id): Response
    {
        $result = $this->orderService->update($request->validated(),$id);
        return response($result[0], $result[1]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    *
    * @return    Response
    */
    public function destroy(int $id): Response
    {
        $result = $this->orderService->delete($id);
        return response($result[0], $result[1]);
    }

    public function pickupOffices(): JsonResponse
    {
        $result = $this->orderService->pickupOffices();
        return response()->json($result['message'], $result['code']);
    }

    public function create(OrderSendRequest $request): JsonResponse
    {
        $request = $request->validated();
        $result  = $this->orderService->orderCreate($request);

        if ($request['online_payment']) {
            //TODO онлайн оплату подключай сюда
            $this->paymentService->all();
            return response()->json($result['message'], $result['code']);
        }

        return response()->json($result['message'], $result['code']);
    }
}
