<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate();
        return $this->apiPaginatedResponse(new UserCollection($users));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ['required', 'string', 'min:3', "max:70"],
            "email" => ["required", "email"],
            "type" => ['required', 'string', "in:admin,writer"],
            "password" => ["required", "string", "min:5", "max:50"],
            "confirm_password" => ["required", "string", "same:password"],
        ]);
        $user = User::create($data);
        return $this->apiResponse(new UserResource($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->apiResponse(new UserResource($user), 201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            "name" => ['required', 'string', 'min:3', "max:70"],
            "email" => ["required", "email", Rule::unique("users")->ignore($user->id)],
            "type" => ['required', 'string', "in:admin,writer"],
            "password" => ["required", "string", "min:5", "max:50"],
            "confirm_password" => ["required", "string", "same:password"],
        ]);
        $user->update($data);
        return $this->apiResponse(new UserResource($data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->apiResponse([], 202);
    }
}
