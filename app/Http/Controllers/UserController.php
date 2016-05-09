<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests;

class UserController extends Controller
{
    public function rentHistory(User $user)
    {
        $rents = Rent::where('user_id', $user->id)->get();

        return view('user.rentHistory', compact(['rents', 'user']));
    }
}
