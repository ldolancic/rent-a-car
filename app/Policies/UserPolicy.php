<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function edit(User $loggedInUser, User $user)
    {
        return Auth::user()->role == 'admin' || $loggedInUser->id == $user->id;
    }

    public function showRentHistory(User $loggedInUser, User $user)
    {
        return Auth::user()->role == 'admin' || $loggedInUser->id == $user->id;
    }
}
