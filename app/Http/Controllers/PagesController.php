<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Car;

class PagesController extends Controller
{
    public function homepage()
    {
        return view('pages.homepage');
    }
}
