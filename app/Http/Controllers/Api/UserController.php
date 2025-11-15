<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function store(UserCreateRequest $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
