<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;
use App\Models\Rent;

class RentPolicy
{
    use HandlesAuthorization;

    public function show(User $user, Rent $rent)
    {
        return $user->role == 'admin' || $rent->user_id == $user->id;
    }
}
