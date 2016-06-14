<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (! Auth::user()->can('edit', $user)) {
            return abort(403);
        }

        return view('user.edit', compact('user'));
    }

    public function rentHistory(User $user)
    {
        $rents = Rent::where('user_id', $user->id)->get();

        return view('user.rentHistory', compact(['rents', 'user']));
    }
}
