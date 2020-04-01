<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoggedInUserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return UserResource
     */
    public function __invoke(Request $request)
    {
        return new UserResource($request->user());
    }
}
