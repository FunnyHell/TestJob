<?php

namespace App\Policies;

use App\Models\User;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user)
    {
        return $user->hasRole(config('products.role'));
    }

}
