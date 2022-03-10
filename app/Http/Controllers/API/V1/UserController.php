<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use App\Services\UserService;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public UserService  $userService;
    public OrderService $orderService;

    public function __construct(
        UserService  $userService,
        OrderService $orderService
    )
    {
        $this->userService  = $userService;
        $this->orderService = $orderService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param GetUserRequest $request
    *
    * @return  Response
    */
    public function index(GetUserRequest $request): Response
    {
        $result = $this->userService->all($request->validated());
        return response($result[0], $result[1]);
    }

    /**
    * Display paginated listing of the resource.
    *
    * @param GetUserRequest $request
    *
    * @return    Response
    */
    public function paginate(GetUserRequest $request): Response
    {
        $result = $this->userService->paginate($request->validated());
        return response($result[0], $result[1]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param CreateUserRequest $request
    *
    * @return    Response
    */
    public function store(CreateUserRequest $request): Response
    {
        $result = $this->userService->create($request->validated());
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
        $result = $this->userService->show($id);
        return response($result[0], $result[1]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserRequest $request
     *
     * @param int $id
     * @return    Response
     */
    public function update(UpdateUserRequest $request, int $id): Response
    {
        $result = $this->userService->update($request->validated(), $id);
        return response([
            'status'  => true,
            'message' => OPERATION_SUCCESSFUL
        ], $result[1]);
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
        $result = $this->userService->delete($id);
        return response($result[0], $result[1]);
    }

    public function getAuthUser()
    {
        $result = $this->userService->show(Auth::id());
        return response([
            'status'  => true,
            'data' => $result[0]
        ], $result[1]);
    }
    public function updateAuthUser(UpdateUserRequest $request)
    {
        $id = Auth::id();
        $result = $this->userService->update($request->validated(), $id);
        return response([
            'status'  => true,
            'message' => OPERATION_SUCCESSFUL
        ], $result[1]);
    }
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $result = $this->userService->changePassword($request->validated());
        return response()->json($result['message'], $result['code']);
    }

    public function history(): JsonResponse
    {
        $result  = $this->orderService->history();
        return response()->json($result['message'], $result['code']);
    }
}
