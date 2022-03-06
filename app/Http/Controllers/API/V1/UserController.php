<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public UserService $UserService;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  \App\Http\Requests\GetUserRequest $request
    *
    * @return  \Illuminate\Http\Response
    */
    public function index(GetUserRequest $request): \Illuminate\Http\Response
    {
        $result = $this->UserService->all();
        return response($result[0], $result[1]);
    }

    /**
    * Display paginated listing of the resource.
    *
    * @param  \App\Http\Requests\GetUserRequest $request
    *
    * @return    \Illuminate\Http\Response
    */
    public function paginate(GetUserRequest $request): \Illuminate\Http\Response
    {
        $result = $this->UserService->paginate();
        return response($result[0], $result[1]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \App\Http\Requests\CreateUserRequest $request
    *
    * @return    \Illuminate\Http\Response
    */
    public function store(CreateUserRequest $request): \Illuminate\Http\Response
    {
        $result = $this->UserService->create();
        return response($result[0], $result[1]);
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Http\Requests\GetUserRequest $request
    * @param  int                               $id
    *
    * @return    \Illuminate\Http\Response
    */
    public function show(GetUserRequest $request, int $id): \Illuminate\Http\Response
    {
        $result = $this->UserService->show($id);
        return response($result[0], $result[1]);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \App\Http\Requests\UpdateUserRequest $request
    * @param  int                                  $id
    *
    * @return    \Illuminate\Http\Response
    */
    public function update(UpdateUserRequest $request, int $id): \Illuminate\Http\Response
    {
        $result = $this->UserService->update($id);
        return response($result[0], $result[1]);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int $id
    *
    * @return    \Illuminate\Http\Response
    */
    public function destroy(int $id): \Illuminate\Http\Response
    {
        $result = $this->UserService->delete($id);
        return response($result[0], $result[1]);
    }
}
