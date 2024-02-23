<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }


    public function view(User $user)
    {
        return $user->type === "admin" ;
    }

    public function update(User $user)
    {
        return $user->type === "admin";
    }

    public function add(User $user)
    {
        return $user->type === "writer";
    }

    public function delete(User $user)
    {
        return $user->type === "admin";
    }
}
