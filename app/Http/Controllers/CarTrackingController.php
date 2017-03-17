<?php

namespace App\Http\Controllers;

use App\Models\CarTracking;
use Illuminate\Http\Request;

class CarTrackingController extends Controller
{
    public function store(Request $request)
    {
        CarTracking::create($request->all());

        return 'success';
    }
}
